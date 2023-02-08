<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/program', name: 'program_')]

class ProgramController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(Request $request, ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
           'programs' => $programs,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();

        // Create the form, linked with $category
        $form = $this->createForm(ProgramType::class, $program);
        
        // Get data from HTTP request
    $form->handleRequest($request);
    // Was the form submitted ?
    if ($form->isSubmitted() && $form->isValid()) {
        $programRepository->save($program, true);
        // Deal with the submitted data
        // For example : persiste & flush the entity
        // And redirect to a route that display the result

        $this->addFlash('success', 'The new program has been created');

        return $this->redirectToRoute('program_index');
    }
        // Render the form (best practice)
        return $this->renderForm('program/new.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
        // Alternative
        // return $this->render('category/new.html.twig', [
        //   'form' => $form->createView(),
        // ]);
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

