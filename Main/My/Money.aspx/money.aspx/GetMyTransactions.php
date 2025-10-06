<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/../config/main.php';
header('Content-Type: application/json');

use Roblox\Authentication;
use Roblox\Economy\Common\TransactionHistory;
use Roblox\Economy\Common\TransactionType;
use Roblox\Economy\Common\TransactionOriginType;
use Roblox\Economy\Sale;
use Roblox\Economy\Product;
use Roblox\Economy\ProductType;
use Roblox\Economy\RobloxProduct;
use Roblox\Asset;


$input = json_decode(file_get_contents("php://input"), true);
$transactionType = $input["transactiontype"] ?? null;
$startIndex = intval($input["startindex"] ?? 0);
$pageSize = 10;

$user = Authentication::GetAuthenticatedUser();
if (!$user) {
    http_response_code(403);
    exit(json_encode(["error" => "Not logged in."]));
}
$userId = (int)$user["id"];

$transactionTypes = [
    "purchase" => TransactionType::DebitID,
    "sale" => TransactionType::CreditID,
    "affiliatesale" => TransactionType::AffiliateSaleID ?? null, // gonna define later this
    "grouppayout" => TransactionType::AdjustmentID ?? null
];

if (!isset($transactionTypes[$transactionType])) {
    http_response_code(400);
    exit(json_encode(["error" => "Invalid transaction type."]));
}

$typeId = $transactionTypes[$transactionType];

$transactions = TransactionHistory::getByUserAndTypePaged($userId, $typeId, $startIndex, $pageSize);
$totalCount = TransactionHistory::countByUser($userId);

$data = [];

foreach ($transactions as $t) {
    // t is a TransactionHistory object
    try {
        $step1 = $t->getDAL()->saleId;
        $sale = Sale::Get($step1);
        $productObj = Product::GetById($sale->getProductId());
        $productLink = null;
        // lets get the product type
        // if the product type is not set, lets just use origin types to determine the description.
    
        switch (ProductType::Get($productObj->ProductTypeID)) {
            case "ROBLOX Product":
                $rbxproduct = RobloxProduct::getById($productObj->RobloxProductID);
                $product = $rbxproduct;
                break;
            default: // User Product
                $product = $productObj && $productObj->AssetID ? Asset::Get($productObj->AssetID) : null;
                $productLink = $product ? "/Item.aspx?id=".$product->id : null;
                break;
        }
    } catch (TypeError $e) {
        // just in case it's null the sale id
        $productObj = new stdClass;
        $productObj->name = TransactionOriginType::GetName($t->getDAL()->transactionOriginTypeId);
        $productObj->CreatorID = 1; // roblox
        $product = $productObj;
        $productLink = null;
    }
    $creator = Authentication::GetUserInfo($productObj->CreatorID);
    $amount = $t->getDAL()->amount ?? 0;
    $tag = "robux";
    $currencytype = $t->getDAL()->currencyTypeId ?? 1; // 1 is robux, 2 is tickets
    if ($currencytype != 1) {
        $tag = "tickets";
    }
    $data[] = json_encode([
        "Date" => date("m/d/Y", strtotime($t->createdAt ?? 'now')),
        "Member" => $creator["username"] ?? "Unknown",
        "Member_ID" => $creator["id"] ?? 0,
        "MemberIsGroup" => "False",
        "Group_ID" => "",
        "Description" => get_debug_type($productObj) == "Product" ? TransactionType::GetName($t->getDAL()->transactionTypeId) : "Earned ".TransactionType::GetName($t->getDAL()->transactionTypeId),
        "Amount" => ($amount >= 0
            ? "<span class='{$tag} notranslate'>{$amount}</span>"
            : "<span>{$amount}</span>"),
        "Amount_Class" => $transactionType == "purchase" ? "negative" : "positive",
        "Item_Name" => htmlspecialchars($product->name ?? "Unknown"),
        "Item_Url" => $productLink, // just for now
        "EventDate" => date("m/d/Y")
    ]);
}

$response = [
    "StartIndex" => $startIndex + 10,
    "TotalCount" => $totalCount,
    "Data" => $data
];

echo json_encode(["d" => json_encode($response)]);
