<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Caching\LazyWithRetry;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupFeatureTypeDAL;

class GroupFeatureType implements IRobloxEntity, ICacheableObject
{
    private GroupFeatureTypeDAL $_EntityDAL;

    private static LazyWithRetry $allowEnemiesLazy;
    private static LazyWithRetry $allowVisibleGroupFundsLazy;
    private static LazyWithRetry $clanLazy;
    private static LazyWithRetry $groupGamesVisibleLazy;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupFeatureTypeDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupFeatureTypeDAL();
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

    public static function getAllowEnemiesID(): int
    {
        return self::$allowEnemiesLazy->getValue();
    }

    public static function getAllowVisibleGroupFundsID(): int
    {
        return self::$allowVisibleGroupFundsLazy->getValue();
    }

    public static function getClanID(): int
    {
        return self::$clanLazy->getValue();
    }

    public static function getGroupGamesVisibleID(): int
    {
        return self::$groupGamesVisibleLazy->getValue();
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    private static function lazyGetter(string $name): LazyWithRetry
    {
        return new LazyWithRetry(
            static fn(): int => self::getByName($name)?->getID()
                ?? throw new \RuntimeException("Group feature type '$name' was not found.")
        );
    }

    public static function init(): void
    {
        self::$allowEnemiesLazy = self::lazyGetter('AllowEnemies');
        self::$allowVisibleGroupFundsLazy = self::lazyGetter('AllowVisibleGroupFunds');
        self::$clanLazy = self::lazyGetter('Clan');
        self::$groupGamesVisibleLazy = self::lazyGetter('GroupGamesVisible');
        self::$EntityCacheInfo = new CacheInfo(
            new CacheabilitySettings(
                collectionsAreCacheable: true,
                countsAreCacheable: true,
                entityIsCacheable: true,
                idLookupsAreCacheable: true
            ),
            'Roblox.GroupFeatureType',
            isNullCacheable: true
        );
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

    public static function createNew(string $name): self
    {
        $featureType = new self();
        $featureType->setName($name);
        $featureType->save();
        return $featureType;
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }

        $dal = GroupFeatureTypeDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getNullable(?int $id): ?self
    {
        return $id !== null ? self::get($id) : null;
    }

    public static function getByName(string $name): ?self
    {
        if ($name === '') {
            return null;
        }

        $dal = GroupFeatureTypeDAL::getByName($name);
        return $dal ? new self($dal) : null;
    }

    public function construct(GroupFeatureTypeDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return ['Name:' . $this->getName()];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }
}

GroupFeatureType::init();
