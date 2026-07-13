<?php
// written and ported by SkylerClock
namespace Roblox\DataAccess;

use PDO;
use DateTime;
use Roblox\Database;

class GroupAssetCreatorDAL
{
    public int $ID;
    public int $AssetID;
    public int $GroupID;
    public int $UserID;
    public DateTime $Created;
    public DateTime $Updated;

    private static function buildDAL(array $row): self
    {
        $dal = new self();
        $dal->ID = (int)$row['id'];
        $dal->AssetID = (int)$row['asset_id'];
        $dal->GroupID = (int)$row['group_id'];
        $dal->UserID = (int)$row['user_id'];
        $dal->Created = new DateTime($row['created']);
        $dal->Updated = new DateTime($row['updated']);
        return $dal;
    }

    public function insert(): void
    {
        $db = Database::getRobloxGroups();
        $stmt = $db->prepare("INSERT INTO group_asset_creators (asset_id, group_id, user_id, created, updated) VALUES (:asset_id, :group_id, :user_id, :created, :updated) RETURNING id");
        $stmt->execute([':asset_id' => $this->AssetID, ':group_id' => $this->GroupID, ':user_id' => $this->UserID, ':created' => $this->Created->format('Y-m-d H:i:s'), ':updated' => $this->Updated->format('Y-m-d H:i:s'),]);
        $this->ID = (int)$stmt->fetchColumn();
    }

    public function update(): void
    {
        $db = Database::getRobloxGroups();
        $stmt = $db->prepare("UPDATE group_asset_creators SET asset_id = :asset_id, group_id = :group_id, user_id = :user_id, created = :created, updated = :updated WHERE id = :id");
        $stmt->execute([':asset_id' => $this->AssetID, ':group_id' => $this->GroupID, ':user_id' => $this->UserID, ':created' => $this->Created->format('Y-m-d H:i:s'), ':updated' => $this->Updated->format('Y-m-d H:i:s'), ':id' => $this->ID,]);
    }

    public function delete(): void
    {
        $db = Database::getRobloxGroups();
        $stmt = $db->prepare("DELETE FROM group_asset_creators WHERE id = :id");
        $stmt->execute([':id' => $this->ID]);
    }

    public static function get(int $id): ?self
    {
        if ($id === 0) return null;
        $db = Database::getRobloxGroups();
        $stmt = $db->prepare("SELECT * FROM group_asset_creators WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }

    public static function getByAssetID(int $assetId): ?self
    {
        if ($assetId === 0) throw new \InvalidArgumentException("AssetID is required");
        $db = Database::getRobloxGroups();
        $stmt = $db->prepare("SELECT * FROM group_asset_creators WHERE asset_id = :asset_id");
        $stmt->execute([':asset_id' => $assetId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildDAL($row) : null;
    }
}
