<?php

namespace Roblox\Economy;

use Roblox\Economy\Common\TransactionHistory;
use Roblox\Economy\Common\TransactionOriginType;
use Roblox\Economy\Common\TransactionType;

class CreatorType
{
    public const User = 1;
    public const Group = 2;
}

class PurchaseType
{
    public const Purchase = 1;
    public const Sale = 2;
    public const GroupPayouts = 3;
}

class TransactionSubType
{
    public const GroupPayoutReceived = 1;
    public const GroupPayoutSent = 2;
    public const AudioUploadLong = 3;
    public const GameMediaUpload = 4;
    public const ItemPurchase = 5;
    public const ItemResalePurchase = 6;
    public const ItemSale = 7;
    public const ItemResale = 8;
}

class CurrencyType
{
    public const Robux = 1;
    public const Tickets = 2;
}

class EconomyTransactionBase
{
    public int $userIdOne = 0;
    public int $userIdTwo = 0;
    public int $type = 0;
    public ?int $subType = null;
    public ?string $itemName = null;
    public int $amount = 0;
    public int $currencyType = 0;
    public ?int $groupIdOne = null;
    public ?int $groupIdTwo = null;
    public ?int $assetId = null;
    public ?int $userAssetId = null;
    public ?string $oldUsername = null;
    public ?string $newUsername = null;

    public function setSelf(int $type, int $id): void
    {
        if ($type === CreatorType::Group) {
            $this->groupIdOne = $id;
        } elseif ($type === CreatorType::User) {
            $this->userIdOne = $id;
        } else {
            throw new \InvalidArgumentException($type . ' is invalid: ' . $type);
        }
    }

    public function setOther(int $type, int $id): void
    {
        if ($type === CreatorType::Group) {
            $this->groupIdTwo = $id;
        } elseif ($type === CreatorType::User) {
            $this->userIdTwo = $id;
        } else {
            throw new \InvalidArgumentException($type . ' is invalid: ' . $type);
        }
    }

    public function submitHistory(int $userId, int $transactionTypeId, int $transactionOriginTypeId, ?int $saleId = null): void
    {
        if ($userId <= 0 || $this->amount <= 0) {
            return;
        }

        TransactionHistory::submit($userId, $transactionTypeId, $transactionOriginTypeId, $this->currencyType, $this->amount, $saleId);
    }
}

interface IEconomyTransaction
{
    public function getDto(): EconomyTransactionBase;
}

class GroupFundRecipientTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $creatorType, int $creatorId, int $groupId, int $currencyType, int $amount)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currencyType;
        $this->transaction->type = PurchaseType::GroupPayouts;
        $this->transaction->subType = TransactionSubType::GroupPayoutReceived;
        $this->transaction->setSelf($creatorType, $creatorId);
        $this->transaction->setOther(CreatorType::Group, $groupId);
        $this->transaction->submitHistory($creatorId, TransactionType::CreditID, TransactionOriginType::GroupRevenuePayoutID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class GroupFundPayoutTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $groupId, int $currencyType, int $amount, int $recipientType, int $recipientId)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currencyType;
        $this->transaction->type = PurchaseType::GroupPayouts;
        $this->transaction->subType = TransactionSubType::GroupPayoutSent;
        $this->transaction->setSelf(CreatorType::Group, $groupId);
        $this->transaction->setOther($recipientType, $recipientId);
        $this->transaction->submitHistory($groupId, TransactionType::DebitID, TransactionOriginType::GroupRevenuePayoutID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class AudioUploadTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $creatorType, int $creatorId)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->amount = 100;
        $this->transaction->currencyType = CurrencyType::Robux;
        $this->transaction->type = PurchaseType::Purchase;
        $this->transaction->subType = TransactionSubType::AudioUploadLong;
        $this->transaction->setSelf($creatorType, $creatorId);
        $this->transaction->setOther(CreatorType::User, 1);
        $this->transaction->submitHistory($creatorId, TransactionType::CreditID, TransactionOriginType::MiscellaneousAdjustmentID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class GameThumbnailUploadTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $creatorType, int $creatorId)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->amount = 10;
        $this->transaction->currencyType = CurrencyType::Robux;
        $this->transaction->type = PurchaseType::Purchase;
        $this->transaction->subType = TransactionSubType::GameMediaUpload;
        $this->transaction->setSelf($creatorType, $creatorId);
        $this->transaction->setOther(CreatorType::User, 1);
        $this->transaction->submitHistory($creatorId, TransactionType::CreditID, TransactionOriginType::MiscellaneousAdjustmentID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class AssetPurchaseTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $userIdPurchaser, int $sellerType, int $sellerId, int $currency, int $amount, int $assetId, int $userAssetId)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->userIdOne = $userIdPurchaser;
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currency;
        $this->transaction->type = PurchaseType::Purchase;
        $this->transaction->subType = TransactionSubType::ItemPurchase;
        $this->transaction->userAssetId = $userAssetId;
        $this->transaction->assetId = $assetId;
        $this->transaction->setOther($sellerType, $sellerId);
        $this->transaction->submitHistory($userIdPurchaser, TransactionType::DebitID, TransactionOriginType::SaleOfGoodsID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class DevProdPurchaseTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $userIdPurchaser, int $sellerType, int $sellerId, int $currency, int $amount, string $productName)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->userIdOne = $userIdPurchaser;
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currency;
        $this->transaction->type = PurchaseType::Purchase;
        $this->transaction->itemName = $productName;
        $this->transaction->setOther($sellerType, $sellerId);
        $this->transaction->submitHistory($userIdPurchaser, TransactionType::DebitID, TransactionOriginType::SaleOfGoodsID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class DevProdSaleTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $userIdPurchaser, int $sellerType, int $sellerId, int $currency, int $amount, string $productName)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->userIdTwo = $userIdPurchaser;
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currency;
        $this->transaction->type = PurchaseType::Sale;
        $this->transaction->itemName = $productName;
        $this->transaction->setSelf($sellerType, $sellerId);
        $this->transaction->submitHistory($userIdPurchaser, TransactionType::CreditID, TransactionOriginType::SaleOfGoodsID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class AssetResalePurchaseTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $userIdPurchaser, int $sellerId, int $currency, int $amount, int $assetId, int $userAssetId)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->userIdOne = $userIdPurchaser;
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currency;
        $this->transaction->type = PurchaseType::Purchase;
        $this->transaction->subType = TransactionSubType::ItemResalePurchase;
        $this->transaction->userIdTwo = $sellerId;
        $this->transaction->userAssetId = $userAssetId;
        $this->transaction->assetId = $assetId;
        $this->transaction->submitHistory($userIdPurchaser, TransactionType::DebitID, TransactionOriginType::SaleOfGoodsID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class AssetSaleTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $userIdPurchaser, int $sellerType, int $sellerId, int $currency, int $amount, int $assetId, int $userAssetId)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->userIdTwo = $userIdPurchaser;
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currency;
        $this->transaction->type = PurchaseType::Sale;
        $this->transaction->subType = TransactionSubType::ItemSale;
        $this->transaction->userAssetId = $userAssetId;
        $this->transaction->assetId = $assetId;
        $this->transaction->setSelf($sellerType, $sellerId);
        $this->transaction->submitHistory($userIdPurchaser, TransactionType::CreditID, TransactionOriginType::SaleOfGoodsID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}

class AssetReSaleTransaction implements IEconomyTransaction
{
    private EconomyTransactionBase $transaction;

    public function __construct(int $userIdPurchaser, int $userIdSeller, int $currency, int $amount, int $assetId, int $userAssetId)
    {
        $this->transaction = new EconomyTransactionBase();
        $this->transaction->userIdTwo = $userIdPurchaser;
        $this->transaction->userIdOne = $userIdSeller;
        $this->transaction->amount = $amount;
        $this->transaction->currencyType = $currency;
        $this->transaction->type = PurchaseType::Sale;
        $this->transaction->subType = TransactionSubType::ItemResale;
        $this->transaction->userAssetId = $userAssetId;
        $this->transaction->assetId = $assetId;
        $this->transaction->submitHistory($userIdPurchaser, TransactionType::CreditID, TransactionOriginType::SaleOfGoodsID);
    }

    public function getDto(): EconomyTransactionBase
    {
        return $this->transaction;
    }
}
