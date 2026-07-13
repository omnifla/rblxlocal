<?php
// writen by chloe
$id = $_GET['ID'] ?? '';
$width = $_GET['Width'] ?? '';
$height = $_GET['Height'] ?? '';

$placeholder = '/Images/Placeholder1024x1024.png';
$imagePath = __DIR__ . "/RenderedAssets/$id.png";

if (!preg_match('/^\d+$/', $id) || !preg_match('/^\d+$/', $width) || !preg_match('/^\d+$/', $height)) {
    $src = $placeholder;
    $width = 352;
    $height = 352;
} elseif (file_exists($imagePath)) {
    $src = "/Thumbs/RenderedAssets/$id.png";
} else {
    $src = $placeholder;
    $width = 352;
    $height = 352;
}

header('Content-Type: image/png');
readfile($_SERVER['DOCUMENT_ROOT'] . $src);
?>
