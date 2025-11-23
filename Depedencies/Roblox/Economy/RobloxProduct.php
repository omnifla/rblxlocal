<?php
// ported by meditext
namespace Roblox\Economy;

use DateTime;

class RobloxProduct
{
    private $dal;

    public $id;
    public $name;
    public $description;
    public $created;
    public $updated;

    public static $UserAd_728x90;
    public static $UserAd_160x600;
    public static $UserAd_300x250;
    public static $UserAd_PromotedUniverseDesktop;
    public static $UserAd_PromotedUniverseTablet;
    public static $UserAd_PromotedUniversePhone;
    public static $UserAd_PromotedUniverseConsole;
    public static $Group;
    public static $Badge;
    public static $GroupRoleSet;
    public static $YouTubeMediaItem;
    public static $ImageMediaItem;
    public static $GamePass;
    public static $CashOut;
    public static $Audio;
    public static $UsernameChange;
    public static $Animation;
    public static $Clan;
    public static $PrivateServer;
    public static $AudioShortSoundEffect;
    public static $AudioLongSoundEffect;
    public static $AudioMusic;
    public static $AudioLongMusic;

    public function __construct($dal = null)
    {
        if ($dal === null) {
            $this->dal = new RobloxProductDAL();
        } else {
            $this->dal = $dal;
        }

        $this->id = $this->dal->id ?? null;
        $this->name = $this->dal->name ?? null;
        $this->description = $this->dal->description ?? null;
        $this->created = $this->dal->created ?? null;
        $this->updated = $this->dal->updated ?? null;
    }

    public function save()
    {
        global $conn;
        if (!$this->id) {
            $this->created = new DateTime();
            $this->updated = $this->created;
            $this->id = $this->dal->insert($conn, $this);
        } else {
            $this->updated = new DateTime();
            $this->dal->update($conn, $this);
        }
    }

    public function delete()
    {
        global $conn;
        if ($this->id) {
            $this->dal->delete($conn, $this->id);
        }
    }

    public static function getById($id)
    {
        global $conn;
        $dal = RobloxProductDAL::getById($conn, $id);
        return $dal ? new RobloxProduct($dal) : null;
    }

    public static function getByName($name)
    {
        global $conn;
        $dal = RobloxProductDAL::getByName($conn, $name);
        return $dal ? new RobloxProduct($dal) : null;
    }

    public static function init()
    {
        global $conn;
        self::$UserAd_728x90 = self::getByName("User Ad: 728x90");
        self::$UserAd_160x600 = self::getByName("User Ad: 160x600");
        self::$UserAd_300x250 = self::getByName("User Ad: 300x250");
        self::$UserAd_PromotedUniverseDesktop = self::getByName("UserAd: PromotedUniverseDesktop");
        self::$UserAd_PromotedUniverseTablet = self::getByName("UserAd: PromotedUniverseTablet");
        self::$UserAd_PromotedUniversePhone = self::getByName("UserAd: PromotedUniversePhone");
        self::$UserAd_PromotedUniverseConsole = self::getByName("UserAd: PromotedUniverseConsole");
        self::$Group = self::getByName("Group");
        self::$Badge = self::getByName("Badge");
        self::$GroupRoleSet = self::getByName("GroupRoleSet");
        self::$YouTubeMediaItem = self::getByName("YouTubeMediaItem");
        self::$ImageMediaItem = self::getByName("ImageMediaItem");
        self::$GamePass = self::getByName("Game Pass");
        self::$CashOut = self::getByName("Cash Out");
        self::$Audio = self::getByName("Audio");
        self::$UsernameChange = self::getByName("Username Change");
        self::$Animation = self::getByName("Animation");
        self::$Clan = self::getByName("Clan");
        self::$PrivateServer = self::getByName("PrivateServer");
        self::$AudioShortSoundEffect = self::getByName("Audio: Short Sound Effect");
        self::$AudioLongSoundEffect = self::getByName("Audio: Long Sound Effect");
        self::$AudioMusic = self::getByName("Audio: Music");
        self::$AudioLongMusic = self::getByName("Audio: Long Music");
    }
}
RobloxProduct::init();
