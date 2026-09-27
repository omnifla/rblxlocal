<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupJoinRequestDAL;

class GroupJoinRequest implements IRobloxEntity, ICacheableObject
{
    private GroupJoinRequestDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupJoinRequestDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupJoinRequestDAL();
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

    public function getUserID(): int
    {
        return $this->_EntityDAL->UserID;
    }

    public function setUserID(int $value): void
    {
        $this->_EntityDAL->UserID = $value;
    }

    public function getCreated(): \DateTime
    {
        return $this->_EntityDAL->Created;
    }

    public function getUpdated(): \DateTime
    {
        return $this->_EntityDAL->Updated;
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

    public static function createNew(int $groupId, int $userId): self
    {
        $request = new self();
        $request->setGroupID($groupId);
        $request->setUserID($userId);
        $request->save();
        return $request;
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }
        $dal = GroupJoinRequestDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getNullable(?int $id): ?self
    {
        return $id !== null ? self::get($id) : null;
    }

    public static function getByGroupIDAndUserID(int $groupId, int $userId): ?self
    {
        $dal = GroupJoinRequestDAL::getByGroupIDAndUserID($groupId, $userId);
        return $dal ? new self($dal) : null;
    }

    public static function getGroupJoinRequestsByGroupID(int $groupId): array
    {
        return self::loadIDs(GroupJoinRequestDAL::getGroupJoinRequestIDsByGroupID($groupId));
    }

    public static function getGroupJoinRequestsByGroupIDEnumerative(
        int $groupId,
        ?int $exclusiveStartId,
        int $maximumRows
    ): array {
        return self::loadIDs(
            GroupJoinRequestDAL::getGroupJoinRequestsIDsByGroupIDEnumerative(
                $groupId,
                $exclusiveStartId,
                $maximumRows
            )
        );
    }

    public static function getGroupJoinRequestsByGroupIDPaged(
        int $groupId,
        int $startRowIndex,
        int $maximumRows
    ): array {
        return self::loadIDs(
            GroupJoinRequestDAL::getGroupJoinRequestIDsByGroupIDPaged(
                $groupId,
                $startRowIndex + 1,
                $maximumRows
            )
        );
    }

    public static function getGroupJoinRequestsByUserID(int $userId): array
    {
        return self::loadIDs(GroupJoinRequestDAL::getGroupJoinRequestIDsByUserID($userId));
    }

    public static function getTotalNumberOfGroupJoinRequestsByGroupID(int $groupId): int
    {
        return GroupJoinRequestDAL::getTotalNumberOfGroupJoinRequestsByGroupID($groupId);
    }

    public static function getTotalNumberOfGroupJoinRequestsByUserID(int $userId): int
    {
        return GroupJoinRequestDAL::getTotalNumberOfGroupJoinRequestsByUserID($userId);
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

    public function construct(GroupJoinRequestDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function equals(?GroupJoinRequest $other): bool
    {
        return $other !== null && $this->getID() === $other->getID();
    }

    public function buildEntityIDLookups(): array
    {
        return ["GroupID:{$this->getGroupID()}_UserID:{$this->getUserID()}"];
    }

    public function buildStateTokenCollection(): array
    {
        return ["UserID:{$this->getUserID()}", "GroupID:{$this->getGroupID()}"];
    }
}

GroupJoinRequest::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: true,
        countsAreCacheable: true,
        entityIsCacheable: true,
        idLookupsAreCacheable: true
    ),
    'GroupJoinRequest',
    isNullCacheable: true
);
