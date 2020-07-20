<?php

namespace App\DataFixtures;

use App\Entity\Famille;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class FamilleFixtures extends Fixture
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
        $famille1 = new Famille();
        $famille1->setNom('chien');          
        $manager->persist($famille1);
        $this->setReference(sprintf("famille1"), $famille1);

        $famille2 = new Famille();
        $famille2->setNom('chat');          
        $manager->persist($famille2);
        $this->setReference(sprintf("famille2"), $famille2);

     

        $manager->flush();
    }
}