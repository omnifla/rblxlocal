<?php
header('Content-Type: application/json');
$domain = $_SERVER['HTTP_HOST'];
$domain_parts = explode('.', $domain);

if (count($domain_parts) == 2) {
    array_unshift($domain_parts, "tr");
}
else {
    $domain_parts[0] = "tr";
}

$base_domain = implode('.', $domain_parts);
$hash = $_GET['md5'] ?? "";
echo json_encode(["Url" => "https://" . $base_domain . "/" . $hash]);
