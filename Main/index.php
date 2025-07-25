<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

if (Roblox\Authentication::GetAuthenticatedUser()) {
    header("Location: /Home");
    exit;
}
header("Location: /Landing/Animated");
exit;
?>
<!DOCTYPE html>
<html lang="en">

<head></head>

<body>
    <p>This page was intentionally left empty.</p>
    <h2>Your Probably looking for Landing/animated.php, Wait how did you get here?</h2>
</body>

</html>

<?php
print_r(Roblox\Authentication::GetAuthenticatedUser());
?>
