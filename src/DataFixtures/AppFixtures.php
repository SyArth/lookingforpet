<?php
namespace App\DataFixtures;


use App\Entity\User;
use App\Entity\Animal;
use App\Entity\Famille;
use App\Entity\Membre;
use App\Entity\Signalement;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class AppFixtures extends Fixture 
{
    
    private Generator $generator;

    
    private string $uploadDirRelativePath;

    /**
     * UserFixtures constructor
     * 
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
        
        $famille1 = new Famille();
        $famille1->setNom('chien');          
        $manager->persist($famille1);

        $famille2 = new Famille();
        $famille2->setNom('chat');          
        $manager->persist($famille2);

        $familles = [$famille1, $famille2];

        foreach($familles as $fa){
            $rand0 = rand(20, 30);
            for($i=1; $i <= $rand0; $i++){
            
            $animal = new Animal();
            $animal->setNom($this->generator->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'));
            $animal->setCommentaire($this->generator->realText($maxNbChars = 200, $indexSize = 2));
            $animal->setActive(true|false);
            $animal->setFamille($fa);
            $manager->persist($animal);
                for($j = 1; $j <= 10; $j++ ){
                    $signalement = new Signalement();
                    $signalement->setAnimal($animal);
                    $signalement->setCommentaire($this->generator->realText($maxNbChars = 200, $indexSize = 2));
                    $manager->persist($signalement);
                }
           
            

            $user = new User();
        $user->setPseudo($this->generator->regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'));
        $user->setEmail($this->generator->email);
        $user->setPassword("password");
        $user->addSignalement($signalement);
        $manager->persist($user);
        $membre = new Membre();
        $membre->setPrenom($this->generator->firstName);
        $membre->setNom($this->generator->lastName);
        $membre->setTelephone($this->generator->phoneNumber);
      
        $membre->addAnimaux($animal);
        $manager->persist($membre);
        
            }
        }
      
               
                
        
        $animaux [] = $animal;

        $rand = rand(20, 40);
        for($i=1; $i <= $rand; $i++){
        
        }
        $users [] = $user;

        $rand1 = rand(10, 20);
        for($i=1; $i <= $rand1; $i++){
        
        }
        $membres [] = $membre;
 
        $manager->flush();
    }
}