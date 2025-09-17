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
    public string $uploadedAt;
    public string $uploaderUsername;

    public function __construct(object $data)
    {
        $this->id = $data->id;
        $this->title = $data->title;
        $this->videoName = $data->video_name;
        $this->url = $this->buildUrl($data->video_name);
        $this->views = $data->views;
        $this->uploadedAt = $data->uploadedAt;
        $this->uploaderUsername = $data->uploaderUsername;
    }

    private function buildUrl(string $videoName): string
    {
        $bucketDomain = "https://videoscdn.aftwld.xyz";
        return rtrim($bucketDomain, "/") . "/" . ltrim($videoName, "/");
    }

    public static function getRecent(int $limit = 1): array
    {
        return array_map(
            fn ($data) => new self($data),
            VideosDAL::getRecent($limit)
        );
    }
  
    public static function getById(int $id): ?self
    {
        $data = VideosDAL::getById($id);
        return $data ? new self($data) : null;
    }
}
