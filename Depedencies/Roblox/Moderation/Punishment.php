<?php
// ported by meditext

namespace Roblox\Moderation;
use PDO;
use DateTime;

class Punishment
{
    public int $id;
    public int $userId;
    public int $punishmentType;
    public ?string $reason;
    public ?string $startDate;
    public ?string $endDate;
    public bool $active;

    private static array $types = [
        1 => ['name' => 'Warn', 'duration' => null],
        2 => ['name' => 'Reminder', 'duration' => null],
        3 => ['name' => '1 Day Ban', 'duration' => 1],
        4 => ['name' => '3 Day Ban', 'duration' => 3],
        5 => ['name' => '7 Day Ban', 'duration' => 7],
        6 => ['name' => 'Account Deleted', 'duration' => null],
        7 => ['name' => 'Poison Machine', 'duration' => null],
    ];


    public static function getTypeName(int $typeId): ?string {
        return self::$types[$typeId]['name'] ?? null;
    }

    public static function getDurationInDays(int $typeId): ?int {
        return self::$types[$typeId]['duration'] ?? null;
    }


    public static function getTotalNumberOfPunishmentsByUserID(int $userId): int {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM punishments WHERE user_id = :uid");
        $stmt->execute([':uid' => $userId]);
        return (int)$stmt->fetchColumn();
    }

    public static function getTotalNumberOfActivePunishmentsByUserID(int $userId): int {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM punishments WHERE user_id = :uid AND active = TRUE");
        $stmt->execute([':uid' => $userId]);
        return (int)$stmt->fetchColumn();
    }

    public static function getPunishmentsByUserIDPaged(int $offset, int $limit, int $userId): array {
        global $conn;
        $stmt = $conn->prepare("
            SELECT id, user_id, punishment_type, reason, start_date, end_date, active
            FROM punishments
            WHERE user_id = :uid
            ORDER BY id ASC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':uid', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];

        foreach ($rows as $row) {
            $p = new Punishment();
            $p->id = (int)$row['id'];
            $p->userId = (int)$row['user_id'];
            $p->punishmentType = (int)$row['punishment_type'];
            $p->reason = $row['reason'] ?? null;
            $p->startDate = $row['start_date'] ?? null;
            $p->endDate = $row['end_date'] ?? null;
            $p->active = (bool)$row['active'];
            $result[] = $p;
        }

        return $result;
    }


    public function getTypeNameSelf(): ?string {
        return self::getTypeName($this->punishmentType);
    }

    public function getDurationString(): ?string {
        $days = self::getDurationInDays($this->punishmentType);
        if ($days === null) return null;
        return $days . ' Day' . ($days > 1 ? 's' : '');
    }

    public function isExpired(): bool {
        if (!$this->endDate) return false;
        $end = new DateTime($this->endDate);
        return $end < new DateTime();
    }

    public static function deactivateExpiredPunishments(): void {
        global $conn;
        $stmt = $conn->prepare("
            UPDATE punishments
            SET active = FALSE
            WHERE end_date < NOW() AND active = TRUE
        ");
        $stmt->execute();
    }


    public static function create(int $userId, int $typeId, ?string $reason = null, ?int $customDurationDays = null): void {
        global $conn;
        $duration = $customDurationDays ?? self::getDurationInDays($typeId);

        $start = new DateTime();
        $end = $duration ? (clone $start)->modify("+$duration days") : null;

        $stmt = $conn->prepare("
            INSERT INTO punishments (user_id, punishment_type, reason, start_date, end_date, active)
            VALUES (:uid, :type, :reason, :start, :end, TRUE)
        ");

        $stmt->execute([
            ':uid' => $userId,
            ':type' => $typeId,
            ':reason' => $reason,
            ':start' => $start->format('Y-m-d H:i:s'),
            ':end' => $end ? $end->format('Y-m-d H:i:s') : null,
        ]);
    }
}
?>