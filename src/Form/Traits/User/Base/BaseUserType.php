<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Traits\User\Base;

use App\Form\Base\BaseAbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class BaseUserType extends BaseAbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'trait_user',
            'label' => 'trait.name',
        ]);
    }
}
