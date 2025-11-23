<?php
namespace Roblox\Economy\Common;

use Exception;
use PDO;

class TransactionHistory
{
    private $dal;

    public function __construct()
    {
        $this->dal = new TransactionHistoryDAL();
    }

    public function save()
    {
        global $conn;
        if (empty($this->dal->id)) {
            $this->dal->insert($conn);
        } else {
            $this->dal->update($conn);
        }
    }

    public function delete()
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM transaction_history WHERE id = :id");
        $stmt->execute([':id' => $this->dal->id]);
    }

    public static function get($id)
    {
        global $conn;
        $dal = TransactionHistoryDAL::get($conn, $id);
        if (!$dal) return null;

        $obj = new self();
        $obj->dal = $dal;
        return $obj;
    }

    public static function createNew($userId, $transactionTypeId, $transactionOriginTypeId, $currencyTypeId, $amount, $saleId = null)
    {
        $entity = new self();
        $entity->dal->userId = $userId;
        $entity->dal->transactionTypeId = $transactionTypeId;
        $entity->dal->transactionOriginTypeId = $transactionOriginTypeId;
        $entity->dal->currencyTypeId = $currencyTypeId;
        $entity->dal->amount = $amount;
        $entity->dal->saleId = $saleId;
        $entity->dal->isProcessed = true;
        $entity->save();
        return $entity;
    }

    public static function submit($userId, $transactionTypeId, $transactionOriginTypeId, $currencyTypeId, $amount, $originId = null)
    {
        try {
            return self::createNew($userId, $transactionTypeId, $transactionOriginTypeId, $currencyTypeId, $amount, $originId);
        } catch (Exception $e) {
            error_log("TransactionHistory::submit failed: " . $e->getMessage());
            return null;
        }
    }

    public static function getByUserAndTypePaged(int $userId, ?int $transactionTypeId = null, int $offset = 0, int $limit = 10): array
    {
        global $conn;
        $query = "SELECT * FROM transaction_history WHERE user_id = :user";
        if ($transactionTypeId !== null) {
            $query .= " AND transaction_type_id = :type";
        }
        $query .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        $stmt = $conn->prepare($query);
        $stmt->bindValue(':user', $userId, PDO::PARAM_INT);
        if ($transactionTypeId !== null) {
            $stmt->bindValue(':type', $transactionTypeId, PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $transactions = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dal = new TransactionHistoryDAL();
            foreach ($row as $k => $v) {
                switch($k) {
                    case 'transaction_type_id':
                        $k = "transactionTypeId";
                        break;
                    case 'transaction_origin_type_id':
                        $k = "transactionOriginTypeId";
                        break;
                    case 'currency_type_id':
                        $k = "currencyTypeId";
                        break;
                    case 'user_id':
                        $k = "userId";
                        break;
                    case 'sale_id':
                        $k = "saleId";
                        break;
                    case 'is_processed':
                        $k = "isProcessed";
                        break;
                }
                $dal->$k = $v;
            }
            $t = new self();
            $t->dal = $dal;
            $transactions[] = $t;
        }
        return $transactions;
    }

    public static function countByUser(int $userId): int
    {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM transaction_history WHERE user_id = :user");
        $stmt->execute([':user' => $userId]);
        return (int)$stmt->fetchColumn();
    }

    public function getDAL(): TransactionHistoryDAL
    {
        return $this->dal;
    }

    public static function __callStatic($name, $arguments)
    {
        if (method_exists(TransactionHistoryDAL::class, $name)) {
            global $conn;
            array_unshift($arguments, $conn);
            return call_user_func_array([TransactionHistoryDAL::class, $name], $arguments);
        }
        throw new \BadMethodCallException("Method $name does not exist in TransactionHistory.");
    }
}
