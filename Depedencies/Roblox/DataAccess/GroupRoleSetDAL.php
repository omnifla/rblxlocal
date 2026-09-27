<?php
namespace Roblox\DataAccess;

use DateTime;
use InvalidArgumentException;
use PDO;
use Roblox\Database;

class GroupRoleSetDAL
{
    public int $ID = 0;
    public int $GroupID = 0;
    public string $Name = '';
    public string $Description = '';
    public int $Rank = 0;
    public ?string $Permissions = null;
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
        $dal->Name = $row['name'];
        $dal->Description = $row['description'] ?? '';
        $dal->Rank = (int) $row['rank'];
        $dal->Permissions = $row['permissions'] ?? null;
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $this->validateForWrite(false);
        $parameters = $this->getWriteParameters();
        $parameters[':description'] = $this->Description;
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_roles (group_id, name, description, rank, permissions, created, updated) '
            . 'VALUES (:group_id, :name, :description, :rank, :permissions, :created, :updated) RETURNING id'
        );
        $stmt->execute($parameters);
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $this->validateForWrite(true);
        $parameters = $this->getWriteParameters();
        if ($this->Description === '') {
            $parameters[':description'] = null;
        }
        $stmt = self::getDb()->prepare(''
            . 'UPDATE group_roles SET group_id = :group_id, name = :name, description = :description, '
            . 'rank = :rank, permissions = :permissions, created = :created, updated = :updated WHERE id = :id'
        );
        $stmt->execute([':id' => $this->ID] + $parameters);
    }

    public function delete(): void
    {
        if ($this->ID <= 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('DELETE FROM group_roles WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_roles WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByGroupIDAndName(int $groupId, string $name): ?self
    {
        if ($name === '') {
            throw new InvalidArgumentException('Required value not specified: Name.');
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_roles WHERE group_id = :group_id AND name = :name LIMIT 1');
        $stmt->execute([':group_id' => $groupId, ':name' => $name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getOwnerByGroupID(int $groupId): ?self
    {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_roles WHERE group_id = :group_id AND rank = 255 LIMIT 1');
        $stmt->execute([':group_id' => $groupId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getOrCreate(int $groupId, string $name, string $description, int $rank): self
    {
        if ($groupId === 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if ($name === '') {
            throw new InvalidArgumentException('Required value not specified: Name.');
        }
        if ($rank < 0 || $rank > 255) {
            throw new InvalidArgumentException('Rank must be between 0 and 255.');
        }

        $db = self::getDb();
        $stmt = $db->prepare(''
            . 'INSERT INTO group_roles (group_id, name, description, rank, created, updated) '
            . 'VALUES (:group_id, :name, :description, :rank, NOW(), NOW()) '
            . 'ON CONFLICT (group_id, name) DO UPDATE SET name = group_roles.name '
            . 'RETURNING *'
        );
        $stmt->execute([
            ':group_id' => $groupId,
            ':name' => $name,
            ':description' => $description,
            ':rank' => $rank,
        ]);
        return self::buildDAL($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public static function getIDsByGroupID(int $groupId): array
    {
        if ($groupId <= 0) {
            return [];
        }
        $stmt = self::getDb()->prepare('SELECT id FROM group_roles WHERE group_id = :group_id ORDER BY rank ASC, id ASC');
        $stmt->execute([':group_id' => $groupId]);
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getIDsByGroupIDAndMaxRank(int $groupId, int $maxRank): array
    {
        if ($groupId <= 0) {
            return [];
        }
        $stmt = self::getDb()->prepare('SELECT id FROM group_roles WHERE group_id = :group_id AND rank <= :max_rank ORDER BY rank ASC, id ASC');
        $stmt->execute([':group_id' => $groupId, ':max_rank' => $maxRank]);
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getTotalByGroupID(int $groupId): int
    {
        if ($groupId <= 0) {
            return 0;
        }
        $stmt = self::getDb()->prepare('SELECT COUNT(*) FROM group_roles WHERE group_id = :group_id');
        $stmt->execute([':group_id' => $groupId]);
        return (int) $stmt->fetchColumn();
    }

    public static function getIDByGroupIDAndUserID(int $groupId, int $userId): ?int
    {
        if ($groupId <= 0 || $userId <= 0) {
            return null;
        }
        $stmt = self::getDb()->prepare(''
            . 'SELECT role_id FROM group_members WHERE group_id = :group_id AND user_id = :user_id LIMIT 1'
        );
        $stmt->execute([':group_id' => $groupId, ':user_id' => $userId]);
        $roleId = $stmt->fetchColumn();
        return $roleId === false ? null : (int) $roleId;
    }

    public static function multiGet(array $ids): array
    {
        if ($ids === []) {
            return [];
        }
        $ids = array_values(array_unique(array_map('intval', $ids)));
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = self::getDb()->prepare("SELECT * FROM group_roles WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        $byId = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $dal = self::buildDAL($row);
            $byId[$dal->ID] = $dal;
        }

        $result = [];
        foreach ($ids as $id) {
            if (isset($byId[$id])) {
                $result[] = $byId[$id];
            }
        }
        return $result;
    }

    private function getWriteParameters(): array
    {
        return [
            ':group_id' => $this->GroupID,
            ':name' => $this->Name,
            ':description' => $this->Description === '' ? null : $this->Description,
            ':rank' => $this->Rank,
            ':permissions' => $this->Permissions,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ];
    }

    private function validateForWrite(bool $updating): void
    {
        if ($updating && $this->ID <= 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        if ($this->GroupID <= 0) {
            throw new InvalidArgumentException('Required value not specified: GroupID.');
        }
        if (trim($this->Name) === '') {
            throw new InvalidArgumentException('Required value not specified: Name.');
        }
        if ($this->Rank < 0 || $this->Rank > 255) {
            throw new InvalidArgumentException('Rank must be between 0 and 255.');
        }
        if ($this->Created->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Created.');
        }
        if ($this->Updated->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Required value not specified: Updated.');
        }
    }
}
