<?php

namespace Roblox\Caching\Interfaces;

interface IRemoteCachabilitySettings
{
    public function getMemcachedGroupName(): string;
}
