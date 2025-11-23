<?php
// ported by meditext
namespace Roblox\DataAccess;

use PDO;
use Exception;

class AssetOptionDAL {
    public int $ID;
    public int $AssetID;
    public bool $EnableComments = true;
    public bool $EnableRatings = true;
    public bool $IsCopyLocked = true;
    public bool $IsFriendsOnly = false;
    public bool $IsAllowingGear = false;
    public int $AllowedGearCategories = 0;
    public ?int $DefaultExpirationInTicks = null;
    public string $Created;
    public string $Updated;
    public bool $EnforceGenre = true;
    public int $MinMembershipType = 0;

    private static function db(): PDO {
        global $conn;
        return $conn;
    }

    private static function fromRow(array $row): AssetOptionDAL {
        $dal = new AssetOptionDAL();
        $dal->ID = (int)$row['id'];
        $dal->AssetID = (int)$row['assetid'];
        $dal->EnableComments = (bool)$row['enablecomments'];
        $dal->EnableRatings = (bool)$row['enableratings'];
        $dal->IsCopyLocked = (bool)$row['iscopylocked'];
        $dal->IsFriendsOnly = (bool)$row['isfriendsonly'];
        $dal->IsAllowingGear = (bool)$row['isallowinggear'];
        $dal->AllowedGearCategories = (int)$row['allowedgearcategories'];
        $dal->DefaultExpirationInTicks = $row['defaultexpirationinticks'] !== null ? (int)$row['defaultexpirationinticks'] : null;
        $dal->Created = $row['created'];
        $dal->Updated = $row['updated'];
        $dal->EnforceGenre = (bool)$row['enforcegenre'];
        $dal->MinMembershipType = (int)$row['minmembershiptype'];
        return $dal;
    }

    public function Insert(): void {
        $sql = "INSERT INTO assetoptions (assetid, enablecomments, enableratings, iscopylocked, isfriendsonly, isallowinggear, allowedgearcategories, defaultexpirationinticks, created, updated, enforcegenre, minmembershiptype)
            VALUES (:assetid, :enablecomments, :enableratings, :iscopylocked, :isfriendsonly, :isallowinggear, :allowedgearcategories, :defaultexpirationinticks, NOW(), NOW(), :enforcegenre, :minmembershiptype)
            RETURNING id, created, updated";

        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':assetid' => $this->AssetID,
            ':enablecomments' => $this->EnableComments,
            ':enableratings' => $this->EnableRatings,
            ':iscopylocked' => $this->IsCopyLocked,
            ':isfriendsonly' => $this->IsFriendsOnly,
            ':isallowinggear' => $this->IsAllowingGear,
            ':allowedgearcategories' => $this->AllowedGearCategories,
            ':defaultexpirationinticks' => $this->DefaultExpirationInTicks,
            ':enforcegenre' => $this->EnforceGenre,
            ':minmembershiptype' => $this->MinMembershipType
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->ID = (int)$row['id'];
        $this->Created = $row['created'];
        $this->Updated = $row['updated'];
    }

    public function Update(): void {
        if (!$this->ID) throw new Exception("Cannot update AssetOption without ID");

        $sql = "UPDATE assetoptions SET assetid = :assetid, enablecomments = :enablecomments, enableratings = :enableratings, iscopylocked = :iscopylocked, isfriendsonly = :isfriendsonly, isallowinggear = :isallowinggear, allowedgearcategories = :allowedgearcategories, defaultexpirationinticks = :defaultexpirationinticks, enforcegenre = :enforcegenre, minmembershiptype = :minmembershiptype, updated = NOW()
            WHERE id = :id";

        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':id' => $this->ID,
            ':assetid' => $this->AssetID,
            ':enablecomments' => $this->EnableComments,
            ':enableratings' => $this->EnableRatings,
            ':iscopylocked' => $this->IsCopyLocked,
            ':isfriendsonly' => $this->IsFriendsOnly,
            ':isallowinggear' => $this->IsAllowingGear,
            ':allowedgearcategories' => $this->AllowedGearCategories,
            ':defaultexpirationinticks' => $this->DefaultExpirationInTicks,
            ':enforcegenre' => $this->EnforceGenre,
            ':minmembershiptype' => $this->MinMembershipType
        ]);
    }

    public function Delete(): void {
        if (!$this->ID) throw new Exception("Cannot delete AssetOption without ID");
        $stmt = self::db()->prepare("DELETE FROM assetoptions WHERE id = :id");
        $stmt->execute([':id' => $this->ID]);
    }

    public static function Get(int $id): ?AssetOptionDAL {
        $stmt = self::db()->prepare("SELECT * FROM assetoptions WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    public static function GetByAssetID(int $assetId): ?AssetOptionDAL {
        $stmt = self::db()->prepare("SELECT * FROM assetoptions WHERE assetid = :assetid LIMIT 1");
        $stmt->execute([':assetid' => $assetId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }
}