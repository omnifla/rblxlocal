<?php
// written by meditext
// optimized by random
declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

// autoloader for Roblox\
spl_autoload_register(function ($class) {
    if (class_exists($class, false) || interface_exists($class, false)) return;

    $base_dir = __DIR__ . '/Depedencies/';
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

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
    "hostname" => $_SERVER['HTTP_HOST'],
    "baseUrl" => "https://" . $_SERVER['HTTP_HOST'],
];
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

// we should make a middleware system for this
// aka, A FUCKING FRAMEWORK
if ($properties['SiteMaintenanceMode'] ?? false) {
    $bypassCookie = $_COOKIE['MaintenanceBypass'] ?? null;
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $whitelistedIPs = ['10.0.0.1'];
    $excludedPaths = ['/Login/FulfillConstraint.aspx'];
    $excluded = false;
    foreach ($excludedPaths as $path) {
        if (str_starts_with($currentPath, $path)) {
            $excluded = true;
            break;
        }
    }
    
    $clientIP = $_SERVER['REMOTE_ADDR'];
    if ($bypassCookie !== 'true' && !$excluded && !in_array($clientIP, $whitelistedIPs, true)) {
        header('Location: /Login/FulfillConstraint.aspx');
        exit;
    }
}

