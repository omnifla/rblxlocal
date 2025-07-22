<?php
// yeah im NOT adding 
// written by meditext 
// database connection
$host = 'localhost';
$dbname = 'roblox';
$user = 'postgres';
$password = 'ROOTPSWRPRJ-AFW1241'; // TODO: make it environment variable
$port = 5432;
try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  exit("Connection failed for the ROBLOX Database: " . $e->getMessage());
}
$site_properties = [
  "Title" => "ROBLOX",
  "meta-Author" => "ROBLOX Corporation",
  "meta-Description" => "User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine.",
  "meta-Keywords" => "free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine",
  "hostname" => $_SERVER['HTTP_HOST'],
  "baseUrl" => "https://" . $_SERVER['HTTP_HOST'],
];

// global variables ripped from the Settings.cs in the Roblox Source code.
$properties = [
  "MaxFileSize" => 50000000,
  "UserGroupJoinLimit" => 5,
  "CostToCreateGroupInRobux" => 100,
  "BCUserGroupJoinLimit" => 10,
  "FacebookEnabled" => false, // i will let this disabled since i dont have any plans to implement it.
  "BCOnlyGroupBuilding" => true,
  "GroupBuildingEnabled" => false,
  "InviteKeyEnabled" => false, // not from the roblox source code.
  "BCReferralRewardinRobux" => 50,
  "BuildToolAssetList" => [], // TODO: find the BuildToolAssetList from the Roblox Source code
  "BuildingWithFriendsStartingEnvironmentAssetIDs" => [],
  "TBCUserGroupJoinLimit" => 20,
  "TBCtoBCDurationConversionFactor" => 2,
  "BCReferralRewardsEnabled" => true,
  "FriendReferralRewardsEnabled" => true,
  "PercentEmailRequired" => 50,
  "BCReferralRewardDescription" => "Yay", // WHAT THE HECK ROBLOX???
  "MaximumNumberOfGroupRoleSets" => 10,
  "CostToCreateRoleSetInRobux" => 100,
  "BuildInstanceInfoOnGroupPage" => true,
  "OBCUserGroupJoinLimit" => 100,
  "OBCtoTBCDurationConversionFactor" => 1.5,
  "OBCtoBCDurationConversionFactor" => 3,
  "UploadedPlaceParsingFrequency" => 100,
  "ScriptAuthorsAreTentative" => true,
  "IsBubbleChatEnabled" => false,
  "MaximumNumberOfItemsPerAssetSet" => 100,
  "MaximumNumberOfAssetSetsPerOwner" => 10,
  "ParseScriptsFromReportedPlacesOn" => true,
  "ROBLOXP2PAutoOfferThreshold" => 0.1,
  "GameGenresListEnabled" => true,
  "ExpirationWindowInDays" => 3,
  "CommentPostingIntervalInSeconds" => 15, // likewise i will try to make a ratelimter for all properties that inherits interval.
  "GameGenreSEOenabled" => true,
  "RobloxSets" => [], // Database will be used to store RobloxSets,
  "GameGenreSEOIconPathEditingEnabled" => false, // what's this supposed to do?
  "CommentPostingFloodCheckingOn" => false, // i will make it enabled by default once i finish the ratelimiter.
  "SetsEnabled" => false,
  "MinAssetHashSafetyRatingToDisplay" => 0.5,
  "AssetHashSafetyDefaultRating" => 0.5,
  "AssetHashSafetyRatingRecalculationIntervalInTicks" => 864000000000,
  "MaximumNumberOfAssetSetSubscriptions" => 10,
  "InteractionTrackingIsEnabled" => False,
  "CommentsPostingEnabled" => true,
  "CommentsResultsPerPage" => 10,
  "TemporaryStoreDirectory" => "/content",
  "AssetOwnershipCountThreshold" => 100000,
  "UseUnreadMessagesCounter" => false,
  "UnreadMessagesCounterVerificationPercentage" => 0,
  "SignScriptsOnFetch" => false, // focused for /Game/ apis and /Asset/?id= when fetching asset type Lua.
  "CommentsCounterVerificationPercentage" => 0,
  "UseCommentsCounter" => false,
  "CLSID32Bit" => "76D50904-6780-4c8b-8986-1A7EE0B1716D", // what am i going to do with this CLSID?
  "DefaultFollowPrivacySetting" => 0,
  "AsyncGoogleOn" => false,
  "GlobalCommentaryIsEnabled" => true,
  "LoginFloodCheckLimitPerHour" => 25,
  "BCOnlyPlacesEnabled" => true,
  "ShowAllAdsWithGAM" => false,
  "RobuxStipendBonusMaxMultiplier" => 3,
  "RobuxStipendBonusMaxDays" => 760,
  "BCExpireNagScreenOff" => false,
  "FacebookLikeOff" => true, // disabled by default.
  "FacebookNewApplicationID" => "0", // Why roblox put their application id inside of the original code?
  "FacebookNewApplicationSeceret" => "", // dear developers, please do not put your application secret inside of the code.
  "FacebookNewAPIKey" => "", // WHY DID YOU GUYS PUT YOUR API KEY INSIDE OF THE SETTINGS CODE?
  "AlliesEnemiesEnabled" => false, // groupwise
  "BoyGuestCharacterID" => 1, // ROBLOX userid account for loading the CharacterAppearance
  "GirlGuestCharacterID" => 1,
  "DefaultGuestCharacterID" => 1,
  "IsTestingSite" => false,
  "AttachChildAccountFloodCheckLimitPerDay" => 5,
  "AttachChildAccountFloodCheckTimeLimit" => 5,
  "GiftCardEmailDeliveryEnabled" => false,
  "NewsletterUnsubscribeFloodCheckLimit" => 3,
  "NewsletterUnsubscribeFloodCheckExpiryHours" => 12,
  "UnsubscribeNewsletterKey" => "", // AGAIN ROBLOX, DO NOT PUT YOUR KEYS INSIDE OF THE CODE.
  "JavaScriptS3Bucket" => "", // empty by default.
  "CssS3Bucket" => "",
  "ImagesS3Bucket" => "",
  "AccountCreationFloodCheckTimeLimitInHours" => 1,
  "AccountCreationFloodCheckLimit" => 2,
  "JavaScriptGZipS3Bucket" => "",
  "CssGZipS3Bucket" => "",
  "RobuxStipendBonusTerminationDate" => "", // unix format i dont know
  "AssetSaleCommissionRate" => 0.1,
  "RobloxBadges" => [], // Database will be used to store RobloxBadges
  "EnableItemHolds" => false,
  "HoldEnabledAssetTypes" => [], // unsure what to do
  "MinHoldPriceInRobux" => 1000,
  "MinHoldPriceInTickets" => 5000,
  "AffiliateSalesEnabled" => false,
  "PresenceCacheDuration" => 5 * 60,
  "FloodcheckPerHourUserAssetScrubLimit" => 100,
  "RegisterVisitorAbsence" => false,
  "ExpiredBCActiveSlots" => 5,
  "ExpiredBCActiveSlotsEnabled" => false,
  "GameSearchAndBanEnabled" => false,
  "DefaultUnder13MessagePrivacySetting" => 2,
  "AssetSaleCommissionRateNonBC" => 0.9,
  "AudioAssetUploadEnabled" => true,
  "IOSCatalogItemsCSV" => "",
  "UnreadMessagesCounterAutoSyncThreshold" => 0,
  "AssetEndorsementsEnabled" => false,
  "NotifyEndorsedAssetCreators" => false,
  "EndorsementRewardInRobux" => 0,
  "AccountAddOnActivationLeaseDurationInMilliseconds" => 30000,
  "UserAssetShimClientApiKey" => "",
  "LogSource" => "Roblox",
  "LogLevel" => "Information",
  "IsAssetOptionRemoteCached" => false,
  "IsIncreasedActiveUniverseLimitEnabled" => false,
  "MaxActiveUniversesCount" => 200,
  "MaxActiveUniversesCountForGroups" => 100,
  "BCUserGroupCreateLimit" => 10,
  "OBCUserGroupCreateLimit" => 100,
  "TBCUserGroupCreateLimit" => 20,
  "UserGroupCreateLimit" => 5,
  "DatabaseMaxUsernameLength" => 64, // Roblox's max username length is 20, but the database allows 64.
  "SiteMaintenaceMode" => false,
];
// load composer vendor autoload
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
// autoload all classes from /Depedencies
spl_autoload_register(function ($class) {
    $prefix = 'Roblox\\';
    $base_dir = __DIR__ . '/Depedencies/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) { 
        require $file;
    } else {
        throw new \Exception("File not found: $file");
    }
});
