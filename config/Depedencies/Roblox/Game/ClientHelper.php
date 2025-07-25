<?php
// utils to help with the client and assets

namespace Roblox\Game;
use IncludeHelper;

class ClientHelper {
    private static $privateKey = null;
    private static $signPrefix = null;

    private const PRIVATEKEY_PATH = '/keys/PrivateKey.pem';

    public static function init() {
        self::$privateKey = IncludeHelper::getContents(self::PRIVATEKEY_PATH); // should we use openssl_pkey_get_private?
        
        // if ($properties['SignScriptsOnFetch'])
        //     self::$signPrefix = '--rbxsig%{0}%';
        self::$signPrefix = '--rbxsig%{0}%';
    }

    public static function signTextBlob(string $blob) : string {
        if (!self::$privateKey)
            self::init();
        if (!self::$signPrefix)
            return $blob;

        $blob = "\r\n" . $blob;
        $signBuffer = null;
        \openssl_sign($blob, $signBuffer, self::$privateKey, OPENSSL_ALGO_SHA1);
        return str_replace('{0}', base64_encode($signBuffer), self::$signPrefix) . $blob;
    }
}