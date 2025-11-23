<?php
// ported by meditext
namespace Roblox\DataAccess;

use PDO;

class PromoCodeDAL {
    public int $ID = 0;
    public string $Code = '';
    public ?string $Expiration = null;
    public int $MaxRedemptions = 0;
    public string $Created = '';
    public string $Updated = '';

    private static function db(): PDO {
        global $conn;
        return $conn;
    }

    private static function fromRow(array $row): self {
        $dal = new self();
        $dal->ID = (int)$row['id'];
        $dal->Code = $row['code'];
        $dal->Expiration = $row['expiration'];
        $dal->MaxRedemptions = (int)$row['max_redemptions'];
        $dal->Created = $row['created'];
        $dal->Updated = $row['updated'];
        return $dal;
    }

    public function Insert(): void {
        $sql = "INSERT INTO promocodes (code, expiration, max_redemptions, created, updated) VALUES (:code, :expiration, :max_redemptions, :created, :updated) RETURNING id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':code' => $this->Code,
            ':expiration' => $this->Expiration,
            ':max_redemptions' => $this->MaxRedemptions,
            ':created' => $this->Created,
            ':updated' => $this->Updated,
        ]);
        $this->ID = (int)$stmt->fetchColumn();
    }

    public function Update(): void {
        $sql = "UPDATE promocodes SET code = :code, expiration = :expiration, max_redemptions = :max_redemptions, updated = :updated WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':id' => $this->ID,
            ':code' => $this->Code,
            ':expiration' => $this->Expiration,
            ':max_redemptions' => $this->MaxRedemptions,
            ':updated' => $this->Updated,
        ]);
    }

    public function Delete(): void {
        $sql = "DELETE FROM promocodes WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':id' => $this->ID]);
    }

    public static function Get(int $id): ?self {
        $sql = "SELECT * FROM promocodes WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    public static function GetByCode(string $code): ?self {
        $sql = "SELECT * FROM promocodes WHERE code = :code";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([':code' => $code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    public static function MultiGet(array $ids): array {
        if (empty($ids)) return [];
        $in = implode(',', array_fill(0, count($ids), '?'));
        $sql = "SELECT * FROM promocodes WHERE id IN ($in)";
        $stmt = self::db()->prepare($sql);
        $stmt->execute($ids);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => self::fromRow($row), $rows);
    }
}
