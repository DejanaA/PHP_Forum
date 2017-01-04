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
		      <a class="navbar-brand" href="#">Brand</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a data-toggle="modal" data-target="#addSubTopicModal" href="#">Add Subtopic</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Action</a></li>
		            <li><a href="#">Another action</a></li>
		            <li><a href="#">Something else here</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">Separated link</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">One more separated link</a></li>
		          </ul>
		        </li>
		      </ul>
		      <form class="navbar-form navbar-left">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">Submit</button>
		      </form>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#">Link</a></li>
		        <li class="dropdown">
		          <a href="../logout.php" class="dropdown-toggle"  role="button" aria-haspopup="true" aria-expanded="false">Log out </a>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		
		
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
				$sql3 = "SELECT sub_topic.id AS sub_topic_id , comments.comment_text, sub_topic.id AS sub_topic_id FROM sub_topic INNER JOIN comments ON sub_topic.id = comments.subtopic_id WHERE sub_topic.id = '$sub_id'";
				$results3 = $connection->query($sql3);

				?>
					<li class="list-group-item"><?php echo $row['name']?>
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