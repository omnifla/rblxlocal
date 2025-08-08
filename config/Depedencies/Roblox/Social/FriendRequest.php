<?php

namespace Roblox\Social;

class FriendRequest implements IFriendRequest
{
    private int $id;
    private int $senderId;
    private int $recipientId;
    private string $subject;
    private string $body;
    private \DateTime $sentAt;
    private ?bool $isAccepted;

    public function __construct(
        int $id = 0,
        int $senderId = 0,
        int $recipientId = 0,
        string $subject = '',
        string $body = '',
        ?\DateTime $sentAt = null,
        ?bool $isAccepted = null
    ) {
        $this->id = $id;
        $this->senderId = $senderId;
        $this->recipientId = $recipientId;
        $this->subject = $subject;
        $this->body = $body;
        $this->sentAt = $sentAt ?? new \DateTime();
        $this->isAccepted = $isAccepted;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    public function getRecipientId(): int
    {
        return $this->recipientId;
    }

    public function setRecipientId(int $recipientId): void
    {
        $this->recipientId = $recipientId;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTime $sentAt): void
    {
        $this->sentAt = $sentAt;
    }

    public function getIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(?bool $isAccepted): void
    {
        $this->isAccepted = $isAccepted;
    }
}
