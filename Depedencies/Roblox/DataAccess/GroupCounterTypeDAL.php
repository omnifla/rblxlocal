<?php
namespace Roblox\DataAccess;

use PDO;

class GroupCounterTypeDAL
{
    public int $id = 0;
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
        if ($value === '') {
            return null;
        }

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
        $this->validateForWrite(false);
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
        $this->validateForWrite(true);
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
        if ($this->id === 0) {
            throw new \InvalidArgumentException('Required value not specified: ID.');
        }

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
        $dal->setValue($row['value']);
        $dal->created = $row['created'];
        $dal->updated = $row['updated'];

        return $dal;
    }

    public function setValue(string $value): void
    {
        if (function_exists('mb_substr')) {
            $this->value = mb_substr($value, 0, 50);
        } elseif (function_exists('iconv_substr')) {
            $truncated = iconv_substr($value, 0, 50, 'UTF-8');
            $this->value = $truncated === false ? substr($value, 0, 50) : $truncated;
        } else {
            $this->value = substr($value, 0, 50);
        }
    }

    private function validateForWrite(bool $updating): void
    {
        if ($updating && $this->id === 0) {
            throw new \InvalidArgumentException('Required value was not specified: ID.');
        }
        if (trim($this->value) === '') {
            throw new \InvalidArgumentException('Required value not specified: Value.');
        }
        if ($this->created === null || $this->created === '') {
            throw new \InvalidArgumentException('Required value not specified: Created.');
        }
        if ($this->updated === null || $this->updated === '') {
            throw new \InvalidArgumentException('Required value not specified: Updated.');
        }
    }
}