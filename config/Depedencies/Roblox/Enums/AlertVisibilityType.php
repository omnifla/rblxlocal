<?php
// written and ported by SkylerClock
namespace Roblox;

use Roblox\DataAccess\AlertVisibilityTypeDAL;
use Roblox\Common\EntityHelper;
use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;

class AlertVisibilityType implements \Roblox\Common\IRobloxEntity, \Roblox\Caching\ICacheableObject
{
    private AlertVisibilityTypeDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct()
    {
        $this->_EntityDAL = new AlertVisibilityTypeDAL();
    }

    public static function initCache(): void
    {
        self::$EntityCacheInfo = new CacheInfo(
            new CacheabilitySettings(true, true, true, true),
            'Roblox.AlertVisibilityType',
            true
        );
    }

    public function getID(): int
    {
        return $this->_EntityDAL->getID();
    }

    public function getValue(): string
    {
        return $this->_EntityDAL->Value;
    }

    public function setValue(string $value): void
    {
        $this->_EntityDAL->Value = $value;
    }

    public function getCreated(): \DateTime
    {
        return $this->_EntityDAL->Created;
    }

    public function setCreated(\DateTime $created): void
    {
        $this->_EntityDAL->Created = $created;
    }

    public function getUpdated(): \DateTime
    {
        return $this->_EntityDAL->Updated;
    }

    public function setUpdated(\DateTime $updated): void
    {
        $this->_EntityDAL->Updated = $updated;
    }

    public static function All(): ?AlertVisibilityType
    {
        return self::getByValue("All");
    }

    public static function AuthenticatedUsers(): ?AlertVisibilityType
    {
        return self::getByValue("AuthenticatedUsers");
    }

    public static function NonAuthenticatedUsers(): ?AlertVisibilityType
    {
        return self::getByValue("NonAuthenticatedUsers");
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    public function Save(): void
    {
        EntityHelper::SaveEntity($this, function () {
            $this->_EntityDAL->Created = new \DateTime();
            $this->_EntityDAL->Updated = $this->_EntityDAL->Created;
            $this->_EntityDAL->Insert();
        }, function () {
            $this->_EntityDAL->Updated = new \DateTime();
            $this->_EntityDAL->Update();
        });
    }

    public static function CreateNew(string $value): AlertVisibilityType
    {
        $t = new AlertVisibilityType();
        $t->setValue($value);
        $t->Save();
        return $t;
    }

    public static function Get(int $id): ?AlertVisibilityType
    {
        return EntityHelper::GetEntity(self::$EntityCacheInfo, $id, fn () => AlertVisibilityTypeDAL::Get($id));
    }

    public static function getByValue(string $value): ?AlertVisibilityType
    {
        return EntityHelper::GetEntityByLookup(
            self::$EntityCacheInfo,
            "Value:$value",
            fn () => AlertVisibilityTypeDAL::Get($value)
        );
    }

    public function Construct($dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function BuildEntityIDLookups(): array
    {
        return ["Value:" . $this->_EntityDAL->Value];
    }

    public function BuildStateTokenCollection(): array
    {
        return [];
    }
}

AlertVisibilityType::initCache();
