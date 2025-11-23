<?php
// ported by meditext
namespace Roblox;

class AssetReference
{
    public const ASSET_SUBSCRIPTION = 0;
    public const ASSET_VERSION = 1;

    private int $_Id;


    private function _AssetID(): int
    {
        return $this->isAsset() ? $this->_Id : 0;
    }

    private function _AssetVersionID(): int
    {
        return $this->isAssetVersion() ? abs($this->_Id) : 0;
    }


    public function getID(): int
    {
        return $this->_Id;
    }

    public function setID(int $id): void
    {
        $this->_Id = $id;
    }

    public function isAsset(): bool
    {
        return $this->_Id > 0;
    }

    public function isAssetVersion(): bool
    {
        return $this->_Id < 0;
    }

    public function getReferredAsset(): ?IAsset
    {
        if ($this->isAssetVersion()) {
            return AssetVersion::get($this->_AssetVersionID());
        }

        if ($this->isAsset()) {
            return Asset::get($this->_AssetID());
        }

        return null;
    }

    public function __construct(int $assetReferenceId)
    {
        $this->_Id = $assetReferenceId;
    }

    public static function fromAsset(IAsset $asset, int $type): self
    {
        switch ($type) {
            case self::ASSET_SUBSCRIPTION:
                return new self($asset->getCurrentVersion()->getAssetID());

            case self::ASSET_VERSION:
                return new self(-1 * $asset->getCurrentVersion()->getID());

            default:
                throw new \Exception("Asset Reference type unknown");
        }
    }

    public static function fromAssetSubscription(int $assetId): self
    {
        return new self($assetId);
    }

    public static function fromAssetVersion(int $assetVersionId): self
    {
        return new self(-1 * $assetVersionId);
    }
}

