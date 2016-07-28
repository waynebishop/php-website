<?php $this->layout('master'); ?>

<body>

 <?= $this->insert('nav') ?>

<h1>Edit Post: <?= htmlentities($originalTitle) ?></h1>	
<!--  -->
<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data">
	
	<div>
		<label for="title">Title: </label>
		<input type="text" id="title" name="title" value="<?= $post['title'] ?>">	
	</div>

	<?= isset($titleError) ? $titleError : '' ?>	

	<div>
		<label for="desc">Description: </label>
		<textarea id="desc" name="description"><?= $post['description'] ?></textarea>
	</div>

	<?= isset($descError) ? $descError : '' ?>	

	<img src="img/uploads/stream/<?= $post['image'] ?>" alt="">

	<input type="file" name="image">

	<input type="submit" name="edit-post">
	<?= isset($upateMessage) ? $updateMessage : '' ?>		

</form>
