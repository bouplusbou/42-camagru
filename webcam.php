<?php

if( isset($_POST['src_img']) ){

	$img = $_POST['src_img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	//saving
	$fileName = 'photo.png';
	file_put_contents($fileName, $fileData);

	// $imgl = base64_decode($img);

	$imgl = "photo.png";
	$img2 = "logo_artsy_blue.png";
	
	$dest = imagecreatefrompng($imgl);
	$src = imagecreatefrompng($img2);
	imagecolortransparent($src, imagecolorat($src, 0, 0));
	
	$src_x = imagesx($src);
	$src_y = imagesy($src);
	imagecopymerge($dest, $src, 0, 0, 0, 0, $src_x, $src_y, 100);


	// Save final result
	$fileName = 'final.png';
	// file_put_contents($fileName, $dest);
	
	// Output and free from memory
	header('Content-Type: image/png');
	// imagepng($dest);
	imagepng($dest, $fileName);
	
	imagedestroy($dest);
	imagedestroy($src);
}