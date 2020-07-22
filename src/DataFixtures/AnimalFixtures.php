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
    private string $uploadsRelativeDir;

    /**
     * UserFixtures constructor.
     * @param Generator $generator
     * @param string $uploadsRelativeDir
     */
    public function __construct(Generator $generator, string $uploadsRelativeDir)
    {
        $this->generator = $generator;
        $this->uploadsRelativeDir = $uploadsRelativeDir;
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {

   
  
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
            $animal->setFamille($this->generator->randomElement($familles));

            /** @var Image $image */
            $image = new Image();
            $image->setNom(sprintf('%s %s',$this->uploadsRelativeDir,'animal.png'));
            $image->setAlt('animal');
            
            /** @var Puce $puce */
            $puce = new Puce();
            $puce->setNumero($this->generator->unique()->regexify('[0-9]{15}'));
            $manager->persist($puce);
            $animal->setPuce($puce);

            /** @var Tatouage $tatouage */
            $tatouage = new Tatouage();
            $tatouage->setNumero($this->generator->unique()->regexify('[0-9][A-Z]{3}[0-9]{3}'));
            $manager->persist($tatouage);        
            $animal->setTatouage($tatouage);
            
           
                /** @var User $user */
                $user = new User();
                $user->setPseudo($this->generator->unique()->city);
                $user->setEmail($this->generator->unique()->email);
                $user->setPassword("password");
                $user->setPrenom($this->generator->firstName);
                $user->setNom($this->generator->lastName);
                $user->setTelephone($this->generator->phoneNumber);
                $user->setIsAdmin( $this->generator->boolean(false) );
                $user->setIsActive( $this->generator->boolean('70%? true : false') );
                $manager->persist($user);   
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
        ];
    }
}