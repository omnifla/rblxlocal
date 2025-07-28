<?php

namespace Roblox;

use Roblox\Common\ExceptionHandler;
use Roblox\DAL\UserThemeDAL;
use Roblox\Cache\CacheInfo;
use Roblox\Cache\CacheabilitySettings;
use Roblox\Premium\PremiumFeatureHelper;
use Roblox\Premium\PremiumFeatures;
use Roblox\Theme\ThemeType;

class UserTheme implements IRobloxEntity, ICacheableObject
{
    private static $activationQueue;
    private static $expirationQueue;
    private static $entityCacheInfo;

    private $entityDAL;

    public static function init()
    {
        self::$activationQueue = new \SplQueue();
        self::$expirationQueue = new \SplQueue();

        PremiumFeatureHelper::registerBuildersClubActivationSubscriber(self::$activationQueue);
        PremiumFeatureHelper::registerBuildersClubExpirationSubscriber(self::$expirationQueue);

        self::$entityCacheInfo = new CacheInfo(
            new CacheabilitySettings(true, true, true, true),
            'UserTheme',
            true
        );

        register_tick_function(function () {
            while (!self::$activationQueue->isEmpty()) {
                $msg = self::$activationQueue->dequeue();
                if ($msg['value'] === PremiumFeatures::AccountAddOnType_OutrageousBuildersClubMembershipValue) {
                    $user = User::getByAccountID($msg['key']);
                    if (!$user) {
                        throw new \InvalidArgumentException("User not found for AccountID {$msg['key']}");
                    }

                    $userTheme = self::getByUserID($user->ID);
                    if ($userTheme) {
                        $userTheme->setThemeTypeID(ThemeType::OutrageousID);
                    } else {
                        $userTheme = new self();
                        $userTheme->setUserID($user->ID);
                        $userTheme->setThemeTypeID(ThemeType::OutrageousID);
                    }
                    $userTheme->save();
                }
            }

            while (!self::$expirationQueue->isEmpty()) {
                $msg = self::$expirationQueue->dequeue();
                if ($msg['value'] === PremiumFeatures::AccountAddOnType_OutrageousBuildersClubMembershipValue) {
                    $user = User::getByAccountID($msg['key']);
                    if (!$user) {
                        throw new \InvalidArgumentException("User not found for AccountID {$msg['key']}");
                    }

                    $userTheme = self::getByUserID($user->ID);
                    if ($userTheme && $userTheme->getThemeTypeID() === ThemeType::OutrageousID) {
                        $userTheme->setThemeTypeID(self::getAuthenticatedUserDefaultThemeTypeID());
                        $userTheme->save();
                    } elseif (!$userTheme) {
                        $userTheme = new self();
                        $userTheme->setUserID($user->ID);
                        $userTheme->setThemeTypeID(self::getAuthenticatedUserDefaultThemeTypeID());
                        $userTheme->save();
                    }
                }
            }
        });
    }

    public function __construct()
    {
        $this->entityDAL = new UserThemeDAL();
    }

    public function getID()
    {
        return $this->entityDAL->ID;
    }

    public function getUserID()
    {
        return $this->entityDAL->UserID;
    }

    public function setUserID($id)
    {
        $this->entityDAL->UserID = $id;
    }

    public function getThemeTypeID()
    {
        return $this->entityDAL->ThemeTypeID;
    }

    public function setThemeTypeID($id)
    {
        $this->entityDAL->ThemeTypeID = $id;
    }

    public function getCreated()
    {
        return $this->entityDAL->Created;
    }

    public function getUpdated()
    {
        return $this->entityDAL->Updated;
    }

    public function delete()
    {
        EntityHelper::deleteEntity($this, [$this->entityDAL, 'delete']);
    }

    public function save()
    {
        EntityHelper::saveEntity(
            $this,
            function () {
                $this->entityDAL->Created = new \DateTime();
                $this->entityDAL->Updated = new \DateTime();
                $this->entityDAL->insert();
            },
            function () {
                $this->entityDAL->Updated = new \DateTime();
                $this->entityDAL->update();
            }
        );
    }

    public static function get($id)
    {
        return EntityHelper::getEntity(
            self::$entityCacheInfo,
            $id,
            fn() => UserThemeDAL::get($id)
        );
    }

    public static function getByUserID($userID)
    {
        return EntityHelper::getEntityByLookup(
            self::$entityCacheInfo,
            "UserID:{$userID}",
            fn() => UserThemeDAL::getByUserID($userID)
        );
    }

    public function construct($dal)
    {
        $this->entityDAL = $dal;
    }

    public function getCacheInfo()
    {
        return self::$entityCacheInfo;
    }

    public function buildEntityIDLookups()
    {
        return ["UserID:{$this->getUserID()}"];
    }

    public function buildStateTokenCollection()
    {
        return [];
    }

    public static function getGuestUserThemeTypeID()
    {
        return Settings::get('GuestUserThemeTypeID');
    }

    public static function getAuthenticatedUserDefaultThemeTypeID()
    {
        return Settings::get('AuthenticatedUserDefaultThemeTypeID');
    }

    public static function isABThemeTestingEnabled()
    {
        return Settings::get('ABThemeTestingEnabled');
    }

    public static function setABThemeTestingEnabled($enabled)
    {
        Settings::set('ABThemeTestingEnabled', $enabled);
    }

    public static function isOBCCastEnabled()
    {
        return Settings::get('OBCCastEnabled');
    }

    public static function setOBCCastEnabled($enabled)
    {
        Settings::set('OBCCastEnabled', $enabled);
    }

    public static function getOBCCastDescription()
    {
        return Settings::get('OBCCastDescription');
    }

    public static function setOBCCastDescription($desc)
    {
        Settings::set('OBCCastDescription', $desc);
    }

    public static function getUsersCanChangeThemeEnabled()
    {
        return Settings::get('UsersCanChangeThemeEnabled');
    }

    public static function setUsersCanChangeThemeEnabled($enabled)
    {
        Settings::set('UsersCanChangeThemeEnabled', $enabled);
    }
}
