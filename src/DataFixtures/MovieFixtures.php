<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 1000; $i++) {
            $movie = new Movie();
            $movie->setTitle($faker->words(3, true));
            $movie->setReleaseDate($faker->numberBetween(1900, 2020));

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
