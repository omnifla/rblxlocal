<?php
// ported by meditext
namespace Roblox\Economy;

use Roblox\DataAccess\PromoCodeDAL;
use Exception;
use DateTime;

class PromoCode
{
    private PromoCodeDAL $_EntityDAL;

    public function __construct(?PromoCodeDAL $dal = null)
    {
        $this->_EntityDAL = $dal ?? new PromoCodeDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }
    public function getCode(): string
    {
        return $this->_EntityDAL->Code;
    }
    public function setCode(string $value): void
    {
        $this->_EntityDAL->Code = $value;
    }

    public function getExpiration(): ?DateTime
    {
        return $this->_EntityDAL->Expiration ? new DateTime($this->_EntityDAL->Expiration) : null;
    }
    public function setExpiration(?DateTime $value): void
    {
        $this->_EntityDAL->Expiration = $value ? $value->format('Y-m-d H:i:s') : null;
    }

    public function getMaxRedemptions(): int
    {
        return $this->_EntityDAL->MaxRedemptions;
    }
    public function setMaxRedemptions(int $value): void
    {
        $this->_EntityDAL->MaxRedemptions = $value;
    }

    public function getRewardRobux(): int
    {
        return $this->_EntityDAL->reward_robux;
    }

    public function setRewardRobux(int $value): void
    {
        $this->_EntityDAL->reward_robux = $value;
    }

    public function getRewardTickets(): int
    {
        return $this->_EntityDAL->reward_tickets;
    }

    public function setRewardTickets(int $value): void
    {
        $this->_EntityDAL->reward_tickets = $value;
    }

    public function getRewardAssetId(): ?int
    {
        return $this->_EntityDAL->reward_asset_id;
    }

    public function setRewardAssetId(?int $value): void
    {
        $this->_EntityDAL->reward_asset_id = $value;
    }

    public function getRewardAssetTypeId(): ?int
    {
        return $this->_EntityDAL->reward_asset_type_id;
    }

    public function setRewardAssetTypeId(?int $value): void
    {
        $this->_EntityDAL->reward_asset_type_id = $value;
    }

    public function getRewardMembershipType(): ?int
    {
        return $this->_EntityDAL->reward_membership_type;
    }

    public function setRewardMembershipType(?int $value): void
    {
        $this->_EntityDAL->reward_membership_type = $value;
    }

    public function getCreated(): string
    {
        return $this->_EntityDAL->Created;
    }
    public function getUpdated(): string
    {
        return $this->_EntityDAL->Updated;
    }

    public function Save(): void
    {
        if (empty($this->_EntityDAL->ID)) {
            $this->_EntityDAL->Created = date("Y-m-d H:i:s");
            $this->_EntityDAL->Updated = $this->_EntityDAL->Created;
            $this->_EntityDAL->Insert();
        } else {
            $this->_EntityDAL->Updated = date("Y-m-d H:i:s");
            $this->_EntityDAL->Update();
        }
    }



    public static function Get(int $id): ?PromoCode
    {
        $dal = PromoCodeDAL::Get($id);
        return $dal ? new PromoCode($dal) : null;
    }

    public static function GetByCode(string $code): ?PromoCode
    {
        $dal = PromoCodeDAL::GetByCode($code);
        return $dal ? new PromoCode($dal) : null;
    }

    public function Delete(): void
    {
        if (!empty($this->_EntityDAL->ID)) {
            $this->_EntityDAL->Delete();
        }
    }

    public function IsExpired(): bool
    {
        $expiration = $this->getExpiration();
        return $expiration && $expiration < new DateTime();
    }

    public function CanRedeem(): bool
    {
        if ($this->IsExpired())
            return false;
        $total = PromoCodeRedemption::GetTotalNumberOfPromoCodeRedemptionsByPromoCodeID($this->getID());
        return $this->getMaxRedemptions() === 0 || $total < $this->getMaxRedemptions();
    }
}
