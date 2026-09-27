<?php
namespace Roblox\DataAccess;

use DateTime;
use InvalidArgumentException;
use PDO;
use Roblox\Database;

class GroupJoinRequestDAL
{
    public int $ID = 0;
    public int $GroupID = 0;
    public int $UserID = 0;
    public DateTime $Created;
    public DateTime $Updated;

    public function __construct()
    {
        $minimumDate = new DateTime('0001-01-01 00:00:00');
        $this->Created = $minimumDate;
        $this->Updated = clone $minimumDate;
    }

    private static function getDb(): PDO
    {
        return Database::getRobloxGroups();
    }

    private static function buildDAL(array $row): self
    {
        $dal = new self();
        $dal->ID = (int) $row['id'];
        $dal->GroupID = (int) $row['group_id'];
        $dal->UserID = (int) $row['user_id'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $this->validateForWrite(false);
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_join_requests (group_id, user_id, created, updated) '
            . 'VALUES (:group_id, :user_id, :created, :updated) RETURNING id'
        );
        $stmt->execute([
            ':group_id' => $this->GroupID,
            ':user_id' => $this->UserID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $this->validateForWrite(true);
        $stmt = self::getDb()->prepare(''
            . 'UPDATE group_join_requests SET group_id = :group_id, user_id = :user_id, '
            . 'created = :created, updated = :updated WHERE id = :id'
        );
        $stmt->execute([
            ':id' => $this->ID,
            ':group_id' => $this->GroupID,
            ':user_id' => $this->UserID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
    }

    public function delete(): void
    {
        if ($this->ID === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('DELETE FROM group_join_requests WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_join_requests WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByGroupIDAndUserID(int $groupId, int $userId): ?self
    {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($userId === 0) {
            throw new InvalidArgumentException('Required value not specified: UserID.');
        }
        $stmt = self::getDb()->prepare(''
            . 'SELECT * FROM group_join_requests WHERE group_id = :group_id AND user_id = :user_id '
            . 'ORDER BY id ASC LIMIT 1'
        );
        $stmt->execute([':group_id' => $groupId, ':user_id' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getGroupJoinRequestIDsByGroupID(int $groupId): array
    {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        $stmt = self::getDb()->prepare('SELECT id FROM group_join_requests WHERE group_id = :group_id ORDER BY id ASC');
        $stmt->execute([':group_id' => $groupId]);
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getGroupJoinRequestsIDsByGroupIDEnumerative(
        int $groupId,
        ?int $exclusiveStartId,
        int $maximumRows
    ): array {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($maximumRows <= 0) {
            return [];
        }

        $after = $exclusiveStartId ?? 0;
        $stmt = self::getDb()->prepare(''
            . 'SELECT id FROM group_join_requests WHERE group_id = :group_id AND id > :exclusive_start_id '
            . 'ORDER BY id ASC LIMIT :maximum_rows'
        );
        $stmt->bindValue(':group_id', $groupId, PDO::PARAM_INT);
        $stmt->bindValue(':exclusive_start_id', $after, PDO::PARAM_INT);
        $stmt->bindValue(':maximum_rows', $maximumRows, PDO::PARAM_INT);
        $stmt->execute();
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getGroupJoinRequestIDsByGroupIDPaged(
        int $groupId,
        int $startRowIndex,
        int $maximumRows
    ): array {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($startRowIndex === 0) {
            throw new InvalidArgumentException('Required value not specified: StartRowIndex.');
        }
        if ($maximumRows === 0) {
            return [];
        }

        $stmt = self::getDb()->prepare(''
            . 'SELECT id FROM group_join_requests WHERE group_id = :group_id '
            . 'ORDER BY id ASC LIMIT :maximum_rows OFFSET :offset'
        );
        $stmt->bindValue(':group_id', $groupId, PDO::PARAM_INT);
        $stmt->bindValue(':maximum_rows', $maximumRows, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $startRowIndex - 1, PDO::PARAM_INT);
        $stmt->execute();
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getGroupJoinRequestIDsByUserID(int $userId): array
    {
        if ($userId === 0) {
            throw new InvalidArgumentException('Required value not specified: UserID.');
        }
        $stmt = self::getDb()->prepare('SELECT id FROM group_join_requests WHERE user_id = :user_id ORDER BY id ASC');
        $stmt->execute([':user_id' => $userId]);
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getTotalNumberOfGroupJoinRequestsByGroupID(int $groupId): int
    {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        $stmt = self::getDb()->prepare('SELECT COUNT(*) FROM group_join_requests WHERE group_id = :group_id');
        $stmt->execute([':group_id' => $groupId]);
        return (int) $stmt->fetchColumn();
    }

    public static function getTotalNumberOfGroupJoinRequestsByUserID(int $userId): int
    {
        if ($userId === 0) {
            throw new InvalidArgumentException('Required value not specified: UserID.');
        }
        $stmt = self::getDb()->prepare('SELECT COUNT(*) FROM group_join_requests WHERE user_id = :user_id');
        $stmt->execute([':user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }

    private function validateForWrite(bool $updating): void
    {
        if ($updating && $this->ID === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        if ($this->GroupID === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($this->UserID === 0) {
            throw new InvalidArgumentException('Required value not specified: UserID.');
        }
        if ($this->Created->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Created.');
        }
        if ($this->Updated->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Updated.');
        }
    }
}
