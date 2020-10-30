<?php

namespace App\DataFixtures;

use App\Entity\Maisons;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();
      
        for($i = 1; $i <= 10; $i++){
            $maison = new Maisons();
            $maison->setTitre('Maison 4 pieces'.$i);
            $maison->setDescription('Desription de la maison n°'.$i);
            $maison->setChambres(random_int(1, 5));
            $maison->setPrix(random_int(29, 99));
            $maison->setNote(random_int(1, 5));
            $maison->setSurface(random_int(29, 149));
            $maison->setImg1('maison'.$i.'-1.png');
            $maison->setImg2('maison'.$i.'-2.png');
            $maison->setImg3('maison'.$i.'-3.png');
            $manager->persist($maison);
        }

        $manager->flush();

    }
}

        
