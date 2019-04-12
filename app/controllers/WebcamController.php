<?php
session_start();

// var_dump(__DIR__);

if( isset($_POST['dst_img']) && isset($_POST['src_img']) && isset($_POST['placement_x']) && isset($_POST['placement_y']) ){
	// echo "OK\n";
	// sprintf("%s", $_POST['dst_img']);
	$img = $_POST['dst_img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$filedata = base64_decode($img);

	//saving
	$filename = '../assets/images/post_img/dst.png';
	file_put_contents($filename, $filedata);

	// $img1 = base64_decode($img);


	$img1 = "../assets/images/post_img/dst.png";
	$img2 = "../assets/images/stickers/" . basename($_POST['src_img']);
	
	
	$dest = imagecreatefrompng($img1);
	$src = imagecreatefrompng($img2);
	imagecolortransparent($src, imagecolorat($src, 0, 0));
	
	$src_x = imagesx($src);
	$src_y = imagesy($src);

	// echo $src_x." ".$src_y;

	$placement_x = intval($_POST['placement_x']);
	$placement_y = intval($_POST['placement_y']);

	imagecopy($dest, $src, $placement_x, $placement_y, 0, 0, $src_x, $src_y);


	// Output and free from memory
	$timestamp = time();
	$filename = $timestamp.'.png';
	$filepath = '../assets/images/post_img/'.$filename;
	imagepng($dest, $filepath);

	require 'PostsController.php';
	// require './app/controllers/PostsControllers.php';
	createPost($filename, $_SESSION['id_user']);

	imagedestroy($dest);
	imagedestroy($src);


// save image with unique name timestamp
// insert into db



} else {
	print_r($_POST);;
}