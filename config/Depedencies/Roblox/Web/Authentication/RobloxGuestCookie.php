<?php
// ported by meditext
namespace Roblox\Authentication;
// this file defines the RobloxGuestCookie class and its dependencies
// extra note: someone can use this to be any guest they want to be including guest 666 but who cares lol
// NO SWEAR WORDS ALLOWED SKYLER
class RobloxGuestCookie
{
    const COOKIE_NAME = "GuestData";
    const GUEST_ID_KEY = "UserID";
    const GUEST_GENDER_KEY = "Gender";
    const EXPIRATION_LENGTH = 10000 * 24 * 60 * 60;

    public $GuestId;
    public $GuestGender;

    public function __construct($guestId = null, $guestGender = null)
    {
        $this->GuestId = $guestId;
        $this->GuestGender = $guestGender;
    }

    public static function GetOrCreate($guestId = null)
    {
        $cookieData = [];
        if (isset($_COOKIE[self::COOKIE_NAME])) {
            parse_str($_COOKIE[self::COOKIE_NAME], $cookieData);
        }
        $guestIdValue = isset($cookieData[self::GUEST_ID_KEY]) ? $cookieData[self::GUEST_ID_KEY] : null;
        $guestGenderValue = isset($cookieData[self::GUEST_GENDER_KEY]) ? $cookieData[self::GUEST_GENDER_KEY] : null;

        if ($guestId !== null) {
            if ($guestIdValue !== $guestId) {
                $cookieData[self::GUEST_ID_KEY] = $guestId;
                $guestIdValue = $guestId;
                self::setCookieData($cookieData);
            }
        } elseif ($guestIdValue === null) {
            $guestIdValue = null;
        }

        return new self($guestIdValue, $guestGenderValue);
    }

    public function Save()
    {
        $cookieData = [];
        if ($this->GuestId !== null) {
            $cookieData[self::GUEST_ID_KEY] = $this->GuestId;
        }
        if (!empty($this->GuestGender)) {
            $cookieData[self::GUEST_GENDER_KEY] = $this->GuestGender;
        }
        self::setCookieData($cookieData);
    }

    public function Delete()
    {
        setcookie(self::COOKIE_NAME, '', time() - 3600, "/");
        unset($_COOKIE[self::COOKIE_NAME]);
    }

    private static function setCookieData($data)
    {
        $cookieValue = http_build_query($data);
        setcookie(self::COOKIE_NAME, $cookieValue, time() + self::EXPIRATION_LENGTH, "/");
        $_COOKIE[self::COOKIE_NAME] = $cookieValue;
    }
}
