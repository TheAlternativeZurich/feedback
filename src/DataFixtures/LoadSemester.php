<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\DataFixtures\Base\BaseFixture;
use App\Entity\Semester;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSemester extends BaseFixture
{
    const ORDER = 1;

    /**
     * Load data fixtures with the passed EntityManager.
     */
    public function load(ObjectManager $manager)
    {
        $semesters = ['HS 2018', 'FS 2019'];
        $count = 0;
        foreach ($semesters as $semesterName) {
            $semester = new Semester();
            $semester->setName($semesterName);
            $semester->setCreationDate((new \DateTime('today'))->modify('+' . $count++ . ' day'));
            $manager->persist($semester);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return static::ORDER;
    }
}
