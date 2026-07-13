<?php
// utils to help with the client and assets

namespace Roblox\Game;
use IncludeHelper;

class ClientHelper
{
    private static $privateKey = null;
    private static $signPrefix = null;

    private const PRIVATEKEY_PATH = DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'keys' . DIRECTORY_SEPARATOR . 'PrivateKey.pem';
    private const RBXASSET_PREFIX = '--rbxassetid%{0}%';
    private const RBXSIG_PREFIX = '--rbxsig%{0}%';

    public static function init()
    {
        // Build an absolute path based on the current directory to avoid Windows drive confusion
        // Adjust the __DIR__ nesting if your keys folder is located up a level (e.g., __DIR__ . '/../../')
        $fullPath = dirname(__DIR__, 3) . self::PRIVATEKEY_PATH;

        // Bypass IncludeHelper completely to isolate the issue
        if (file_exists($fullPath)) {
            $rawKeyData = file_get_contents($fullPath);
        } else {
            trigger_error("Native PHP says file does not exist at: " . $fullPath, E_USER_ERROR);
            return;
        }

        if (!$rawKeyData) {
            trigger_error("ClientHelper: Private key file could not be read at path: " . $fullPath, E_USER_ERROR);
            return;
        }

        // Explicitly parse the key string into an OpenSSL resource/object
        self::$privateKey = openssl_pkey_get_private($rawKeyData);

        if (!self::$privateKey) {
            trigger_error("ClientHelper: OpenSSL failed to parse the private key. Check its formatting.", E_USER_ERROR);
            return;
        }

        self::$signPrefix = self::RBXSIG_PREFIX;
    }

    public static function signTextBlob(string $blob): string
    {
        if (!self::$privateKey)
            self::init();
        if (!self::$signPrefix)
            return $blob;

        $blob = "\r\n" . $blob;
        $signBuffer = null;
        openssl_sign($blob, $signBuffer, self::$privateKey, OPENSSL_ALGO_SHA1);
        return str_replace('{0}', base64_encode($signBuffer), self::$signPrefix) . $blob;
    }

    public static function createAssetSign(string $blob, string $assetID)
    {
        if (!self::$privateKey)
            self::init();

        $blob = "\r\n" . $blob;
        return str_replace('{0}', $assetID, self::RBXASSET_PREFIX) . $blob;
    }
}