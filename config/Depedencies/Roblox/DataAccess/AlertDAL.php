<?php
// written and ported by SkylerClock
namespace Roblox\DataAccess;

use PDO;
use Exception;

class AlertDAL
{
    public int $ID = 0;
    public int $UserID = 0;
    public string $Text = '';
    public string $Created = '';
    public string $Updated = '';
    public int $VisibilityTypeID = 0;

    private static function getConnection(): PDO {
        global $conn;
        return $conn;
    }

    public function insert(): void {
        $db = self::getConnection();
        $stmt = $db->prepare("INSERT INTO alerts (user_id, text, created, updated, visibility_type_id) VALUES (:user_id, :text, :created, :updated, :visibility_type_id) RETURNING id");
        $stmt->execute([':user_id' => $this->UserID, ':text' => $this->Text, ':created' => $this->Created ?: date('c'), ':updated' => $this->Updated ?: date('c'), ':visibility_type_id' => $this->VisibilityTypeID,]);
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void {
        if ($this->ID === 0) {
            throw new Exception("Missing alert ID for update.");
        }
        $db = self::getConnection();
        $stmt = $db->prepare("UPDATE alerts SET user_id = :user_id, text = :text, created = :created, updated = :updated, visibility_type_id = :visibility_type_id WHERE id = :id");
        $stmt->execute([':user_id' => $this->UserID, ':text' => $this->Text, ':created' => $this->Created, ':updated' => $this->Updated, ':visibility_type_id' => $this->VisibilityTypeID, ':id' => $this->ID,]);
    }

    public function delete(): void {
        if ($this->ID === 0) {
            throw new Exception("Missing alert ID for delete.");
        }
        $db = self::getConnection();
        $stmt = $db->prepare("DELETE FROM alerts WHERE id = :id");
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?AlertDAL {
        if ($id === 0) return null;
        $db = self::getConnection();
        $stmt = $db->prepare("SELECT * FROM alerts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        $alert = new AlertDAL();
        $alert->ID = (int)$row['id'];
        $alert->UserID = (int)$row['user_id'];
        $alert->Text = $row['text'];
        $alert->Created = $row['created'];
        $alert->Updated = $row['updated'];
        $alert->VisibilityTypeID = (int)$row['visibility_type_id'];
        return $alert;
    }

    public static function getMostRecentIDsPaged(int $startRowIndex, int $maximumRows): array {
        $db = self::getConnection();
        $stmt = $db->prepare("SELECT id FROM alerts ORDER BY created DESC OFFSET :start LIMIT :limit");
        $stmt->bindValue(':start', $startRowIndex, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $maximumRows, PDO::PARAM_INT);
        $stmt->execute();
        $ids = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ids[] = (int)$row['id'];
        }
        return $ids;
    }
}
