<h1>GALERY</h1>

<?php foreach ($data = $db->query('SELECT * FROM posts') as $post): ?>
    <img src="<?= $post->photo_path; ?>" alt="">
<?php endforeach; ?>
