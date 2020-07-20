<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Famille;
use App\Entity\puce;
use App\Entity\Tatouage;
use App\Entity\Image;
use App\Entity\User;
use App\Entity\Signalement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var Generator
     */
    private Generator $generator;

    /**
     * @var string
     */
    private string $uploadDirRelativePath;

    /**
     * UserFixtures constructor.
     * @param Generator $generator
     * @param string $uploadDirRelativePath
     */
    public function __construct(Generator $generator, string $uploadDirRelativePath)
    {
        $this->generator = $generator;
        $this->uploadDirRelativePath = $uploadDirRelativePath;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {

        /** @var User $user */
        $user = $this->getReference(sprintf("user"));
  
         /** @var Famille $famille */
        $famille1 = $this->getReference(sprintf("famille1"));
        $famille2 = $this->getReference(sprintf("famille2"));
        $familles = [$famille1, $famille2];
        
      
        $rand = rand(400, 500);
        for($i=1; $i <= $rand; $i++){           
            $animal = new Animal();
            $animal->setNom($this->generator->unique()->city);
            $animal->setCommentaire($this->generator->realText($maxNbChars = 200, $indexSize = 2));
            $animal->setActive('80%? true : false');
            $animal->getFamille('50%? $famille1 : $famille2');

            /** @var Image $image */
            $image = new Image();
            $image->setNom(sprintf('%s %s',$this->uploadDirRelativePath,'animal.png'));
            $image->setAlt('animal');
            
            /** @var Puce $puce */
            $puce = $this->getReference(sprintf("puce"));
            $animal->setPuce($puce);

            /** @var Tatouage $tatouage */
            $tatouage = $this->getReference(sprintf("tatouage"));         
            $animal->setTatouage($tatouage);
            
            /** @var User $ser */
            $user = $this->getReference(sprintf("user"));
            $animal->setUser($user);

           
            $image->setAnimal($animal);
            $animal->getImages($image);
            $manager->persist($image);
            $manager->persist($animal);
            

           
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
        UserFixtures::class,
        FamilleFixtures::class,
        IdentificationFixtures::class,
        ];
    }
}