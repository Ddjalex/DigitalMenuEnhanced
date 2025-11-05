<?php
// Load this tenant's config then shared DB helpers
require __DIR__ . '/config.php';
require __DIR__ . '/../_shared/db.php';

$db = dbi();

// find tenant id
$tenantId = 0;
$stmt = $db->prepare("SELECT id FROM tenants WHERE slug=? AND is_active=1 LIMIT 1");
$stmt->bind_param('s', $slug);
$slug = TENANT_SLUG;
$stmt->execute();
$stmt->bind_result($tenantId);
$stmt->fetch();
$stmt->close();

if (!$tenantId) {
    http_response_code(404);
    exit('Tenant not found');
}

// categories
$cats = [];
$stmt = $db->prepare("SELECT id, name FROM menu_categories WHERE tenant_id=? AND is_active=1 ORDER BY display_order, id");
$stmt->bind_param('i', $tenantId);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) $cats[] = $row;
$stmt->close();

// items by category
$itemsByCat = [];
if ($cats) {
    $ids = implode(',', array_map('intval', array_column($cats,'id')));
    $sql = "SELECT id, category_id, name, description, price, is_available
            FROM menu_items
            WHERE tenant_id={$tenantId} AND category_id IN ($ids) AND is_active=1
            ORDER BY display_order, id";
    $res = $db->query($sql);
    while ($row = $res->fetch_assoc()) {
        $itemsByCat[(int)$row['category_id']][] = $row;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Fuji Cafe · Digital Menu</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/modern-css-reset/dist/reset.min.css">
<style>
  body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,Helvetica,Arial,sans-serif;background:#fafafa;color:#222}
  .wrap{max-width:860px;margin:32px auto;padding:0 16px}
  h1{font-size:28px;margin:4px 0 16px}
  .cat{margin:28px 0}
  .item{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #eee}
  .item h4{margin:0 0 6px 0}
  .price{white-space:nowrap;margin-left:16px}
  .muted{color:#777}
</style>
</head>
<body>
<div class="wrap">
  <h1>Fuji Cafe — Menu</h1>

  <?php if (!$cats): ?>
    <p class="muted">No categories yet.</p>
  <?php endif; ?>

  <?php foreach ($cats as $c): ?>
    <div class="cat">
      <h2><?=htmlspecialchars($c['name'])?></h2>
      <?php if (empty($itemsByCat[$c['id']])): ?>
        <div class="muted">No items.</div>
      <?php else: ?>
        <?php foreach ($itemsByCat[$c['id']] as $it): ?>
          <div class="item">
            <div>
              <h4><?=htmlspecialchars($it['name'])?></h4>
              <?php if (!empty($it['description'])): ?>
                <div class="muted"><?=htmlspecialchars($it['description'])?></div>
              <?php endif; ?>
              <?php if (!$it['is_available']): ?>
                <div class="muted">Currently unavailable</div>
              <?php endif; ?>
            </div>
            <div class="price">Br <?=number_format((float)$it['price'],2)?></div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>
</body>
</html>
