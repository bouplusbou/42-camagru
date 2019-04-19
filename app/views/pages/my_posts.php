<h1>MY POSTS</h1>

<?php foreach ($user_posts as $user_post): ?>
<!-- <?php var_dump($user_post) ?> -->
<div div_post="<?= $user_post->id_post; ?>" class="post_container">
    <div class="post_header">
        <p><?= $user_post->username; ?></p>
    </div>
    <img src="<?= './app/assets/images/post_img/'.$user_post->photo_name; ?>" alt="">
    <div class="post_footer">
    <?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
        <button class="like_btn" id_post="<?= $user_post->id_post; ?>">Like</button>
    <?php } ?>
        <a href="<?= 'index.php?p=view_post&id='.$user_post->id_post; ?>">View comments</a>
        <button class="delete_btn" id_post="<?= $user_post->id_post; ?>">Delete post</button>
        <div class="likes">
            <p id_post_show_likes="<?= $user_post->id_post; ?>"><?= $user_post->likes_count ? $user_post->likes_count : 0; ?></p>
            <p> Likes</p>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php if (isset($_SESSION['username']) && isset($_SESSION['id_user'])) { ?>
<script type="text/javascript">
    let currentUsername = "<?= $_SESSION['username']; ?>";
    let currentUserID = "<?= $_SESSION['id_user']; ?>";
</script>
<script type="text/javascript" src="./app/assets/js/myPosts.js"></script>
<?php } ?>


<div id="message" style="color:red;"></div>