<?php
$cats = [
    ['id' => 1, 'name' => 'Appetizers'],
    ['id' => 2, 'name' => 'Main Courses'],
    ['id' => 3, 'name' => 'Beverages'],
    ['id' => 4, 'name' => 'Desserts']
];

$itemsByCat = [
    1 => [
        ['id' => 1, 'name' => 'Spring Rolls', 'description' => 'Crispy vegetable spring rolls served with sweet chili sauce', 'price' => 85.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=600&h=400&fit=crop'],
        ['id' => 2, 'name' => 'Edamame', 'description' => 'Steamed soybeans with sea salt', 'price' => 65.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1583963641308-9bc92b8bed32?w=600&h=400&fit=crop'],
        ['id' => 3, 'name' => 'Gyoza', 'description' => 'Pan-fried dumplings with a savory filling', 'price' => 95.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1630408377656-ed66ae5a6d1a?w=600&h=400&fit=crop']
    ],
    2 => [
        ['id' => 4, 'name' => 'Teriyaki Chicken', 'description' => 'Grilled chicken glazed with house-made teriyaki sauce, served with steamed rice and vegetables', 'price' => 245.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1606850003-cf6563e31d85?w=600&h=400&fit=crop'],
        ['id' => 5, 'name' => 'Salmon Sushi Platter', 'description' => 'Fresh salmon nigiri and rolls with wasabi and pickled ginger', 'price' => 395.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1617196034796-73dfa7b1fd56?w=600&h=400&fit=crop'],
        ['id' => 6, 'name' => 'Vegetable Ramen', 'description' => 'Rich miso broth with fresh vegetables, noodles, and tofu', 'price' => 185.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1623341214825-9f4f963727da?w=600&h=400&fit=crop'],
        ['id' => 7, 'name' => 'Beef Udon', 'description' => 'Thick udon noodles with tender beef slices in savory broth', 'price' => 285.00, 'is_available' => 0, 'image' => 'https://images.unsplash.com/photo-1618841557871-b4664fbf0cb3?w=600&h=400&fit=crop']
    ],
    3 => [
        ['id' => 8, 'name' => 'Japanese Green Tea', 'description' => 'Premium sencha green tea', 'price' => 45.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1564890369478-c89ca6d9cde9?w=600&h=400&fit=crop'],
        ['id' => 9, 'name' => 'Iced Matcha Latte', 'description' => 'Creamy matcha green tea latte over ice', 'price' => 75.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?w=600&h=400&fit=crop'],
        ['id' => 10, 'name' => 'Fresh Fruit Smoothie', 'description' => 'Blended seasonal fruits with a touch of honey', 'price' => 85.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=600&h=400&fit=crop']
    ],
    4 => [
        ['id' => 11, 'name' => 'Mochi Ice Cream', 'description' => 'Traditional Japanese rice cake with ice cream filling (assorted flavors)', 'price' => 65.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=600&h=400&fit=crop'],
        ['id' => 12, 'name' => 'Matcha Tiramisu', 'description' => 'Italian classic with a Japanese twist - layers of matcha-soaked ladyfingers', 'price' => 95.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=600&h=400&fit=crop'],
        ['id' => 13, 'name' => 'Dorayaki', 'description' => 'Sweet red bean pancake sandwich', 'price' => 55.00, 'is_available' => 1, 'image' => 'https://images.unsplash.com/photo-1582716401301-b2407dc7563d?w=600&h=400&fit=crop']
    ]
];

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
    transform: translateY(-4px) scale(1.1);
    box-shadow: var(--shadow-xl);
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
  <div class="hero">
    <div class="hero-content">
      <h1 class="menu-title">Fuji Cafe</h1>
      <div class="decorative-line"></div>
      <p class="menu-subtitle">Digital Menu</p>
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
                  <?php if (!$it['is_available']): ?>
                    <div class="availability-badge">Currently Unavailable</div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>

    <section class="review-section">
      <div class="review-content">
        <div class="review-header">
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

            <div class="marketing-notice">
              <div>
                <strong>SMS Marketing Benefits:</strong> Receive timely lunch specials, exclusive weekend offers, and birthday surprises. We'll send you personalized notifications based on your preferences. Msg & data rates may apply.
              </div>
            </div>

            <button type="submit" class="submit-btn" id="submit-btn">Join VIP Club</button>
          </form>
        </div>
      </div>
    </section>
  </div>

  <div class="footer">
    <p>&copy; <?=date('Y')?> Fuji Cafe. All rights reserved.</p>
    <p style="margin-top: 8px; font-size: 0.85rem;">Powered by SMS Marketing · Building customer loyalty, one message at a time</p>
  </div>

  <div class="scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
    ↑
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const scrollTopBtn = document.querySelector('.scroll-top');
      
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
    });
  </script>
</body>
</html>
