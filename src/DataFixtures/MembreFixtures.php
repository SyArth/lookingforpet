<?php
namespace App\DataFixtures;

use App\Entity\Membre;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class MembreFixtures extends Fixture implements DependentFixtureInterface
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
        $rand = rand(30, 50);           
        for($i=1; $i <= $rand; $i++){
            $membre = new Membre();
            $membre->setNom($this->generator->lastName);
            $membre->setPrenom($this->generator->firstName($gender = 'male'|'female'));
            $membre->setTelephone($this->generator->phoneNumber);               
          
            $user = $this->getReference(sprintf("user_%d", $i));
            $membre->setUser($user);
            $manager->persist($membre);
        }

        $manager->flush();
    }
     /**
     * @return array
     */
    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}