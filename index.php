<?php
$cats = [
    ['id' => 1, 'name' => 'Appetizers'],
    ['id' => 2, 'name' => 'Main Courses'],
    ['id' => 3, 'name' => 'Beverages'],
    ['id' => 4, 'name' => 'Desserts']
];

$itemsByCat = [
    1 => [
        ['id' => 1, 'name' => 'Spring Rolls', 'description' => 'Crispy vegetable spring rolls served with sweet chili sauce', 'price' => 85.00, 'is_available' => 1],
        ['id' => 2, 'name' => 'Edamame', 'description' => 'Steamed soybeans with sea salt', 'price' => 65.00, 'is_available' => 1],
        ['id' => 3, 'name' => 'Gyoza', 'description' => 'Pan-fried dumplings with a savory filling', 'price' => 95.00, 'is_available' => 1]
    ],
    2 => [
        ['id' => 4, 'name' => 'Teriyaki Chicken', 'description' => 'Grilled chicken glazed with house-made teriyaki sauce, served with steamed rice and vegetables', 'price' => 245.00, 'is_available' => 1],
        ['id' => 5, 'name' => 'Salmon Sushi Platter', 'description' => 'Fresh salmon nigiri and rolls with wasabi and pickled ginger', 'price' => 395.00, 'is_available' => 1],
        ['id' => 6, 'name' => 'Vegetable Ramen', 'description' => 'Rich miso broth with fresh vegetables, noodles, and tofu', 'price' => 185.00, 'is_available' => 1],
        ['id' => 7, 'name' => 'Beef Udon', 'description' => 'Thick udon noodles with tender beef slices in savory broth', 'price' => 285.00, 'is_available' => 0]
    ],
    3 => [
        ['id' => 8, 'name' => 'Japanese Green Tea', 'description' => 'Premium sencha green tea', 'price' => 45.00, 'is_available' => 1],
        ['id' => 9, 'name' => 'Iced Matcha Latte', 'description' => 'Creamy matcha green tea latte over ice', 'price' => 75.00, 'is_available' => 1],
        ['id' => 10, 'name' => 'Fresh Fruit Smoothie', 'description' => 'Blended seasonal fruits with a touch of honey', 'price' => 85.00, 'is_available' => 1]
    ],
    4 => [
        ['id' => 11, 'name' => 'Mochi Ice Cream', 'description' => 'Traditional Japanese rice cake with ice cream filling (assorted flavors)', 'price' => 65.00, 'is_available' => 1],
        ['id' => 12, 'name' => 'Matcha Tiramisu', 'description' => 'Italian classic with a Japanese twist - layers of matcha-soaked ladyfingers', 'price' => 95.00, 'is_available' => 1],
        ['id' => 13, 'name' => 'Dorayaki', 'description' => 'Sweet red bean pancake sandwich', 'price' => 55.00, 'is_available' => 1]
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
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --primary-color: #2c1810;
    --secondary-color: #8b4513;
    --accent-color: #d4a574;
    --bg-primary: #faf8f5;
    --bg-secondary: #ffffff;
    --text-primary: #2c1810;
    --text-secondary: #6b5d52;
    --text-muted: #9b8b7e;
    --border-color: #e8dfd5;
    --shadow-sm: 0 2px 8px rgba(44, 24, 16, 0.08);
    --shadow-md: 0 4px 16px rgba(44, 24, 16, 0.12);
    --shadow-lg: 0 8px 32px rgba(44, 24, 16, 0.16);
    --gradient-warm: linear-gradient(135deg, #f5e6d3 0%, #d4a574 100%);
    --gradient-overlay: linear-gradient(180deg, rgba(250, 248, 245, 0) 0%, rgba(250, 248, 245, 0.8) 100%);
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
    max-width: 1000px;
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
    gap: 24px;
  }

  .menu-item {
    background: var(--bg-secondary);
    border-radius: 16px;
    padding: 28px;
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

  .menu-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(212, 165, 116, 0.1), transparent);
    transition: left 0.6s ease;
  }

  .menu-item:hover::before {
    left: 100%;
  }

  .menu-item:hover {
    transform: translateY(-4px) scale(1.01);
    box-shadow: var(--shadow-lg);
    border-color: var(--accent-color);
  }

  .item-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 24px;
  }

  .item-info {
    flex: 1;
  }

  .item-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 8px;
    transition: color 0.3s ease;
  }

  .menu-item:hover .item-name {
    color: var(--secondary-color);
  }

  .item-description {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 12px;
  }

  .item-price-wrapper {
    position: relative;
    min-width: 120px;
    text-align: right;
  }

  .item-price {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--secondary-color);
    white-space: nowrap;
    display: inline-block;
    transition: transform 0.3s ease;
  }

  .menu-item:hover .item-price {
    transform: scale(1.1);
  }

  .currency {
    font-size: 1.2rem;
    opacity: 0.8;
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
    margin-top: 12px;
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

    .menu-item {
      padding: 20px;
    }

    .item-content {
      flex-direction: column;
    }

    .item-price-wrapper {
      text-align: left;
      margin-top: 12px;
    }
  }

  .scroll-top {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 50px;
    height: 50px;
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
    box-shadow: var(--shadow-md);
    z-index: 1000;
  }

  .scroll-top.visible {
    opacity: 1;
    visibility: visible;
  }

  .scroll-top:hover {
    background: var(--primary-color);
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
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
                <div class="item-content">
                  <div class="item-info">
                    <h3 class="item-name"><?=htmlspecialchars($it['name'])?></h3>
                    <?php if (!empty($it['description'])): ?>
                      <p class="item-description"><?=htmlspecialchars($it['description'])?></p>
                    <?php endif; ?>
                    <?php if (!$it['is_available']): ?>
                      <div class="availability-badge">Currently Unavailable</div>
                    <?php endif; ?>
                  </div>
                  <div class="item-price-wrapper">
                    <div class="item-price">
                      <span class="currency">Br</span> <?=number_format((float)$it['price'], 2)?>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </section>
    <?php endforeach; ?>
  </div>

  <div class="footer">
    <p>&copy; <?=date('Y')?> Fuji Cafe. All rights reserved.</p>
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
    });
  </script>
</body>
</html>
