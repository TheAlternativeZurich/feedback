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
    private $questionIndex;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $private;

    /**
     * @var Participant
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="answers")
     */
    private $participant;

    public function getQuestionIndex(): int
    {
        return $this->questionIndex;
    }

    public function setQuestionIndex(int $questionIndex): void
    {
        $this->questionIndex = $questionIndex;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getParticipant(): Participant
    {
        return $this->participant;
    }

    public function setParticipant(Participant $participant): void
    {
        $this->participant = $participant;
    }

    public function isPrivate(): bool
    {
        return $this->private;
    }

    public function setPrivate(bool $private): void
    {
        $this->private = $private;
    }
}
