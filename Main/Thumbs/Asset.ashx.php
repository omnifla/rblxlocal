<?php
// writen by chloe
$id = $_GET['ID'] ?? '';
$width = $_GET['Width'] ?? '';
$height = $_GET['Height'] ?? '';

$placeholder = '/Images/Placeholder1024x1024.png';
$imagePath = __DIR__ . "/RenderedAssets/$id.png";

// default dimensions used whenever Width/Height aren't valid positive integers
$defaultWidth = 352;
$defaultHeight = 352;

if (!preg_match('/^\d+$/', $width)) {
    $width = $defaultWidth;
}
if (!preg_match('/^\d+$/', $height)) {
    $height = $defaultHeight;
}

if (!preg_match('/^\d+$/', $id) || !file_exists($imagePath)) {
    $src = $placeholder;
} else {
    $src = "/Thumbs/RenderedAssets/$id.png";
}

header('Content-Type: image/png');
readfile($_SERVER['DOCUMENT_ROOT'] . $src);
?>