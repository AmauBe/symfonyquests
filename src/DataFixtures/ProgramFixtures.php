<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

        const PROGRAMS = [
            ['Title'=> 'The Walking Dead', 'Synopsis' => 'Des zombies envahissent le monde', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2010', 'Category' => 'Horreur'],
            ['Title'=> 'Warrior Nun', 'Synopsis' => "Histoire d'un groupe de religieuse guerrière", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2020','Category' => 'Action'],
            ['Title'=> 'Simpsons', 'Synopsis' => 'Aventure de la famille simpsons', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '1989', 'Category' => 'Animation'],
            ['Title'=> 'The witcher', 'Synopsis' => 'Série reprenant le célébre jeux vidéo', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2019', 'Category' => 'Fantastique'],
            ['Title'=> 'Le seigneur des Anneaux', 'Synopsis' => "Nouvelle histoire basé sur l'oeuvre de Tolkien mais en série cette fois-ci", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2022', 'Category' => 'Aventure'],
            ['Title'=> 'Friends', 'Synopsis' => "Aventure d'un groupe d'ami", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '1994', 'Category' => 'Comedie'],
            ['Title'=> 'The Mandalorian', 'Synopsis' => "Aventure d'un personnage faisant partie de la communauté des Mandalorian, univers Star Wars", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2019', 'Category' => 'Sf'],
            ['Title'=> 'MacGyver', 'Synopsis' => "Aventure d'un homme se sortant des situations les plus difficiles grâce à son génie", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '1985', 'Category' => 'Action'],
            ['Title'=> 'The 100', 'Synopsis' => "Un groupe d'adolescent se retrouve sur une nouvelle terre", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2010', 'Category' => 'Action'],
            ['Title'=> 'Supernatural', 'Synopsis' => 'Histoire de deux frères qui chassent les monstres les plus horribles de la planétes', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2005', 'Category' => 'Horreur'],
            ['Title'=> 'fear the walking dead', 'Synopsis' => "Basé sur the walking dead mais sur la cote ouest", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2010', 'Category' => 'Horreur']
            ];

            public function load(ObjectManager $manager): void
            {
                foreach (self::PROGRAMS as $key => $tvshow ){
                $program = new program();
                $program->setTitle($tvshow['Title']);
                $program->setSynopsis($tvshow['Synopsis']);
                $program->setPoster($tvshow['Poster']);
                $program->setCountry($tvshow['Country']);
                $program->setYear($tvshow['Year']);
                $program->setCategory($this->getReference('category_' . $tvshow['Category']));
                $manager->persist($program);
                $this->addReference('program_' . $key, $program);
            }
        $manager->flush();
    }

    public function getDependencies()
    {
                // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [ CategoryFixtures::class,];
    }
}
