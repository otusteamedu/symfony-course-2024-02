<?php

namespace App\Domain\Repository;

interface FeedRepositoryInterface
{
    public function getFeed(int $userId, int $count): array;
}
