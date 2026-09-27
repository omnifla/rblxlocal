<?php
namespace Roblox\DataAccess;

use Exception;
use PDO;

class UserAvatarDAL
{
	public int $id = 0;
	public int $user_id = 0;
	public int $new_avatar_asset_hash_id = 0;
	public string $avatar_hash = '';
	public string $created = '';
	public string $updated = '';
	public ?int $body_color_set_id = null;
	public ?int $player_avatar_type_id = null;
	public ?int $scale_id = null;

	private PDO $db;

	public function __construct()
	{
		global $conn;
		$this->db = $conn;
	}

	private static function buildFromRow(array $row): ?self
	{
		$dal = new self();
		$dal->id = (int) $row['id'];
		$dal->user_id = (int) $row['user_id'];
		$dal->new_avatar_asset_hash_id = (int) ($row['new_avatar_asset_hash_id'] ?? 0);
		$dal->avatar_hash = $row['avatar_hash'] ?? '';
		$dal->created = $row['created'];
		$dal->updated = $row['updated'];
		$dal->body_color_set_id = isset($row['body_color_set_id']) ? (int) $row['body_color_set_id'] : null;
		$dal->player_avatar_type_id = isset($row['player_avatar_type_id']) ? (int) $row['player_avatar_type_id'] : null;
		$dal->scale_id = isset($row['scale_id']) ? (int) $row['scale_id'] : null;

		return $dal->id > 0 ? $dal : null;
	}

	public function delete(): void
	{
		if ($this->id === 0) {
			throw new Exception('Required value not specified: ID.');
		}

		$stmt = $this->db->prepare('DELETE FROM user_avatars WHERE id = :id');
		$stmt->execute([':id' => $this->id]);
	}

	public function update(): void
	{
		if ($this->id === 0) {
			throw new Exception('Required value was not specified: ID.');
		}
		if ($this->user_id === 0) {
			throw new Exception('Required value not specified: UserID.');
		}
		if ($this->created === '') {
			throw new Exception('Required value not specified: Created.');
		}
		if ($this->updated === '') {
			throw new Exception('Required value not specified: Updated.');
		}

		$stmt = $this->db->prepare(''
			. 'UPDATE user_avatars SET user_id = :user_id, avatar_hash = :avatar_hash, '
			. 'created = :created, updated = :updated, new_avatar_asset_hash_id = :new_avatar_asset_hash_id, '
			. 'body_color_set_id = :body_color_set_id, player_avatar_type_id = :player_avatar_type_id, '
			. 'scale_id = :scale_id WHERE id = :id'
		);
		$stmt->execute([
			':id' => $this->id,
			':user_id' => $this->user_id,
			':avatar_hash' => $this->avatar_hash === '' ? null : $this->avatar_hash,
			':created' => $this->created,
			':updated' => $this->updated,
			':new_avatar_asset_hash_id' => $this->new_avatar_asset_hash_id,
			':body_color_set_id' => $this->body_color_set_id,
			':player_avatar_type_id' => $this->player_avatar_type_id,
			':scale_id' => $this->scale_id,
		]);
	}

	public static function get(int $id): ?self
	{
		global $conn;
		$stmt = $conn->prepare('SELECT * FROM user_avatars WHERE id = :id LIMIT 1');
		$stmt->execute([':id' => $id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		return $row ? self::buildFromRow($row) : null;
	}

	public static function getOrCreate(int $userId, ?int $playerAvatarTypeId = null, ?int $scaleId = null): self
	{
		global $conn;
		if ($userId === 0) {
			throw new Exception('Required value not specified: UserID.');
		}

		$stmt = $conn->prepare('SELECT * FROM user_avatars WHERE user_id = :user_id LIMIT 1');
		$stmt->execute([':user_id' => $userId]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row) {
			return self::buildFromRow($row);
		}

		$stmt = $conn->prepare(''
			. 'INSERT INTO user_avatars '
			. '(user_id, avatar_hash, new_avatar_asset_hash_id, player_avatar_type_id, scale_id, created, updated) '
			. 'VALUES (:user_id, :avatar_hash, 0, :player_avatar_type_id, :scale_id, NOW(), NOW()) '
			. 'RETURNING *'
		);
		$stmt->execute([
			':user_id' => $userId,
			':avatar_hash' => '',
			':player_avatar_type_id' => $playerAvatarTypeId,
			':scale_id' => $scaleId,
		]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$row) {
			throw new Exception('Failed to create user avatar.');
		}

		return self::buildFromRow($row);
	}

	public static function getUserAvatarIDs(int $exclusiveStartId, int $count): array
	{
		global $conn;
		if ($exclusiveStartId < 0) {
			throw new Exception('Required value not specified: ExclusiveStartID.');
		}
		if ($count < 1) {
			throw new Exception('Required value not specified: Count.');
		}

		$stmt = $conn->prepare(''
			. 'SELECT id FROM user_avatars WHERE id > :exclusive_start_id '
			. 'ORDER BY id ASC LIMIT :count'
		);
		$stmt->bindValue(':exclusive_start_id', $exclusiveStartId, PDO::PARAM_INT);
		$stmt->bindValue(':count', $count, PDO::PARAM_INT);
		$stmt->execute();

		return array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
	}

	public static function multiGet(array $ids): array
	{
		global $conn;
		if ($ids === []) {
			return [];
		}

		$placeholders = implode(',', array_fill(0, count($ids), '?'));
		$stmt = $conn->prepare("SELECT * FROM user_avatars WHERE id IN ($placeholders)");
		$stmt->execute(array_map('intval', $ids));
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$dals = [];
		foreach ($rows as $row) {
			$dal = self::buildFromRow($row);
			if ($dal !== null) {
				$dals[] = $dal;
			}
		}

		return $dals;
	}
}
