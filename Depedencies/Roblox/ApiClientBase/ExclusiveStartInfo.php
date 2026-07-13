<?php
// written by omnifla

namespace Roblox\ApiClientBase;

class ExclusiveStartInfo
{
    protected mixed $exclusiveStartKey;
    protected int $count;

    public function __construct(
        mixed $exclusiveStartKey = null,
        int $count = 0
    ) {
        $this->exclusiveStartKey = $exclusiveStartKey;
        $this->count = $count;
    }

    public function getExclusiveStartKey(): mixed
    {
        return $this->exclusiveStartKey;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}