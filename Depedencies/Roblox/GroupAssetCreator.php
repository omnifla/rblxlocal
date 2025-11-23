<?php
namespace Roblox;

use Roblox\DataAccess\GroupAssetCreatorDAL;

class GroupAssetCreator
{
    private GroupAssetCreatorDAL $entityDAL;

    public function __construct()
    {
        $this->entityDAL = new GroupAssetCreatorDAL();
    }

    public function getID(): int
    {
        return $this->entityDAL->ID;
    }

    public function getAssetID(): int
    {
        return $this->entityDAL->AssetID;
    }

    public function setAssetID(int $id): void
    {
        $this->entityDAL->AssetID = $id;
    }

    public function getGroupID(): int
    {
        return $this->entityDAL->GroupID;
    }

    public function setGroupID(int $id): void
    {
        $this->entityDAL->GroupID = $id;
    }

    public function getUserID(): int
    {
        return $this->entityDAL->UserID;
    }

    public function setUserID(int $id): void
    {
        $this->entityDAL->UserID = $id;
    }

    public function getCreated(): \DateTime
    {
        return $this->entityDAL->Created;
    }

    public function setCreated(\DateTime $dt): void
    {
        $this->entityDAL->Created = $dt;
    }

    public function getUpdated(): \DateTime
    {
        return $this->entityDAL->Updated;
    }

    public function setUpdated(\DateTime $dt): void
    {
        $this->entityDAL->Updated = $dt;
    }

    public function save(): void
    {
        if ($this->entityDAL->ID === 0) {
            $now = new \DateTime();
            $this->entityDAL->Created = $now;
            $this->entityDAL->Updated = $now;
            $this->entityDAL->insert();
        } else {
            $this->entityDAL->Updated = new \DateTime();
            $this->entityDAL->update();
        }
    }

    public static function createNew(int $assetID, int $groupID, int $userID): self
    {
        $creator = new self();
        $creator->setAssetID($assetID);
        $creator->setGroupID($groupID);
        $creator->setUserID($userID);
        $creator->save();
        return $creator;
    }

    public static function get(int $id): ?self
    {
        $dal = GroupAssetCreatorDAL::get($id);
        if (!$dal) return null;

        $creator = new self();
        $creator->construct($dal);
        return $creator;
    }

    public static function getByAssetID(int $assetID): ?self
    {
        $dal = GroupAssetCreatorDAL::getByAssetID($assetID);
        if (!$dal) return null;

        $creator = new self();
        $creator->construct($dal);
        return $creator;
    }

    public function construct(GroupAssetCreatorDAL $dal): void
    {
        $this->entityDAL = $dal;
    }
}
