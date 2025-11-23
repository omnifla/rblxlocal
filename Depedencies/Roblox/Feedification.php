<?php
namespace Roblox;

use Roblox\DataAccess\FeedificationDAL;

class Feedification
{
    public int $id;
    public string $title;
    public string $message;
    public string $createdAt;

    public function __construct(object $data)
    {
        $this->id = $data->id;
        $this->title = $data->title;
        $this->message = $data->message;
        $this->createdAt = $data->created_at;
    }

    public static function getRecent(int $limit = 1): array
    {
        return array_map(fn ($data) => new self($data), FeedificationDAL::getRecent($limit));
    }
}
