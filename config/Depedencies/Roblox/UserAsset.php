<?php
// ported by meditext
namespace Roblox;

use Roblox\DataAccess\UserAssetDAL;
use Exception;
use DateTime;

class UserAsset
{
    private UserAssetDAL $dal;

    public function __construct(?UserAssetDAL $dal = null)
    {
        $this->dal = $dal ?? new UserAssetDAL();
    }

    public function getId(): int
    {
        return $this->dal->id;
    }

    public function getUserId(): int
    {
        return $this->dal->user_id;
    }

    public function getAssetId(): int
    {
        return $this->dal->asset_id;
    }

    public function getAssetTypeId(): int
    {
        return $this->dal->asset_type_id;
    }

    public function getCreated(): DateTime
    {
        return new DateTime($this->dal->created);
    }

    public function getUpdated(): DateTime
    {
        return new DateTime($this->dal->updated);
    }

    public function isExpired(): bool
    {
        // TODO: add expiration.
        return false;
    }

    public function save(): void
    {
        if ($this->dal->id === 0) {
            $this->dal->insert();
        } else {
            $this->dal->update();
        }
    }

    public function delete(): void
    {
        if ($this->dal->id === 0) {
            throw new Exception("Cannot delete a UserAsset without an ID.");
        }
        $this->dal->delete();
    }

    public static function get(int $id): ?self
    {
        $dal = UserAssetDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getUserAssets(int $userId, int $assetTypeId): array
    {
        $ids = UserAssetDAL::getUserAssetIDs($userId, $assetTypeId);
        return array_map(fn($id) => self::get($id), $ids);
    }

    public static function createNew(int $userId, int $assetId, int $assetTypeId): self
    {
        $dal = new UserAssetDAL();
        $dal->user_id = $userId;
        $dal->asset_id = $assetId;
        $dal->asset_type_id = $assetTypeId;
        $dal->created = date('Y-m-d H:i:s');
        $dal->updated = $dal->created;

        $userAsset = new self($dal);
        $userAsset->save();
        return $userAsset;
    }
}