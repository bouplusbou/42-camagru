<?php

if( isset($_POST['dst_img']) && isset($_POST['src_img']) && isset($_POST['placement_x']) && isset($_POST['placement_y']) ){

	echo "OK\n";
	echo $_POST['placement_x'];
	// sprintf("%s", $_POST['dst_img']);
	$img = $_POST['dst_img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$fileName = 'src_images/dst.png';
	file_put_contents($fileName, $fileData);

	// $imgl = base64_decode($img);



	$imgl = "src_images/dst.png";
	$img2 = "src_images/" . basename($_POST['src_img']);
	
	sprintf("%s %s\n", $imgl, $img2);
	
	$dest = imagecreatefrompng($imgl);
	$src = imagecreatefrompng($img2);
	imagecolortransparent($src, imagecolorat($src, 0, 0));
	
	$src_x = imagesx($src);
	$src_y = imagesy($src);


	$placement_x = intval($_POST['placement_x']);
	$placement_y = intval($_POST['placement_y']);

	imagecopy($dest, $src, $placement_x, $placement_y, 0, 0, $src_x, $src_y);


	// Output and free from memory
	$fileName = 'final.png';
	imagepng($dest, $fileName);
	
	imagedestroy($dest);
	imagedestroy($src);
} else {
	print_r($_POST);;
}