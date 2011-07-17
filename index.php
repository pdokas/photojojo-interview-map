<?php

/* Stub Data */

$orders = array(
	array(
		'id'       => 'NDP-CMIFS',
		'name'     => 'Bart Simpson',
		'address'  => '1243 Marlborough, Ann Arbor, MI 48104',
		'tracking' => '9101901000704027882045',
		'geocode'  => array(
			'lat'  => 42.25184,
			'lng'  => -83.73086
		)
	),
	array(
		'id'       => 'NDP-FNORD',
		'name'     => 'Fox Mulder',
		'address'  => '201 N Main St., Roswell, NM 88201',
		'tracking' => '1ZE587150331792478',
		'geocode'  => array(
			'lat'  => 33.39440,
			'lng'  => -104.52262
		)
	),
	array(
		'id'       => 'NDP-NARF',
		'name'     => 'Baron Von Savings',
		'address'  => '398 Lucky St., Truth or Consequences, NM 87901',
		'tracking' => 'LF002345052US',
		'geocode'  => array(
			'lat'  => 33.13417,
			'lng'  => -107.23851
		)
	)
);

/* Setup basic view data */

$view_data = array();

// Setup order ID
if (isset($_GET['order'])) {
	$view_data['order'] = $_GET['order'];
}
else {
	$view_data['order'] = rand(0, count($orders) - 1);
}

// Cache order data object
$view_data['order_data'] = $orders[$view_data['order']];

// Setup monster ID
if (isset($_GET['monster'])) {
	$view_data['monster'] = $_GET['monster'];
}
else {
	$num_monsters = count(glob('img/monsters/*.png'));
	
	$view_data['monster'] = base_convert($view_data['order_data']['id'], 32, 10) % $num_monsters;
}

// Setup path ID
if (isset($_GET['path'])) {
	$view_data['path'] = $_GET['path'];
}
else {
	$num_paths = count(glob('img/paths/*.png'));

	$view_data['path'] = base_convert($view_data['order_data']['name'], 32, 10) % $num_paths;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Status</title>
</head>

<body>
	<?php echo $view_data['monster']; ?><br />
	<?php echo $view_data['path']; ?><br />
</body>
</html>
