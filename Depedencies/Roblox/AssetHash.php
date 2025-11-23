<?php
// ported by meditext
namespace Roblox;

use Roblox\DataAccess\AssetHashDAL;

class AssetHash
{
    const REVIEW_NONE = 0;
    const REVIEW_APPROVED = 1;
    const REVIEW_REJECTED = 2;

    public int $id;
    public int $assetId;
    public string $hash;
    public int $size;
    public int $reviewStatus;
    public int $creatorId;
    public ?string $created;
    public ?string $updated;

    public function __construct(array $row) {
        $this->id = (int)$row['id'];
        $this->assetId = (int)$row['asset_id'];
        $this->hash = $row['hash'];
        $this->size = (int)$row['size'];
        $this->reviewStatus = (int)$row['review_status'];
        $this->creatorId = (int)$row['creator_id'];
        $this->created = $row['created'];
        $this->updated = $row['updated'];
    }

    public static function getByAssetId(int $assetId): ?AssetHash {
        $row = AssetHashDAL::getByAssetId($assetId);
        return $row ? new AssetHash($row) : null;
    }

    public static function getByHash(string $hash): array {
        $rows = AssetHashDAL::listByHash($hash);
        return array_map(fn($r) => new AssetHash($r), $rows);
    }


    public static function create(int $assetId, string $hash, int $size, int $creatorId, int $reviewStatus = self::REVIEW_NONE): AssetHash {
        if (strlen($hash) !== 40) {
            throw new \InvalidArgumentException("Hash must be 40 chars SHA1 hex.");
        }

        $id = AssetHashDAL::insert([
            'asset_id' => $assetId,
            'hash' => $hash,
            'size' => $size,
            'review_status' => $reviewStatus,
            'creator_id' => $creatorId
        ]);

        return new AssetHash(AssetHashDAL::getByAssetId($assetId));
    }

    public function save(): void {
        AssetHashDAL::update($this->id, [
            'hash' => $this->hash,
            'size' => $this->size,
            'review_status' => $this->reviewStatus,
            'creator_id' => $this->creatorId
        ]);
    }

    public function delete(): void {
        AssetHashDAL::deleteById($this->id);
    }

    public function setApproved(): void
    {
        $this->reviewStatus = self::REVIEW_APPROVED;
        $this->save();
    }

    public function setRejected(): void {
        $this->reviewStatus = self::REVIEW_REJECTED;
        $this->save();
    }

    public function isApproved(): bool {
        return $this->reviewStatus === self::REVIEW_APPROVED;
    }

    public function isRejected(): bool {
        return $this->reviewStatus === self::REVIEW_REJECTED;
    }
}
