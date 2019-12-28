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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends BaseApiController
{
    /**
     * @Route("/active", name="api_active")
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
     * @Route("/{event}/{identifier}/answers", name="api_active_answers")
     *
     * @param $identifier
     *
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function activeAnswersAction(Event $event, $identifier)
    {
        if (!$this->canGiveFeedback($event)) {
            return $this->json([]);
        }

        //get participant & return answers
        $participant = $this->getDoctrine()->getRepository(Participant::class)->findOneBy(['event' => $event->getId(), 'identifier' => $identifier]);
        if ($participant !== null) {
            return $this->returnAnswers($participant->getAnswers());
        }

        return $this->json([]);
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
     * @Route("/{event}/answer", name="api_event_answer")
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
        if (!$this->checkAllFieldsSet($request, ['identifier', 'questionIndex', 'value', 'action'], $payload)) {
            return $this->json(false);
        }

        //write fields
        $identifier = $payload->identifier;
        $questionIndex = $payload->questionIndex;
        $value = $payload->value;
        $action = $payload->action;
        $private = property_exists($payload, 'private') && $payload->private === 'true';

        //ensure all fields set & valid
        if (!isset($identifier) || !\is_int($questionIndex) || !isset($value) || !\in_array($action, ['override', 'ensure_value_exists', 'remove_value'], true)) {
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
        $conditions = ['questionIndex' => $questionIndex, 'participant' => $participant->getId()];
        if ($action === 'ensure_value_exists' || $action === 'remove_value') {
            $conditions += ['value' => $value];
        }
        $answer = $this->getDoctrine()->getRepository(Answer::class)->findOneBy($conditions);

        //create new of not found && not want to remove
        if ($answer === null && $action !== 'remove_value') {
            $answer = new Answer();
            $answer->setParticipant($participant);
            $answer->setPrivate($private);
            $answer->setQuestionIndex($questionIndex);
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
     * @throws \Exception
     *
     * @return JsonResponse
     */
    public function finishAction(Request $request, Event $event)
    {
        if (!$this->canGiveFeedback($event)) {
            return $this->json(1);
        }

        if (!$this->checkAllFieldsSet($request, ['identifier', 'timeNeededInSeconds'], $payload)) {
            return $this->json(false);
        }

        //write fields
        $identifier = $payload->identifier;
        $timeNeededInSeconds = (int)$payload->timeNeededInSeconds;

        //get participant
        $participant = $this->getDoctrine()->getRepository(Participant::class)->findOneBy(['identifier' => $identifier, 'event' => $event->getId()]);
        if ($participant === null || $participant->getTimeNeededInSeconds() !== null) {
            return $this->json(false);
        }

        //set time info
        $participant->setTimeNeededInSeconds($timeNeededInSeconds);
        $this->fastSave($participant);

        return $this->json(true);
    }

    /**
     * @param string[] $requiredFields
     * @param string[] $payload
     *
     * @return bool
     */
    private function checkAllFieldsSet(Request $request, array $requiredFields, &$payload)
    {
        //get request fields
        $payload = json_decode($request->getContent());
        foreach ($requiredFields as $requiredField) {
            if (!property_exists($payload, $requiredField)) {
                return false;
            }
        }

        return true;
    }

    /**
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
        $eventEndTime = \DateTime::createFromFormat('H:i:s', $event->getFeedbackEndTime());
        //allow additional 1 hour to hand in after the feedback has been closed
        $threshold = $eventEndTime->add(new \DateInterval('PT1H'))->format('H:i');
        //prevent if current time higher than threshold & threshold has not done a wrap around
        if ($currentTime > $threshold && $event->getFeedbackEndTime() < $threshold) {
            return false;
        }

        return true;
    }
}
