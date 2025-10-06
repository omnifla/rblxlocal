<?php
namespace Roblox\Controls;

class ScriptingUtilities {
    public static function escapeForJavaScript(string $value): string {
        return str_replace(
            ["\\", "\"", "\n", "\r", "'"],
            ["\\\\", "\\\"", "\\n", "\\r", "\\'"],
            $value
        );
    }

    public static function renderScriptBlock(string $js): string {
        return "<script type=\"text/javascript\">\n" . $js . "\n</script>";
    }

    public static function onLoadScript(string $js): string {
        return self::renderScriptBlock("document.addEventListener('DOMContentLoaded', function() { $js });");
    }
}
