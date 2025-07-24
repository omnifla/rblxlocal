<?php
// ported by meditext,
// trimmed anyways.
namespace Roblox;
use PDO;
use DateTime;
class UserLoginAwardDAL
{
    public int $id;
    public int $userId;
    public ?DateTime $lastAwarded = null;
    public DateTime $created;
    public DateTime $updated;

    public static function getOrCreate(int $userId): ?self
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_login_awards WHERE user_id = :uid");
        $stmt->execute([':uid' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $stmt = $conn->prepare("INSERT INTO user_login_awards (user_id) VALUES (:uid) RETURNING *");
            $stmt->execute([':uid' => $userId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return self::fromRow($row);
    }

    public function trySetDailyAward(): bool
    {
        global $conn;
        $now = new DateTime();
        $yesterday = (clone $now)->modify('-1 day');

        if ($this->lastAwarded && $this->lastAwarded > $yesterday) {
            return false;
        }

        $stmt = $conn->prepare("UPDATE user_login_awards SET last_awarded = NOW(), updated = NOW() WHERE id = :id RETURNING last_awarded, updated");
        $stmt->execute([':id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->lastAwarded = new DateTime($row['last_awarded']);
        $this->updated = new DateTime($row['updated']);
        return true;
    }

    private static function fromRow(array $row): self
    {
        $dal = new self();
        $dal->id = (int)$row['id'];
        $dal->userId = (int)$row['user_id'];
        $dal->lastAwarded = isset($row['last_awarded']) ? new DateTime($row['last_awarded']) : null;
        $dal->created = new DateTime($row['created']);
        $dal->updated = new DateTime($row['updated']);
        return $dal;
    }
    public function getLastAwarded(): ?DateTime {
        return $this->lastAwarded;
    }
}
