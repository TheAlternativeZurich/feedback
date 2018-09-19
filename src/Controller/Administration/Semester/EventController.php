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

use App\Controller\Base\BaseFormController;
use App\Entity\Event;
use App\Entity\Semester;
use App\Model\Breadcrumb;
use App\Security\Voter\Base\BaseVoter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/event")
 */
class EventController extends BaseFormController
{
    /**
     * @Route("/new", name="administration_semester_event_new")
     *
     * @param Request $request
     * @param Semester $semester
     * @param TranslatorInterface $translator
     *
     * @return Response
     */
    public function newAction(Request $request, Semester $semester, TranslatorInterface $translator)
    {
        //create the event
        $event = new Event();
        $event->setSemester($semester);

        //fill out default values as smart as possible
        $lastEvent = $this->getDoctrine()->getRepository(Event::class)->findBy([], ['createdAt' => 'DESC'], 1);
        if (\count($lastEvent) > 0) {
            $event->setFeedbackStartTime($lastEvent[0]->getFeedbackStartTime());
            $event->setFeedbackEndTime($$lastEvent[0]->getFeedbackEndTime());
        } else {
            $event->setFeedbackStartTime('19:00');
            $event->setFeedbackEndTime('21:00');
        }

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
     * @param Request $request
     * @param Semester $semester
     * @param Event $event
     * @param TranslatorInterface $translator
     *
     * @return Response
     */
    public function editAction(Request $request, Semester $semester, Event $event, TranslatorInterface $translator)
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

    /**     *
     * @Route("/{event}/remove", name="administration_semester_event_remove")
     *
     * @param Request $request
     * @param Semester $semester
     * @param Event $event
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

    /**
     * @param Event $event
     */
    private function ensureAccessGranted(Event $event)
    {
        $this->denyAccessUnlessGranted(BaseVoter::VIEW, $event);
    }

    /**
     * @param Event $event
     *
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
     * @param string $view
     * @param Semester $semester
     * @param array $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderWithSemester(string $view, Semester $semester, array $parameters = [])
    {
        return $this->render($view, $parameters + ['semester' => $semester]);
    }
}
