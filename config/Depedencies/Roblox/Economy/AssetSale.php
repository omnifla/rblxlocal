<?php
// ported by meditext
namespace Roblox\Economy;

use PDO;
use PDOException;

class AssetSale {
    private ?int $id = null;
    public int $saleId;
    public int $assetId;
    public int $assetTypeId;
    public string $saleDate;
    public int $totalPrice;
    public int $currencyTypeId;
    public ?int $sellerId;
    public string $created;
    public string $updated;

    private static ?PDO $db = null;

    public function __construct() {
        $this->created = date('c');
        $this->updated = date('c');
    }

    public static function setConnection(PDO $pdo): void {
        self::$db = $pdo;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function insert(): void {
        $stmt = self::$db->prepare("
            INSERT INTO asset_sales (sale_id, asset_id, asset_type_id, sale_date, total_price, currency_type_id, seller_id, created, updated)
            VALUES (:saleId, :assetId, :assetTypeId, :saleDate, :totalPrice, :currencyTypeId, :sellerId, :created, :updated)
            RETURNING id
        ");
        $stmt->execute([
            ':saleId' => $this->saleId,
            ':assetId' => $this->assetId,
            ':assetTypeId' => $this->assetTypeId,
            ':saleDate' => $this->saleDate,
            ':totalPrice' => $this->totalPrice,
            ':currencyTypeId' => $this->currencyTypeId,
            ':sellerId' => $this->sellerId,
            ':created' => $this->created,
            ':updated' => $this->updated,
        ]);
        $this->id = $stmt->fetchColumn();
    }

    public function update(): void {
        if (!$this->id) {
            throw new \RuntimeException("Cannot update AssetSale without ID");
        }
        $this->updated = date('c');
        $stmt = self::$db->prepare("
            UPDATE asset_sales
            SET sale_id = :saleId, asset_id = :assetId, asset_type_id = :assetTypeId, sale_date = :saleDate, total_price = :totalPrice, currency_type_id = :currencyTypeId, seller_id = :sellerId, created = :created, updated = :updated
            WHERE id = :id
        ");
        $stmt->execute([
            ':id' => $this->id,
            ':saleId' => $this->saleId,
            ':assetId' => $this->assetId,
            ':assetTypeId' => $this->assetTypeId,
            ':saleDate' => $this->saleDate,
            ':totalPrice' => $this->totalPrice,
            ':currencyTypeId' => $this->currencyTypeId,
            ':sellerId' => $this->sellerId,
            ':created' => $this->created,
            ':updated' => $this->updated,
        ]);
    }

    public function delete(): void {
        if (!$this->id) {
            throw new \RuntimeException("Cannot delete AssetSale without ID");
        }
        $stmt = self::$db->prepare("DELETE FROM asset_sales WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?AssetSale {
        $stmt = self::$db->prepare("SELECT * FROM asset_sales WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    public static function getSumOfTotalPriceByAssetIDCurrencyTypeIDFromDate(int $assetId, int $currencyTypeId, string $fromDateTime): int {
        $stmt = self::$db->prepare("
            SELECT COALESCE(SUM(total_price), 0) FROM asset_sales WHERE asset_id = :assetId AND currency_type_id = :currencyTypeId AND sale_date >= :fromDate
        ");
        $stmt->execute([
            ':assetId' => $assetId,
            ':currencyTypeId' => $currencyTypeId,
            ':fromDate' => $fromDateTime,
        ]);
        return (int)$stmt->fetchColumn();
    }

    public static function getAssetSaleIDsByAssetID(
        int $assetId,
        int $maximumRows,
        int $exclusiveStartAssetSaleId = 0
    ): array {
        if ($maximumRows <= 0) {
            return [];
        }
        $stmt = self::$db->prepare("
            SELECT id FROM asset_sales WHERE asset_id = :assetId AND id > :exclusiveStart ORDER BY id ASC LIMIT :limit
        ");
        $stmt->bindValue(':assetId', $assetId, PDO::PARAM_INT);
        $stmt->bindValue(':exclusiveStart', $exclusiveStartAssetSaleId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $maximumRows, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function multiGet(array $ids): array {
        if (empty($ids)) return [];
        $in = implode(',', array_fill(0, count($ids), '?'));
        $stmt = self::$db->prepare("SELECT * FROM asset_sales WHERE id IN ($in)");
        $stmt->execute($ids);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map([self::class, 'fromRow'], $rows);
    }

    private static function fromRow(array $row): AssetSale {
        $sale = new AssetSale();
        $sale->id = (int)$row['id'];
        $sale->saleId = (int)$row['sale_id'];
        $sale->assetId = (int)$row['asset_id'];
        $sale->assetTypeId = (int)$row['asset_type_id'];
        $sale->saleDate = $row['sale_date'];
        $sale->totalPrice = (int)$row['total_price'];
        $sale->currencyTypeId = (int)$row['currency_type_id'];
        $sale->sellerId = $row['seller_id'] !== null ? (int)$row['seller_id'] : null;
        $sale->created = $row['created'];
        $sale->updated = $row['updated'];
        return $sale;
    }
}
