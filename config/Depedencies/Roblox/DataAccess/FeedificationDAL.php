<?php

namespace Roblox\DataAccess;

use PDO;
use stdClass;

class FeedificationDAL
{
    protected static PDO $conn;
    public static function setConnection(PDO $pdo): void
    {
        self::$conn = $pdo;
    }

    public static function getRecent(int $limit = 1): array
    {
        $sql = 'SELECT id, title, message, created_at FROM feedifications ORDER BY created_at DESC LIMIT :limit';
        $stmt = self::$conn->prepare($sql);
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
