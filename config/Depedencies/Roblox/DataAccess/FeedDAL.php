<?php
// written and ported by SkylerClock
// This is a ported version of Roblox.DataAccess.FeedDAL intended to be used for a new Feed System in the near future
namespace Roblox.DataAccess;

class FeedDAL
{
    public int $post_id = 0;
    public int $author_id = 0;
    public int $posted_at = 0;
    public string $content = '';

    private PDO $db;

    public function __construct() {
        global $conn;
        $this->db = $conn;
    }

    public function insert(): void {
        if ($this->author_id === 0) {
            throw new Exception("Required: author_id");
        }
        if ($this->posted_at === 0) {
            $this->posted_at = time();
        }
        if (trim($this->content) === '') {
            throw new Exception("Required: content");
        }

        $stmt = $this->db->prepare("INSERT INTO feeds (author_id, posted_at, content) VALUES (:author_id, :posted_at, :content) RETURNING post_id");
        $stmt->execute([':author_id' => $this->author_id, ':posted_at' => $this->posted_at, ':content' => $this->content, ]);
        $this->post_id = (int) $stmt->fetchColumn();
    }

    public function update(): void {
        if ($this->post_id === 0) {
            throw new Exception("Required: post_id");
        }

        $stmt = $this->db->prepare("UPDATE feeds SET author_id = :author_id, posted_at = :posted_at, content = :content WHERE post_id = :post_id");
        $stmt->execute([':author_id' => $this->author_id, ':posted_at' => $this->posted_at, ':content' => $this->content, ':post_id' => $this->post_id,]);
    }

    public function delete(): void {
        if ($this->post_id === 0) {
            throw new Exception("Required: post_id");
        }

        $stmt = $this->db->prepare("DELETE FROM feeds WHERE post_id = :post_id");
        $stmt->execute([':post_id' => $this->post_id]);
    }

    public static function get(int $id): ?FeedDAL {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM feeds WHERE post_id = :post_id");
        $stmt->execute([':post_id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $feed = new FeedDAL();
        $feed->post_id = (int)$row['post_id'];
        $feed->author_id = (int)$row['author_id'];
        $feed->posted_at = (int)$row['posted_at'];
        $feed->content = $row['content'];
        return $feed;
    }

    public static function getByAuthor(int $author_id, int $limit = 10): array {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM feeds WHERE author_id = :author_id ORDER BY posted_at DESC LIMIT :limit");
        $stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $feeds = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $feed = new FeedDAL();
            $feed->post_id = (int)$row['post_id'];
            $feed->author_id = (int)$row['author_id'];
            $feed->posted_at = (int)$row['posted_at'];
            $feed->content = $row['content'];
            $feeds[] = $feed;
        }

        return $feeds;
    }
}
