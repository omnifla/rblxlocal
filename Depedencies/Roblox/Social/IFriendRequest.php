<?php

namespace Roblox\Social;

interface IFriendRequest
{
    public function getId(): int;
    public function getSenderId(): int;
    public function getRecipientId(): int;
    public function getSubject(): string;
    public function getBody(): string;
    public function getSentAt(): \DateTime;
    public function isAccepted(): ?bool;
}
