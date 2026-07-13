<?php
// written by omnifla
namespace Roblox;

class UserAvatar
{
    private User $user;

    private function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function getOrCreate(User $user): self
    {
        return new self($user);
    }

    public function appearanceChanged(): void
    {
        // stub
    }

    public function getUser(): User
    {
        return $this->user;
    }
}