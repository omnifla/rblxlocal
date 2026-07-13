<?php

// written by omnifla

namespace Roblox\Membership;

interface IUser
{
    public function getId(): int;

    public function getName(): string;
}