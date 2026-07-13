<?php
// written by omnifla

namespace Roblox\Social\Events;

interface IMessageEventPublisher
{
    public function publish(
        string $subject,
        string $message,
        object $recipient
    ): bool;
}