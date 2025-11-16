<?php
// ported by meditext
namespace Roblox;

class Pants
{
    public static function GetImageUriFromXml(string $xml): ?string
    {
        $doc = new \DOMDocument();
        $doc->loadXML($xml);
        $node = self::GetTextureNode($doc);
        if ($node && $node->hasChildNodes()) {
            $child = $node->firstChild;
            if ($child->nodeName === 'url') {
                return $child->nodeValue;
            }
        }
        return null;
    }

    public static function GetNode(\DOMDocument $doc): ?\DOMElement
    {
        foreach ($doc->childNodes as $child) {
            if ($child->nodeName !== 'roblox') continue;
            foreach ($child->childNodes as $item) {
                if ($item->nodeName === 'Item' && $item->getAttribute('class') === 'Pants') {
                    return $item;
                }
            }
        }
        return null;
    }

    public static function GetTextureNode(\DOMDocument $doc)
    {
        $node = self::GetNode($doc);
        if (!$node) return null;
        foreach ($node->childNodes as $props) {
            if ($props->nodeName !== 'Properties') continue;
            foreach ($props->childNodes as $prop) {
                if ($prop->getAttribute('name') === 'PantsTemplate') return $prop;
            }
        }
        return null;
    }

    public static function GetImageAssetFromXml(string $xml)
    {
        $uri = self::GetImageUriFromXml($xml);
        if (!$uri) throw new \InvalidArgumentException('No image uri');
        return QueryStringAssetParameterParser::ParseAssetFromQuerystring($uri, true);
    }

    public static function TemplateIsValid($streamOrFile): bool
    {
        if (is_string($streamOrFile) && file_exists($streamOrFile)) {
            $info = getimagesize($streamOrFile);
        } elseif (is_resource($streamOrFile)) {
            $tmp = tmpfile();
            stream_copy_to_stream($streamOrFile, $tmp);
            fseek($tmp, 0);
            $meta = stream_get_meta_data($tmp);
            $tmpname = $meta['uri'];
            $info = getimagesize($tmpname);
            fclose($tmp);
        } else {
            return false;
        }

        if (!$info) return false;
        $width = $info[0];
        $height = $info[1];
        return ($height === 559 && $width === 585);
    }
}
