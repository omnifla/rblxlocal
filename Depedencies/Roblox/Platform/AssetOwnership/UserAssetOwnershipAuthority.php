<?php
namespace Roblox\Platform;

use Roblox\UserAsset;

class UserAssetOwnershipAuthority
{
    public static function doesUserOwnAsset(int $userId, int $assetId): bool
    {
        return OwnershipV1UserAssetFactory::agentOwnsAsset($userId, $assetId);
    }

    public static function awardUserAsset(int $userId, int $assetId, int $assetTypeId): UserAsset
    {
        return OwnershipV1UserAssetFactory::awardAsset($userId, $assetId, $assetTypeId);
    }

    public static function revokeUserAsset(int $userAssetId): void
    {
        OwnershipV1UserAssetFactory::revokeAsset($userAssetId);
    }

    public static function revokeAllUserAssets(int $userId, int $assetId): void
    {
        $assets = OwnershipV1UserAssetFactory::getOwnedUserAssetsByUserId($userId);
        foreach ($assets as $ua) {
            if ($ua->getAssetId() === $assetId) {
                $ua->delete();
            }
        }
    }
    public static function getUserAssets(int $userId, ?int $assetTypeId = null): array
    {
        return OwnershipV1UserAssetFactory::getOwnedUserAssetsByUserId($userId, $assetTypeId);
    }
    public static function transferUserAsset(int $fromUserId, int $toUserId, int $assetId, int $assetTypeId): ?UserAsset
    {
        if (!self::doesUserOwnAsset($fromUserId, $assetId)) {
            return null; // nothing to transfer
        }

        // revoke from original owner
        $assets = self::getUserAssets($fromUserId, $assetTypeId);
        foreach ($assets as $ua) {
            if ($ua->getAssetId() === $assetId) {
                $ua->delete();
                break;
            }
        }
        // award to new owner
        return self::awardUserAsset($toUserId, $assetId, $assetTypeId);
    }
}
