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
		        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
		        <li><a href="#">Link</a></li>
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
		<?php
			if ($results->num_rows > 0) {
				while($row = $results->fetch_assoc()){
					$topic_id = $row['id'];
				    $topic_subtopics_sql = "SELECT topic.id AS topic_id , topic.topic_name, sub_topic.id AS sub_topic_id FROM topic INNER JOIN sub_topic ON topic.id = sub_topic.topic_id WHERE topic.id = '$topic_id'";
					$topic_subtopics = $connection->query($topic_subtopics_sql);
				?>
				
				<div class="panel panel-default">
				  <div class="panel-heading">
				  	<form action="../delete.php" method ="POST" >
				  		<input type="hidden" name ="topic_id" value = "<?php echo $row['id']?>">
				  		<button class="btn btn-danger btn-xs ">Delete</button>
				  	</form>

				  </div>
				  <div class="panel-body">

				    <?php echo $row['topic_name'];
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