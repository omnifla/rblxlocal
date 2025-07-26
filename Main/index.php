<?php
// random 2025
// the INDEX... 
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Settings;

$settings = new Settings();

if ($settings->settings['LandingRedirect']) {
    header('Location: /Landing/Animated');
} else {
    header('Location: /Default.aspx');
}
exit;
