<?php
// ported by meditext
namespace Roblox\DataAccess;

use PDO;

class PromoCodeDAL {
    public int $ID = 0;
    public string $Code = '';
    public ?string $Expiration = null;
    public int $MaxRedemptions = 0;
    public int $reward_robux = 0;
    public int $reward_tickets = 0;
    public ?int $reward_asset_id = null;
    public ?int $reward_asset_type_id = null;
    public ?int $reward_membership_type = null;
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
        $dal->reward_robux = isset($row['reward_robux']) ? (int)$row['reward_robux'] : 0;
        $dal->reward_tickets = isset($row['reward_tickets']) ? (int)$row['reward_tickets'] : 0;
        $dal->reward_asset_id = isset($row['reward_asset_id']) && $row['reward_asset_id'] !== null ? (int)$row['reward_asset_id'] : null;
        $dal->reward_asset_type_id = isset($row['reward_asset_type_id']) && $row['reward_asset_type_id'] !== null ? (int)$row['reward_asset_type_id'] : null;
        $dal->reward_membership_type = isset($row['reward_membership_type']) && $row['reward_membership_type'] !== null ? (int)$row['reward_membership_type'] : null;
        $dal->Created = $row['created'];
        $dal->Updated = $row['updated'];
        return $dal;
    }

    public function Insert(): void {
        $sql = "INSERT INTO promocodes (code, expiration, max_redemptions, reward_robux, reward_tickets, reward_asset_id, reward_asset_type_id, reward_membership_type, created, updated) VALUES (:code, :expiration, :max_redemptions, :reward_robux, :reward_tickets, :reward_asset_id, :reward_asset_type_id, :reward_membership_type, :created, :updated) RETURNING id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':code' => $this->Code,
            ':expiration' => $this->Expiration,
            ':max_redemptions' => $this->MaxRedemptions,
            ':reward_robux' => $this->reward_robux,
            ':reward_tickets' => $this->reward_tickets,
            ':reward_asset_id' => $this->reward_asset_id,
            ':reward_asset_type_id' => $this->reward_asset_type_id,
            ':reward_membership_type' => $this->reward_membership_type,
            ':created' => $this->Created,
            ':updated' => $this->Updated,
        ]);
        $this->ID = (int)$stmt->fetchColumn();
    }

    public function Update(): void {
        $sql = "UPDATE promocodes SET code = :code, expiration = :expiration, max_redemptions = :max_redemptions, reward_robux = :reward_robux, reward_tickets = :reward_tickets, reward_asset_id = :reward_asset_id, reward_asset_type_id = :reward_asset_type_id, reward_membership_type = :reward_membership_type, updated = :updated WHERE id = :id";
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':id' => $this->ID,
            ':code' => $this->Code,
            ':expiration' => $this->Expiration,
            ':max_redemptions' => $this->MaxRedemptions,
            ':reward_robux' => $this->reward_robux,
            ':reward_tickets' => $this->reward_tickets,
            ':reward_asset_id' => $this->reward_asset_id,
            ':reward_asset_type_id' => $this->reward_asset_type_id,
            ':reward_membership_type' => $this->reward_membership_type,
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
