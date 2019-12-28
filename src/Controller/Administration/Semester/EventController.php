<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Administration\Semester;

use App\Controller\Administration\Base\BaseController;
use App\Entity\Event;
use App\Entity\Semester;
use App\Model\Breadcrumb;
use App\Security\Voter\Base\BaseVoter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class EventController extends BaseController
{
    /**
     * @Route("/new", name="administration_semester_event_new")
     *
     * @return Response
     */
    public function newAction(Request $request, Semester $semester)
    {
        //create the event
        $event = new Event();
        $event->setSemester($semester);
        $event->setName('');

        //fill out default values as smart as possible
        /** @var Event|null $lastEvent */
        $lastEvent = $semester->getEvents()->first();
        if ($lastEvent) {
            $event->setFeedbackStartTime($lastEvent->getFeedbackStartTime());
            $event->setFeedbackEndTime($lastEvent->getFeedbackEndTime());
            $event->setTemplateName($lastEvent->getTemplateName());
        } else {
            $event->setFeedbackStartTime('19:00:00');
            $event->setFeedbackEndTime('21:00:00');
            $event->setTemplateName('default.json');
        }
        $event->setDate((new \DateTime())->modify('+20 day')->format('Y-m-d'));

        //check if can indeed create the event
        $this->ensureAccessGranted($event);

        //process form
        $myForm = $this->handleCreateForm(
            $request,
            $event,
            function () use ($event) {
                return $this->prePersistActions($event);
            }
        );
        if ($myForm instanceof Response) {
            return $myForm;
        }

        return $this->renderWithSemester('administration/semester/event/new.html.twig', $semester, ['form' => $myForm->createView()]);
    }

    /**
     * @Route("/{event}/edit", name="administration_semester_event_edit")
     *
     * @return Response
     */
    public function editAction(Request $request, Semester $semester, Event $event)
    {
        $this->ensureAccessGranted($event);

        //process form
        $myForm = $this->handleUpdateForm(
            $request,
            $event,
            function () use ($event) {
                return $this->prePersistActions($event);
            }
        );
        if ($myForm instanceof Response) {
            return $myForm;
        }

        return $this->renderWithSemester('administration/semester/event/edit.html.twig', $semester, ['form' => $myForm->createView(), 'event' => $event]);
    }

    /**
     * @Route("/{event}/view/", name="administration_semester_event_view")
     *
     * @return Response
     */
    public function viewAction(Semester $semester, Event $event)
    {
        return $this->renderWithSemester('administration/semester/event/view.html.twig', $semester, ['event' => $event]);
    }

    /**
     * @Route("/{event}/result/", name="administration_semester_event_result")
     *
     * @return Response
     */
    public function resultAction(Semester $semester, Event $event)
    {
        return $this->renderWithSemester('administration/semester/event/result.html.twig', $semester, ['event' => $event]);
    }

    /**     *
     * @Route("/{event}/remove", name="administration_semester_event_remove")
     *
     * @return Response
     */
    public function removeAction(Request $request, Semester $semester, Event $event)
    {
        $this->ensureAccessGranted($event);

        //process form
        $form = $this->handleDeleteForm($request, $event);
        if ($form === null) {
            return $this->redirectToRoute('administration_semesters');
        }

        return $this->renderWithSemester('administration/semester/event/remove.html.twig', $semester, ['event' => $event, 'form' => $form->createView()]);
    }

    /**
     * get the breadcrumbs leading to this controller.
     *
     * @return Breadcrumb[]
     */
    protected function getIndexBreadcrumbs()
    {
        return array_merge(parent::getIndexBreadcrumbs(), [
            new Breadcrumb(
                $this->generateUrl('administration_semesters'),
                $this->getTranslator()->trans('index.title', [], 'administration_semester')
            ),
        ]);
    }

    private function ensureAccessGranted(Event $event)
    {
        $this->denyAccessUnlessGranted(BaseVoter::VIEW, $event);
    }

    /**
     * @return bool
     */
    protected function prePersistActions(Event $event)
    {
        $event->loadTemplateIfSafe($this->getParameter('PUBLIC_DIR'));

        return true;
    }

    /**
     * renders the view & prepares views which need the active election.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderWithSemester(string $view, Semester $semester, array $parameters = [])
    {
        return $this->render($view, $parameters + ['semester' => $semester]);
    }
}
