<?php 
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$_SESSION['token'] = $token;
?>

<section class="section">
  <div class="container">
    <h1 class="title">New post</h1>
    <p class="title is-size-6">You have a webcam? Take a selfie <a href="index.php?p=post_webcam">here</a>.</p>
  </div>
</section>

<div class="container">
  <form method="post" action="index.php?p=post_upload" enctype="multipart/form-data">
    <label for="img"><span class="title is-size-5 tag is-warning">Upload an image</span></label><br />
    <label for="img">(PNG only | max. 1 Mo)</label><br />
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <div class="file has-name">
            <label class="file-label">
              <input class="file-input" type="file" name="img" id="img">
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                  Choose a file…
                </span>
              </span>
              <span id="filename" class="file-name">
              </span>
            </label>
          </div>
        </div>
        <div class="level-item">
          <input id="button_upload" class="button is-static" type="submit" name="submit" value="Upload" />
        </div>
      </div>
    </div>
  </form>
</div>

<section class="section">
  <div class="container">
    <div class="tile is-ancestor">
      <div class="tile is-10 is-vertical is-parent">
        <div class="tile is-child box">
            <figure class="image is-800x600">
                <img id="uploaded_img" src="<?= isset($filename) ? './app/assets/images/user_img/'.$filename : './app/assets/images/site/placeholder_img.png'?>" alt="">
            </figure>
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
          <div div_post="<?= $post->id_post?>" class="thumbnail_container">
            <img class="thumbnail" src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
            <div class="thumbnail_overlay">
              <a id_post="<?= $post->id_post?>" class="delete"></a>
            </div>
          </div>
        <?php } endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<input type="hidden" name="token" id="token" value="<?= $token; ?>" />

<script type="text/javascript" src="./app/assets/js/postUpload.js"></script>


