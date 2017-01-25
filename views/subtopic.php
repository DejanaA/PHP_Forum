
<?php
	
	require("../db.php");
	require("../session.php");
	if (isset($_GET['subtopic'])) {
		$id = $_GET['subtopic'];
		if ($id == "") {
			header("Location : home.php");
		}
		$sql = "SELECT * FROM sub_topic WHERE id = '$id'";
		$results = $connection->query($sql);
		$subtopicrow = $results->fetch_assoc();

		$sql2 = "SELECT * FROM comments WHERE subtopic_id = '$id'";
		$comments_result = $connection->query($sql2);

	}
	
?>
<html>
<head>
	<title></title>
	<?php
		require("../scripts/cssScripts.css");
	?>
	<link rel="stylesheet" type="text/css" href="/PHP_Forum/style/style.css">
</head>
<body>

	<div class= "container">
		<!-- <nav class="navbar navbar-default"> -->
			<div class="jumbotron">
			  <h1><?php echo $subtopicrow['name']?></h1>
			  <p><?php echo $subtopicrow['subtopic_text']?></p>
			  
			</div>
		<!-- </nav> -->
		<div class="col-md-12">
			<form action="/PHP_Forum/postNewComment.php" method="POST">
				<input type="hidden" name= "subtopic_id" value="<?php echo $subtopicrow['id']?>">
				<textarea id="comment_area" class="form-control"name="comment" ></textarea>
				<button id="btn_post" class="btn btn-default" type="submit" >Post</button>
			</form>
		</div>
		<?php
			if ($comments_result->num_rows > 0) {
			while ($row = $comments_result->fetch_assoc()) {
				$user_id = $row['user_id'];
				$sql3 = "SELECT * FROM users WHERE id ='$user_id' ";
				$user_results = $connection->query($sql3);
				$user_row = $user_results->fetch_assoc();
				?>
				<div class="col-md-12">
				<hr>
				<div class="media">
				  <div class="media-left media-middle">
				    <a href="#">
				      
				    </a>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"><?php echo $user_row['first_name'] . " " . $user_row['last_name'] ?> </h4>
				    <?php echo $row['comment_text'] ?>
				  </div>
				  <?php 
				  	if ($loged_user_id == $row['user_id']) {
				  		?>
				  		<form action="/PHP_Forum/deleteComment.php" method="POST">
				  			<input type="hidden" name="comment_id" value="<?php echo $row['id'];?>">
				  			<input type="hidden" name = "subtopic_id" value="<?php echo $row['subtopic_id']?>">
				  		<button type="submit"  class="close" aria-label="Close">
					        <span aria-hidden="true">&times;</span>
					    </button>
					    </form>
				  		<?php
				  	}
				  ?>
				</div>
				</div>
				<?php
			}
		}
		?>
	</div>

	<?php
	require("../scripts/jsScripts.php");
	?>
</body>
</html>



