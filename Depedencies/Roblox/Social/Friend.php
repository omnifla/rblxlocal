<?php
namespace Roblox\Social;

use PDO;

class Friend implements IFriend
{
    private int $userId;
    private \DateTime $friendsSince;

    public function __construct(int $userId = 0, ?\DateTime $friendsSince = null)
    {
        $this->userId = $userId;
        $this->friendsSince = $friendsSince ?? new \DateTime();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getFriendsSince(): \DateTime
    {
        return $this->friendsSince;
    }

    public function setFriendsSince(\DateTime $friendsSince): void
    {
        $this->friendsSince = $friendsSince;
    }

    public static function areFriends(int $userId, int $otherId): bool
    {
        global $conn;

        $stmt = $conn->prepare("
            SELECT 1
            FROM friends
            WHERE status = 2
              AND (
                    (fromid = :a AND toid = :b)
                  OR (fromid = :b AND toid = :a)
              )
            LIMIT 1
        ");

        $stmt->execute([
            'a' => $userId,
            'b' => $otherId
        ]);

        return (bool) $stmt->fetchColumn();
    }

    public static function sendRequest(int $fromId, int $toId): void
    {
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO friends (fromid, toid, status)
            VALUES (:fromid, :toid, 1)
            ON CONFLICT DO NOTHING
        ");

        $stmt->execute([
            'fromid' => $fromId,
            'toid' => $toId
        ]);
    }

    public static function accept(int $fromId, int $toId): void
    {
        global $conn;

        $stmt = $conn->prepare("
            UPDATE friends
            SET status = 2
            WHERE fromid = :from
              AND toid = :to
              AND status = 1
        ");

        $stmt->execute([
            'from' => $fromId,
            'to' => $toId
        ]);
    }

    public static function remove(int $userId, int $otherId): void
    {
        global $conn;

        $stmt = $conn->prepare("
            DELETE FROM friends
            WHERE (
                (fromid = :a AND toid = :b)
             OR (fromid = :b AND toid = :a)
            )
        ");

        $stmt->execute([
            'a' => $userId,
            'b' => $otherId
        ]);
    }

    public static function getFriends(int $userId, int $page = 1, int $pageSize = 50): array
    {
        global $conn;

        $offset = ($page - 1) * $pageSize;

        $stmt = $conn->prepare("
        SELECT
            u.id,
            u.username
        FROM friends f
        JOIN users u
            ON u.id = CASE
                WHEN f.fromid = :uid THEN f.toid
                ELSE f.fromid
            END
        WHERE
            f.status = 2
            AND (f.fromid = :uid OR f.toid = :uid)
        ORDER BY u.username
        LIMIT :limit OFFSET :offset
    ");

        $stmt->bindValue(":uid", $userId, PDO::PARAM_INT);
        $stmt->bindValue(":limit", $pageSize, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

        $stmt->execute();

        $friends = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $friends[] = [
                "Id" => (int) $row["id"],
                "Username" => $row["username"],
                "UserProfileLink" => "/User.aspx?ID=" . $row["id"]
            ];
        }

        return $friends;
    }

    public static function getFriendsFromList(int $userId, array $ids): array
    {
        global $conn;

        if (empty($ids))
            return [];

        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $sql = "
            SELECT
                CASE
                    WHEN fromid = ? THEN toid
                    ELSE fromid
                END AS friend_id
            FROM friends
            WHERE status = 2
              AND (
                    fromid = ?
                 OR toid = ?
              )
              AND (
        ";

        $sql .= implode(" OR ", array_map(fn($i) => "(fromid = ? OR toid = ?)", $ids));

        $sql .= ")";

        // simpler safe version instead:
        $stmt = $conn->prepare("
            SELECT fromid, toid
            FROM friends
            WHERE status = 2
              AND (
                    fromid = :u OR toid = :u
              )
        ");

        $stmt->execute(['u' => $userId]);

        $friends = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $fid = ($row['fromid'] == $userId) ? $row['toid'] : $row['fromid'];
            $friends[] = $fid;
        }

        return array_values(array_intersect($friends, $ids));
    }

    public static function getFriendCount(int $userId): int
    {
        global $conn;

        $stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM friends
        WHERE status = 2
          AND (
                fromid = :id
             OR toid = :id
          )
    ");

        $stmt->execute([
            "id" => $userId
        ]);

        return (int) $stmt->fetchColumn();
    }

    public static function getPendingCount(int $userId): int
    {
        global $conn;

        $stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM friends
        WHERE status = 1
          AND toid = :id
    ");

        $stmt->execute([
            "id" => $userId
        ]);

        return (int) $stmt->fetchColumn();
    }
}
