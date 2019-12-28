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
 * @Route("/result/api")
 */
class ResultApiController extends BaseApiController
{
    /**
     * @Route("/active", name="administration_semester_event_result_api_active")
     *
     * @return JsonResponse
     */
    public function activeEventAction(Event $event)
    {
        return $this->returnEvent($event);
    }

    /**
     * @Route("/{event2}/participants", name="administration_semester_event_result_api_participants")
     *
     * @return JsonResponse
     */
    public function participantsAction(Event $event)
    {
        return $this->returnParticipant($event->getParticipants());
    }

    /**
     * @Route("/semesters", name="administration_semester_event_result_api_semesters")
     *
     * @return JsonResponse
     */
    public function semestersAction()
    {
        $semesters = $this->getDoctrine()->getRepository(Semester::class)->findBy([], ['name' => 'DESC']);

        return $this->returnSemester($semesters);
    }
}
