<?php
namespace Roblox;

use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\DataAccess\UserAvatarDAL;

class UserAvatar
{
    public static string $DefaultPants = '';
    public static string $DefaultShirt = '';
    public static string $DefaultTeeShirt = '';
    public static CacheInfo $EntityCacheInfo;

    private UserAvatarDAL $_EntityDAL;
    private static array $clearThumbnailHandlers = [];
    private static array $userAssetRemovedHandlers = [];

    public function __construct(?UserAvatarDAL $userAvatarDAL = null)
    {
        $this->_EntityDAL = $userAvatarDAL ?? new UserAvatarDAL();
    }

    public function getID(): int
    {
        return $this->_EntityDAL->id;
    }

    public function getUserID(): int
    {
        return $this->_EntityDAL->user_id;
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    public function getAvatarHash(): string
    {
        return $this->_EntityDAL->avatar_hash;
    }

    public function setAvatarHash(string $hash): void
    {
        $hash = substr($hash, 0, 32);
        if ($this->_EntityDAL->avatar_hash !== $hash) {
            $this->_EntityDAL->new_avatar_asset_hash_id = 0;
        }
        $this->_EntityDAL->avatar_hash = $hash;
    }

    public function getNewAvatarAssetHashID(): int
    {
        return $this->_EntityDAL->new_avatar_asset_hash_id;
    }

    public function setNewAvatarAssetHashID(int $value): void
    {
        $this->_EntityDAL->new_avatar_asset_hash_id = $value;
    }

    public function getCreated(): string
    {
        return $this->_EntityDAL->created;
    }

    public function getUpdated(): string
    {
        return $this->_EntityDAL->updated;
    }

    public function getBodyColorSetID(): ?int
    {
        return $this->_EntityDAL->body_color_set_id;
    }

    public function setBodyColorSetID(?int $value): void
    {
        $this->_EntityDAL->body_color_set_id = $value;
    }

    public function getPlayerAvatarTypeID(): ?int
    {
        return $this->_EntityDAL->player_avatar_type_id;
    }

    public function setPlayerAvatarTypeID(?int $value): void
    {
        $this->_EntityDAL->player_avatar_type_id = $value;
    }

    public function getScaleID(): ?int
    {
        return $this->_EntityDAL->scale_id;
    }

    public function setScaleID(?int $value): void
    {
        $this->_EntityDAL->scale_id = $value;
    }

    public function clearThumbnail(): void
    {
        if ($this->getNewAvatarAssetHashID() !== 0) {
            $this->setNewAvatarAssetHashID(0);
            $this->save();
        }
    }

    public function save(): void
    {
        $this->_EntityDAL->updated = date('Y-m-d H:i:s');
        $this->_EntityDAL->update();
    }

    private static function doGetOrCreate(int $userId, ?int $playerAvatarTypeId, ?int $scaleId): self
    {
        return new self(UserAvatarDAL::getOrCreate($userId, $playerAvatarTypeId, $scaleId));
    }

    public static function get(int $id): ?self
    {
        $dal = UserAvatarDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function multiGet(array $ids): array
    {
        return array_map(static fn(UserAvatarDAL $dal): self => new self($dal), UserAvatarDAL::multiGet($ids));
    }

    public static function getOrCreate(int $userId, ?int $playerAvatarTypeId = null, ?int $scaleId = null): self
    {
        return self::doGetOrCreate($userId, $playerAvatarTypeId, $scaleId);
    }

    public function construct(UserAvatarDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return $this->getID() > 0 ? ['UserID:' . $this->getUserID()] : [];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }

    public function getSerializable(): UserAvatarDAL
    {
        return $this->_EntityDAL;
    }

    public function appearanceChanged(): void
    {
        $this->clearThumbnail();
    }

    public function getUser(): array
    {
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $this->getUserID()]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];
    }

    public static function onClearThumbnail(callable $handler): void
    {
        self::$clearThumbnailHandlers[] = $handler;
    }

    public static function onUserAssetRemoved(callable $handler): void
    {
        self::$userAssetRemovedHandlers[] = $handler;
    }

    public static function invokeClearThumbnailEvent(int $userId): void
    {
        foreach (self::$clearThumbnailHandlers as $handler) {
            $handler($userId);
        }
    }

    public static function invokeUserAssetRemovedEvent(int $userAssetId, int $userId): void
    {
        foreach (self::$userAssetRemovedHandlers as $handler) {
            $handler($userAssetId, $userId);
        }
    }

    public function __get(string $name)
    {
        return match ($name) {
            'id', 'ID' => $this->_EntityDAL->id,
            'userId', 'UserID' => $this->_EntityDAL->user_id,
            'avatarHash', 'AvatarHash' => $this->_EntityDAL->avatar_hash,
            'newAvatarAssetHashId', 'NewAvatarAssetHashID' => $this->_EntityDAL->new_avatar_asset_hash_id,
            'bodyColorSetId', 'BodyColorSetID' => $this->_EntityDAL->body_color_set_id,
            'playerAvatarTypeId', 'PlayerAvatarTypeID' => $this->_EntityDAL->player_avatar_type_id,
            'scaleId', 'ScaleID' => $this->_EntityDAL->scale_id,
            'created', 'Created' => $this->_EntityDAL->created,
            'updated', 'Updated' => $this->_EntityDAL->updated,
            default => throw new \OutOfBoundsException("Unknown UserAvatar property: $name"),
        };
    }

    public function __set(string $name, mixed $value): void
    {
        switch ($name) {
            case 'avatarHash':
            case 'AvatarHash':
                $this->setAvatarHash((string) $value);
                return;
            case 'newAvatarAssetHashId':
            case 'NewAvatarAssetHashID':
                $this->setNewAvatarAssetHashID((int) $value);
                return;
            case 'bodyColorSetId':
            case 'BodyColorSetID':
                $this->setBodyColorSetID($value === null ? null : (int) $value);
                return;
            case 'playerAvatarTypeId':
            case 'PlayerAvatarTypeID':
                $this->setPlayerAvatarTypeID($value === null ? null : (int) $value);
                return;
            case 'scaleId':
            case 'ScaleID':
                $this->setScaleID($value === null ? null : (int) $value);
                return;
            default:
                throw new \OutOfBoundsException("UserAvatar property is read-only or unknown: $name");
        }
    }

    public function __isset(string $name): bool
    {
        try {
            return $this->__get($name) !== null;
        } catch (\OutOfBoundsException) {
            return false;
        }
    }
}

UserAvatar::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: false,
        countsAreCacheable: false,
        entityIsCacheable: true,
        idLookupsAreCacheable: true,
        hasUnqualifiedCollections: false
    ),
    'UserAvatar',
    isNullCacheable: true
);