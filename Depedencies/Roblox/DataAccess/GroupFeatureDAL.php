<?php
namespace Roblox\DataAccess;

use DateTime;
use PDO;
use InvalidArgumentException;
use Roblox\Database;

class GroupFeatureDAL
{
    public int $ID = 0;
    public int $GroupID = 0;
    public int $GroupFeatureTypeID = 0;
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
        $dal->GroupFeatureTypeID = (int) $row['group_feature_type_id'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $db = self::getDb();
        $stmt = $db->prepare(''
            . 'INSERT INTO group_features (group_id, group_feature_type_id, created, updated) '
            . 'VALUES (:group_id, :group_feature_type_id, :created, :updated) RETURNING id'
        );
        $stmt->execute([
            ':group_id' => $this->GroupID,
            ':group_feature_type_id' => $this->GroupFeatureTypeID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $db = self::getDb();
        $stmt = $db->prepare(''
            . 'UPDATE group_features SET group_id = :group_id, group_feature_type_id = :group_feature_type_id, '
            . 'created = :created, updated = :updated WHERE id = :id'
        );
        $stmt->execute([
            ':id' => $this->ID,
            ':group_id' => $this->GroupID,
            ':group_feature_type_id' => $this->GroupFeatureTypeID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
    }

    public function delete(): void
    {
        $stmt = self::getDb()->prepare('DELETE FROM group_features WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id === 0) {
            return null;
        }

        $stmt = self::getDb()->prepare('SELECT * FROM group_features WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByGroupIDAndTypeID(int $groupId, int $groupFeatureTypeId): ?self
    {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($groupFeatureTypeId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupFeatureTypeID.');
        }

        $stmt = self::getDb()->prepare(''
            . 'SELECT * FROM group_features '
            . 'WHERE group_id = :group_id AND group_feature_type_id = :group_feature_type_id LIMIT 1'
        );
        $stmt->execute([
            ':group_id' => $groupId,
            ':group_feature_type_id' => $groupFeatureTypeId,
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getGroupFeatureIDsByGroupIDPaged(
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
            . 'SELECT id FROM group_features WHERE group_id = :group_id '
            . 'ORDER BY id ASC LIMIT :maximum_rows OFFSET :offset'
        );
        $stmt->bindValue(':group_id', $groupId, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $startRowIndex - 1, PDO::PARAM_INT);
        $stmt->bindValue(':maximum_rows', $maximumRows, PDO::PARAM_INT);
        $stmt->execute();
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }
}
