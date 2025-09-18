<?php
// written by skyler
namespace Roblox\DataAccess;
use DateTime;
use Exception;

class VideosDAL
{
    public int $id = 0;
    public string $title = '';
    public string $video_name = '';
    public int $views = 0;
    public int $uploaderId = 0;
    public ?DateTime $uploadedAt = null;
    private \PDO $db;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    public function insert(): void
    {
        if (empty($this->title)) {
            throw new Exception("Video title is required.");
        }
        if (empty($this->video_name)) {
            throw new Exception("Video file name is required.");
        }
        if ($this->uploaderId === 0) {
            throw new Exception("Uploader user ID is required.");
        }

        $stmt = $this->db->prepare("INSERT INTO videos (title, video_name, views, uploaderId) VALUES (:title, :video_name, :views, :uploaderId) RETURNING id, uploadedAt");
        $stmt->execute([
            ':title' => $this->title,
            ':video_name' => $this->video_name,
            ':views' => $this->views,
            ':uploaderId' => $this->uploaderId,
        ]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->id = (int)$result['id'];
        $this->uploadedAt = new DateTime($result['uploadedat']);
    }

    public function update(): void
    {
        if ($this->id === 0) {
            throw new Exception("Video ID is required for update.");
        }

        $stmt = $this->db->prepare("UPDATE videos SET title = :title, video_name = :video_name, views = :views WHERE id = :id");
        $stmt->execute([
            ':id' => $this->id,
            ':title' => $this->title,
            ':video_name' => $this->video_name,
            ':views' => $this->views,
        ]);
    }

    public function delete(): void
    {
        if ($this->id === 0) {
            throw new Exception("Video ID is required for delete.");
        }

        $stmt = $this->db->prepare("DELETE FROM videos WHERE id = :id");
        $stmt->execute([':id' => $this->id]);
    }

    public static function get(int $id): ?VideosDAL
    {
        global $conn;
        $sql = "SELECT id, title, video_name, views, uploadedat, uploaderid FROM videos WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }

    public static function getAll(int $limit = 50): array
    {
        global $conn;
        $sql = "SELECT id, title, video_name, views, uploadedat, uploaderid FROM videos ORDER BY uploadedat DESC LIMIT :limit";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map([self::class, 'buildFromRow'], $rows);
    }

    private static function buildFromRow(array $row): VideosDAL
    {
        $video = new VideosDAL();
        $video->id = (int)$row['id'];
        $video->title = $row['title'];
        $video->video_name = $row['video_name'];
        $video->views = (int)$row['views'];
        $video->uploaderId = (int)$row['uploaderid'];
        $video->uploadedAt = $row['uploadedat'] !== null ? new DateTime($row['uploadedat']) : null;
        return $video;
    }

    public static function getRecent(int $limit = 1): array
    {
        global $conn;
        $sql = "SELECT id, title, video_name, views, uploadedat, uploaderid FROM videos ORDER BY uploadedat DESC LIMIT :limit";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map([self::class, 'buildFromRow'], $rows);
    }

    public static function getById(int $id): ?VideosDAL
    {
        global $conn;
        $sql = "SELECT id, title, video_name, views, uploadedat, uploaderid FROM videos WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? self::buildFromRow($row) : null;
    }
}
