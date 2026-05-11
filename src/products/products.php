<?php
require __DIR__ . '/catalog.php';

$products = get_all_products();
?>

<html>
<title>Products</title>
<h1>Products</h1>
<p><a href="./recently_viewed.php">View Recently Viewed Products</a></p>
<h2>All Products</h2>
<ul>
<?php foreach ($products as $product): ?>
  <li>
    <a href="<?php echo htmlspecialchars($product['product_link'], ENT_QUOTES, 'UTF-8'); ?>">
      <?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>
    </a>
  </li>
<?php endforeach; ?>
</ul>
</html>
