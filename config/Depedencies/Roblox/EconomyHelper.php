<?php
namespace Roblox;
use Roblox\Economy\Common\RobuxBalance;
use Roblox\Economy\Common\TicketsBalance;
use Roblox\Economy\Common\TransactionHistory;
use Roblox\Economy\Common\TransactionType;
use Roblox\Economy\Common\TransactionOriginType;
use Roblox\Economy\Product;
use Roblox\Economy\Sale;
use Roblox\Economy\ProductType;
use Roblox\Authentication;
use Roblox\UserAsset;
use Roblox\AssetOption;
use Roblox\AssetCounter;
use Exception;
use DateTime;

class EconomyHelper
{
    private static int $MinimumFee_Robux = 1;
    private static int $MinimumFee_Tickets = 1;

    private static function getMarketplaceFee(int $currencyTypeId, int $purchasePrice): int
    {
        $minimumFee = 0;
        $derivedFee = 0;
        $itemPrice = (float)$purchasePrice;

        if ($currencyTypeId === 1) { // Robux
            $minimumFee = self::$MinimumFee_Robux;
            $derivedFee = (int)round($itemPrice / 10.0);
        } elseif ($currencyTypeId === 2) { // Tickets
            $minimumFee = self::$MinimumFee_Tickets;
            $derivedFee = (int)round($itemPrice / 10.0);
        }

        return max($derivedFee, $minimumFee);
    }

    public static function conductSale(int $purchaserId, int $sellerId, int $productId, int $currencyTypeId): void
    {
        $product = Product::get($productId);
        if (!$product) {
            throw new Exception("Product {$productId} not found.");
        }

        $purchaser = Authentication::GetUserInfo($purchaserId);
        if (!$purchaser) {
            throw new Exception("Purchaser not found.");
        }

        if ($product->productOptions && $product->productOptions->offSaleDeadline && strtotime($product->productOptions->offSaleDeadline) < time()) {
            throw new Exception("Product is no longer for sale.");
        }

        if ($product->isPublicDomain) {
            self::handleFreeProductTransaction($purchaserId, $sellerId, $product, $currencyTypeId);
        } elseif ($product->isForSale) {
            self::handleForSaleProductTransaction($purchaserId, $sellerId, $product, $currencyTypeId);
        }
    }

    private static function handleFreeProductTransaction(int $purchaserId, int $sellerId, Product $product, int $currencyTypeId): void
    {
        $awarded = true;
        if (ProductType::Get($product->productTypeId) == "User Product") {
            $assetOption = AssetOption::getOrCreate($product->assetId);
            if ($assetOption && $assetOption->defaultExpirationInTicks) {
                foreach (UserAsset::getUserAssets($purchaserId, $product->assetId) as $ua) {
                    if ($ua->isExpired()) {
                        $ua->delete();
                    }
                }
            }
            UserAsset::awardUserAsset($product->assetId, $purchaserId, true, $awarded);
        }

        if ($awarded) {
            Sale::createNew($purchaserId, $sellerId, $product, $currencyTypeId, 1, 0, 0, 0, 0);
        }
    }

    private static function handleForSaleProductTransaction(int $purchaserId, int $sellerId, Product $product, int $currencyTypeId): void
    {
        $purchasePrice = $product->getPrice($currencyTypeId);
        if ($purchasePrice === null) {
            throw new Exception("Product not available in this currency.");
        }

        $awardedUserAsset = null;
        if (ProductType::Get($product->productTypeId) == "User Product") {
            $assetOption = AssetOption::getOrCreate($product->assetId);
            if ($assetOption && $assetOption->defaultExpirationInTicks) {
                foreach (UserAsset::getUserAssets($purchaserId, $product->assetId) as $ua) {
                    if ($ua->isExpired()) {
                        $ua->delete();
                    }
                }
            }
            if (UserAsset::exists($purchaserId, $product->assetId)) {
                return;
            }
            $awardedUserAsset = UserAsset::award($product->assetId, $purchaserId, true);
        }

        $balance = ($currencyTypeId === 1) ? RobuxBalance::Get($purchaserId) : TicketsBalance::Get($purchaserId);
        if (!$balance->tryDebit($purchasePrice)) {
            if ($awardedUserAsset) {
                $awardedUserAsset->delete();
            }
            throw new Exception("Insufficient funds.");
        }

        $marketplaceFee = self::getMarketplaceFee($currencyTypeId, $purchasePrice);
        $totalPrice = $purchasePrice;
        $sellerCredit = $totalPrice - $marketplaceFee;

        $sale = Sale::CreateNew($purchaserId, $sellerId, $product, $currencyTypeId, 1, $purchasePrice, 0, $totalPrice, $marketplaceFee);

        TransactionHistory::createNew($purchaserId, TransactionType::DebitID, TransactionOriginType::SaleOfGoodsID, $currencyTypeId, $totalPrice, $sale->id);

        if ($sellerCredit > 0) {
            $sellerBalance = ($currencyTypeId === 1) ? RobuxBalance::Get($sellerId) : TicketsBalance::Get($sellerId);
            $sellerBalance->Credit($sellerCredit);
            TransactionHistory::createNew($sellerId, TransactionType::CreditID, TransactionOriginType::SaleOfGoodsID, $currencyTypeId, $sellerCredit, $sale->id);
        }
    }

    public static function conductRobloxProductSaleByAuction(int $purchaserId, int $productId, int $currencyTypeId, int $purchasePrice): void
    {
        $product = Product::GetById($productId);
        if (!$product) {
            throw new Exception("Product {$productId} not found.");
        }

        if (ProductType::Get($product->ProductTypeID) != "ROBLOX Product") {
            throw new Exception("Invalid product type for auction.");
        }

        $purchaser = Authentication::GetUserInfo($purchaserId);
        if (!$purchaser) {
            throw new Exception("Purchaser not found.");
        }

        $balance = ($currencyTypeId === 1) ? RobuxBalance::Get($purchaserId) : TicketsBalance::Get($purchaserId);
        if (!$balance->TryDebit($purchasePrice)) {
            throw new Exception("User {$purchaserId} has insufficient funds.");
        }

        $sale = Sale::createNew($purchaserId, 1, $product->ID, $currencyTypeId, 1, $purchasePrice, 0, $purchasePrice, 0);
        TransactionHistory::createNew($purchaserId, TransactionType::DebitID, TransactionOriginType::SaleOfGoodsID, $currencyTypeId, $purchasePrice, $sale->getId());
    }

    // stubs for future trading system port
    public static function getEstimatedTradeReturnForRobux(int $robux): int
    {
        return 0;
    }

    public static function getEstimatedTradeReturnForTickets(int $tickets): int
    {
        return 0;
    }

    public static function testAndHandleItemDeadlineExpiration(int $assetId): void
    {
        $asset = Asset::get($assetId);
        if (!$asset) return;

        $product = Product::getByAsset($asset->id);
        if (!$product) return;

        $productOption = $product->productOptions ?? null;
        if (!$productOption || !$productOption->hasOffSaleDeadline) return;

        if ($productOption->offSaleDeadline && strtotime($productOption->offSaleDeadline) > time()) return;

        if (!$productOption->isResellable) {
            $product->isForSale = false;

            if ($product->isLimitedEdition) {
                $counter = AssetCounter::getOrCreate($product->assetId, 'NumberSoldByRobloxID');
                $product->totalAvailable = $counter->value;
                $product->numberRemaining = 0;
                $productOption->isResellable = true;
            }

            $product->save();
        }

        $productOption->offSaleDeadline = null;
        $productOption->save();
    }
}
