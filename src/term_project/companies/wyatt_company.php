<?php
require_once __DIR__ . '/../../products/catalog.php';

function wyatt_company_get_data() {
	return [
		'company_name' => 'Icedancer Snow Equipment',
		'products' => get_all_products(),
	];
}
