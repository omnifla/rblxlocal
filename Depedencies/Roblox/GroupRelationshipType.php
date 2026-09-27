<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Caching\ICacheableObject;
use Roblox\Caching\LazyWithRetry;
use Roblox\Common\IRobloxEntity;
use Roblox\DataAccess\GroupRelationshipTypeDAL;

class GroupRelationshipType implements IRobloxEntity, ICacheableObject
{
    private GroupRelationshipTypeDAL $_EntityDAL;

    private static LazyWithRetry $allyLazy;
    private static LazyWithRetry $enemyLazy;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?GroupRelationshipTypeDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new GroupRelationshipTypeDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getValue(): string
    {
        return $this->_EntityDAL->Value;
    }

    public function setValue(string $value): void
    {
        $this->_EntityDAL->Value = $value;
    }

    public function getIsReciprocal(): bool
    {
        return $this->_EntityDAL->IsReciprocal;
    }

    public function setIsReciprocal(bool $value): void
    {
        $this->_EntityDAL->IsReciprocal = $value;
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

    public static function getAllyID(): int
    {
        return self::$allyLazy->getValue();
    }

    public static function getEnemyID(): int
    {
        return self::$enemyLazy->getValue();
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    public static function init(): void
    {
        self::$allyLazy = self::lazyGetter('Ally');
        self::$enemyLazy = self::lazyGetter('Enemy');
        self::$EntityCacheInfo = new CacheInfo(
            new CacheabilitySettings(
                collectionsAreCacheable: true,
                countsAreCacheable: true,
                entityIsCacheable: true,
                idLookupsAreCacheable: true
            ),
            'Roblox.GroupRelationshipType',
            isNullCacheable: true
        );
    }

    private static function lazyGetter(string $value): LazyWithRetry
    {
        return new LazyWithRetry(
            static fn(): int => self::getByValue($value)?->getID()
                ?? throw new \RuntimeException("Group relationship type '$value' was not found.")
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

    public static function createNew(string $value, bool $isReciprocal): self
    {
        $type = new self();
        $type->setValue($value);
        $type->setIsReciprocal($isReciprocal);
        $type->save();
        return $type;
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }
        $dal = GroupRelationshipTypeDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getByValue(string $value): ?self
    {
        if ($value === '') {
            return null;
        }
        $dal = GroupRelationshipTypeDAL::getByValue($value);
        return $dal ? new self($dal) : null;
    }

    public function construct(GroupRelationshipTypeDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return ['Value:' . $this->getValue()];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }
}

GroupRelationshipType::init();
