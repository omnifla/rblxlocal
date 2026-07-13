<?php

namespace Roblox\Cache;

class EntityCacheInvalidator
{
    private static array $replicationPorts = [];

    public static function addReplicationPort(string $entityType): void
    {
        if (!in_array($entityType, self::$replicationPorts, true)) {
            self::$replicationPorts[] = $entityType;
        }
    }

    public static function getReplicationPorts(): array
    {
        return self::$replicationPorts;
    }

    public static function invalidate(
        string $entityType,
        int|string|null $entityId = null
    ): void {
    }
}