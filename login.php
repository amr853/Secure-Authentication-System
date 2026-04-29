<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

$error = '';
$success = isset($_GET['registered']) ? 'Registration successful! Please login.' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE u.email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['pending_user_id'] = $user['id'];
        $_SESSION['pending_user_name'] = $user['name'];
        $_SESSION['pending_user_role'] = $user['role_name'];
        header("Location: verify_2fa.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | SecureAuth</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="glass-card">
        <h1>Welcome Back</h1>
        <p class="subtitle">Enter your credentials to continue</p>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="name@company.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit">Continue</button>
        </form>
        
        <div class="footer-link">
            Don't have an account? <a href="register.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
