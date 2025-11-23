<?php
// ported by meditext
namespace Roblox\Economy\Common;

use PDO;

class TransactionHistoryDAL {
    public $id;
    public $transactionTypeId;
    public $transactionOriginTypeId;
    public $currencyTypeId;
    public $userId;
    public $saleId;
    public $amount;
    public $isProcessed;
    public $created;
    public $updated;

    public function __construct() {
        $this->created = date("Y-m-d H:i:s");
        $this->updated = date("Y-m-d H:i:s");
    }

    public function insert($conn) {
        $stmt = $conn->prepare("
            INSERT INTO transaction_history
            (transaction_type_id, transaction_origin_type_id, currency_type_id, user_id, sale_id, amount, is_processed, created, updated)
            VALUES (:type, :origin, :currency, :user, :sale, :amount, :processed, :created, :updated)
            RETURNING id
        ");
        $stmt->execute([
            ':type' => $this->transactionTypeId,
            ':origin' => $this->transactionOriginTypeId,
            ':currency' => $this->currencyTypeId,
            ':user' => $this->userId,
            ':sale' => $this->saleId,
            ':amount' => $this->amount,
            ':processed' => $this->isProcessed ? 1 : 0,
            ':created' => $this->created,
            ':updated' => $this->updated
        ]);
        $this->id = $stmt->fetchColumn();
    }

    public function update($conn) {
        $stmt = $conn->prepare("
            UPDATE transaction_history
            SET transaction_type_id = :type,
                transaction_origin_type_id = :origin,
                currency_type_id = :currency,
                user_id = :user,
                sale_id = :sale,
                amount = :amount,
                is_processed = :processed,
                updated = NOW()
            WHERE id = :id
        ");
        $stmt->execute([
            ':id' => $this->id,
            ':type' => $this->transactionTypeId,
            ':origin' => $this->transactionOriginTypeId,
            ':currency' => $this->currencyTypeId,
            ':user' => $this->userId,
            ':sale' => $this->saleId,
            ':amount' => $this->amount,
            ':processed' => $this->isProcessed ? 1 : 0
        ]);
    }

    public static function get($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM transaction_history WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        $dal = new TransactionHistoryDAL();
        foreach ($row as $k => $v) {
            $dal->$k = $v;
        }
        return $dal;
    }

    public static function getTransactionsTotalAmountByCriteria($conn, $userId, $transactionTypeId, $transactionOriginTypeId, $currencyTypeId, $fromDate) {
        $stmt = $conn->prepare("
            SELECT COALESCE(SUM(amount), 0) 
            FROM transaction_history
            WHERE user_id = :user
              AND transaction_type_id = :type
              AND transaction_origin_type_id = :origin
              AND currency_type_id = :currency
              AND created >= :fromdate
        ");
        $stmt->execute([
            ':user' => $userId,
            ':type' => $transactionTypeId,
            ':origin' => $transactionOriginTypeId,
            ':currency' => $currencyTypeId,
            ':fromdate' => $fromDate
        ]);
        return (int) $stmt->fetchColumn();
    }
    // robux
    public static function getRobuxEarnedCount($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, 0, 1, $fromDate
        );
    }

    public static function getRobuxEarnedFromSaleOfGoods($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::SaleOfGoodsID, 1, $fromDate
        );
    }

    public static function getRobuxEarnedFromLoginAwards($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::DailyLoginAwardID, 1, $fromDate
        );
    }

    public static function getRobuxEarnedFromCurrencyPurchase($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::CurrencyPurchaseID, 1, $fromDate
        );
    }

    public static function getRobuxEarnedFromSignupBonus($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::BuildersClubSignupBonusID, 1, $fromDate
        );
    }

    public static function getRobuxEarnedFromBCStipendBonus($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::BuildersClubStipendBonusID, 1, $fromDate
        );
    }

    public static function getRobuxEarnedFromGroupPayouts($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::GroupRevenuePayoutID, 1, $fromDate
        );
    }

    public static function getRobuxDebitedFromGroupPayouts($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::DebitID, TransactionOriginType::GroupRevenuePayoutID, 1, $fromDate
        );
    }

    public static function getRobuxAdjustedFromAdjustments($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::AdjustmentID, TransactionOriginType::MiscellaneousAdjustmentID, 1, $fromDate
        );
    }

    public static function getRobuxCreditedFromAdjustments($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::MiscellaneousAdjustmentID, 1, $fromDate
        );
    }

    public static function getRobuxDebitedFromAdjustments($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::DebitID, TransactionOriginType::MiscellaneousAdjustmentID, 1, $fromDate
        );
    }

    public static function getRobuxCreditedFromCurrencyTrade($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::CurrencyTradeID, 1, $fromDate
        );
    }

    public static function getRobuxDebitedFromCurrencyTrade($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::DebitID, TransactionOriginType::CurrencyTradeID, 1, $fromDate
        );
    }

    public static function getRobuxCreditedFromTradeSystem($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::TradeSystemTradeID, 1, $fromDate
        );
    }

    public static function getRobuxOrganicAcquisitionTargetedPayoutAmount($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::OrganicAcquisitionTargetedID, 1, $fromDate
        );
    }

    public static function getRobuxOrganicAcquisitionPromotedPayoutAmount($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::OrganicAcquisitionPromotedID, 1, $fromDate
        );
    }

    public static function getRobuxRobloxAdjustmentAmount($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::AdjustmentID, TransactionOriginType::AdjustmentByRobloxAdminID, 1, $fromDate
        );
    }
    // tickets
    public static function getTicketsEarnedCount($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, 0, 2, $fromDate
        );
    }
    public static function getTicketsEarnedFromLoginAwards($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::DailyLoginAwardID, 2, $fromDate
        );
    }
    public static function getTicketsEarnedFromPlaceTraffic($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::PlaceTrafficAwardID, 2, $fromDate
        );
    }
    public static function getTicketsEarnedFromSaleOfGoods($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::SaleOfGoodsID, 2, $fromDate
        );
    }
    public static function getTicketsEarnedFromGroupPayouts($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::CreditID, TransactionOriginType::GroupRevenuePayoutID, 2, $fromDate
        );
    }

    public static function getTicketsDebitedFromGroupPayouts($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::DebitID, TransactionOriginType::GroupRevenuePayoutID, 2, $fromDate
        );
    }
    public static function getTicketsDebitedFromCurrencyTrade($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::DebitID, TransactionOriginType::CurrencyTradeID, 2, $fromDate
        );
    }
    public static function getTicketsRobloxAdjustmentAmount($conn, $userId, $fromDate) {
        return self::getTransactionsTotalAmountByCriteria(
            $conn, $userId, TransactionType::AdjustmentID, TransactionOriginType::AdjustmentByRobloxAdminID, 2, $fromDate
        );
    }
}
