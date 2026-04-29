<?php
require_once 'includes/auth.php';

if (!isset($_SESSION['temp_user_id'])) {
    header("Location: register.php");
    exit();
}

$secret = $_SESSION['temp_secret'];
// In a real app, we'd use a library like PHPGangsta_GoogleAuthenticator
// For this assignment, we'll simulate the QR code display
$qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=otpauth://totp/SecureAuth:User?secret=" . $secret . "&issuer=SecureAuth";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate verification
    unset($_SESSION['temp_user_id']);
    unset($_SESSION['temp_secret']);
    header("Location: login.php?registered=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setup 2FA | SecureAuth</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="glass-card" style="text-align: center;">
        <h1>Two-Factor Auth</h1>
        <p class="subtitle">Scan this QR code with Google Authenticator</p>
        
        <div class="qr-container">
            <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code">
        </div>
        
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 20px;">
            Secret Key: <code style="color: var(--accent);"><?php echo $secret; ?></code>
        </p>

        <form method="POST">
            <div class="form-group">
                <label>Enter 6-digit Code</label>
                <input type="text" name="code" placeholder="000000" maxlength="6" required>
            </div>
            <button type="submit">Verify & Complete</button>
        </form>
    </div>
</body>
</html>
