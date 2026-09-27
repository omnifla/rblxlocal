<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupRelationshipRequestDAL;

class GroupRelationshipRequest implements IRobloxEntity, ICacheableObject
{
    private GroupRelationshipRequestDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupRelationshipRequestDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupRelationshipRequestDAL();
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
        $request = new self();
        $request->setGroupID($groupId);
        $request->setRelatedGroupID($relatedGroupId);
        $request->setGroupRelationshipTypeID($typeId);
        $request->save();
        return $request;
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }
        $dal = GroupRelationshipRequestDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getGroupRelationshipRequestsByGroupIDRelatedGroupIDAndGroupRelationshipTypeID(
        int $groupId,
        int $relatedGroupId,
        int $typeId,
        int $count,
        ?int $exclusiveStartId = null
    ): array {
        return self::loadIDs(GroupRelationshipRequestDAL::getGroupRelationshipRequestIDsByGroupIDRelatedGroupIDAndGroupRelationshipTypeID(
            $groupId,
            $relatedGroupId,
            $typeId,
            $count,
            $exclusiveStartId
        ));
    }

    public static function getTotalNumberOfGroupRelationshipRequestsByGroupIDAndRelatedGroupIDAndTypeID(
        int $groupId,
        int $relatedGroupId,
        int $typeId
    ): int {
        if ($groupId === 0 || $typeId === 0) {
            return 0;
        }
        return GroupRelationshipRequestDAL::getTotalNumberOfGroupRelationshipRequestsByGroupIDAndRelatedGroupIDAndTypeID($groupId, $relatedGroupId, $typeId);
    }

    public static function getGroupRelationshipRequestsByGroupIDAndTypeIDPaged(
        int $groupId,
        int $typeId,
        int $startRowIndex,
        int $maximumRows
    ): array {
        return self::loadIDs(GroupRelationshipRequestDAL::getGroupRelationshipRequestIDsByGroupIDAndTypeIDPaged(
            $groupId,
            $typeId,
            $startRowIndex + 1,
            $maximumRows
        ));
    }

    public static function getTotalNumberOfGroupRelationshipRequestsByGroupIDAndTypeID(
        int $groupId,
        int $typeId
    ): int {
        if ($groupId === 0 || $typeId === 0) {
            return 0;
        }
        return GroupRelationshipRequestDAL::getTotalNumberOfGroupRelationshipRequestsByGroupIDAndTypeID($groupId, $typeId);
    }

    private static function loadIDs(array $ids): array
    {
        $requests = [];
        foreach ($ids as $id) {
            $request = self::get((int) $id);
            if ($request !== null) {
                $requests[] = $request;
            }
        }
        return $requests;
    }

    public function construct(GroupRelationshipRequestDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return [];
    }

    public function buildStateTokenCollection(): array
    {
        return [
            "GroupID:{$this->getGroupID()}_TypeID:{$this->getGroupRelationshipTypeID()}",
            self::getCacheQualifierByGroupIDRelatedGroupIDGroupRelationshipTypeID(
                $this->getGroupID(),
                $this->getRelatedGroupID(),
                $this->getGroupRelationshipTypeID()
            ),
        ];
    }

    private static function getCacheQualifierByGroupIDRelatedGroupIDGroupRelationshipTypeID(
        int $groupId,
        int $relatedGroupId,
        int $typeId
    ): string {
        return "GroupID:{$groupId}_RelatedGroupID:{$relatedGroupId}_TypeID:{$typeId}";
    }

    public function getSerializable(): GroupRelationshipRequestDAL
    {
        return $this->_EntityDAL;
    }
}

GroupRelationshipRequest::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: true,
        countsAreCacheable: true,
        entityIsCacheable: true,
        idLookupsAreCacheable: true
    ),
    'Roblox.GroupRelationshipRequest',
    isNullCacheable: true
);
