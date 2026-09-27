<?php
namespace Roblox;

use InvalidArgumentException;
use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupRoleSetPermissionDAL;

class GroupRoleSetPermission implements IRobloxEntity, ICacheableObject
{
    private GroupRoleSetPermissionDAL $_EntityDAL;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupRoleSetPermissionDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupRoleSetPermissionDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getRoleSetID(): int
    {
        return $this->_EntityDAL->RoleSetID;
    }

    public function setRoleSetID(int $value): void
    {
        $this->_EntityDAL->RoleSetID = $value;
    }

    public function getRoleSetPermissionTypeID(): int
    {
        return $this->_EntityDAL->RoleSetPermissionTypeID;
    }

    public function setRoleSetPermissionTypeID(int $value): void
    {
        $this->_EntityDAL->RoleSetPermissionTypeID = $value;
    }

    public function getRoleSetPermissionTypeCategoryID(): int
    {
        return $this->_EntityDAL->RoleSetPermissionTypeCategoryID;
    }

    public function setRoleSetPermissionTypeCategoryID(int $value): void
    {
        $this->_EntityDAL->RoleSetPermissionTypeCategoryID = $value;
    }

    public function getRoleSetPermissionTypeCategory(): int
    {
        return $this->getRoleSetPermissionTypeCategoryID();
    }

    public function setRoleSetPermissionTypeCategory(int $value): void
    {
        $this->setRoleSetPermissionTypeCategoryID($value);
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

    public function getRoleSetPermissionType(): GroupRoleSetPermissionType
    {
        return new GroupRoleSetPermissionType(
            $this->getRoleSetPermissionTypeID(),
            $this->getRoleSetPermissionTypeCategoryID()
        );
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

    public static function getOrCreate(
        int $roleSetId,
        int|GroupRoleSetPermissionType $permissionType,
        ?int $categoryId = null
    ): self {
        if ($permissionType instanceof GroupRoleSetPermissionType) {
            $typeId = $permissionType->ID;
            $categoryId = $permissionType->Category;
        } else {
            $typeId = $permissionType;
        }
        if ($categoryId === null) {
            throw new InvalidArgumentException('Permission type category is required.');
        }
        return new self(GroupRoleSetPermissionDAL::getOrCreate($roleSetId, $typeId, $categoryId));
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }
        $dal = GroupRoleSetPermissionDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getByRoleSetIDAndTypeID(int $roleSetId, int $typeId): ?self
    {
        $dal = GroupRoleSetPermissionDAL::getByRoleSetIDAndTypeID($roleSetId, $typeId);
        return $dal ? new self($dal) : null;
    }

    public static function getTotalNumberOfRoleSetPermissionsByRoleSetID(int $roleSetId): int
    {
        return GroupRoleSetPermissionDAL::getTotalByRoleSetID($roleSetId);
    }

    public static function getRoleSetPermissionsByRoleSetID(int $roleSetId): array
    {
        return self::multiGet(GroupRoleSetPermissionDAL::getIDsByRoleSetID($roleSetId));
    }

    public static function multiGet(array $ids): array
    {
        return array_map(
            static fn(GroupRoleSetPermissionDAL $dal): self => new self($dal),
            GroupRoleSetPermissionDAL::multiGet($ids)
        );
    }

    public function construct(GroupRoleSetPermissionDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function equals(?GroupRoleSetPermission $other): bool
    {
        return $other !== null && $this->getID() === $other->getID();
    }

    public function buildEntityIDLookups(): array
    {
        return ["RoleSetID:{$this->getRoleSetID()}_TypeID:{$this->getRoleSetPermissionTypeID()}"];
    }

    public function buildStateTokenCollection(): array
    {
        return ["GroupRoleSetID:{$this->getRoleSetID()}"];
    }

    public function getSerializable(): GroupRoleSetPermissionDAL
    {
        return $this->_EntityDAL;
    }
}

GroupRoleSetPermission::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: true,
        countsAreCacheable: true,
        entityIsCacheable: true,
        idLookupsAreCacheable: true,
        hasUnqualifiedCollections: false
    ),
    'GroupRoleSetPermission',
    isNullCacheable: true
);
