<?php
// ported by meditext
// DO NOT USE THIS.
namespace Roblox\Assets\DataAccess;

use PDO;
use Exception;

class AssetDAL
{
    private static function getDbConnection(): PDO
    {
        global $conn;
        return $conn;
    }

    public static function getAssetGenres(int $assetId): int
    {
        if ($assetId === 0) {
            throw new Exception("Required value not specified: AssetID.");
        }

        $db = self::getDbConnection();
        $stmt = $db->prepare("SELECT * FROM Assets_GetAssetGenresByAssetID(:AssetID)");
        $stmt->bindValue(':AssetID', $assetId, PDO::PARAM_INT);
        $stmt->execute();

        return (int)$stmt->fetchColumn();
    }

    public static function getAssetCategories(int $assetId): int
    {
        if ($assetId === 0) {
            throw new Exception("Required value not specified: AssetID.");
        }

        $db = self::getDbConnection();
        $stmt = $db->prepare("SELECT * FROM Assets_GetAssetCategoriesByAssetID(:AssetID)");
        $stmt->bindValue(':AssetID', $assetId, PDO::PARAM_INT);
        $stmt->execute();

        return (int)$stmt->fetchColumn();
    }
}
