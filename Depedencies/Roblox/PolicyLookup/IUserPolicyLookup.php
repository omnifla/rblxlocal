<?php

// written by omnifla

namespace Roblox\PolicyLookup;

interface IUserPolicyLookup
{
    public function getApplicablePoliciesForTargetUser(
        object $context,
        int $userId
    ): array;
}