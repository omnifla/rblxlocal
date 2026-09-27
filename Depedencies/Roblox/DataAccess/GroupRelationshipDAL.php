<?php
namespace Roblox\DataAccess;

use DateTime;
use InvalidArgumentException;
use PDO;
use Roblox\Database;

class GroupRelationshipDAL
{
    public int $ID = 0;
    public int $GroupID = 0;
    public int $RelatedGroupID = 0;
    public int $GroupRelationshipTypeID = 0;
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
        $dal->RelatedGroupID = (int) $row['related_group_id'];
        $dal->GroupRelationshipTypeID = (int) $row['group_relationship_type_id'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $this->validateForWrite(false);
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_relationships '
            . '(group_id, related_group_id, group_relationship_type_id, created, updated) '
            . 'VALUES (:group_id, :related_group_id, :type_id, :created, :updated) RETURNING id'
        );
        $stmt->execute([
            ':group_id' => $this->GroupID,
            ':related_group_id' => $this->RelatedGroupID,
            ':type_id' => $this->GroupRelationshipTypeID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $this->validateForWrite(true);
        $stmt = self::getDb()->prepare(''
            . 'UPDATE group_relationships SET group_id = :group_id, related_group_id = :related_group_id, '
            . 'group_relationship_type_id = :type_id, created = :created, updated = :updated WHERE id = :id'
        );
        $stmt->execute([
            ':id' => $this->ID,
            ':group_id' => $this->GroupID,
            ':related_group_id' => $this->RelatedGroupID,
            ':type_id' => $this->GroupRelationshipTypeID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
    }

    public function delete(): void
    {
        if ($this->ID === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('DELETE FROM group_relationships WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_relationships WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByGroupIDAndRelatedGroupIDAndTypeID(
        int $groupId,
        int $relatedGroupId,
        int $typeId
    ): ?self {
        if ($groupId <= 0 || $relatedGroupId <= 0 || $typeId <= 0) {
            throw new InvalidArgumentException('GroupID, RelatedGroupID, and GroupRelationshipTypeID are required.');
        }

        $stmt = self::getDb()->prepare(''
            . 'SELECT * FROM group_relationships '
            . 'WHERE group_id = :group_id AND related_group_id = :related_group_id '
            . 'AND group_relationship_type_id = :type_id LIMIT 1'
        );
        $stmt->execute([
            ':group_id' => $groupId,
            ':related_group_id' => $relatedGroupId,
            ':type_id' => $typeId,
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getGroupRelationshipIDsByGroupIDAndTypeIDPaged(
        int $groupId,
        int $typeId,
        int $startRowIndex,
        int $maximumRows
    ): array {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($typeId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupRelationshipTypeID.');
        }
        if ($startRowIndex === 0) {
            throw new InvalidArgumentException('Required value not specified: StartRowIndex.');
        }
        if ($maximumRows === 0) {
            return [];
        }

        $stmt = self::getDb()->prepare(''
            . 'SELECT id FROM group_relationships '
            . 'WHERE group_id = :group_id AND group_relationship_type_id = :type_id '
            . 'ORDER BY id ASC LIMIT :maximum_rows OFFSET :offset'
        );
        $stmt->bindValue(':group_id', $groupId, PDO::PARAM_INT);
        $stmt->bindValue(':type_id', $typeId, PDO::PARAM_INT);
        $stmt->bindValue(':maximum_rows', $maximumRows, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $startRowIndex - 1, PDO::PARAM_INT);
        $stmt->execute();
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getTotalNumberOfGroupRelationshipsByGroupIDAndTypeID(int $groupId, int $typeId): int
    {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($typeId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupRelationshipTypeID.');
        }

        $stmt = self::getDb()->prepare(''
            . 'SELECT COUNT(*) FROM group_relationships '
            . 'WHERE group_id = :group_id AND group_relationship_type_id = :type_id'
        );
        $stmt->execute([':group_id' => $groupId, ':type_id' => $typeId]);
        return (int) $stmt->fetchColumn();
    }

    private function validateForWrite(bool $updating): void
    {
        if ($updating && $this->ID <= 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        if ($this->GroupID <= 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($this->RelatedGroupID <= 0) {
            throw new InvalidArgumentException('Required value not specified: RelatedGroupID.');
        }
        if ($this->GroupRelationshipTypeID <= 0) {
            throw new InvalidArgumentException('Required value not specified: GroupRelationshipTypeID.');
        }
        if ($this->Created->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Created.');
        }
        if ($this->Updated->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Updated.');
        }
    }
}
