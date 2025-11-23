<?php
// utils to help with the client and assets

namespace Roblox\Game;
use IncludeHelper;

class ClientHelper {
    private static $privateKey = null;
    private static $signPrefix = null;

    private const PRIVATEKEY_PATH = '/keys/PrivateKey.pem';
    private const RBXASSET_PREFIX = '--rbxassetid%{0}%';

    public static function init() {
        self::$privateKey = IncludeHelper::getContents(self::PRIVATEKEY_PATH); // should we use openssl_pkey_get_private?
        
        // if ($properties['SignScriptsOnFetch'])
        //     self::$signPrefix = '--rbxsig%{0}%';
        self::$signPrefix = '--rbxsig%{0}%'; // TODO: make this a const
    }

    public static function signTextBlob(string $blob) : string {
        if (!self::$privateKey)
            self::init();
        if (!self::$signPrefix)
            return $blob;

        $blob = "\r\n" . $blob;
        $signBuffer = null;
        openssl_sign($blob, $signBuffer, self::$privateKey, OPENSSL_ALGO_SHA1);
        return str_replace('{0}', base64_encode($signBuffer), self::$signPrefix) . $blob;
    }

    public static function createAssetSign(string $blob, string $assetID) {
        if (!self::$privateKey)
            self::init();

        $blob = "\r\n" . $blob;
        return str_replace('{0}', $assetID, self::RBXASSET_PREFIX) . $blob;
    }
}