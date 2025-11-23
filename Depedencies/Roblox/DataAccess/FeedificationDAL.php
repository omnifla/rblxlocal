<?php
namespace Roblox\DataAccess;
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use PDO;
use stdClass;

class FeedificationDAL
{
    private PDO $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function getRecent(int $limit = 1): array
    {
        $sql = 'SELECT id, title, message, created_at FROM feedifications ORDER BY created_at DESC LIMIT :limit';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new stdClass();
            $obj->id = (int) $row['id'];
            $obj->title = $row['title'];
            $obj->message = $row['message'];
            $obj->created_at = $row['created_at'];
            $results[] = $obj;
        }

        return $results;
    }
}
