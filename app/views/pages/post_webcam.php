<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">New post</h1>
    <p class="title is-size-6">Don't have a webcam? Upload an image <a href="index.php?p=post_upload">here</a>.</p>
  </div>
</section>





<section class="section">
  <div class="container">
    <div class="tile is-ancestor">
      <div class="tile is-10 is-vertical is-parent">
        <div class="tile is-child box">
          <video id="video" playsinline autoplay>
            </video>
            <div id="overlay"></div>
          
        </div>
        <div class="tile is-child has-text-centered">
          <button id="button_snap" class="button is-info is-static">Snap</button>
        </div>
        <div class="tile is-child box">
          <div id="sticker_container" class="level">
          <?php foreach ($stickers as $sticker): ?>
            <div class="level-item sticker">
                <img src="<?= './app/assets/images/stickers/'.$sticker.'.png'; ?>" alt="">
            </div>
          <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="tile is-parent">
        <div id="thumbnails_container" class="tile is-child box">
          <p id="last_posts_title" class="title is-size-5" ><span class="tag is-info">Last posts</span></p>
        <?php foreach ($posts as $post): 
        	if ($post->id_user === $_SESSION['id_user']) {?>
            <img class="thumbnail" src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
        <?php } endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/postWebcam.js"></script>












<!-- <section class="section">
  <div class="container">
    <div class="columns">
      <div class="column is-three-quarters">
        <figure class="image is-800x600">
          <video id="video" playsinline autoplay></video>
        </figure>
        <div id="overlay"></div>
        <div id="sticker_container">
          <div class="level">
          <?php foreach ($stickers as $sticker): ?>
            <div class="level-item sticker">
                <img src="<?= './app/assets/images/stickers/'.$sticker.'.png'; ?>" alt="">
            </div>
          <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="column"></div>
    </div>
  </div>
</section>


<div class="video_wrap">

</div>


<div id="control">
</div>


<form method="post" action="index.php?p=post_upload" enctype="multipart/form-data">
     <label for="img">Upload an image (PNG only | max. 1 Mo) :</label><br />
     <input type="file" name="img" id="img" /><br />
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	 <input type="hidden" name="token" id="token" value="<?= $token; ?>" />
     <input type="submit" name="submit" value="Envoyer" />
</form>



<div id="thumbnails_container">
<?php foreach ($posts as $post): 
	if ($post->id_user === $_SESSION['id_user']) {?>
    <img src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
<?php } endforeach; ?>
</div>

<div id="message" style="color:red;"></div> -->

