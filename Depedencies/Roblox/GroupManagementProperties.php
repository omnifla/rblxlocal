<?php
namespace Roblox;

use Roblox\Economy\Product;
use Roblox\Economy\RobloxProduct;
use RuntimeException;

final class GroupManagementProperties
{
    public const maximumNumberOfPlacesPerGroup = 1;

    public static function getUserGroupJoinLimit(): int
    {
        return self::getInt('UserGroupJoinLimit');
    }

    public static function getBCUserGroupJoinLimit(): int
    {
        return self::getInt('BCUserGroupJoinLimit');
    }

    public static function getTBCUserGroupJoinLimit(): int
    {
        return self::getInt('TBCUserGroupJoinLimit');
    }

    public static function getOBCUserGroupJoinLimit(): int
    {
        return self::getInt('OBCUserGroupJoinLimit');
    }

    public static function getPremiumUserGroupJoinLimit(): int
    {
        return self::getInt('PremiumUserGroupJoinLimit', self::getOBCUserGroupJoinLimit());
    }

    public static function getUserGroupCreateLimit(): int
    {
        return self::getInt('UserGroupCreateLimit');
    }

    public static function getBCUserGroupCreateLimit(): int
    {
        return self::getInt('BCUserGroupCreateLimit');
    }

    public static function getTBCUserGroupCreateLimit(): int
    {
        return self::getInt('TBCUserGroupCreateLimit');
    }

    public static function getOBCUserGroupCreateLimit(): int
    {
        return self::getInt('OBCUserGroupCreateLimit');
    }

    public static function getPremiumUserGroupCreateLimit(): int
    {
        return self::getInt('PremiumUserGroupCreateLimit', self::getOBCUserGroupCreateLimit());
    }

    public static function getCostToCreateGroupInRobux(): int
    {
        return self::getInt('CostToCreateGroupInRobux');
    }

    public static function getBuildInstanceInfoOnGroupPage(): bool
    {
        return (bool) self::getSetting('BuildInstanceInfoOnGroupPage', false);
    }

    public static function setBuildInstanceInfoOnGroupPage(bool $value): void
    {
        self::setSettingIfChanged('BuildInstanceInfoOnGroupPage', $value);
    }

    public static function getBCOnlyGroupBuilding(): bool
    {
        return (bool) self::getSetting('BCOnlyGroupBuilding', false);
    }

    public static function setBCOnlyGroupBuilding(bool $value): void
    {
        self::setSettingIfChanged('BCOnlyGroupBuilding', $value);
    }

    public static function getGroupBuildingEnabled(): bool
    {
        return (bool) self::getSetting('GroupBuildingEnabled', false);
    }

    public static function setGroupBuildingEnabled(bool $value): void
    {
        self::setSettingIfChanged('GroupBuildingEnabled', $value);
    }

    public static function getBuildToolAssetList(): string
    {
        $value = self::getSetting('BuildToolAssetList', '');
        return is_array($value) ? implode(',', array_map('strval', $value)) : (string) $value;
    }

    public static function setBuildToolAssetList(string $value): void
    {
        self::setSettingIfChanged('BuildToolAssetList', $value);
    }

    public static function getCostToCreateRoleSetInRobux(): int
    {
        $product = self::getGroupRoleSetProduct();
        if ($product->PriceInRobux === null) {
            throw new RuntimeException('The GroupRoleSet product has no Robux price.');
        }
        return $product->PriceInRobux;
    }

    public static function setCostToCreateRoleSetInRobux(int $value): void
    {
        $product = self::getGroupRoleSetProduct();
        if ($product->PriceInRobux !== $value) {
            $product->PriceInRobux = $value;
            $product->Update();
        }
    }

    public static function getBuildingWithFriendsStartingEnvironmentAssetIDs(): array
    {
        $value = self::getSetting('BuildingWithFriendsStartingEnvironmentAssetIDs', []);
        if (is_array($value)) {
            return array_map('intval', $value);
        }
        if (trim((string) $value) === '') {
            return [];
        }
        return array_map('intval', explode(',', (string) $value));
    }

    public static function setBuildingWithFriendsStartingEnvironmentAssetIDs(array $assetIds): void
    {
        self::setSettingIfChanged(
            'BuildingWithFriendsStartingEnvironmentAssetIDs',
            implode(',', array_map('intval', $assetIds))
        );
    }

    public static function getMaximumNumberOfGroupRoleSets(): int
    {
        return self::getInt('MaximumNumberOfGroupRoleSets');
    }

    public static function setMaximumNumberOfGroupRoleSets(int $value): void
    {
        self::setSettingIfChanged('MaximumNumberOfGroupRoleSets', $value);
    }

    private static function getGroupRoleSetProduct(): Product
    {
        global $conn;

        $robloxProduct = RobloxProduct::$GroupRoleSet ?? RobloxProduct::getByName('GroupRoleSet');
        if ($robloxProduct === null || empty($robloxProduct->id)) {
            throw new RuntimeException('No GroupRoleSet product exists.');
        }

        $stmt = $conn->prepare('SELECT id FROM products WHERE roblox_product_id = :roblox_product_id LIMIT 1');
        $stmt->execute([':roblox_product_id' => $robloxProduct->id]);
        $productId = $stmt->fetchColumn();
        if ($productId === false) {
            throw new RuntimeException('No economy product exists for GroupRoleSet.');
        }

        $product = Product::GetById((int) $productId);
        if ($product === null) {
            throw new RuntimeException('No economy product exists for GroupRoleSet.');
        }
        return $product;
    }

    private static function getInt(string $key, ?int $fallback = null): int
    {
        return (int) self::getSetting($key, $fallback ?? 0);
    }

    private static function getSetting(string $key, mixed $fallback = null): mixed
    {
        global $properties;
        if (isset($properties) && is_array($properties) && array_key_exists($key, $properties)) {
            return $properties[$key];
        }

        $settings = new Settings();
        $value = $settings->get($key);
        return $value ?? $fallback;
    }

    private static function setSettingIfChanged(string $key, mixed $value): void
    {
        global $properties, $settingsInstance;
        $current = self::getSetting($key);
        if ($current === $value) {
            return;
        }

        if (!isset($properties) || !is_array($properties)) {
            $properties = (new Settings())->settings;
        }
        $properties[$key] = $value;

        if (isset($settingsInstance) && $settingsInstance instanceof Settings) {
            $settingsInstance->set($key, $value);
        }
    }
}
