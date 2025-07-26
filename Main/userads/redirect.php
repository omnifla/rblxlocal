<?php
// writen by chloe
if (!isset($_GET['data'])) {
    header("Location: /RobloxDefaultErrorPage.aspx?code=404");
    exit();
}

$data = $_GET['data'];
$url = base64_decode($data, true);

if ($url === false || strpos($url, "\0") !== false) {
    header("Location: /RobloxDefaultErrorPage.aspx?code=404");
    exit();
}

if (strpos($url, '/') !== 0) {
    header("Location: /RobloxDefaultErrorPage.aspx?code=404");
    exit();
}

header("Location: " . $url);
exit();
?>
