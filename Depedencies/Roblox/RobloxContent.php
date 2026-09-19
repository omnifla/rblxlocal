<?php

namespace Roblox;

use DOMDocument;
use DOMElement;
use Exception;
use Imagick;
use Roblox\Web;
use Roblox\AssetType;

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
        switch ($assetType->value) {
            case 'Decal':
                $item->loadXML(RobloxContentUtilities::$DefaultDecal);
                $textureNode = Decal::getTextureNode($item);
                if ($textureNode) {
                    $textureNode->nodeValue = "<url>{$textureUrl}</url>";
                }
                break;
            default:
                throw new Exception("AssetType {$assetType->value} is not valid RobloxContent.");
        }
        return $item;
    }

    private static function resampleTexture(AssetType $assetType, string $imageData): string
    {
        switch ($assetType->value) {
            case 'Decal':
                return Decal::resampleTexture($imageData);
            default:
                throw new Exception("AssetType {$assetType->value} is not valid RobloxContent.");
        }
    }

    private static function validateContentType(AssetType $assetType): void
    {
        if ($assetType->id !== AssetType::DecalID()) {
            throw new Exception("AssetType {$assetType->value} is not valid RobloxContent.");
        }
    }

    public static function create(User $user, AssetType $assetType, string $itemName, string $itemDescription, string $imageData, bool $resample, ?int $userImageAsset): UserAsset
    {
        self::validateContentType($assetType);

        $imageAssetType = AssetType::getImage();
        $imageDescription = "{$assetType->value} Image";

        if ($resample) {
            $resampled = self::resampleTexture($assetType, $imageData);
            $imageUserAsset = UserAsset::createNew($user->getID(), $imageAssetType->id, AssetType::getImage()->id);
            $imageUserAsset->save();
        } else {
            $imageUserAsset = UserAsset::get($userImageAsset);
        }

        if (!$imageUserAsset) {
            throw new Exception("Failed to create new Image UserAsset.");
        }

        $imageUrl = self::$assetUrl . "?id=" . $imageUserAsset->getAssetId();
        $xml = self::createTexturedItem($assetType, $imageUrl);

        $itemUserAsset = UserAsset::createNew($user->getID(), $assetType->id, $assetType->id);

        if (!$itemUserAsset) {
            throw new Exception("Failed to create new {$assetType->value} UserAsset.");
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
        foreach ($doc->childNodes as $child) {
            if ($child instanceof DOMElement && $child->nodeName === 'roblox') {
                foreach ($child->childNodes as $itemNode) {
                    if ($itemNode instanceof DOMElement && $itemNode->nodeName === 'Item' && $itemNode->getAttribute('class') === 'Decal') {
                        return $itemNode;
                    }
                }
            }
        }
        return null;
    }

    public static function getTextureNode(DOMDocument $doc): ?DOMElement
    {
        $itemNode = self::getNode($doc);
        if ($itemNode) {
            foreach ($itemNode->childNodes as $child) {
                if ($child instanceof DOMElement && $child->nodeName === 'Properties') {
                    foreach ($child->childNodes as $prop) {
                        if ($prop instanceof DOMElement && $prop->getAttribute('class') === 'Texture') {
                            return $prop;
                        }
                    }
                }
            }
        }
        return null;
    }

    public static function resampleTexture(string $imageData): string
    {
        if (!class_exists('Imagick')) {
            return $imageData;
        }

        $imagick = new Imagick();
        $imagick->readImageBlob($imageData);
        $imagick->resizeImage(256, 256, Imagick::FILTER_LANCZOS, 1, true);
        $imagick->setImageFormat('png');
        return $imagick->getImageBlob();
    }

    public static function isDecal(AssetVersion $assetVersion): bool
    {
        return $assetVersion->AssetTypeID === AssetType::DecalID() || $assetVersion->AssetTypeID === AssetType::DecalID();
    }
}

RobloxContent::init();
