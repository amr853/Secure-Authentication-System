<?php
require_once 'includes/db.php';
require_once 'includes/auth.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    if (empty($name) || empty($email) || empty($password) || empty($role_id)) {
        $error = "All fields are required.";
    } else {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        // Generate 2FA Secret (Simulated for this assignment)
        $two_factor_secret = bin2hex(random_bytes(10));

        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, role_id, two_factor_secret) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $password_hash, $role_id, $two_factor_secret]);
            
            $_SESSION['temp_user_id'] = $pdo->lastInsertId();
            $_SESSION['temp_secret'] = $two_factor_secret;
            
            header("Location: setup_2fa.php");
            exit();
        } catch (PDOException $e) {
            $error = "Email already exists or database error.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | SecureAuth</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="glass-card">
        <h1>Create Account</h1>
        <p class="subtitle">Join our secure platform today</p>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="name@company.com" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="form-group">
                <label>Assign Role</label>
                <select name="role_id" required>
                    <option value="3">User</option>
                    <option value="2">Manager</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <button type="submit">Register & Setup 2FA</button>
        </form>
        
        <div class="footer-link">
            Already have an account? <a href="login.php">Sign In</a>
        </div>
    </div>
</body>
</html>
