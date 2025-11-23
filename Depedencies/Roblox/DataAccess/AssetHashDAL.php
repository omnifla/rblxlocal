<?php
// ported by meditext
namespace Roblox\DataAccess;

use PDO;
use Roblox\Database;

class AssetHashDAL
{
    public static function getByAssetId(int $assetId): ?array
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM asset_hashes WHERE asset_id = :id LIMIT 1");
        $stmt->execute(['id' => $assetId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public static function getByHash(string $hash): array
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM asset_hashes WHERE hash = :hash");
        $stmt->execute(['hash' => $hash]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert(array $row): int
    {
        global $conn;
        $sql = "INSERT INTO asset_hashes (asset_id, hash, size, review_status, creator_id, created, updated) VALUES (:asset_id, :hash, :size, :review_status, :creator_id, NOW(), NOW()) RETURNING id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'asset_id' => $row['asset_id'],
            'hash' => $row['hash'],
            'size' => $row['size'],
            'review_status' => $row['review_status'],
            'creator_id' => $row['creator_id']
        ]);

        return (int) $stmt->fetchColumn();
    }

    public static function update(int $id, array $row): void
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE asset_hashes
            SET hash = :hash, size = :size, review_status = :review_status, creator_id = :creator_id, updated = NOW()
            WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'hash' => $row['hash'],
            'size' => $row['size'],
            'review_status' => $row['review_status'],
            'creator_id' => $row['creator_id']
        ]);
    }

    public static function deleteById(int $id): void
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM asset_hashes WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function listByHash(string $hash): array
    {
        return self::getByHash($hash);
    }
}