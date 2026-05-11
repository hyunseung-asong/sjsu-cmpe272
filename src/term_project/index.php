<?php
require_once __DIR__ . '/companies/wyatt_company.php';
require_once __DIR__ . '/companies/lucas_company.php';
require_once __DIR__ . '/companies/robbie_company.php';
require_once __DIR__ . '/companies/andrew_company.php';

$companies = [
	wyatt_company_get_data(),
	lucas_company_get_data(),
	robbie_company_get_data(),
	andrew_company_get_data(),
];

function escape_html($value) {
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Term Project Products</title>
</head>
<body>
	<header>
		<a href="/term_project/todo.php">Login</a>
		<h1>Term Project Products</h1>
	</header>

	<main>
		<?php foreach ($companies as $company): ?>
			<section>
				<h2><?php echo escape_html($company['company_name'] ?? 'Unknown Company'); ?></h2>

				<?php if (empty($company['products'])): ?>
					<p>No products available.</p>
				<?php else: ?>
					<ul>
						<?php foreach ($company['products'] as $product): ?>
							<li>
								<a href="<?php echo escape_html($product['product_link'] ?? '#'); ?>">
									<?php echo escape_html($product['title'] ?? 'Untitled Product'); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</section>
		<?php endforeach; ?>
	</main>
</body>
</html>
