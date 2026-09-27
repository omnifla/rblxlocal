<?php
namespace Roblox\DataAccess;

use DateTime;
use InvalidArgumentException;
use PDO;
use Roblox\Database;

class GroupRoleSetPermissionDAL
{
    public int $ID = 0;
    public int $RoleSetID = 0;
    public int $RoleSetPermissionTypeID = 0;
    public int $RoleSetPermissionTypeCategoryID = 0;
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
        $dal->RoleSetID = (int) $row['role_set_id'];
        $dal->RoleSetPermissionTypeID = (int) $row['role_set_permission_type_id'];
        $dal->RoleSetPermissionTypeCategoryID = (int) $row['role_set_permission_type_category_id'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $this->validateForWrite(false);
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_role_set_permissions '
            . '(role_set_id, role_set_permission_type_id, role_set_permission_type_category_id, created, updated) '
            . 'VALUES (:role_set_id, :type_id, :category_id, :created, :updated) RETURNING id'
        );
        $stmt->execute($this->writeParameters());
        $this->ID = (int) $stmt->fetchColumn();
    }

    public function update(): void
    {
        $this->validateForWrite(true);
        $stmt = self::getDb()->prepare(''
            . 'UPDATE group_role_set_permissions SET role_set_id = :role_set_id, '
            . 'role_set_permission_type_id = :type_id, role_set_permission_type_category_id = :category_id, '
            . 'created = :created, updated = :updated WHERE id = :id'
        );
        $stmt->execute([':id' => $this->ID] + $this->writeParameters());
    }

    public function delete(): void
    {
        $stmt = self::getDb()->prepare('DELETE FROM group_role_set_permissions WHERE id = :id');
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('SELECT * FROM group_role_set_permissions WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByRoleSetIDAndTypeID(int $roleSetId, int $typeId): ?self
    {
        if ($roleSetId === 0) {
            throw new InvalidArgumentException('Required value not specified: RoleSetID.');
        }
        if ($typeId === 0) {
            throw new InvalidArgumentException('Required value not specified: TypeID.');
        }
        $stmt = self::getDb()->prepare(''
            . 'SELECT * FROM group_role_set_permissions '
            . 'WHERE role_set_id = :role_set_id AND role_set_permission_type_id = :type_id LIMIT 1'
        );
        $stmt->execute([':role_set_id' => $roleSetId, ':type_id' => $typeId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getOrCreate(int $roleSetId, int $typeId, int $categoryId): self
    {
        if ($roleSetId === 0) {
            throw new InvalidArgumentException('Required value not specified: RoleSetID.');
        }
        if ($typeId === 0) {
            throw new InvalidArgumentException('Required value not specified: RoleSetPermissionTypeID.');
        }
        $stmt = self::getDb()->prepare(''
            . 'INSERT INTO group_role_set_permissions '
            . '(role_set_id, role_set_permission_type_id, role_set_permission_type_category_id, created, updated) '
            . 'VALUES (:role_set_id, :type_id, :category_id, NOW(), NOW()) '
            . 'ON CONFLICT (role_set_id, role_set_permission_type_id, role_set_permission_type_category_id) '
            . 'DO UPDATE SET role_set_id = group_role_set_permissions.role_set_id RETURNING *'
        );
        $stmt->execute([
            ':role_set_id' => $roleSetId,
            ':type_id' => $typeId,
            ':category_id' => $categoryId,
        ]);
        return self::buildDAL($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public static function getIDsByRoleSetID(int $roleSetId): array
    {
        if ($roleSetId === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('SELECT id FROM group_role_set_permissions WHERE role_set_id = :role_set_id ORDER BY id ASC');
        $stmt->execute([':role_set_id' => $roleSetId]);
        return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }

    public static function getTotalByRoleSetID(int $roleSetId): int
    {
        if ($roleSetId === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        $stmt = self::getDb()->prepare('SELECT COUNT(*) FROM group_role_set_permissions WHERE role_set_id = :role_set_id');
        $stmt->execute([':role_set_id' => $roleSetId]);
        return (int) $stmt->fetchColumn();
    }

    public static function multiGet(array $ids): array
    {
        if ($ids === []) {
            return [];
        }
        $ids = array_values(array_unique(array_map('intval', $ids)));
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = self::getDb()->prepare("SELECT * FROM group_role_set_permissions WHERE id IN ($placeholders)");
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

    private function writeParameters(): array
    {
        return [
            ':role_set_id' => $this->RoleSetID,
            ':type_id' => $this->RoleSetPermissionTypeID,
            ':category_id' => $this->RoleSetPermissionTypeCategoryID,
            ':created' => $this->Created->format('Y-m-d H:i:s'),
            ':updated' => $this->Updated->format('Y-m-d H:i:s'),
        ];
    }

    private function validateForWrite(bool $updating): void
    {
        if ($updating && $this->ID === 0) {
            throw new InvalidArgumentException('Required value not specified: ID.');
        }
        if ($this->RoleSetID === 0) {
            throw new InvalidArgumentException('Required value not specified: RoleSetID.');
        }
        if ($this->RoleSetPermissionTypeID === 0) {
            throw new InvalidArgumentException('Required value not specified: RoleSetPermissionTypeID.');
        }
        if ($this->RoleSetPermissionTypeCategoryID === 0) {
            throw new InvalidArgumentException('Required value not specified: RoleSetPermissionTypeCategoryID.');
        }
        if ($this->Created->format('Y-m-d H:i:s') === '0001-01-01 00:00:00' || $this->Updated->format('Y-m-d H:i:s') === '0001-01-01 00:00:00') {
            throw new InvalidArgumentException('Created and Updated timestamps are required.');
        }
    }
}
