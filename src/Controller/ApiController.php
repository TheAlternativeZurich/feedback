<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Controller\Base\BaseApiController;
use App\Entity\Event;
use App\Entity\Semester;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends BaseApiController
{
    /**
     * @Route("/active_event", name="api_active_event")
     *
     * @return JsonResponse
     */
    public function activeEventAction()
    {
        $now = new \DateTime();
        $today = $now->format('Y-m-d');
        $time = $now->format('H:i');

        $events = $this->getDoctrine()->getRepository(Event::class)->findBy(['date' => $today]);
        foreach ($events as $event) {
            if ($event->getFeedbackStartTime() < $time && $event->getFeedbackEndTime() > $time) {
                $event->loadTemplateIfSafe($this->getParameter('PUBLIC_DIR'));

                return $this->returnEvent($event);
            }
        }

        return $this->returnEvent(null);
    }

    /**
     * @Route("/semesters", name="api_semesters")
     *
     * @return JsonResponse
     */
    public function semestersAction()
    {
        $semesters = $this->getDoctrine()->getRepository(Semester::class)->findBy([], ['name' => 'DESC']);

        return $this->returnSemester($semesters);
    }
}
