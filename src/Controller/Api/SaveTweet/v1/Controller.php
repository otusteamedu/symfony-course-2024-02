<?php

namespace App\Controller\Api\SaveTweet\v1;

use App\Controller\Common\ErrorResponseTrait;
use App\Manager\TweetManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends AbstractFOSRestController
{
    use ErrorResponseTrait;

    public function __construct(private readonly TweetManager $tweetManager)
    {
    }

    #[Route(path: '/api/v1/tweet', methods: ['POST'])]
    #[RequestParam(name: 'authorId', requirements: '\d+')]
    #[RequestParam(name: 'text')]
    public function saveTweetAction(int $authorId, string $text): Response
    {
        $tweetId = $this->tweetManager->saveTweet($authorId, $text);
        [$data, $code] = ($tweetId === null) ? [['success' => false], 400] : [['tweet' => $tweetId], 200];
        return $this->handleView($this->view($data, $code));
    }
}
