<?php
// every api class should extend from this

namespace Roblox\Web\SecureAPI;

class SecureRoot {
    // class constants rather than enums because its a php 8.1 feature only
    public const SUCCESS = 'SUCCESS';
    public const INVAILD = 'INVAILD';

    function __construct() {}

    protected function getChecksum(string $givenStr) : string {
        // TODO: do more with this function rather than this
        return hash('sha256', $givenStr, false);
    }

    // https://stackoverflow.com/a/55790
    // BIG WARNING: clients can modify these args, causing some vulns. PLEASE FILTER THE VARIABLE!!!!!!!
    // anyways we are checksumming so we should be fine with this
    protected function getIPAddress() : string {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }

        return 'UNKNOWN';
    }
}