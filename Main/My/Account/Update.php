<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth; 
use Roblox\TextFilter\BasicTextFilter;
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
$PersonalBlurb = $_POST['PersonalBlurb'] !== "Describe yourself here" ? trim($_POST['PersonalBlurb']) : "";
$filter = new BasicTextFilter();
$filteredBlurb = $filter->filter($PersonalBlurb)->getFilteredText();
$update_stmt = $conn->prepare("UPDATE users SET description = :blurb, gender = :gender, updated = NOW() WHERE id = :id");
$update_stmt->execute([
    ':blurb' => mb_substr((string)$filteredBlurb, 0, 255, 'UTF-8'),
    ':gender' => $gender,
    ':id' => $authenticatedUser['id']
]);
header("Location: /My/Account.aspx");