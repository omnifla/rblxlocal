<?php

namespace Roblox\Cache;

class CacheabilitySettings
{
    public bool $collectionsAreCacheable;
    public bool $countsAreCacheable;
    public bool $entityIsCacheable;
    public bool $idLookupsAreCacheable;
    public bool $isNullCacheable = false;
    public bool $hasUnqualifiedCollections;
    public bool $idLookupsAreCaseSensitive;

    public function __construct(
        bool $collectionsAreCacheable,
        bool $countsAreCacheable,
        bool $entityIsCacheable,
        bool $idLookupsAreCacheable,
        bool $hasUnqualifiedCollections = true,
        bool $idLookupsAreCaseSensitive = false
    ) {
        $this->collectionsAreCacheable = $collectionsAreCacheable;
        $this->countsAreCacheable = $countsAreCacheable;
        $this->entityIsCacheable = $entityIsCacheable;
        $this->idLookupsAreCacheable = $idLookupsAreCacheable;
        $this->hasUnqualifiedCollections = ($collectionsAreCacheable || $countsAreCacheable) && $hasUnqualifiedCollections;
        $this->idLookupsAreCaseSensitive = $idLookupsAreCaseSensitive;
    }
}
