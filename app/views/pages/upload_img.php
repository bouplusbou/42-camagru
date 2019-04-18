<?php
$maxsize = 1048576;
if ($_FILES['img']['size'] > $maxsize) {
    echo "Le fichier est trop gros";
    exit;
}
$valid_ext = array( 'png' );
$file_ext = strtolower(  substr(  strrchr($_FILES['img']['name'], '.')  ,1)  );
if (!in_array($file_ext, $valid_ext)) {
    echo "Extension incorrecte";
    exit;
}
$name = __DIR__."/../../assets/images/user_img/1.png";
$res = move_uploaded_file($_FILES['img']['tmp_name'],$name);

function resize_imagepng($file, $w, $h) {
    list($width, $height) = getimagesize($file);
    $src = imagecreatefrompng($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    return $dst;
}
$img = resize_imagepng(__DIR__."/../../assets/images/user_img/1.png", 640, 480);
imagepng($img, __DIR__."/../../assets/images/user_img/1.png");

?>

