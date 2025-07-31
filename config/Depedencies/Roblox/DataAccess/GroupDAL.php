<?php
// written and ported by SkylerClock
namespace Roblox\DataAccess;

use PDO;
use Exception;

class GroupDAL
{
    public int $id;
    public ?int $agent_id = null;
    public ?int $owner_user_id = null;
    public int $previous_owner_user_id;
    public string $name = '';
    public string $description = '';
    public int $emblem_id = 1;
    public bool $public_entry_allowed = true;
    public bool $bc_only_join = false;
    public bool $is_locked = false;
    public \DateTime $created;
    public \DateTime $updated;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
    }

    public static function get(PDO $db, int $id): ?self
    {
        if ($id <= 0) throw new Exception("Required value not specified: ID.");

        $stmt = $db->prepare("SELECT * FROM groups WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? self::fromRow($row) : null;
    }

    public static function getByName(PDO $db, string $name): ?self
    {
        if (empty($name)) return null;

        $stmt = $db->prepare("SELECT * FROM groups WHERE name = :name");
        $stmt->execute([':name' => $name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? self::fromRow($row) : null;
    }

    public static function delete(PDO $db, int $id): void
    {
        if ($id <= 0) throw new Exception("Required value not specified: ID.");

        $stmt = $db->prepare("DELETE FROM groups WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    public function insert(PDO $db): void
    {
        if (empty($this->owner_user_id)) throw new Exception("Required value not specified: OwnerUserID.");
        if (empty($this->previous_owner_user_id)) throw new Exception("Required value not specified: PreviousOwnerUserID.");
        if (trim($this->name) === '') throw new Exception("Required value not specified: Name.");
        $stmt = $db->prepare("INSERT INTO groups (agent_id, owner_user_id, previous_owner_user_id, name, description, emblem_id, public_entry_allowed, bc_only_join, is_locked, created, updated) VALUES (:agent_id, :owner_user_id, :previous_owner_user_id, :name, :description, :emblem_id, :public_entry_allowed, :bc_only_join, :is_locked, :created, :updated) RETURNING id");
        $stmt->execute([':agent_id' => $this->agent_id, ':owner_user_id' => $this->owner_user_id, ':previous_owner_user_id' => $this->previous_owner_user_id, ':name' => mb_substr($this->name, 0, 50), ':description' => mb_substr($this->description, 0, 1000), ':emblem_id' => $this->emblem_id, ':public_entry_allowed' => $this->public_entry_allowed, ':bc_only_join' => $this->bc_only_join, ':is_locked' => $this->is_locked, ':created' => $this->created->format('Y-m-d H:i:s'), ':updated' => $this->updated->format('Y-m-d H:i:s'),]);
        $this->id = (int) $stmt->fetchColumn();
    }

    public function update(PDO $db): void
    {
        if ($this->id <= 0) throw new Exception("Required value not specified: ID.");
        if (empty($this->previous_owner_user_id)) throw new Exception("Required value not specified: PreviousOwnerUserID.");
        if (trim($this->name) === '') throw new Exception("Required value not specified: Name.");
        $stmt = $db->prepare("UPDATE groups SET agent_id = :agent_id, owner_user_id = :owner_user_id, previous_owner_user_id = :previous_owner_user_id, name = :name, description = :description, emblem_id = :emblem_id, public_entry_allowed = :public_entry_allowed, bc_only_join = :bc_only_join, is_locked = :is_locked, created = :created, updated = :updated WHERE id = :id");
        $stmt->execute([':id' => $this->id, ':agent_id' => $this->agent_id, ':owner_user_id' => $this->owner_user_id, ':previous_owner_user_id' => $this->previous_owner_user_id, ':name' => mb_substr($this->name, 0, 50), ':description' => mb_substr($this->description, 0, 1000), ':emblem_id' => $this->emblem_id, ':public_entry_allowed' => $this->public_entry_allowed, ':bc_only_join' => $this->bc_only_join, ':is_locked' => $this->is_locked, ':created' => $this->created->format('Y-m-d H:i:s'), ':updated' => (new \DateTime())->format('Y-m-d H:i:s'),]);
    }

    private static function fromRow(array $row): self
    {
        $dal = new self();
        $dal->id = (int)$row['id'];
        $dal->agent_id = $row['agent_id'] !== null ? (int)$row['agent_id'] : null;
        $dal->owner_user_id = $row['owner_user_id'] !== null ? (int)$row['owner_user_id'] : null;
        $dal->previous_owner_user_id = (int)$row['previous_owner_user_id'];
        $dal->name = $row['name'];
        $dal->description = $row['description'];
        $dal->emblem_id = (int)$row['emblem_id'];
        $dal->public_entry_allowed = (bool)$row['public_entry_allowed'];
        $dal->bc_only_join = (bool)$row['bc_only_join'];
        $dal->is_locked = (bool)$row['is_locked'];
        $dal->created = new \DateTime($row['created']);
        $dal->updated = new \DateTime($row['updated']);
        return $dal;
    }
}
