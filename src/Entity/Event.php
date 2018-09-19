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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * an event determines how the questionnaire looks like.
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
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
     * @var string
     *
     * @ORM\Column(type="text")
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
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $templateName;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $hasLecture = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $hasExercise = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $finalTemplateVersionLoaded = false;

    /**
     * @var Participant[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="event")
     */
    private $participants;

    /**
     * @var Semester
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Semester", inversedBy="events")
     */
    private $semester;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

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

    /**
     * @return Participant[]|ArrayCollection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTemplateName(): string
    {
        return $this->templateName;
    }

    /**
     * @param string $templateName
     */
    public function setTemplateName(string $templateName): void
    {
        $this->templateName = $templateName;
    }

    /**
     * @return Semester
     */
    public function getSemester(): Semester
    {
        return $this->semester;
    }

    /**
     * @param Semester $semester
     */
    public function setSemester(Semester $semester): void
    {
        $this->semester = $semester;
    }

    /**
     * which categories should be displayed to the user.
     *
     * @return array
     */
    public function categoryWhitelist()
    {
        $base = ['event'];
        if ($this->getHasExercise()) {
            $base[] = 'exercise';
        }
        if ($this->getHasLecture()) {
            $base[] = 'lecture';
        }

        return $base;
    }

    /**
     * @return bool
     */
    public function isFinalTemplateVersionLoaded(): bool
    {
        return $this->finalTemplateVersionLoaded;
    }

    /**
     * @param bool $finalTemplateVersionLoaded
     */
    public function setFinalTemplateVersionLoaded(bool $finalTemplateVersionLoaded): void
    {
        $this->finalTemplateVersionLoaded = $finalTemplateVersionLoaded;
    }

    /**
     * @return bool
     */
    public function feedbackHasStarted()
    {
        $now = new \DateTime();
        $today = $now->format('Y-m-d');
        $time = $now->format('H:i');

        return $today > $this->getDate() || ($today === $this->getDate() && $time >= $this->getFeedbackStartTime());
    }

    /**
     * @return string
     */
    public function getTemplateFilepath()
    {
        return 'templates/' . $this->getTemplateName();
    }

    /**
     * @param $publicDir
     *
     * @return bool
     */
    public function loadTemplateIfSafe($publicDir)
    {
        if ($this->finalTemplateVersionLoaded) {
            return true;
        }

        if ($this->feedbackHasStarted()) {
            $this->finalTemplateVersionLoaded = true;
        }

        $filePath = $publicDir . '/' . $this->getTemplateFilepath();
        if (file_exists($filePath)) {
            $this->template = file_get_contents($filePath);
        }
    }
}
