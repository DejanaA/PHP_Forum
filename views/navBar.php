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
		    	<?php
		    	if ($loged_user_r == 1) {
		    		?>
		    		<ul class="nav navbar-nav">
		    		<li><a data-toggle="modal"  href="/PHP_Forum/views/adminPanel.php">Admin panel</a></li>
		   		 <?php
		   		}

		    	?>
		      
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