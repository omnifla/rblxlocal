<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

if(Roblox\Authentication::GetAuthenticatedUser()){
    header("Location: /Home");
    exit;
}
header("Location: /Landing/Animated");
exit;
?>
<!DOCTYPE html>
<html lang="en">
<p>This page was intentionally left empty.</p>
<?php
print_r(Roblox\Authentication::GetAuthenticatedUser());