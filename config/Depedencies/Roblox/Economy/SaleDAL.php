<?php
// ported by meditext
namespace Roblox\Economy;

use Exception;
use PDO;

class SaleDAL
{
    public int $id = 0;
    public int $purchaser_id = 0;
    public ?int $seller_id = null;
    public int $product_id = 0;
    public int $quantity = 1;
    public int $currency_type_id = 0; // 1 = Robux, 2 = Tickets 
    public int $unit_price = 0;
    public int $discount = 0;
    public int $total_price = 0;
    public int $marketplace_fee = 0;
    public string $created;
    public string $updated;

    public function __construct()
    {
        $now = date('Y-m-d H:i:s');
        $this->created = $now;
        $this->updated = $now;
    }

    public function insert(): void
    {
        global $conn;

        if ($this->purchaser_id === 0) throw new Exception("PurchaserID required.");
        if ($this->product_id === 0) throw new Exception("ProductID required.");
        if ($this->currency_type_id === 0) throw new Exception("CurrencyTypeID required.");

        $stmt = $conn->prepare("
            INSERT INTO sales 
            (purchaser_id, seller_id, product_id, quantity, currency_type_id, unit_price, discount, total_price, marketplace_fee, created, updated) 
            VALUES (:purchaser_id, :seller_id, :product_id, :quantity, :currency_type_id, :unit_price, :discount, :total_price, :marketplace_fee, :created, :updated)
            RETURNING id
        ");
        $stmt->execute([
            ':purchaser_id' => $this->purchaser_id,
            ':seller_id' => $this->seller_id,
            ':product_id' => $this->product_id,
            ':quantity' => $this->quantity,
            ':currency_type_id' => $this->currency_type_id,
            ':unit_price' => $this->unit_price,
            ':discount' => $this->discount,
            ':total_price' => $this->total_price,
            ':marketplace_fee' => $this->marketplace_fee,
            ':created' => $this->created,
            ':updated' => $this->updated,
        ]);
        $this->id = (int)$stmt->fetchColumn();
    }

    public function update(): void
    {
        global $conn;

        if ($this->id === 0) throw new Exception("ID required for update.");
        $this->updated = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("
            UPDATE sales 
            SET purchaser_id=:purchaser_id, seller_id=:seller_id, product_id=:product_id, quantity=:quantity, 
                currency_type_id=:currency_type_id, unit_price=:unit_price, discount=:discount, 
                total_price=:total_price, marketplace_fee=:marketplace_fee, created=:created, updated=:updated
            WHERE id=:id
        ");
        $stmt->execute([
            ':id' => $this->id,
            ':purchaser_id' => $this->purchaser_id,
            ':seller_id' => $this->seller_id,
            ':product_id' => $this->product_id,
            ':quantity' => $this->quantity,
            ':currency_type_id' => $this->currency_type_id,
            ':unit_price' => $this->unit_price,
            ':discount' => $this->discount,
            ':total_price' => $this->total_price,
            ':marketplace_fee' => $this->marketplace_fee,
            ':created' => $this->created,
            ':updated' => $this->updated,
        ]);
    }

    public function delete(): void
    {
        global $conn;

        if ($this->id === 0) throw new Exception("ID required for delete.");
        $stmt = $conn->prepare("DELETE FROM sales WHERE id=:id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?self
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM sales WHERE id=:id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        $dal = new self();
        foreach ($row as $k => $v) {
            $dal->$k = $v;
        }
        return $dal;
    }
}
