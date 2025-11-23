<?php
// ported by meditext
namespace Roblox\Economy;

use Exception;
use DateTime;

class Sale
{
    private SaleDAL $dal;

    public function __construct(?SaleDAL $dal = null)
    {
        $this->dal = $dal ?? new SaleDAL();
    }

    public function getId(): int { return $this->dal->id; }
    public function getPurchaserId(): int { return $this->dal->purchaser_id; }
    public function setPurchaserId(int $id): void { $this->dal->purchaser_id = $id; }

    public function getSellerId(): ?int { return $this->dal->seller_id; }
    public function setSellerId(?int $id): void { $this->dal->seller_id = $id; }

    public function getProductId(): int { return $this->dal->product_id; }
    public function setProductId(int $id): void { $this->dal->product_id = $id; }

    public function getQuantity(): int { return $this->dal->quantity; }
    public function setQuantity(int $q): void { $this->dal->quantity = $q; }

    public function getCurrencyTypeId(): int { return $this->dal->currency_type_id; }
    public function setCurrencyTypeId(int $id): void { $this->dal->currency_type_id = $id; }

    public function getUnitPrice(): int { return $this->dal->unit_price; }
    public function setUnitPrice(int $p): void { $this->dal->unit_price = $p; }

    public function getDiscount(): int { return $this->dal->discount; }
    public function setDiscount(int $d): void { $this->dal->discount = $d; }

    public function getTotalPrice(): int { return $this->dal->total_price; }
    public function setTotalPrice(int $p): void { $this->dal->total_price = $p; }

    public function getMarketplaceFee(): int { return $this->dal->marketplace_fee; }
    public function setMarketplaceFee(int $f): void { $this->dal->marketplace_fee = $f; }

    public function getCreated(): DateTime { return new DateTime($this->dal->created); }
    public function getUpdated(): DateTime { return new DateTime($this->dal->updated); }

    public function Save(): void
    {
        if ($this->dal->id === 0) {
            $this->dal->insert();
        } else {
            $this->dal->update();
        }
    }

    public function Delete(): void
    {
        $this->dal->delete();
    }

    public static function Get(int $id): ?self
    {
        $dal = SaleDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function CreateNew(int $purchaserId, ?int $sellerId, int $productId, int $currencyTypeId, int $quantity, int $unitPrice, int $discount, int $totalPrice, int $marketplaceFee): self {
        $dal = new SaleDAL();
        $dal->purchaser_id = $purchaserId;
        $dal->seller_id = $sellerId;
        $dal->product_id = $productId;
        $dal->quantity = $quantity;
        $dal->currency_type_id = $currencyTypeId;
        $dal->unit_price = $unitPrice;
        $dal->discount = $discount;
        $dal->total_price = $totalPrice;
        $dal->marketplace_fee = $marketplaceFee;

        $sale = new self($dal);
        $sale->Save();
        return $sale;
    }
}
