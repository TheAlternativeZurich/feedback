<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Administration\Semester\Event;

use App\Controller\Base\BaseApiController;
use App\Entity\Event;
use App\Entity\Semester;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/view/api")
 */
class ViewApiController extends BaseApiController
{
    /**
     * @Route("/active", name="administration_semester_event_view_api_active")
     *
     * @return JsonResponse
     */
    public function activeEventAction(Event $event)
    {
        $event->loadTemplateIfSafe($this->getParameter('PUBLIC_DIR'));

        return $this->returnEvent($event);
    }

    /**
     * @Route("/{event2}/{identifier}/answers", name="administration_semester_event_view_api_active_answers")
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function activeAnswersAction()
    {
        return $this->json([]);
    }

    /**
     * @Route("/semesters", name="administration_semester_event_view_api_semesters")
     *
     * @return JsonResponse
     */
    public function semestersAction()
    {
        $semesters = $this->getDoctrine()->getRepository(Semester::class)->findBy([], ['name' => 'DESC']);

        return $this->returnSemester($semesters);
    }

    /**
     * @Route("/{event2}/answer", name="administration_semester_event_view_api_event_answer")
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function answerAction()
    {
        return $this->json(true);
    }

    /**
     * @Route("/{event2}/finish", name="administration_semester_event_view_api_event_finish")
     *
     * @return JsonResponse
     */
    public function finishAction()
    {
        return $this->json(true);
    }
}
