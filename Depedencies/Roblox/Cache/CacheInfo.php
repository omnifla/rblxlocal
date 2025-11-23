<?php

namespace Roblox\Cache;

use Roblox\Cache\Interfaces\ICacheInfo;
use Roblox\Cache\Interfaces\IRemoteCachabilitySettings;
use Roblox\Cache\Interfaces\IMigrationCacheabilitySettings;

class CacheInfo implements ICacheInfo
{
    private static CacheabilitySettings $defaultCacheabilitySettings;

    public CacheabilitySettings $cacheability;
    public ?IRemoteCachabilitySettings $remoteCachabilitySettings;
    public ?IMigrationCacheabilitySettings $migrationCacheabilitySettings;
    public string $entityType;

    public static function initDefaults()
    {
        self::$defaultCacheabilitySettings = new CacheabilitySettings(
            collectionsAreCacheable: true,
            countsAreCacheable: true,
            entityIsCacheable: true,
            idLookupsAreCacheable: true
        );
    }

    public function __construct(
        CacheabilitySettings $cacheability,
        string $entityType,
        bool $isNullCacheable = false,
        string $replicationPort = null,
        ?IRemoteCachabilitySettings $remoteCachabilitySettings = null,
        ?IMigrationCacheabilitySettings $migrationCacheabilitySettings = null
    ) {
        $cacheability->isNullCacheable = $isNullCacheable;

        $this->cacheability = $cacheability;
        $this->entityType = $entityType;
        $this->remoteCachabilitySettings = $remoteCachabilitySettings;
        $this->migrationCacheabilitySettings = $migrationCacheabilitySettings;

        EntityCacheInvalidator::addReplicationPort($entityType);
    }

    public static function fromEntityType(string $entityType): self
    {
        return new self(self::$defaultCacheabilitySettings, $entityType, false);
    }

    public static function fromType(CacheabilitySettings $cacheability, string $entityType): self
    {
        return new self($cacheability, $entityType, false);
    }

    public function isNullCacheable(): bool
    {
        return $this->cacheability->isNullCacheable;
    }
}
