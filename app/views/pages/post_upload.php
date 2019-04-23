<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">New post</h1>
  </div>
</section>

<div class="img_wrap">
	<img id='uploaded_img' src="<?= './app/assets/images/user_img/'.$filename ?>" alt="">
    <div id="overlay"></div>
</div>

<div id="control">
</div>

<a href="index.php?p=post_webcam">Use webcam</a>

<form method="post" action="index.php?p=post_upload" enctype="multipart/form-data">
    <label for="img">Upload an image (PNG only | max. 1 Mo) :</label><br />
    <input type="file" name="img" id="img" /><br />
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
    <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
    <input type="submit" name="submit" value="Envoyer" />
</form>



<div id="sticker_container">
<?php foreach ($stickers as $sticker): ?>
	<div class="sticker">
    	<img src="<?= './app/assets/images/stickers/'.$sticker.'.png'; ?>" alt="">
	</div>
<?php endforeach; ?>
</div>

<div id="thumbnails_container">
<?php foreach ($posts as $post): 
	if ($post->id_user === $_SESSION['id_user']) {?>
    <img src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
<?php } endforeach; ?>
</div>

<div id="message" style="color:red;"></div>

<script type="text/javascript" src="./app/assets/js/postUpload.js"></script>