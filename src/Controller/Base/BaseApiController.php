<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Base;

use App\Entity\Answer;
use App\Entity\Event;
use App\Entity\Participant;
use App\Entity\Semester;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class BaseApiController extends BaseDoctrineController
{
    public static function getSubscribedServices()
    {
        return parent::getSubscribedServices() +
            [
                'serializer' => SerializerInterface::class,
            ];
    }

    /**
     * @return SerializerInterface
     */
    private function getSerializer()
    {
        return $this->get('serializer');
    }

    /**
     * @param Semester|Semester[] $semester
     *
     * @return JsonResponse
     */
    protected function returnSemester($semester)
    {
        return $this->returnJson($semester, ['name', 'events' => ['id', 'name', 'date', 'feedbackStartTime']]);
    }

    /**
     * @param Event|Event[] $events
     *
     * @return JsonResponse
     */
    protected function returnEvent($events)
    {
        return $this->returnJson($events, ['id', 'name', 'feedbackStartTime', 'feedbackEndTime', 'date', 'template', 'categoryWhitelist']);
    }

    /**
     * @param Answer[]|Answer $answers
     *
     * @return JsonResponse
     */
    protected function returnAnswers($answers)
    {
        return $this->returnJson($answers, ['questionIndex', 'value']);
    }

    /**
     * @param Participant|Participant[] $participants
     *
     * @return JsonResponse
     */
    protected function returnParticipant($participants)
    {
        return $this->returnJson($participants, [
            'timeNeededInSeconds', 'answers' => [
                'questionIndex', 'value',
            ],
        ]);
    }

    /**
     * @param $content
     * @param array $attributes
     *
     * @return JsonResponse
     */
    private function returnJson($content, $attributes = [])
    {
        $addition = \count($attributes) > 0 ? ['attributes' => $attributes] : [];

        return new JsonResponse(
            $this->getSerializer()->serialize(
                $content,
                'json',
                ['json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS | JSON_UNESCAPED_UNICODE] + $addition
            ),
            200,
            [],
            true
        );
    }
}
