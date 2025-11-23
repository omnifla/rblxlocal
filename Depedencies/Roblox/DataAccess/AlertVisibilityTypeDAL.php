<?php
// written and ported by SkylerClock
namespace Roblox;

use PDO;
use PDOException;
use Exception;

class AlertVisibilityTypeDAL
{
    public int $id;
    public string $value;
    public string $created;
    public string $updated;

    private static PDO $db;

    public function __construct()
    {
        global $conn;
        self::$db = $conn;
    }

    public function insert(): void
    {
        $stmt = self::$db->prepare("CALL AlertVisibilityTypes_InsertAlertVisibilityType(:value, :created, :updated, :id)");
        $stmt->bindParam(':value', $this->value);
        $stmt->bindParam(':created', $this->created);
        $stmt->bindParam(':updated', $this->updated);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT | PDO::PARAM_INPUT_OUTPUT);
        $stmt->execute();
    }

    public function update(): void
    {
        $stmt = self::$db->prepare("CALL AlertVisibilityTypes_UpdateAlertVisibilityTypeByID(:id, :value, :created, :updated)");
        $stmt->execute([
            ':id' => $this->id,
            ':value' => $this->value,
            ':created' => $this->created,
            ':updated' => $this->updated
        ]);
    }

    public function delete(): void
    {
        $stmt = self::$db->prepare("CALL AlertVisibilityTypes_DeleteAlertVisibilityTypeByID(:id)");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?AlertVisibilityTypeDAL
    {
        global $conn;
        $stmt = $conn->prepare("CALL AlertVisibilityTypes_GetAlertVisibilityTypeByID(:id)");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $dal = new self();
        $dal->id = (int)$row['ID'];
        $dal->value = $row['Value'];
        $dal->created = $row['Created'];
        $dal->updated = $row['Updated'];

        return $dal;
    }

    public static function getByValue(string $value): ?AlertVisibilityTypeDAL
    {
        global $conn;
        $stmt = $conn->prepare("CALL AlertVisibilityTypes_GetAlertVisibilityTypeByValue(:value)");
        $stmt->execute([':value' => $value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $dal = new self();
        $dal->id = (int)$row['ID'];
        $dal->value = $row['Value'];
        $dal->created = $row['Created'];
        $dal->updated = $row['Updated'];

        return $dal;
    }
}
