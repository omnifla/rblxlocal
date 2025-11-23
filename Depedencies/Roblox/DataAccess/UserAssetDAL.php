<?php
// written by meditext
// Sadly, the original file for UserAssetDAL.cs was lost, and i couldn't find it in the source code leaks, so i had to write from scratch.

namespace Roblox\DataAccess;

use PDO;
use Exception;

class UserAssetDAL
{
    public int $id = 0;
    public int $user_id = 0;
    public int $asset_id = 0;
    public int $asset_type_id = 0;
    public string $created = '';
    public string $updated = '';

    private PDO $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function insert(): void
    {
        if ($this->user_id === 0 || $this->asset_id === 0 || $this->asset_type_id === 0) {
            throw new Exception("Required fields are missing: user_id, asset_id, or asset_type_id.");
        }

        $stmt = $this->db->prepare("INSERT INTO user_assets (user_id, asset_id, asset_type_id, created, updated) VALUES (:user_id, :asset_id, :asset_type_id, :created, :updated) RETURNING id");
        $stmt->execute([
            ':user_id' => $this->user_id,
            ':asset_id' => $this->asset_id,
            ':asset_type_id' => $this->asset_type_id,
            ':created' => $this->created,
            ':updated' => $this->updated
        ]);
        $this->id = (int)$stmt->fetchColumn();
    }

    public function update(): void
    {
        if ($this->id === 0) {
            throw new Exception("Cannot update a UserAsset without an ID.");
        }

        $stmt = $this->db->prepare("UPDATE user_assets SET user_id = :user_id, asset_id = :asset_id, asset_type_id = :asset_type_id, updated = :updated WHERE id = :id");
        $stmt->execute([
            ':id' => $this->id,
            ':user_id' => $this->user_id,
            ':asset_id' => $this->asset_id,
            ':asset_type_id' => $this->asset_type_id,
            ':updated' => $this->updated
        ]);
    }

    public function delete(): void
    {
        if ($this->id === 0) {
            throw new Exception("Cannot delete a UserAsset without an ID.");
        }

        $stmt = $this->db->prepare("DELETE FROM user_assets WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?self
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_assets WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $dal = new self();
        $dal->id = (int)$row['id'];
        $dal->user_id = (int)$row['user_id'];
        $dal->asset_id = (int)$row['asset_id'];
        $dal->asset_type_id = (int)$row['asset_type_id'];
        $dal->created = $row['created'];
        $dal->updated = $row['updated'];
        return $dal;
    }
    
    public static function exists(int $userId, int $assetId): bool
    {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user_assets WHERE user_id = :user_id AND asset_id = :asset_id");
        $stmt->execute([':user_id' => $userId, ':asset_id' => $assetId]);
        return (int)$stmt->fetchColumn() > 0;
    }

    public static function getUserAssetIDs(int $user_id, int $asset_type_id): array
    {
        global $conn;
        $stmt = $conn->prepare("SELECT id FROM user_assets WHERE user_id = :user_id AND asset_type_id = :asset_type_id");
        $stmt->execute([':user_id' => $user_id, ':asset_type_id' => $asset_type_id]);
        return array_map(fn($row) => (int)$row['id'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
