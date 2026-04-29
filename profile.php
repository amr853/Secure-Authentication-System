<?php
require_once 'includes/auth.php';
redirectIfNotLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile | SecureAuth</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="glass-card">
        <h1>User Profile</h1>
        <p class="subtitle">Personal information and security settings.</p>
        <div class="form-group">
            <label>Name</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" disabled>
        </div>
        <div class="form-group">
            <label>Role</label>
            <input type="text" value="<?php echo htmlspecialchars($_SESSION['role']); ?>" disabled>
        </div>
        <div class="alert alert-success">Status: Fully Authenticated (Password + 2FA)</div>
        <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
    </div>
</body>
</html>
