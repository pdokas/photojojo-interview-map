<?php

	$map   = imagecreatefrompng('img/map.png');
	$path  = imagecreatefrompng($_GET['path']);
	
	$angle = $_GET['angle'];
	
	$path = imagerotate($path, $angle, 0); // might need to mark param 3 as transparent with imagecolortransparent
	
	imagecopy($map, $path, 0,0, 0,0, imagesx($path),imagesy($path));
	
	// Deliver and release the image (and the bees)
	header('Content-Type: image/png');
	imagepng($map);
	imagedestroy($map);

?>
