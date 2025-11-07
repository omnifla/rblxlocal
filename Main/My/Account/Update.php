<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth; 
use Roblox\TextFilter\BasicTextFilter;
$languages_offset = [
    1 => "en", // English
    2 => "pt", // Portuguese
    3 => "de", // German
    4 => "es", // Spanish
    5 => "cr", // Croatian
    6 => "sb", // Serbian
    7 => "fr", // french
    8 => "it", // italian
    9 => "du", // dutch
    10 => "ru", // russian
];
if(!Auth::GetAuthenticatedUser()) {
    header("Location: /newlogin");
    exit;
}
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}
$authenticatedUser = Auth::GetAuthenticatedUserInfo();
$gender = $_POST['Gender'] - 1;
$languageId = (int)$_POST['LanguageId'];
$PersonalBlurb = $_POST['PersonalBlurb'] !== "Describe yourself here" ? trim($_POST['PersonalBlurb']) : null;
$filter = new BasicTextFilter();
$filteredBlurb = $filter->filter($PersonalBlurb)->getFilteredText();
$update_stmt = $conn->prepare("UPDATE users SET description = :blurb, gender = :gender, language = :lang, updated = NOW() WHERE id = :id");
$update_stmt->execute([
    ':blurb' => mb_substr((string)$filteredBlurb, 0, 255, 'UTF-8'),
    ':gender' => $gender,
    ':id' => $authenticatedUser['id'],
    ':lang' => array_key_exists($languageId, $languages_offset) ? $languages_offset[$languageId] : 'en',
]);
header("Location: /My/Account.aspx");