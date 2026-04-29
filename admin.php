<?php
require_once 'includes/auth.php';
checkRole('Admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel | SecureAuth</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="glass-card">
        <h1 style="color: #ef4444;">Admin Control Panel</h1>
        <p class="subtitle">Only users with the <strong>Admin</strong> role can see this page.</p>
        <div class="alert alert-success">Access Granted: High-level system permissions active.</div>
        <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
    </div>
</body>
</html>
