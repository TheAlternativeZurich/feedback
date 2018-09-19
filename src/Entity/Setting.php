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
use App\Entity\Traits\ChangeAwareTrait;
use App\Entity\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Setting extends BaseEntity
{
    use IdTrait;
    use ChangeAwareTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $maxShowUsersInList = 20;

    /**
     * @return int
     */
    public function getMaxShowUsersInList(): int
    {
        return $this->maxShowUsersInList;
    }

    /**
     * @param int $maxShowUsersInList
     */
    public function setMaxShowUsersInList(int $maxShowUsersInList): void
    {
        $this->maxShowUsersInList = $maxShowUsersInList;
    }
}
