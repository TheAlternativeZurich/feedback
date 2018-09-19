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
use App\Entity\FrontendUser;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFrontendUser extends BaseFixture
{
    const ORDER = 1;

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        //load some doctors
        $this->loadSomeRandoms($manager, 30);

        //create admin
        $admin = $this->getRandomInstance();
        $admin->setEmail('info@' . $this->getTranslator()->trans('base.brand', [], 'layout'));
        $admin->setPlainPassword('asdf');
        $admin->setPassword();
        $admin->setIsAdministrator(true);
        $admin->setReceivesAdministratorMail(true);
        $manager->persist($admin);

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return static::ORDER;
    }

    /**
     * create an instance with all random values.
     *
     * @return FrontendUser
     */
    protected function getRandomInstance()
    {
        $frontendUser = new FrontendUser();
        $this->fillAddress($frontendUser);
        $this->fillPerson($frontendUser);
        $this->fillUser($frontendUser);

        return $frontendUser;
    }
}
