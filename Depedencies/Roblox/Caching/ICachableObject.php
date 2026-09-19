<?php
namespace Roblox\Caching;

use Roblox\Caching\CacheInfo;

interface ICacheableObject
{
    public function getCacheInfo(): CacheInfo;

    public function buildEntityIDLookups(): array;

    public function buildStateTokenCollection(): array;
}