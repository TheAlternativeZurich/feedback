<?php

/*
 * This file is part of the feedback project.
 *
 * (c) Florian Moser <git@famoser.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures\Base;

use App\Entity\Traits\AddressTrait;
use App\Entity\Traits\PersonTrait;
use App\Entity\Traits\ThingTrait;
use App\Entity\Traits\UserTrait;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BaseFixture extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /* @var ContainerInterface $container */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    protected function getTranslator()
    {
        return $this->container->get('translator');
    }

    /**
     * @return \Faker\Generator
     */
    protected function getFaker()
    {
        return Factory::create('de_CH');
    }

    /**
     * @param UserTrait $obj
     */
    protected function fillUser($obj)
    {
        $faker = $this->getFaker();
        $obj->setEmail($faker->email);
        $obj->setPlainPassword($faker->password);
        $obj->setPassword();
        $obj->setRegistrationDate(new \DateTime());
        $obj->setLastLogin(new \DateTime());
    }

    /**
     * @param AddressTrait $obj
     */
    protected function fillAddress($obj)
    {
        $faker = $this->getFaker();
        $obj->setStreet($faker->streetAddress);
        $obj->setStreetNr($faker->numberBetween(0, 300));
        if ($faker->numberBetween(0, 10) > 8) {
            $obj->setAddressLine($faker->streetAddress);
        }
        $obj->setPostalCode($faker->numberBetween(0, 9999));
        $obj->setCity($faker->city);
        $obj->setCountry($faker->countryCode);
    }

    /**
     * @param ThingTrait $obj
     */
    protected function fillThing($obj)
    {
        $faker = $this->getFaker();
        $obj->setName($faker->text(50));
        if ($faker->numberBetween(0, 10) > 5) {
            $obj->setDescription($faker->text(200));
        }
    }

    /**
     * @param PersonTrait $obj
     */
    protected function fillPerson($obj)
    {
        $faker = $this->getFaker();
        $obj->setGivenName($faker->firstName);
        $obj->setFamilyName($faker->lastName);
        if ($faker->numberBetween(0, 10) > 5) {
            $obj->setJobTitle($faker->jobTitle);
        }
    }

    /**
     * create random instances.
     *
     * @param $count
     *
     * @throws \Exception
     */
    protected function loadSomeRandoms(ObjectManager $manager, $count = 5)
    {
        for ($i = 0; $i < $count; ++$i) {
            $instance = $this->getRandomInstance();
            if ($instance === null) {
                throw new \Exception('you need to override getRandomInstance to return an instance before you can use this function');
            }
            $manager->persist($instance);
        }
    }

    /**
     * create an instance with all random values.
     *
     * @return mixed
     */
    protected function getRandomInstance()
    {
        return null;
    }
}
