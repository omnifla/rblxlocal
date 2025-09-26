<?php
namespace Roblox\Assets;

use PDO;
use Exception;

class AssetCounterTypeDAL
{
    public int $id = 0;
    public string $value = '';
    public string $created = '';
    public string $updated = '';

    public function delete(): void {
        global $conn;
        if ($this->id === 0) {
            throw new Exception("Required value not specified: ID.");
        }
        $stmt = $conn->prepare("DELETE FROM asset_counter_types WHERE id = :id");
        $stmt->execute(['id' => $this->id]);
    }

    public function insert(): void {
        global $conn;
        if (trim($this->value) === '') {
            throw new Exception("Required value not specified: Value.");
        }
        if (empty($this->created)) {
            throw new Exception("Required value not specified: Created.");
        }
        if (empty($this->updated)) {
            throw new Exception("Required value not specified: Updated.");
        }
        $stmt = $conn->prepare("INSERT INTO asset_counter_types (value, created, updated) VALUES (:value, :created, :updated)");
        $stmt->execute([
            'value' => substr($this->value, 0, 50),
            'created' => $this->created,
            'updated' => $this->updated,
        ]);
        $this->id = (int)$conn->lastInsertId();
    }

    public function update(): void {
        global $conn;
        if ($this->id === 0) {
            throw new Exception("Required value was not specified: ID.");
        }
        if (trim($this->value) === '') {
            throw new Exception("Required value not specified: Value.");
        }
        if (empty($this->created)) {
            throw new Exception("Required value not specified: Created.");
        }
        if (empty($this->updated)) {
            throw new Exception("Required value not specified: Updated.");
        }
        $stmt = $conn->prepare(" UPDATE asset_counter_types SET value = :value, created = :created, updated = :updated WHERE id = :id");
        $stmt->execute([
            'id' => $this->id,
            'value' => substr($this->value, 0, 50),
            'created' => $this->created,
            'updated' => $this->updated,
        ]);
    }

    public static function buildFromRow(array $row): AssetCounterTypeDAL {
        $dal = new self();
        $dal->id = (int)$row['id'];
        $dal->value = $row['value'];
        $dal->created = $row['created'];
        $dal->updated = $row['updated'];
        return $dal;
    }

    public static function get(int $id): ?AssetCounterTypeDAL {
        global $conn;
        if ($id === 0) return null;

        $stmt = $conn->prepare("SELECT * FROM asset_counter_types WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getByValue(string $value): ?AssetCounterTypeDAL {
        global $conn;
        if (trim($value) === '') return null;

        $stmt = $conn->prepare("SELECT * FROM asset_counter_types WHERE value = :value LIMIT 1");
        $stmt->execute(['value' => $value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }
}