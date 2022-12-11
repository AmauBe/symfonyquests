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
        $program1 = new program(); 
        $program1->setTitle('The Walking Dead');
        $program1->setSynopsis('Des zombies envahissent le monde');
        $program1->setCategory($this->getReference('category_Horreur'));
        $program1->setYear('2010');
        $program1->setCountry('Etats-Unis');
        $manager->persist($program1);


        $program2 = new program(); 
        $program2->setTitle('Warrior Nun');
        $program2->setSynopsis("Histoire d'un groupe de religieuse guerrière");
        $program2->setCategory($this->getReference('category_Action'));
        $program2->setYear('2020');
        $program2->setCountry('Etats-Unis');
        $manager->persist($program2);


        $program3 = new program(); 
        $program3->setTitle('Simpsons');
        $program3->setSynopsis('Aventure de la famille simpsons');
        $program3->setCategory($this->getReference('category_Animation'));
        $program3->setYear('1989');
        $program3->setCountry('Etats-Unis');
        $manager->persist($program3);

        $program4 = new program(); 
        $program4->setTitle('The witcher');
        $program4->setSynopsis('Série reprenant le célébre jeux vidéo');
        $program4->setCategory($this->getReference('category_Fantastique'));
        $program4->setYear('2019');
        $program4->setCountry('Etats-Unis');
        $manager->persist($program4);


        $program5 = new program(); 
        $program5->setTitle('Le seigneur des Anneaux');
        $program5->setSynopsis("Nouvelle histoire basé sur l'oeuvre de Tolkien mais en série cette fois-ci");
        $program5->setCategory($this->getReference('category_Aventure'));
        $program5->setYear('2022');
        $program5->setCountry('Etats-Unis');
        $manager->persist($program5);

        $program6 = new program(); 
        $program6->setTitle('Friends');
        $program6->setSynopsis("Aventure d'un groupe d'ami");
        $program6->setCategory($this->getReference('category_Comedie'));
        $program6->setYear('1994');
        $program6->setCountry('Etats-Unis');
        $manager->persist($program6);

        $program7 = new program(); 
        $program7->setTitle('The Mandalorian');
        $program7->setSynopsis("Aventure d'un personnage faisant partie de la communauté des Mandalorian, univers Star Wars ");
        $program7->setCategory($this->getReference('category_Sf'));
        $program7->setYear('2019');
        $program7->setCountry('Etats-Unis');
        $manager->persist($program7);

        $program8 = new program(); 
        $program8->setTitle('MacGyver');
        $program8->setSynopsis("Aventure d'un homme se sortant des situations les plus difficiles grâce à son génie");
        $program8->setCategory($this->getReference('category_Action'));
        $program8->setYear('1985');
        $program8->setCountry('Etats-Unis');
        $manager->persist($program8);

        $program9 = new program(); 
        $program9->setTitle('The 100');
        $program9->setSynopsis("Un groupe d'adolescent se retrouve sur une nouvelle terre");
        $program9->setCategory($this->getReference('category_Action'));
        $program9->setYear('2010');
        $program9->setCountry('Etats-Unis');
        $manager->persist($program9);

        $program10 = new program(); 
        $program10->setTitle('The terror');
        $program10->setSynopsis('Histoire de Sir John Franklin menant une expédition à la découverte du Passage du Nord-Ouest');
        $program10->setCategory($this->getReference('category_Horreur'));
        $program10->setYear('2010');
        $program10->setCountry('Etats-Unis');
        $manager->persist($program10);

        $program11 = new program(); 
        $program11->setTitle('Supernatural');
        $program11->setSynopsis("Histoire de deux frères qui chassent les monstres les plus horribles de la planétes");
        $program11->setCategory($this->getReference('category_Horreur'));
        $program11->setYear('2015');
        $program11->setCountry('Etats-Unis');
        $manager->persist($program11);

        $program12 = new program(); 
        $program12->setTitle('Fear the Walking Dead');
        $program12->setSynopsis('Basé sur the walking dead mais sur la cote ouest');
        $program12->setCategory($this->getReference('category_Horreur'));
        $program12->setYear('2010');
        $program12->setCountry('Etats-Unis');
        $manager->persist($program12);
        $this->addReference('program_' . $key, $program);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [ CategoryFixtures::class,];
    }
}
