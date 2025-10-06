<?php
namespace Roblox\Economy\Common;

class TransactionType {
    const CreditID = 1;
    const DebitID = 2;
    const AdjustmentID = 3;
    const AffiliateSaleID = 4; // to be defined

    public static function GetName($id) {
        switch ($id) {
            case self::CreditID: return "Credit";
            case self::DebitID: return "Debit";
            case self::AdjustmentID: return "Adjustment";
            case self::AffiliateSaleID: return "Affiliate Sale";
            default: return "Unknown";
        }
    }
}
