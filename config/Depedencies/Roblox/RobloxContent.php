<?php

namespace Roblox;

use DOMDocument;
use DOMElement;
use Exception;
use Imagick;
use Roblox\Common\Web;

class RobloxContent
{
    private static string $assetUrl;

    public static function init(): void
    {
        self::$assetUrl = rtrim(Web::$ApplicationURL, '/') . '/asset/';
    }

    private static function createTexturedItem(AssetType $assetType, string $textureUrl): DOMDocument
    {
        $item = new DOMDocument();
        switch ($assetType->Value) {
            case 'Decal':
                $item->loadXML(RobloxContentUtilities::$DefaultDecal);
                $textureNode = Decal::getTextureNode($item);
                if ($textureNode) {
                    $textureNode->nodeValue = "<url>{$textureUrl}</url>";
                }
                break;
            default:
                throw new Exception("AssetType {$assetType->Value} is not valid RobloxContent.");
        }
        return $item;
    }

    private static function resampleTexture(AssetType $assetType, string $imageData): string
    {
        switch ($assetType->Value) {
            case 'Decal':
                return Decal::resampleTexture($imageData);
            default:
                throw new Exception("AssetType {$assetType->Value} is not valid RobloxContent.");
        }
    }

    private static function validateContentType(AssetType $assetType): void
    {
        if ($assetType->ID !== AssetType::DecalID()) {
            throw new Exception("AssetType {$assetType->Value} is not valid RobloxContent.");
        }
    }

    public static function create(User $user, AssetType $assetType, string $itemName, string $itemDescription, string $imageData, bool $resample, ?int $userImageAsset): UserAsset
    {
        self::validateContentType($assetType);

        $imageAssetType = AssetType::getImage();
        $imageDescription = "{$assetType->Value} Image";

        if ($resample) {
            $resampled = self::resampleTexture($assetType, $imageData);
            $imageUserAsset = UserAsset::createNew($imageAssetType, $itemName, $imageDescription, $user->ID, $resampled);
        } else {
            $imageUserAsset = UserAsset::get($userImageAsset);
        }

        if (!$imageUserAsset) {
            throw new Exception("Failed to create new Image UserAsset.");
        }

        $imageUrl = self::$assetUrl . "?id=" . $imageUserAsset->AssetID;
        $xml = self::createTexturedItem($assetType, $imageUrl);

        $itemUserAsset = UserAsset::createNew($assetType, $itemName, $itemDescription, $user->ID, $xml->saveXML());

        if (!$itemUserAsset) {
            throw new Exception("Failed to create new {$assetType->Value} UserAsset.");
        }

        return $itemUserAsset;
    }
}

class Decal
{
    public static function getImageUri(DOMDocument $doc): ?string
    {
        $node = self::getTextureNode($doc);
        if ($node && $node->firstChild && $node->firstChild->nodeName === 'url') {
            return $node->firstChild->nodeValue;
        }
        return null;
    }

    public static function getNode(DOMDocument $doc): ?DOMElement
    {
        foreach ($doc->getElementsByTagName('roblox') as $robloxNode) {
            foreach ($robloxNode->getElementsByTagName('Item') as $itemNode) {
                if ($itemNode->getAttribute('class') === 'Decal') {
                    return $itemNode;
                }
            }
        }
        return null;
    }

    public static function getTextureNode(DOMDocument $doc): ?DOMElement
    {
        $itemNode = self::getNode($doc);
        if ($itemNode) {
            foreach ($itemNode->getElementsByTagName('Properties') as $propsNode) {
                foreach ($propsNode->childNodes as $child) {
                    if ($child instanceof DOMElement && $child->getAttribute('class') === 'Texture') {
                        return $child;
                    }
                }
            }
        }
        return null;
    }

    public static function resampleTexture(string $imageData): string
    {
        $imagick = new Imagick();
        $imagick->readImageBlob($imageData);
        $imagick->resizeImage(256, 256, Imagick::FILTER_LANCZOS, 1, true);
        $imagick->setImageFormat('png');
        return $imagick->getImageBlob();
    }

    public static function isDecal(AssetVersion $assetVersion): bool
    {
        return $assetVersion->AssetTypeID === AssetType::DecalID();
    }
}

RobloxContent::init();
