<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\Event;

use App\Entity\Event;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /** @var string */
    private $publicDir;

    /**
     * EventType constructor.
     */
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->publicDir = $parameterBag->get('PUBLIC_DIR');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class);
        $builder->add('date', DateType::class, ['input' => 'string', 'widget' => 'single_text']);

        $builder->add('feedbackStartTime', TimeType::class, ['input' => 'string', 'widget' => 'single_text']);
        $builder->add('feedbackEndTime', TimeType::class, ['input' => 'string', 'widget' => 'single_text']);

        //get all templates
        $templates = [];
        foreach (scandir($this->publicDir . '/templates') as $template) {
            if ($this->endsWith($template, '.json')) {
                $templates[mb_substr($template, 0, -5)] = $template;
            }
        }
        $builder->add('templateName', ChoiceType::class, ['choices' => $templates, 'choice_translation_domain' => false, 'help' => 'help.template_name']);
        $builder->add('hasExercise', CheckboxType::class, ['required' => false, 'help' => 'help.has_exercise']);
        $builder->add('hasLecture', CheckboxType::class, ['required' => false, 'help' => 'help.has_lecture']);
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    private function endsWith($haystack, $needle)
    {
        // search forward starting from end minus needle length characters
        if ($needle === '') {
            return true;
        }
        $diff = mb_strlen($haystack) - mb_strlen($needle);

        return $diff >= 0 && mb_strpos($haystack, $needle, $diff) !== false;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'translation_domain' => 'entity_event',
        ]);
    }
}
