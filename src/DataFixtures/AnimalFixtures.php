<?php
namespace App\DataFixtures;


use App\Entity\User;
use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
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
        for($i=1; $i <= 100; $i++){
            $animal = new Animal();
            $animal->setNom($this->generator->word );
            $animal->setCommentaire($this->generator->sentence($nbWords = 6, $variableNbWords = true));
      
            $user = $this->getReference(sprintf("user_%d", $i));
            $animal->setUser($user);
            $manager->persist($animal);
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