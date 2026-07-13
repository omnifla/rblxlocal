<?php

namespace Roblox\RequestContext;

use Roblox\PolicyLookup\IUserPolicyLookup;

class IRequestContextLoader
{
    public function __construct(
        private IUserPolicyLookup $policyLookup
    ) {}

    public function getCurrentContext(): RequestContext
    {
        $headers = function_exists('getallheaders') ? getallheaders() : [];

        $userId = $_COOKIE['userId'] ?? $_GET['userId'] ?? null;
        $userId = $userId ? (int)$userId : null;

        $placeId = $_GET['placeId'] ?? $_POST['placeId'] ?? null;
        $placeId = $placeId ? (int)$placeId : null;

        $ip =
            $_SERVER['HTTP_CF_CONNECTING_IP'] ??
            $_SERVER['REMOTE_ADDR'] ??
            '0.0.0.0';

        $isApp =
            isset($headers['X-Roblox-App']) ||
            str_contains($headers['User-Agent'] ?? '', 'Roblox');

        $isSameGame = isset($_COOKIE['sessionPlaceId'])
            && (int)$_COOKIE['sessionPlaceId'] === $placeId;

        $context = new RequestContext(
            isApp: $isApp,
            isSameGame: $isSameGame,
            userId: $userId,
            placeId: $placeId,
            ipAddress: $ip,
            headers: $headers
        );
        
        if ($userId) {
            $context->setApplicablePolicies(
                $this->policyLookup->getApplicablePoliciesForTargetUser($context, $userId)
            );
        }

        return $context;
    }
}