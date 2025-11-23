<?php
namespace Roblox\Economy\Common;

class TransactionOriginType {
    const CurrencyPurchaseID = 1;
    const DailyLoginAwardID = 2;
    const PlaceTrafficAwardID = 3;
    const SaleOfGoodsID = 4;
    const BuildersClubSignupBonusID = 5;
    const MiscellaneousAdjustmentID = 6;
    const CurrencyTradeID = 7;
    const TradeSystemTradeID = 8;
    const BuildersClubStipendBonusID = 9;
    const AdjustmentByRobloxAdminID = 10;
    const OrganicAcquisitionTargetedID = 11;
    const OrganicAcquisitionPromotedID = 12;
    const GroupRevenuePayoutID = 13;

    public static function GetName($id) {
        $map = [
            self::CurrencyPurchaseID => "Currency Purchase",
            self::DailyLoginAwardID => "Daily Login Award",
            self::PlaceTrafficAwardID => "Place Traffic Award",
            self::SaleOfGoodsID => "Sale of Goods",
            self::BuildersClubSignupBonusID => "BC Signup Bonus",
            self::MiscellaneousAdjustmentID => "Misc Adjustment",
            self::CurrencyTradeID => "Currency Trade",
            self::TradeSystemTradeID => "Trade System",
            self::BuildersClubStipendBonusID => "BC Stipend",
            self::AdjustmentByRobloxAdminID => "Admin Adjustment",
            self::OrganicAcquisitionTargetedID => "Organic Acquisition (Targeted)",
            self::OrganicAcquisitionPromotedID => "Organic Acquisition (Promoted)",
            self::GroupRevenuePayoutID => "Group Payout"
        ];
        return $map[$id] ?? "Unknown";
    }
}
