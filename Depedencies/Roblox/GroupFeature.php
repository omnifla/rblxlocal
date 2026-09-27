<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupFeatureDAL;

class GroupFeature implements IRobloxEntity, ICacheableObject
{
    private GroupFeatureDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupFeatureDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupFeatureDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getGroupID(): int
    {
        return $this->_EntityDAL->GroupID;
    }

    public function setGroupID(int $value): void
    {
        $this->_EntityDAL->GroupID = $value;
    }

    public function getGroupFeatureTypeID(): int
    {
        return $this->_EntityDAL->GroupFeatureTypeID;
    }

    public function setGroupFeatureTypeID(int $value): void
    {
        $this->_EntityDAL->GroupFeatureTypeID = $value;
    }

    public function getCreated(): \DateTime
    {
        return $this->_EntityDAL->Created;
    }

    public function setCreated(\DateTime $value): void
    {
        $this->_EntityDAL->Created = $value;
    }

    public function getUpdated(): \DateTime
    {
        return $this->_EntityDAL->Updated;
    }

    public function setUpdated(\DateTime $value): void
    {
        $this->_EntityDAL->Updated = $value;
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    public function delete(): void
    {
        $this->_EntityDAL->delete();
    }

    public function save(): void
    {
        if ($this->getID() === 0) {
            $this->_EntityDAL->Created = new \DateTime();
            $this->_EntityDAL->Updated = $this->_EntityDAL->Created;
            $this->_EntityDAL->insert();
        } else {
            $this->_EntityDAL->Updated = new \DateTime();
            $this->_EntityDAL->update();
        }
    }

    public static function createNew(int $groupId, int $groupFeatureTypeId): self
    {
        $feature = new self();
        $feature->setGroupID($groupId);
        $feature->setGroupFeatureTypeID($groupFeatureTypeId);
        $feature->save();
        return $feature;
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }

        $dal = GroupFeatureDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getByGroupIDAndTypeID(int $groupId, int $groupFeatureTypeId): ?self
    {
        $dal = GroupFeatureDAL::getByGroupIDAndTypeID($groupId, $groupFeatureTypeId);
        return $dal ? new self($dal) : null;
    }

    public static function getGroupFeaturesByGroupIDPaged(
        int $groupId,
        int $startRowIndex,
        int $maximumRows
    ): array {
        $ids = GroupFeatureDAL::getGroupFeatureIDsByGroupIDPaged(
            $groupId,
            $startRowIndex + 1,
            $maximumRows
        );

        $features = [];
        foreach ($ids as $id) {
            $feature = self::get((int) $id);
            if ($feature !== null) {
                $features[] = $feature;
            }
        }
        return $features;
    }

    public function construct(GroupFeatureDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return ["GroupID:{$this->getGroupID()}_GroupFeatureTypeID:{$this->getGroupFeatureTypeID()}"];
    }

    public function buildStateTokenCollection(): array
    {
        return ["GroupID:{$this->getGroupID()}"];
    }

    public function getSerializable(): GroupFeatureDAL
    {
        return $this->_EntityDAL;
    }
}

GroupFeature::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: true,
        countsAreCacheable: true,
        entityIsCacheable: true,
        idLookupsAreCacheable: true
    ),
    'Roblox.GroupFeature',
    isNullCacheable: true
);
