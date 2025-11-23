<?php
namespace Roblox\Assets;

use PDO;
use Exception;

class AssetCounterDAL
{
    public int $id = 0;
    public int $asset_id = 0;
    public int $asset_counter_type_id = 0;
    public int $value = 0;
    public string $created = '';
    public string $updated = '';

    private static function buildFromRow(array $row): ?self {
        $dal = new self();
        $dal->id = (int)$row['id'];
        $dal->asset_id = (int)$row['asset_id'];
        $dal->asset_counter_type_id = (int)$row['asset_counter_type_id'];
        $dal->value = (int)$row['value'];
        $dal->created = $row['created'];
        $dal->updated = $row['updated'];
        return $dal->id > 0 ? $dal : null;
    }

    public function increment(int $amount): void {
        global $conn;
        if ($amount < 1) {
            throw new Exception("Required value not specified: Amount.");
        }
        $stmt = $conn->prepare("UPDATE asset_counters SET value = value + :amount, updated = NOW() WHERE id = :id RETURNING value, updated");
        $stmt->execute(['amount' => $amount, 'id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->value = (int)$row['value'];
            $this->updated = $row['updated'];
        }
    }

    public function decrement(int $amount): void {
        global $conn;
        if ($amount < 1) {
            throw new Exception("Required value not specified: Amount.");
        }
        $stmt = $conn->prepare("UPDATE asset_counters SET value = value - :amount, updated = NOW() WHERE id = :id RETURNING value, updated");
        $stmt->execute(['amount' => $amount, 'id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->value = (int)$row['value'];
            $this->updated = $row['updated'];
        }
    }

    public function delete(): void {
        global $conn;
        if ($this->id === 0) {
            throw new Exception("Required value not specified: ID.");
        }
        $stmt = $conn->prepare("DELETE FROM asset_counters WHERE id = :id");
        $stmt->execute(['id' => $this->id]);
    }

    public static function get(int $id): ?self {
        global $conn;
        if ($id === 0) return null;
        $stmt = $conn->prepare("SELECT * FROM asset_counters WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getOrCreate(int $assetId, int $assetCounterTypeId): ?self {
        global $conn;
        if ($assetId === 0) {
            throw new Exception("Required value not specified: AssetID.");
        }
        if ($assetCounterTypeId === 0) {
            throw new Exception("Required value not specified: AssetCounterTypeID.");
        }

        $stmt = $conn->prepare("SELECT * FROM asset_counters WHERE asset_id = :aid AND asset_counter_type_id = :tid LIMIT 1");
        $stmt->execute(['aid' => $assetId, 'tid' => $assetCounterTypeId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return self::buildFromRow($row);
        }

        $stmt = $conn->prepare("INSERT INTO asset_counters (asset_id, asset_counter_type_id, value, created, updated) VALUES (:aid, :tid, 0, NOW(), NOW()) RETURNING *");
        $stmt->execute(['aid' => $assetId, 'tid' => $assetCounterTypeId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? self::buildFromRow($row) : null;
    }
}