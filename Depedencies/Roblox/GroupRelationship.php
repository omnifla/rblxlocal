<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupRelationshipDAL;

class GroupRelationship implements IRobloxEntity, ICacheableObject
{
    private GroupRelationshipDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupRelationshipDAL $entityDAL = null)
    {
        $this->_EntityDAL = $entityDAL ?? new GroupRelationshipDAL();
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

    public function getRelatedGroupID(): int
    {
        return $this->_EntityDAL->RelatedGroupID;
    }

    public function setRelatedGroupID(int $value): void
    {
        $this->_EntityDAL->RelatedGroupID = $value;
    }

    public function getGroupRelationshipTypeID(): int
    {
        return $this->_EntityDAL->GroupRelationshipTypeID;
    }

    public function setGroupRelationshipTypeID(int $value): void
    {
        $this->_EntityDAL->GroupRelationshipTypeID = $value;
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

    public static function createNew(int $groupId, int $relatedGroupId, int $typeId): self
    {
        $relationship = new self();
        $relationship->setGroupID($groupId);
        $relationship->setRelatedGroupID($relatedGroupId);
        $relationship->setGroupRelationshipTypeID($typeId);
        $relationship->save();
        return $relationship;
    }

    public static function get(int $id): ?self
    {
        $dal = GroupRelationshipDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getByGroupRelatedGroupAndType(
        int $groupId,
        int $relatedGroupId,
        int $typeId
    ): ?self {
        $dal = GroupRelationshipDAL::getByGroupIDAndRelatedGroupIDAndTypeID($groupId, $relatedGroupId, $typeId);
        return $dal ? new self($dal) : null;
    }

    public static function getGroupRelationshipsByGroupIDAndTypeIDPaged(
        int $groupId,
        int $typeId,
        int $startRowIndex,
        int $maximumRows
    ): array {
        $ids = GroupRelationshipDAL::getGroupRelationshipIDsByGroupIDAndTypeIDPaged(
            $groupId,
            $typeId,
            $startRowIndex + 1,
            $maximumRows
        );
        $relationships = [];
        foreach ($ids as $id) {
            $relationship = self::get((int) $id);
            if ($relationship !== null) {
                $relationships[] = $relationship;
            }
        }
        return $relationships;
    }

    public static function getTotalNumberOfGroupRelationshipsByGroupIDAndTypeID(
        int $groupId,
        int $typeId
    ): int {
        if ($groupId === 0 || $typeId === 0) {
            return 0;
        }
        return GroupRelationshipDAL::getTotalNumberOfGroupRelationshipsByGroupIDAndTypeID($groupId, $typeId);
    }

    public function construct(GroupRelationshipDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return ["GroupID:{$this->getGroupID()}_RelatedGroupID:{$this->getRelatedGroupID()}_GroupRelationshipTypeID:{$this->getGroupRelationshipTypeID()}"];
    }

    public function buildStateTokenCollection(): array
    {
        return ["GroupID:{$this->getGroupID()}_TypeID:{$this->getGroupRelationshipTypeID()}"];
    }

    public function getSerializable(): GroupRelationshipDAL
    {
        return $this->_EntityDAL;
    }
}

GroupRelationship::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: true,
        countsAreCacheable: true,
        entityIsCacheable: true,
        idLookupsAreCacheable: true
    ),
    'Roblox.GroupRelationship',
    isNullCacheable: true
);
