<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use function Symfony\Component\Clock\now;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $event = new Event();
        $event->setName('mentynas');
        $event->setDescr('mentynas');
        $event->setRDate(now());
        $event->setSDate(now());
        $manager->persist($event);

        $manager->flush();
    }
}
