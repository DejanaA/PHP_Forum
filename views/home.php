<?php
	require("../session.php");
	require("../db.php");
$sql = "SELECT * FROM topic ";
$results = $connection->query($sql);
	
?>


<html>
<head>
	<title>Home page</title>
	<?php
		require("../scripts/cssScripts.css");
	?>
	<link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
	<div class="modal fade" id="addTopicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					  	<form action="../addTopic.php" method="POST">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <h4 class="modal-title" id="myModalLabel">Add Topic</h4>
					      </div>

					      <div class="modal-body">

					        <div class="input-group" style="margin: auto auto ; width:90%">
									
									<input  type="text" name="topicName" class="form-control" />
									<input type="hidden" name="userid" class="form-control" value="<?php echo $loged_user_id?>">
									<textarea id="topicDesc" name="topicDescription" class="form-control"></textarea>

									
							</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Add</button>
					      </div>
					    </div>
						</form>
					  </div>
	</div>

	<div class= "container">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">PHP Forum</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a data-toggle="modal" data-target="#addTopicModal" href="#">Add Topic</a></li>
		       
		      </ul>
		     
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#"><?php echo $loged_user_name . " " .  $loged_user_lastname ?>
		        			<?php if ($loged_user_r == 1) {
		        				?>
		        				(Admin)
		        				<?php
		        			}?>
		        </a></li>
		        <li class="dropdown">
		          <a href="../logout.php" class="dropdown-toggle"  role="button" aria-haspopup="true" aria-expanded="false">Log out </a>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		<?php
			if ($results->num_rows > 0) {
				while($row = $results->fetch_assoc()){
					$topic_id = $row['id'];
				    $topic_subtopics_sql = "SELECT topic.id AS topic_id , topic.topic_name, sub_topic.id AS sub_topic_id FROM topic INNER JOIN sub_topic ON topic.id = sub_topic.topic_id WHERE topic.id = '$topic_id'";
					$topic_subtopics = $connection->query($topic_subtopics_sql);
				?>

				<div class="modal fade" id="updateModal<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					  	<form action="../updateTopic.php" method="POST">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <h4 class="modal-title" id="myModalLabel"><?php echo $row['topic_name']  ?></h4>
					      </div>

					      <div class="modal-body">

					        <div class="input-group" style="margin: auto auto ; width:90%">
									
									<input  type="text" name="topicName" value="<?php echo $row['topic_name']?>" class="form-control" />
									<textarea id="topicDesc" name="topicDescription" class="form-control" ><?php echo $row['description']?></textarea>
									<input type ="hidden"  name ="topicId" value ="<?php echo $row['id']?>"/>
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

				<div class="panel panel-default">
				<?php
					if ($loged_user_id == $row['user_id']) {
						
					
				?>
				  <div class="panel-heading">
				  	<button id="updateBtn" class="btn btn-info btn-xs" data-toggle="modal" data-target="#updateModal<?php echo $row['id']?>">Update</button>
				  	<form action="../delete.php" method ="POST" >
				  		<input type="hidden" name ="topic_id" value = "<?php echo $row['id']?>">
				  		<button class="btn btn-danger btn-xs ">Delete</button>
				  	</form>
				  	

				  </div>
					<?php
					}
					?>
				  <div class="panel-body">

				    <?php echo "<a href='topic.php?topic=" . $row['id'] . "'>" . $row['topic_name'] . "</a>";
				    ?>

				    <div id="subtopic_num"><i>Subtopics: </i><?php echo $topic_subtopics->num_rows?></div>
				  </div>
				</div>


				<?php
				}

			}
			else{
				echo '<div style="text-align:center">No topics</div>';
			}	
		?>

	</div>
	
	<?php
	require("../scripts/jsScripts.php");
	?>
</body>
</html>