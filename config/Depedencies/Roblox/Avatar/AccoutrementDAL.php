<?php
namespace Roblox\Avatar;

use \PDO;
use \Exception;

class AccoutrementDAL {
    public int $id = 0;
    public int $user_id = 0;
    public int $user_asset_id = 0;
    public string $created = '';

    private PDO $db;

    public function __construct() {
        global $conn;
        $this->db = $conn;
    }

    public function insert(): void {
        if ($this->user_id === 0) {
            throw new Exception("Required value not specified: user_id.");
        }
        if ($this->user_asset_id === 0) {
            throw new Exception("Required value not specified: user_asset_id.");
        }
        if (empty($this->created)) {
            $this->created = date('Y-m-d H:i:s');
        }

        $stmt = $this->db->prepare("INSERT INTO accoutrements (user_id, user_asset_id, created) VALUES (:user_id, :user_asset_id, :created) RETURNING id");
        $stmt->execute([
            ':user_id' => $this->user_id,
            ':user_asset_id' => $this->user_asset_id,
            ':created' => $this->created
        ]);
        $this->id = (int) $stmt->fetchColumn();
    }

    public function update(): void {
        if ($this->id === 0) {
            throw new Exception("Required value not specified: id.");
        }
        if ($this->user_id === 0) {
            throw new Exception("Required value not specified: user_id.");
        }
        if ($this->user_asset_id === 0) {
            throw new Exception("Required value not specified: user_asset_id.");
        }

        $stmt = $this->db->prepare("UPDATE accoutrements SET user_id = :user_id, user_asset_id = :user_asset_id, created = :created WHERE id = :id");
        $stmt->execute([
            ':id' => $this->id,
            ':user_id' => $this->user_id,
            ':user_asset_id' => $this->user_asset_id,
            ':created' => $this->created
        ]);
    }

    public function delete(): void {
        if ($this->id === 0) {
            throw new Exception("Required value not specified: id.");
        }

        $stmt = $this->db->prepare("DELETE FROM accoutrements WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?AccoutrementDAL {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM accoutrements WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $dal = new AccoutrementDAL();
        $dal->id = (int) $row['id'];
        $dal->user_id = (int) $row['user_id'];
        $dal->user_asset_id = (int) $row['user_asset_id'];
        $dal->created = $row['created'];
        return $dal;
    }

    public static function getByUserAssetID(int $user_asset_id): ?AccoutrementDAL {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM accoutrements WHERE user_asset_id = :user_asset_id");
        $stmt->execute([':user_asset_id' => $user_asset_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $dal = new AccoutrementDAL();
        $dal->id = (int) $row['id'];
        $dal->user_id = (int) $row['user_id'];
        $dal->user_asset_id = (int) $row['user_asset_id'];
        $dal->created = $row['created'];
        return $dal;
    }

    public static function getUserAccoutrementIDs(int $user_id): array {
        global $conn;
        $stmt = $conn->prepare("SELECT id FROM accoutrements WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $user_id]);
        return array_map(fn($row) => (int) $row['id'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
