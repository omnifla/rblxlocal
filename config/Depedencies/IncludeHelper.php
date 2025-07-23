<?php
// this should help getting includes from config/includes
// neat to use

class IncludeHelper {
    public static $basePath = null;

    // use this as /json/hey.json
    // NOT /config/includes/json/hey.json
    public static function getContents(string $path) {
        if (!self::$basePath)
            self::$basePath = $_SERVER['DOCUMENT_ROOT'] . '/../config/includes';

        // we should be fine when we use this lol
        return file_get_contents(self::$basePath . filter_var($path));
    }
}