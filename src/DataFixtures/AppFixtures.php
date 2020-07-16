<?php
namespace App\DataFixtures;


use App\Entity\User;
use App\Entity\Animal;
use App\Entity\Famille;
use App\Entity\Signalement;
use App\Entity\Tatouage;
use App\Entity\Puce;
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

       

        $rand = rand(100, 200);

        foreach($familles as $fa){
           
            for($i=1; $i <= $rand; $i++){
            
            $animal = new Animal();
            $animal->setNom($this->generator->unique()->city);
            $animal->setCommentaire($this->generator->realText($maxNbChars = 200, $indexSize = 2));
            $animal->setActive(true|false);
            $animal->setFamille($fa);
            
            $puce = new Puce();
            $puce->setNumero($this->generator->unique()->regexify('[0-9]{15}'));
            $puce->getAnimal($animal);
            $manager->persist($puce);
    
            $tatouage = new Tatouage();
            $tatouage->setNumero($this->generator->unique()->regexify('[0-9][A-Z]{3}[0-9]{3}'));
            $tatouage->getAnimal($animal);
            $manager->persist($tatouage);
            $animal->setPuce($puce);
            $animal->setTatouage($tatouage);
            $manager->persist($animal);
                for($j = 1; $j <= 10; $j++ ){
                    $signalement = new Signalement();
                    $signalement->setAnimal($animal);
                    $signalement->setCommentaire($this->generator->realText($maxNbChars = 200, $indexSize = 2));
                    $manager->persist($signalement);
                }
               

            $user = new User();
            $user->setPseudo($this->generator->unique()->city);
            $user->setEmail($this->generator->unique()->email);
            $user->setPassword("password");
            $user->addSignalement($signalement);
            $user->setPrenom($this->generator->firstName);
            $user->setNom($this->generator->lastName);
            $user->setTelephone($this->generator->phoneNumber);
            $user->setIsAdmin( $this->generator->boolean(false) );
            $user->setIsActive( $this->generator->boolean('70%? true : false') );
            $user->addAnimaux($animal);
            $manager->persist($user);   
        
            }
        }
      
        $manager->flush();
    }
}