<h1>GALERY</h1>

<?php foreach ($posts as $post): ?>
    <img src="<?= $post->photo_path; ?>" alt="">
<?php endforeach; ?>
