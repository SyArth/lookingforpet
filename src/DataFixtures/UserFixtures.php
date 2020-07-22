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
        $userAlpha = new User();
            $userAlpha->setPseudo('Alpha');
            $userAlpha->setEmail('alpha@domaine.fr');
            $userAlpha->setPassword("password");
            $userAlpha->setPrenom('Al');
            $userAlpha->setNom('Phabet');
            $userAlpha->setTelephone('0601020304');
            $userAlpha->setIsAdmin(false);
            $userAlpha->setIsActive(true);
            $manager->persist($userAlpha);   

        $userAdmin = new User();
        $userAdmin->setPseudo('Admin');
        $userAdmin->setEmail('admin@domaine.fr');
        $userAdmin->setPassword("password");
        $userAdmin->setPrenom('Pénélope');
        $userAdmin->setNom('Solette');
        $userAdmin->setTelephone('0601020304');
        $userAdmin->setIsAdmin(true);
        $userAdmin->setIsActive(true);
        $manager->persist($userAdmin);   

      
        
        $manager->flush();
    }
}