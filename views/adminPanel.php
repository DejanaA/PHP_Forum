<?php
	require("../session.php");
	require("../db.php");

$sql = "SELECT * FROM topic ";
$results = $connection->query($sql);

$sql2 = "SELECT * FROM users WHERE id != '$loged_user_id'";
$result = $connection->query($sql2);

	
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
		<?php
			require("navBar.php");
		?>
		<?php
		    while ($row = $result->fetch_assoc()) {
		    	?>
		 <div class="panel panel-default">
		  <div class="panel-body">
		  	<?php echo  $row['first_name'] . " " . $row['last_name'] ;
			?>
			<form method="POST" action="../deleteUser.php">
			<input type="hidden" name="user_id" value="<?php echo $row['id']?>">
		    <button class="btn btn-danger btn-xs" style="float:right ; margin-top:-15px" type="submit">Delete</button>
		    </form>
		  </div>
		  <?php
		  if ($row['role_id']==1) {
		  	?>
		  	<div class="panel-footer">Admin
		  	<form method="POST" action="../downgradeUser.php">
		  		<input type="hidden" name="user_id" value="<?php echo $row['id']?>">

		  		
		  		<button class="btn btn-danger btn-xs" style="float:right ; margin-top:-15px" type="submit">Downgrade</button>
		  		
		  	</form>
		  	</div>
		  	<?php
		  }
		  else{
		  	?>
		  	<div class="panel-footer">Regular user
		  	<form method="POST" action="../upgradeUser.php">
		  		<input type="hidden" name="user_id" value="<?php echo $row['id']?>">
		  		
		  		<button class="btn btn-success btn-xs" style="float:right ; margin-top:-15px" type="submit">Upgrade</button>
		  		
		  	</form>
		  	</div>

		  	<?php
		  }

		  ?>
		  
		</div>
			<?php
		    	
		    }
		    ?>
		
		
	</div>


				

	
	<?php
	require("../scripts/jsScripts.php");
	?>
</body>
</html>