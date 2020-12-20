<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
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
        return new Response(sprintf('Show Question: %s', $slug));
    }
}