<?php

namespace App\Controller;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @param QuestionRepository $questionRepository
     * @return Response
     */
    public function homepage(QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findAllByAskedOrderedByNewest();

        return $this->render('question/homepage.html.twig', [
            'questions' => $questions
        ]);
    }

    /**
     * @Route("/questions/new")
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
}