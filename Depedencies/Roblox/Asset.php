<?php
// ported by meditext
namespace Roblox;

use Roblox\DataAccess\AssetDAL;
use Roblox\AssetOption;
use Roblox\AssetType;
use Roblox\Settings;
use Roblox\Platform\AssetOwnershipAuthority;
use Roblox\Platform\UserAssetOwnershipAuthority;
use Exception;

function sanitizeNameForUrl(string $name): string {
    $name = preg_replace('/[^a-zA-Z0-9 -]/', '', $name);
    $name = str_replace(' ', '-', $name);
    $name = preg_replace('/-+/', '-', $name);
    $name = trim($name, '-');
    return $name;
}

class Asset {
    private AssetDAL $_EntityDAL;
    private ?int $_OriginalCreatorID = null;
    private ?bool $_OriginalIsArchived = null;

    public function __construct(?AssetDAL $dal = null) {
        $this->_EntityDAL = $dal ?? new AssetDAL();
    }

    public function getID(): int { return $this->_EntityDAL->ID; }
    public function setID(int $id): void { $this->_EntityDAL->ID = $id; }
    public function getAssetTypeID(): int { return $this->_EntityDAL->AssetTypeID; }
    public function setAssetTypeID(int $value): void { $this->_EntityDAL->AssetTypeID = $value; }
    public function getAssetHashID(): int { return $this->_EntityDAL->AssetHashID; }
    public function setAssetHashID(int $value): void { $this->_EntityDAL->AssetHashID = $value; }
    public function getAssetCategories(): int { return (int)$this->_EntityDAL->AssetCategories; }
    public function setAssetCategories(int $value): void { $this->_EntityDAL->AssetCategories = $value; }
    public function getAssetGenres(): int { return (int)$this->_EntityDAL->AssetGenres; }
    public function setAssetGenres(int $value): void { $this->_EntityDAL->AssetGenres = $value; }
    public function getHash(): string { return $this->_EntityDAL->Hash; }
    public function setHash(string $value): void { $this->_EntityDAL->Hash = $value; }
    public function getName(): string { return $this->_EntityDAL->Name; }
    public function setName(string $value): void { $this->_EntityDAL->Name = $value; }
    public function getDescription(): string { return $this->_EntityDAL->Description ?? ''; }
    public function setDescription(string $value): void { $this->_EntityDAL->Description = $value; }
    public function getCurrentVersionID(): int { return $this->_EntityDAL->CurrentVersionID; }
    public function setCurrentVersionID(int $value): void { $this->_EntityDAL->CurrentVersionID = $value; }
    public function getCreatorID(): int { return $this->_EntityDAL->CreatorID; }
    public function setCreatorID(int $value): void {
        if ($this->_OriginalCreatorID === null) $this->_OriginalCreatorID = $this->_EntityDAL->CreatorID;
        $this->_EntityDAL->CreatorID = $value;
    }
    public function getIsArchived(): ?bool { return $this->_EntityDAL->IsArchived; }
    public function setIsArchived(?bool $value): void {
        if ($this->_OriginalIsArchived === null) $this->_OriginalIsArchived = $this->_EntityDAL->IsArchived;
        $this->_EntityDAL->IsArchived = $value;
    }
    public function getCreated(): string { return $this->_EntityDAL->Created; }
    public function getUpdated(): string { return $this->_EntityDAL->Updated; }
    public function isOwnedByUser(int $userId): bool {
        return AssetOwnershipAuthority::doesUserOwnAsset($userId, $this->getID());
    }
    public function awardToUser(int $userId): UserAsset {
        return AssetOwnershipAuthority::awardAsset($userId, $this->getID(), $this->getAssetTypeID());
    }
    public function revokeFromUser(int $userId): void {
        UserAssetOwnershipAuthority::revokeAllUserAssets($userId, $this->getID());
    }
    public function getUserAssets(int $userId): array {
        $all = UserAssetOwnershipAuthority::getUserAssets($userId, $this->getAssetTypeID());
        return array_filter($all, fn($ua) => $ua->getAssetId() === $this->getID());
    }
    
    public function CanUserUseAsset(?array $user): bool {
        if ($this->getIsArchived() || !$this->CanBeTakenDown()) {
            return false;
        }
        if (!$this->MembershipLevelOk($user)) {
            return false;
        }
        if ($this->IsPlace()) {
            return true;
        }
        if ($user === null) {
            return false;
        }
        $userId = $user["id"] ?? 0;
        if ($userId <= 0) {
            return false;
        }
        return $this->isOwnedByUser($userId);
    }

    
    public function Save(): void {
        if (empty($this->_EntityDAL->ID)) {
            $this->_EntityDAL->CreatedUtc = date("Y-m-d H:i:s");
            $this->_EntityDAL->UpdatedUtc = $this->_EntityDAL->CreatedUtc;
            $this->_EntityDAL->Insert();
        } else {
            $this->_EntityDAL->UpdatedUtc = date("Y-m-d H:i:s");
            $this->_EntityDAL->Update();
        }
        $this->_OriginalCreatorID = null;
        $this->_OriginalIsArchived = null;
    }

    public static function Get(int $id): ?Asset {
        if ($id <= 0) return null;
        $dal = AssetDAL::Get($id);
        return $dal ? new Asset($dal) : null;
    }

    public static function MustGet(int $id): Asset {
        $asset = self::Get($id);
        if ($asset === null) throw new Exception("Asset $id not found");
        return $asset;
    }

    public static function MultiGet(array $ids): array {
        $dals = AssetDAL::MultiGet($ids);
        return array_map(fn($dal) => new Asset($dal), $dals);
    }

    public function Delete(): void {
        if (!empty($this->_EntityDAL->ID)) {
            $this->_EntityDAL->Delete();
        }
    }

    public static function GetSEOURL(Asset $asset): string {
        if ($asset === null) return "";
        $name = sanitizeNameForUrl($asset->getName());
        if ($asset->getAssetTypeID() == AssetType::$PlaceID) {
            return "/{$name}-place?id={$asset->getID()}/";
        }
        return "/{$name}-item?id={$asset->getID()}/";
    }

    public function IsPlace(): bool { return $this->getAssetTypeID() === 9; }
    public function IsDecal(): bool { return $this->getAssetTypeID() === 13; }
    public function IsModel(): bool { return $this->getAssetTypeID() === 10; }
    public function IsAudio(): bool { return $this->getAssetTypeID() === 3; }
    public function IsMesh(): bool { return $this->getAssetTypeID() === 4; }
    public function IsPackage(): bool { return $this->getAssetTypeID() === 32; }
    public function IsAnimation(): bool { return $this->getAssetTypeID() === 24; }
    public function IsClothing(): bool { return in_array($this->getAssetTypeID(), [11, 12], true); }
    public function IsGear(): bool { return $this->getAssetTypeID() === 19; }

    public function PassesGearCategoryMatch(int $gearCategory): bool {
        return ($this->getAssetCategories() & $gearCategory) === $gearCategory;
    }

    public function HasGenre(int $genre): bool {
        return ($this->getAssetGenres() & $genre) === $genre;
    }

    public function CanBeTakenDown(): bool { return !$this->IsPlace(); }

    public static function GetAssetsByCreator(int $creatorId, int $limit = 50, int $offset = 0): array {
        $dals = AssetDAL::GetAssetsByCreator($creatorId, $limit, $offset);
        return array_map(fn($dal) => new Asset($dal), $dals);
    }
    public static function GetAssetsByType(int $assetTypeId, int $limit = 50, int $offset = 0): array {
        $dals = AssetDAL::GetAssetsByType($assetTypeId, $limit, $offset);
        return array_map(fn($dal) => new Asset($dal), $dals);
    }
    public static function GetRecentAssets(int $limit = 50, int $offset = 0): array {
        $dals = AssetDAL::GetRecentAssets($limit, $offset);
        return array_map(fn($dal) => new Asset($dal), $dals);
    }
    public static function SearchByName(string $name, int $limit = 50, int $offset = 0): array {
        $dals = AssetDAL::SearchByName($name, $limit, $offset);
        return array_map(fn($dal) => new Asset($dal), $dals);
    }

    public function GetOptions(): AssetOption {
        return AssetOption::GetOrCreate($this->getID());
    }

    public function MembershipLevelOk(?array $user): bool {
        if (Settings::$settings["BCOnlyPlacesEnabled"]) {
            return true;
        }
        $assetOption = $this->GetOptions();
        $minLevel = $assetOption->getMinMembershipType();

        if ($minLevel == 0) return true;
        if ($user === null) return false;

        $userLevel = $user["membership_type"] ?? 0;
        return $userLevel >= $minLevel;
    }
}
