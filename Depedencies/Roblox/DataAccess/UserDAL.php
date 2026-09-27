<?php
namespace Roblox\DataAccess;
// ported by meditext
use PDO;

class UserDAL {
    public const SELECT_FILTER_ACCOUNT_ID = 'AccountID';
    public const SELECT_FILTER_ID = 'ID';

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

    public static function buildFromRow(array $row): self {
        $dal = new self();
        $dal->id = (int) $row['id'];
        $dal->account_id = (int) ($row['account_id'] ?? $row['id']);
        $dal->age_bracket = isset($row['age_bracket'])
            ? (int) $row['age_bracket']
            : (!empty($row['use_super_safe_privacy_mode']) ? 1 : 2);
        $dal->use_super_safe_conversation_mode = (bool) ($row['use_super_safe_conversation_mode'] ?? $row['use_super_safe_privacy_mode'] ?? false);
        $dal->use_super_safe_privacy_mode = (bool) ($row['use_super_safe_privacy_mode'] ?? false);
        $dal->created = $row['created'];
        $dal->age_bracket_is_locked = (bool) ($row['age_bracket_is_locked'] ?? false);
        $dal->conversation_safety_mode_is_locked = (bool) ($row['conversation_safety_mode_is_locked'] ?? false);
        $dal->privacy_safety_mode_is_locked = (bool) ($row['privacy_safety_mode_is_locked'] ?? false);
        $dal->associated_entity_id = $row['associated_entity_id'] ?? $row['id'];
        $dal->associated_entity_type_id = (int) ($row['associated_entity_type_id'] ?? 1);
        $dal->birth_date = $row['birth_date'] ?? $row['birthdate'] ?? null;
        $dal->gender_type_id = $row['gender_type_id'] ?? $row['gender'] ?? null;
        $dal->updated = $row['updated'] ?? null;
        return $dal;
    }

    public static function get(int $id): ?self {
        global $conn;
        if ($id <= 0) {
            return null;
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getByFilter(string $selectFilter, int $id): ?self {
        return match ($selectFilter) {
            self::SELECT_FILTER_ID => self::get($id),
            self::SELECT_FILTER_ACCOUNT_ID => self::getByAccountID($id),
            default => throw new \InvalidArgumentException("Unknown SelectFilter: $selectFilter."),
        };
    }

    public static function getByAccountID(int $accountId): ?self {
        return self::get($accountId);
    }

    public static function multiGet(array $ids): array {
        global $conn;
        if ($ids === []) {
            return [];
        }
        $ids = array_values(array_unique(array_map('intval', $ids)));
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
