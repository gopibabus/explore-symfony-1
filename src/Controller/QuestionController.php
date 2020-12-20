<?php
namespace App\Controller;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
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
     * @Route("/questions/{slug}", name="app_question_show")
     * @param $slug
     * @param MarkdownParserInterface $markdownParser
     * @return Response
     */
    public function show($slug, MarkdownParserInterface $markdownParser): Response
    {
        $answers = [
            'Answer1 to the `Question`',
            'Answer2 to the `Question`',
            'Answer3 to the `Question`',
            'Answer4 to the `Question`'
        ];
        $description = 'This is a **question** description';
        $parsedDescription = $markdownParser->transformMarkdown($description);

        return $this->render('question/show.html.twig', [
            'question' => $slug,
            'answers' => $answers,
            'description' => $parsedDescription
        ]);
    }
}