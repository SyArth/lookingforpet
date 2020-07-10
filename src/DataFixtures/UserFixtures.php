<?php
namespace App\DataFixtures;

use App\Entity\User;
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

        for ($i = 1; $i <= 100; $i++) {
            $user = new User();
            $user->setPseudo($this->generator->userName);
            $user->setEmail($this->generator->email);
            $user->setPassword("password");

            
            
            $manager->persist($user);
            $this->setReference(sprintf("user_%d", $i), $user);
        }

        $manager->flush();
        

    }
     
}