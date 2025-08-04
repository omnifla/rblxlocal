<?php
// ported by meditext
namespace Roblox\DataAccess;

use PDO;

class AssetTypeDAL {
    public static function insert(AssetType $assetType): int {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO asset_types (value, description, abbreviation, requires_review, created, updated) VALUES (:value, :description, :abbreviation, :requires_review, :created, :updated) RETURNING id");
        $stmt->execute([
            ':value' => $assetType->value,
            ':description' => $assetType->description,
            ':abbreviation' => $assetType->abbreviation,
            ':requires_review' => $assetType->requiresReview,
            ':created' => $assetType->created,
            ':updated' => $assetType->updated
        ]);
        return (int)$stmt->fetchColumn();
    }

    public static function update(AssetType $assetType): void {
        global $conn;
        $stmt = $conn->prepare("UPDATE asset_types SET value = :value, description = :description, abbreviation = :abbreviation, requires_review = :requires_review, updated = :updated WHERE id = :id");
        $stmt->execute([
            ':id' => $assetType->id,
            ':value' => $assetType->value,
            ':description' => $assetType->description,
            ':abbreviation' => $assetType->abbreviation,
            ':requires_review' => $assetType->requiresReview,
            ':updated' => $assetType->updated
        ]);
    }

    public static function delete(int $id): void {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM asset_types WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    public static function get(int $id): ?array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM asset_types WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function getByValue(string $value): ?array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM asset_types WHERE value = :value");
        $stmt->execute([':value' => $value]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function getAll(): array {
        global $conn;
        $stmt = $conn->query("SELECT * FROM asset_types");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAssetTypeIDs(): array {
        global $conn;
        $stmt = $conn->query("SELECT id FROM asset_types");
        return array_map(fn($row) => (int)$row['id'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function getAssetsByType(int $assetTypeId): array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM assets WHERE AssetType = :assetTypeId");
        $stmt->execute([':assetTypeId' => $assetTypeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
