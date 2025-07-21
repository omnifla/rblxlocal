<?php

class Alert
{
    private $entityDAL;

    public function __construct()
    {
        $this->entityDAL = new AlertDAL(); // AlertDAL to be provided later
    }

    public function getID()
    {
        return $this->entityDAL->ID;
    }

    public function getUserID()
    {
        return $this->entityDAL->UserID;
    }

    public function setUserID($value)
    {
        $this->entityDAL->UserID = $value;
    }

    public function getUser()
    {
        // User::get() to be implemented
        return User::get($this->getUserID());
    }

    public function setUser($user)
    {
        if ($user !== null) {
            $this->setUserID($user->ID);
        } else {
            $this->setUserID(0);
        }
    }

    public function getText()
    {
        return $this->entityDAL->Text;
    }

    public function setText($value)
    {
        $this->entityDAL->Text = $value;
    }

    public function getCreated()
    {
        return $this->entityDAL->Created;
    }

    public function setCreated($value)
    {
        $this->entityDAL->Created = $value;
    }

    public function getUpdated()
    {
        return $this->entityDAL->Updated;
    }

    public function setUpdated($value)
    {
        $this->entityDAL->Updated = $value;
    }

    public function getVisibilityTypeID()
    {
        return $this->entityDAL->VisibilityTypeID;
    }

    public function setVisibilityTypeID($value)
    {
        $this->entityDAL->VisibilityTypeID = $value;
    }

    public function save()
    {
        $this->entityDAL->saveEntity(
            $this,
            function () {
                $this->entityDAL->Created = new DateTime();
                $this->entityDAL->Updated = $this->entityDAL->Created;
                $this->entityDAL->insert();
            },
            function () {
                $this->entityDAL->Updated = new DateTime();
                $this->entityDAL->update();
            }
        );
    }

    public static function createNew($userId, $text, $visibilityType)
    {
        $entity = new self();
        $entity->setUserID($userId);
        $entity->setText($text);
        $entity->setVisibilityTypeID($visibilityType);
        $entity->save();
        return $entity;
    }

    public static function get($id)
    {
        // EntityHelper::getEntity() to be implemented
        return EntityHelper::getEntity(
            self::$entityCacheInfo,
            $id,
            function () use ($id) {
                return AlertDAL::get($id);
            }
        );
    }

    public static function getMostRecentAlertsPaged($startRowIndex, $maximumRows)
    {
        $collectionId = sprintf(
            "GetMostRecentAlertsPaged_StartRowIndex:%d_MaximumRows:%d",
            $startRowIndex,
            $maximumRows
        );

        // EntityHelper::getEntityCollection() to be implemented
        return EntityHelper::getEntityCollection(
            self::$entityCacheInfo,
            CacheManager::UnqualifiedNonExpiringCachePolicy(),
            $collectionId,
            function () use ($startRowIndex, $maximumRows) {
                return AlertDAL::getMostRecentAlertsPaged($startRowIndex + 1, $maximumRows);
            },
            [self::class, 'get']
        );
    }

    public static function getLast()
    {
        $mostRecent = self::getMostRecentAlertsPaged(0, 1);
        if (is_array($mostRecent) && count($mostRecent) > 0) {
            return $mostRecent[0];
        }
        return null;
    }

    public function construct($dal)
    {
        $this->entityDAL = $dal;
    }

    public function getCacheInfo()
    {
        return self::$entityCacheInfo;
    }

    public static $entityCacheInfo = null; // CacheInfo to be implemented

    public function buildEntityIDLookups()
    {
        return [];
    }

    public function buildStateTokenCollection()
    {
        return [];
    }
}