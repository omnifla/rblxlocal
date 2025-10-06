<?php
// ported by meditext
namespace Roblox\Economy;

use PDO;

class RobloxProductDAL {
    public $id;
    public $name;
    public $description;
    public $created;
    public $updated;

    public function insert($conn, $product) {
        $stmt = $conn->prepare("
            INSERT INTO roblox_products (name, description, created, updated)
            VALUES (:name, :description, :created, :updated)
            RETURNING id
        ");
        $stmt->execute([
            ':name' => $product->name,
            ':description' => $product->description,
            ':created' => $product->created->format("Y-m-d H:i:s"),
            ':updated' => $product->updated->format("Y-m-d H:i:s"),
        ]);
        return $stmt->fetchColumn();
    }

    public function update($conn, $product) {
        $stmt = $conn->prepare("
            UPDATE roblox_products
            SET name = :name,
                description = :description,
                updated = :updated
            WHERE id = :id
        ");
        $stmt->execute([
            ':id' => $product->id,
            ':name' => $product->name,
            ':description' => $product->description,
            ':updated' => $product->updated->format("Y-m-d H:i:s"),
        ]);
    }

    public function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM roblox_products WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    public static function getById($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM roblox_products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        $dal = new RobloxProductDAL();
        $dal->id = $row['id'];
        $dal->name = $row['name'];
        $dal->description = $row['description'];
        $dal->created = new \DateTime($row['created']);
        $dal->updated = new \DateTime($row['updated']);
        return $dal;
    }

    public static function getByName($conn, $name) {
        $stmt = $conn->prepare("SELECT * FROM roblox_products WHERE name = :name");
        $stmt->execute([':name' => $name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        $dal = new RobloxProductDAL();
        $dal->id = $row['id'];
        $dal->name = $row['name'];
        $dal->description = $row['description'];
        $dal->created = new \DateTime($row['created']);
        $dal->updated = new \DateTime($row['updated']);
        return $dal;
    }
}
