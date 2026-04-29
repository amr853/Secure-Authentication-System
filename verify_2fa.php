<?php
require_once 'includes/auth.php';

if (!isset($_SESSION['pending_user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // In a real app, verify the code against the secret
    // For this assignment, we accept any 6-digit code for demo purposes
    $_SESSION['user_id'] = $_SESSION['pending_user_id'];
    $_SESSION['user_name'] = $_SESSION['pending_user_name'];
    $_SESSION['role'] = $_SESSION['pending_user_role'];
    $_SESSION['authenticated_2fa'] = true;
    $_SESSION['token'] = generateToken($_SESSION['user_id'], $_SESSION['role']);
    
    unset($_SESSION['pending_user_id']);
    unset($_SESSION['pending_user_name']);
    unset($_SESSION['pending_user_role']);
    
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify 2FA | SecureAuth</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="glass-card">
        <h1>Security Check</h1>
        <p class="subtitle">Enter the code from your authenticator app</p>
        
        <form method="POST">
            <div class="form-group">
                <label>6-Digit Verification Code</label>
                <input type="text" name="code" placeholder="000000" maxlength="6" required autofocus>
            </div>
            <button type="submit">Verify & Login</button>
        </form>
        
        <div class="footer-link">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
