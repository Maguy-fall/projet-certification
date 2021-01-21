<?php

namespace App\DataFixtures;


use Faker;
use App\Entity\Villa;
use App\Entity\Terrain;
use App\Entity\Appartement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; ++$i) {
            $appartement = new Appartement();
            $appartement->setTitre($faker->name);
            $appartement->setDescription($faker->text);
            $appartement->setSurface($faker->numberBetween(80, 150));
            $appartement->setPrix($faker->numberBetween(100.000,000, 300.000,000));
            $appartement->setChambres($faker->numberBetween(1, 6));
            $appartement->setGarage($faker->numberBetween(0, 2));
            $appartement->setSalleDeBains($faker->numberBetween(1, 6));
            $appartement->setImageFilename($faker->imageUrl());
            $villa = new Villa();
            $villa->setTitre($faker->name);
            $villa->setDescription($faker->text);
            $villa->setSurface($faker->numberBetween(100, 300));
            $villa->setPrix($faker->numberBetween(50.000,000, 500.000,000));
            $villa->setChambres($faker->numberBetween(1, 6));
            $villa->setGarage($faker->numberBetween(0, 3));
            $villa->setSalleDeBains($faker->numberBetween(1, 6));
            $villa->setImageFilename($faker->imageUrl());
            $terrain = new Terrain();
            $terrain->setTitre($faker->name);
            $terrain->setDescription($faker->text);
            $terrain->setSurface($faker->numberBetween(100, 300));
            $terrain->setPrix($faker->numberBetween(2.000,000, 500.000,000));
            $terrain->setImageFilename($faker->imageUrl());
            

            $manager->persist($appartement);
            $manager->persist($villa);
            $manager->persist($terrain);
        }

        $manager->flush();
    }
}
