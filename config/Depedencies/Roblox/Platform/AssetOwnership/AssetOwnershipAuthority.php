<?php
// ported by meditext
namespace Roblox\Platform;

use Roblox\UserAsset;

class AssetOwnershipAuthority
{
    public static function doesUserOwnAsset(int $userId, int $assetId): bool
    {
        return OwnershipV1UserAssetFactory::agentOwnsAsset($userId, $assetId);
    }

    public static function awardAsset(int $userId, int $assetId, int $assetTypeId): UserAsset
    {
        return OwnershipV1UserAssetFactory::awardAsset($userId, $assetId, $assetTypeId);
    }

    public static function revokeAsset(int $userAssetId): void
    {
        OwnershipV1UserAssetFactory::revokeAsset($userAssetId);
    }

    public static function getUserAssets(int $userId, ?int $assetTypeId = null): array
    {
        return OwnershipV1UserAssetFactory::getOwnedUserAssetsByUserId($userId, $assetTypeId);
    }
}
