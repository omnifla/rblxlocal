<?php
// written by meditext
// I literally did this on my phone bruh

namespace Roblox;

class Settings {
    public array $settings = [
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
        // "AccountCreationFloodCheckTimeLimitInHours" => 1,
        "AccountCreationFloodCheckTimeInMinutes" => 5, // recommended, LimitInHours is deprecated.
        "AccountCreationFloodCheckLimit" => 10, // original value: 2
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
        "IsAssetOptionRemoteCached" => true,
        "IsIncreasedActiveUniverseLimitEnabled" => false,
        "MaxActiveUniversesCount" => 200,
        "MaxActiveUniversesCountForGroups" => 100,
        "BCUserGroupCreateLimit" => 10,
        "OBCUserGroupCreateLimit" => 100,
        "TBCUserGroupCreateLimit" => 20,
        "UserGroupCreateLimit" => 5,
        "DatabaseMaxUsernameLength" => 64, // Roblox's max username length is 20, but the database allows 64.
        "SiteMaintenaceMode" => true,
        "LandingRedirect" => true, // Default.aspx to Landing/Animated.
        // added those here as i found more eventually in the other scripts
        "DefaultBoyAssets" => [],
        "DefaultGirlAssets" => [],
        "VerifiedUserHatAssetId" => 0, // change this once we publish the verified hat.
        "DefaultEnvironments" => [],
        "DefaultShirts" => [],
        "DefaultPants" => [],
        "DefaultHeads" => [],
    ];
    public function get(string $key): mixed {
        return $this->settings[$key] ?? null;
    }
}
