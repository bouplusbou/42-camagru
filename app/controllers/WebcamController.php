<?php

if( isset($_POST['dst_img']) && isset($_POST['src_img']) && isset($_POST['placement_x']) && isset($_POST['placement_y']) ){
	// echo "OK\n";
	// sprintf("%s", $_POST['dst_img']);
	$img = $_POST['dst_img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);

	//saving
	$fileName = '../assets/images/post_img/dst.png';
	file_put_contents($fileName, $fileData);

	// $img1 = base64_decode($img);


	$img1 = "../assets/images/post_img/dst.png";
	$img2 = "../assets/images/stickers/" . basename($_POST['src_img']);
	
	
	$dest = imagecreatefrompng($img1);
	$src = imagecreatefrompng($img2);
	imagecolortransparent($src, imagecolorat($src, 0, 0));
	
	$src_x = imagesx($src);
	$src_y = imagesy($src);

	echo $src_x." ".$src_y;

	$placement_x = intval($_POST['placement_x']);
	$placement_y = intval($_POST['placement_y']);

	imagecopy($dest, $src, $placement_x, $placement_y, 0, 0, $src_x, $src_y);


	// Output and free from memory
	$fileName = '../assets/images/post_img/final1.png';
	imagepng($dest, $fileName);

	imagedestroy($dest);
	imagedestroy($src);
} else {
	print_r($_POST);;
}