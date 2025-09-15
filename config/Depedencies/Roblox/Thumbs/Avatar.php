<?php 
// ported and written by meditext 
namespace Roblox\Thumbs; 
use IncludeHelper; 
use Roblox\Grid; 
use Roblox\Grid\Lua;
use Roblox\Grid\Rcc as RBXGS; 
use Roblox\Authentication as Auth; 
use Roblox\Accoutrement; 
class AvatarRequest { 
    private $userId; 
    private $parameters; 
    private $avatarAssetHashId; 

    public function __construct($parameters, $user, $avatarAssetHashId) { 
        $this->parameters = $parameters; 
        $this->userId = $user['id']; 
        $this->avatarAssetHashId = $avatarAssetHashId; 
    } 

    public function getScript($size) { 
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
        $avatarAccoutrementsUrl = sprintf( Avatar::$avatarAccoutrementsBaseUrl, $this->userId ); 
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
                $this->parameters['format'], 
                $size['width'],
                $size['height']
            ]
        ); 
    } 
} 
class Avatar {
    private static $avatarScriptOverride = null;
    public static $avatarScript = "AvatarScript.lua"; 
    public static $baseUrl = "http://%s/"; 
    public static $avatarAccoutrementsBaseUrl = "%sAsset/CharacterFetch.ashx?userId=%s"; 
    public static function init(){
        self::$baseUrl = sprintf(self::$baseUrl, $_SERVER['SERVER_NAME']);
        self::$avatarAccoutrementsBaseUrl = sprintf(self::$avatarAccoutrementsBaseUrl, self::$baseUrl, "%s");
    }

    public function requestThumbnail($userId, $width = null, $height = null, $imageFormat = "png", $thumbnailFormatId = 1) {
        if (is_null($width) || is_null($height)) {
            $thumbnailFormat = $this->getThumbnailFormat($thumbnailFormatId);
            $width = $thumbnailFormat['width']; 
            $height = $thumbnailFormat['height']; 
        } 
        $user = $this->getUser($userId); 
        $imageParameters = $this->createImageParameters($width, $height, $imageFormat, $thumbnailFormatId); 
        $thumbResult = $this->getThumbnailUrl($user, $imageParameters); 

        return ['url' => $thumbResult['url'], 'isSecure' => $this->isSecureConnection()]; 
    } 
    private function getThumbnailFormat($thumbnailFormatId) {
        // stub, return 100px2
        return ['width' => 100, 'height' => 100];
    } 
    private function getUser($userId) {
        $user = Auth::GetUserInfo($userId); 
        if(!$user){ 
            exit("uhm what"); 
        } 
        return ['id' => $user['id'], 'name' => $user['username'], 'bodycolor' => $user['bodycolor']];
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
        $avatarscript = $avatarRequest->getScript([
            'width' => $parameters['width'],
            'height' => $parameters['height']
        ]);

        $rccservice = new RBXGS\RCCServiceSoap("127.0.0.1", 64989);
        $job = new RBXGS\Job($avatarAssetHashId);

        $output = $rccservice->BatchJobEx($job, $avatarscript);
        
        if (is_soap_fault($output) || $output === null) {
            exit("RCCService returned null or fault for avatar {$avatarAssetHashId}");
            return ['url' => null];
        }
        // normalize the response
        $base64 = null;
        $base64 = $output;

        if (empty($base64)) {
            exit("No base64 data returned for avatar {$avatarAssetHashId}");
            return ['url' => null];
        }

        $storageDir = $_SERVER["DOCUMENT_ROOT"] . "/../thumbnail_renders/";
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }

        $filename = "{$avatarAssetHashId}.{$parameters['format']}";
        $filePath = $storageDir . $filename;

            $data = base64_decode($base64);
            if ($data !== false) {
                file_put_contents($filePath, $data);
            } else {
                error_log("Failed to decode base64 for avatar {$avatarAssetHashId}");
                return ['url' => null];
            }
        // parse domain to only let the actual root domain to be used (preventing subdomains)
        $domainParts = explode('.', $_SERVER['SERVER_NAME']);
        $domainCount = count($domainParts);
        if ($domainCount >= 2) {
            $rootDomain = $domainParts[$domainCount - 2] . '.' . $domainParts[$domainCount - 1];
        } else {
            $rootDomain = $_SERVER['SERVER_NAME'];
        }

        $url = "https://thumbs.{$rootDomain}/" . $filename;
        return ['url' => $url];
    }

    private function getAvatarAssetHashId($user) {
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
    public static function getAvatarScriptContent() { 
        $cont = self::$avatarScriptOverride ?? self::$avatarScript;
        $val = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../config/Depedencies/Roblox/Thumbs/" . $cont);
        return $val; 
    } 
    private function createAvatarRequest($parameters, $user, $avatarAssetHashId) {
        return new AvatarRequest($parameters, $user, $avatarAssetHashId); 
    } 
    private function getAvatarScript() {
        return self::getAvatarScriptContent(); 
    } 
    private function isSecureConnection() { 
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'; 
    } 
}
Avatar::init();
