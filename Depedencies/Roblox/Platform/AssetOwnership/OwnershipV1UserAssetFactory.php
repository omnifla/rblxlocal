<?php
// ported by meditext
namespace Roblox\Platform;

use Roblox\UserAsset;
use Roblox\DataAccess\UserAssetDAL;
use Exception;

class OwnershipV1UserAssetFactory
{
    public static function awardAsset(int $userId, int $assetId, int $assetTypeId): UserAsset
    {
        if (self::agentOwnsAsset($userId, $assetId)) {
            $assets = UserAsset::getUserAssets($userId, $assetTypeId);
            foreach ($assets as $ua) {
                if ($ua->getAssetId() === $assetId) {
                    return $ua;
                }
            }
        }
        return UserAsset::createNew($userId, $assetId, $assetTypeId);
    }
    public static function revokeAsset(int $userAssetId): void {
        $ua = UserAsset::get($userAssetId);
        if ($ua) {
            $ua->delete();
        }
    }
    public static function agentOwnsAsset(int $userId, int $assetId): bool {
        $dal = UserAssetDAL::getByUserAndAsset($userId, $assetId);
        return $dal !== null;
    }
    public static function getOwnedUserAssetsByUserId(int $userId, ?int $assetTypeId = null): array {
        if ($assetTypeId !== null) {
            return UserAsset::getUserAssets($userId, $assetTypeId);
        }

        $dals = UserAssetDAL::getByUserId($userId);
        $out = [];
        foreach ($dals as $dal) {
            $out[] = new UserAsset($dal);
        }
        return $out;
    }
}