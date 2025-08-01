<?php
namespace Roblox\DataAccess;

use PDO;
use Exception;
use DateTime;

class GroupCounterDAL
{
    public int $id;
    public int $groupId;
    public int $groupCounterTypeId;
    public int $value;
    public string $created;
    public string $updated;

    private static function getDb(): PDO
    {
        return \Roblox\Database::getGroupCountersPDO();
    }

    public function increment(int $amount): void
    {
        if ($amount < 1) {
            throw new Exception('Required value not specified: Amount.');
        }
        $stmt = self::getDb()->prepare("SELECT value, updated FROM group_counters_increment(:id, :amount)");
        $stmt->execute([':id' => $this->id, ':amount' => $amount,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->value = (int)$result['value'];
        $this->updated = $result['updated'];
    }

    public function tryDecrement(int $amount): void
    {
        if ($amount < 1) {
            throw new Exception('Required value not specified: Amount.');
        }

        $stmt = self::getDb()->prepare("SELECT is_success, value, updated FROM group_counters_try_decrement(:id, :amount)");
        $stmt->execute([':id' => $this->id, ':amount' => $amount,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['is_success']) {
            $this->value = (int)$result['value'];
            $this->updated = $result['updated'];
        }
    }

    public function insert(): void
    {
        if (!$this->groupId) {
            throw new Exception("Required value not specified: GroupID.");
        }
        if (!$this->groupCounterTypeId) {
            throw new Exception("Required value not specified: GroupCounterTypeID.");
        }
        if (!$this->value) {
            throw new Exception("Required value not specified: Value.");
        }
        if (!$this->created || !$this->updated) {
            throw new Exception("Required value not specified: Created/Updated.");
        }

        $stmt = self::getDb()->prepare("INSERT INTO group_counters (group_id, group_counter_type_id, value, created, updated) VALUES (:group_id, :type_id, :value, :created, :updated) RETURNING id");
        $stmt->execute([':group_id' => $this->groupId, ':type_id' => $this->groupCounterTypeId,':value' => $this->value, ':created' => $this->created, ':updated' => $this->updated,]);
        $this->id = (int)$stmt->fetchColumn();
    }

    public function update(): void
    {
        if (!$this->id) {
            throw new Exception("Required value not specified: ID.");
        }

        $stmt = self::getDb()->prepare("UPDATE group_counters SET group_id = :group_id, group_counter_type_id = :type_id, value = :value, created = :created, updated = :updated WHERE id = :id");
        $stmt->execute([':id' => $this->id, ':group_id' => $this->groupId, ':type_id' => $this->groupCounterTypeId, ':value' => $this->value, ':created' => $this->created, ':updated' => $this->updated,]);
    }

    public function delete(): void
    {
        if (!$this->id) {
            throw new Exception("Required value not specified: ID.");
        }

        $stmt = self::getDb()->prepare("DELETE FROM group_counters WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?GroupCounterDAL
    {
        if ($id <= 0) {
            throw new Exception("Required value not specified: ID.");
        }

        $stmt = self::getDb()->prepare("SELECT * FROM group_counters WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getOrCreate(int $groupId, int $typeId): GroupCounterDAL
    {
        if ($groupId <= 0 || $typeId <= 0) {
            throw new Exception("Required value not specified: GroupID or GroupCounterTypeID.");
        }

        $stmt = self::getDb()->prepare("SELECT * FROM group_counters_get_or_create(:group_id, :type_id)");
        $stmt->execute([':group_id' => $groupId, ':type_id' => $typeId,]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return self::buildDAL($row);
    }

    private static function buildDAL(array $row): GroupCounterDAL
    {
        $dal = new GroupCounterDAL();
        $dal->id = (int)$row['id'];
        $dal->groupId = (int)$row['group_id'];
        $dal->groupCounterTypeId = (int)$row['group_counter_type_id'];
        $dal->value = (int)$row['value'];
        $dal->created = $row['created'];
        $dal->updated = $row['updated'];
        return $dal;
    }
}
