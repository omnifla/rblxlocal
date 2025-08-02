<?php
// ported by meditext
namespace Roblox;
// TODO: add more asset types from the Roblox Source code.
class AssetTypes
{
    // static ids and values
    public const AudioValue = "Audio";
    public const AvatarValue = "Avatar";
    public const DecalValue = "Decal";
    public const HatValue = "Hat";
    public const HtmlValue = "HTML";
    public const ImageValue = "Image";
    public const LuaValue = "Lua";
    public const MeshValue = "Mesh";
    public const ModelValue = "Model";
    public const PantsValue = "Pants";
    public const PlaceValue = "Place";
    public const ShirtValue = "Shirt";
    public const TeeShirtValue = "T-Shirt";
    public const TextValue = "Text";
    public const HeadValue = "Head";
    public const FaceValue = "Face";
    public const GearValue = "Gear";
    public const BadgeValue = "Badge";
    public const AnimationValue = "Animation";
    public const ArmsValue = "Arms";
    public const LeftArmValue = "Left Arm";
    public const RightArmValue = "Right Arm";
    public const LegsValue = "Legs";
    public const LeftLegValue = "Left Leg";
    public const RightLegValue = "Right Leg";
    public const TorsoValue = "Torso";
    public const PackageValue = "Package";

    public static $AudioID = 1;
    public static $AvatarID = 2;
    public static $DecalID = 3;
    public static $HatID = 4;
    public static $HtmlID = 5;
    public static $ImageID = 6;
    public static $LuaID = 7;
    public static $MeshID = 8;
    public static $ModelID = 9;
    public static $PantsID = 10;
    public static $PlaceID = 11;
    public static $ShirtID = 12;
    public static $TeeShirtID = 13;
    public static $TextID = 14;
    public static $HeadID = 15;
    public static $FaceID = 16;
    public static $GearID = 17;
    public static $BadgeID = 18;
    public static $AnimationID = 19;
    public static $ArmsID = 20;
    public static $LeftArmID = 21;
    public static $RightArmID = 22;
    public static $LegsID = 23;
    public static $LeftLegID = 24;
    public static $RightLegID = 25;
    public static $TorsoID = 26;
    public static $PackageID = 27;

    public $id;
    public $value;

    public function __construct($id = null, $value = null)
    {
        $this->id = $id;
        $this->value = $value;
    }

    public static function getById($id)
    {
        $map = self::getIdValueMap();
        if (isset($map[$id])) {
            return new self($id, $map[$id]);
        }
        return null;
    }

    public static function getByValue($value)
    {
        $map = array_flip(self::getIdValueMap());
        if (isset($map[$value])) {
            return new self($map[$value], $value);
        }
        return null;
    }

    public static function getIdValueMap()
    {
        return [
            self::$AudioID => self::AudioValue,
            self::$AvatarID => self::AvatarValue,
            self::$DecalID => self::DecalValue,
            self::$HatID => self::HatValue,
            self::$HtmlID => self::HtmlValue,
            self::$ImageID => self::ImageValue,
            self::$LuaID => self::LuaValue,
            self::$MeshID => self::MeshValue,
            self::$ModelID => self::ModelValue,
            self::$PantsID => self::PantsValue,
            self::$PlaceID => self::PlaceValue,
            self::$ShirtID => self::ShirtValue,
            self::$TeeShirtID => self::TeeShirtValue,
            self::$TextID => self::TextValue,
            self::$HeadID => self::HeadValue,
            self::$FaceID => self::FaceValue,
            self::$GearID => self::GearValue,
            self::$BadgeID => self::BadgeValue,
            self::$AnimationID => self::AnimationValue,
            self::$ArmsID => self::ArmsValue,
            self::$LeftArmID => self::LeftArmValue,
            self::$RightArmID => self::RightArmValue,
            self::$LegsID => self::LegsValue,
            self::$LeftLegID => self::LeftLegValue,
            self::$RightLegID => self::RightLegValue,
            self::$TorsoID => self::TorsoValue,
            self::$PackageID => self::PackageValue,
        ];
    }

    public static function getImage()
    {
        return new self(self::$ImageID, self::ImageValue);
    }

    public static function getDecal()
    {
        return new self(self::$DecalID, self::DecalValue);
    }

    public static function getPants()
    {
        return new self(self::$PantsID, self::PantsValue);
    }

    public static function getShirt()
    {
        return new self(self::$ShirtID, self::ShirtValue);
    }

    public static function getTeeShirt()
    {
        return new self(self::$TeeShirtID, self::TeeShirtValue);
    }

    public static function getPlural($value)
    {
        switch ($value) {
            case self::AudioValue:
            case self::HtmlValue:
            case self::LuaValue:
            case self::PantsValue:
            case self::GearValue:
            case self::LegsValue:
            case self::ArmsValue:
            case self::TextValue:
                return $value;
            case self::MeshValue:
                return $value . "es";
            case "All":
                return "All";
            default:
                return $value . "s";
        }
    }
}