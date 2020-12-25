<?php

namespace App\Controller;

use App\Entity\Question;
use App\Service\MarkdownHelper;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @return Response
     */
    public function homepage(): Response
    {
        return $this->render('question/homepage.html.twig');
    }

    /**
     * @Route("/questions/new")
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws Exception
     */
    public function new(EntityManagerInterface $entityManager): Response
    {
        $question = new Question();
        $question->setName('Missing pants')
            ->setSlug('missing-pants-' . rand(1, 1000))
            ->setQuestion('Missing pants Question');

        if (rand(1, 10) > 2) {
            $question->setAskedAt(new DateTime(sprintf('-%d days', rand(1, 100))));
        }
        $entityManager->persist($question);
        $entityManager->flush();

        return new Response(sprintf('Well!! The question with id #%d and slug %s got saved',
            $question->getId(), $question->getSlug()));
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     * @param                $slug
     * @param MarkdownHelper $markdownHelper
     * @return Response
     */
    public function show(
        $slug,
        MarkdownHelper $markdownHelper,
        EntityManagerInterface $entityManager
    ): Response
    {
        $repository = $entityManager->getRepository(Question::class);

        /** @var Question|null $question */
        $question = $repository->findOneBy(['slug' => $slug]);

        if(!$question){
            throw $this->createNotFoundException(sprintf('no question found related to "%s"', $slug));
        }
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
}