<?php
// ported by meditext
// i had to re-read the code to port it correctly, and it happens to be that i entirely wiped out everything.
namespace Roblox;

use Exception;
use Roblox\DataAccess\AssetTypeDAL;

class AssetType {
    public int $id = 0;
    public string $value = '';
    public ?string $valuePlural = null;
    public ?string $description = null;
    public ?string $abbreviation = null;
    public bool $requiresReview = false;
    public ?string $created = null;
    public ?string $updated = null;

    private static array $assetTypeCache = [];
    private static array $constants = [
        'Audio' => 'Audio',
        'Avatar' => 'Avatar',
        'Decal' => 'Decal',
        'Hat' => 'Hat',
        'Html' => 'HTML',
        'Image' => 'Image',
        'Lua' => 'Lua',
        'Mesh' => 'Mesh',
        'Model' => 'Model',
        'Pants' => 'Pants',
        'Place' => 'Place',
        'Shirt' => 'Shirt',
        'TeeShirt' => 'T-Shirt',
        'Text' => 'Text',
        'Head' => 'Head',
        'Face' => 'Face',
        'Gear' => 'Gear',
        'Badge' => 'Badge',
        'Animation' => 'Animation',
        'Arms' => 'Arms',
        'LeftArm' => 'Left Arm',
        'RightArm' => 'Right Arm',
        'Legs' => 'Legs',
        'LeftLeg' => 'Left Leg',
        'RightLeg' => 'Right Leg',
        'Torso' => 'Torso',
        'Package' => 'Package',
    ];

    public static int $AudioID;
    public static int $AvatarID;
    public static int $DecalID;
    public static int $HatID;
    public static int $HtmlID;
    public static int $ImageID;
    public static int $LuaID;
    public static int $MeshID;
    public static int $ModelID;
    public static int $PantsID;
    public static int $PlaceID;
    public static int $ShirtID;
    public static int $TeeShirtID;
    public static int $TextID;
    public static int $HeadID;
    public static int $FaceID;
    public static int $GearID;
    public static int $BadgeID;
    public static int $AnimationID;
    public static int $ArmsID;
    public static int $LeftArmID;
    public static int $RightArmID;
    public static int $LegsID;
    public static int $LeftLegID;
    public static int $RightLegID;
    public static int $TorsoID;
    public static int $PackageID;

    public function __construct() {
        // stub.
    }

    public static function init(): void {
        self::$AudioID = self::MustGet('Audio')->id;
        self::$AvatarID = self::MustGet('Avatar')->id;
        self::$DecalID = self::MustGet('Decal')->id;
        self::$HatID = self::MustGet('Hat')->id;
        self::$HtmlID = self::MustGet('HTML')->id;
        self::$ImageID = self::MustGet('Image')->id;
        self::$LuaID = self::MustGet('Lua')->id;
        self::$MeshID = self::MustGet('Mesh')->id;
        self::$ModelID = self::MustGet('Model')->id;
        self::$PantsID = self::MustGet('Pants')->id;
        self::$PlaceID = self::MustGet('Place')->id;
        self::$ShirtID = self::MustGet('Shirt')->id;
        self::$TeeShirtID = self::MustGet('T-Shirt')->id;
        self::$TextID = self::MustGet('Text')->id;
        self::$HeadID = self::MustGet('Head')->id;
        self::$FaceID = self::MustGet('Face')->id;
        self::$GearID = self::MustGet('Gear')->id;
        self::$BadgeID = self::MustGet('Badge')->id;
        self::$AnimationID = self::MustGet('Animation')->id;
        self::$ArmsID = self::MustGet('Arms')->id;
        self::$LeftArmID = self::MustGet('Left Arm')->id;
        self::$RightArmID = self::MustGet('Right Arm')->id;
        self::$LegsID = self::MustGet('Legs')->id;
        self::$LeftLegID = self::MustGet('Left Leg')->id;
        self::$RightLegID = self::MustGet('Right Leg')->id;
        self::$TorsoID = self::MustGet('Torso')->id;
        self::$PackageID = self::MustGet('Package')->id;
    }

    public static function MustGet(string $value): AssetType {
        $assetType = self::getByValue($value);
        if (!$assetType) {
            throw new Exception("Failed to load AssetType: $value");
        }
        return $assetType;
    }

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

    public static function getValuePluralized(string $value): string {
        switch ($value) {
            case 'Audio':
            case 'HTML':
            case 'Lua':
            case 'Pants':
            case 'Gear':
            case 'Legs':
            case 'Arms':
            case 'Text':
                return $value;
            case 'Mesh':
                return $value . 'es';
            case 'All':
                return 'All';
            default:
                return $value . 's';
        }
    }

    public static function register(string $value, string $description, bool $requiresReview): AssetType {
        $assetType = self::getByValue($value);
        if (!$assetType) {
            $assetType = new AssetType();
            $assetType->value = $value;
            $assetType->description = $description;
            $assetType->requiresReview = $requiresReview;
            $assetType->save();
        }
        return $assetType;
    }

    public static function getCatalogAll(): AssetType {
        $all = new AssetType();
        $all->id = 0;
        $all->value = 'All';
        return $all;
    }

    public function isPurchaseable(): bool {
        return in_array($this->id, [
            self::getByValue('Decal')->id,
            self::getByValue('Model')->id,
            self::getByValue('Place')->id,
            self::getByValue('Head')->id,
            self::getByValue('Face')->id,
            self::getByValue('Hat')->id,
            self::getByValue('TeeShirt')->id,
            self::getByValue('Shirt')->id,
            self::getByValue('Pants')->id,
            self::getByValue('Gear')->id,
            self::getByValue('Package')->id,
        ]);
    }

    public function isCreateable(): bool {
        return in_array($this->id, [
            self::getByValue('Pants')->id,
            self::getByValue('Shirt')->id,
            self::getByValue('TeeShirt')->id,
        ]);
    }
    public static function GetAssetType(string $xml) : ?AssetType{
        $endOfFirstTagIndex = strpos($xml,'>');
        if ($endOfFirstTagIndex == -1){
            throw new \Exception("Invalid XML");
        }
        // Should just be using xml parsing....
        $indexOfAssetType = strpos(strtolower(substr($xml,0, $endOfFirstTagIndex)),"assettype=");
        if ($indexOfAssetType == -1){
            // Is it a model, place? Dunno..
            return null;
        }
        $indexOfAssetType += 11;
        $endIndex = strpos($xml,'\"', $indexOfAssetType);
        $assetType = substr($xml,$indexOfAssetType, $endIndex - $indexOfAssetType);
        $actualtype = self::get(assetType);
        return $actualtype;
    }
}

AssetType::init();
