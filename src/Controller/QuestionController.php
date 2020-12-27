<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/", name="app_homepage")
     * @param QuestionRepository  $questionRepository
     * @param string              $isMac
     * @param HttpKernelInterface $httpKernel
     * @return Response
     * @throws Exception
     */
    public function homepage(
        QuestionRepository $questionRepository,
        string $isMac,
        HttpKernelInterface $httpKernel
    ): Response
    {
        $questions = $questionRepository->findAllByAskedOrderedByNewest();
        $this->logger->info("Called Inside Controller");

        //Manual SubRequest
        $request = new Request();
        $request->attributes->set('_controller', 'App\\Controller\\QuestionController::subRequestFooter');
        $request->server->set('REMOTE_ADDR', '127.0.0.1');
        $response = $httpKernel->handle($request, HttpKernelInterface::SUB_REQUEST);


        return $this->render('question/homepage.html.twig', [
            'questions' => $questions,
            'isMac' => $isMac,
            'subRequestBody' => $response->getContent()
        ]);
    }

    /**
     * @Route("/questions/new", )
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws Exception
     */
    public function new(EntityManagerInterface $entityManager): Response
    {
        return $this->render('question/new.html.twig', [
            'question' => null
        ]);
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     * @param Question $question
     * @return Response
     */
    public function show(Question $question): Response
    {
        $answers = [
            'Answer1 to the `Question`',
            'Answer2 to the `Question`',
            'Answer3 to the `Question`',
            'Answer4 to the `Question`'
        ];

        return $this->render('question/show.html.twig', [
            'question' => $question,
            'answers' => $answers
        ]);
    }

    /**
     * @Route("/questions/{slug}/vote", name="app_question_post", methods="POST")
     * @param Question               $question
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse
     */
    public function questionVote(
        Question $question,
        Request $request,
        EntityManagerInterface $entityManager)
    {
        $direction = $request->request->get('direction');

        if ($direction === 'up') {
            $question->upVote();
        } else {
            $question->downVote();
        }
        $entityManager->flush();

        return $this->redirectToRoute('app_question_show', [
            'slug' => $question->getSlug()
        ]);
    }

    /**
     * @return Response
     */
    public function subRequestFooter(): Response
    {
        return $this->render('question/sub.html.twig', [
            'data' => 'This is a SubRequest demo from Question Controller'
        ]);
    }
}