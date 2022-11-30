<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new program(); 
        $program->setTitle('The Walking Dead');
        $program->setSynopsis('Des zombies envahissent le monde');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);


        $program = new program(); 
        $program->setTitle('The Sinister');
        $program->setSynopsis('Dieux paiens qui enlève les enfants');
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);


        $program = new program(); 
        $program->setTitle('Moana');
        $program->setSynopsis('Histoire aventure Hawaienne');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);

        $program = new program(); 
        $program->setTitle('Friends');
        $program->setSynopsis('Les aventures d_un groupe d_ami');
        $program->setCategory($this->getReference('category_Comedie'));
        $manager->persist($program);


        $program = new program(); 
        $program->setTitle('The Lord Of the Rings');
        $program->setSynopsis('Film fantastique primé');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);


        $program = new program(); 
        $program->setTitle('Indiana Jones and the last Crusade');
        $program->setSynopsis('Nouvelle aventure de Indiana Jones');
        $program->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [ CategoryFixtures::class,];
    }
}
