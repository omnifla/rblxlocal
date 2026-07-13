<?php
// random 2025
// the INDEX... 
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_data = [
        "username" => $_POST['userName'] ?? $_POST['username'] ?? '',
        "password" => $_POST['password'] == $_POST['passwordConfirm'] ? $_POST["password"] : false,
        "gender" => $_POST['gender'] == "Male" ? 1 : 2,
        "birthdate" => $_POST["lstYears"]."-".$_POST["lstMonths"]."-".$_POST["lstDays"],
    ];
    if ($form_data["password"] == false) {
        echo json_encode([
            "success" => false,
            "message" => "Passwords do not match."
        ]);
        exit;
    }
    try {
        Auth::Register($form_data["username"], $form_data["password"], $form_data['gender'], null, $form_data["birthdate"]);
    } catch(\InvalidArgumentException $e) {
        echo json_encode([
            "success" => false,
            "message" => $e->getMessage()
        ]);
        exit;
    }
}
$returnUrl = $_GET['ReturnUrl'] ?? '/Home/';

if(Auth::GetAuthenticatedUser()){
    header("Location: " . urldecode($returnUrl));
    exit;
}
header("location: /");
exit;
?>