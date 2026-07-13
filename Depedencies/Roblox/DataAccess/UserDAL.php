<?php
namespace Roblox\DataAccess;
// ported by meditext
use PDO;

class UserDAL {
    public $id;
    public $account_id;
    public $age_bracket = 1;
    public $use_super_safe_conversation_mode;
    public $use_super_safe_privacy_mode;
    public $created;
    public $age_bracket_is_locked;
    public $conversation_safety_mode_is_locked;
    public $privacy_safety_mode_is_locked;
    public $associated_entity_id;
    public $associated_entity_type_id = 0;
    public $birth_date;
    public $gender_type_id;
    public $updated;

    public static function buildFromRow(array $row) {
        $dal = new self();
        $dal->id = (int)$row['id'];
        $dal->account_id = (int)$row['id'];
        $dal->age_bracket = $row['use_super_safe_privacy_mode'] ? 1 : 2; // simple translation
        $dal->use_super_safe_conversation_mode = (bool)$row['use_super_safe_privacy_mode'];
        $dal->use_super_safe_privacy_mode = (bool)$row['use_super_safe_privacy_mode'];
        $dal->created = $row['created'];
        $dal->age_bracket_is_locked = false;
        $dal->conversation_safety_mode_is_locked = false;
        $dal->privacy_safety_mode_is_locked = false;
        $dal->associated_entity_id = $row['id'];
        $dal->associated_entity_type_id = 0;
        $dal->birth_date = $row['birthdate'] ?? null;
        $dal->gender_type_id = $row['gender'] ?? null;
        $dal->updated = $row['updated'] ?? null;
        return $dal;
    }

    public static function get($id) {
        global $conn;
        if ($id <= 0) return null;

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getByAccountID($accountId) {
        return self::get($accountId);
    }

    public static function multiGet(array $ids) {
        global $conn;
        if (empty($ids)) return [];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $conn->prepare("SELECT * FROM users WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($rows as $row) {
            $result[] = self::buildFromRow($row);
        }
        return $result;
    }
}
