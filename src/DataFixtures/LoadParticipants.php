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
use App\Entity\Answer;
use App\Entity\Event;
use App\Entity\Participant;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Serializer\SerializerInterface;

class LoadParticipants extends BaseFixture
{
    const ORDER = LoadEvent::ORDER + 1;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * LoadEvent constructor.
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Load data fixtures with the passed EntityManager.
     */
    public function load(ObjectManager $manager)
    {
        //prepare events
        $events = $manager->getRepository(Event::class)->findAll();
        $now = (new \DateTime())->format('Y-m-d');

        //prepare participants
        $dir = __DIR__ . '/Resources/participants';
        $fileNames = scandir($dir);
        /** @var Answer[][] $participantJson */
        $participantJson = [];
        foreach ($fileNames as $fileName) {
            //filter out folder links
            if ($fileName !== '.' && $fileName !== '..') {
                $participantJson[] = file_get_contents($dir . '/' . $fileName);
            }
        }

        //add participants to all events
        foreach ($events as $event) {
            //only add if already happened
            if ($event->getDate() < $now) {
                foreach ($participantJson as $json) {
                    $participant = new Participant();
                    $participant->setIdentifier(uniqid());
                    $participant->setEvent($event);
                    $participant->setTimeNeededInSeconds(rand(0, 60 * 3));

                    /** @var Answer[] $answers */
                    $answers = $this->serializer->deserialize($json, Answer::class . '[]', 'json');
                    foreach ($answers as $answer) {
                        $answer->setParticipant($participant);
                        $manager->persist($answer);
                    }
                    $manager->persist($participant);
                }
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
