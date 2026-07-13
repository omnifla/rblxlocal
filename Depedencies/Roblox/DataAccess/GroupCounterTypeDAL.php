<?php
namespace Roblox\DataAccess;

use PDO;

class GroupCounterTypeDAL
{
    public ?int $id = null;
    public string $value = '';
    public ?string $created = null;
    public ?string $updated = null;

    public static function getByID(int $id): ?self
    {
        global $conn;

        $stmt = $conn->prepare("
            SELECT *
            FROM group_counter_types
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return self::fromRow($row);
    }

    public static function getByValue(string $value): ?self
    {
        global $conn;

        $stmt = $conn->prepare("
            SELECT *
            FROM group_counter_types
            WHERE value = :value
            LIMIT 1
        ");

        $stmt->execute(['value' => $value]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return self::fromRow($row);
    }

    public function insert(): void
    {
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO group_counter_types (
                value,
                created,
                updated
            )
            VALUES (
                :value,
                :created,
                :updated
            )
            RETURNING id
        ");

        $stmt->execute([
            'value' => $this->value,
            'created' => $this->created,
            'updated' => $this->updated
        ]);

        $this->id = (int)$stmt->fetchColumn();
    }

    public function update(): void
    {
        global $conn;

        $stmt = $conn->prepare("
            UPDATE group_counter_types
            SET
                value = :value,
                updated = :updated
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $this->id,
            'value' => $this->value,
            'updated' => $this->updated
        ]);
    }

    public function delete(): void
    {
        global $conn;

        $stmt = $conn->prepare("
            DELETE FROM group_counter_types
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $this->id
        ]);
    }

    private static function fromRow(array $row): self
    {
        $dal = new self();

        $dal->id = (int)$row['id'];
        $dal->value = $row['value'];
        $dal->created = $row['created'];
        $dal->updated = $row['updated'];

        return $dal;
    }
}