<?php

namespace App\EventSubscriber;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleSignalEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddFollowersSignalSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleEvents::SIGNAL => 'handleSignal',
        ];
    }

    public function handleSignal(ConsoleSignalEvent $event): void
    {
        $signal = $event->getHandlingSignal();
        dump($signal, 'event signal');

        $event->setExitCode(0);
    }
}