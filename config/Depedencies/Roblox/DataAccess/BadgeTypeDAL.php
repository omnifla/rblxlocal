<?php
// written and ported by SkylerClock
// Roblox.DataAccess.BadgeTypeDAL is used to manage types of badges, meaning the category or classification of a badge
namespace Roblox.DataAccess;
use \DateTime;

class BadgeTypeDAL
{
    public int $id = 0;
    public string $value = '';
    public ?string $description = null;
    public ?string $abbreviation = null;
    public ?string $image_name = null;
    public ?DateTime $created = null;
    public ?DateTime $updated = null;

    private PDO $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;

    public function insert(): void
    }
    {
        if (trim($this->value) === '') {
            throw new Exception("Required value: value");
        }

        $this->truncateFields();
        $now = (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO badge_types (value, description, abbreviation, image_name, created, updated) VALUES (:value, :description, :abbreviation, :image_name, :created, :updated) RETURNING id, created, updated");
        $stmt->execute([':value' => $this->value, ':description' => $this->description, ':abbreviation' => $this->abbreviation, ':image_name' => $this->image_name, ':created' => $now, ':updated' => $now]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = (int)$row['id'];
        $this->created = new DateTime($row['created']);
        $this->updated = new DateTime($row['updated']);
    }

    public function update(): void
    {
        if ($this->id === 0) {
            throw new Exception("Required value: ID");
        }
        if (trim($this->value) === '') {
            throw new Exception("Required value: value");
        }

        $this->truncateFields();
        $now = (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d H:i:s');

        $stmt = $this->db->prepare("UPDATE badge_types SET value = :value, description = :description, abbreviation = :abbreviation, image_name = :image_name, updated = :updated WHERE id = :id");
        $stmt->execute([':id' => $this->id, ':value' => $this->value, ':description' => $this->description, ':abbreviation' => $this->abbreviation, ':image_name' => $this->image_name, ':updated' => $now]);
        $this->updated = new DateTime($now);
    }

    public function delete(): void
    {
        if ($this->id === 0) {
            throw new Exception("Required value: ID");
        }

        $stmt = $this->db->prepare("DELETE FROM badge_types WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?BadgeTypeDAL
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM badge_types WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getByValue(string $value): ?BadgeTypeDAL
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM badge_types WHERE value = :value");
        $stmt->execute([':value' => $value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getAllIDs(): array
    {
        global $conn;
        $stmt = $conn->query("SELECT id FROM badge_types");
        return array_map(fn($r) => (int)$r['id'], $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    private static function buildFromRow(array $row): BadgeTypeDAL
    {
        $b = new BadgeTypeDAL();
        $b->id = (int)$row['id'];
        $b->value = $row['value'];
        $b->description = $row['description'] ?? null;
        $b->abbreviation = $row['abbreviation'] ?? null;
        $b->image_name = $row['image_name'] ?? null;
        $b->created = $row['created'] ? new DateTime($row['created']) : null;
        $b->updated = $row['updated'] ? new DateTime($row['updated']) : null;
        return $b;
    }

    private function truncateFields(): void
    {
        $this->value = substr($this->value, 0, 50);
        if ($this->description !== null) {
            $this->description = substr($this->description, 0, 1000);
        }
        if ($this->abbreviation !== null) {
            $this->abbreviation = substr($this->abbreviation, 0, 10);
        }
        if ($this->image_name !== null) {
            $this->image_name = substr($this->image_name, 0, 100);
        }
    }
}
