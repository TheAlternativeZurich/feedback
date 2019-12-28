<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Extension;

use App\Enum\BooleanType;
use DateTime;
use Symfony\Component\Translation\TranslatorInterface;
use Twig_Extension;
use Twig_SimpleFilter;

class TwigExtension extends Twig_Extension
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * makes the filters available to twig.
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('dateFormat', [$this, 'dateFormatFilter']),
            new Twig_SimpleFilter('timeFormat', [$this, 'timeFormatFilter']),
            new Twig_SimpleFilter('dateTimeFormat', [$this, 'dateTimeFilter']),
            new Twig_SimpleFilter('booleanFormat', [$this, 'booleanFilter']),
            new Twig_SimpleFilter('camelCaseToUnderscore', [$this, 'camelCaseToUnderscoreFilter']),
        ];
    }

    /**
     * @param string $propertyName
     *
     * @return string
     */
    public function camelCaseToUnderscoreFilter($propertyName)
    {
        return mb_strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $propertyName));
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function dateFormatFilter($date)
    {
        if ($date instanceof \DateTime) {
            $dateFormat = $this->translator->trans('time.format.date', [], 'framework');

            return $this->prependDayName($date) . ', ' . $date->format($dateFormat);
        }

        return '-';
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function dateTimeFilter($date)
    {
        if ($date instanceof \DateTime) {
            $dateTimeFormat = $this->translator->trans('time.format.date_time', [], 'framework');

            return $this->prependDayName($date) . ', ' . $date->format($dateTimeFormat);
        }

        return '-';
    }

    /**
     * @param $date
     *
     * @return string
     */
    public function timeFormatFilter($date)
    {
        if (\is_string($date)) {
            return mb_substr($date, 0, 5);
        }

        return '-';
    }

    /**
     * translates the day of the week.
     *
     * @return string
     */
    private function prependDayName(DateTime $date)
    {
        return $this->translator->trans('time.weekdays.' . $date->format('D'), [], 'framework');
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function booleanFilter($value)
    {
        if ($value) {
            return BooleanType::getTranslation(BooleanType::YES, $this->translator);
        }

        return BooleanType::getTranslation(BooleanType::NO, $this->translator);
    }
}
