<?php
// ported by meditext
// port of the json password algorithm from roblox
/*
header('Content-Type: application/json');
$status = false;
$password = $_GET['password'] ?? '';
$message = '';
function passwordTooLong($n) {
    return strlen($n) > 20;
}
function passwordTooShort($n) {
    return strlen($n) < 6;
}
function passwordEnoughLetters($n) {
    $i = 0;
    if ($n == null || $n == "")
        return 0;
    for ($t = 0; $t < strlen($n); $t++) {
        if (preg_match('/[A-Za-z]/', $n[$t])) {
            $i += 1;
        }
    }
    return $i > 3;
}
function passwordEnoughNumbers($n) {
    $i = 0;
    if ($n == null || $n == "")
        return 0;
    for ($t = 0; $t < strlen($n); $t++) {
        if (preg_match('/[0-9]/', $n[$t])) {
            $i += 1;
        }
    }
    return $i > 1;
}
function passwordContainsSpaces($n) {
    $i = 0;
    if ($n == null || $n == "")
        return 0;
    for ($t = 0; $t < strlen($n); $t++) {
        if (preg_match('/\s/', $n[$t])) {
            $i += 1;
        }
    }
    return $i > 0;
}
function weakPassword($n) {
    $n = strtolower($n);
    if (strpos($n, "asdf") !== false) {
        return true;
    } elseif (strpos($n, "pass") !== false || strpos($n, "qwer") !== false || strpos($n, "zxcv") !== false || strpos($n, "aaaa") !== false || strpos($n, "zzzz") !== false) {
        return true;
    } else {
        return false;
    }
}
if (passwordTooLong($password)) {
    $message = "Password is too long";
} elseif (passwordTooShort($password)) {
    $message = "Password is too short";
} else {
    if (!passwordEnoughLetters($password)) {
        $message = "Password needs at least four letters";
    } elseif (!passwordEnoughNumbers($password)) {
        $message = "Password needs at least two numbers";
    } elseif (passwordContainsSpaces($password)) {
        $message = "Password cannot contain spaces";
    } elseif (weakPassword($password)) {
        $message = "Password is too weak";
    } else {
        $status = true;
    }
}
exit(json_encode(["success" => $status]));
*/
// scrapped it from now
?>
{'success': true}