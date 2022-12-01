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
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);


        $program1 = new program(); 
        $program1->setTitle('Warrior Nun');
        $program1->setSynopsis("Histoire d'un groupe de religieuse guerrière");
        $program1->setCategory($this->getReference('category_Action'));
        $manager->persist($program1);


        $program2 = new program(); 
        $program2->setTitle('Simpsons');
        $program2->setSynopsis('Aventure de la famille simpsons');
        $program2->setCategory($this->getReference('category_Animation'));
        $manager->persist($program2);

        $program3 = new program(); 
        $program3->setTitle('The witcher');
        $program3->setSynopsis('Série reprenant le célébre jeux vidéo');
        $program3->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program3);


        $program4 = new program(); 
        $program4->setTitle('Le seigneur des Anneaux');
        $program4->setSynopsis("Nouvelle histoire basé sur l'oeuvre de Tolkien mais en série cette fois-ci");
        $program4->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program4);

        $program5 = new program(); 
        $program5->setTitle('Friends');
        $program5->setSynopsis("Aventure d'un groupe d'ami");
        $program5->setCategory($this->getReference('category_Comedie'));
        $manager->persist($program5);

        $program7 = new program(); 
        $program7->setTitle('Avenger');
        $program7->setSynopsis('Aventure groupe heros');
        $program7->setCategory($this->getReference('category_Sf'));
        $manager->persist($program7);

        $program8 = new program(); 
        $program8->setTitle('MacGyver');
        $program8->setSynopsis("Aventure d'un homme se sortant des situations les plus difficiles grâce à son génie");
        $program8->setCategory($this->getReference('category_Action'));
        $manager->persist($program8);

        $program9 = new program(); 
        $program9->setTitle('The 100');
        $program9->setSynopsis("Un groupe d'adolescent se retrouve sur une nouvelle terre");
        $program9->setCategory($this->getReference('category_Action'));
        $manager->persist($program9);

        $program10 = new program(); 
        $program10->setTitle('The terror');
        $program10->setSynopsis('Histoire de Sir John Franklin menant une expédition à la découverte du Passage du Nord-Ouest');
        $program10->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program10);

        $program11 = new program(); 
        $program11->setTitle('American Horror Story');
        $program11->setSynopsis("Différentes histoire à travers les saisons");
        $program11->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program11);

        $program12 = new program(); 
        $program12->setTitle('Fear the Walking Dead');
        $program12->setSynopsis('Basé sur the walking dead mais sur la cote ouest');
        $program12->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program12);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [ CategoryFixtures::class,];
    }
}
