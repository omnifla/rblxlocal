<?php
// ported by meditext
namespace Roblox;

use Roblox\Platform\AssetOwnershipAuthority;

class QueryStringAssetParameterParser
{
    public static function ParseAssetFromQuerystring(string $uri, bool $throwIfBadUrl = true)
    {
        $parts = parse_url($uri);
        $query = $parts['query'] ?? '';
        parse_str($query, $params);

        if (isset($params['userassetid'])) {
            $userAssetId = (int)$params['userassetid'];
            $ua = OwnershipV1UserAssetFactory::getByUserAssetId($userAssetId) ?? null;
            if ($ua) {
                return Asset::Get((int)$ua->assetId);
            }
            if ($throwIfBadUrl) throw new \InvalidArgumentException('Bad userassetid');
            return null;
        }

        if (isset($params['versionid']) || isset($params['assetversionid'])) {
            $v = (int)($params['versionid'] ?? $params['assetversionid']);
            return AssetVersion::Get($v);
        }

        $assetId = $params['id'] ?? null;
        $assetVersion = $params['version'] ?? null;

        if ($assetId !== null && $assetVersion !== null) {
            return AssetVersion::Get((int)$assetId, (int)$assetVersion);
        }

        if ($assetId !== null) {
            return Asset::Get((int)$assetId);
        }

        if ($throwIfBadUrl) {
            throw new \InvalidArgumentException('No asset in URL');
        }
        return null;
    }

    public static function ParseAssetIdFromQueryString(string $uri, bool $throwIfBadUrl = true): ?int
    {
        $asset = self::ParseAssetFromQuerystring($uri, $throwIfBadUrl);
        if ($asset === null) return null;
        if (is_a($asset, 'Roblox\\AssetVersion')) {
            return $asset->AssetID ?? ($asset->assetId ?? null);
        }
        if (is_a($asset, 'Roblox\\Asset')) {
            return $asset->ID ?? ($asset->id ?? null);
        }
        return null;
    }

    public static function ParseAssetReferenceFromQuerystring(string $uri, bool $throwIfBadUrl = true): ?AssetReference
    {
        $parts = parse_url($uri);
        $query = $parts['query'] ?? '';
        parse_str($query, $params);

        if (isset($params['userassetid'])) {
            $userAssetId = (int)$params['userassetid'];
            $ua = OwnershipV1UserAssetFactory::getByUserAssetId($userAssetId) ?? null;
            if ($ua) {
                return AssetReference::fromAssetSubscription((int)$ua->assetId);
            }
        }

        if (isset($params['versionid']) || isset($params['assetversionid'])) {
            $av = AssetVersion::Get((int)($params['versionid'] ?? $params['assetversionid']));
            if ($av) return AssetReference::fromAssetSubscription($av->AssetID);
        }

        $assetId = $params['id'] ?? null;
        $assetVersion = $params['version'] ?? null;

        if ($assetId !== null && $assetVersion !== null) {
            $av2 = AssetVersion::Get((int)$assetId, (int)$assetVersion);
            if ($av2) return AssetReference::fromAssetVersion($av2->ID ?? $av2->id);
        }

        if ($assetId !== null) {
            $a = Asset::Get((int)$assetId);
            if ($a) return AssetReference::fromAssetSubscription($a->ID ?? $a->id);
        }

        if ($throwIfBadUrl) throw new \InvalidArgumentException('No asset reference in query');
        return null;
    }
}