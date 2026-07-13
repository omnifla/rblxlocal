<?php

namespace Roblox\Caching\Interfaces;

use Roblox\Caching\MigrationStateChange;

interface IMigrationCacheabilitySettings
{
    public function getMigrationMemcachedGroupName(): string;

    public function getMigrationStateChange(): MigrationStateChange;
}
