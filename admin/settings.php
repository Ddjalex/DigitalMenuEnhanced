<?php
require_once 'session.php';
requireLogin();

$settingsFile = __DIR__ . '/../site_settings.json';

if (!file_exists($settingsFile)) {
    $defaultSettings = [
        'social_media' => [
            'facebook' => '',
            'instagram' => '',
            'tiktok' => ''
        ],
        'contact' => [
            'phone' => '',
            'email' => '',
            'address' => ''
        ],
        'neo_digital' => [
            'name' => 'Neo Digital Solution',
            'website' => 'https://neodigitalsolutions.com/',
            'logo' => 'attached_assets/neo_1762334562172.png'
        ]
    ];
    file_put_contents($settingsFile, json_encode($defaultSettings, JSON_PRETTY_PRINT), LOCK_EX);
}

$settings = json_decode(file_get_contents($settingsFile), true) ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings['social_media']['facebook'] = $_POST['facebook'] ?? '';
    $settings['social_media']['instagram'] = $_POST['instagram'] ?? '';
    $settings['social_media']['tiktok'] = $_POST['tiktok'] ?? '';
    $settings['contact']['phone'] = $_POST['phone'] ?? '';
    $settings['contact']['email'] = $_POST['email'] ?? '';
    $settings['contact']['address'] = $_POST['address'] ?? '';
    
    file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT), LOCK_EX);
    header('Location: settings.php?success=Settings updated successfully');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Settings - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
        }

        h1 {
            color: #333;
            font-size: 2rem;
        }

        .back-btn {
            padding: 10px 20px;
            background: #666;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #555;
        }

        .success {
            background: #10b981;
            color: white;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .section {
            margin-bottom: 32px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #8b4513;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="url"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #8b4513;
        }

        .help-text {
            font-size: 0.85rem;
            color: #777;
            margin-top: 4px;
        }

        .submit-btn {
            padding: 14px 32px;
            background: linear-gradient(135deg, #8b4513 0%, #d4a574 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 69, 19, 0.3);
        }

        .icon-preview {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        .social-preview {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            border-radius: 50%;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛠️ Site Settings</h1>
            <div style="display: flex; gap: 10px;">
                <a href="index.php" class="back-btn">Menu</a>
                <a href="orders.php" class="back-btn">Orders</a>
                <a href="change_password.php" class="back-btn">🔒 Password</a>
                <a href="logout.php" class="back-btn">Logout</a>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="success">✓ <?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="section">
                <h2 class="section-title">Social Media Links</h2>
                
                <div class="form-group">
                    <label for="facebook">Facebook URL</label>
                    <input 
                        type="url" 
                        id="facebook" 
                        name="facebook" 
                        value="<?= htmlspecialchars($settings['social_media']['facebook'] ?? '') ?>"
                        placeholder="https://facebook.com/yourpage"
                    >
                    <div class="help-text">Enter the full URL to your Facebook page</div>
                </div>

                <div class="form-group">
                    <label for="instagram">Instagram URL</label>
                    <input 
                        type="url" 
                        id="instagram" 
                        name="instagram" 
                        value="<?= htmlspecialchars($settings['social_media']['instagram'] ?? '') ?>"
                        placeholder="https://instagram.com/yourhandle"
                    >
                    <div class="help-text">Enter the full URL to your Instagram profile</div>
                </div>

                <div class="form-group">
                    <label for="tiktok">TikTok URL</label>
                    <input 
                        type="url" 
                        id="tiktok" 
                        name="tiktok" 
                        value="<?= htmlspecialchars($settings['social_media']['tiktok'] ?? '') ?>"
                        placeholder="https://tiktok.com/@yourhandle"
                    >
                    <div class="help-text">Enter the full URL to your TikTok profile</div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Contact Information</h2>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="text" 
                        id="phone" 
                        name="phone" 
                        value="<?= htmlspecialchars($settings['contact']['phone'] ?? '') ?>"
                        placeholder="+251 912 345 678"
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?= htmlspecialchars($settings['contact']['email'] ?? '') ?>"
                        placeholder="contact@fujicoffee.com"
                    >
                </div>

                <div class="form-group">
                    <label for="address">Physical Address</label>
                    <textarea 
                        id="address" 
                        name="address" 
                        rows="3"
                        placeholder="123 Main Street, Addis Ababa, Ethiopia"
                    ><?= htmlspecialchars($settings['contact']['address'] ?? '') ?></textarea>
                </div>
            </div>

            <button type="submit" class="submit-btn">💾 Save Settings</button>
        </form>
    </div>
</body>
</html>
