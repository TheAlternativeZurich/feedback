<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Setting;

use App\Entity\Setting;
use App\Form\Base\BaseAbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingType extends BaseAbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('maxShowUsersInList', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Setting::class,
            'translation_domain' => 'entity_setting',
        ]);
    }
}
