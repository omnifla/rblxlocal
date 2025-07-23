<?php
// written by meditext
namespace Roblox;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Roblox\BrickColor as BrickColor;
use Roblox\TextFilter\BasicTextFilter;

class Authentication {
    public static function GetAuthenticatedUser() {
        $jwt_secret = 'EIJ3ITGJANGHIANSGOIJ';
        if (empty($_COOKIE['_ROBLOSECURITY'])) {
            return null;
        }
        try {
            $decoded = \Firebase\JWT\JWT::decode($_COOKIE['_ROBLOSECURITY'], new Key($jwt_secret, 'HS256'));
            return $decoded;
        } catch (\Exception $e) {
            return null;
        }
    }
    public static function Login(string $username, string $password) {
        global $conn;
        $jwt_secret = 'EIJ3ITGJANGHIANSGOIJ';

        if (empty($username) || empty($password)) {
            throw new \InvalidArgumentException("Username and password are required.");
        }
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            throw new \InvalidArgumentException("Invalid username or password.");
        }

        $payload = [
            'sub' => $user['id'],
            'username' => $user['username'],
            'iat' => time(),
            'exp' => time() + 60*60*24*7
        ];
        $jwt = JWT::encode($payload, $jwt_secret, 'HS256');

        setcookie('.ROBLOSECURITY', $jwt, [
            'expires' => $payload['exp'],
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        return true;
    }
    public static function ValidateUsername(string $username) {
        global $conn;
        if(empty($username)) {
            throw new \InvalidArgumentException("Please enter a username.");
        }
        if(strlen($username) < 3 || strlen($username) > 20) {
            throw new \InvalidArgumentException("Usernames can be 3 to 20 characters long.");
        }
        // verify if the username contains only valid characters
        if(!preg_match('/^[a-zA-Z0-9]*$/', $username)) {
            throw new \InvalidArgumentException("Usernames may only contain letters and numbers.");
        }
        $check = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $check->execute([':username' => $username]);
        if($check->fetchColumn() > 0) {
            throw new \InvalidArgumentException("This username is already in use.");
        }
        return true;
    }
    public static function Register(string $username, string $password, ?int $gender = 1, ?string $email = "", ?string $birthdate = "1970-01-01") {
        global $conn;
        $filter = new BasicTextFilter();
        $jwt_secret = 'EIJ3ITGJANGHIANSGOIJ';

        if(empty($birthdate)) {
            throw new \InvalidArgumentException("Birthday must be set first.");
        }
        if(!in_array($gender, [1, 2])) {
            throw new \InvalidArgumentException("Invalid Gender provided.");
        }
        self::ValidateUsername($username); // user validation
        $torsoColor = BrickColor::GetRandom(); 
        $palletColor = BrickColor::GetRandomHeadColor();
        $final_bodycolor = [
            "HeadColor" => $palletColor->ID,
            "LeftArmColor" => $palletColor->ID,
            "RightArmColor" => $palletColor->ID,
            "LeftLegColor" => 11, // default leg color
            "RightLegColor" => 11, // default leg color
            "TorsoColor" => $torsoColor->ID,
        ];
        if(empty($password)) {
            throw new \InvalidArgumentException("Please enter a password.");
        }
        if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Please enter a valid email address.");
        }
        $check = $filter->filter($username);
        if($check->isFiltered()) {
            throw new \InvalidArgumentException("Can't be used as username.");
        }
        $created = $updated = date('Y-m-d H:i:s');
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $stmt = $conn->prepare('INSERT INTO users (birthdate, created, updated, username, email, password, ips, gender, bodycolor, account_status_id) VALUES (:birthdate, :created, :updated, :username, :email, :password, :ips, :gender, :bodycolor, 1)');
        $stmt->execute([
            ':birthdate' => $birthdate,
            ':created' => $created,
            ':updated' => $updated,
            ':username' => $username,
            ':email' => $email,
            ':password' => $passwordHash,
            ':ips' => json_encode([md5($ip)]),
            ':gender' => $gender,
            ":bodycolor" => json_encode($final_bodycolor)
        ]);
        $userId = $conn->lastInsertId('users_id_seq');

        $payload = [
            'sub' => $userId,
            'username' => $username,
            'iat' => time(),
            'exp' => time() + 60*60*24*7
        ];

        $jwt = \Firebase\JWT\JWT::encode($payload, $jwt_secret, 'HS256');
        setcookie('.ROBLOSECURITY', $jwt, [
            'expires' => $payload['exp'],
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        return $userId;
    }
    public static function Logout(){
        setcookie('.ROBLOSECURITY', '', [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }
    public static function GetAuthenticatedUserInfo() {
        global $conn;
        $jwt_secret = 'EIJ3ITGJANGHIANSGOIJ';
        if (empty($_COOKIE['_ROBLOSECURITY'])) {
            return null;
        }
        try {
            $decoded = \Firebase\JWT\JWT::decode($_COOKIE['_ROBLOSECURITY'], new Key($jwt_secret, 'HS256'));
            if (empty($decoded->sub)) {
                return null;
            }
            $stmt = $conn->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
            $stmt->execute([':id' => $decoded->sub]);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }
            return $row;
        } catch (\Exception $e) {
            return null;
        }
    }
    public static function GetUserInfo(int $userId) {
        global $conn;
        try {
            $stmt = $conn->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
            $stmt->execute([':id' => $userId]);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }
            return $row;
        } catch (\Exception $e) {
            return null;
        }
    }
    public static function GetUserInfoViaUsername(string $username) {
        global $conn;
        try {
            $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
            $stmt->execute([':username' => $username]);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }
            return $row;
        } catch (\Exception $e) {
            return null;
        }
    }
}  
