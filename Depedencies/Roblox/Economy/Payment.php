<?php
// ported by meditext
namespace Roblox\Economy;

use PDO;
use DateTime;
use Exception;

class Payment {
    private PDO $db;

    public ?int $ID = null;
    public int $SaleID;
    public int $UnitPrice;
    public int $CurrencyTypeID;
    public int $PaymentStatusTypeID;
    public DateTime $PaymentDate;
    public DateTime $Created;
    public DateTime $Updated;

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->PaymentDate = new DateTime();
        $this->Created = new DateTime();
        $this->Updated = new DateTime();
    }

    public function Insert(): void {
        $stmt = $this->db->prepare("
            INSERT INTO payments (sale_id, unit_price, currency_type_id, payment_status_type_id, payment_date, created, updated)
            VALUES (:sale_id, :unit_price, :currency_type_id, :payment_status_type_id, :payment_date, NOW(), NOW())
            RETURNING id, created, updated
        ");

        $stmt->execute([
            ':sale_id' => $this->SaleID,
            ':unit_price' => $this->UnitPrice,
            ':currency_type_id' => $this->CurrencyTypeID,
            ':payment_status_type_id' => $this->PaymentStatusTypeID,
            ':payment_date' => $this->PaymentDate->format('Y-m-d H:i:s')
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->ID = (int)$row['id'];
        $this->Created = new DateTime($row['created']);
        $this->Updated = new DateTime($row['updated']);
    }

    public function Update(): void {
        if ($this->ID === null) {
            throw new Exception("Cannot update Payment without ID");
        }

        $stmt = $this->db->prepare("
            UPDATE payments
            SET sale_id = :sale_id, unit_price = :unit_price, currency_type_id = :currency_type_id, payment_status_type_id = :payment_status_type_id, payment_date = :payment_date, updated = NOW()
            WHERE id = :id
            RETURNING updated
        ");

        $stmt->execute([
            ':id' => $this->ID,
            ':sale_id' => $this->SaleID,
            ':unit_price' => $this->UnitPrice,
            ':currency_type_id' => $this->CurrencyTypeID,
            ':payment_status_type_id' => $this->PaymentStatusTypeID,
            ':payment_date' => $this->PaymentDate->format('Y-m-d H:i:s')
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->Updated = new DateTime($row['updated']);
    }

    public function Delete(): void {
        if ($this->ID === null) {
            throw new Exception("Cannot delete Payment without ID");
        }

        $stmt = $this->db->prepare("DELETE FROM payments WHERE id = :id");
        $stmt->execute([':id' => $this->ID]);
    }

    public static function GetById(PDO $db, int $id): ?Payment {
        $stmt = $db->prepare("SELECT * FROM payments WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $payment = new Payment($db);
        $payment->hydrate($row);
        return $payment;
    }

    private function hydrate(array $row): void {
        $this->ID = (int)$row['id'];
        $this->SaleID = (int)$row['sale_id'];
        $this->UnitPrice = (int)$row['unit_price'];
        $this->CurrencyTypeID = (int)$row['currency_type_id'];
        $this->PaymentStatusTypeID = (int)$row['payment_status_type_id'];
        $this->PaymentDate = new DateTime($row['payment_date']);
        $this->Created = new DateTime($row['created']);
        $this->Updated = new DateTime($row['updated']);
    }
}
