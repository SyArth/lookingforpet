<?php
namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Famille;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class UserFixtures extends Fixture 
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

        for ($i = 1; $i <= 100; $i++) {
            $user = new User();
            $user->setPseudo($this->generator->userName);
            $user->setEmail($this->generator->email);
            $user->setPassword("password");

            $manager->persist($user);
            $this->setReference(sprintf("user_%d", $i), $user);
            $users[] = $user;
        }

        foreach($users as $user){
            
        }

   
        

        $manager->flush();
        

    }
     
}