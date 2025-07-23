<?php
// ported by meditext
namespace Roblox;
use Roblox\Web\Authentication\RobloxGuestCookie as RobloxGuestCookie;
// this file defines the UserHelper class and its dependencies


class UserHelper
{
    private static int $_GendersCount = 3;
    // since i dont use the GenderType enum, i will just use the local constants directly.
    const GENDER_TYPES = [0, 1, 2]; // 0 = unknown, 1 = male, 2 = female
    const GENDER_UNKNOWN = 0;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    /// Returns the current guestId.  If one didn't exist, or 
	/// there was an error with the current value, then a new cookie &amp; value
	/// will be created and set in the current context.
	/// This function will throw an exception if it is called after a Response.Redirect call with endResponse parameter value set to False or 
	/// if it is called in an HttpModule's OnEndRequest method.
    public static function GetOrCreateCurrentGuestId()
    {
        return self::GetCurrentGuestId(true);
    }

    public static function GetOrCreateCurrentGuestIdWithoutSettingCookie()
    {
        return self::GetCurrentGuestId(false);
    }

    private static function GetCurrentGuestId($createCookie)
    {
        try {
            $guestCookie = RobloxGuestCookie::GetOrCreate();
        } catch (Exception $ex) {
            error_log($ex);
            return null;
        }
        if (!empty($guestCookie->GuestId)) {
            try {
                $currentGuestId = intval($guestCookie->GuestId);
                if ($currentGuestId < 0) {
                    return $currentGuestId;
                }
            } catch (Exception $ex2) {
                error_log($ex2);
            }
        }
        try {
            $newGuestId = self::GenerateRandomGuestId();
            if ($createCookie) {
                self::SetGuestId($newGuestId);
            }
            return $newGuestId;
        } catch (Exception $ex3) {
            error_log($ex3);
            return null;
        }
    }

	/// This code encodes gender into a guestId, which is never served to the user.
	/// This is really weird.
	///
	/// So what's the purpose of this "guestId encoding gender"?
	/// It's sent to the game instances service, and returned when the website gets the player list for a server.
	/// From that point it's decrypted mod 3 to find out whether the user clicked male or female on the chooser popup,
	/// and correctly display their gender in the player list by server.
	///
	/// So if you are trying to remove this, watch out.
    public static function SetGuestGenderType($genderTypeId)
    {
        $orCreate = RobloxGuestCookie::GetOrCreate();
        $guestId = intval($orCreate->GuestId);
        if ($guestId === 0) {
            $guestId = self::GetGenderedGuestId($genderTypeId);
        } else if (self::GetGuestGenderTypeById($guestId)->ID !== $genderTypeId) {
            $guestId = self::GetGenderedGuestId($genderTypeId);
        }
        $orCreate->GuestId = strval($guestId);
        $orCreate->GuestGender = strval($genderTypeId);
        $orCreate->Save();
    }

    private static function GetGuestGenderTypeById($guestId)
    {
        if ($guestId >= 0) {
            return self::GENDER_UNKNOWN;
        }
        // Gender is encoded as (-guestId % 3 + 1)
        return (int)((-($guestId) % self::$_GendersCount) + 1);
    }

    private static function GetGenderedGuestId($genderTypeId)
    {
        $randomGuestId = -self::GenerateRandomGuestId();
        return -($randomGuestId + $genderTypeId - ($randomGuestId % self::$_GendersCount + 1));
    }

    public static function GetGuestCharacterIdById($guestId)
    {
        global $properties;
        $genderType = self::GetGuestGenderTypeById($guestId);
        $characterId = $properties["DefaultGuestCharacterID"];
        if ($genderType === self::GENDER_MALE) {
            $characterId = $properties["BoyGuestCharacterID"];
        } else if ($genderType === self::GENDER_FEMALE) {
            $characterId = $properties["GirlGuestCharacterID"];
        }
        return $characterId;
    }

    public static function GetGuestGenderType()
    {
        $guestUserCookie = RobloxGuestCookie::GetOrCreate();
        $genderValue = $guestUserCookie->GuestGender;
        if (!empty($genderValue)) {
            $cookiedGenderId = intval($genderValue);
            if (in_array($cookiedGenderId, self::GENDER_TYPES, true)) {
                return $cookiedGenderId;
            }
            $guestUserCookie->Delete();
            error_log("Invalid Guest Gender stored in cookie: " . $cookiedGenderId);
        }
        return self::GENDER_UNKNOWN;
    }

    private static function GenerateRandomGuestId()
    {
        return -random_int(self::$_GendersCount, PHP_INT_MAX - self::$_GendersCount);
    }

    public static function SetGuestId($id)
    {
        if ($id >= 0) {
            throw new Exception("Bad GuestUserID");
        }
        RobloxGuestCookie::GetOrCreate(strval($id));
    }

    public static function GetGuestCharacterId()
    {
        global $properties;
        $genderType = self::GetGuestGenderType();
        $characterId = $properties["DefaultGuestCharacterID"];
        if ($genderType === self::GENDER_MALE) {
            $characterId = $properties["BoyGuestCharacterID"];
        } else if ($genderType === self::GENDER_FEMALE) {
            $characterId = $properties["GirlGuestCharacterID"];
        }
        return $characterId;
    }
}
