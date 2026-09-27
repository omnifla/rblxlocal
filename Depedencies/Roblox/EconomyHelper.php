<?php
namespace Roblox;

use PDO;
use Roblox\Economy\Common\TransactionHistory;
use Roblox\Economy\Common\TransactionOriginType;
use Roblox\Economy\Common\TransactionType;
use Roblox\Economy\Common\UserBalance;
use Roblox\Economy\Payment;
use Roblox\Economy\Product;
use Roblox\Economy\Sale;

class EconomyHelper
{
	private const ROBUX_CURRENCY_TYPE_ID = 1;
	private const ROBLOX_PRODUCT_TYPE_ID = 1;
	private const ROBLOX_ACCOUNT_ID = 1;
	private const PAYMENT_STATUS_SUCCESS = 1;

	public static function getMarketplaceFee(
		int $currencyTypeId,
		int $purchasePrice,
		int $sellerUserId,
		bool $isPremiumUser = false
	): int {
		$fee = (int) round(
			$purchasePrice * self::getCommissionRate($sellerUserId, $isPremiumUser),
			0,
			PHP_ROUND_HALF_EVEN
		);
		$minimumFee = $currencyTypeId === self::ROBUX_CURRENCY_TYPE_ID ? 1 : 0;

		return max($fee, $minimumFee);
	}

	public static function getCommissionRate(int $sellerUserId, bool $isPremiumUser = false): float
	{
		global $properties;

		$seller = User::get($sellerUserId);
		if ($seller === null) {
			throw new \InvalidArgumentException('Seller user does not exist.');
		}

		if (!$seller->isAnyBuildersClubMember() && !$isPremiumUser) {
			return (float) ($properties['AssetSaleCommissionRateNonBC'] ?? 0.9);
		}

		return (float) ($properties['AssetSaleCommissionRate'] ?? 0.1);
	}

	public static function conductRobloxProductSaleByAuction(
		int $purchaserId,
		int $productId,
		int $purchasePrice,
		int $platformTypeId = 1,
		?callable $purchaseOperation = null
	): bool {
		global $conn;

		$product = Product::getById($productId);
		if (
			$product === null
			|| $product->ProductTypeID !== self::ROBLOX_PRODUCT_TYPE_ID
			|| !$product->IsForSale
			|| $product->PriceInRobux !== $purchasePrice
			|| $purchasePrice < 1
		) {
			return false;
		}

		if (!$conn->beginTransaction()) {
			return false;
		}

		try {
			$balance = new UserBalance($purchaserId);
			if (!$balance->TryDebitRobux($purchasePrice)) {
				$conn->rollBack();
				return false;
			}

			if ($purchaseOperation !== null) {
				$purchaseOperation();
			}

			$sale = Sale::createNew(
				$purchaserId,
				self::ROBLOX_ACCOUNT_ID,
				$productId,
				self::ROBUX_CURRENCY_TYPE_ID,
				1,
				$purchasePrice,
				0,
				$purchasePrice,
				0
			);

			$payment = new Payment($conn);
			$payment->SaleID = $sale->getId();
			$payment->UnitPrice = $purchasePrice;
			$payment->CurrencyTypeID = self::ROBUX_CURRENCY_TYPE_ID;
			$payment->PaymentStatusTypeID = self::PAYMENT_STATUS_SUCCESS;
			$payment->Insert();

			TransactionHistory::createNew(
				$purchaserId,
				TransactionType::DebitID,
				TransactionOriginType::SaleOfGoodsID,
				self::ROBUX_CURRENCY_TYPE_ID,
				$purchasePrice,
				$sale->getId()
			);

			return $conn->commit();
		} catch (\Throwable $exception) {
			if ($conn->inTransaction()) {
				$conn->rollBack();
			}
			return false;
		}
	}
}
