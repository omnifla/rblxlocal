<?php
// this version just uses api keys
// only use this for legacy roblox apis (like clientsettings)

namespace Roblox\Web\SecureAPI;

class APIKey extends SecureRoot {
    private $defaultAPIKey;
    private $apiKey;
    private $hashKey;

    function __construct(?string $key = null) {
        $this->defaultAPIKey = 'defaultApiKey';
        if (!$key)
            $key = $this->defaultAPIKey;

        $this->apiKey = htmlspecialchars($key);
        $this->hashKey = $this->getChecksum($this->apiKey); // don't waste memory
    }

    public function processRequest() : string {
        if (!isset($_GET['apiKey']))
            throw new \InvalidArgumentException('apiKey does not exist in the given request, not good.');

        $givenKey = htmlspecialchars((string)$_GET['apiKey']); // we're only putting this through a checksum, is it really important to keep it here?
        $newKey = $this->getChecksum($givenKey);
        if ($newKey == $this->hashKey)
            return self::SUCCESS;

        return self::INVAILD;
    }
}