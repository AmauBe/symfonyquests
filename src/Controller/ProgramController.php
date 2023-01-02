<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

#[Route('/program', name: 'program_')]

class ProgramController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
           'programs' => $programs,
        ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show( Program $program): Response
    {  

        return $this->render('program/show.html.twig', [
            'program' => $program,
            
        ]);
    }

    #[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}', name: 'season_show')]
    #[Entity('program', options: ['mapping' => ['programId' => 'id']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    public function  showSeason(Program $program, Season $season):Response

    {
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }


    #Quests 11
    ##[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}', name: 'season_show')]
    ##public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    #{

       # $program = $programRepository->findOneBy(['id' => $programId]);
        #$season = $seasonRepository->findOneBy(['id' => $seasonId]);
        
        #if (!$program) {
         #   throw $this->createNotFoundException(
          #      'No program with id : ' . $program['id'] . ' found in program\'s table.'
           # );
        #}

        #if (!$season) {
         #   throw $this->createNotFoundException(
          #      'No season with id : ' . $season['id'] . ' found in program\'s table.'
           # );
        #}
        
        #return $this->render('program/season_show.html.twig', [
         #   'program' => $program,
          #  'season' => $season,
        #]);##
    #}


    #[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}/episode/{episodeId<^[0-9]+$>}', name: 'episode_show')]
    #[Entity('program', options: ['mapping' => ['programId' => 'id']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeId' => 'id']])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
    }


    ##[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}/episode/{episodeId<^[0-9]+$>}', methods: ['GET'], name: 'episode_show')]
    #public function showEpisode(int $programId, int $seasonId, int $episodeId, ProgramRepository $programRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
    #{
     //   $program = $programRepository->findOneBy(['id' => $programId]);
       // $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        //$episode = $episodeRepository->findOneBy(['id' => $episodeId]);

        //if (!$program) {
          //  throw $this->createNotFoundException(
            //    'No program with id : '.$id.' found in program\'s table.');
        //}
        //if (!$season) {
          //  throw $this->createNotFoundException(
            //    'No program with id : '.$id.' found in program\'s table.');
        //}

        //if (!$episode) {
          //  throw $this->createNotFoundException(
            //    'No program with id : '.$id.' found in program\'s table.');
        //}

        //return $this->render('program/episode_show.html.twig', [
          //  'program' => $program,
            //'season' => $season,
            //'episode' => $episode,
        //]);
    //}
        }

