<?php
// ported by meditext
// trimmed and merged both Badge.cs and BadgeDAL.cs guh

namespace Roblox\Economy;

use Roblox\Authentication;

class Badge
{
    // am i stupid enough to leave this or is it fine, because it was left in the original code?
    public static int $BUILDERS_CLUB_ID = 1;
    public static int $TURBO_BUILDERS_CLUB_ID = 2;
    public static int $OUTRAGEOUS_BUILDERS_CLUB_ID = 3;
    
    public static function GetUserBadgesByUserID(int $userId): array
    {
        global $conn;
        $stmt = $conn->prepare("SELECT b.* FROM user_badges ub INNER JOIN badges b ON b.id = ub.badge_id WHERE ub.user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function CreateNew(int $badgeTypeId, int $userId): ?array
    {
        global $conn;

        $stmt = $conn->prepare("
            SELECT b.* FROM user_badges ub
            INNER JOIN badges b ON b.id = ub.badge_id
            WHERE ub.user_id = :user_id AND b.badge_type_id = :badge_type
            LIMIT 1
        ");
        $stmt->execute([
            'user_id' => $userId,
            'badge_type' => $badgeTypeId
        ]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            return $existing;
        }

        $stmt = $conn->prepare("SELECT id FROM badges WHERE badge_type_id = :type LIMIT 1");
        $stmt->execute(['type' => $badgeTypeId]);
        $badgeId = $stmt->fetchColumn();

        if (!$badgeId) {
            return null;
        }
        self::AwardBadge($badgeId);

        return self::Get($badgeId);
    }
    public static function Get(int $badgeId): ?array
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM badges WHERE id = :id");
        $stmt->execute(['id' => $badgeId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }
    public static function AwardBuildersClubBadge(int $badgeTypeId, int $userId): void
    {
        $existingBadges = self::GetUserBadgesByUserID($userId);
        foreach ($existingBadges as $badge) {
            if ((int)$badge['badge_type_id'] === $badgeTypeId) {
                return;
            }
            if ($badgeTypeId === self::$BUILDERS_CLUB_ID &&
                in_array((int)$badge['badge_type_id'], [self::$TURBO_BUILDERS_CLUB_ID, self::$OUTRAGEOUS_BUILDERS_CLUB_ID])) {
                self::DeleteUserBadge($userId, $badge['id']);
            } elseif ($badgeTypeId === self::$TURBO_BUILDERS_CLUB_ID &&
                in_array((int)$badge['badge_type_id'], [self::$BUILDERS_CLUB_ID, self::$OUTRAGEOUS_BUILDERS_CLUB_ID])) {
                self::DeleteUserBadge($userId, $badge['id']);
            } elseif ($badgeTypeId === self::$OUTRAGEOUS_BUILDERS_CLUB_ID &&
                in_array((int)$badge['badge_type_id'], [self::$BUILDERS_CLUB_ID, self::$TURBO_BUILDERS_CLUB_ID])) {
                self::DeleteUserBadge($userId, $badge['id']);
            }
        }

        self::CreateNew($badgeTypeId, $userId);
    }
    public static function DeleteUserBadge(int $userId, int $badgeId): void
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM user_badges WHERE user_id = :user_id AND badge_id = :badge_id");
        $stmt->execute([
            'user_id' => $userId,
            'badge_id' => $badgeId
        ]);
    }
    public static function AwardBadge(int $userId, int $badgeId): bool
    {
        global $conn;
        if (self::UserHasBadge($userId, $badgeId)) return false;

        $stmt = $conn->prepare("INSERT INTO user_badges (user_id, badge_id, awarded_at) VALUES (:user_id, :badge_id, NOW())");
        return $stmt->execute(['user_id' => $userId, 'badge_id' => $badgeId]);
    }

}
