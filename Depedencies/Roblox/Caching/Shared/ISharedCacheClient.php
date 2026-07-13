<?php
// written by omnifla

namespace Roblox\Caching\Shared;

interface ISharedCacheClient
{
    public function get(string $key): mixed;

    public function set(
        string $key,
        mixed $value,
        int $ttl = 0
    ): bool;

    public function delete(string $key): bool;
}