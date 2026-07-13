<?php

namespace Roblox\Caching;

enum MigrationState: int
{
    case NoMigration = 0;

    case Legacy = 1;
    case Hybrid = 2;
    case Remote = 3;

    public static function tryFromName(string $name): ?self
    {
        foreach (self::cases() as $case) {
            if (strcasecmp($case->name, trim($name)) === 0) {
                return $case;
            }
        }

        return null;
    }
}