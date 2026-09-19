<?php

namespace Roblox;

interface IAsset
{
    public function getID(): int;

    public function getCurrentVersion(): ?AssetVersion;
}
