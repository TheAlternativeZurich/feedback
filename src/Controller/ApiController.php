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
use App\Entity\Answer;
use App\Entity\Event;
use App\Entity\Participant;
use App\Entity\Semester;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

                return $this->returnActiveEvent($event);
            }
        }

        return $this->returnActiveEvent(null);
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

    /**
     * @Route("/{event}/public", name="api_event_public")
     *
     * @param Event $event
     *
     * @return JsonResponse
     */
    public function eventPublicAction(Event $event)
    {
        return $this->returnEventPublic($event->feedbackHasStarted() ? $event : null);
    }

    /**
     * @param Event $event
     *
     * @throws \Exception
     *
     * @return bool
     */
    private function canGiveFeedback(Event $event)
    {
        //prevent hand in too early
        if (!$event->feedbackHasStarted()) {
            return false;
        }

        //prevent hand in on other days
        $now = new \DateTime();
        $today = $now->format('Y-m-d');
        if ($today !== $event->getDate()) {
            return false;
        }

        //prevent hand in too late
        $currentTime = $now->format('H:i');
        $eventEndTime = \DateTime::createFromFormat('H:i', $event->getFeedbackEndTime());
        //allow additional 1 hour to hand in after the feedback has been closed
        $threshold = $eventEndTime->add(new \DateInterval('PT1H'))->format('H:i');
        //prevent if current time higher than threshold & threshold has not done a wrap around
        if ($currentTime > $threshold && $event->getFeedbackEndTime() < $threshold) {
            return false;
        }

        return true;
    }

    /**
     * @Route("/{event}/answer", name="api_event_answer")
     *
     * @param Request $request
     * @param Event $event
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function answerAction(Request $request, Event $event)
    {
        if (!$this->canGiveFeedback($event)) {
            return $this->json(false);
        }

        //get request fields
        $identifier = $request->request->get('identifier');
        $questionNumber = $request->request->get('questionNumber');
        $value = $request->request->get('value');
        $private = $request->request->get('private') === 'true';
        $action = $request->request->get('action', 'override');

        //ensure all fields set
        if (!isset($identifier) || !isset($questionNumber) || !isset($value) || !isset($private) || !\in_array($action, ['override', 'ensure_value_exists', 'remove_value'], true)) {
            return $this->json(false);
        }

        //get participant or create a new one
        $participant = $this->getDoctrine()->getRepository(Participant::class)->findOneBy(['identifier' => $identifier, 'event' => $event->getId()]);
        if ($participant === null) {
            $participant = new Participant();
            $participant->setEvent($event);
            $participant->setIdentifier($identifier);
            $this->fastSave($participant);
        }

        //try to find existing answer
        $conditions = ['questionNumber' => $questionNumber, 'participant' => $participant->getId()];
        if ($action === 'ensure_value_exists' || $action === 'remove_value') {
            $conditions += ['value' => $value];
        }
        $answer = $this->getDoctrine()->getRepository(Answer::class)->findOneBy($conditions);

        //create new of not found && not want to remove anyways
        if ($answer === null && $action !== 'remove_value') {
            $answer = new Answer();
            $answer->setParticipant($participant);
            $answer->setPrivate($private);
            $answer->setQuestionNumber($questionNumber);
        }
        $answer->setValue($value);

        //process actions
        if ($action === 'override' || $action === 'ensure_value_exists') {
            $this->fastSave($answer);
        } elseif ($action === 'remove_value' && $answer !== null) {
            $this->fastRemove($answer);
        }

        return $this->json(true);
    }

    /**
     * @Route("/{event}/finish", name="api_event_finish")
     *
     * @param Request $request
     * @param Event $event
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function finishAction(Request $request, Event $event)
    {
        if (!$this->canGiveFeedback($event)) {
            return $this->json(false);
        }

        //get request fields
        $identifier = $request->request->get('identifier');
        $timeNeededInMinutes = (int)$request->request->get('timeNeededInMinutes');

        $participant = $this->getDoctrine()->getRepository(Participant::class)->findOneBy(['identifier' => $identifier, 'event' => $event->getId()]);
        if ($participant === null || $participant->getTimeNeededInMinutes() !== null) {
            return $this->json(false);
        }

        //set time info
        $participant->setTimeNeededInMinutes($timeNeededInMinutes);
        $this->fastSave($participant);

        return $this->json(true);
    }

    /**
     * @Route("/{event}/private", name="api_event_private")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Event $event
     *
     * @return JsonResponse
     */
    public function eventPrivateAction(Event $event)
    {
        return $this->returnEventPrivate($event);
    }
}
