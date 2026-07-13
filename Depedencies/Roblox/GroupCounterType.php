<?php
namespace Roblox;

use Roblox\DataAccess\GroupCounterTypeDAL;
use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\LazyWithRetry;
use Exception;

class GroupCounterType implements Interfaces\IRobloxEntity, Interfaces\ICacheableObject
{
    private GroupCounterTypeDAL $dal;

    private static LazyWithRetry $membersLazy;
    private static LazyWithRetry $adminsLazy;

    public static CacheInfo $entityCacheInfo;

    public function __construct()
    {
        $this->dal = new GroupCounterTypeDAL();
    }

    public static function init(): void
    {
        self::$membersLazy = self::lazyGetter('Members');
        self::$adminsLazy = self::lazyGetter('Admins');

        self::$entityCacheInfo = new CacheInfo(
            new CacheabilitySettings(
                collectionsAreCacheable: true,
                countsAreCacheable: true,
                entityIsCacheable: true,
                idLookupsAreCacheable: true
            ),
            'GroupCounterType',
            true
        );
    }

    public function getID(): int
    {
        return $this->dal->id;
    }

    public function getValue(): string
    {
        return $this->dal->value;
    }

    public function setValue(string $value): void
    {
        $this->dal->value = $value;
    }

    public function getCreated(): string
    {
        return $this->dal->created;
    }

    public function getUpdated(): string
    {
        return $this->dal->updated;
    }

    public static function getMembersID(): int
    {
        return self::$membersLazy->getValue();
    }

    public static function getAdminsID(): int
    {
        return self::$adminsLazy->getValue();
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$entityCacheInfo;
    }

    private static function lazyGetter(string $value): LazyWithRetry
    {
        return new LazyWithRetry(fn() => self::getByValue($value)->getID());
    }

    public function delete(): void
    {
        EntityHelper::deleteEntity($this, fn() => $this->dal->delete());
    }

    public function save(): void
    {
        EntityHelper::saveEntity(
            $this,
            function () {
                $now = date('Y-m-d H:i:s');
                $this->dal->created = $now;
                $this->dal->updated = $now;
                $this->dal->insert();
            },
            function () {
                $this->dal->updated = date('Y-m-d H:i:s');
                $this->dal->update();
            }
        );
    }

    public static function get(int $id): ?GroupCounterType
    {
        return EntityHelper::getEntity(
            self::$entityCacheInfo,
            $id,
            fn() => GroupCounterTypeDAL::getByID($id)
        );
    }

    public static function getNullable(?int $id): ?GroupCounterType
    {
        return $id !== null ? self::get($id) : null;
    }

    public static function getByValue(string $value): ?GroupCounterType
    {
        return EntityHelper::getEntityByLookup(
            self::$entityCacheInfo,
            $value,
            fn() => GroupCounterTypeDAL::getByValue($value)
        );
    }

    public function construct(GroupCounterTypeDAL $dal): void
    {
        $this->dal = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return $this->dal ? [$this->dal->value] : [];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }
}

GroupCounterType::init();
