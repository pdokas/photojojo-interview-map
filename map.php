<?php

	$map_dimensions = array(
		'padding' => array(
			'left'   => 154,
			'right'  => 888,
			'top'    => 54,
			'bottom' => 443
		),
		'latlng' => array(
			'left'   => -124.3,
			'right'  => -67.1,
			'top'    => 50,
			'bottom' => 26.2
		),
		'ratios' => array(
			'x' => 12.83216788, // unit: px/deg
			'y' => 16.34453789  // unit: px/deg
		)
	);
	
	list($start_x, $start_y) = explode(',', $_GET['start']);
	list($end_x, $end_y)     = explode(',', $_GET['end']);
	
	// Load images
	$map  = imagecreatefrompng('img/map.png');
	$path = imagecreatefrompng($_GET['path']);
	
	// Calculate path rotation
	$y_delta = abs($end_y - $start_y);
	$x_delta = abs($end_x - $start_x);
	$angle   = abs(rad2deg(tan($y_delta / $x_delta)));
	
	// Calculate path reduction
	$path_width  = imagesx($path);
	$path_height = imagesy($path);
	
	$path_width_deg  = $path_width / $map_dimensions['ratios']['x'];
	$path_height_deg = $path_height / $map_dimensions['ratios']['y'];
	
	$new_path_width  = $path_width * ($x_delta / $path_width_deg);
	$new_path_height = $path_height * ($y_delta / $path_height_deg);
	
	// Resize path
	$resized_path = imagecreatetruecolor($new_path_width, $new_path_height);
	$clear = imagecolorallocatealpha($resized_path, 0, 0, 0, 127);
    imagefill($resized_path, 0, 0, $clear);
	
	imagecopyresampled($resized_path, $path, 0,0, 0,0, $new_path_width,$new_path_height, $path_width,$path_height);
	
	// Rotate path
	$resized_path = imagerotate($resized_path, $angle, 0);
	
		// Do translation portion
		$point_x = ($new_path_width / 2) - abs(cos(deg2rad($angle)) * ($new_path_width / 2));
		$point_x = ceil($point_x);
		
		$point_y = $new_path_height / 2;
		$point_y += abs(sin(deg2rad($angle)) * $new_path_width / 2);
		$point_y = ceil($point_y);
		
		$dest_x = $map_dimensions['padding']['left'];
		$dest_x += abs($end_x - $map_dimensions['latlng']['left']) * $map_dimensions['ratios']['x'];
		
		$dest_y = $map_dimensions['padding']['top'];
		$dest_y += abs($end_y - $map_dimensions['latlng']['top']) * $map_dimensions['ratios']['y'];
		
		$diff_x = ceil(abs($dest_x - $point_x));
		$diff_y = ceil(abs($dest_y - $point_y));
	
	// Layer path onto map
	imagecopy($map, $resized_path, $diff_x,$diff_y, 0,0, imagesx($resized_path),imagesy($resized_path));
	
	// Deliver and release the image (and the bees)
	header('Content-Type: image/png');
	imagepng($map);
	imagedestroy($map);

?>
