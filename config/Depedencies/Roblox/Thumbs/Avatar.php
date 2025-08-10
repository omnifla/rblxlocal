<?php
// ported and written by meditext
namespace Roblox\Thumbs;
use Roblox\Grid;
use Roblox\Grid\Lua;
use Roblox\Grid\Rcc as RBXGS;
use Roblox\Authentication as Auth;
use Roblox\Accoutrement;
class AvatarRequest {
    private $userId;
    private $parameters;
    private $avatarAssetHashId;
    public function __construct($parameters, $user, $avatarAssetHashId)
    {
        $this->parameters = $parameters;
        $this->userId = $user['id'];
        $this->avatarAssetHashId = $avatarAssetHashId;
    }
    public function getScript($size)
    {
        $equippedGearId = 0;
        $assetIds = [];
        $accoutrements = Accoutrement::getUserAccoutrements($this->userId);

        foreach ($accoutrements as $accoutrement) {
            $assetIds[] = $accoutrement->getDAL()->user_asset_id;
            if ($accoutrement->isEquipped()) {
                $equippedGearId = $accoutrement->getDAL()->user_asset_id;
            }
        }

        $assetIdsString = implode(", ", $assetIds);
        $avatarAccoutrementsUrl = sprintf(
            Avatar::$avatarAccoutrementsBaseUrl,
            $this->userId,
            $assetIdsString
        );

        if ($equippedGearId !== 0) {
            $avatarAccoutrementsUrl .= "&EquippedGearId={$equippedGearId}";
        }

        return Lua::NewScriptWithArgs(
            $this->avatarAssetHashId,
            Avatar::getAvatarScriptContent(),
            [$avatarAccoutrementsUrl,
            Avatar::$baseUrl,
            $this->parameters['format'],
            $size['width'],
            $size['height']]
        );
    }
}

class Avatar {
    private static $avatarScriptOverride = null;
    public static $avatarScript = "AvatarScript.lua"; 
    public static $baseUrl = "http://roblox.com/";
    private static $avatarAccoutrementsBaseUrl = "http://roblox.com/Asset/AvatarAccoutrements.ashx?UserID={0}&AssetIDs={1}";

    public function requestThumbnail($userId, $width = null, $height = null, $imageFormat = "png", $thumbnailFormatId = 1) {
        if (is_null($width) || is_null($height)) {
            $thumbnailFormat = $this->getThumbnailFormat($thumbnailFormatId);
            $width = $thumbnailFormat['width'];
            $height = $thumbnailFormat['height'];
        }

        $user = $this->getUser($userId);
        $imageParameters = $this->createImageParameters($width, $height, $imageFormat, $thumbnailFormatId);
        $thumbResult = $this->getThumbnailUrl($user, $imageParameters);

        return [
            'url' => $thumbResult['url'],
            'isSecure' => $this->isSecureConnection()
        ];
    }

    private function getThumbnailFormat($thumbnailFormatId) {
        // stub, return 100px2
        return ['width' => 100, 'height' => 100];
    }

    private function getUser($userId) {
        $user = Auth::GetUserInfo($userId);
        if(!$user){
            // Guestify as the user entry is not found
            // crop the ID to 4 digits
            $userId = abs($userId) % 10000;
            return ['id' => -$userId, 'name' => "Guest $userId"];
        }
        return ['id' => $user['id'], 'name' => $user['username']];
    }

    private function createImageParameters($width, $height, $imageFormat, $thumbnailFormatId) {
        return [
            'width' => $width,
            'height' => $height,
            'format' => $imageFormat,
            'thumbnailFormatId' => $thumbnailFormatId
        ];
    }

    private function getThumbnailUrl($user, $parameters) {
        $avatarAssetHashId = $this->getAvatarAssetHashId($user);
        $avatarRequest = new AvatarRequest($parameters, $user, $avatarAssetHashId);
        // stub
        return ['url' => ""];
    }

    private function getAvatarAssetHashId($user) {
        $accoutrements = Accoutrement::getUserAccoutrements($user['id']);
        if (empty($accoutrements)) {
            return 0;
        }
        $hashComponents = [];
        foreach ($accoutrements as $accoutrement) {
            $hashComponents[] = $accoutrement->getDAL()->user_asset_id;
        }

        return crc32(implode(',', $hashComponents));
    }

    public static function getAvatarScriptContent()
    {
        return self::$avatarScriptOverride ?? self::$avatarScript;
    }

    private function createAvatarRequest($parameters, $user, $avatarAssetHashId)
    {
        return new AvatarRequest($parameters, $user, $avatarAssetHashId);
    }

    private function getAvatarScript()
    {
        return self::getAvatarScriptContent();
    }
    private function isSecureConnection() {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }
}