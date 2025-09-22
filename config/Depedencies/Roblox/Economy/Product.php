<?php
// ported by meditext
// this is maybe my first attempt to write the whole code by simply merging both DAL and base itself.
namespace Roblox\Economy;

use PDO;
use DateTime;
use Exception;

enum LookupFilter
{
	case AssetID;
	case ID;
}

class Product {
    private PDO $db;

    public ?int $ID = null;
    public int $ProductTypeID;
    public bool $IsPublicDomain = false;
    public bool $IsForSale = false;
    public ?int $PriceInRobux = null;
    public ?int $PriceInTickets = null;
    public ?int $RobloxProductID = null;
    public ?int $AssetID = null;
    public ?int $AssetTypeID = null;
    public ?int $CreatorID = null;
    public int $AssetGenres = 0;
    public int $AssetCategories = 0;
    public ?int $AffiliateFeePercentage = null;
    public DateTime $Created;
    public DateTime $Updated;

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->Created = new DateTime();
        $this->Updated = new DateTime();
    }

    public function Insert(): void {
        if ($this->ProductTypeID === 0) {
            throw new Exception("ProductTypeID cannot be 0");
        }

        $stmt = $this->db->prepare("
            INSERT INTO products (product_type_id, is_public_domain, is_for_sale, price_in_robux,price_in_tickets, roblox_product_id, asset_id, asset_type_id,creator_id, asset_genres, asset_categories, affiliate_fee_percentage,created, updated)
            VALUES (:product_type_id, :is_public_domain, :is_for_sale, :price_in_robux, :price_in_tickets, :roblox_product_id, :asset_id, :asset_type_id, :creator_id, :asset_genres, :asset_categories, :affiliate_fee_percentage, NOW(), NOW())
            RETURNING id, created, updated
        ");

        $stmt->execute([
            ':product_type_id' => $this->ProductTypeID,
            ':is_public_domain' => $this->IsPublicDomain,
            ':is_for_sale' => $this->IsForSale,
            ':price_in_robux' => $this->PriceInRobux,
            ':price_in_tickets' => $this->PriceInTickets,
            ':roblox_product_id' => $this->RobloxProductID,
            ':asset_id' => $this->AssetID,
            ':asset_type_id' => $this->AssetTypeID,
            ':creator_id' => $this->CreatorID,
            ':asset_genres' => $this->AssetGenres,
            ':asset_categories' => $this->AssetCategories,
            ':affiliate_fee_percentage' => $this->AffiliateFeePercentage
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->ID = (int)$row['id'];
        $this->Created = new DateTime($row['created']);
        $this->Updated = new DateTime($row['updated']);
    }

    public function Update(): void {
        if ($this->ID === null) {
            throw new Exception("Cannot update Product without ID");
        }

        $stmt = $this->db->prepare("
            UPDATE products
            SET product_type_id = :product_type_id, is_public_domain = :is_public_domain, is_for_sale = :is_for_sale, price_in_robux = :price_in_robux, price_in_tickets = :price_in_tickets, roblox_product_id = :roblox_product_id, asset_id = :asset_id, asset_type_id = :asset_type_id, creator_id = :creator_id, asset_genres = :asset_genres, asset_categories = :asset_categories, affiliate_fee_percentage = :affiliate_fee_percentage, updated = NOW()
            WHERE id = :id
            RETURNING updated
        ");

        $stmt->execute([
            ':id' => $this->ID,
            ':product_type_id' => $this->ProductTypeID,
            ':is_public_domain' => $this->IsPublicDomain,
            ':is_for_sale' => $this->IsForSale,
            ':price_in_robux' => $this->PriceInRobux,
            ':price_in_tickets' => $this->PriceInTickets,
            ':roblox_product_id' => $this->RobloxProductID,
            ':asset_id' => $this->AssetID,
            ':asset_type_id' => $this->AssetTypeID,
            ':creator_id' => $this->CreatorID,
            ':asset_genres' => $this->AssetGenres,
            ':asset_categories' => $this->AssetCategories,
            ':affiliate_fee_percentage' => $this->AffiliateFeePercentage
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->Updated = new DateTime($row['updated']);
    }

    public function Delete(): void {
        if ($this->ID === null) {
            throw new Exception("Cannot delete Product without ID");
        }

        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $this->ID]);
    }

    public static function GetById(PDO $db, int $id): ?Product {
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $product = new Product($db);
        $product->hydrate($row);
        return $product;
    }

    private function hydrate(array $row): void {
        $this->ID = (int)$row['id'];
        $this->ProductTypeID = (int)$row['product_type_id'];
        $this->IsPublicDomain = (bool)$row['is_public_domain'];
        $this->IsForSale = (bool)$row['is_for_sale'];
        $this->PriceInRobux = $row['price_in_robux'] !== null ? (int)$row['price_in_robux'] : null;
        $this->PriceInTickets = $row['price_in_tickets'] !== null ? (int)$row['price_in_tickets'] : null;
        $this->RobloxProductID = $row['roblox_product_id'];
        $this->AssetID = $row['asset_id'];
        $this->AssetTypeID = $row['asset_type_id'];
        $this->CreatorID = $row['creator_id'];
        $this->AssetGenres = (int)$row['asset_genres'];
        $this->AssetCategories = (int)$row['asset_categories'];
        $this->AffiliateFeePercentage = $row['affiliate_fee_percentage'];
        $this->Created = new DateTime($row['created']);
        $this->Updated = new DateTime($row['updated']);
    }
}
