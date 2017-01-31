<?php
	require("../session.php");
	require("../db.php");
if (isset($_GET['topic'])){
	$id = $_GET['topic'];
	if ($id =="") {
		header("Location: home.php");
	}

	$sql = "SELECT * FROM sub_topic WHERE topic_id = '$id'";
	$results = $connection->query($sql);

	$sql2 = "SELECT * FROM topic WHERE id = '$id'";
	$topic_results = $connection->query($sql2);
	$topicrow = $topic_results->fetch_assoc();
}
	
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
	<div class="modal fade" id="addSubTopicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					  	<form action="../addSubTopic.php" method="POST">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <h4 class="modal-title" id="myModalLabel">Add Subtopic</h4>
					      </div>

					      <div class="modal-body">

					        <div class="input-group" style="margin: auto auto ; width:90%">
									<input type="hidden" name="topic_id" value="<?php echo $topicrow['id']?>"/>
									<input  type="text" name="subTopicName" class="form-control" />

									
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
		<?php
			require("navBar.php");
		?>
		
	
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		 
		  <div class="panel-heading"><?php echo $topicrow['topic_name']?>
		  		
		  </div>

		  <div class="panel-body">
		    <p><?php echo $topicrow['description']?></p>
		  </div>


		  <!-- List group -->
		  <ul class="list-group">
		  	<?php
			while ($row = $results->fetch_assoc()) {
				$sub_id = $row['id'];
				$topic_id = $row['topic_id'];
				$sql3 = "SELECT sub_topic.id AS sub_topic_id , comments.comment_text FROM sub_topic INNER JOIN comments ON sub_topic.id = comments.subtopic_id WHERE sub_topic.id = '$sub_id'";
				$results3 = $connection->query($sql3);

				$sql4 = "SELECT sub_topic.id AS sub_topic_id , topic.user_id FROM sub_topic INNER JOIN topic ON sub_topic.topic_id = topic.id WHERE sub_topic.topic_id = '$topic_id'";
				// $topic_result = $connection->query($sql4);
				// $topic1 = $topic_result->fetch_assoc();
				

				?>

					<div class="modal fade" id="updateSubTopicModal<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					  	<form action="../updateSubTopic.php" method="POST">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					        <h4 class="modal-title" id="myModalLabel"><?php echo $row['name']  ?></h4>
					      </div>

					      <div class="modal-body">

					        <div class="input-group" style="margin: auto auto ; width:90%">
									
									<input type="text" name="subTopicName" value="<?php echo $row['name']?>" class="form-control"/>
									<input type ="hidden"  name ="subTopicId" value ="<?php echo $row['id']?>"/>
									<input type ="hidden"  name ="topicId" value ="<?php echo $row['topic_id']?>"/>

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

					<li class="list-group-item"><a href="subtopic.php/?subtopic=<?php echo $row['id']?>"><?php echo $row['name']?></a>
						<?php
		  				
		  					if ($topicrow['user_id'] == $loged_user_id) {

		
		  				?>
						<span class="pull-right">
							<form action="../deleteSubTopic.php" method="POST">
								<input type="hidden" name="subtopic_id" value="<?php echo $row['id']?>">
								<input type="hidden" name="topic_id" value="<?php echo $topicrow['id']?>">
								<button type="submit">

			  						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			  					</button>
			  				</form>
		  				</span>
		  				
		  				<span class="pull-right">
							<button id="updateBtn" style="margin-left:30px " class="btn btn-info btn-xs" data-toggle="modal" data-target="#updateSubTopicModal<?php echo $row['id']?>">Update</button>
						</span>
						<?php } ?>
						<span class="pull-right">
							<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
							<?php echo $results3->num_rows?>
						</span>
						
					</li>

				<?php
			}

			?> 
		  </ul>
		</div>
				



	</div>
	
	<?php
	require("../scripts/jsScripts.php");
	?>
</body>
</html>