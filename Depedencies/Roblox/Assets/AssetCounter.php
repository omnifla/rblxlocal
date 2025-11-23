<?php
// written and ported by SkylerClock
namespace Roblox\Assets;

use Roblox\Cache\CacheInfo;
use Roblox\Cache\CacheabilitySettings;
use Roblox\Cache\CacheManager;
use Roblox\Common\EntityHelper;
use Roblox\Assets\AssetCounterDAL;

class AssetCounter
{
    private AssetCounterDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?AssetCounterDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new AssetCounterDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getAssetID(): int
    {
        return $this->_EntityDAL->AssetID;
    }

    public function setAssetID(int $value): void
    {
        $this->_EntityDAL->AssetID = $value;
    }

    public function getAssetCounterTypeID(): int
    {
        return $this->_EntityDAL->AssetCounterTypeID;
    }

    public function setAssetCounterTypeID(int $value): void
    {
        $this->_EntityDAL->AssetCounterTypeID = $value;
    }

    public function getValue(): int
    {
        return $this->_EntityDAL->Value;
    }

    public function setValue(int $value): void
    {
        $this->_EntityDAL->Value = $value;
    }

    public function getCreated(): \DateTime
    {
        return $this->_EntityDAL->Created;
    }

    public function getUpdated(): \DateTime
    {
        return $this->_EntityDAL->Updated;
    }

    public function increment(int $amount = 1): void
    {
        if ($amount !== 0) {
            $this->_EntityDAL->increment($amount);
            CacheManager::processEntityChange($this, \Roblox\Common\StateChangeEventType::Modification);
        }
    }

    public function decrement(int $amount = 1): void
    {
        if ($amount !== 0) {
            $this->_EntityDAL->decrement($amount);
            CacheManager::processEntityChange($this, \Roblox\Common\StateChangeEventType::Modification);
        }
    }

    private static function doGetOrCreate(int $assetId, int $assetCounterTypeId): AssetCounter
    {
        return EntityHelper::doGetOrCreate(
            fn() => AssetCounterDAL::getOrCreate($assetId, $assetCounterTypeId)
        );
    }

    public static function getOrCreate(int $assetId, int $assetCounterTypeId): AssetCounter
    {
        return EntityHelper::getOrCreateEntityWithRemoteCache(
            self::$EntityCacheInfo,
            "AssetID:{$assetId}_AssetCounterTypeID:{$assetCounterTypeId}",
            fn() => self::doGetOrCreate($assetId, $assetCounterTypeId),
            fn($id) => self::get($id)
        );
    }

    public static function getOrCreateWithHandler(int $assetId, int $assetCounterTypeId, ?callable $onCreateHandler = null): AssetCounter
    {
        if ($onCreateHandler === null) {
            return self::getOrCreate($assetId, $assetCounterTypeId);
        }

        $created = false;

        $entity = EntityHelper::getOrCreateEntityWithRemoteCache(
            self::$EntityCacheInfo,
            "AssetID:{$assetId}_AssetCounterTypeID:{$assetCounterTypeId}",
            function () use ($assetId, $assetCounterTypeId, &$created) {
                $orCreate = AssetCounterDAL::getOrCreate($assetId, $assetCounterTypeId);
                $created = $orCreate->CreatedNewEntity;
                return $orCreate;
            },
            fn($id) => self::get($id)
        );

        if ($created) {
            $onCreateHandler($entity);
        }

        return $entity;
    }

    public static function get(int $id): ?AssetCounter
    {
        return EntityHelper::getEntity(
            self::$EntityCacheInfo,
            $id,
            fn() => AssetCounterDAL::get($id)
        );
    }

    public function construct(AssetCounterDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        $lookups = [];
        if ($this->_EntityDAL) {
            $lookups[] = "AssetID:{$this->getAssetID()}_AssetCounterTypeID:{$this->getAssetCounterTypeID()}";
        }
        return $lookups;
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }

    public function getSerializable(): object
    {
        return $this->_EntityDAL;
    }

    public static function __init(): void
    {
        self::$EntityCacheInfo = new CacheInfo(
            new CacheabilitySettings(false, false, true, true),
            "AssetCounter",
            true
        );
    }
}

AssetCounter::__init();