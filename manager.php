<?php
require_once 'includes/auth.php';
redirectIfNotLoggedIn();
if (!hasRole('Manager') && !hasRole('Admin')) {
    header("Location: unauthorized.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager View | SecureAuth</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="glass-card">
        <h1 style="color: #f59e0b;">Manager Dashboard</h1>
        <p class="subtitle">Accessible by <strong>Managers</strong> and <strong>Admins</strong>.</p>
        <div class="alert alert-success">Access Granted: Management tools available.</div>
        <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
    </div>
</body>
</html>
