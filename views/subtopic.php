
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
		<?php
			require("navBar.php");
		?>
		<!-- <nav class="navbar navbar-default"> -->
			<div class="jumbotron">
			  <h1><?php echo $subtopicrow['name']?></h1>
			  <p><?php echo $subtopicrow['subtopic_text']?></p>
			  
			</div>
		<!-- </nav> -->
		<div class="col-md-12">
			<form action="/PHP_Forum/postNewComment.php" method="POST">
				<input type="hidden" name= "subtopic_id" value="<?php echo $subtopicrow['id']?>">
				<textarea id="comment_area" class="form-control" name="comment" ></textarea>
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
				<div class="modal fade" id="updateCommentModal<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					  	<form action="/PHP_Forum/updateComment.php" method="POST">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        
					      </div>

					      <div class="modal-body">

					        <div class="input-group" style="margin: auto auto ; width:90%">
									
								<input type="hidden" name="comment_id" value="<?php echo $row['id']?>">
								<input type="hidden" name= "subtopic_id" value="<?php echo $row['subtopic_id']?>">
								<input type="hidden" name= "user_id" value="<?php echo $row['user_id']?>">

								<textarea id="comment_area" class="form-control" name="comment"><?php echo $row['comment_text']?></textarea>

								

							</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Update</button>
					      </div>
					    </div>
						</form>
					  </div>
					</div>
				
				<div class="col-md-10">
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
				  		
				  		<span class="pull-right">
							<button  class="btn btn-info btn-xs" data-toggle="modal" style="margin-top: -40px"  data-target="#updateCommentModal<?php echo $row['id']?>">Update</button>
						</span>
						
				  		<form action="/PHP_Forum/deleteComment.php" method="POST"> 
				  			<input type="hidden" name="comment_id" value="<?php echo $row['id']?>">
				  			<input type="hidden" name = "subtopic_id" value="<?php echo $row['subtopic_id']?>">
				  			
				  		<button  type="submit"  class="close pull-right" aria-label="Close" style="margin-top: -30px ; margin-right:70px" >
					        <span  aria-hidden="true">&times;</span>
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



