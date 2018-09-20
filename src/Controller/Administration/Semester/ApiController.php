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

use App\Controller\Base\BaseApiController;
use App\Entity\Event;
use App\Entity\Semester;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends BaseApiController
{
    /**
     * @Route("/{event}", name="administration_semester_api_event")
     * @Security("has_role('ROLE_ADMIN')")
     *
     * @param Event $event
     *
     * @return JsonResponse
     */
    public function eventAction(Event $event)
    {
        return $this->returnEventPrivate($event);
    }
}
