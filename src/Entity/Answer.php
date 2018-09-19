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
use Doctrine\ORM\Mapping as ORM;

/**
 * an answer determines a single feedback.
 *
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Answer extends BaseEntity
{
    use IdTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $questionNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $value;

    /**
     * @var Participant
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="answers")
     */
    private $participant;

    /**
     * @return int
     */
    public function getQuestionNumber(): int
    {
        return $this->questionNumber;
    }

    /**
     * @param int $questionNumber
     */
    public function setQuestionNumber(int $questionNumber): void
    {
        $this->questionNumber = $questionNumber;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return Participant
     */
    public function getParticipant(): Participant
    {
        return $this->participant;
    }

    /**
     * @param Participant $participant
     */
    public function setParticipant(Participant $participant): void
    {
        $this->participant = $participant;
    }
}
