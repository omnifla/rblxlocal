<?php
// written and ported by SkylerClock
namespace Roblox;

use Roblox\DataAccess\AssetGenreDAL;

class AssetGenre
{
    private AssetGenreDAL $dal;
    public const AllName = "All";
    public static int $AllID = 0;
    public static int $AllOrdinal = 0;
    public const BuildingName = "Tutorial";
    public static int $BuildingID = 0;
    public static int $BuildingOrdinal = 0;
    public const HorrorName = "Scary";
    public static int $HorrorID = 0;
    public static int $HorrorOrdinal = 0;
    public const TownAndCityName = "Town and City";
    public static int $TownAndCityID = 0;
    public static int $TownAndCityOrdinal = 0;
    public const MilitaryName = "War";
    public static int $MilitaryID = 0;
    public static int $MilitaryOrdinal = 0;
    public const ComedyName = "Funny";
    public static int $ComedyID = 0;
    public static int $ComedyOrdinal = 0;
    public const MedievalName = "Fantasy";
    public static int $MedievalID = 0;
    public static int $MedievalOrdinal = 0;
    public const AdventureName = "Adventure";
    public static int $AdventureID = 0;
    public static int $AdventureOrdinal = 0;
    public const SciFiName = "Sci-Fi";
    public static int $SciFiID = 0;
    public static int $SciFiOrdinal = 0;
    public const NavalName = "Pirate";
    public static int $NavalID = 0;
    public static int $NavalOrdinal = 0;
    public const FPSName = "FPS";
    public static int $FPSID = 0;
    public static int $FPSOrdinal = 0;
    public const RPGName = "RPG";
    public static int $RPGID = 0;
    public static int $RPGOrdinal = 0;
    public const SportsName = "Sports";
    public static int $SportsID = 0;
    public static int $SportsOrdinal = 0;
    public const FightingName = "Ninja";
    public static int $FightingID = 0;
    public static int $FightingOrdinal = 0;
    public const WesternName = "Wild West";
    public static int $WesternID = 0;
    public static int $WesternOrdinal = 0;
    private static array $SortedGenres = [];
    public function __construct(?AssetGenreDAL $dal = null)
    {
        $this->dal = $dal ?? new AssetGenreDAL();
    }

    public function getID(): int { return $this->dal->ID; }
    public function getBitOrdinal(): int { return $this->dal->BitOrdinal; }
    public function getBitMask(): int { return $this->dal->BitMask; }
    public function getName(): string { return $this->dal->Name; }
    public function getDisplayName(): string { return $this->dal->DisplayName; }
    public function getDescription(): string { return $this->dal->Description; }
    public function getAbbreviation(): string { return $this->dal->Abbreviation; }
    public function getCreated(): string { return $this->dal->Created; }
    public function getUpdated(): string { return $this->dal->Updated; }
    public function setDescription(string $desc): void { $this->dal->Description = $desc; }
    public function setAbbreviation(string $abbr): void { $this->dal->Abbreviation = $abbr; }
    public function delete(): void { $this->dal->delete(); }
    public function save(): void
    {
        if ($this->dal->ID === 0) {
            $this->dal->Created = date("Y-m-d H:i:s");
            $this->dal->Updated = $this->dal->Created;
            $this->dal->insert();
        } else {
            $this->dal->Updated = date("Y-m-d H:i:s");
            $this->dal->update();
        }
    }

    public static function get(int $id): ?AssetGenre
    {
        $dal = AssetGenreDAL::get($id);
        return $dal ? new AssetGenre($dal) : null;
    }

    public static function getByName(string $name): ?AssetGenre
    {
        $dal = AssetGenreDAL::getByName($name);
        return $dal ? new AssetGenre($dal) : null;
    }

    public static function getByBitOrdinal(int $bitOrdinal): ?AssetGenre
    {
        $dal = AssetGenreDAL::getByBitOrdinal($bitOrdinal);
        return $dal ? new AssetGenre($dal) : null;
    }

    public static function getAllGenresSorted(): array
    {
        if (empty(self::$SortedGenres)) {
            self::bootstrapGenres();
        }
        return self::$SortedGenres;
    }

    private static function bootstrapGenres(): void
    {
        $map = [
            'All' => [&self::$AllID, &self::$AllOrdinal],
            'Tutorial' => [&self::$BuildingID, &self::$BuildingOrdinal],
            'Scary' => [&self::$HorrorID, &self::$HorrorOrdinal],
            'Town and City' => [&self::$TownAndCityID, &self::$TownAndCityOrdinal],
            'War' => [&self::$MilitaryID, &self::$MilitaryOrdinal],
            'Funny' => [&self::$ComedyID, &self::$ComedyOrdinal],
            'Fantasy' => [&self::$MedievalID, &self::$MedievalOrdinal],
            'Adventure' => [&self::$AdventureID, &self::$AdventureOrdinal],
            'Sci-Fi' => [&self::$SciFiID, &self::$SciFiOrdinal],
            'Pirate' => [&self::$NavalID, &self::$NavalOrdinal],
            'FPS' => [&self::$FPSID, &self::$FPSOrdinal],
            'RPG' => [&self::$RPGID, &self::$RPGOrdinal],
            'Sports' => [&self::$SportsID, &self::$SportsOrdinal],
            'Ninja' => [&self::$FightingID, &self::$FightingOrdinal],
            'Wild West' => [&self::$WesternID, &self::$WesternOrdinal],
        ];

        foreach ($map as $name => [$idRef, $ordRef]) {
            $genre = self::getByName($name);
            if ($genre) {
                $idRef = $genre->getID();
                $ordRef = $genre->getBitOrdinal();
                self::$SortedGenres[] = $genre;
            }
        }
    }

    public static function mustGet(int $id): AssetGenre
    {
        $genre = self::get($id);
        if (!$genre) {
            throw new \Exception("AssetGenre with ID $id not found");
        }
        return $genre;
    }

    public static function getAll(): AssetGenre { return self::mustGet(self::$AllID); }
    public static function getBuilding(): AssetGenre { return self::mustGet(self::$BuildingID); }
    public static function getHorror(): AssetGenre { return self::mustGet(self::$HorrorID); }

    public function getSEOURL(): string
    {
        return str_replace(" ", "-", $this->getName());
    }
}