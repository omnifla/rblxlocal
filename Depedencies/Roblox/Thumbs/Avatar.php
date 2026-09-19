<?php

namespace Roblox\Thumbs;

use Roblox\Grid;
use Roblox\Grid\Lua;
use Roblox\Grid\Rcc as RBXGS;
use Roblox\Accoutrement;
use Roblox\Authentication as Auth;
use Exception;

class AvatarRequest
{
    private $userId;
    private $parameters;
    private $avatarAssetHashId;

    public function __construct($parameters, $user, $avatarAssetHashId)
    {
        $this->parameters = $parameters;
        $this->userId = (int) $user['id'];
        $this->avatarAssetHashId = $avatarAssetHashId;
    }

    public function getScript($size)
    {
        $equippedGearId = 0;
        $assetIds = [];

        $accoutrements = Accoutrement::getUserAccoutrements($this->userId);

        foreach ($accoutrements as $accoutrement) {
            if (!$accoutrement)
                continue;

            $dal = $accoutrement->getDAL();
            if (!$dal)
                continue;

            $assetIds[] = $dal->user_asset_id;

            if ($accoutrement->isEquipped()) {
                $equippedGearId = $dal->user_asset_id;
            }
        }

        $avatarAccoutrementsUrl = sprintf(
            Avatar::$avatarAccoutrementsBaseUrl,
            $this->userId
        );

        if ($equippedGearId !== 0) {
            $avatarAccoutrementsUrl .= "&EquippedGearId={$equippedGearId}";
        }

        $avatarcontent = Avatar::getAvatarScriptContent();

        return Lua::NewScriptWithArgs(
            $this->avatarAssetHashId,
            $avatarcontent,
            [
                $avatarAccoutrementsUrl,
                Avatar::$baseUrl,
                $this->parameters['format'] ?? 'png',
                $size['width'] ?? 100,
                $size['height'] ?? 100
            ]
        );
    }
}

class Avatar
{
    private static $avatarScriptOverride = null;

    public static $avatarScript = "AvatarScript.lua";
    public static $baseUrl = "http://%s/";
    public static $avatarAccoutrementsBaseUrl = "%sAsset/CharacterFetch.ashx?userId=%d";

    public static function init()
    {
        self::$baseUrl = sprintf(self::$baseUrl, $_SERVER['SERVER_NAME']);

        self::$avatarAccoutrementsBaseUrl =
            self::$baseUrl . "Asset/CharacterFetch.ashx?userId=%d";
    }

    public function requestThumbnail($userId, $width = 100, $height = 100, $imageFormat = "png", $thumbnailFormatId = 1)
    {
        if (is_null($width) || is_null($height)) {
            $thumbnailFormat = $this->getThumbnailFormat($thumbnailFormatId);
            $width = $thumbnailFormat['width'];
            $height = $thumbnailFormat['height'];
        }
        $user = $this->getUser($userId);
        if (!$user) {
            return ['url' => null];
        }
        $params = $this->createImageParameters($width, $height, $imageFormat, 1);
        $thumbResult = $this->getThumbnailUrl($user, $params);
        if (!isset($thumbResult['url']) && $imageFormat == 'obj') {
            return $thumbResult; // since obj generation outputs without a url
        }
        return [
            'url' => $thumbResult['url'] ?? null,
            'isSecure' => $this->isSecureConnection()
        ];
    }
    private function getThumbnailFormat($thumbnailFormatId)
    {
        // stub, return 100px2
        return ['width' => 100, 'height' => 100];
    }

    private function getUser($userId)
    {
        $user = Auth::GetUserInfo($userId);

        if (!$user) {
            exit("uhm what");
        }

        return ['id' => $user['id'], 'name' => $user['username'], 'bodycolor' => $user['bodycolor']];
    }

    private function createImageParameters($width, $height, $imageFormat, $thumbnailFormatId)
    {
        return [
            'width' => $width,
            'height' => $height,
            'format' => $imageFormat,
            'thumbnailFormatId' => $thumbnailFormatId
        ];
    }

    private function getThumbnailUrl($user, $parameters)
    {
        $avatarAssetHashId = $this->getAvatarAssetHashId($user);

        $avatarRequest = new AvatarRequest(
            $parameters,
            $user,
            $avatarAssetHashId
        );

        $script = $avatarRequest->getScript([
            'width' => $parameters['width'],
            'height' => $parameters['height']
        ]);

        $rccservice = new RBXGS\RCCServiceSoap("127.0.0.1", 64989);
        $job = new RBXGS\Job($avatarAssetHashId);

        $output = $rccservice->BatchJobEx($job, $script);

        if (is_soap_fault($output) || $output === null) {
            exit("RCCService returned null or fault for avatar {$avatarAssetHashId}");
            return ['url' => null];
        }

        // normalize the response
        if ($parameters['format'] === 'obj') {
            return $this->handleObjExport($output);
        }

        $base64 = $output;

        if (empty($base64)) {
            throw \Exception("No base64 data returned for avatar {$avatarAssetHashId}");
        }

        $storageDir = $_SERVER["DOCUMENT_ROOT"] . "/../thumbnail_renders/";

        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }

        $filename = "{$avatarAssetHashId}.{$parameters['format']}";
        $filePath = $storageDir . $filename;

        $decoded = base64_decode($base64);

        if ($decoded === false) {
            return ['url' => null];
        }

        file_put_contents($filePath, $decoded);

        $url = "https://thumbs.{$_SERVER['SERVER_NAME']}/{$filename}";

        return ['url' => $url];
    }

    private function handleObjExport($output)
    {
        $json = json_decode($output, true);

        if (!$json || !isset($json['files'])) {
            error_log("OBJ thumbnail error: invalid JSON returned");
            return ['url' => null];
        }

        $relativePath = "/../thumbnail_renders/";
        $cdnPath = $_SERVER['DOCUMENT_ROOT'] . $relativePath;

        if (!is_dir($cdnPath)) {
            mkdir($cdnPath, 0777, true);
        }

        $obj = base64_decode($json['files']['scene.obj']['content']);
        $objHash = md5($obj);
        $objFilename = $objHash . ".obj";

        $mtl = base64_decode($json['files']['scene.mtl']['content']);
        $mtlHash = md5($mtl);
        $mtlFilename = $mtlHash . ".mtl";

        $textures = [];
        foreach ($json['files'] as $filename => $file) {
            if (str_ends_with($filename, ".png")) {
                $tex = base64_decode($file['content']);
                $texHash = md5($tex);
                $texFilename = $texHash . ".png";

                file_put_contents($cdnPath . $texFilename, $tex);

                $textureReplacements[$filename] = $texFilename;
                $textures[] = $texFilename;
            }
        }

        foreach ($textureReplacements as $old => $new) {
            $mtl = str_replace($old, $new, $mtl);
        }

        file_put_contents($cdnPath . $mtlFilename, $mtl);

        return [
            "obj" => $objFilename,
            "mtl" => $mtlFilename,
            "textures" => $textures,
            "camera" => $json["camera"],
            "aabb" => $json["AABB"],
        ];
    }

    private function getAvatarAssetHashId($user)
    {
        $accoutrements = Accoutrement::getUserAccoutrements($user['id']);
        $hashComponents = [];

        foreach ($accoutrements as $accoutrement) {
            $hashComponents[] = $accoutrement->getDAL()->user_asset_id;
        }

        if (empty($hashComponents)) {
            return md5("user:{$user['id']};bodycolors:{$user['bodycolor']}");
        }

        return md5(implode(',', $hashComponents));
    }

    public static function getAvatarScriptContent()
    {
        $cont = self::$avatarScriptOverride ?? self::$avatarScript;
        $val = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../Depedencies/Roblox/Thumbs/" . $cont);
        return $val;
    }
    private function createAvatarRequest($parameters, $user, $avatarAssetHashId)
    {
        return new AvatarRequest($parameters, $user, $avatarAssetHashId);
    }
    private function getAvatarScript()
    {
        return self::getAvatarScriptContent();
    }
    private function isSecureConnection()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }
}

Avatar::init();