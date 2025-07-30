<?php
// fetch assets via caching and apis

namespace Roblox\Game\Asset;

use IncludeHelper;
use Roblox\Settings;
use Roblox\Game\ClientHelper;

class AssetFetcher {
    public bool $cacheAssets;

    private Settings $settingsInstance;

    private const ROBLOXAPI_URL = 'https://assetdelivery.roblox.com/v1/assetId/{0}';
    private const ASSET_PATH = '/assets/{0}.{1}';
    private const ASSETPRE_PATH = '/assets/predefined/{0}.{1}';
    private const SIGNEDFILE_EXT = 'saf';

    function __construct()
    {
        $this->settingsInstance = new Settings();
        $this->cacheAssets = $this->settingsInstance->settings['IsAssetOptionRemoteCached']; // might be the wrong settings, meh who cares
    }

    // WARNING: this is unsafe as $assetID isn't filtered
    private function getJSONString(string $assetID) : \stdClass {
        return json_decode(file_get_contents(str_replace('{0}', $assetID, self::ROBLOXAPI_URL)));
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
            $fileContents = file_get_contents($this->getJSONString($assetID)->location);

        return $fileContents;
    }
}