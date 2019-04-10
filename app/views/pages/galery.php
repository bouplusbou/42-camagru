<h1>GALERY</h1>


<?php foreach ($posts as $post): ?>
<?php var_dump($posts); ?>
    <img src="<?= $post->photo_path; ?>" alt="">
<?php endforeach; ?>
