<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['authenticated_2fa']) && $_SESSION['authenticated_2fa'] === true;
}

function hasRole($roleName) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $roleName;
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

function checkRole($roleName) {
    redirectIfNotLoggedIn();
    if (!hasRole($roleName)) {
        header("Location: unauthorized.php");
        exit();
    }
}

// Simple JWT-like token generation for demonstration
function generateToken($userId, $role) {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode(['user_id' => $userId, 'role' => $role, 'exp' => time() + 3600]);
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'your_secret_key', true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
}
?>
