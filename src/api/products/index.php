<?php
require __DIR__ . '/../../products/catalog.php';

header('Content-Type: application/json; charset=utf-8');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET') {
	header('Allow: GET');
	http_response_code(405);
	echo json_encode(['error' => 'Method not allowed']);
	exit;
}

$response = json_encode(get_all_products(), JSON_UNESCAPED_SLASHES);

if ($response === false) {
	http_response_code(500);
	echo json_encode(['error' => 'Unable to encode products']);
	exit;
}

echo $response;
