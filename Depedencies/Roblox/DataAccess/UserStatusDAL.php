<?php
// ported by meditext
namespace Roblox\DataAccess;

use PDO;
use Exception;

class UserStatusDAL
{
    public int $ID = 0;
    public int $UserID = 0;
    public string $Message = '';
    public string $Created = '';
    public string $Updated = '';

    private static function getConnection(): PDO
    {
        global $conn;
        return $conn;
    }

    public function delete(): void
    {
        if ($this->ID === 0) {
            throw new Exception("Required value not specified: ID.");
        }

        $db = self::getConnection();
        $stmt = $db->prepare("DELETE FROM user_statuses WHERE id = :id");
        $stmt->bindValue(":id", $this->ID, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function insert(): void
    {
        if ($this->UserID === 0) {
            throw new Exception("Required value not specified: UserID");
        }
        if ($this->Message === null) {
            throw new Exception("Required value not specified: Message");
        }
        if (empty($this->Created)) {
            throw new Exception("Required value not specified: Created");
        }
        if (empty($this->Updated)) {
            throw new Exception("Required value not specified: Updated");
        }

        $db = self::getConnection();
        $stmt = $db->prepare("INSERT INTO user_statuses (userid, message, created, updated) VALUES (:userid, :message, :created, :updated) RETURNING id");
        $stmt->bindValue(":userid", $this->UserID, PDO::PARAM_INT);
        $stmt->bindValue(":message", $this->Message, PDO::PARAM_STR);
        $stmt->bindValue(":created", $this->Created, PDO::PARAM_STR);
        $stmt->bindValue(":updated", $this->Updated, PDO::PARAM_STR);
        $stmt->execute();

        $this->ID = (int)$stmt->fetchColumn();
    }

    public function update(): void
    {
        if ($this->ID === 0) {
            throw new Exception("Required value not specified: ID.");
        }
        if ($this->UserID === 0) {
            throw new Exception("Required value not specified: UserID.");
        }
        if ($this->Message === null) {
            throw new Exception("Required value not specified: Message.");
        }
        if (empty($this->Created)) {
            throw new Exception("Required value not specified: Created.");
        }
        if (empty($this->Updated)) {
            throw new Exception("Required value not specified: Updated.");
        }

        $db = self::getConnection();
        $stmt = $db->prepare("UPDATE user_statuses SET userid = :userid, message = :message, created = :created, updated = :updated WHERE id = :id");
        $stmt->bindValue(":id", $this->ID, PDO::PARAM_INT);
        $stmt->bindValue(":userid", $this->UserID, PDO::PARAM_INT);
        $stmt->bindValue(":message", $this->Message, PDO::PARAM_STR);
        $stmt->bindValue(":created", $this->Created, PDO::PARAM_STR);
        $stmt->bindValue(":updated", $this->Updated, PDO::PARAM_STR);
        $stmt->execute();
    }

    private static function buildDAL(array $row): ?UserStatusDAL
    {
        if (!$row) {
            return null;
        }

        $dal = new self();
        $dal->ID = (int)$row['id'];
        $dal->UserID = (int)$row['userid'];
        $dal->Message = $row['message'];
        $dal->Created = $row['created'];
        $dal->Updated = $row['updated'];

        return $dal->ID === 0 ? null : $dal;
    }

    public static function get(int $id): ?UserStatusDAL
    {
        if ($id === 0) {
            throw new Exception("Required value not specified: ID.");
        }

        $db = self::getConnection();
        $stmt = $db->prepare("SELECT * FROM user_statuses WHERE id = :id LIMIT 1");
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return self::buildDAL($row);
    }

    public static function getOrCreate(int $userId): ?UserStatusDAL
    {
        if ($userId === 0) {
            throw new Exception("Required value not specified: UserID.");
        }

        $db = self::getConnection();
        $stmt = $db->prepare("SELECT * FROM user_statuses WHERE userid = :userid LIMIT 1");
        $stmt->bindValue(":userid", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return self::buildDAL($row);
        }
        $status = new self();
        $status->UserID = $userId;
        $status->Message = '';
        $status->Created = date('Y-m-d H:i:s');
        $status->Updated = date('Y-m-d H:i:s');
        $status->insert();

        return $status;
    }
}
