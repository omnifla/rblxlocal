<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT']."/../config/main.php";
use Roblox\Economy\PromoCode;
use Roblox\Economy\PromoCodeRedemption;
use Roblox\Authentication as Auth;
use Roblox\Economy\Common\RobuxBalance; // generally used for roblox.
// this makes usage of the PromoCode system and UserAsset. This is not complete yet.
$code = $_GET['code'];
header("Content-Type: application/json; charset=utf-8");
// output data: {"successMsg": str, "successSubText": str, "balance": int, "errorMsg": ?str, "success": bool}
// errorMsgs: "Code already redeemed." "You must be logged in to redeem!" "Invalid code." "Code is expired."
$auth = Auth::GetAuthenticatedUser();
if(!$auth){
    exit(json_encode([
        "success" => false,
        "errorMsg" => "You must be logged in to redeem!"
    ]));
}
$check = PromoCode::GetByCode($code);
if(!$check){
    exit(json_encode([
        "success" => false,
        "errorMsg" => "Invalid Code."
    ]));
}
if($check->isExpired()){
    exit(json_encode([
        "success" => false,
        "errorMsg" => "Code is expired."
    ]));
}
// now, for the redemption code system
$getred = PromoCodeRedemption::GetByPromoCodeIDAndUserID($check->getID(), $auth['id']);
if($getred){
    exit(json_encode([
        "success" => false,
        "errorMsg" => "Code already redeemed."
    ]));
}
if (!$check->CanRedeem()) {
    exit(json_encode([
        "success" => false,
        "errorMsg" => "Promo code cannot be redeemed at this time."
    ]));
}
try {
    global $conn;
    $conn->beginTransaction();

    $check->applyToUser($auth['id']);

    $newred = new PromoCodeRedemption();
    $newred->setUserID($auth['id']);
    $newred->setPromoCodeID($check->getID());
    $newred->Save();

    $conn->commit();
} catch (Exception $ex) {
    if (isset($conn) && $conn->inTransaction()) {
        $conn->rollBack();
    }
    exit(json_encode([
        "success" => false,
        "errorMsg" => "Failed to redeem promo code: " . $ex->getMessage()
    ]));
}
exit(json_encode([
    "success" => true,
    "successMsg" => "Promo code successfully redeemed!",
    "errorMsg" => ""
]));