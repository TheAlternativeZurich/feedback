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
use App\Entity\Event;
use App\Entity\Semester;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Serializer\SerializerInterface;

class LoadEvent extends BaseFixture
{
    const ORDER = LoadSemester::ORDER + 1;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    private $publicDir;

    /**
     * LoadEvent constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer, ParameterBagInterface $parameterBag)
    {
        $this->serializer = $serializer;
        $this->publicDir = $parameterBag->get('PUBLIC_DIR');
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //prepare resources
        $templateName = 'default.json';
        $template = file_get_contents($this->publicDir . '/templates/' . $templateName);
        $json = file_get_contents(__DIR__ . '/Resources/events.json');

        //fill semester with events
        $semesters = $manager->getRepository(Semester::class)->findAll();
        foreach ($semesters as $semester) {
            /** @var Event[] $events */
            $events = $this->serializer->deserialize($json, Event::class . '[]', 'json');
            foreach ($events as $event) {
                $event->setSemester($semester);
                $event->setTemplateName($templateName);
                $event->setTemplate($template);
                $manager->persist($event);
            }
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
