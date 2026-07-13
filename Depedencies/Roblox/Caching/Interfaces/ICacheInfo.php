<?php
namespace Roblox\Caching\Interfaces;
use Roblox\Caching\CacheabilitySettings;
interface ICacheInfo
{
    public function getCacheability(): CacheabilitySettings;
    public function getRemoteCachabilitySettings(): ?IRemoteCachabilitySettings;
    public function getMigrationCacheabilitySettings(): ?IMigrationCacheabilitySettings;
    public function getEntityType(): string;
    public function isNullCacheable(): bool;
}
