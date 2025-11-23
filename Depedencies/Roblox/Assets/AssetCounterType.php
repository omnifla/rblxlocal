<?php
// written and ported by SkylerClock
namespace Roblox\Assets;

use Roblox\DataAccess\AssetCounterTypeDAL;
use Exception;

class AssetCounterType
{
    public int $id = 0;
    public string $value = '';
    public string $created = '';
    public string $updated = '';
    private AssetCounterTypeDAL $_entityDAL;
    public static int $CommentsID;
    public static int $FavoritesID;
    public static int $NumberSoldByRobloxID;
    public static int $GrossSalesRevenueRobuxID;
    public const CommentsValue = 'Comments';
    public const FavoritesValue = 'Favorites';
    public const NumberSoldByRobloxValue = 'NumberSoldByRoblox';
    public const GrossSalesRevenueRobuxValue = 'GrossSalesRevenueRobux';

    public function __construct() {
        $this->_entityDAL = new AssetCounterTypeDAL();
    }

    public static function init(): void {
        self::$CommentsID = self::get(self::CommentsValue)?->id ?? 0;
        self::$FavoritesID = self::get(self::FavoritesValue)?->id ?? 0;
        self::$NumberSoldByRobloxID = self::get(self::NumberSoldByRobloxValue)?->id ?? 0;
        self::$GrossSalesRevenueRobuxID = self::get(self::GrossSalesRevenueRobuxValue)?->id ?? 0;
    }

    public function delete(): void {
        $this->_entityDAL->delete();
    }

    public function save(): void {
        if ($this->id === 0) {
            $this->_entityDAL->created = date('Y-m-d H:i:s');
            $this->_entityDAL->updated = $this->_entityDAL->created;
            $this->_entityDAL->value = $this->value;
            $this->_entityDAL->insert();
            $this->id = $this->_entityDAL->id;
            $this->created = $this->_entityDAL->created;
            $this->updated = $this->_entityDAL->updated;
        } else {
            $this->_entityDAL->id = $this->id;
            $this->_entityDAL->value = $this->value;
            $this->_entityDAL->updated = date('Y-m-d H:i:s');
            $this->_entityDAL->update();
            $this->updated = $this->_entityDAL->updated;
        }
    }

    private static function createNew(string $value): AssetCounterType {
        $obj = new self();
        $obj->value = $value;
        $obj->save();
        return $obj;
    }

    private static function doGetById(int $id): ?AssetCounterType {
        $dal = AssetCounterTypeDAL::get($id);
        return $dal ? self::fromDAL($dal) : null;
    }

    private static function doGetByValue(string $value): ?AssetCounterType {
        $dal = AssetCounterTypeDAL::getByValue($value);
        return $dal ? self::fromDAL($dal) : null;
    }

    public static function get(int|string $idOrValue): ?AssetCounterType {
        if (is_int($idOrValue)) {
            return self::doGetById($idOrValue);
        }
        return self::doGetByValue($idOrValue);
    }

    public static function getSegmentedType(string $type, int $segmentId): AssetCounterType {
        $typeString = "{$type}_SegmentID:{$segmentId}";
        return self::get($typeString) ?? self::createNew($typeString);
    }

    public static function getByPlatformType(string $type, int $platformTypeId): AssetCounterType {
        $typeString = "{$type}_PlatformTypeID:{$platformTypeId}";
        return self::get($typeString) ?? self::createNew($typeString);
    }

    public static function fromDAL(AssetCounterTypeDAL $dal): AssetCounterType {
        $obj = new self();
        $obj->_entityDAL = $dal;
        $obj->id = $dal->id;
        $obj->value = $dal->value;
        $obj->created = $dal->created;
        $obj->updated = $dal->updated;
        return $obj;
    }

    public function buildEntityIDLookups(): array {
        return $this->value ? [$this->value] : [];
    }

    public function buildStateTokenCollection(): array {
        return [];
    }
}

AssetCounterType::init();