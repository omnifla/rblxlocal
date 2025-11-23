<?php
// written and ported by SkylerClock
namespace Roblox\Assets;

use Roblox\Cache\CacheInfo;
use Roblox\Cache\CacheabilitySettings;
use Roblox\Cache\CacheManager;
use Roblox\Common\EntityHelper;
use Roblox\Common\Converters;
use Roblox\Assets\AssetDAL;

class AssetCategory
{
    private AssetCategoryDAL $_EntityDAL;

    public const AllCategoriesName = "All";

    public static int $AllTShirtCategoriesID;
    public static int $AllGearCategories;

    public static array $GearNames = [];
    public static array $FriendlyGearNames = [];

    public const AllCategories = 0;
    public const GearCategoriesCount = 10;

    public const GearAll = 0;
    public const GearMelee = 1;
    public const GearRanged = 2;
    public const GearExplosive = 3;
    public const GearPowerUps = 4;
    public const GearNavigation = 5;
    public const GearMusical = 6;
    public const GearSocial = 7;
    public const GearBuilding = 8;
    public const GearPersonalTransport = 9;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?AssetCategoryDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new AssetCategoryDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getAssetTypeID(): int
    {
        return $this->_EntityDAL->AssetTypeID;
    }

    public function getBitOrdinal(): int
    {
        return $this->_EntityDAL->BitOrdinal;
    }

    public function setBitOrdinal(int $value): void
    {
        $this->_EntityDAL->BitOrdinal = $value;
        $this->_EntityDAL->BitMask = pow(2, $value - 1);
    }

    public function getBitMask(): int
    {
        return (int)$this->_EntityDAL->BitMask;
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

    public function getAbbreviation(): string
    {
        return $this->_EntityDAL->Abbreviation;
    }

    public function setAbbreviation(string $value): void
    {
        $this->_EntityDAL->Abbreviation = $value;
    }

    public function getCreated(): \DateTime
    {
        return $this->_EntityDAL->Created;
    }

    public function getUpdated(): \DateTime
    {
        return $this->_EntityDAL->Updated;
    }

    public static function getFriendlyGearName(int $gearCategory): string
    {
        return self::$FriendlyGearNames[$gearCategory] ?? '';
    }

    public static function getGearName(int $gearCategory): string
    {
        return self::$GearNames[$gearCategory] ?? '';
    }

    public function delete(): void
    {
        EntityHelper::deleteEntity($this, [$this->_EntityDAL, 'delete']);
    }

    public function save(): void
    {
        EntityHelper::saveEntity(
            $this,
            function () {
                $this->_EntityDAL->Created = new \DateTime();
                $this->_EntityDAL->Updated = $this->_EntityDAL->Created;
                $this->_EntityDAL->insert();
            },
            function () {
                $this->_EntityDAL->Updated = new \DateTime();
                $this->_EntityDAL->update();
            }
        );
    }

    private static function doGet(int $id): ?AssetCategory
    {
        return EntityHelper::doGet(fn() => AssetCategoryDAL::get($id), $id);
    }

    private static function doGetByOrdinal(int $assetTypeId, int $bitOrdinal): ?AssetCategory
    {
        return EntityHelper::doGetByLookup(
            fn() => AssetCategoryDAL::getByOrdinal($assetTypeId, $bitOrdinal),
            "AssetTypeID:{$assetTypeId}_BitOrdinal:{$bitOrdinal}"
        );
    }

    private static function doGetByName(int $assetTypeId, string $name): ?AssetCategory
    {
        return EntityHelper::doGetByLookup(
            fn() => AssetCategoryDAL::getByName($assetTypeId, $name),
            "AssetTypeID:{$assetTypeId}_Name:{$name}"
        );
    }

    public static function get(int $id): ?AssetCategory
    {
        return EntityHelper::getEntityOld(self::$EntityCacheInfo, $id, fn() => self::doGet($id));
    }

    public static function getNullable(?int $id): ?AssetCategory
    {
        return $id !== null ? self::get($id) : null;
    }

    public static function getByOrdinal(int $assetTypeId, int $bitOrdinal): ?AssetCategory
    {
        return EntityHelper::getEntityByLookupOld(
            self::$EntityCacheInfo,
            "AssetTypeID:{$assetTypeId}_BitOrdinal:{$bitOrdinal}",
            fn() => self::doGetByOrdinal($assetTypeId, $bitOrdinal)
        );
    }

    public static function getByName(int $assetTypeId, string $name): ?AssetCategory
    {
        return EntityHelper::getEntityByLookupOld(
            self::$EntityCacheInfo,
            "AssetTypeID:{$assetTypeId}_Name:{$name}",
            fn() => self::doGetByName($assetTypeId, $name)
        );
    }

    public static function getAssetCategoriesPaged(int $startRowIndex, int $maximumRows): array
    {
        $collectionId = "GetAssetCategoriesPaged_StartRowIndex:{$startRowIndex}_MaximumRows:{$maximumRows}";
        return EntityHelper::getEntityCollection(
            self::$EntityCacheInfo,
            CacheManager::$UnqualifiedNonExpiringCachePolicy,
            $collectionId,
            fn() => AssetCategoryDAL::getAssetCategoryIDsPaged($startRowIndex + 1, $maximumRows),
            fn($id) => self::get($id)
        );
    }

    public static function getTotalNumberOfAssetCategories(): int
    {
        return EntityHelper::getEntityCount(
            self::$EntityCacheInfo,
            CacheManager::$UnqualifiedNonExpiringCachePolicy,
            "GetTotalNumberOfAssetCategories",
            [AssetCategoryDAL::class, 'getTotalNumberOfAssetCategories']
        );
    }

    public static function coalesceAssetCategories(array $categories): int
    {
        $returnValue = 0;
        foreach ($categories as $cat) {
            $returnValue |= $cat->getBitMask();
        }
        return $returnValue;
    }

    public static function convertBitMaskToCategories(int $assetTypeId, int $bitMask): \Generator
    {
        foreach (Converters::distillOrdinalsFromBitMask($bitMask) as $ordinal) {
            yield self::getByOrdinal($assetTypeId, $ordinal);
        }
    }

    private static function initializeGearNames(): void
    {
        self::$GearNames = [
            "All",
            "Melee",
            "Ranged",
            "Explosive",
            "PowerUps",
            "Navigation",
            "Music",
            "Social",
            "Building",
            "PersonalTransport"
        ];
        self::$FriendlyGearNames = [
            "All",
            "Melee",
            "Ranged",
            "Explosive",
            "Power Up",
            "Navigation",
            "Musical",
            "Social",
            "Building",
            "Transport"
        ];
    }

    public function construct(AssetCategoryDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        $lookups = [];
        if ($this->_EntityDAL) {
            $lookups[] = "AssetTypeID:{$this->getAssetTypeID()}_BitOrdinal:{$this->getBitOrdinal()}";
            $lookups[] = "AssetTypeID:{$this->getAssetTypeID()}_Name:{$this->getName()}";
        }
        return $lookups;
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }

    public static function __init(): void
    {
        self::$EntityCacheInfo = new CacheInfo(
            new CacheabilitySettings(true, true, true, true),
            "AssetCategory",
            true
        );

        self::$AllTShirtCategoriesID = AssetCategoryDAL::getByName(\Roblox\DataAccess\AssetType::TeeShirtID, "All")->ID;
        self::$AllGearCategories = AssetCategoryDAL::getByName(\Roblox\DataAccess\AssetType::GearID, "All")->ID;

        self::initializeGearNames();
    }
}

AssetCategory::__init();