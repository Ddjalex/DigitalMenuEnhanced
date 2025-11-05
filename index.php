<?php
$menuFile = __DIR__ . '/menu_items.json';
$settingsFile = __DIR__ . '/site_settings.json';

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
            'website' => 'https://neodigitalsolution.com',
            'logo' => 'attached_assets/neo_1762334562172.png'
        ]
    ];
    file_put_contents($settingsFile, json_encode($defaultSettings, JSON_PRETTY_PRINT), LOCK_EX);
}

$siteSettings = json_decode(file_get_contents($settingsFile), true) ?? [];

if (!file_exists($menuFile)) {
    $defaultMenu = [
        ['id' => 1, 'name' => 'Spring Rolls', 'category' => 'Appetizers', 'description' => 'Crispy vegetable spring rolls served with sweet chili sauce', 'price' => 85.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=600&h=400&fit=crop'],
        ['id' => 2, 'name' => 'Edamame', 'category' => 'Appetizers', 'description' => 'Steamed soybeans with sea salt', 'price' => 65.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1583963641308-9bc92b8bed32?w=600&h=400&fit=crop'],
        ['id' => 3, 'name' => 'Gyoza', 'category' => 'Appetizers', 'description' => 'Pan-fried dumplings with a savory filling', 'price' => 95.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1630408377656-ed66ae5a6d1a?w=600&h=400&fit=crop'],
        ['id' => 4, 'name' => 'Teriyaki Chicken', 'category' => 'Main Courses', 'description' => 'Grilled chicken glazed with house-made teriyaki sauce, served with steamed rice and vegetables', 'price' => 245.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1606850003-cf6563e31d85?w=600&h=400&fit=crop'],
        ['id' => 5, 'name' => 'Salmon Sushi Platter', 'category' => 'Main Courses', 'description' => 'Fresh salmon nigiri and rolls with wasabi and pickled ginger', 'price' => 395.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1617196034796-73dfa7b1fd56?w=600&h=400&fit=crop'],
        ['id' => 6, 'name' => 'Vegetable Ramen', 'category' => 'Main Courses', 'description' => 'Rich miso broth with fresh vegetables, noodles, and tofu', 'price' => 185.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1623341214825-9f4f963727da?w=600&h=400&fit=crop'],
        ['id' => 7, 'name' => 'Beef Udon', 'category' => 'Main Courses', 'description' => 'Thick udon noodles with tender beef slices in savory broth', 'price' => 285.00, 'is_available' => 0, 'image' => 'https://images.unsplash.com/photo-1618841557871-b4664fbf0cb3?w=600&h=400&fit=crop'],
        ['id' => 8, 'name' => 'Japanese Green Tea', 'category' => 'Beverages', 'description' => 'Premium sencha green tea', 'price' => 45.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=600&h=400&fit=crop'],
        ['id' => 9, 'name' => 'Iced Matcha Latte', 'category' => 'Beverages', 'description' => 'Creamy matcha green tea latte over ice', 'price' => 75.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?w=600&h=400&fit=crop'],
        ['id' => 10, 'name' => 'Fresh Fruit Smoothie', 'category' => 'Beverages', 'description' => 'Blended seasonal fruits with a touch of honey', 'price' => 85.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=600&h=400&fit=crop'],
        ['id' => 11, 'name' => 'Mochi Ice Cream', 'category' => 'Desserts', 'description' => 'Traditional Japanese rice cake with ice cream filling (assorted flavors)', 'price' => 65.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=600&h=400&fit=crop'],
        ['id' => 12, 'name' => 'Matcha Tiramisu', 'category' => 'Desserts', 'description' => 'Italian classic with a Japanese twist - layers of matcha-soaked ladyfingers', 'price' => 95.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=600&h=400&fit=crop'],
        ['id' => 13, 'name' => 'Dorayaki', 'category' => 'Desserts', 'description' => 'Sweet red bean pancake sandwich', 'price' => 55.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1582716401301-b2407dc7563d?w=600&h=400&fit=crop']
    ];
    file_put_contents($menuFile, json_encode($defaultMenu, JSON_PRETTY_PRINT), LOCK_EX);
}

$menuItems = json_decode(file_get_contents($menuFile), true) ?? [];

$cats = [];
$itemsByCat = [];

foreach ($menuItems as $item) {
    $category = $item['category'];
    
    if (!isset($cats[$category])) {
        $cats[$category] = ['id' => count($cats) + 1, 'name' => $category];
    }
    
    $catId = $cats[$category]['id'];
    
    if (!isset($itemsByCat[$catId])) {
        $itemsByCat[$catId] = [];
    }
    
    $itemsByCat[$catId][] = $item;
}

$cats = array_values($cats);

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Fuji Cafe · Digital Menu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --primary-color: #2c1810;
    --secondary-color: #8b4513;
    --accent-color: #d4a574;
    --success-color: #10b981;
    --bg-primary: #faf8f5;
    --bg-secondary: #ffffff;
    --text-primary: #2c1810;
    --text-secondary: #6b5d52;
    --text-muted: #9b8b7e;
    --border-color: #e8dfd5;
    --shadow-sm: 0 2px 8px rgba(44, 24, 16, 0.08);
    --shadow-md: 0 4px 16px rgba(44, 24, 16, 0.12);
    --shadow-lg: 0 8px 32px rgba(44, 24, 16, 0.16);
    --shadow-xl: 0 12px 48px rgba(44, 24, 16, 0.2);
    --gradient-warm: linear-gradient(135deg, #f5e6d3 0%, #d4a574 100%);
    --gradient-overlay: linear-gradient(180deg, rgba(250, 248, 245, 0) 0%, rgba(250, 248, 245, 0.9) 100%);
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    line-height: 1.6;
    overflow-x: hidden;
  }

  .hero {
    position: relative;
    background: var(--gradient-warm);
    padding: 80px 24px 60px;
    text-align: center;
    overflow: hidden;
    animation: gradientShift 8s ease infinite;
    background-size: 200% 200%;
  }

  @keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
  }

  .hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 50%, rgba(139, 69, 19, 0.1) 0%, transparent 50%);
    animation: floatPattern 15s ease-in-out infinite;
  }

  @keyframes floatPattern {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(20px, -20px) scale(1.05); }
  }

  .hero-content {
    position: relative;
    z-index: 1;
    max-width: 900px;
    margin: 0 auto;
    animation: fadeInUp 1s ease-out;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .menu-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 12px;
    letter-spacing: -0.02em;
    text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.5);
    animation: slideInDown 1s ease-out 0.2s both;
  }

  @keyframes slideInDown {
    from {
      opacity: 0;
      transform: translateY(-40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .menu-subtitle {
    font-size: 1.125rem;
    color: var(--text-secondary);
    font-weight: 300;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    animation: fadeIn 1s ease-out 0.4s both;
  }

  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  .decorative-line {
    width: 80px;
    height: 3px;
    background: var(--secondary-color);
    margin: 24px auto;
    position: relative;
    animation: expandWidth 1s ease-out 0.6s both;
  }

  @keyframes expandWidth {
    from { width: 0; }
    to { width: 80px; }
  }

  .decorative-line::before,
  .decorative-line::after {
    content: '';
    position: absolute;
    width: 6px;
    height: 6px;
    background: var(--secondary-color);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    animation: pulse 2s ease-in-out infinite;
  }

  .decorative-line::before { left: -20px; }
  .decorative-line::after { right: -20px; }

  @keyframes pulse {
    0%, 100% { transform: translateY(-50%) scale(1); opacity: 1; }
    50% { transform: translateY(-50%) scale(1.3); opacity: 0.7; }
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 24px 80px;
  }

  .category-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin-bottom: 48px;
    padding: 24px;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    animation: fadeInUp 1s ease-out 0.8s both;
  }

  .cat-nav-btn {
    padding: 10px 24px;
    background: var(--bg-secondary);
    border: 2px solid var(--border-color);
    border-radius: 24px;
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: inline-block;
  }

  .cat-nav-btn:hover {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .category-section {
    margin-bottom: 64px;
    opacity: 0;
    animation: fadeInUp 0.6s ease-out forwards;
  }

  .category-section:nth-child(1) { animation-delay: 0.1s; }
  .category-section:nth-child(2) { animation-delay: 0.2s; }
  .category-section:nth-child(3) { animation-delay: 0.3s; }
  .category-section:nth-child(4) { animation-delay: 0.4s; }
  .category-section:nth-child(5) { animation-delay: 0.5s; }

  .category-header {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
  }

  .category-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 12px;
    position: relative;
    display: inline-block;
  }

  .category-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background: var(--accent-color);
    transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .category-section:hover .category-title::after {
    width: 100%;
  }

  .menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 28px;
  }

  .menu-item {
    background: var(--bg-secondary);
    border-radius: 20px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    opacity: 0;
    transform: translateY(20px);
    animation: itemFadeIn 0.6s ease-out forwards;
  }

  .menu-item:nth-child(1) { animation-delay: 0.1s; }
  .menu-item:nth-child(2) { animation-delay: 0.15s; }
  .menu-item:nth-child(3) { animation-delay: 0.2s; }
  .menu-item:nth-child(4) { animation-delay: 0.25s; }
  .menu-item:nth-child(5) { animation-delay: 0.3s; }
  .menu-item:nth-child(6) { animation-delay: 0.35s; }
  .menu-item:nth-child(7) { animation-delay: 0.4s; }
  .menu-item:nth-child(8) { animation-delay: 0.45s; }

  @keyframes itemFadeIn {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .menu-item:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-xl);
    border-color: var(--accent-color);
  }

  .item-image-wrapper {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
    background: linear-gradient(135deg, var(--border-color) 0%, var(--accent-color) 100%);
  }

  .item-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 0;
  }

  .item-image.loaded {
    opacity: 1;
    animation: imageReveal 0.8s ease-out;
  }

  @keyframes imageReveal {
    from {
      opacity: 0;
      transform: scale(1.1);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .menu-item:hover .item-image {
    transform: scale(1.1);
  }

  .item-image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60%;
    background: var(--gradient-overlay);
    pointer-events: none;
  }

  .item-content {
    padding: 24px;
  }

  .item-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
    gap: 16px;
  }

  .item-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    transition: color 0.3s ease;
    flex: 1;
  }

  .menu-item:hover .item-name {
    color: var(--secondary-color);
  }

  .item-price {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--secondary-color);
    white-space: nowrap;
    transition: transform 0.3s ease;
  }

  .menu-item:hover .item-price {
    transform: scale(1.1);
  }

  .currency {
    font-size: 1.1rem;
    opacity: 0.8;
  }

  .item-description {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 12px;
  }

  .availability-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: rgba(255, 152, 0, 0.1);
    border: 1px solid rgba(255, 152, 0, 0.3);
    border-radius: 20px;
    color: #d97706;
    font-size: 0.85rem;
    font-weight: 500;
    margin-top: 8px;
    animation: badgePulse 2s ease-in-out infinite;
  }

  @keyframes badgePulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(0.98); }
  }

  .availability-badge::before {
    content: '◉';
    font-size: 0.7rem;
    animation: blink 2s ease-in-out infinite;
  }

  @keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
  }

  .item-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 12px 0;
  }

  .stars {
    display: flex;
    gap: 2px;
  }

  .star {
    font-size: 1.2rem;
    color: #ddd;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .star.active,
  .star:hover {
    color: #fbbf24;
    transform: scale(1.2);
  }

  .rating-count {
    font-size: 0.85rem;
    color: var(--text-muted);
    margin-left: 4px;
  }

  .order-btn {
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    margin-top: 12px;
    box-shadow: var(--shadow-sm);
  }

  .order-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    background: linear-gradient(135deg, #059669 0%, var(--success-color) 100%);
  }

  .order-btn:active {
    transform: translateY(0);
  }

  .review-section {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(212, 165, 116, 0.1) 100%);
    border-radius: 24px;
    padding: 48px 32px;
    margin: 80px auto 40px;
    max-width: 700px;
    box-shadow: var(--shadow-lg);
    border: 2px solid var(--border-color);
    animation: fadeInUp 0.8s ease-out;
    position: relative;
    overflow: hidden;
  }

  .review-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(212, 165, 116, 0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
  }

  @keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  .review-content {
    position: relative;
    z-index: 1;
  }

  .review-header {
    text-align: center;
    margin-bottom: 32px;
  }

  .review-icon {
    font-size: 3rem;
    margin-bottom: 16px;
    animation: bounce 2s ease-in-out infinite;
  }

  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }

  .review-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 8px;
  }

  .review-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
  }

  .review-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .form-label {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.95rem;
  }

  .form-input,
  .form-textarea {
    padding: 14px 18px;
    border: 2px solid var(--border-color);
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: var(--bg-secondary);
  }

  .form-input:focus,
  .form-textarea:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
    transform: translateY(-2px);
  }

  .form-textarea {
    min-height: 120px;
    resize: vertical;
  }

  .phone-input-wrapper {
    position: relative;
  }

  .phone-prefix {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
    font-weight: 500;
  }

  .phone-input {
    padding-left: 60px;
  }

  .submit-btn {
    padding: 16px 32px;
    background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-md);
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  .submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
  }

  .submit-btn:active {
    transform: translateY(-1px);
  }

  .marketing-notice {
    background: rgba(16, 185, 129, 0.1);
    border-left: 4px solid var(--success-color);
    padding: 16px;
    border-radius: 8px;
    font-size: 0.9rem;
    color: var(--text-secondary);
    display: flex;
    align-items: start;
    gap: 12px;
  }

  .marketing-notice::before {
    content: 'ℹ️';
    font-size: 1.2rem;
  }

  .success-message {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    color: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    font-weight: 500;
    animation: successPop 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }

  .error-message {
    background: rgba(239, 68, 68, 0.1);
    border: 2px solid #ef4444;
    color: #dc2626;
    padding: 16px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-weight: 500;
    animation: shake 0.5s ease;
  }

  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
  }

  @keyframes successPop {
    0% {
      opacity: 0;
      transform: scale(0.8);
    }
    100% {
      opacity: 1;
      transform: scale(1);
    }
  }

  .success-icon {
    font-size: 3rem;
    margin-bottom: 12px;
    animation: checkmark 0.8s ease;
  }

  @keyframes checkmark {
    0% {
      transform: scale(0) rotate(0deg);
    }
    50% {
      transform: scale(1.2) rotate(180deg);
    }
    100% {
      transform: scale(1) rotate(360deg);
    }
  }

  .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--text-muted);
    font-size: 1.1rem;
  }

  .empty-state::before {
    content: '☕';
    display: block;
    font-size: 3rem;
    margin-bottom: 16px;
    opacity: 0.5;
    animation: float 3s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }

  .footer {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-muted);
    font-size: 0.9rem;
    border-top: 1px solid var(--border-color);
    margin-top: 60px;
  }

  .scroll-top {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 56px;
    height: 56px;
    background: var(--secondary-color);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    font-size: 1.5rem;
  }

  .scroll-top.visible {
    opacity: 1;
    visibility: visible;
  }

  .scroll-top:hover {
    background: var(--primary-color);
    transform: translateY(-3px);
  }

  .mobile-menu-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1001;
    width: 50px;
    height: 50px;
    background: var(--secondary-color);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    box-shadow: var(--shadow-lg);
    transition: all 0.3s ease;
  }

  .mobile-menu-btn:hover {
    background: var(--primary-color);
    transform: scale(1.05);
  }

  .mobile-menu-btn span {
    width: 24px;
    height: 3px;
    background: white;
    border-radius: 2px;
    transition: all 0.3s ease;
  }

  .mobile-menu-btn.active span:nth-child(1) {
    transform: rotate(45deg) translate(7px, 7px);
  }

  .mobile-menu-btn.active span:nth-child(2) {
    opacity: 0;
  }

  .mobile-menu-btn.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -7px);
  }

  .mobile-menu {
    position: fixed;
    top: 0;
    left: -100%;
    width: 280px;
    height: 100vh;
    background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);
    box-shadow: var(--shadow-xl);
    z-index: 1000;
    transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow-y: auto;
    padding: 80px 0 40px;
  }

  .mobile-menu.active {
    left: 0;
  }

  .mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
  }

  .mobile-menu-overlay.active {
    opacity: 1;
    visibility: visible;
  }

  .menu-logo {
    text-align: center;
    padding: 0 24px 24px;
    border-bottom: 2px solid var(--border-color);
    margin-bottom: 24px;
  }

  .menu-logo-text {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 4px;
  }

  .menu-logo-icon {
    font-size: 2.5rem;
    margin-bottom: 8px;
  }

  .menu-nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .menu-nav-links li {
    border-bottom: 1px solid var(--border-color);
  }

  .menu-nav-links a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 24px;
    color: var(--text-primary);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .menu-nav-links a:hover {
    background: var(--accent-color);
    color: white;
    padding-left: 32px;
  }

  .menu-nav-links .nav-icon {
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
  }

  .menu-social {
    padding: 24px;
    margin-top: 24px;
  }

  .menu-social-title {
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 16px;
  }

  .social-icons {
    display: flex;
    gap: 12px;
  }

  .social-icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-secondary);
    border: 2px solid var(--border-color);
    border-radius: 50%;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 1.2rem;
    transition: all 0.3s ease;
  }

  .social-icon:hover {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
    transform: translateY(-2px);
  }

  .neo-footer {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--border-color);
  }

  .neo-logo {
    width: 40px;
    height: 40px;
    object-fit: contain;
  }

  .neo-link {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .neo-link:hover {
    color: var(--secondary-color);
    transform: translateX(3px);
  }

  @media (max-width: 768px) {
    .mobile-menu {
      width: 85%;
      max-width: 320px;
    }
  }

  @media (max-width: 768px) {
    .hero {
      padding: 60px 20px 40px;
    }

    .menu-title {
      font-size: 2.5rem;
    }

    .category-nav {
      padding: 16px;
    }

    .menu-grid {
      grid-template-columns: 1fr;
    }

    .review-section {
      padding: 32px 20px;
      margin: 60px 16px 40px;
    }

    .review-title {
      font-size: 1.75rem;
    }

    .scroll-top {
      width: 48px;
      height: 48px;
      bottom: 24px;
      right: 24px;
    }
  }
</style>
</head>
<body>
  <button class="mobile-menu-btn" id="menuToggle" aria-label="Toggle menu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <div class="mobile-menu-overlay" id="menuOverlay"></div>

  <nav class="mobile-menu" id="mobileMenu">
    <div class="menu-logo">
      <div class="menu-logo-icon">☕</div>
      <div class="menu-logo-text">Fuji Coffee</div>
    </div>

    <ul class="menu-nav-links">
      <li>
        <a href="#menu">
          <span class="nav-icon">🍽️</span>
          <span>Menu</span>
        </a>
      </li>
      <li>
        <a href="#feedback">
          <span class="nav-icon">💬</span>
          <span>Feedback</span>
        </a>
      </li>
      <li>
        <a href="#contact">
          <span class="nav-icon">📞</span>
          <span>Contact Us</span>
        </a>
      </li>
      <li>
        <a href="#reviews">
          <span class="nav-icon">⭐</span>
          <span>Review</span>
        </a>
      </li>
    </ul>

    <div class="menu-social">
      <div class="menu-social-title">Follow Us</div>
      <div class="social-icons">
        <?php if (!empty($siteSettings['social_media']['facebook'])): ?>
          <a href="<?= htmlspecialchars($siteSettings['social_media']['facebook']) ?>" target="_blank" class="social-icon" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
          </a>
        <?php endif; ?>
        <?php if (!empty($siteSettings['social_media']['instagram'])): ?>
          <a href="<?= htmlspecialchars($siteSettings['social_media']['instagram']) ?>" target="_blank" class="social-icon" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
        <?php endif; ?>
        <?php if (!empty($siteSettings['social_media']['tiktok'])): ?>
          <a href="<?= htmlspecialchars($siteSettings['social_media']['tiktok']) ?>" target="_blank" class="social-icon" aria-label="TikTok">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/></svg>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <div class="hero" id="menu">
    <div class="hero-content">
      <h1 class="menu-title">Fuji Coffee</h1>
      <div class="decorative-line"></div>
      <p class="menu-subtitle"> Menu</p>
    </div>
  </div>

  <div class="container">
    <?php if (!empty($cats)): ?>
      <nav class="category-nav">
        <?php foreach ($cats as $c): ?>
          <a href="#cat-<?=$c['id']?>" class="cat-nav-btn"><?=htmlspecialchars($c['name'])?></a>
        <?php endforeach; ?>
      </nav>
    <?php endif; ?>

    <?php if (!$cats): ?>
      <div class="empty-state">
        No categories available at the moment
      </div>
    <?php endif; ?>

    <?php foreach ($cats as $c): ?>
      <section class="category-section" id="cat-<?=$c['id']?>">
        <div class="category-header">
          <h2 class="category-title"><?=htmlspecialchars($c['name'])?></h2>
        </div>

        <?php if (empty($itemsByCat[$c['id']])): ?>
          <div class="empty-state">No items in this category</div>
        <?php else: ?>
          <div class="menu-grid">
            <?php foreach ($itemsByCat[$c['id']] as $it): ?>
              <div class="menu-item">
                <div class="item-image-wrapper">
                  <img 
                    src="<?=htmlspecialchars($it['image'])?>" 
                    alt="<?=htmlspecialchars($it['name'])?>"
                    class="item-image"
                    loading="lazy"
                    onload="this.classList.add('loaded')"
                  >
                  <div class="item-image-overlay"></div>
                </div>
                <div class="item-content">
                  <div class="item-header">
                    <h3 class="item-name"><?=htmlspecialchars($it['name'])?></h3>
                    <div class="item-price">
                      <span class="currency">Br</span> <?=number_format((float)$it['price'], 2)?>
                    </div>
                  </div>
                  <?php if (!empty($it['description'])): ?>
                    <p class="item-description"><?=htmlspecialchars($it['description'])?></p>
                  <?php endif; ?>
                  
                  <div class="item-rating" data-item-id="<?=$it['id']?>">
                    <div class="stars">
                      <?php for($i=1; $i<=5; $i++): ?>
                        <span class="star" data-rating="<?=$i?>">★</span>
                      <?php endfor; ?>
                    </div>
                    <span class="rating-count">(0 reviews)</span>
                  </div>
                  
                  <?php if (!$it['is_available']): ?>
                    <div class="availability-badge">Currently Unavailable</div>
                  <?php else: ?>
                    <button class="order-btn" data-item-id="<?=$it['id']?>">
                      🛒 Order Now
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>

    <section class="review-section" id="feedback">
      <div class="review-content">
        <div class="review-header" id="reviews">
          <div class="review-icon">⭐</div>
          <h2 class="review-title">Join Our VIP Club</h2>
          <p class="review-subtitle">Get exclusive lunch specials & personalized offers</p>
        </div>

        <div id="form-container">
          <form id="vip-form" class="review-form">
            <div class="form-group">
              <label for="customer_name" class="form-label">Your Name</label>
              <input 
                type="text" 
                id="customer_name" 
                name="customer_name" 
                class="form-input" 
                placeholder="John Doe"
                required
              >
            </div>

            <div class="form-group">
              <label for="customer_phone" class="form-label">Phone Number</label>
              <div class="phone-input-wrapper">
                <span class="phone-prefix">+251</span>
                <input 
                  type="tel" 
                  id="customer_phone" 
                  name="customer_phone" 
                  class="form-input phone-input" 
                  placeholder="912345678"
                  pattern="[0-9]{9}"
                  required
                >
              </div>
            </div>

            <div class="form-group">
              <label for="customer_review" class="form-label">Message (Optional)</label>
              <textarea 
                id="customer_review" 
                name="customer_review" 
                class="form-textarea" 
                placeholder="Tell us what you love or what we can improve..."
              ></textarea>
            </div>

            <div id="error-message" class="error-message" style="display: none;"></div>
              </div>
            </div>

            <button type="submit" class="submit-btn" id="submit-btn">Join VIP Club</button>
          </form>
        </div>
      </div>
    </section>
  </div>

  <div class="footer">
    <p>&copy; <?=date('Y')?> Fuji Coffee. All rights reserved.</p>
    <div class="neo-footer">
      <span style="font-size: 0.85rem;">Powered by</span>
      <a href="<?= htmlspecialchars($siteSettings['neo_digital']['website'] ?? 'https://neodigitalsolution.com') ?>" target="_blank" class="neo-link">
        <img src="<?= htmlspecialchars($siteSettings['neo_digital']['logo'] ?? 'attached_assets/neo_1762334562172.png') ?>" alt="Neo Digital Solution" class="neo-logo">
        <span><?= htmlspecialchars($siteSettings['neo_digital']['name'] ?? 'Neo Digital Solution') ?></span>
      </a>
    </div>
  </div>

  <div class="scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    ↑
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const menuToggle = document.getElementById('menuToggle');
      const mobileMenu = document.getElementById('mobileMenu');
      const menuOverlay = document.getElementById('menuOverlay');
      const scrollTopBtn = document.querySelector('.scroll-top');

      function toggleMenu() {
        menuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        menuOverlay.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
      }

      menuToggle.addEventListener('click', toggleMenu);
      menuOverlay.addEventListener('click', toggleMenu);

      document.querySelectorAll('.menu-nav-links a').forEach(link => {
        link.addEventListener('click', function(e) {
          toggleMenu();
          const targetId = this.getAttribute('href');
          if (targetId.startsWith('#')) {
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
              setTimeout(() => {
                const yOffset = -20;
                const y = targetElement.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({top: y, behavior: 'smooth'});
              }, 300);
            }
          }
        });
      });
      
      window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
          scrollTopBtn.classList.add('visible');
        } else {
          scrollTopBtn.classList.remove('visible');
        }
      });

      document.querySelectorAll('.cat-nav-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          const targetId = this.getAttribute('href');
          const targetElement = document.querySelector(targetId);
          
          if (targetElement) {
            const yOffset = -20;
            const y = targetElement.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({top: y, behavior: 'smooth'});
          }
        });
      });

      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, observerOptions);

      document.querySelectorAll('.category-section, .menu-item').forEach(el => {
        observer.observe(el);
      });

      const vipForm = document.getElementById('vip-form');
      const submitBtn = document.getElementById('submit-btn');
      const errorMessage = document.getElementById('error-message');
      const formContainer = document.getElementById('form-container');

      if (vipForm) {
        vipForm.addEventListener('submit', async function(e) {
          e.preventDefault();
          
          errorMessage.style.display = 'none';
          submitBtn.disabled = true;
          submitBtn.textContent = 'Joining...';

          const formData = new FormData(vipForm);

          try {
            const response = await fetch('save_vip_customer.php', {
              method: 'POST',
              body: formData
            });

            const result = await response.json();

            if (result.success) {
              formContainer.innerHTML = `
                <div class="success-message">
                  <div class="success-icon">✓</div>
                  <p style="font-size: 1.2rem; margin-bottom: 8px;">Thank You!</p>
                  <p>${result.message}</p>
                  ${result.already_registered ? '<p style="margin-top: 12px; font-size: 0.95rem;">We already have your details and will continue sending you amazing offers!</p>' : ''}
                </div>
              `;
            } else {
              errorMessage.textContent = result.error || 'Something went wrong. Please try again.';
              errorMessage.style.display = 'block';
              submitBtn.disabled = false;
              submitBtn.textContent = 'Join VIP Club';
            }
          } catch (error) {
            errorMessage.textContent = 'Network error. Please check your connection and try again.';
            errorMessage.style.display = 'block';
            submitBtn.disabled = false;
            submitBtn.textContent = 'Join VIP Club';
          }
        });
      }
      
      // Load reviews and update star ratings
      async function loadReviews() {
        try {
          const response = await fetch('get_reviews.php');
          const reviews = await response.json();
          
          Object.keys(reviews).forEach(itemId => {
            const ratingEl = document.querySelector(`[data-item-id="${itemId}"]`);
            if (ratingEl) {
              const stars = ratingEl.querySelectorAll('.star');
              const avgRating = reviews[itemId].average;
              const count = reviews[itemId].count;
              
              stars.forEach((star, index) => {
                if (index < Math.floor(avgRating)) {
                  star.classList.add('active');
                }
              });
              
              const countEl = ratingEl.querySelector('.rating-count');
              countEl.textContent = `(${count} review${count !== 1 ? 's' : ''})`;
            }
          });
        } catch (error) {
          console.error('Failed to load reviews:', error);
        }
      }
      
      loadReviews();
      
      // Handle star rating clicks
      document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', async function() {
          const itemId = this.closest('.item-rating').dataset.itemId;
          const rating = parseInt(this.dataset.rating);
          
          try {
            const formData = new FormData();
            formData.append('item_id', itemId);
            formData.append('rating', rating);
            
            const response = await fetch('save_review.php', {
              method: 'POST',
              body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
              alert(result.message);
              loadReviews();
            }
          } catch (error) {
            console.error('Failed to save review:', error);
          }
        });
      });
      
      // Handle order button clicks
      document.querySelectorAll('.order-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
          const itemId = this.dataset.itemId;
          
          const customerName = prompt('Enter your name:');
          if (!customerName) return;
          
          const customerPhone = prompt('Enter your phone number (9 digits):');
          if (!customerPhone) return;
          
          if (!/^[0-9]{9}$/.test(customerPhone)) {
            alert('Please enter a valid 9-digit phone number');
            return;
          }
          
          const quantity = prompt('Enter quantity:', '1');
          if (!quantity || quantity < 1) return;
          
          try {
            const formData = new FormData();
            formData.append('item_id', itemId);
            formData.append('customer_name', customerName);
            formData.append('customer_phone', customerPhone);
            formData.append('quantity', quantity);
            
            this.disabled = true;
            this.textContent = 'Processing...';
            
            const response = await fetch('place_order.php', {
              method: 'POST',
              body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
              alert(result.message);
              this.textContent = '✓ Ordered';
              setTimeout(() => {
                this.disabled = false;
                this.textContent = '🛒 Order Now';
              }, 3000);
            } else {
              alert('Error: ' + result.error);
              this.disabled = false;
              this.textContent = '🛒 Order Now';
            }
          } catch (error) {
            console.error('Failed to place order:', error);
            alert('Failed to place order. Please try again.');
            this.disabled = false;
            this.textContent = '🛒 Order Now';
          }
        });
      });
    });
  </script>
</body>
</html>
