<?php

	require('lib.php');

	/* Stub Data */
	$orders = array(
		array(
			'id'            => 'NDP-CMIFS',
			'name'          => 'Bart Simpson',
			'address'       => '1243 Marlborough, Ann Arbor, MI 48104',
			'geocode'       => array(
				'lng'       => -83.73086,
				'lat'       => 42.25184
			),
			'tracking'      => '9101901000704027882045',
			'order_date'    => strtotime('-1 day'),
			'delivery_date' => strtotime('+2 days')
		),
		array(
			'id'            => 'NDP-FNORD',
			'name'          => 'Fox Mulder',
			'address'       => '201 N Main St., Roswell, NM 88201',
			'geocode'       => array(
				'lng'       => -104.52262,
				'lat'       => 33.39440
			),
			'tracking'      => '1ZE587150331792478',
			'order_date'    => strtotime('-2 days'),
			'delivery_date' => strtotime('+3 days')
		),
		array(
			'id'            => 'NDP-NARF',
			'name'          => 'Baron Von Savings',
			'address'       => '398 Lucky St., Truth or Consequences, NM 87901',
			'geocode'       => array(
				'lng'       => -107.23851,
				'lat'       => 33.13417
			),
			'tracking'      => 'LF002345052US',
			'order_date'    => strtotime('-3 days'),
			'delivery_date' => strtotime('+1 day')
		)
	);
	
	$map_dimensions = array(
		'padding' => array(
			'top'    => 54,
			'right'  => 888,
			'bottom' => 443,
			'left'   => 154
		),
		'latlng'  => array(
			'top'    => 50,
			'right'  => -67.1,
			'bottom' => 26.2,
			'left'   => -124.3
		),
		'warehouse' => array('lng' => -85.3, 'lat' => 38.8)
	);
	
	// Populate view data
	$view_data                = array();
	$view_data['order_data']  = getOrderData();
	$view_data['monster']     = getMonster();
	$view_data['monster_pos'] = getMonsterPos();
	$view_data['path']        = getPath();
	$view_data['path_angle']  = computePathAngle($view_data['order_data']['geocode']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Status</title>
	<link rel="stylesheet" href="css/map.css" type="text/css" media="screen" />
</head>

<body>
	<p id="debug">
		Going to: <?php echo $view_data['order_data']['address']; ?>
	</p>
	<div id="mapHolder">
		<img src="map.php?angle=<?php echo $view_data['path_angle']; ?>&path=<?php echo $view_data['path']; ?>" />
		
		<img src="<?php echo $view_data['monster']; ?>" class="<?php echo $view_data['monster_pos']; ?>" />
	</div>
</body>
</html>
