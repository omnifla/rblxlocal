<?php
namespace Roblox;

class BadgeType
{
    public const Administrator = 1;
    public const Friendship = 2;
    public const CombatInitiation = 3;
    public const Warrior = 4;
    public const Bloxxer = 5;
    public const Homestead = 6;
    public const Bricksmith = 7;
    public const Inviter = 8;
    public const ForumModerator = 9;
    public const ImageModerator = 10;
    public const BuildersClub = 11;
    public const Veteran = 12;
    public const BuildersClubHardHat = 13;

    private static array $allTypes = [];

    public int $id;
    public string $value;
    public string $description;

    private function __construct(int $id, string $value, string $description = "")
    {
        $this->id = $id;
        $this->value = $value;
        $this->description = $description;
    }

    public static function register(string $value, int $id, string $description = ""): void
    {
        self::$allTypes[$id] = new BadgeType($id, $value, $description);
    }

    public static function getById(int $id): ?BadgeType
    {
        return self::$allTypes[$id] ?? null;
    }

    public static function getByName(string $value): ?BadgeType
    {
        foreach (self::$allTypes as $type) {
            if (strcasecmp($type->value, $value) === 0) {
                return $type;
            }
        }
        return null;
    }

    public static function getAll(): array
    {
        return array_values(self::$allTypes);
    }

    // Load default badge types
    public static function init(): void
    {
        self::register("Administrator", self::Administrator, "Roblox administrator");
        self::register("Friendship", self::Friendship, "User made a friend");
        self::register("Veteran", self::Veteran, "Account is at least a year old");
        self::register("Inviter", self::Inviter, "User invited someone to Roblox");
        self::register("Ambassador", self::Ambassador);
        self::register("Bloxer", self::Bloxer);
        self::register("Warrior", self::Warrior);
        self::register("CombatInitiation", self::CombatInitiation);
        self::register("Bricksmith", self::Bricksmith);
        self::register("Homestead", self::Homestead);
        self::register("OfficialModelMaker", self::OfficialModelMaker);
        self::register("WelcomeToTheClub", self::WelcomeToTheClub);
        self::register("BuildersClubHardHat", self::BuildersClubHardHat);
        self::register("CombatInitiation2009", self::CombatInitiation2009);
        self::register("Homestead2009", self::Homestead2009);
        self::register("Bricksmith2009", self::Bricksmith2009);
        self::register("Bloxer2009", self::Bloxer2009);
    }
}

\Roblox\Badges\BadgeType::init();
