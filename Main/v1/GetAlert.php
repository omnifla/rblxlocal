<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Alert;
$alerts = \Roblox\Alert::getMostRecentAlertsPaged(0, 3);
if (empty($alerts)) return;
foreach ($alerts as $alert) {
    $text = htmlspecialchars($alert->getText());
    echo <<<HTML
    <div class="SystemAlert" style="background-color: orange;"><div class="SystemAlertText">{$text}</div></div>
    HTML;
}
?>
