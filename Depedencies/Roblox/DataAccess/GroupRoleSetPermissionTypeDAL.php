<?php
namespace Roblox\DataAccess;

use DateTime;
use InvalidArgumentException;
use PDO;
use Roblox\Database;

class GroupRoleSetPermissionTypeDAL
{
    public int $ID = 0;
    public string $Name = '';
    public string $Description = '';
    public int $CategoryID = 0;
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
        $dal->Description = $row['description'] ?? '';
        $dal->CategoryID = (int) $row['category_id'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $this->validateForWrite(false);
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_role_set_permission_types (name, description, category_id, created, updated) '
            . 'VALUES (:name, :description, :category_id, :created, :updated) RETURNING id'
        );
        $stmt->execute($this->writeParameters());
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $this->validateForWrite(true);
        $stmt = self::getDb()->prepare(''
            . 'UPDATE group_role_set_permission_types SET name = :name, description = :description, '
            . 'category_id = :category_id, created = :created, updated = :updated WHERE id = :id'
        );
        $stmt->execute([':id' => $this->ID] + $this->writeParameters());
    }

    public function delete(): void
    {
        if ($this->ID <= 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('DELETE FROM group_role_set_permission_types WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id <= 0) {
            return null;
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_role_set_permission_types WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByName(string $name): ?self
    {
        if ($name === '') {
            return null;
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_role_set_permission_types WHERE name = :name LIMIT 1');
        $stmt->execute([':name' => $name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getIDsByCategoryID(int $categoryId): array
    {
        if ($categoryId <= 0) {
            return [];
        }
        $stmt = self::getDb()->prepare('SELECT id FROM group_role_set_permission_types WHERE category_id = :category_id ORDER BY id ASC');
        $stmt->execute([':category_id' => $categoryId]);
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function multiGet(array $ids): array
    {
        if ($ids === []) {
            return [];
        }
        $ids = array_values(array_unique(array_map('intval', $ids)));
        $holders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = self::getDb()->prepare("SELECT * FROM group_role_set_permission_types WHERE id IN ($holders)");
        $stmt->execute($ids);
        $byId = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $dal = self::buildDAL($row);
            $byId[$dal->ID] = $dal;
        }
        $ordered = [];
        foreach ($ids as $id) {
            if (isset($byId[$id])) {
                $ordered[] = $byId[$id];
            }
        }
        return $ordered;
    }

    private function writeParameters(): array
    {
        return [
            ':name' => $this->Name,
            ':description' => $this->Description,
            ':category_id' => $this->CategoryID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ];
    }

    private function validateForWrite(bool $updating): void
    {
        if ($updating && $this->ID <= 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        if (trim($this->Name) === '') {
            throw new InvalidArgumentException('Required value not specified: Name.');
        }
        if ($this->CategoryID <= 0) {
            throw new InvalidArgumentException('Required value not specified: CategoryID.');
        }
        if ($this->Created->format('Y-m-d H:i:s') === '0001-01-01 00:00:00' || $this->Updated->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Created and Updated timestamps are required.');
        }
    }
}
