<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\DataAccess\GroupCounterDAL;

class GroupCounter
{
    private GroupCounterDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupCounterDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupCounterDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->id;
    }

    public function getGroupID(): int
    {
        return $this->_EntityDAL->groupId;
    }

    public function setGroupID(int $value): void
    {
        $this->_EntityDAL->groupId = $value;
    }

    public function getGroupCounterTypeID(): int
    {
        return $this->_EntityDAL->groupCounterTypeId;
    }

    public function setGroupCounterTypeID(int $value): void
    {
        $this->_EntityDAL->groupCounterTypeId = $value;
    }

    public function getValue(): int
    {
        return $this->_EntityDAL->value;
    }

    public function setValue(int $value): void
    {
        $this->_EntityDAL->value = $value;
    }

    public function getCreated(): string
    {
        return $this->_EntityDAL->created;
    }

    public function getUpdated(): string
    {
        return $this->_EntityDAL->updated;
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    public function increment(int $amount = 1): void
    {
        if ($amount !== 0) {
            $this->_EntityDAL->increment($amount);
        }
    }

    public function tryDecrement(int $amount = 1): void
    {
        if ($amount !== 0) {
            $this->_EntityDAL->tryDecrement($amount);
        }
    }

    public function save(): void
    {
        if ($this->getID() === 0) {
            $this->_EntityDAL->created = date('Y-m-d H:i:s');
            $this->_EntityDAL->updated = $this->_EntityDAL->created;
            $this->_EntityDAL->insert();
        } else {
            $this->_EntityDAL->updated = date('Y-m-d H:i:s');
            $this->_EntityDAL->update();
        }
    }

    public static function getOrCreate(int $groupId, int $groupCounterTypeId): self
    {
        return new self(GroupCounterDAL::getOrCreate($groupId, $groupCounterTypeId));
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }

        $dal = GroupCounterDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public function construct(GroupCounterDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return ["GroupID:{$this->getGroupID()}_GroupCounterTypeID:{$this->getGroupCounterTypeID()}"];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }

    public function getSerializable(): GroupCounterDAL
    {
        return $this->_EntityDAL;
    }
}

GroupCounter::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: false,
        countsAreCacheable: false,
        entityIsCacheable: true,
        idLookupsAreCacheable: true
    ),
    'GroupCounter',
    isNullCacheable: true
);
