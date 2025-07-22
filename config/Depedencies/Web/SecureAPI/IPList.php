<?php
// this is way better than apikey, the only way someone
// can access this is via a rat in the gameservers
// anyways, USE THIS INSTEAD OF API KEY FOR NEW APIS

namespace Roblox\Web\SecureAPI;

class IPList extends SecureRoot {
    private array $ipList;
    private string $failedGrabHash;

    public const NO_IPGIVEN = 'NOIPGIVEN';

    function __construct(array $ipList, bool $isHashed = false) {
        $mainIPList = $ipList;
        if (!$isHashed) {
            $mainIPList = [];
            foreach ($ipList as $unhashedIP)
                array_push($mainIPList, $this->getChecksum($unhashedIP));
        }

        $this->ipList = $mainIPList;
        $this->failedGrabHash = '23759997b3c59884dc4c0ff5320d6301b0e7f63bf0f6483a7b54d7d43bc5ccd1';
    }

    public function processRequest() : string {
        $hashedIP = $this->getChecksum($this->getIPAddress());
        if ($hashedIP == $this->failedGrabHash)
            return self::NO_IPGIVEN; // debating myself if we should use this rather than a throw thingy
        if (in_array($hashedIP, $this->ipList))
            return self::SUCCESS;

        return self::INVAILD;
    }
}