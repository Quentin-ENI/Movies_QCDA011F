<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    static $categoryKeys = [
        'adventure',
        'science-fiction',
        'documentary',
        'thriller',
    ];

    public function load(ObjectManager $manager): void
    {
        $adventure = new Category();
        $adventure->setName('Aventure');
        $this->addReference(static::$categoryKeys[0], $adventure);
        $manager->persist($adventure);

        $scienceFiction = new Category();
        $scienceFiction->setName('Science Fiction');
        $this->addReference(static::$categoryKeys[1], $scienceFiction);
        $manager->persist($scienceFiction);

        $documentary = new Category();
        $documentary->setName('Documentaire');
        $this->addReference(static::$categoryKeys[2], $documentary);
        $manager->persist($documentary);

        $thriller = new Category();
        $thriller->setName('Thriller');
        $this->addReference(static::$categoryKeys[3], $thriller);
        $manager->persist($thriller);

        $manager->flush();
    }
}
