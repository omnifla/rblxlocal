<?php
// handle /game/script.ashx apis
// sadly, i don't have the source for this lol

namespace Roblox\Game;
use Roblox\Game\ClientHelper;
use IncludeHelper;

class ClientScriptCreator {
    public const GAMESCRIPT_LIST = [ // i feel like there's a better way for this
        'join' => [
            'Join.lua'
        ],
        'studio' => [
            'Studio.lua'
        ],
        'visit' => [
            'SingleplayerSharedScript.lua',
            'Visit.lua'
        ],
    ];
    public const LUA_BASEPATH = '/lua/scripts/%s';
    public static array $DEFAULT_REPLACELIST = [
        '{0}' => null,
        '{1}' => null
    ];

    public static function init() { // god i fucking hate php
        // there is a better way to do this, i think
        self::$DEFAULT_REPLACELIST['{0}'] = $_ENV['SITE_DOMAIN'];
        self::$DEFAULT_REPLACELIST['{1}'] = $_ENV['API_DOMAIN'];
    }

    // WARNING: this is insecure if you DON'T filter the variables, please filter them
    public static function formatScripts(array $scriptList, array $replaceList) : string {
        $returnScript = '';
        foreach ($scriptList as $script) {
            $returnScript = $returnScript . IncludeHelper::getContents(sprintf(self::LUA_BASEPATH, $script));
        }

        // now, we do some magical replacement
        foreach ($replaceList as $strReplace => $strValue) { // don't use the second arg in getContents since this predates that
            $returnScript = str_replace($strReplace, $strValue, $returnScript);
        }
        return $returnScript;
    }

    public static function getScript(string $script, array $replaceList) : string {
        $script = strtolower($script);
        if (!self::$DEFAULT_REPLACELIST['{0}'])
            self::init();
        if (!isset(self::GAMESCRIPT_LIST[$script]))
            throw new \OutOfRangeException('Bad script name');
        
        $formatedScript = self::formatScripts(self::GAMESCRIPT_LIST[$script], $replaceList);
        return ClientHelper::signTextBlob($formatedScript);
    }
}
