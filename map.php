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
	
	list($warehouse_x, $warehouse_y) = explode(',', $_GET['start']);
	list($dest_x, $dest_y)           = explode(',', $_GET['end']);
	
	// Load images
	$map  = imagecreatefrompng('img/map.png');
	$path = imagecreatefrompng($_GET['path']);
	
	// Calculate path rotation
	$route_x = abs($dest_x - $warehouse_x);
	$route_y = abs($dest_y - $warehouse_y);
	$angle   = abs(rad2deg(tan($route_y / $route_x)));
	
	// Calculate path reduction
	$path_width  = imagesx($path);
	$path_height = imagesy($path);
	
	$path_width_deg  = $path_width / $map_dimensions['ratios']['x'];
	$path_height_deg = $path_height / $map_dimensions['ratios']['y'];
	
	$new_path_width  = $path_width * ($route_x / $path_width_deg);
	$new_path_height = $path_height * ($route_y / $path_height_deg);
	
	// Resize path
	$resized_path = imagecreatetruecolor($new_path_width, $new_path_height);
	$clear_color  = imagecolorallocatealpha($resized_path, 0, 0, 0, 127);
    imagefill($resized_path, 0, 0, $clear_color);
	
	imagecopyresampled($resized_path, $path, 0,0, 0,0, $new_path_width,$new_path_height, $path_width,$path_height);
	
	// Rotate path
	$resized_path = imagerotate($resized_path, $angle, 0);
	
	// Translate path
	$route_midpoint_x = ($warehouse_x + $dest_x) / 2;
	$route_midpoint_y = ($warehouse_y + $dest_y) / 2;
	
	$midpoint_pct_across_map_x = ($route_midpoint_x - $map_dimensions['latlng']['left']) / ($map_dimensions['latlng']['right'] - $map_dimensions['latlng']['left']);
	$midpoint_pct_across_map_y = ($route_midpoint_y - $map_dimensions['latlng']['top']) / ($map_dimensions['latlng']['bottom'] - $map_dimensions['latlng']['top']);
	
	$route_midpoint_px_x = $midpoint_pct_across_map_x * ($map_dimensions['padding']['right'] - $map_dimensions['padding']['left']);
	$route_midpoint_px_y = $midpoint_pct_across_map_y * ($map_dimensions['padding']['bottom'] - $map_dimensions['padding']['top']);
	
	$route_midpoint_px_x += $map_dimensions['padding']['left'] - ($new_path_width / 2);
	$route_midpoint_px_y += $map_dimensions['padding']['top'] - ($new_path_height / 2);
	
	// Layer path onto map
	imagecopy($map, $resized_path, $route_midpoint_px_x,$route_midpoint_px_y, 0,0, imagesx($resized_path),imagesy($resized_path));
	
	// Deliver and release the image (and the bees)
	header('Content-Type: image/png');
	imagepng($map);
	imagedestroy($map);

?>
