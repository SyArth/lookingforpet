<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class UserFixtures extends Fixture
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
        $rand = rand(200, 300);
        for($i=1; $i <= $rand; $i++){
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

            $this->setReference(sprintf("user"), $user);
        }
        $users = [$user];
        $manager->flush();
    }
}