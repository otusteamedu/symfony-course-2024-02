<?php declare(strict_types=1);

namespace App\Controller\Api\CreateUser\v5\Input;

use Symfony\Component\Validator\Constraints as Assert;

class TweetDTO
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    public string $text;
}
