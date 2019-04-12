<h1>GALERY</h1>

<?php foreach ($posts as $post): ?>
<?php var_dump($post) ?>
<div class="post_container">
    <div class="post_header">
        <p><?= $post->username; ?></p>
    </div>
    <img src="<?= './app/assets/images/post_img/'.$post->photo_name; ?>" alt="">
    <div class="post_footer">
        <a href="">Like</a>
        <a href="<?= 'index.php?p=viewPost&id='.$post->id_post; ?>">Comment</a>
        <p>1540 Likes</p>
        <p><b>Kiki</b> Impressive work !!!</p>
    </div>
</div>
<?php endforeach; ?>
