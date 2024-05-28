<?php

namespace App\Controller\Api\GetFeed\v1;

use App\Service\FeedService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class Controller extends AbstractFOSRestController
{
    /** @var int */
    private const DEFAULT_FEED_SIZE = 20;

    public function __construct(private readonly FeedService $feedService)
    {
    }

    #[Route(path: '/api/v1/get-feed', methods: ['GET'])]
    #[QueryParam(name: 'userId', requirements: '\d+')]
    #[QueryParam(name: 'count', requirements: '\d+', nullable: true)]
    #[OA\Get(
        operationId: 'getFeed',
        tags: ['Лента'],
        parameters: [
            new OA\Parameter(
                name: 'userId',
                description: 'ID пользователя',
                in: 'query',
                example: '135',
            ),
            new OA\Parameter(
                name: 'count',
                description: 'Количество на странице',
                in: 'query',
                example: '1',
            ),
        ]
    )]
    public function getFeedAction(int $userId, ?int $count = null): View
    {
        $count = $count ?? self::DEFAULT_FEED_SIZE;
        $tweets = $this->feedService->getFeed($userId, $count);
        $code = empty($tweets) ? 204 : 200;

        return View::create(['tweets' => $tweets], $code);
    }
}
