<?php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{id}/vote/{direction<up|down>}", methods="POST", name="comment_vote_update")
     * @param int $id
     * @param string $direction
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function commentVote(int $id, string $direction, LoggerInterface $logger)
    {
        if($direction === 'up'){
            $logger->info("Voting Up");
            $currentVoteCount = rand(7, 100);
        } else {
            $logger->info("Voting Down");
            $currentVoteCount = rand(0, 5);
        }

        return $this->json(['votes' => $currentVoteCount]);
    }
}