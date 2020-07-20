<?php

namespace App\DataFixtures;

use App\Entity\Puce;
use App\Entity\Tatouage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

class IdentificationFixtures extends Fixture
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
        $rand = rand(300, 400);
        for($i=1; $i <= $rand; $i++)
        {
            $puce = new Puce();
            $puce->setNumero($this->generator->unique()->regexify('[0-9]{15}'));
            $manager->persist($puce);
            $this->setReference(sprintf("puce"), $puce);
        
            $tatouage = new Tatouage();
            $tatouage->setNumero($this->generator->unique()->regexify('[0-9][A-Z]{3}[0-9]{3}'));
            $manager->persist($tatouage);
            $this->setReference(sprintf("tatouage"), $tatouage);
        }

        $manager->flush();
    }
}