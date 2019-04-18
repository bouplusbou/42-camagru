<?php
session_start();

if( isset($_POST['img_data']) && isset($_POST['sticker_src']) && isset($_POST['placement_x']) && isset($_POST['placement_y']) ){
	$img = $_POST['img_data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$filedata = base64_decode($img);

	//saving
	$filename = '../assets/images/post_img/dst.png';
	file_put_contents($filename, $filedata);

	$img_src = "../assets/images/post_img/dst.png";
	$sticker_src = "../assets/images/stickers/" . basename($_POST['sticker_src']);
	
	$img = imagecreatefrompng($img_src);
	$sticker = imagecreatefrompng($sticker_src);
	imagecolortransparent($sticker, imagecolorat($sticker, 0, 0));
	
	$sticker_x = imagesx($sticker);
	$sticker_y = imagesy($sticker);

	$placement_x = intval($_POST['placement_x']);
	$placement_y = intval($_POST['placement_y']);

	imagecopy($img, $sticker, $placement_x, $placement_y, 0, 0, $sticker_x, $sticker_y);

	// Output and free from memory
	$timestamp = time();
	$filename = $timestamp.'.png';
	$filepath = '../assets/images/post_img/'.$filename;
	imagepng($img, $filepath);

	require 'PostsController.php';
	createPost($filename, $_SESSION['id_user']);

	imagedestroy($img);
	imagedestroy($sticker);

} else {
	print_r($_POST);;
}