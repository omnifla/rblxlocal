<?php
// ported by meditext
// i had to re-read the code to port it correctly, and it happens to be that i entirely wiped out everything.
namespace Roblox;

use Exception;
use Roblox\DataAccess\AssetTypeDAL;

class AssetType {
    public int $id = 0;
    public string $value = '';
    public ?string $description = null;
    public ?string $abbreviation = null;
    public bool $requiresReview = false;
    public ?string $created = null;
    public ?string $updated = null;

    private static array $assetTypeCache = [];

    public function __construct() {}

    public function save(): void {
        if ($this->id > 0) {
            $this->updated = date('Y-m-d H:i:s');
            AssetTypeDAL::update($this);
        } else {
            $this->created = $this->updated = date('Y-m-d H:i:s');
            $this->id = AssetTypeDAL::insert($this);
        }
    }

    public function delete(): void {
        if ($this->id === 0) {
            throw new Exception("Required value not specified: ID.");
        }
        AssetTypeDAL::delete($this->id);
    }

    public static function get(int $id): ?AssetType {
        if (isset(self::$assetTypeCache[$id])) {
            return self::$assetTypeCache[$id];
        }
        $dal = AssetTypeDAL::get($id);
        if (!$dal) {
            return null;
        }
        $assetType = self::buildFromDAL($dal);
        self::$assetTypeCache[$id] = $assetType;
        return $assetType;
    }

    public static function getByValue(string $value): ?AssetType {
        $dal = AssetTypeDAL::getByValue($value);
        return $dal ? self::buildFromDAL($dal) : null;
    }

    public static function getAll(): array {
        $dals = AssetTypeDAL::getAll();
        return array_map(fn($dal) => self::buildFromDAL($dal), $dals);
    }

    public static function isAccoutrementPackageType(int $typeId): bool {
        return $typeId === self::getPackage()->id;
    }

    private static function buildFromDAL(array $dal): AssetType {
        $assetType = new AssetType();
        $assetType->id = $dal['id'];
        $assetType->value = $dal['value'];
        $assetType->description = $dal['description'];
        $assetType->abbreviation = $dal['abbreviation'];
        $assetType->requiresReview = (bool)$dal['requires_review'];
        $assetType->created = $dal['created'];
        $assetType->updated = $dal['updated'];
        return $assetType;
    }

    public static function getPackage(): AssetType {
        return self::getByValue("Package");
    }

    public function getAssets(): array {
        return AssetTypeDAL::getAssetsByType($this->id);
    }
}
