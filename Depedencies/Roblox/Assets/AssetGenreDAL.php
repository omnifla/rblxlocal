<?php
// written and ported by SkylerClock
namespace Roblox\Assets;

use DateTime;
use Exception;
use PDO;

class AssetGenreDAL
{
    public int $ID = 0;
    public int $BitOrdinal = 0;
    public int $BitMask = 0;
    public string $Name = '';
    public string $DisplayName = '';
    public string $Description = '';
    public string $Abbreviation = '';
    public string $Created = '';
    public string $Updated = '';

    private static function conn(): PDO
    {
        global $conn;
        return $conn;
    }

    public function insert(): void
    {
        if (trim($this->Name) === '') {
            throw new Exception("Required value not specified: Name.");
        }
        $sql = "INSERT INTO AssetGenres (BitOrdinal, BitMask, Name, DisplayName, Description, Abbreviation, Created, Updated) VALUES (:bitOrdinal, :bitMask, :name, :displayName, :description, :abbreviation, :created, :updated)";
        $stmt = self::conn()->prepare($sql);
        $stmt->execute([
            ':bitOrdinal' => $this->BitOrdinal,
            ':bitMask' => $this->BitMask,
            ':name' => $this->Name,
            ':displayName' => $this->DisplayName,
            ':description' => $this->Description,
            ':abbreviation' => $this->Abbreviation,
            ':created' => $this->Created ?: date("Y-m-d H:i:s"),
            ':updated' => $this->Updated ?: date("Y-m-d H:i:s"),
        ]);
        $this->ID = intval(self::conn()->lastInsertId());
    }

    public function update(): void
    {
        if ($this->ID === 0) {
            throw new Exception("Required value not specified: ID.");
        }
        $sql = "UPDATE AssetGenres SET BitOrdinal = :bitOrdinal, BitMask = :bitMask, Name = :name, DisplayName = :displayName, Description = :description, Abbreviation = :abbreviation, Created = :created, Updated = :updated WHERE ID = :id";
        $stmt = self::conn()->prepare($sql);
        $stmt->execute([
            ':bitOrdinal' => $this->BitOrdinal,
            ':bitMask' => $this->BitMask,
            ':name' => $this->Name,
            ':displayName' => $this->DisplayName,
            ':description' => $this->Description,
            ':abbreviation' => $this->Abbreviation,
            ':created' => $this->Created,
            ':updated' => $this->Updated ?: date("Y-m-d H:i:s"),
            ':id' => $this->ID,
        ]);
    }

    public function delete(): void
    {
        if ($this->ID === 0) {
            throw new Exception("Required value not specified: ID.");
        }
        $sql = "DELETE FROM AssetGenres WHERE ID = :id";
        $stmt = self::conn()->prepare($sql);
        $stmt->execute([':id' => $this->ID]);
    }

    private static function buildFromRow(array $row): AssetGenreDAL
    {
        $dal = new AssetGenreDAL();
        $dal->ID = intval($row['ID']);
        $dal->BitOrdinal = intval($row['BitOrdinal']);
        $dal->BitMask = intval($row['BitMask']);
        $dal->Name = $row['Name'];
        $dal->DisplayName = $row['DisplayName'];
        $dal->Description = $row['Description'];
        $dal->Abbreviation = $row['Abbreviation'];
        $dal->Created = $row['Created'];
        $dal->Updated = $row['Updated'];
        return $dal;
    }

    public static function get(int $id): ?AssetGenreDAL
    {
        if ($id === 0) return null;
        $sql = "SELECT * FROM AssetGenres WHERE ID = :id";
        $stmt = self::conn()->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getByName(string $name): ?AssetGenreDAL
    {
        $sql = "SELECT * FROM AssetGenres WHERE Name = :name";
        $stmt = self::conn()->prepare($sql);
        $stmt->execute([':name' => $name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getByBitOrdinal(int $bitOrdinal): ?AssetGenreDAL
    {
        $sql = "SELECT * FROM AssetGenres WHERE BitOrdinal = :ord";
        $stmt = self::conn()->prepare($sql);
        $stmt->execute([':ord' => $bitOrdinal]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getPaged(int $startRowIndex, int $maximumRows): array
    {
        $sql = "SELECT * FROM AssetGenres ORDER BY ID OFFSET :start ROWS FETCH NEXT :max ROWS ONLY";
        $stmt = self::conn()->prepare($sql);
        $stmt->bindValue(':start', $startRowIndex, PDO::PARAM_INT);
        $stmt->bindValue(':max', $maximumRows, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([self::class, 'buildFromRow'], $rows);
    }

    public static function getTotalNumberOfAssetGenres(): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM AssetGenres";
        $stmt = self::conn()->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($row['cnt']);
    }
}
