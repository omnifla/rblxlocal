<?php
// ported by meditext
namespace Roblox\Platform;

use Roblox\UserAsset;
use Roblox\DataAccess\UserAssetDAL;

class OwnershipV1UserAssetFactory
{
    public static function awardAsset(int $userId, int $assetId, int $assetTypeId): UserAsset
    {
        if (self::agentOwnsAsset($userId, $assetId)) {
            return UserAsset::getUserAssets($userId, $assetTypeId)[0];
        }
        return UserAsset::createNew($userId, $assetId, $assetTypeId);
    }

    public static function revokeAsset(int $userAssetId): void
    {
        $ua = UserAsset::get($userAssetId);
        if ($ua) {
            $ua->delete();
        }
    }

    public static function agentOwnsAsset(int $userId, int $assetId): bool
    {
        $dal = UserAssetDAL::getByUserAndAsset($userId, $assetId);
        return $dal !== null;
    }

    public static function getOwnedUserAssetsByUserId(int $userId, ?int $assetTypeId = null): array
    {
        if ($assetTypeId !== null) {
            return UserAsset::getUserAssets($userId, $assetTypeId);
        }

        $dals = UserAssetDAL::getByUserId($userId);
        return array_map(fn($dal) => new UserAsset($dal), $dals);
    }
}
