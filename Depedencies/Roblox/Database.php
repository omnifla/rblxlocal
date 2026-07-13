<?php

namespace Roblox;

use PDO;

class Database
{
    private static ?PDO $roblox = null;
    private static ?PDO $robloxGroups = null;
    private static ?PDO $groupCounters = null;

    private static function connect(): PDO
    {
        global $conn;

        if (!$conn instanceof PDO) {
            throw new \RuntimeException("Global database connection \$conn is invalid.");
        }

        return $conn;
    }

    public static function get(): PDO
    {
        return self::getRoblox();
    }

    public static function getRoblox(): PDO
    {
        if (self::$roblox === null) {
            self::$roblox = self::connect();
        }

        return self::$roblox;
    }

    public static function getRobloxGroups(): PDO
    {
        if (self::$robloxGroups === null) {
            self::$robloxGroups = self::connect();
        }

        return self::$robloxGroups;
    }

    public static function getGroupCountersPDO(): PDO
    {
        if (self::$groupCounters === null) {
            self::$groupCounters = self::connect();
        }

        return self::$groupCounters;
    }

    public static function getConnection(): PDO
    {
        return self::getRoblox();
    }
}