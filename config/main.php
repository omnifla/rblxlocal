<?php 
// written by meditext 
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
// load dotenv
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();
// autoload all classes from /Depedencies
spl_autoload_register(function ($class) {
    $prefix = 'Roblox\\';
    $base_dir = __DIR__ . '/Depedencies/';

    // $len = strlen($prefix);
    // if (strncmp($prefix, $class, $len) !== 0) {
    //     return;
    // }
    $relative_class = $class; //substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) { 
        require $file;
    } else {
        throw new \Exception("File not found: $file");
    }
});
// database connection
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$port = $_ENV['DB_PORT'];
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
$properties = Roblox\Settings::settings;
