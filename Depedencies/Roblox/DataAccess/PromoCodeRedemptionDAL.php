<?php
// ported by meditext
namespace Roblox\DataAccess;

use PDO;

class PromoCodeRedemptionDAL {
    public int $ID = 0;
    public int $PromoCodeID = 0;
    public int $UserID = 0;
    public string $Created = '';
    public string $Updated = '';

    private static function db(): PDO {
        global $conn;
        return $conn;
    }

    private static function fromRow(array $row): self {
        $dal = new self();
        $dal->ID = (int)$row['id'];
        $dal->PromoCodeID = (int)$row['promocode_id'];
        $dal->UserID = (int)$row['user_id'];
        $dal->Created = $row['created'];
        $dal->Updated = $row['updated'];
        return $dal;
    }

    public function Insert(): void {
        $sql = "INSERT INTO promocode_redemptions (promocode_id, user_id, created, updated) VALUES (:promocode_id, :user_id, :created, :updated) RETURNING id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':promocode_id' => $this->PromoCodeID,
            ':user_id' => $this->UserID,
            ':created' => $this->Created,
            ':updated' => $this->Updated,
        ]);
        $this->ID = (int)$stmt->fetchColumn();
    }

    public function Update(): void {
        $sql = "UPDATE promocode_redemptions SET promocode_id = :promocode_id, user_id = :user_id, updated = :updated WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':id' => $this->ID,
            ':promocode_id' => $this->PromoCodeID,
            ':user_id' => $this->UserID,
            ':updated' => $this->Updated,
        ]);
    }

    public function Delete(): void {
        $sql = "DELETE FROM promocode_redemptions WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':id' => $this->ID]);
    }

    public static function Get(int $id): ?self {
        $sql = "SELECT * FROM promocode_redemptions WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    public static function GetByPromoCodeIDAndUserID(int $promoCodeId, int $userId): ?self {
        $sql = "SELECT * FROM promocode_redemptions WHERE promocode_id = :promocode_id AND user_id = :user_id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':promocode_id' => $promoCodeId, ':user_id' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    public static function MultiGet(array $ids): array {
        if (empty($ids)) return [];
        $in = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT * FROM promocode_redemptions WHERE id IN ($in)";
        $stmt = self::db()->prepare($sql);
        $stmt->execute($ids);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => self::fromRow($row), $rows);
    }

    public static function GetTotalNumberOfPromoCodeRedemptionsByPromoCodeID(int $promoCodeId): int {
        $sql = "SELECT COUNT(*) FROM promocode_redemptions WHERE promocode_id = :promocode_id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':promocode_id' => $promoCodeId]);
        return (int)$stmt->fetchColumn();
    }
}
