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
 * a participant answers the questions.
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Participant extends BaseEntity
{
    use IdTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $identifier;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timeNeededInSeconds;

    /**
     * @var Answer[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="participant")
     */
    private $answers;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="participants")
     */
    private $event;

    /**
     * Participant constructor.
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @return Answer[]|ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

    public function getTimeNeededInSeconds(): ?int
    {
        return $this->timeNeededInSeconds;
    }

    public function setTimeNeededInSeconds(?int $timeNeededInSeconds): void
    {
        $this->timeNeededInSeconds = $timeNeededInSeconds;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }
}
