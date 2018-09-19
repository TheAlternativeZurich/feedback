<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Api;

use App\Controller\Api\Base\BaseApiController;
use App\Entity\FrontendUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vote")
 */
class VoteController extends BaseApiController
{
    /**
     * @Route("/frontend_users", name="api_vote_frontend_users")
     *
     * @return JsonResponse
     */
    public function dataAction()
    {
        $frontendUsers = $this->getDoctrine()->getRepository(FrontendUser::class)->findBy(['deletedAt' => null]);

        return $this->returnFrontendUsers($frontendUsers);
    }
}
