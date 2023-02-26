<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\ProgramType;
use App\Form\SearchProgramType;
use App\Service\ProgramDuration;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;

#[Route('/program', name: 'program_')]

class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, RequestStack $requestStack, ProgramRepository $programRepository): Response
    {
        $form = $this->createForm(SearchProgramType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $programs = $programRepository->findLikeName($search);
        } else {
            $programs = $programRepository->findAll();
        }
        return $this->renderForm('program/index.html.twig', [
            'programs' => $programs,
            'form' => $form,
        ]);
    }

 // Correspond à la route /program/new et au name "program_new"
    #[Route('/new', name: 'new')]
    public function new(Request $request, MailerInterface $mailer, ProgramRepository $programRepository, SluggerInterface $slugger): Response
    {
        $program = new Program();

        // Create the form, linked with $category
        $form = $this->createForm(ProgramType::class, $program);
        
        // Get data from HTTP request
    $form->handleRequest($request);
    // Was the form submitted ?
    if ($form->isSubmitted() && $form->isValid()) {

        $slug = $slugger->slug($program->getTitle());
        $program->setSlug($slug);
        $program->setOwner($this->getUser());
        $programRepository->save($program, true);

        $email = (new Email())
        ->from($this->getParameter('mailer_from'))
        ->to('your_email@example.com')
        ->subject('Une nouvelle série vient d\'être publiée !')
        ->html($this->renderView('program/newProgramEmail.html.twig', ['program' => $program]));
$mailer->send($email);

        // Deal with the submitted data
        // For example : persiste & flush the entity
        // And redirect to a route that display the result

        $this->addFlash('success', 'The new program has been created');

        return $this->redirectToRoute('program_index');
    }
        // Render the form (best practice)
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
        // Alternative
        // return $this->render('category/new.html.twig', [
        //   'form' => $form->createView(),
        // ]);
}

#[Route('/{slug}/edit', name: 'edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Program $program, ProgramRepository $programRepository, SluggerInterface $slugger): Response
{
    if ($this->getUser() !== $program->getOwner()) {
        // If not the owner, throws a 403 Access Denied exception
        throw $this->createAccessDeniedException('Only the owner can edit the program!');
    }

    $form = $this->createForm(ProgramType::class, $program);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $slug = $slugger->slug($program->getTitle());
        $program->setSlug($slug);
        $programRepository->save($program, true);

        $this->addFlash('success', 'The program has been edited');


        return $this->redirectToRoute('app_program_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('program/edit.html.twig', [
        'program' => $program,
        'form' => $form,
    ]);
}

    #[Route('/{slug}',  name: 'show')]
    public function show( Program $program, ProgramDuration $programDuration): Response
    {  

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'programDuration' => $programDuration->calculate($program)
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


    //#[Route('/{programId<^[0-9]+$>}/season/{seasonId<^[0-9]+$>}/episode/{episodeId<^[0-9]+$>}', name: 'episode_show')]
    #[Route('/{programSlug}/season/{seasonId<^[0-9]+$>}/episode/{episodeSlug}', methods: ['GET'], name: 'episode_show')]
    #[Entity('program', options: ['mapping' => ['programSlug' => 'slug']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeSlug' => 'slug']])]
    public function showEpisode(Program $program, Season $season, Episode $episode,  Request $request): Response
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

    #[Route('/{id}/watchlist', name: 'watchlist', methods: ['GET', 'POST'])]
public function addToWatchlist(program $program, UserRepository $userRepository): Response
{
    if (!$program) {
        throw $this->createNotFoundException(
            'No program with this id found in program\'s table.'
        );
    }

    /** @var \App\Entity\User */
    $user = $this->getUser();
    if ($user->isInWatchlist($program)) {
        $user->removeFromWatchlist($program);
    } else {
        $user->addToWatchlist($program);
    }

    $userRepository->save($user, true);

    return $this->redirectToRoute('program_show', ['slug' => $program->getSlug()], Response::HTTP_SEE_OTHER);
}
        }

