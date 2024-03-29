<?php

/*
 * This file is part of the thealternativezurich/feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Base;

use App\Entity\Base\BaseEntity;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class BaseFormController extends BaseDoctrineController
{
    /**
     * @param callable $onValidCallable with $form ass an argument
     *
     * @return FormInterface
     */
    protected function handleForm(FormInterface $form, Request $request, $onValidCallable)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                return $onValidCallable($form);
            }

            $this->displayError(
                $this->getTranslator()->trans('form.error.validation_failed', [], 'framework')
            );
        }

        return $form;
    }

    /**
     * creates a "create" form.
     *
     * @param callable|null $beforeCreateCallable
     *
     * @return FormInterface
     */
    protected function handleCreateForm(Request $request, BaseEntity $defaultEntity, $beforeCreateCallable = null)
    {
        //translate messages
        $translator = $this->getTranslator();
        $buttonLabel = $translator->trans('form.submit_buttons.create', [], 'framework');
        $successfulText = $translator->trans('form.successful.created', [], 'framework');

        $formType = $this->classToFormType(\get_class($defaultEntity));
        $startEntity = clone $defaultEntity;

        //create persist callable
        $myOnSuccessCallable = function ($form) use ($defaultEntity, $beforeCreateCallable, $successfulText, $formType, $startEntity, $buttonLabel) {
            $manager = $this->getDoctrine()->getManager();

            if (!\is_callable($beforeCreateCallable) || false !== $beforeCreateCallable($manager)) {
                $manager->persist($defaultEntity);
                $manager->flush();
                $this->displaySuccess($successfulText);

                //recreate form so values are not filled out already
                return $this->createForm($formType, $startEntity)
                    ->add('submit', SubmitType::class, ['label' => $buttonLabel, 'translation_domain' => false]);
            }

            return $form;
        };

        //handle the form
        return $this->handleForm(
            $this->createForm($formType, $defaultEntity)
                ->add('submit', SubmitType::class, ['label' => $buttonLabel, 'translation_domain' => false]),
            $request,
            $myOnSuccessCallable
        );
    }

    /**
     * creates a "create" form.
     *
     * @param callable|null $beforeUpdateCallable
     *
     * @return FormInterface
     */
    protected function handleUpdateForm(Request $request, BaseEntity $entity, $beforeUpdateCallable = null)
    {
        //translate messages
        $translator = $this->getTranslator();
        $buttonLabel = $translator->trans('form.submit_buttons.update', [], 'framework');
        $successfulText = $translator->trans('form.successful.updated', [], 'framework');

        //create persist callable
        $myOnSuccessCallable = function ($form) use ($entity, $beforeUpdateCallable, $successfulText) {
            $manager = $this->getDoctrine()->getManager();

            if (!\is_callable($beforeUpdateCallable) || false !== $beforeUpdateCallable($manager)) {
                $manager->persist($entity);
                $manager->flush();
                $this->displaySuccess($successfulText);
            }

            return $form;
        };

        //handle the form
        return $this->handleForm(
            $this->createForm($this->classToFormType(\get_class($entity)), $entity)
                ->add('submit', SubmitType::class, ['label' => $buttonLabel, 'translation_domain' => false]),
            $request,
            $myOnSuccessCallable
        );
    }

    /**
     * creates a "create" form.
     *
     * @param callable $beforeDeleteCallable called after successful submit, before entity is deleted. return true to continue removal
     *
     * @return FormInterface
     */
    protected function handleDeleteForm(Request $request, BaseEntity $entity, $beforeDeleteCallable = null)
    {
        $translator = $this->getTranslator();

        return $this->handleDeleteFormInternal(
            $request,
            $entity,
            $this->classToFormType(\get_class($entity), 'Delete', false),
            $translator->trans('form.submit_buttons.delete', [], 'framework'),
            $translator->trans('form.successful.deleted', [], 'framework'),
            $beforeDeleteCallable ??
            function () {
                return true;
            }
        );
    }

    /**
     * persist the entity to the database if submitted successfully.
     *
     * @param string   $formType             namespace of form type to use
     * @param string   $buttonLabel          label of button
     * @param string   $successText          content of text displayed if successful
     * @param callable $beforeDeleteCallable called after successful submit, before entity is deleted. return true to continue removal
     *
     * @return FormInterface the constructed form
     */
    private function handleDeleteFormInternal(Request $request, BaseEntity $entity, $formType, $buttonLabel, $successText, $beforeDeleteCallable)
    {
        $myOnSuccessCallable = function ($form) use ($entity, $successText, $beforeDeleteCallable) {
            $manager = $this->getDoctrine()->getManager();

            if (false !== $beforeDeleteCallable($entity, $manager)) {
                $manager->remove($entity);
                $manager->flush();
                $this->displaySuccess($successText);

                return null;
            }

            return $form;
        };

        $myForm = $this->handleForm(
            $this->createForm($formType, $entity)
                ->add('submit', SubmitType::class, ['label' => $buttonLabel, 'translation_domain' => false]),
            $request,
            $myOnSuccessCallable
        );

        return $myForm;
    }

    /**
     * produces App\Form\MyClassName\MyClassNameType from App\Entity\MyClassName
     * if $isDeleteType is true then the delete form is returned.
     *
     * @param string $classWithNamespace
     * @param string $prepend            is prepended to class name
     * @param bool   $repeatClass
     *
     * @return string
     */
    private function classToFormType($classWithNamespace, $prepend = '', $repeatClass = true)
    {
        $className = mb_substr($classWithNamespace, mb_strrpos($classWithNamespace, '\\') + 1);

        return 'App\\Form\\'.$className.'\\'.$prepend.($repeatClass ? $className : '').'Type';
    }
}
