<?php
// ported by omnifla
namespace Roblox;

class UserAvatar
{
    public int $id;
    public int $userId;
    public string $avatarHash = '';
    public int $newAvatarAssetHashId = 0;
    public ?int $bodyColorSetId = null;
    public ?int $playerAvatarTypeId = null;
    public ?int $scaleId = null;
    public string $created = '';
    public string $updated = '';

    private function __construct()
    {
    }

    public static function getOrCreate(int $userId, ?int $playerAvatarTypeId = null, ?int $scaleId = null): self
    {
        global $conn;

        $stmt = $conn->prepare("
            SELECT * FROM user_avatars WHERE user_id = :uid LIMIT 1
        ");
        $stmt->execute([':uid' => $userId]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            return self::fromRow($row);
        }

        // create
        $conn->prepare("
            INSERT INTO user_avatars (user_id, avatar_hash, new_avatar_asset_hash_id, player_avatar_type_id, scale_id, created, updated)
            VALUES (:uid, '', 0, :pat, :sid, NOW(), NOW())
        ")->execute([
                    ':uid' => $userId,
                    ':pat' => $playerAvatarTypeId,
                    ':sid' => $scaleId,
                ]);

        return self::getOrCreate($userId, $playerAvatarTypeId, $scaleId);
    }

    public static function get(int $id): ?self
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_avatars WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? self::fromRow($row) : null;
    }

    private static function fromRow(array $row): self
    {
        $a = new self();
        $a->id = (int) $row['id'];
        $a->userId = (int) $row['user_id'];
        $a->avatarHash = $row['avatar_hash'] ?? '';
        $a->newAvatarAssetHashId = (int) ($row['new_avatar_asset_hash_id'] ?? 0);
        $a->bodyColorSetId = isset($row['body_color_set_id']) ? (int) $row['body_color_set_id'] : null;
        $a->playerAvatarTypeId = isset($row['player_avatar_type_id']) ? (int) $row['player_avatar_type_id'] : null;
        $a->scaleId = isset($row['scale_id']) ? (int) $row['scale_id'] : null;
        $a->created = $row['created'] ?? '';
        $a->updated = $row['updated'] ?? '';
        return $a;
    }

    public function setAvatarHash(string $hash): void
    {
        $hash = substr($hash, 0, 32);
        if ($this->avatarHash !== $hash) {
            $this->newAvatarAssetHashId = 0;
        }
        $this->avatarHash = $hash;
    }

    public function clearThumbnail(): void
    {
        if ($this->newAvatarAssetHashId !== 0) {
            $this->newAvatarAssetHashId = 0;
            $this->save();
        }
    }

    public function save(): void
    {
        global $conn;
        $conn->prepare("
            UPDATE user_avatars
            SET avatar_hash             = :hash,
                new_avatar_asset_hash_id = :nahid,
                body_color_set_id       = :bcid,
                player_avatar_type_id   = :patid,
                scale_id                = :sid,
                updated                 = NOW()
            WHERE id = :id
        ")->execute([
                    ':hash' => substr($this->avatarHash, 0, 32),
                    ':nahid' => $this->newAvatarAssetHashId,
                    ':bcid' => $this->bodyColorSetId,
                    ':patid' => $this->playerAvatarTypeId,
                    ':sid' => $this->scaleId,
                    ':id' => $this->id,
                ]);
    }

    public function appearanceChanged(): void
    {
        $this->clearThumbnail();
    }

    public function getUser(): array
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $this->userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: [];
    }
}