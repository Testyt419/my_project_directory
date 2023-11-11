<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\PrizeNames;
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

        $event->addPrize($this->makePrizeForEvent($manager, 'pydariukas'));
        $event->addPrize($this->makePrizeForEvent($manager, 'debiliukas'));

        $manager->flush();
    }

    private function makePrizeForEvent(ObjectManager $manager, string $name='pydariukas'): PrizeNames
    {
        $prizename = new PrizeNames;
        $prizename->setName($name);
        $manager->persist($prizename);
        return $prizename;
    }
}
