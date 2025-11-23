<?php
// ported by meditext
namespace Roblox;
use Roblox\DataAccess;
use Exception;
use DateTime;

class UserStatus
{
    private UserStatusDAL $_EntityDAL;

    public static array $EntityCacheInfo = [
        'collectionCacheable' => false,
        'countCacheable'      => false,
        'entityCacheable'     => true,
        'idLookupCacheable'   => true,
        'hasUnqualifiedCollections' => false,
        'name'                => 'UserStatus',
        'isNullCacheable'     => true
    ];

    public function __construct(?UserStatusDAL $dal = null)
    {
        if ($dal) {
            $this->_EntityDAL = $dal;
        } else {
            $this->_EntityDAL = new UserStatusDAL();
        }
    }

    public function getID(): int
    {
        return $this->_EntityDAL->ID;
    }

    public function getUserID(): int
    {
        return $this->_EntityDAL->UserID;
    }

    public function setUserID(int $userId): void
    {
        $this->_EntityDAL->UserID = $userId;
    }

    public function getMessage(): string
    {
        return $this->_EntityDAL->Message;
    }

    public function setMessage(string $msg): void
    {
        $this->_EntityDAL->Message = $msg;
    }

    public function getCreated(): string
    {
        return $this->_EntityDAL->Created;
    }

    public function getUpdated(): string
    {
        return $this->_EntityDAL->Updated;
    }

    public function save(): void
    {
        if ($this->getID() === 0) {
            $this->_EntityDAL->Created = date('Y-m-d H:i:s');
            $this->_EntityDAL->Updated = $this->_EntityDAL->Created;
            $this->_EntityDAL->insert();
        } else {
            $this->_EntityDAL->Updated = date('Y-m-d H:i:s');
            $this->_EntityDAL->update();
        }
    }

    private static function doGetOrCreate(int $userId): UserStatus
    {
        $dal = UserStatusDAL::getOrCreate($userId);
        return new UserStatus($dal);
    }

    public static function get(int $id): ?UserStatus
    {
        $dal = UserStatusDAL::get($id);
        return $dal ? new UserStatus($dal) : null;
    }

    public static function getNullable(?int $id): ?UserStatus
    {
        return $id !== null ? self::get($id) : null;
    }

    public static function getOrCreate(int $userId): UserStatus
    {
        $existing = self::getByUserID($userId);
        if ($existing) {
            return $existing;
        }
        return self::doGetOrCreate($userId);
    }

    public static function getByUserID(int $userId): ?UserStatus
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_statuses WHERE userid = :uid LIMIT 1");
        $stmt->bindValue(':uid', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            return new UserStatus(UserStatusDAL::buildDAL($row));
        }
        return null;
    }

    public function construct(UserStatusDAL $dal): void
    {
        $this->_EntityDAL = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        if ($this->_EntityDAL) {
            return ["UserID:" . $this->getUserID()];
        }
        return [];
    }

    public function equals(UserStatus $other): bool
    {
        return $this->getID() === $other->getID();
    }

    public function getSerializable(): UserStatusDAL
    {
        return $this->_EntityDAL;
    }
}
