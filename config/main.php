<?php
// written by meditext
// optimized by random
declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

// autoloader for Roblox\
spl_autoload_register(function ($class) {
    if (class_exists($class, false) || interface_exists($class, false)) return;

    // Roblox namespace
    if (strpos($class, 'Roblox\\') === 0) {
        $base_dir = __DIR__ . '/Depedencies/';
        $file = $base_dir . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) require $file;
    }
    // UserControls namespace
    elseif (strpos($class, 'UserControls\\') === 0) {
        $base_dir = __DIR__ . '/../UserControls/';
        $relative = str_replace('UserControls\\', '', $class);
        $file = $base_dir . str_replace('\\', '/', $relative) . '.php';
        if (file_exists($file)) require $file;
    }
});
// important stuff:
require_once __DIR__ . '/Depedencies/IncludeHelper.php';
require_once __DIR__ . '/Depedencies/PrivateLogger.php';

// load .env and other stuff
use Dotenv\Dotenv;
use Roblox\Settings;
use Roblox\Game\ClientScriptCreator;
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$settingsInstance = new Settings();
$properties = $settingsInstance->settings;
$site_properties = [
    "Title" => "ROBLOX",
    "meta-Author" => "ROBLOX Corporation",
    "meta-Description" => "User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world.",
    "meta-Keywords" => "free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine",
    "hostname" => $_SERVER['SERVER_NAME'], // CAN YOU ALL STOP PUTTING AFTWLD.XYZ EVERYWHERE?
    "baseUrl" => "https://" . $_SERVER['SERVER_NAME'], // maybe we should discontinue this
];
// we will use the landing page here
$accepted = $_COOKIE['AgreedToSafetyFilters'] ?? null;
if ($accepted !== "true"
 && !str_contains($_SERVER['REQUEST_URI'], '/Main/Landing/Home.php') 
 && !str_contains(strtolower($_SERVER['REQUEST_URI']), '/game/') 
 && !str_contains($_SERVER['REQUEST_URI'], '/mobileapi/')
 && !str_contains(strtolower($_SERVER['REQUEST_URI']), '/asset')
 && !str_contains($_SERVER['REQUEST_URI'], '/Setting')
 && !str_contains($_SERVER['SERVER_NAME'], "api")) {
    header("Location: /Landing/Home.php");
    exit;
}
ClientScriptCreator::init();

// db connect. I'm sorry..
$host = $_ENV['DB_HOST'];  
$dbname = $_ENV['DB_NAME'];  
$user = $_ENV['DB_USER'];  
$password = $_ENV['DB_PASS'];  
$port = $_ENV['DB_PORT'];  

try {  
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
}
catch(PDOException $e) {  
    exit("Connection failed for the ROBLOX Database: " . $e->getMessage());  
}

// remove maintenance stuff cuz it dosen't work
