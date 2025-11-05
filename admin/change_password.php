<?php
require_once 'session.php';
requireLogin();

$adminFile = __DIR__ . '/../admin_users.json';

if (!file_exists($adminFile)) {
    $defaultUsers = [
        [
            'username' => 'admin',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'name' => 'Administrator',
            'created_at' => date('Y-m-d H:i:s')
        ]
    ];
    file_put_contents($adminFile, json_encode($defaultUsers, JSON_PRETTY_PRINT), LOCK_EX);
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    $users = json_decode(file_get_contents($adminFile), true) ?? [];
    $currentUsername = $_SESSION['admin_username'] ?? 'admin';
    
    $passwordChanged = false;
    foreach ($users as &$user) {
        if ($user['username'] === $currentUsername) {
            if (!password_verify($currentPassword, $user['password'])) {
                $error = 'Current password is incorrect';
            } elseif (strlen($newPassword) < 6) {
                $error = 'New password must be at least 6 characters';
            } elseif ($newPassword !== $confirmPassword) {
                $error = 'New passwords do not match';
            } else {
                $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                file_put_contents($adminFile, json_encode($users, JSON_PRETTY_PRINT), LOCK_EX);
                $message = 'Password changed successfully!';
                $passwordChanged = true;
            }
            break;
        }
    }
    
    if (!$passwordChanged && !$error) {
        $error = 'User not found';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Fuji Cafe Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f7fafc;
            color: #2d3748;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h1 { font-size: 1.75rem; }
        
        .header-nav {
            display: flex;
            gap: 15px;
        }
        
        .header-nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s;
        }
        
        .header-nav a:hover { background: rgba(255,255,255,0.1); }
        .header-nav a.active { background: rgba(255,255,255,0.2); }
        
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #4a5568;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 100%;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .success {
            background: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }
        
        .error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #fc8181;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>🍱 Fuji Cafe Admin</h1>
            <nav class="header-nav">
                <a href="/admin/dashboard.php">📊 Dashboard</a>
                <a href="/admin/index.php">🍽️ Menu</a>
                <a href="/admin/orders.php">📦 Orders</a>
                <a href="/admin/settings.php">⚙️ Settings</a>
                <a href="/admin/change_password.php" class="active">🔒 Password</a>
                <a href="/index.php" target="_blank">👁️ View Site</a>
                <a href="/admin/logout.php">🚪 Logout</a>
            </nav>
        </div>
    </div>
    
    <div class="container">
        <div class="card">
            <h2 style="margin-bottom: 30px;">Change Password</h2>
            
            <?php if ($message): ?>
                <div class="message success"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="message error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                </div>
                
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required minlength="6">
                </div>
                
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" required minlength="6">
                </div>
                
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</body>
</html>
