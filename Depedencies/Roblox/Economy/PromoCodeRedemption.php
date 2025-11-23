<?php
// ported by meditext
namespace Roblox\Economy;

use Roblox\DataAccess\PromoCodeRedemptionDAL;
use DateTime;

class PromoCodeRedemption {
    private PromoCodeRedemptionDAL $_EntityDAL;

    public function __construct(?PromoCodeRedemptionDAL $dal = null) {
        $this->_EntityDAL = $dal ?? new PromoCodeRedemptionDAL();
    }

    public function getID(): int { return $this->_EntityDAL->ID; }
    public function getPromoCodeID(): int { return $this->_EntityDAL->PromoCodeID; }
    public function setPromoCodeID(int $value): void { $this->_EntityDAL->PromoCodeID = $value; }
    public function getUserID(): int { return $this->_EntityDAL->UserID; }
    public function setUserID(int $value): void { $this->_EntityDAL->UserID = $value; }

    public function getCreated(): string { return $this->_EntityDAL->Created; }
    public function getUpdated(): string { return $this->_EntityDAL->Updated; }

    public function Save(): void {
        if (empty($this->_EntityDAL->ID)) {
            $this->_EntityDAL->Created = date("Y-m-d H:i:s");
            $this->_EntityDAL->Updated = $this->_EntityDAL->Created;
            $this->_EntityDAL->Insert();
        } else {
            $this->_EntityDAL->Updated = date("Y-m-d H:i:s");
            $this->_EntityDAL->Update();
        }
    }

    public function Delete(): void {
        if (!empty($this->_EntityDAL->ID)) {
            $this->_EntityDAL->Delete();
        }
    }

    public static function Get(int $id): ?PromoCodeRedemption {
        $dal = PromoCodeRedemptionDAL::Get($id);
        return $dal ? new PromoCodeRedemption($dal) : null;
    }

    public static function GetByPromoCodeIDAndUserID(int $promoCodeId, int $userId): ?PromoCodeRedemption {
        $dal = PromoCodeRedemptionDAL::GetByPromoCodeIDAndUserID($promoCodeId, $userId);
        return $dal ? new PromoCodeRedemption($dal) : null;
    }

    public static function MultiGet(array $ids): array {
        $dals = PromoCodeRedemptionDAL::MultiGet($ids);
        return array_map(fn($dal) => new PromoCodeRedemption($dal), $dals);
    }

    public static function GetTotalNumberOfPromoCodeRedemptionsByPromoCodeID(int $promoCodeId): int {
        return PromoCodeRedemptionDAL::GetTotalNumberOfPromoCodeRedemptionsByPromoCodeID($promoCodeId);
    }
}
