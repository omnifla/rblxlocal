<?php
// rewritten by meditext
// this is the code used from afterworld to generate 3d avatar thumbnails
// i've decided to reutilize the code, except i will clear off some junk here to make it more sustainable.
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
use Roblox\Authentication as Auth;
use Roblox\Thumbs\Avatar;
header('Content-Type: application/json');

$userid = (int)$_GET['userId'];
$output = $avatar->requestThumbnail($id, $width, $height, 'obj');
if($output['url'] === null) {
    http_response_code(404);
    exit("failed to generate avatar thumbnail");
}
exit(json_encode($output));