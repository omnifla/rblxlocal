<?php
// ported and written by meditext
namespace Roblox\Thumbs;
use Roblox\Grid;
use Roblox\Grid\Rcc as RBXGS;
use Roblox\Authentication as Auth;
use Roblox\Avatar\Accoutrement;

class Avatar {
    private static $avatarScriptOverride = null;
    private static $avatarScript = "AvatarScript.lua"; 
    private static $baseUrl = "http://roblox.com/";

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
        $avatarRequest = $this->createAvatarRequest($parameters, $user, $avatarAssetHashId);
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

    private function createAvatarRequest($parameters, $user, $avatarAssetHashId) {
        $script = $this->getAvatarScript();
        $baseUrl = self::$baseUrl;

        $accoutrements = Accoutrement::getUserAccoutrements($user['id']);
        $accoutrementIds = array_map(fn($acc) => $acc->getDAL()->user_asset_id, $accoutrements);

        return [
            'parameters' => $parameters,
            'user' => $user,
            'avatarAssetHashId' => $avatarAssetHashId,
            'script' => $script,
            'baseUrl' => $baseUrl,
            'accoutrements' => $accoutrementIds
        ];
    }

    private function getAvatarScript() {
        return self::$avatarScriptOverride ?? self::$avatarScript;
    }

    private function isSecureConnection() {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }
}