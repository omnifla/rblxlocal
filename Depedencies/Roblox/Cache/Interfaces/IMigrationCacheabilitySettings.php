<?php

namespace Roblox\Cache\Interfaces;

use Roblox\Cache\MigrationStateChange;

interface IMigrationCacheabilitySettings
{
    public function getMigrationMemcachedGroupName(): string;

    public function getMigrationStateChange(): MigrationStateChange;
}
