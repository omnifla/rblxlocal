<?php
namespace Roblox\Moderation;

class PunishmentType
{
    public static array $types = [
        1 => 'Warn',
        2 => 'Remind' ,
        3 => 'Ban 1 Day',
        4 => 'Ban 3 Days',
        5 => 'Ban 7 Days',
        6 => 'Ban 14 Days',
        7 => 'Delete',
        8 => 'Poison',
    ];

    public static function GetById(int $id): ?string
    {
        return self::$types[$id] ?? null;
    }

    public static function GetByName(string $name): ?int
    {
        return array_flip(self::$types)[$name] ?? null;
    }
}
