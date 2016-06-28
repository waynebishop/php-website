<?php 

	$this->layout('master', [
		'title'=>'Post page',
		'desc'=>'View individual post'
	]);

?>

<body>

<h1><?= $post['title'] ?></h1>

<p><?= $post['description'] ?></p>

<img src="img/uploads/highres/<?= $post['image'] ?>" alt="">

<ul>
	<li>Post created: <?= $post['created_at'] ?></li>
	<li>Post updated: <?= $post['updated_at'] ?></li>
</ul>






