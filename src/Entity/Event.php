<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Entity;

use App\Entity\Base\BaseEntity;
use App\Entity\Traits\IdTrait;

class Event extends BaseEntity
{
    use IdTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $feedbackStartTime;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $feedbackEndTime;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $template;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $hasLecture;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $hasExercise;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getFeedbackStartTime(): string
    {
        return $this->feedbackStartTime;
    }

    /**
     * @param string $feedbackStartTime
     */
    public function setFeedbackStartTime(string $feedbackStartTime): void
    {
        $this->feedbackStartTime = $feedbackStartTime;
    }

    /**
     * @return string
     */
    public function getFeedbackEndTime(): string
    {
        return $this->feedbackEndTime;
    }

    /**
     * @param string $feedbackEndTime
     */
    public function setFeedbackEndTime(string $feedbackEndTime): void
    {
        $this->feedbackEndTime = $feedbackEndTime;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    /**
     * @return bool
     */
    public function getHasLecture(): bool
    {
        return $this->hasLecture;
    }

    /**
     * @param bool $hasLecture
     */
    public function setHasLecture(bool $hasLecture): void
    {
        $this->hasLecture = $hasLecture;
    }

    /**
     * @return bool
     */
    public function getHasExercise(): bool
    {
        return $this->hasExercise;
    }

    /**
     * @param bool $hasExercise
     */
    public function setHasExercise(bool $hasExercise): void
    {
        $this->hasExercise = $hasExercise;
    }
}
