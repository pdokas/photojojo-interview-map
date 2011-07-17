<?php

	require('lib.php');

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
	
	$view_data['order_data'] = getOrderData();
	$view_data['monster']    = getMonster();
	$view_data['path']       = getPath();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Status</title>
</head>

<body>
	<div id="mapHolder">
		<img src="img/map.png" />
		
		<img src="<?php echo $view_data['monster']; ?>" />
		<img src="<?php echo $view_data['path']; ?>" />
	</div>
</body>
</html>
