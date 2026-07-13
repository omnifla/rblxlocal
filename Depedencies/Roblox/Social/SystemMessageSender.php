<?php
// written by omnifla

namespace Roblox\Social;

use Roblox\Social\Events\IMessageEventPublisher;

class SystemMessageSender
{
    protected IMessageEventPublisher $publisher;

    public function __construct(IMessageEventPublisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function send(
        string $subject,
        string $message,
        object $recipient
    ): bool {
        return $this->publisher->publish(
            $subject,
            $message,
            $recipient
        );
    }
}