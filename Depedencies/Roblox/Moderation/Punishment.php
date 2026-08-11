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

    public ?string $ipAddress; // used for poisoning a account

    private static array $types = [
        1 => ['name' => 'Warn', 'duration' => null],
        2 => ['name' => 'Reminder', 'duration' => null],
        3 => ['name' => '1 Day Ban', 'duration' => 1],
        4 => ['name' => '3 Day Ban', 'duration' => 3],
        5 => ['name' => '7 Day Ban', 'duration' => 7],
        6 => ['name' => '14 Day Ban', 'duration' => 14],
        7 => ['name' => 'Account Deleted', 'duration' => null],
        8 => ['name' => 'Poison Machine', 'duration' => null],
    ];


    public static function getTypeName(int $typeId): ?string
    {
        return self::$types[$typeId]['name'] ?? null;
    }

    public static function getDurationInDays(int $typeId): ?int
    {
        return self::$types[$typeId]['duration'] ?? null;
    }


    public static function getTotalNumberOfPunishmentsByUserID(int $userId): int
    {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM punishments WHERE user_id = :uid");
        $stmt->execute([':uid' => $userId]);
        return (int) $stmt->fetchColumn();
    }

    public static function getTotalNumberOfActivePunishmentsByUserID(int $userId): int
    {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM punishments WHERE user_id = :uid AND active = TRUE");
        $stmt->execute([':uid' => $userId]);
        return (int) $stmt->fetchColumn();
    }

    public static function getPunishmentsByUserIDPaged(int $offset, int $limit, int $userId): array
    {
        self::deactivateExpiredPunishments();
        global $conn;
        $stmt = $conn->prepare("
            SELECT id, user_id, punishment_type, reason, start_date, end_date, active
            FROM punishments
            WHERE user_id = :uid
            ORDER BY start_date DESC
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
            $p->id = (int) $row['id'];
            $p->userId = (int) $row['user_id'];
            $p->punishmentType = (int) $row['punishment_type'];
            $p->reason = $row['reason'] ?? null;
            $p->startDate = $row['start_date'] ?? null;
            $p->endDate = $row['end_date'] ?? null;
            $p->active = (bool) $row['active'];
            $p->ipAddress = null;
            $result[] = $p;
        }

        return $result;
    }

    public static function assertUserAllowed(int $userId): void
    {
        global $conn;

        $stmt = $conn->prepare("
            SELECT punishment_type, active
            FROM punishments
            WHERE user_id = :uid
            AND active = TRUE
            ORDER BY id DESC
            LIMIT 1
        ");

        $stmt->execute([':uid' => $userId]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$p)
            return;

        $type = (int) $p['punishment_type'];

        if ($type === 7 || $type === 8) {
            throw new \Exception("Account is terminated");
        }

        throw new \Exception("User is banned");
    }

    public function getTypeNameSelf(): ?string
    {
        return self::getTypeName($this->punishmentType);
    }

    public function getDurationString(): ?string
    {
        $days = self::getDurationInDays($this->punishmentType);
        if ($days === null)
            return null;
        return $days . ' Day' . ($days > 1 ? 's' : '');
    }

    public function isExpired(): bool
    {
        if (!$this->endDate)
            return false;
        $end = new DateTime($this->endDate);
        return $end < new DateTime();
    }

    public function isPermanent(): bool
    {
        return in_array($this->punishmentType, [7, 8], true);
    }

    public function getReviewedDateFormatted(): ?string
    {
        if (!$this->startDate)
            return null;

        return date("n/j/Y g:i:s A", strtotime($this->startDate));
    }
    public static function deactivateExpiredPunishments(): void
    {
        global $conn;
        $stmt = $conn->prepare("
            UPDATE punishments
            SET active = FALSE
            WHERE end_date < NOW()
            AND active = TRUE
        ");
        $stmt->execute();

        $usersStmt = $conn->prepare("
            SELECT DISTINCT user_id
            FROM punishments
            WHERE active = TRUE
        ");
        $usersStmt->execute();
        $activeUserIds = $usersStmt->fetchAll(PDO::FETCH_COLUMN);

        $allUserIdsStmt = $conn->prepare("SELECT id FROM users WHERE account_status_id = 2");
        $allUserIdsStmt->execute();
        $bannedUserIds = $allUserIdsStmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($bannedUserIds as $userId) {
            if (!in_array($userId, $activeUserIds, true)) {
                $conn->prepare("UPDATE users SET account_status_id = 1 WHERE id = :uid")
                    ->execute([':uid' => $userId]);
            }
        }
    }

    public static function getNextPunishmentType(int $userId): int
    {
        $count = self::getTotalNumberOfPunishmentsByUserID($userId);

        return match (true) {
            $count === 0 => 1,
            $count === 1 => 3,
            $count === 2 => 4,
            $count === 3 => 5,
            $count === 4 => 6,
            default => 7
        };
    }

    public function isPoison(): bool
    {
        return $this->punishmentType === 8;
    }

    public static function isIpPoisoned(?string $ip): bool
    {
        if (!$ip)
            return false;

        global $conn;

        $hashedIp = md5($ip);

        $stmt = $conn->prepare("
            SELECt id FROM users
            WHERE ips::text @> :hashed::jsonb
            LIMIT 1
        ");
        $stmt->execute([':hashed' => json_encode([$hashedIp])]);
        $userIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($userIds))
            return false;

        $placeholders = implode(',', array_fill(0, count($userIds), '?'));
        $pStmt = $conn->prepare("
        SELECT COUNT(*) FROM punishments
        WHERE punishment_type = 8
        AND active = TRUE
        AND user_id IN ($placeholders)
        ");
        $pStmt->execute($userIds);

        return (int) $pStmt->fetchColumn() > 0;
    }

    public static function create(int $userId, int $typeId, ?string $reason = null, ?int $customDurationDays = null, ?array $evidence = []): void
    {
        global $conn;

        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $duration = $customDurationDays ?? self::getDurationInDays($typeId);

        $start = new DateTime();
        $end = $duration ? (clone $start)->modify("+$duration days") : null;

        if ($typeId === 7 && $customDurationDays !== null) {
            throw new \Exception("Account deletion cannot have a duration.");
        }

        if ($typeId === 8 && $ip && self::isIpPoisoned($ip)) {
            $typeId = 7;
        }

        $deactivate = $conn->prepare("
            UPDATE punishments
            SET active = FALSE
            WHERE user_id = :uid
            AND active = TRUE
            AND punishment_type NOT IN (7, 8)
        ");
        $deactivate->execute([':uid' => $userId]);

        $insert = $conn->prepare("
            INSERT INTO punishments (user_id, punishment_type, reason, start_date, end_date, active, evidence)
            VALUES (:uid, :type, :reason, :start, :end, TRUE, :evidence)
        ");

        $insert->execute([
            ':uid' => $userId,
            ':type' => $typeId,
            ':reason' => $reason,
            ':start' => $start->format('Y-m-d H:i:s'),
            ':end' => $end ? $end->format('Y-m-d H:i:s') : null,
            ':evidence' => json_encode($evidence)
        ]);

        $conn->prepare("UPDATE users SET account_status_id = 2 WHERE id = :uid")
            ->execute([':uid' => $userId]);

        if ($typeId === 8 && $ip) {
            $stmt = $conn->prepare("SELECT id FROM users WHERE ips @> :ip");
            $stmt->execute([':ip' => json_encode([$ip])]);

            $users = $stmt->fetchAll(PDO::FETCH_COLUMN);

            foreach ($users as $uid) {
                if ($uid != $userId) {
                    $conn->prepare("
                UPDATE punishments
                SET active = FALSE
                WHERE user_id = :uid
                AND active = TRUE
                AND punishment_type NOT IN (7, 8)
            ")->execute([':uid' => $uid]);

                    $conn->prepare("
                INSERT INTO punishments (user_id, punishment_type, reason, start_date, end_date, active)
                VALUES (:uid, 7, :reason, NOW(), NULL, TRUE)
            ")->execute([
                                ':uid' => $uid,
                                ':reason' => "You are no longer welcome to Roblox.",
                                ':ip' => $ip
                            ]);
                }
            }
        }
    }
}
?>
