<?php

namespace App\Manager;

use App\Entity\EmailNotification;
use Doctrine\ORM\EntityManagerInterface;

class EmailNotificationManager
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function saveEmailNotification(string $email, string $text): void {
        $emailNotification = new EmailNotification();
        $emailNotification->setEmail($email);
        $emailNotification->setText($text);
        $this->entityManager->persist($emailNotification);
        $this->entityManager->flush();
    }
}
