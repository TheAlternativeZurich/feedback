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

use App\Controller\Base\BaseDoctrineController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class IndexController extends BaseDoctrineController
{
    /**
     * @Route("", name="index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('index/index.html.twig');
    }

    /**
     * no breadcrumbs on the index.
     *
     * @return \App\Model\Breadcrumb[]|array
     */
    protected function getIndexBreadcrumbs()
    {
        return [];
    }
}
