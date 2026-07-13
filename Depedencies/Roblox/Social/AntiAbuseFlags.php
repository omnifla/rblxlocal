<?php

// written by omnifla

namespace Roblox\Social;

use Roblox\Social\Exceptions\FriendshipOperationErrorType;

class AntiAbuseFlags
{
    public function __construct(
        protected bool $recipientInSameGame = false,
        protected bool $userInApp = false,
        protected bool $captchaPassed = true
    ) {}

    public function checkIfSendFriendRequestIsAllowed(): ?FriendshipOperationErrorType
    {
        if (!$this->recipientInSameGame) {
            return FriendshipOperationErrorType::UsersAreNotInSameGame;
        }

        if (!$this->captchaPassed) {
            return FriendshipOperationErrorType::UserHasNotPassedCaptcha;
        }

        return null;
    }

    public function isRecipientInSameGameAsUser(): bool
    {
        return $this->recipientInSameGame;
    }

    public function isUserInApp(): bool
    {
        return $this->userInApp;
    }
}