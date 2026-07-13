<?php
// written by omnifla

namespace Roblox\Social;

class Settings
{
    protected static array $settings = [
        'FriendshipSendEventEnabled' => true,
        'ShouldUseRequestContextToCheckSendFriendRequestPermission' => false,
        'IsPermissionsCheckForSendFriendRequestEnabled' => false
    ];

    public static function get(string $key): mixed
    {
        return static::$settings[$key] ?? null;
    }

    public static function set(string $key, mixed $value): void
    {
        static::$settings[$key] = $value;
    }
}