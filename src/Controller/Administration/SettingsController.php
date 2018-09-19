<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Administration;

use App\Controller\Administration\Base\BaseController;
use App\Entity\FrontendUser;
use App\Entity\Setting;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/settings")
 */
class SettingsController extends BaseController
{
    /**
     * @Route("", name="administration_settings")
     *
     * @param Request $request
     * @param FormFactoryInterface $factory
     * @param TranslatorInterface $translator
     *
     * @return Response
     */
    public function indexAction(Request $request, FormFactoryInterface $factory, TranslatorInterface $translator)
    {
        //general settings
        $setting = $this->getDoctrine()->getRepository(Setting::class)->findSingle();
        $form = $this->handleUpdateForm(
            $request,
            $setting
        );

        $admins = $this->processSelectFrontendUsers($request, $factory, $translator, 'admins',
            function ($doctor, $value) {
                /* @var FrontendUser $doctor */
                $doctor->setIsAdministrator($value);
            },
            'admins'
        );

        //allow to edit who receives the emails
        $emails = $this->processSelectFrontendUsers($request, $factory, $translator, 'emails',
            function ($doctor, $value) {
                /* @var FrontendUser $doctor */
                $doctor->setReceivesAdministratorMail($value);
            },
            'emails'
        );

        return $this->render('administration/setting/update.html.twig', ['settings' => $form->createView(), 'admins' => $admins->createView(), 'emails' => $emails->createView()]);
    }

    /**
     * @param Request $request
     * @param FormFactoryInterface $factory
     * @param TranslatorInterface $translator
     * @param string $name
     * @param callable $setProperty
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function processSelectFrontendUsers(Request $request, FormFactoryInterface $factory, TranslatorInterface $translator, $name, $setProperty, $type)
    {
        //create condition by how to select users
        $selectCondition = ['isAdministrator' => true];
        if ($type === 'emails') {
            $selectCondition += ['receivesAdministratorMail' => true];
        }

        //form creation
        $createForm = function () use ($factory, $name, $type, $selectCondition) {
            $frontendUsers = $this->getDoctrine()->getRepository(FrontendUser::class)->findBy($selectCondition);

            return $factory->createNamedBuilder($name)
                ->setMapped(false)
                ->add('frontendUsers', EntityType::class, ['multiple' => true, 'query_builder' => function (EntityRepository $er) use ($type) {
                    $qb = $er->createQueryBuilder('e');
                    if ($type === 'emails') {
                        $qb->where('e.isAdministrator = :isAdministrator');
                        $qb->setParameter(':isAdministrator', true);
                    }

                    return $qb;
                }, 'data' => $frontendUsers, 'class' => FrontendUser::class, 'translation_domain' => 'entity_frontend_user', 'label' => 'entity.plural'])
                ->add('submit', SubmitType::class, ['translation_domain' => 'framework', 'label' => 'form.submit_buttons.update'])
                ->getForm();
        };

        $form = $createForm();

        //handle request
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var FrontendUser[] $propertySetFrontendUsers */
            $propertySetFrontendUsers = $form->getData()['frontendUsers'];

            //ensure at least one activated
            if (\count($propertySetFrontendUsers) === 0) {
                $this->displayError($translator->trans('update.error.select_at_least_one', [], 'administration_setting'));

                return $createForm();
            }

            //prevent deactivate self
            if ($type === 'admins' && !\in_array($this->getUser(), $propertySetFrontendUsers, true)) {
                $this->displayError($translator->trans('update.error.cannot_deactive_self', [], 'administration_setting'));

                return $createForm();
            }

            //deactivate the property for the previous
            $doctors = $this->getDoctrine()->getRepository(FrontendUser::class)->findBy($selectCondition);
            foreach ($doctors as $doctor) {
                $setProperty($doctor, false);
            }

            //active for the chosen ones
            foreach ($propertySetFrontendUsers as $doctor) {
                $setProperty($doctor, true);
            }
            $this->getDoctrine()->getManager()->flush();
        }

        return $form;
    }
}
