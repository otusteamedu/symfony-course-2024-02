<?php

namespace App\Entity;

use DateTime;
use JMS\Serializer\Annotation as JMS;
use JsonException;

class Tweet
{
    private ?int $id = null;

    #[JMS\Groups(['elastica'])]
    private User $author;

    #[JMS\Groups(['elastica'])]
    private string $text;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(): void {
        $this->createdAt = DateTime::createFromFormat('U', (string)time());
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new DateTime();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'login' => $this->author->getLogin()->getValue(),
            'text' => $this->text,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }

    public function toFeed(): array
    {
        return [
            'id' => $this->id,
            'author' => isset($this->author) ? $this->author->getLogin()->getValue() : null,
            'text' => $this->text,
            'createdAt' => isset($this->createdAt) ? $this->createdAt->format('Y-m-d h:i:s') : '',
        ];
    }

    /**
     * @throws JsonException
     */
    public function toAMPQMessage(): string
    {
        return json_encode(['tweetId' => $this->id], JSON_THROW_ON_ERROR);
    }
}
