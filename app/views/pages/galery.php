<h1>GALERY</h1>

<?php foreach ($posts as $post): ?>
<!-- <?php var_dump($post) ?> -->
<div class="post_container">
    <div class="post_header">
        <p><?= $post->username; ?></p>
    </div>
    <img src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
    <div class="post_footer">
        <button class="like_btn" id_post="<?= $post->id_post; ?>">Like</button>
        <a href="<?= 'index.php?p=viewPost&id='.$post->id_post; ?>">Comment</a>
        <div class="likes">
            <p id_post_show_likes="<?= $post->id_post; ?>"><?= $post->likes_count ? $post->likes_count : 0; ?></p>
            <p> Likes</p>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script type="text/javascript">
<?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
    let currentUsername = "<?= $_SESSION['username']; ?>";
    let currentUserID = "<?= $_SESSION['id_user']; ?>";
<?php } ?>
</script>
<script type="text/javascript" src="./app/assets/js/galery.js"></script>


<div id="message" style="color:red;"></div>