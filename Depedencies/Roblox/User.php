<?php
// written by meditext
// This is going to move most of the stuff present into the Authentication, Anything else used in is going to be deprecated and re-routed.
namespace Roblox;

use Roblox\DataAccess\UserDAL;
use Roblox\Caching\CacheInfo;
use Roblox\Caching\CacheabilitySettings;
use Roblox\Economy\Badge;
use Roblox\Message;
use Exception;

class User
{
    private UserDAL $dal;

    public static CacheInfo $EntityCacheInfo;

    public function __construct(?UserDAL $dal = null)
    {
        $this->dal = $dal ?? new UserDAL();
    }

    public static function get(int|string|null $id): ?self
    {
        if (is_string($id)) {
            return self::getByName($id);
        }
        if ($id === null || $id <= 0) {
            return null;
        }

        $dal = UserDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function MustGet(int $id): User
    {
        $user = self::Get($id);
        if ($user === null)
            throw new Exception("User $id not found");
        return $user;
    }

    public static function getByAccountID($accountId)
    {
        $dal = UserDAL::getByAccountID($accountId);
        return $dal ? new self($dal) : null;
    }

    public static function getByName(string $name): ?self
    {
        global $conn;
        $name = trim($name);
        if ($name === '') {
            return null;
        }

        $stmt = $conn->prepare('SELECT id FROM users WHERE LOWER(username) = LOWER(:username) LIMIT 1');
        $stmt->execute([':username' => $name]);
        $id = $stmt->fetchColumn();
        return $id === false ? null : self::get((int) $id);
    }

    public static function multiGet(array $ids)
    {
        $dals = UserDAL::multiGet($ids);
        return array_map(fn($dal) => new self($dal), $dals);
    }

    public function getID()
    {
        return $this->dal->id;
    }

    public function getAccountID(): int
    {
        return $this->dal->account_id;
    }

    public function getAgeBracket(): int
    {
        return $this->dal->age_bracket;
    }

    public function getUseSuperSafeConversationMode(): bool
    {
        return (bool) $this->dal->use_super_safe_conversation_mode;
    }

    public function getUseSuperSafePrivacyMode(): bool
    {
        return (bool) $this->dal->use_super_safe_privacy_mode;
    }

    public function getAssociatedEntityID(): ?int
    {
        return $this->dal->associated_entity_id !== null
            ? (int) $this->dal->associated_entity_id
            : null;
    }

    public function getCreatorType(): int
    {
        return (int) $this->dal->associated_entity_type_id;
    }

    public function getName()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT username FROM users WHERE id = :id");
        $stmt->execute(['id' => $this->dal->id]);
        return $stmt->fetchColumn();
    }

    public function getCreated()
    {
        return $this->dal->created;
    }

    public function getBirthDate(): ?string
    {
        return $this->dal->birth_date;
    }

    public function getGenderTypeId(): ?int
    {
        return $this->dal->gender_type_id !== null ? (int) $this->dal->gender_type_id : null;
    }

    public function getUpdated(): ?string
    {
        return $this->dal->updated;
    }

    public function getBadges(): array
    {
        return Badge::GetUserBadgesByUserID($this->getID());
    }

    public function getTotalNumberOfMessages(): int
    {
        return Message::getTotalNumberOfMessages($this->getID());
    }

    public function getTotalNumberOfUnreadMessages(): int
    {
        return Message::getTotalNumberOfUnreadUnarchivedMessages($this->getID());
    }

    public function setBirthdate($date)
    {
        global $conn;
        if ($date instanceof \DateTimeInterface) {
            $date = $date->format('Y-m-d');
        }
        $stmt = $conn->prepare("UPDATE users SET birthdate = :bd WHERE id = :id");
        $stmt->execute(['bd' => $date, 'id' => $this->dal->id]);
        $this->dal->birth_date = $date;
        $this->dal->updated = date('Y-m-d H:i:s');
    }

    public function setGender($gender)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET gender = :g WHERE id = :id");
        $stmt->execute(['g' => $gender, 'id' => $this->dal->id]);
        $this->dal->gender_type_id = $gender;
        $this->dal->updated = date('Y-m-d H:i:s');
    }

    public function getCacheInfo(): CacheInfo
    {
        return self::$EntityCacheInfo;
    }

    public function isNullCacheable(): bool
    {
        return true;
    }

    public function getSerializable(): UserDAL
    {
        return $this->dal;
    }

    public function construct(UserDAL $dal): void
    {
        $this->dal = $dal;
    }

    public function buildEntityIDLookups(): array
    {
        return ['AccountID:' . $this->getAccountID()];
    }

    public function buildStateTokenCollection(): array
    {
        return [];
    }

    public function getIdentifier(): string
    {
        return (string) $this->getID();
    }

    public function getAgentID(): int
    {
        return $this->getID();
    }

    // all of this is stubbed until we implement the full Roblox\Economy feature.
    public function isAnyBuildersClubMember()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT membership_type FROM users WHERE id = :id");
        $stmt->execute(['id' => $this->dal->id]);
        return (int) $stmt->fetchColumn() > 0;
    }
    public function isBuildersClubMember()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT membership_type FROM users WHERE id = :id");
        $stmt->execute(['id' => $this->dal->id]);
        return (int) $stmt->fetchColumn() === 1;
    }
    public function isTurboBuildersClubMember()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT membership_type FROM users WHERE id = :id");
        $stmt->execute(['id' => $this->dal->id]);
        return (int) $stmt->fetchColumn() === 2;
    }
    public function isOutrageousBuildersClubMember()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT membership_type FROM users WHERE id = :id");
        $stmt->execute(['id' => $this->dal->id]);
        return (int) $stmt->fetchColumn() === 3;
    }
    public function isExBuildersClubMember()
    {
        return false;
    }
    public function getExBuildersClubMembership()
    {
        return null;
    }
    public function getCurrentOrFormerBuildersClubStipend()
    {
        return 0;
    }

    // stub until i implement role system.
    public function testIsSuperAdministrator()
    {
        return false;
    }
    public function testIsCustomerService()
    {
        return false;
    }
    public function testIsModerator()
    {
        return false;
    }
    public function testIsSuperModerator()
    {
        return false;
    }
    public function testIsTrustedContributor()
    {
        return false;
    }
    public function testIsSoothsayer()
    {
        return false;
    }
    public function testIsContentCreator()
    {
        return false;
    }
    public function testIsDeveloper()
    {
        return false;
    }
    public function testIsRegularUser()
    {
        return true;
    }
    public function testIsCommunityManager()
    {
        return false;
    }
    public function testIsEconomyManager()
    {
        return false;
    }
    public function testIsMarketing()
    {
        return false;
    }
    public function testIsMarketingManager()
    {
        return false;
    }
    public function testIsAdOps()
    {
        return false;
    }
    public function testIsAdOpsManager()
    {
        return false;
    }
    public function testIsModeratorManager()
    {
        return false;
    }
    public function testIsCommunityRepresentative()
    {
        return false;
    }
    public function testIsBursar()
    {
        return false;
    }
    public function testIsFinance()
    {
        return false;
    }
    public function testIsBetaTester()
    {
        return false;
    }
    public function testIsProtectedUser()
    {
        return false;
    }
    public function testIsReleaseEngineer()
    {
        return false;
    }
    public function testIsViewer()
    {
        return false;
    }
    public function testIsCommunityChampion()
    {
        return false;
    }
    public function testIsDevRelManager()
    {
        return false;
    }
    public function testIsDataAdministrator()
    {
        return false;
    }
    public function testIsEventStreamCreator()
    {
        return false;
    }
    public function testIsTranslationManager()
    {
        return false;
    }
    public function testIsTranslationContributor()
    {
        return false;
    }
    public function testIsPIIManager()
    {
        return false;
    }
    public function testIsIT()
    {
        return false;
    }
    public function testIsCSAgentAdmin()
    {
        return false;
    }
    public function testIsFastTrackMember()
    {
        return false;
    }
    public function testIsFastTrackModerator()
    {
        return false;
    }
    public function testIsFastTrackAdmin()
    {
        return false;
    }
    public function testIsItemManager()
    {
        return false;
    }
    public function testIsChinaLicenseUser()
    {
        return false;
    }
    public function testIsCatalogItemCreator()
    {
        return false;
    }
    public function testIsRccReleaseTesterManager()
    {
        return false;
    }

    public function equals(?User $other): bool
    {
        return $other !== null && $this->getID() === $other->getID();
    }
}

User::$EntityCacheInfo = new CacheInfo(
    new CacheabilitySettings(
        collectionsAreCacheable: true,
        countsAreCacheable: true,
        entityIsCacheable: true,
        idLookupsAreCacheable: true
    ),
    'User',
    isNullCacheable: true
);

