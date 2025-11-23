<?php

namespace Roblox\Cache\Interfaces;

interface IRemoteCachabilitySettings
{
    public function getMemcachedGroupName(): string;
}
