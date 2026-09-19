<?php
namespace Roblox\Common;

use Roblox\Caching\CacheInfo;
use Roblox\GroupCounterType;

class EntityHelper
{
    public static function getEntity(
        CacheInfo $cacheInfo,
        int $id,
        callable $callback
    ) {
        $dal = $callback();

        if (!$dal) {
            return null;
        }

        $entity = new GroupCounterType();
        $entity->construct($dal);

        return $entity;
    }

    public static function getEntityByLookup(
        CacheInfo $cacheInfo,
        string $lookup,
        callable $callback
    ) {
        $dal = $callback();

        if (!$dal) {
            return null;
        }

        $entity = new GroupCounterType();
        $entity->construct($dal);

        return $entity;
    }

    public static function saveEntity(
        $entity,
        callable $insert,
        callable $update
    ): void {
        if ($entity->getID() <= 0) {
            $insert();
        } else {
            $update();
        }
    }

    public static function deleteEntity(
        $entity,
        callable $callback
    ): void {
        $callback();
    }
}