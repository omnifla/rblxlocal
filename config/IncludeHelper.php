<?php
// this should help getting includes from config/includes
// neat to use

class IncludeHelper {
    public static $basePath = null;

    public static function findFileByName(string $name, string $addon = '') : array | null {
        if (!self::$basePath)
            self::$basePath = $_SERVER['DOCUMENT_ROOT'] . '/../config/includes';
        foreach (glob(self::$basePath . $addon . '/*.*') as $path) {
            $pathInfo = pathinfo($path);
            if (strcasecmp($pathInfo['filename'], $name) == 0)
                return $pathInfo;
        }

        return null;
    }

    // use this as /json/hey.json
    // NOT /config/includes/json/hey.json
    public static function getContents(string $path, ?array $replaceList = null) : string | false {
        if (!self::$basePath)
            self::$basePath = $_SERVER['DOCUMENT_ROOT'] . '/../config/includes';
        if ($replaceList) {
            foreach ($replaceList as $key => $value) {
                $path = str_replace($key, $value, $path);
            }
        }

        // we should be fine when we use this lol
        return @file_get_contents(self::$basePath . filter_var($path));
    }

    public static function putContents(string $path, mixed $contents, ?array $replaceList = null) {
        if (!self::$basePath)
            self::$basePath = $_SERVER['DOCUMENT_ROOT'] . '/../config/includes';
        if ($replaceList) {
            foreach ($replaceList as $key => $value) {
                $path = str_replace($key, $value, $path);
            }
        }

        file_put_contents(self::$basePath . filter_var($path), $contents);
    }
}