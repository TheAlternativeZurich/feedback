<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\FrontendUser;

use App\Entity\FrontendUser;
use App\Form\Base\BaseAbstractType;
use App\Form\Traits\Address\AddressType;
use App\Form\Traits\Person\PersonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends BaseAbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', \App\Form\Traits\User\RegisterType::class, ['inherit_data' => true]);
        $builder->add('person', PersonType::class, ['inherit_data' => true]);
        $builder->add('address', AddressType::class, ['inherit_data' => true]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FrontendUser::class,
            'translation_domain' => 'entity_frontend_user',
        ]);
    }
}
