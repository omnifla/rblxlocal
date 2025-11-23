<?php
// ported by meditext
Namespace Roblox\Economy;
use PDO;
use Exception;

class AssetDAL {
    public int $ID;
    public int $AssetTypeID;
    public int $AssetHashID;
    public int $AssetCategories = 0;
    public int $AssetGenres = 0;
    public string $Hash;
    public string $Name;
    public ?string $Description = null;
    public int $CreatorID;
    public int $CurrentVersionID;
    public string $CreatedUtc;
    public string $UpdatedUtc;
    public ?bool $IsArchived = null;

    private static function db(): PDO {
        global $conn;
        return $conn;
    }

    private static function fromRow(array $row): AssetDAL {
        $dal = new AssetDAL();
        $dal->ID = (int)$row['AssetId'];
        $dal->AssetTypeID = (int)$row['AssetType'];
        $dal->AssetHashID = (int)$row['HashId'];
        $dal->AssetCategories = (int)$row['Categories'];
        $dal->AssetGenres = (int)$row['Genres'];
        $dal->Hash = $row['hash'];
        $dal->Name = $row['Name'];
        $dal->Description = $row['Description'];
        $dal->CreatorID = (int)$row['OwnerId'];
        $dal->CurrentVersionID = (int)$row['CurrentVersionId'];
        $dal->CreatedUtc = $row['CreationDate'];
        $dal->UpdatedUtc = $row['UpdatedDate'];
        $dal->IsArchived = $row['IsArchived'] !== null ? (bool)$row['IsArchived'] : null;
        return $dal;
    }

    public function Insert(): void {
        $sql = "INSERT INTO assets (AssetType, HashId, Categories, Genres, hash, Name, Description, OwnerId, CurrentVersionId, CreationDate, UpdatedDate, IsArchived)
            VALUES (:AssetType, :HashId, :Categories, :Genres, :hash, :Name, :Description, :OwnerId, :CurrentVersionId, NOW(), NOW(), :IsArchived)
            RETURNING assetid, CreationDate, UpdatedDate";

        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':AssetType' => $this->AssetTypeID,
            ':HashId' => $this->AssetHashID,
            ':Categories' => $this->AssetCategories,
            ':Genres' => $this->AssetGenres,
            ':hash' => $this->Hash,
            ':Name' => $this->Name,
            ':Description' => $this->Description,
            ':OwnerId' => $this->CreatorID,
            ':CurrentVersionId' => $this->CurrentVersionID,
            ':IsArchived' => $this->IsArchived,
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->ID = (int)$row['assetid'];
        $this->CreatedUtc = $row['CreationDate'];
        $this->UpdatedUtc = $row['UpdatedDate'];
    }

    public function Update(): void {
        if (!$this->ID) throw new Exception("Cannot update Asset without ID");

        $sql = "UPDATE assets SET AssetType = :AssetType, HashId = :HashId, Categories = :Categories, Genres = :Genres, hash = :hash, Name = :Name, Description = :Description, OwnerId = :OwnerId, CurrentVersionId = :CurrentVersionId, IsArchived = :IsArchived, UpdatedDate = NOW() WHERE assetid = :id";

        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            ':id' => $this->ID,
            ':AssetType' => $this->AssetTypeID,
            ':HashId' => $this->AssetHashID,
            ':Categories' => $this->AssetCategories,
            ':Genres' => $this->AssetGenres,
            ':hash' => $this->Hash,
            ':Name' => $this->Name,
            ':Description' => $this->Description,
            ':OwnerId' => $this->CreatorID,
            ':CurrentVersionId' => $this->CurrentVersionID,
            ':IsArchived' => $this->IsArchived,
        ]);
    }

    public function Delete(): void {
        if (!$this->ID){ 
            throw new Exception("Cannot delete Asset without ID");
        }
        $stmt = self::db()->prepare("DELETE FROM assets WHERE assetid = :id");
        $stmt->execute([':id' => $this->ID]);
    }

    public static function Get(int $id): ?AssetDAL {
        $stmt = self::db()->prepare("SELECT * FROM assets WHERE assetid = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    public static function MultiGet(array $ids): array {
        if (empty($ids)){
            return [];
        }
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = self::db()->prepare("SELECT * FROM assets WHERE assetid IN ($placeholders)");
        $stmt->execute($ids);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => self::fromRow($row), $rows);
    }

    public static function GetAssetsByCreator(int $creatorId, int $limit = 50, int $offset = 0): array {
        $stmt = self::db()->prepare("SELECT * FROM assets WHERE OwnerId = :OwnerId ORDER BY CreationDate DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':OwnerId', $creatorId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return array_map(fn($row) => self::fromRow($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function GetAssetsByType(int $assetTypeId, int $limit = 50, int $offset = 0): array {
        $stmt = self::db()->prepare("SELECT * FROM assets WHERE AssetType = :AssetType ORDER BY CreationDate DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':AssetType', $assetTypeId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return array_map(fn($row) => self::fromRow($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function GetRecentAssets(int $limit = 50, int $offset = 0): array {
        $stmt = self::db()->prepare("SELECT * FROM assets ORDER BY CreationDate DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return array_map(fn($row) => self::fromRow($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function SearchByName(string $Name, int $limit = 50, int $offset = 0): array {
        $stmt = self::db()->prepare("SELECT * FROM assets WHERE Name ILIKE :Name ORDER BY CreationDate DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':Name', '%' . $Name . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return array_map(fn($row) => self::fromRow($row), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
