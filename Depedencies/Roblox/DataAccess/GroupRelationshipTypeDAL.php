<?php
namespace Roblox\DataAccess;

use DateTime;
use InvalidArgumentException;
use PDO;
use Roblox\Database;

class GroupRelationshipTypeDAL
{
    public int $ID = 0;
    public string $Value = '';
    public bool $IsReciprocal = false;
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
        $dal->Value = $row['value'];
        $dal->IsReciprocal = (bool) $row['is_reciprocal'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $this->validateForWrite(false);
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_relationship_types (value, is_reciprocal, created, updated) '
            . 'VALUES (:value, :is_reciprocal, :created, :updated) RETURNING id'
        );
        $stmt->execute([
            ':value' => $this->Value,
            ':is_reciprocal' => $this->IsReciprocal,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $this->validateForWrite(true);
        $stmt = self::getDb()->prepare(''
            . 'UPDATE group_relationship_types SET value = :value, is_reciprocal = :is_reciprocal, '
            . 'created = :created, updated = :updated WHERE id = :id'
        );
        $stmt->execute([
            ':id' => $this->ID,
            ':value' => $this->Value,
            ':is_reciprocal' => $this->IsReciprocal,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ]);
    }

    public function delete(): void
    {
        if ($this->ID <= 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('DELETE FROM group_relationship_types WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_relationship_types WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByValue(string $value): ?self
    {
        if ($value === '') {
            return null;
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_relationship_types WHERE value = :value LIMIT 1');
        $stmt->execute([':value' => $value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    private function validateForWrite(bool $updating): void
    {
        if ($updating && $this->ID <= 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        if (trim($this->Value) === '') {
            throw new InvalidArgumentException('Required value not specified: Value.');
        }
        if ($this->Created->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Created.');
        }
        if ($this->Updated->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Updated.');
        }
    }
}
