<?php
// ported by meditext
// TODO: Add ROBLOX2Local Asset System (copy the assets from roblox itself once requesting them, publish into the database.)

namespace Roblox;
use Roblox\DataAccess\AssetDAL;
// The asset class should ideally have it's own assembly to make it easily portable between projects, this a crude beginning
class Asset
{
    public static array $DefaultHeadIds = [];
    public static array $DefaultPlaceIds = [];
    public static array $DefaultShirtIds = [];

    public static function getDefaultBoyAssetIds(): array
    {
        return self::getDefaults(Settings::get('DefaultBoyAssets'));
    }

    public static function getDefaultGirlAssetIds(): array
    {
        return self::getDefaults(Settings::get('DefaultGirlAssets'));
    }

    public static function getVerifiedHatId(): int
    {
        return (int)Settings::get('VerifiedUserHatAssetId');
    }

    public static function init(): void
    {
        self::setDefaults(self::$DefaultPlaceIds, Settings::get('DefaultEnvironments'));
        self::setDefaults(self::$DefaultShirtIds, Settings::get('DefaultShirts'));
        self::setDefaults(self::$DefaultHeadIds, Settings::get('DefaultHeads'));

        Settings::onChange(function ($key, $value) {
            switch ($key) {
                case 'DefaultEnvironments':
                    self::setDefaults(self::$DefaultPlaceIds, $value);
                    break;
                case 'DefaultShirts':
                    self::setDefaults(self::$DefaultShirtIds, $value);
                    break;
                case 'DefaultHeads':
                    self::setDefaults(self::$DefaultHeadIds, $value);
                    break;
            }
        });
    }

    private static function setDefaults(array &$arrayToPopulate, string $sourceData): void
    {
        $array = explode(',', $sourceData);
        $ids = [];

        foreach ($array as $item) {
            if (!empty($item)) {
                $ids[] = (int)$item;
            }
        }

        $arrayToPopulate = $ids;
    }

    private static function getDefaults(string $sourceData): array
    {
        $array = explode(',', $sourceData);
        $ids = [];

        foreach ($array as $item) {
            if (!empty($item)) {
                $ids[] = (int)$item;
            }
        }

        return $ids;
    }

    //TODO: Implement Assets class here
    public static function getAssetGenres(int $assetId): int
    {
        return AssetDAL::getAssetGenres($assetId);
    }

    public static function getAssetCategories(int $assetId): int
    {
        return AssetDAL::getAssetCategories($assetId);
    }
}

Asset::init();
