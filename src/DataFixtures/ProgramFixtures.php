<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

        const PROGRAMS = [
            ['Title'=> 'The Walking Dead', 'Synopsis' => 'Des zombies envahissent le monde', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2010', 'Category' => 'Horreur', 'owner' => 'contributor@monsite.com'],
            ['Title'=> 'Warrior Nun', 'Synopsis' => "Histoire d'un groupe de religieuse guerrière", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2020','Category' => 'Action', 'owner' => 'admin@monsite.com'],
            ['Title'=> 'Simpsons', 'Synopsis' => 'Aventure de la famille simpsons', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '1989', 'Category' => 'Animation', 'owner' => 'contributor@monsite.com'],
            ['Title'=> 'The witcher', 'Synopsis' => 'Série reprenant le célébre jeux vidéo', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2019', 'Category' => 'Fantastique', 'owner' => 'admin@monsite.com'],
            ['Title'=> 'Le seigneur des Anneaux', 'Synopsis' => "Nouvelle histoire basé sur l'oeuvre de Tolkien mais en série cette fois-ci", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2022', 'Category' => 'Aventure', 'owner' => 'contributor@monsite.com'],
            ['Title'=> 'Friends', 'Synopsis' => "Aventure d'un groupe d'ami", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '1994', 'Category' => 'Comedie', 'owner' => 'contributor@monsite.com'],
            ['Title'=> 'The Mandalorian', 'Synopsis' => "Aventure d'un personnage faisant partie de la communauté des Mandalorian, univers Star Wars", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2019', 'Category' => 'Sf', 'owner' => 'admin@monsite.com'],
            ['Title'=> 'MacGyver', 'Synopsis' => "Aventure d'un homme se sortant des situations les plus difficiles grâce à son génie", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '1985', 'Category' => 'Action', 'owner' => 'admin@monsite.com'],
            ['Title'=> 'The 100', 'Synopsis' => "Un groupe d'adolescent se retrouve sur une nouvelle terre", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2010', 'Category' => 'Action', 'owner' => 'admin@monsite.com'],
            ['Title'=> 'Supernatural', 'Synopsis' => 'Histoire de deux frères qui chassent les monstres les plus horribles de la planétes', 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2005', 'Category' => 'Horreur', 'owner' => 'admin@monsite.com'],
            ['Title'=> 'fear the walking dead', 'Synopsis' => "Basé sur the walking dead mais sur la cote ouest", 'Poster' => '', 'Country' => 'Etats-Unis', 'Year' => '2010', 'Category' => 'Horreur', 'owner' => 'admin@monsite.com']
            ];

            public function load(ObjectManager $manager): void
            {
                foreach (self::PROGRAMS as $key => $tvshow ){
                $program = new program();
                $program->setTitle($tvshow['Title']);
                $slug = $this->slugger->slug($program->getTitle());
                $program->setSlug($slug);
                $program->setSynopsis($tvshow['Synopsis']);
                $program->setPoster($tvshow['Poster']);
                $program->setCountry($tvshow['Country']);
                $program->setYear($tvshow['Year']);
                $program->setCategory($this->getReference('category_' . $tvshow['Category']));
                $program->setOwner($this->getReference($tvshow['owner']));
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
