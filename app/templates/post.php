<?php 

	$this->layout('master', [
		'title'=>'Post page',
		'desc'=>'View individual post'
	]);

?>

<body>

<h1><?= $post['title'] ?></h1>

<p><?= $post['description'] ?></p>

<img src="img/uploads/original/<?= $post['image'] ?>" alt="">

<ul>
	<li>Post created: <?= $post['created_at'] ?></li>
	<li>Post updated: <?= $post['updated_at'] ?></li>
	<li>Posted by: <?= $post['first_name'].' '.$post['last_name'] ?> </li>
</ul>

<section>
	
	<h1>Comments: (<?= count($allComments) ?>)</h1>	

	<form action="index.php?page=post&postid=<?= $_GET['postid'] ?>" method="post">

		<label for="comment">Write a comment: </label>
		<textarea name="comment" id="comment" cols="30" rows="10" ></textarea>
		<input type="submit" name="new-comment" value="Submit">	

	</form>
	
	<?php foreach($allComments as $comment): ?>

	<!-- htmlentities will take any script text eg < and > and change to safe text eg &lt and &gt  -->	

	<article>
		<p><?= htmlentities($comment['comment']) ?></p>
		<small>Written by: <?= htmlentities($comment['author']) ?></small>

		<?php

			// Is this the visitor logged in?
			if( isset($_SESSION['id']) ) {

				// Does this user own the comment?
				if( $_SESSION['id'] == $comment['user_id'] ) {

					// Yes! This user owns the comemnts
					echo 'Delete ';
					echo 'Edit';

				}

 			}

		?>

	</article>	

	<?php endforeach ?> 	


</section>





