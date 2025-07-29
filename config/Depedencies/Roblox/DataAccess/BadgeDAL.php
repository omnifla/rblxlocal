<?php
// written and ported by SkylerClock
// this is Roblox.DataAccess.BadgeDAL and it's used for defining and inserting game badges
namespace Roblox.DataAccess;

class BadgeDAL
{
    public int $id = 0;
    public string $name = '';
    public ?string $description = null;
    public ?int $image_asset_id = null;
    public ?int $badge_type_id = 1;
    public int $creator_user_id = 0;
    public ?bool $is_enabled = true;
    public ?DateTime $created_at = null;

    private PDO $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function insert(): void
    {
        if (empty($this->name)) {
            throw new Exception("Badge name is required.");
        }
        if ($this->creator_user_id === 0) {
            throw new Exception("Creator user ID is required.");
        }

        $stmt = $this->db->prepare("INSERT INTO badges (name, description, image_asset_id, badge_type_id, creator_user_id, is_enabled) VALUES (:name, :description, :image_asset_id, :badge_type_id, :creator_user_id, :is_enabled) RETURNING id, created_at");
        $stmt->execute([':name' => $this->name, ':description' => $this->description, ':image_asset_id' => $this->image_asset_id, ':badge_type_id' => $this->badge_type_id, ':creator_user_id' => $this->creator_user_id, ':is_enabled' => $this->is_enabled,]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = (int)$result['id'];
        $this->created_at = new DateTime($result['created_at']);
    }

    public function update(): void
    {
        if ($this->id === 0) {
            throw new Exception("Badge ID is required for update.");
        }

        $stmt = $this->db->prepare("UPDATE badges SET name = :name, description = :description, image_asset_id = :image_asset_id, badge_type_id = :badge_type_id, creator_user_id = :creator_user_id, is_enabled = :is_enabled WHERE id = :id");
        $stmt->execute([':id' => $this->id, ':name' => $this->name, ':description' => $this->description, ':image_asset_id' => $this->image_asset_id, ':badge_type_id' => $this->badge_type_id, ':creator_user_id' => $this->creator_user_id, ':is_enabled' => $this->is_enabled,]);
    }

    public function delete(): void
    {
        if ($this->id === 0) {
            throw new Exception("Badge ID is required for delete.");
        }

        $stmt = $this->db->prepare("DELETE FROM badges WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?BadgeDAL
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM badges WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        return self::buildFromRow($row);
    }

    public static function getAll(): array
    {
        global $conn;

        $stmt = $conn->query("SELECT * FROM badges ORDER BY created_at DESC");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map([self::class, 'buildFromRow'], $rows);
    }

    private static function buildFromRow(array $row): BadgeDAL
    {
        $badge = new BadgeDAL();
        $badge->id = (int)$row['id'];
        $badge->name = $row['name'];
        $badge->description = $row['description'];
        $badge->image_asset_id = $row['image_asset_id'] !== null ? (int)$row['image_asset_id'] : null;
        $badge->badge_type_id = $row['badge_type_id'] !== null ? (int)$row['badge_type_id'] : null;
        $badge->creator_user_id = (int)$row['creator_user_id'];
        $badge->is_enabled = $row['is_enabled'] !== null ? (bool)$row['is_enabled'] : null;
        $badge->created_at = $row['created_at'] !== null ? new DateTime($row['created_at']) : null;
        return $badge;
    }
}
