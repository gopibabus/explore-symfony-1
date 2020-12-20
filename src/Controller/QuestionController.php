<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function homepage(): Response
    {
        return new Response('Question Page');
    }

    /**
     * @Route("/questions/{slug}")
     * @return Response
     */
    public function show($slug): Response
    {
        return $this->render('question/show.html.twig', [
            'question' => $slug
        ]);
    }
}