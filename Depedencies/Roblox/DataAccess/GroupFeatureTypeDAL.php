<?php
namespace Roblox\DataAccess;

use DateTime;
use PDO;
use Roblox\Database;

class GroupFeatureTypeDAL
{
    public int $ID = 0;
    public string $Name = '';
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
        $dal->Name = $row['name'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_feature_types (name, created, updated) '
            . 'VALUES (:name, :created, :updated) RETURNING id'
        );
        $stmt->execute([
            ':name' => $this->Name,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $stmt = self::getDb()->prepare(''
            . 'UPDATE group_feature_types SET name = :name, created = :created, updated = :updated '
            . 'WHERE id = :id'
        );
        $stmt->execute([
            ':id' => $this->ID,
            ':name' => $this->Name,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
    }

    public function delete(): void
    {
        $stmt = self::getDb()->prepare('DELETE FROM group_feature_types WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id === 0) {
            return null;
        }

        $stmt = self::getDb()->prepare('SELECT * FROM group_feature_types WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByName(string $name): ?self
    {
        if ($name === '') {
            return null;
        }

        $stmt = self::getDb()->prepare('SELECT * FROM group_feature_types WHERE name = :name LIMIT 1');
        $stmt->execute([':name' => $name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }
}
