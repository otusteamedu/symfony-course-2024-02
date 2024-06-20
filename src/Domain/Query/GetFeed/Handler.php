<?php

namespace App\Domain\Query\GetFeed;

use App\Domain\Repository\FeedRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class Handler
{
    public function __construct(
        private readonly FeedRepositoryInterface $feedRepository,
    ) {
    }

    public function __invoke(GetFeedQuery $query): GetFeedQueryResult
    {
        return new GetFeedQueryResult(
            $this->feedRepository->getFeed($query->getUserId(), $query->getCount())
        );
    }
}
