<?php
namespace Roblox\Cache\Interfaces;
use Roblox\Cache\CacheabilitySettings;
interface ICacheInfo
{
    public function getCacheability(): CacheabilitySettings;
    public function getRemoteCachabilitySettings(): ?IRemoteCachabilitySettings;
    public function getMigrationCacheabilitySettings(): ?IMigrationCacheabilitySettings;
    public function getEntityType(): string;
    public function isNullCacheable(): bool;
}
