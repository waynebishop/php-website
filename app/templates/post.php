<?php 

	$this->layout('master', [
		'title'=>'Post page',
		'desc'=>'View individual post'
	]);

?>

<body>

 <?= $this->insert('nav') ?>

<h1><?= htmlentities($post['title']) ?></h1>

<p><?= htmlentities($post['description']) ?></p>

<img src="img/uploads/original/<?= $post['image'] ?>" alt="">

<ul>
	<li>Post created: <?= $post['created_at'] ?></li>
	<li>Post updated: <?= $post['updated_at'] ?></li>
	<li>Posted by: <?= htmlentities($post['first_name'].' '.$post['last_name']) ?> </li>
	<?php 

		if( isset($_SESSION['id']) ) {

			if( $_SESSION['id'] == $post['user_id'] || $_SESSION['privilege'] == 'admin' ) {
				// You own the post
				?>
				<li>
					<a href="index.php?page=edit-post&id=<?= $_GET['postid'] ?>">Edit</a>
				</li>
				<li>
					<button id="delete-post">Delete</button>
					<div id="delete-post-options">
						<a href="<?= $_SERVER['REQUEST_URI'] ?>&delete">Yes</a> / <button>No</button>
					</div>
				</li>

				<?php

			}

		}

	?>
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
				if( $_SESSION['id'] == $comment['user_id'] || $_SESSION['privilege'] == 'admin' ) {

					// Yes! This user owns the comemnts
					echo '<a href="">Delete</a> ';
					echo '<a href="index.php?page=edit-comment&id='.$comment['id'].'">Edit</a>';

				}

 			}

		?>

	</article>	

	<?php endforeach ?> 	


</section>


<script>
	// wait for all th stuff to be ready
	$(document).ready(function() {
		// When the user clicks on the delete button
		$('#delete-post, #delete-post-options button').click(function(){
			// Toggle the visibility of the controls
			$('#delete-post-options').toggle();

		});



	});
	
</script>




