<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Caching\LazyWithRetry;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupRoleSetPermissionTypeDAL;

class GroupRoleSetPermissionType implements IRobloxEntity, ICacheableObject
{
    private GroupRoleSetPermissionTypeDAL $_EntityDAL;

    private static ?LazyWithRetry $allPermissionsLazy = null;
    private static array $namedPermissionLazy = [];

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupRoleSetPermissionTypeDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupRoleSetPermissionTypeDAL();
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

    public function getDescription(): string
    {
        return $this->_EntityDAL->Description;
    }

    public function setDescription(string $value): void
    {
        $this->_EntityDAL->Description = $value;
    }

    public function getCategory(): GroupRoleSetPermissionCategory
    {
        return GroupRoleSetPermissionCategory::from($this->_EntityDAL->CategoryID);
    }

    public function setCategory(GroupRoleSetPermissionCategory $category): void
    {
        $this->_EntityDAL->CategoryID = $category->value;
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

    public static function get(int|GroupRoleSetPermissionName $id): ?self
    {
        if ($id instanceof GroupRoleSetPermissionName) {
            return self::getByName($id);
        }
        $dal = GroupRoleSetPermissionTypeDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getNullable(?int $id): ?self
    {
        return $id !== null ? self::get($id) : null;
    }

    public static function getByName(string|GroupRoleSetPermissionName $name): ?self
    {
        $name = $name instanceof GroupRoleSetPermissionName ? $name->value : $name;
        $dal = GroupRoleSetPermissionTypeDAL::getByName($name);
        return $dal ? new self($dal) : null;
    }

    public static function createNew(
        GroupRoleSetPermissionName $permission,
        string $description,
        GroupRoleSetPermissionCategory $category = GroupRoleSetPermissionCategory::Group
    ): self {
        $type = new self();
        $type->setName($permission->value);
        $type->setDescription($description);
        $type->setCategory($category);
        $type->save();
        return $type;
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

    public function delete(): void
    {
        $this->_EntityDAL->delete();
    }

    public static function getAllPermissions(): array
    {
        self::$allPermissionsLazy ??= new LazyWithRetry(static function (): array {
            $types = [];
            foreach (GroupRoleSetPermissionName::cases() as $permission) {
                $type = self::getByName($permission);
                if ($type !== null) {
                    $types[] = $type;
                }
            }
            return $types;
        });

        return self::$allPermissionsLazy->getValue();
    }

    public static function getPermissionByCategory(GroupRoleSetPermissionCategory $category): array
    {
        $ids = GroupRoleSetPermissionTypeDAL::getIDsByCategoryID($category->value);
        return array_map(static fn(GroupRoleSetPermissionTypeDAL $dal): self => new self($dal), GroupRoleSetPermissionTypeDAL::multiGet($ids));
    }

    public static function init(): void
    {
        self::$EntityCacheInfo = new CacheInfo(
            new CacheabilitySettings(
                collectionsAreCacheable: true,
                countsAreCacheable: true,
                entityIsCacheable: true,
                idLookupsAreCacheable: true
            ),
            'GroupRoleSetPermissionType',
            isNullCacheable: true
        );
    }

    public function construct(GroupRoleSetPermissionTypeDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return [];
    }

    public function buildStateTokenCollection(): array
    {
        return ['CategoryID:' . $this->_EntityDAL->CategoryID];
    }

    public function equals(?GroupRoleSetPermissionType $other): bool
    {
        return $other !== null && $this->getID() === $other->getID();
    }

    public static function __callStatic(string $name, array $arguments): mixed
    {
        if (preg_match('/^get(Can[A-Za-z]+)$/', $name, $matches)) {
            $permissionName = $matches[1];
            self::$namedPermissionLazy[$permissionName] ??= new LazyWithRetry(
                static fn(): ?self => self::getByName($permissionName)
            );
            return self::$namedPermissionLazy[$permissionName]->getValue();
        }
        throw new \BadMethodCallException("Unknown static method $name");
    }

    public function __get(string $name): mixed
    {
        return match ($name) {
            'ID' => $this->getID(),
            'Name' => $this->getName(),
            'Description' => $this->getDescription(),
            'Category' => $this->getCategory(),
            'Created' => $this->getCreated(),
            'Updated' => $this->getUpdated(),
            default => throw new \OutOfBoundsException("Unknown permission type property: $name"),
        };
    }

    public function __set(string $name, mixed $value): void
    {
        match ($name) {
            'Name' => $this->setName((string) $value),
            'Description' => $this->setDescription((string) $value),
            'Category' => $this->setCategory($value),
            default => throw new \OutOfBoundsException("Unknown or read-only permission type property: $name"),
        };
    }
}

GroupRoleSetPermissionType::init();
