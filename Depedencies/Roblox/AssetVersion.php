<?php

namespace Roblox;

class AssetVersion
{
    public int $id = 0;
    public int $AssetID = 0;
    public int $assetVersionId = 0;
    public int $versionNumber = 0;
    public int $AssetTypeID = 0;
    public ?\DateTime $createdAt = null;
    public int $createdBy = 0;
    public ?string $hash = null;
    public ?int $fileSize = null;

    public function __construct(?int $id = null)
    {
        if ($id !== null) {
            $this->id = $id;
            $this->assetVersionId = $id;
            $this->AssetID = 0;
        }
    }

    public static function Get(int $assetId, ?int $version = null, ?int $assetTypeId = null): ?self
    {
        if ($assetId <= 0) {
            return null;
        }

        $assetVersion = new self($version ?? $assetId);
        $assetVersion->AssetID = $assetId;

        if ($version !== null) {
            $assetVersion->versionNumber = $version;
        }

        if ($assetTypeId !== null) {
            $assetVersion->AssetTypeID = $assetTypeId;
        }

        return $assetVersion;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getAssetID(): int
    {
        return $this->AssetID > 0 ? $this->AssetID : $this->AssetID;
    }
}