<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Api\Base;

use App\Controller\Base\BaseDoctrineController;
use App\Entity\FrontendUser;
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
     * @param FrontendUser[]|FrontendUser $frontendUsers
     *
     * @return JsonResponse
     */
    protected function returnFrontendUsers($frontendUsers)
    {
        return new JsonResponse(
            $this->getSerializer()->serialize(
                $frontendUsers,
                'json',
                ['attributes' => ['id', 'fullName', 'email']]
            ),
            200,
            [],
            true
        );
    }
}
