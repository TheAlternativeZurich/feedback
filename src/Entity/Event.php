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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFeedbackStartTime(): string
    {
        return $this->feedbackStartTime;
    }

    public function setFeedbackStartTime(string $feedbackStartTime): void
    {
        $this->feedbackStartTime = $feedbackStartTime;
    }

    public function getFeedbackEndTime(): string
    {
        return $this->feedbackEndTime;
    }

    public function setFeedbackEndTime(string $feedbackEndTime): void
    {
        $this->feedbackEndTime = $feedbackEndTime;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): void
    {
        $this->template = $template;
    }

    public function getHasLecture(): bool
    {
        return $this->hasLecture;
    }

    public function setHasLecture(bool $hasLecture): void
    {
        $this->hasLecture = $hasLecture;
    }

    public function getHasExercise(): bool
    {
        return $this->hasExercise;
    }

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

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getTemplateName(): string
    {
        return $this->templateName;
    }

    public function setTemplateName(string $templateName): void
    {
        $this->templateName = $templateName;
    }

    public function getSemester(): Semester
    {
        return $this->semester;
    }

    public function setSemester(Semester $semester): void
    {
        $this->semester = $semester;
    }

    /**
     * which categories should be displayed to the user.
     *
     * @return array
     */
    public function getCategoryWhitelist()
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

    public function isFinalTemplateVersionLoaded(): bool
    {
        return $this->finalTemplateVersionLoaded;
    }

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
    public function getTemplateFilePath()
    {
        return 'templates/' . $this->getTemplateName();
    }

    /**
     * @param $publicDir
     */
    public function loadTemplateIfSafe($publicDir)
    {
        if ($this->finalTemplateVersionLoaded) {
            return;
        }

        if ($this->feedbackHasStarted()) {
            $this->finalTemplateVersionLoaded = true;
        }

        $filePath = $publicDir . '/' . $this->getTemplateFilePath();
        if (file_exists($filePath)) {
            $this->template = file_get_contents($filePath);
        }
    }

    /**
     * @return Answer[]
     */
    public function getPublicFeedback()
    {
        //to preserve privacy, no feedback shown if not enough participants
        if ($this->getParticipants()->count() <= 5) {
            return [];
        }

        $feedback = [];
        foreach ($this->getParticipants() as $participant) {
            foreach ($participant->getAnswers() as $answer) {
                if (!$answer->isPrivate()) {
                    $feedback[] = $answer;
                }
            }
        }

        return $feedback;
    }
}
