<?php
// written by skyler
namespace Roblox;
use Roblox\DataAccess\VideosDAL;

class Videos
{
    public int $id;
    public string $title;
    public string $videoName;
    public string $url;
    public int $views;
    public \DateTime $uploadedAt;
    public string $uploaderUsername;
    public int $uploaderId;

    public function __construct(VideosDAL $data)
    {
        $this->id = $data->id;
        $this->title = $data->title;
        $this->videoName = $data->video_name;
        $this->url = $this->buildUrl($data->video_name);
        $this->views = $data->views;
        $this->uploadedAt = $data->uploadedAt ?? new \DateTime();
        $this->uploaderUsername = $data->uploaderUsername;
        $this->uploaderId = $data->uploaderId;
    }

    private function buildUrl(string $videoName): string
    {
        $bucketDomain = "https://videoscdn.aftwld.xyz";
        return rtrim($bucketDomain, "/") . "/" . ltrim($videoName, "/");
    }

    public static function getRecent(int $limit = 1): array
    {
        return array_map(fn ($data) => new self($data), VideosDAL::getRecent($limit));
    }

    public static function getById(int $id): ?self
    {
        $data = VideosDAL::getById($id);
        return $data ? new self($data) : null;
    }

    public static function getAll(int $limit = 50): array
    {
        return array_map(fn ($data) => new self($data), VideosDAL::getAll($limit));
    }
    
    public function insert(): void
    {
        $dal = new VideosDAL();
        $dal->title = $this->title;
        $dal->video_name = $this->videoName;
        $dal->views = $this->views;
        $dal->uploaderId = $this->uploaderId;
        $dal->insert();
        $this->id = $dal->id;
        $this->uploadedAt = $dal->uploadedAt;
    }

    public function update(): void
    {
        $dal = new VideosDAL();
        $dal->id = $this->id;
        $dal->title = $this->title;
        $dal->video_name = $this->videoName;
        $dal->views = $this->views;
        $dal->update();
    }

    public function delete(): void
    {
        $dal = new VideosDAL();
        $dal->id = $this->id;
        $dal->delete();
    }
}
