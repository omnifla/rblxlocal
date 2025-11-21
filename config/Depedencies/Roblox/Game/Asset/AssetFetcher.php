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