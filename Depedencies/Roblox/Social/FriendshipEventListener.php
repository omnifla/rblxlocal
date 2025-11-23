<?php

namespace Roblox\Social;

use Roblox\Membership\IUserFactory;
use Roblox\Social\Events\IMessageEventPublisher;
use Roblox\Social\SystemMessageSender;
use Roblox\Social\IFriendshipFactory;
use Roblox\Social\IFriendRequest;

class FriendshipEventListener
{
    public static function register(
        IFriendshipFactory $friendshipFactory,
        IUserFactory $userFactory,
        IMessageEventPublisher $messageEventPublisher,
        callable $exceptionHandler
    ): void {
        $friendshipFactory->onFriendRequestAccepted = function (
            int $friendRequestId,
            int $accepterUserId,
            ?int $senderUserId
        ) use ($friendshipFactory, $userFactory, $messageEventPublisher, $exceptionHandler) {
            self::onFriendRequestAccepted(
                $friendRequestId,
                $accepterUserId,
                $senderUserId,
                $friendshipFactory,
                $userFactory,
                $messageEventPublisher,
                $exceptionHandler
            );
        };
    }

    private static function onFriendRequestAccepted(
        int $friendRequestId,
        int $accepterUserId,
        ?int $senderUserId,
        IFriendshipFactory $friendshipFactory,
        IUserFactory $userFactory,
        IMessageEventPublisher $messageEventPublisher,
        callable $exceptionHandler
    ): void {
        try {
            $systemMessageSender = new SystemMessageSender($messageEventPublisher);

            $accepter = $userFactory->getUser($accepterUserId);
            $friendRequest = $friendshipFactory->getFriendRequest($friendRequestId, $senderUserId, $accepterUserId);
            $sender = $userFactory->getUser($friendRequest->getSenderId());

            if ($accepter && $sender) {
                $message = sprintf(
                    "<a href='/User.aspx?ID=%d'>%s</a> has accepted your friend request.",
                    $accepter->getId(),
                    htmlspecialchars($accepter->getName(), ENT_QUOTES, 'UTF-8')
                );

                $systemMessageSender->send("Friend Request: Accepted", $message, $sender);
            }
        } catch (\Throwable $ex) {
            $exceptionHandler($ex);
        }
    }
}
