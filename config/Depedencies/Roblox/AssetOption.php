<?php
namespace Roblox;

use Roblox\DataAccess\AssetOptionDAL;

class AssetOption {
    private AssetOptionDAL $_EntityDAL;

    public function __construct(?AssetOptionDAL $dal = null) {
        $this->_EntityDAL = $dal ?? new AssetOptionDAL();
    }

    public function getID(): int { return $this->_EntityDAL->ID; }
    public function getAssetID(): int { return $this->_EntityDAL->AssetID; }
    public function setAssetID(int $value): void { $this->_EntityDAL->AssetID = $value; }

    public function getEnableComments(): bool { return $this->_EntityDAL->EnableComments; }
    public function setEnableComments(bool $value): void { $this->_EntityDAL->EnableComments = $value; }

    public function getEnableRatings(): bool { return $this->_EntityDAL->EnableRatings; }
    public function setEnableRatings(bool $value): void { $this->_EntityDAL->EnableRatings = $value; }

    public function getIsCopyLocked(): bool { return $this->_EntityDAL->IsCopyLocked; }
    public function setIsCopyLocked(bool $value): void { $this->_EntityDAL->IsCopyLocked = $value; }

    public function getIsFriendsOnly(): bool { return $this->_EntityDAL->IsFriendsOnly; }
    public function setIsFriendsOnly(bool $value): void { $this->_EntityDAL->IsFriendsOnly = $value; }

    public function getIsAllowingGear(): bool { return $this->_EntityDAL->IsAllowingGear; }
    public function setIsAllowingGear(bool $value): void { $this->_EntityDAL->IsAllowingGear = $value; }

    public function getAllowedGearCategories(): int { return $this->_EntityDAL->AllowedGearCategories; }
    public function setAllowedGearCategories(int $value): void { $this->_EntityDAL->AllowedGearCategories = $value; }

    public function getDefaultExpirationInTicks(): ?int { return $this->_EntityDAL->DefaultExpirationInTicks; }
    public function setDefaultExpirationInTicks(?int $value): void { $this->_EntityDAL->DefaultExpirationInTicks = $value; }

    public function getCreated(): string { return $this->_EntityDAL->Created; }
    public function getUpdated(): string { return $this->_EntityDAL->Updated; }

    public function getEnforceGenre(): bool { return $this->_EntityDAL->EnforceGenre; }
    public function setEnforceGenre(bool $value): void { $this->_EntityDAL->EnforceGenre = $value; }

    public function getMinMembershipType(): int { return $this->_EntityDAL->MinMembershipType; }
    public function setMinMembershipType(int $value): void { $this->_EntityDAL->MinMembershipType = $value; }

    // === Core Methods ===
    public function Save(): void {
        if (empty($this->_EntityDAL->ID)) {
            $this->_EntityDAL->Insert();
        } else {
            $this->_EntityDAL->Update();
        }
    }

    public function Delete(): void {
        $this->_EntityDAL->Delete();
    }

    public static function Get(int $id): ?AssetOption {
        $dal = AssetOptionDAL::Get($id);
        return $dal ? new AssetOption($dal) : null;
    }

    public static function GetByAssetID(int $assetId): ?AssetOption {
        $dal = AssetOptionDAL::GetByAssetID($assetId);
        return $dal ? new AssetOption($dal) : null;
    }

    public static function GetOrCreate(int $assetId): AssetOption {
        $option = self::GetByAssetID($assetId);
        if ($option === null) {
            $dal = new AssetOptionDAL();
            $dal->AssetID = $assetId;
            $dal->Insert();
            return new AssetOption($dal);
        }
        return $option;
    }
}
