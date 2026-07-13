<?php
namespace Roblox;

use Roblox\DataAccess\GroupCounterDAL;
use Roblox\Caching\CacheManager;
use Roblox\Enums\StateChangeEventType;

class GroupCounter implements \ICacheableObject, \ICacheableObjectByID
{
    private GroupCounterDAL $entityDAL;
    public static CacheInfo $EntityCacheInfo;

    public function __construct()
    {
        $this->entityDAL = new GroupCounterDAL();
        self::$EntityCacheInfo ??= new CacheInfo(new CacheabilitySettings(
            collectionsAreCacheable: false,
            countsAreCacheable: false,
            entityIsCacheable: true,
            idLookupsAreCacheable: true
        ), "GroupCounter", true);
    }

    public static function fromDAL(GroupCounterDAL $dal): self
    {
        $self = new self();
        $self->entityDAL = $dal;
        return $self;
    }

    public function getID(): int
    {
        return $this->entityDAL->ID;
    }

    public function getGroupID(): int
    {
        return $this->entityDAL->GroupID;
    }

    public function setGroupID(int $groupId): void
    {
        $this->entityDAL->GroupID = $groupId;
    }

    public function getGroupCounterTypeID(): int
    {
        return $this->entityDAL->GroupCounterTypeID;
    }

    public function setGroupCounterTypeID(int $typeId): void
    {
        $this->entityDAL->GroupCounterTypeID = $typeId;
    }

    public function getValue(): int
    {
        return $this->entityDAL->Value;
    }

    public function setValue(int $value): void
    {
        $this->entityDAL->Value = $value;
    }

    public function getCreated(): \DateTime
    {
        return $this->entityDAL->Created;
    }

    public function getUpdated(): \DateTime
    {
        return $this->entityDAL->Updated;
    }

    public function increment(int $amount = 1): void
    {
        if ($amount !== 0) {
            $this->entityDAL->increment($amount);
            CacheManager::processEntityChange($this, StateChangeEventType::Modification);
        }
    }

    public function tryDecrement(int $amount = 1): void
    {
        if ($amount !== 0) {
            $this->entityDAL->tryDecrement($amount);
            CacheManager::processEntityChange($this, StateChangeEventType::Modification);
        }
    }

    public function save(): void
    {
        EntityHelper::saveEntity($this, function () {
            $now = new \DateTime();
            $this->entityDAL->Created = $now;
            $this->entityDAL->Updated = $now;
            $this->entityDAL->insert();
        }, function () {
            $this->entityDAL->Updated = new \DateTime();
            $this->entityDAL->update();
        });
    }

    public static function getOrCreate(int $groupId, int $typeId): self
    {
        $lookup = "GroupID:{$groupId}_GroupCounterTypeID:{$typeId}";
        return EntityHelper::getOrCreateEntityWithRemoteCache(
            self::$EntityCacheInfo,
            $lookup,
            fn() => self::fromDAL(GroupCounterDAL::getOrCreate($groupId, $typeId)),
            fn($id) => self::get($id)
        );
    }

    public static function get(int $id): ?self
    {
        $dal = GroupCounterDAL::get($id);
        return $dal ? self::fromDAL($dal) : null;
    }

    public function buildEntityIDLookups(): array
    {
        return ["GroupID:{$this->getGroupID()}_GroupCounterTypeID:{$this->getGroupCounterTypeID()}"];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }
}
