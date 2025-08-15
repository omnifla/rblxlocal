<?php
// written by meditext
// This is going to move most of the stuff present into the Authentication, Anything else used in is going to be deprecated and re-routed.
namespace Roblox;

use Roblox\DataAccess\UserDAL;

class User {
    private $dal;

    public function __construct(UserDAL $dal) {
        $this->dal = $dal;
    }

    public static function get($id) {
        $dal = UserDAL::get($id);
        return $dal ? new self($dal) : null;
    }

    public static function getByAccountID($accountId) {
        $dal = UserDAL::getByAccountID($accountId);
        return $dal ? new self($dal) : null;
    }

    public static function multiGet(array $ids) {
        $dals = UserDAL::multiGet($ids);
        return array_map(fn($dal) => new self($dal), $dals);
    }

    public function getID() {
        return $this->dal->id;
    }

    public function getName() {
        global $conn;
        $stmt = $conn->prepare("SELECT username FROM users WHERE id = :id");
        $stmt->execute(['id' => $this->dal->id]);
        return $stmt->fetchColumn();
    }

    public function getCreated() {
        return $this->dal->created;
    }

    public function setBirthdate($date) {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET birthdate = :bd WHERE id = :id");
        $stmt->execute(['bd' => $date, 'id' => $this->dal->id]);
        $this->dal->birth_date = $date;
    }

    public function setGender($gender) {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET gender = :g WHERE id = :id");
        $stmt->execute(['g' => $gender, 'id' => $this->dal->id]);
        $this->dal->gender_type_id = $gender;
    }
    
    // all of this is stubbed until we implement the full Roblox\Economy feature.
    public function isAnyBuildersClubMember() { return false; }
    public function isBuildersClubMember() { return false; }
    public function isTurboBuildersClubMember() { return false; }
    public function isOutrageousBuildersClubMember() { return false; }
    public function isExBuildersClubMember() { return false; }
    public function getExBuildersClubMembership() { return null; }
    public function getCurrentOrFormerBuildersClubStipend() { return 0; }

    // stub until i implement role system.
    public function testIsSuperAdministrator() { return false; }
    public function testIsCustomerService() { return false; }
    public function testIsModerator() { return false; }
    public function testIsSuperModerator() { return false; }
    public function testIsTrustedContributor() { return false; }
    public function testIsSoothsayer() { return false; }
    public function testIsContentCreator() { return false; }
    public function testIsDeveloper() { return false; }
    public function testIsRegularUser() { return true; }
    public function testIsCommunityManager() { return false; }
    public function testIsEconomyManager() { return false; }
    public function testIsMarketing() { return false; }
    public function testIsMarketingManager() { return false; }
    public function testIsAdOps() { return false; }
    public function testIsAdOpsManager() { return false; }
    public function testIsModeratorManager() { return false; }
    public function testIsCommunityRepresentative() { return false; }
    public function testIsBursar() { return false; }
    public function testIsFinance() { return false; }
    public function testIsBetaTester() { return false; }
    public function testIsProtectedUser() { return false; }
    public function testIsReleaseEngineer() { return false; }
    public function testIsViewer() { return false; }
    public function testIsCommunityChampion() { return false; }
    public function testIsDevRelManager() { return false; }
    public function testIsDataAdministrator() { return false; }
    public function testIsEventStreamCreator() { return false; }
    public function testIsTranslationManager() { return false; }
    public function testIsTranslationContributor() { return false; }
    public function testIsPIIManager() { return false; }
    public function testIsIT() { return false; }
    public function testIsCSAgentAdmin() { return false; }
    public function testIsFastTrackMember() { return false; }
    public function testIsFastTrackModerator() { return false; }
    public function testIsFastTrackAdmin() { return false; }
    public function testIsItemManager() { return false; }
    public function testIsChinaLicenseUser() { return false; }
    public function testIsCatalogItemCreator() { return false; }
    public function testIsRccReleaseTesterManager() { return false; }

    public function equals(User $other) {
        return $this->getID() === $other->getID();
    }
}

