<?php
require_once __DIR__ . '/_lib.php';

function get_product_catalog() {
	return [
		'gloves' => [
			'title' => 'Gloves',
			'description' => "Stay warm and stylish with our high-quality gloves! Crafted from premium materials, these gloves provide excellent insulation to keep your hands cozy in cold weather. The sleek design ensures a comfortable fit while allowing for easy movement. Whether you're heading out for a winter walk, commuting to work, or enjoying outdoor activities, our gloves are the perfect accessory to keep your hands protected from the elements. Don't let the cold stop you – grab a pair of our gloves and embrace the winter season in style!",
			'price' => 25.99,
			'image_link' => '/products/gloves/gloves.png',
			'product_link' => '/products/gloves/gloves.php',
		],
		'hand_warmers' => [
			'title' => 'Hand Warmers',
			'description' => "Keep your hands warm and cozy with our Hand Warmers! These compact and portable heat packs are perfect for chilly days. Simply activate them by shaking or squeezing, and they will provide hours of soothing warmth. Whether you're outdoor adventuring, attending sporting events, or just need a little extra warmth during the winter months, our Hand Warmers are the ideal solution to keep your hands comfortable and toasty.",
			'price' => 2.99,
			'image_link' => '/products/hand_warmers/hand_warmers.png',
			'product_link' => '/products/hand_warmers/hand_warmers.php',
		],
		'ice_pick' => [
			'title' => 'Ice Pick',
			'description' => "You'll love our Ice Pick! This versatile tool is perfect for breaking up ice, whether you're clearing a path or preparing for winter activities. With its sturdy design and sharp point, the Ice Pick makes it easy to chip away at ice and snow. It's an essential accessory for anyone who wants to stay safe and prepared during the winter months.",
			'price' => 10.99,
			'image_link' => '/products/ice_pick/ice_pick.png',
			'product_link' => '/products/ice_pick/ice_pick.php',
		],
		'shovel' => [
			'title' => 'Shovel',
			'description' => 'A sturdy shovel for digging and gardening.',
			'price' => 19.99,
			'image_link' => '/products/shovel/shovel.png',
			'product_link' => '/products/shovel/shovel.php',
		],
		'sled' => [
			'title' => 'Sled',
			'description' => 'Experience the thrill of gliding down snowy hills with our classic sled! Made from durable materials, this sled is designed for both fun and safety. Its sleek design allows for smooth rides, while the sturdy construction ensures it can withstand the winter elements. Whether you\'re racing down a hill or just enjoying a leisurely ride, our sled is the perfect companion for your winter adventures. Get ready to create unforgettable memories with family and friends on this fantastic sled!',
			'price' => 19.99,
			'image_link' => '/products/sled/sled.png',
			'product_link' => '/products/sled/sled.php',
		],
		'snow_blower' => [
			'title' => 'Snow Blower',
			'description' => 'Keep your driveway clear and safe with our powerful Snow Blower! This heavy-duty machine is designed to quickly and efficiently remove snow from your property, making winter maintenance a breeze. With its robust engine and wide clearing path, the Snow Blower can handle even the heaviest snowfall, ensuring you can get back to your daily routine without delay. Say goodbye to shoveling and hello to effortless snow removal with our reliable Snow Blower!',
			'price' => 899.99,
			'image_link' => '/products/snow_blower/snow_blower.png',
			'product_link' => '/products/snow_blower/snow_blower.php',
		],
		'snow_shoes' => [
			'title' => 'Snow Shoes',
			'description' => "Experience the great outdoors even in deep snow with our Snow Shoes! Designed to distribute your weight evenly, these snow shoes allow you to walk on top of the snow without sinking. Whether you're hiking, snowshoeing, or just exploring winter landscapes, our snow shoes provide comfort and stability. Made with durable materials and adjustable straps, they are perfect for all skill levels. Don't let the snow hold you back – get your pair of snow shoes today and enjoy winter like never before!",
			'price' => 199.99,
			'image_link' => '/products/snow_shoes/snow_shoes.png',
			'product_link' => '/products/snow_shoes/snow_shoes.php',
		],
		'snowball_maker' => [
			'title' => 'Snowball Maker',
			'description' => "Make perfect snowballs every time with our Snowball Maker! This handy tool allows you to easily create compact and uniform snowballs, making your snowball fights more fun and competitive. Simply fill the mold with snow, press it together, and release to create a perfectly shaped snowball. It's the ultimate accessory for winter fun!",
			'price' => 5.99,
			'image_link' => '/products/snowball_maker/snowball_maker.png',
			'product_link' => '/products/snowball_maker/snowball_maker.php',
		],
		'snowboard' => [
			'title' => 'Snowboard',
			'description' => 'A high-quality snowboard for all your winter adventures.',
			'price' => 399.99,
			'image_link' => '/products/snowboard/snowboard.png',
			'product_link' => '/products/snowboard/snowboard.php',
		],
		'tire_chains' => [
			'title' => 'Tire Chains',
			'description' => "Ensure your safety on snowy and icy roads with our durable tire chains! These chains provide enhanced traction and grip, allowing you to navigate through challenging winter conditions with confidence. Made from high-quality materials, they are designed to withstand harsh weather and provide reliable performance. Easy to install and remove, our tire chains are a must-have for any driver during the winter season. Don't let the snow slow you down – equip your vehicle with our tire chains today!",
			'price' => 299.99,
			'image_link' => '/products/tire_chains/tire_chains.png',
			'product_link' => '/products/tire_chains/tire_chains.php',
		],
	];
}

function get_all_products() {
	$products = array_values(get_product_catalog());

	usort($products, function ($left, $right) {
		return strcmp($left['title'], $right['title']);
	});

	return $products;
}

function get_product_by_slug($slug) {
	$catalog = get_product_catalog();

	if (!isset($catalog[$slug])) {
		return null;
	}

	return $catalog[$slug];
}

function get_product_page_model($slug) {
	$product = get_product_by_slug($slug);

	if ($product === null) {
		return null;
	}

	return new Product(
		$product['title'],
		$product['description'],
		$product['price'],
		$product['image_link']
	);
}

function make_catalog_product_page($slug) {
	$product = get_product_page_model($slug);

	if ($product === null) {
		http_response_code(404);
		echo 'Product not found.';
		return;
	}

	make_product_page($product);
}
