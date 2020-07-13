<?php
namespace App\DataFixtures;

use App\Entity\Famille;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class FamilleFixtures extends Fixture 
   { 
    
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {

            $famille1 = new Famille();
            $famille1->setNom('chien');          
            $manager->persist($famille1);

            $famille2 = new Famille();
            $famille2->setNom('chat');          
            $manager->persist($famille2);
       

        $manager->flush();
        

    }
     
}