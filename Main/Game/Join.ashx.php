<?php
// written by meditext
/*
    SOME IMPORTANT NOTES:
    Add ClientTicket generation under this format:
        5/21/2016 2:23:35 AM;MX60rUfe83aS4vezIQFz7BN3NHHdgST7/U/QuOA44wLh+hBOW3Xe0HJu1PkQuu2S8tL6HDlza234sWLCTBevtAf/Tw66IDKuKLelysn8FJVQnkJILeN5FfGLcHxY94ZE7NQBo4UV0M6ygy3u9nMW5evwWVXd2/JUpGFgGHq+ggw=;jYs7BXPT+YZzUJ0rOA2TnxtOWlg3QpOt3InJk2nizFnobvp1toerlWgRtiu+RLw7ibkz82GHTsMGspfHIbuh8/0YqmjJdtPviaoDjLaRSSdXj8h7XggSW4F2eNI4XTtjJAtVXYsAA9a8C3xh1qXOf4d8Me9hSf//y2Fr3sPhLHk=
    Format: ExpirationTime;Signature 1;Signature 2
    The Signature 1 Format:
        ID
        Name
        CharacterURL
        JobID
        unix Timestamp
    The Signature 2 Format:
        ID
        JobID
        unix Timestamp
    must be hashed using SHA-1 algorithm (and encoded to base64).
    Signature: base64 encoded RSA-SHA1 signature of the Ticket
    The Private key used to sign the ticket is in /config/roblox_private_key.pem
    Add (via the ClientTicket) Authentication support without usage of .ROBLOSECURITY (ONLY DEFINES IT WHEN THE CLIENT TICKET IS VALID!)
    We are going to insert this whole gathered information on Authentication.php, and validate it there.
    
    Add support for fetching PlaceId and UniverseId from the database (based on the JobId, or based on the defined PlaceID, which is going to randomly pick an avaliable server or generated a new one)
    Add support for ChatStyle fetching from the database (Classic, Bubble, etc)
*/
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Game\ClientHelper;
use Roblox\Authentication as Auth;
header('Content-Type: application/json');
// Arguments
$jobId = $_GET['jobid'] ?? $_GET['jobId'] ?? $_GET['jobID'] ?? "Test"; 
$server = $_GET['server'] ?? $_GET['Server'] ?? $_GET['MachineAddress'] ?? "localhost";
$serverPort = $_GET['serverPort'] ?? 53640;
$token = $_GET['token'] ?? null;
$placeId = $_GET['placeId'] ?? 1818; // fetched from DB
$clientPort = $_GET['clientPort'] ?? 0;
// extra
$videoInfo = <<<XML
<?xml version="1.0"?><entry xmlns="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:yt="http://gdata.youtube.com/schemas/2007"><media:group><media:title type="plain"><![CDATA[ROBLOX Place]]></media:title><media:description type="plain"><![CDATA[ For more games visit http://www.roblox.com]]></media:description><media:category scheme="http://gdata.youtube.com/schemas/2007/categories.cat">Games</media:category><media:keywords>ROBLOX, video, free game, online virtual world</media:keywords></media:group></entry>
XML;

// DB entries
$chat_style = "Classic";
$creator_info = [ // placeholder data, should be replaced to use the db
    "id" => 1,
];
// fetch user
$player = Auth::GetAuthenticatedUser();
if($player == null){
    $player = [
        "username" => "Guest ". rand(1,9999),
        "id" => rand(-9999999999, 0),
    ];
}
// format the script into JSON:
$formatedScript = [
    "ClientPort" => (int)$clientPort,
    "MachineAddress" => $server,
    "ServerPort" => (int)$serverPort,
    "PingUrl" => "",
    "PingInterval" => 120,
    "UserName" => $player['username'],
    "UserId" => $player['id'],
    "SuperSafeChat" => false, // should be set to true for under 13 accounts or unauthenticated users.
    "CharacterAppearance" => "http://{$site_properties['hostname']}/Asset/CharacterFetch.ashx?userId={$player['id']}&placeId={$placeId}", // TODO: fetch from db
    "ClientTicket" => "",
    "GameId" => $jobId,
    "PlaceId" => (int)$placeId,
    "MeasurementId" => 0,
    "WaitingForCharacterGuid" => "", // used for determining an unique player GUID.
    "BaseUrl" => "http://{$site_properties['hostname']}/",
    "ChatStyle" => $chat_style,
    "VendorId" => 0, // what is this supposed to be used for?
    "ScreenShotInfo" => "",
    "VideoInfo" => $videoInfo,
    "CreatorId" => (int)$creator_info['id'],
    "CreatorTypeEnum" => "User", // TODO: add support for groups and other types of Creator Enums.
    "MembershipType" => "None",
    "AccountAge" => 0,
    "IsRobloxPlace" => true, // if we want to make teleport work.
    "GenerateTeleportJoin" => false,
    "IsUnknownOrUnder13" => true,
    "SessionId" => "",
    "FollowUserId" => 0,
];
$signed_output = ClientHelper::signTextBlob(json_encode($formatedScript));

exit($signed_output);