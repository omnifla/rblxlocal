<?php
// fetch assets via caching and apis

namespace Roblox\Game\Asset;

use IncludeHelper;
use Roblox\Settings;
use Roblox\Game\ClientHelper;
use Roblox\AssetType;

class AssetFetcher {
    public bool $cacheAssets;
    public bool $useRobloxCookie;

    private Settings $settingsInstance;
    private string $assetApiKey;

    private const ROBLOXAPI_URL = 'https://apis.roblox.com/asset-delivery-api/v1/assetId/{0}';
    private const ASSET_PATH = '/assets/{0}.{1}';
    private const ASSETPRE_PATH = '/assets/predefined/{0}.{1}';
    private const SIGNEDFILE_EXT = 'saf';

    function __construct()
    {
        $this->settingsInstance = new Settings();
        $this->cacheAssets = $this->settingsInstance->settings['IsAssetOptionRemoteCached']; // might be the wrong setting, meh who cares
        $this->useRobloxCookie = true; // insecure, but keep this true as i haven't tested api keys yet...
        $this->assetApiKey = $_ENV['ROBLOXAPI_KEY'];
    }

    // WARNING: all of these private functions are unsafe, please $assetID before use

    private function getJSONString(string $assetID) : \stdClass {
        // https://stackoverflow.com/a/3032658
        // I AM NOT USING CURL
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => "x-api-key: " . $this->assetApiKey . "\r\n"
            ]
        ];
        $context = stream_context_create($options);

        return json_decode(file_get_contents(str_replace('{0}', $assetID, self::ROBLOXAPI_URL), false, $context));
    }

    private function cacheAsset(string $assetID) {
        $jsonContents = $this->getJSONString($assetID);
        if (!isset($jsonContents->location)) {
            // this is an error, log this and return an empty string
            // $this->loggerInstance->log(LoggerLevel::ERROR, 'failed to load asset id: ' . $assetID)
            var_dump($jsonContents->errors); // TODO: add this to the private logger
            return '';
        }

        $fileContents = file_get_contents($jsonContents->location);
        $isLuaFile = $jsonContents->assetTypeId == AssetType::$PantsID; // modern roblox uses different asset types, models are now 10
        echo $isLuaFile;

        $assetReplaceList = [
            '{0}' => $assetID,
            '{1}' => $isLuaFile ? self::SIGNEDFILE_EXT : 'uaf' // thank god for ternary operations!!!
        ];

        IncludeHelper::putContents(self::ASSET_PATH, $fileContents, $assetReplaceList);
        return $fileContents;
    }

    private function getCachedFile(string $assetID, string $fileExt) : string | null {
        if (!$this->cacheAssets)
            return null;

        $assetReplaceList = [
            '{0}' => $assetID,
            '{1}' => $fileExt
        ];
        $fileContents = IncludeHelper::getContents(self::ASSETPRE_PATH, $assetReplaceList); // check if we have any predefined assets first
        if (!$fileContents)
            $fileContents = IncludeHelper::getContents(self::ASSET_PATH, $assetReplaceList);
        if (!$fileContents)
            return null; // file wasn't found
        if (strcasecmp($fileExt, self::SIGNEDFILE_EXT) == 0) {
            $fileContents = ClientHelper::createAssetSign($fileContents, $assetID);
            $fileContents = ClientHelper::signTextBlob($fileContents);
        }

        return $fileContents;
    }

    public function getAsset(string $assetID) : string | null {
        $assetID = filter_var($assetID);
        $fileInfo = IncludeHelper::findFileByName($assetID, '/assets/predefined');
        
        // DEFINE YOUR LOCAL STORAGE DIRECTORY
        $localMapPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "Asset" . DIRECTORY_SEPARATOR . "Storage" . DIRECTORY_SEPARATOR . $assetID . ".rbxl";

       if (file_exists($localMapPath)) {
            // 1. Clear any active output buffers to eliminate accidental whitespaces
            if (ob_get_length()) ob_end_clean();
            
            $data = file_get_contents($localMapPath);
            
            // 2. Strip UTF-8 Byte Order Mark (BOM) if present (\xEF\xBB\xBF)
            // Older RCC builds will crash instantly if they see a BOM before the "<roblox" tag
            if (str_starts_with($data, "\xEF\xBB\xBF")) {
                $data = substr($data, 3);
            }
            
            // 3. Clean up leading/trailing whitespaces that skew length calculations
            $data = trim($data);
            
            // 4. Set headers explicitly tailored for raw XML asset streams
            header("Content-Type: text/xml; charset=utf-8");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . strlen($data)); // Force strict byte-accurate boundary
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            
            // 5. Output and instantly kill the worker thread
            echo $data;
            exit;
        }

        if (!$fileInfo)
            $fileInfo = IncludeHelper::findFileByName($assetID, '/assets');

        $fileContents = null;
        if ($fileInfo)
            $fileContents = $this->getCachedFile($assetID, $fileInfo['extension']);
        else 
            $fileContents = $this->cacheAsset($assetID);

        return $fileContents;
    }
}