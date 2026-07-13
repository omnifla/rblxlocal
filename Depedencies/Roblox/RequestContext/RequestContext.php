<?php

namespace Roblox\RequestContext;

class RequestContext
{
    public function __construct(
        public bool $isApp,
        public bool $isSameGame,
        public ?int $userId,
        public ?int $placeId,
        public string $ipAddress,
        public array $headers,
        private array $applicablePolicies = []
    ) {
    }

    public function getApplicablePolicies(): array
    {
        return $this->applicablePolicies;
    }

    public function setApplicablePolicies(array $policies): void
    {
        $this->applicablePolicies = $policies;
    }
}