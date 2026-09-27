<?php
namespace Roblox;

use InvalidArgumentException;
use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupRoleSetDAL;

class GroupRoleSet implements IRobloxEntity, ICacheableObject
{
    public const SORT_NAME = 0;
    public const SORT_RANK = 1;
    public const SORT_CREATED = 2;
    public const SORT_UPDATED = 3;
    public const SORT_ORDER_ASCENDING = 0;
    public const SORT_ORDER_DESCENDING = 1;
    public const GuestRank = 0;
    public const OwnerRank = 255;

    private GroupRoleSetDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupRoleSetDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupRoleSetDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getName(): string
    {
        return $this->_EntityDAL->Name;
    }

    public function setName(string $value): void
    {
        $this->_EntityDAL->Name = $value;
    }

    public function getGroupID(): int
    {
        return $this->_EntityDAL->GroupID;
    }

    public function setGroupID(int $value): void
    {
        $this->_EntityDAL->GroupID = $value;
    }

    public function getDescription(): string
    {
        return $this->_EntityDAL->Description;
    }

    public function setDescription(string $value): void
    {
        $this->_EntityDAL->Description = $value;
    }

    public function getRank(): int
    {
        return $this->_EntityDAL->Rank;
    }

    public function setRank(int $value): void
    {
        if ($value < 0 || $value > self::OwnerRank) {
            throw new InvalidArgumentException('Rank must be between 0 and 255.');
        }
        $this->_EntityDAL->Rank = $value;
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

    public function getPermissions(): array
    {
        $permissions = $this->_EntityDAL->Permissions;
        if ($permissions === null || trim($permissions) === '') {
            return [];
        }

        $decoded = json_decode($permissions, true);
        if (is_array($decoded)) {
            return array_values($decoded);
        }
        return array_values(array_filter(array_map('trim', explode(',', $permissions)), static fn(string $value): bool => $value !== ''));
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->isGroupLocked()) {
            return false;
        }
        if ($this->getRank() === self::OwnerRank) {
            return true;
        }
        return in_array($permission, $this->getPermissions(), true);
    }

    private function isGroupLocked(): bool
    {
        global $conn;
        $stmt = $conn->prepare('SELECT is_locked FROM groups WHERE gid = :group_id LIMIT 1');
        $stmt->execute([':group_id' => $this->getGroupID()]);
        return (bool) $stmt->fetchColumn();
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

    public static function createNew(int $groupId, string $name, string $description, int $rank): self
    {
        $roleSet = new self();
        $roleSet->setGroupID($groupId);
        $roleSet->setName($name);
        $roleSet->setDescription($description);
        $roleSet->setRank($rank);
        $roleSet->save();
        return $roleSet;
    }

    public static function get(int $id): ?self
    {
        $dal = GroupRoleSetDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getByGroupIDAndName(int $groupId, string $name): ?self
    {
        $dal = GroupRoleSetDAL::getByGroupIDAndName($groupId, $name);
        return $dal ? new self($dal) : null;
    }

    public static function getByUserIDAndGroupID(?int $userId, int $groupId): ?self
    {
        if ($userId === null) {
            return self::getGuestRoleSet($groupId);
        }
        $roleSetId = GroupRoleSetDAL::getIDByGroupIDAndUserID($groupId, $userId);
        return $roleSetId === null ? self::getGuestRoleSet($groupId) : self::get($roleSetId);
    }

    public static function getGuestRoleSet(int $groupId): ?self
    {
        return self::getByGroupIDAndName($groupId, 'Guest');
    }

    public static function getOwnerGroupRoleSetByGroupID(int $groupId): ?self
    {
        $dal = GroupRoleSetDAL::getOwnerByGroupID($groupId);
        return $dal ? new self($dal) : null;
    }

    public static function getOrCreate(int $groupId, string $name, string $description, int $rank): self
    {
        return new self(GroupRoleSetDAL::getOrCreate($groupId, $name, $description, $rank));
    }

    public static function multiGet(array $ids): array
    {
        return array_map(static fn(GroupRoleSetDAL $dal): self => new self($dal), GroupRoleSetDAL::multiGet($ids));
    }

    public static function getGroupRoleSetsByGroupID(int $groupId): array
    {
        return self::loadIDs(GroupRoleSetDAL::getIDsByGroupID($groupId));
    }

    public static function getGroupRoleSetsByGroupIDAndMaxRank(int $groupId, int $maxRank): array
    {
        return self::loadIDs(GroupRoleSetDAL::getIDsByGroupIDAndMaxRank($groupId, $maxRank));
    }

    public static function getTotalNumberOfGroupRoleSetsByGroupID(int $groupId): int
    {
        return GroupRoleSetDAL::getTotalByGroupID($groupId);
    }

    public static function getDefaultStartingRoleSetByGroupID(int $groupId): ?self
    {
        $roleSets = self::getGroupRoleSetsByGroupID($groupId);
        if (count($roleSets) <= 1) {
            return null;
        }
        return $roleSets[1];
    }

    private static function loadIDs(array $ids): array
    {
        $roleSets = [];
        foreach ($ids as $id) {
            $roleSet = self::get((int) $id);
            if ($roleSet !== null) {
                $roleSets[] = $roleSet;
            }
        }
        return $roleSets;
    }

    public function construct(GroupRoleSetDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function equals(?GroupRoleSet $other): bool
    {
        return $other !== null && $this->getID() === $other->getID() && $this->getGroupID() === $other->getGroupID();
    }

    public function buildEntityIDLookups(): array
    {
        return [
            "GroupID:{$this->getGroupID()}_Name:{$this->getName()}",
            "Owner_GroupID:{$this->getGroupID()}",
        ];
    }

    public function buildStateTokenCollection(): array
    {
        return ["GroupID:{$this->getGroupID()}"];
    }

    public function getSerializable(): GroupRoleSetDAL
    {
        return $this->_EntityDAL;
    }
}

GroupRoleSet::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: true,
        countsAreCacheable: true,
        entityIsCacheable: true,
        idLookupsAreCacheable: false
    ),
    'GroupRoleSet',
    isNullCacheable: false
);
