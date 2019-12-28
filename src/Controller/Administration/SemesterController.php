<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Administration;

use App\Controller\Administration\Base\BaseController;
use App\Entity\Semester;
use App\Model\Breadcrumb;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/semester")
 */
class SemesterController extends BaseController
{
    /**
     * @Route("", name="administration_semesters")
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        //allow semester creation
        $semester = new Semester();
        $semester->setCreationDate(new \DateTime());
        $semester->setName('');
        $form = $this->handleCreateForm($request, $semester);

        //get all existing semesters
        $semesters = $this->getDoctrine()->getRepository(Semester::class)->findBy([], ['creationDate' => 'DESC']);

        return $this->render('administration/semesters.html.twig', ['semesters' => $semesters, 'form' => $form->createView()]);
    }

    /**     *
     * @Route("/{semester}/remove", name="administration_semester_remove")
     *
     * @return Response
     */
    public function removeAction(Semester $semester)
    {
        //only allow to remove if no more entites attached
        if ($semester->getEvents()->count() > 0) {
            $this->displayError($this->getTranslator()->trans('remove.still_events_attached', [], 'administration_semester'));
        } else {
            $this->fastRemove($semester);
        }

        return $this->redirectToRoute('administration_semesters');
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
}
