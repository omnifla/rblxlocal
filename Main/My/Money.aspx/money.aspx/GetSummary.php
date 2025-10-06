<?php
// written by meditext

include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
header('Content-Type: application/json');

use Roblox\Authentication;
use Roblox\Economy\Common\TransactionHistory;
use Roblox\Economy\Common\TransactionType;
use Roblox\Economy\Common\TransactionOriginType;
use Roblox\Economy\Common\CurrencyType;

$user = Authentication::GetAuthenticatedUser();
if (!$user) {
    echo json_encode(['d' => json_encode(['error' => 'unauthorized'])]);
    exit;
}


$input = json_decode(file_get_contents('php://input'), true) ?: [];
$timePeriod = $input['timePeriod'] ?? null;
$userId = (int)$user['id'];

$summary = [
    "R_SaleOfGoods" => 0,
    "R_GroupPayouts" => 0,
    "R_TradeSystem" => 0,
    "R_PendingSales" => 0,
    "CurrencyPurchase" => 0,
    "BCStipend" => 0,
    "BCStipendBonus" => 0,
    "PromotedPageConversionRevenue" => 0,
    "GamePageConversionRevenue" => 0,
    "LoginAward" => 0,
    "PlaceTraffic" => 0,
    "T_SaleOfGoods" => 0,
    "T_PendingSales" => 0,
    "T_GroupPayouts" => 0,
    "R_Total" => 0,
    "T_Total" => 0
];

$calc = [
    "day" => "-1 days",
    "week" => "-7 days",
    "month" => "-30 days",
    "year" => "-365 days"
];


try {
    $fromDate = new DateTime($calc[$timePeriod] ?? "-7 days");
    $fromDateStr = $fromDate->format('Y-m-d H:i:s');

    // robux
    $summary["R_SaleOfGoods"] = (int) TransactionHistory::__callStatic("getRobuxEarnedFromSaleOfGoods", [$userId, $fromDateStr]);
    $summary["R_GroupPayouts"] = (int) TransactionHistory::__callStatic("getRobuxEarnedFromGroupPayouts", [$userId, $fromDateStr]);
    $summary["R_TradeSystem"] = (int) TransactionHistory::__callStatic("getRobuxCreditedFromTradeSystem", [$userId, $fromDateStr]);
    $summary["CurrencyPurchase"] = (int) TransactionHistory::__callStatic("getRobuxEarnedFromCurrencyPurchase", [$userId, $fromDateStr]);
    $summary["BCStipend"] = (int) TransactionHistory::__callStatic("getRobuxEarnedFromSignupBonus", [$userId, $fromDateStr]);
    $summary["BCStipendBonus"] = (int) TransactionHistory::__callStatic("getRobuxEarnedFromBCStipendBonus", [$userId, $fromDateStr]);
    $summary["PromotedPageConversionRevenue"] = (int) TransactionHistory::__callStatic("getRobuxOrganicAcquisitionPromotedPayoutAmount", [$userId, $fromDateStr]);
    $summary["GamePageConversionRevenue"] = (int) TransactionHistory::__callStatic("getRobuxOrganicAcquisitionTargetedPayoutAmount", [$userId, $fromDateStr]);

    // tickets
    $summary["LoginAward"] = (int) TransactionHistory::__callStatic("getTicketsEarnedFromLoginAwards", [$userId, $fromDateStr]);
    $summary["PlaceTraffic"] = (int) TransactionHistory::__callStatic("getTicketsEarnedFromPlaceTraffic", [$userId, $fromDateStr]);
    $summary["T_SaleOfGoods"] = (int) TransactionHistory::__callStatic("getTicketsEarnedFromSaleOfGoods", [$userId, $fromDateStr]);
    $summary["T_GroupPayouts"] = (int) TransactionHistory::__callStatic("getTicketsEarnedFromGroupPayouts", [$userId, $fromDateStr]);

    $R_total = 0;
    $T_total = 0;
    foreach ($summary as $k => $v) {
        if ($k === 'R_Total' || $k === 'T_Total') continue;
        if (strpos($k, 'R_') === 0 || ($k == "CurrencyPurchase" || strpos($k, 'BCStipend') === 0 || $k == "PromotedPageConversionRevenue" || $k == "GamePageConversionRevenue")) $R_total += (int)$v;
        if (strpos($k, 'T_') === 0 || ($k == "LoginAward" || $k == "PlaceTraffic")) $T_total += (int)$v;
    }
    $summary['R_Total'] = $R_total;
    $summary['T_Total'] = $T_total;

    echo json_encode(['d' => json_encode($summary)]);
    exit;
} catch (Throwable $ex) {
    echo json_encode(['d' => json_encode(['error' => 'internal_error', 'message' => $ex->getMessage()])]);
    exit;
}