<?php $title= "Welcome Page"; ?>
<?php require_once 'class.user.php';?>
<?php $user=new User();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title><?php echo $title; ?></title>
 	 
 	 <!-- Custom CSS================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	
	 <!-- Bootstrap CSS================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	
</head>
<body>

	<nav class="navbar navbar-toggleable-md navbar-light bd-faded">
	    		<button type="button" class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	                <span class="navbar-toggler-icon"></span>   
	    		</button>
	    		<a class="navbar-brand" href="index.php">Anakle</a>

	        <div class="collapse navbar-collapse" id="navbarNav">
	             <ul class="navbar-nav mr-auto mt-2 mt-md-0">
	                <li class="nav-item active"><a class="nav-link" href="dashboard/index.php">Create</a></li>

	                <?php if(isset($_SESSION['username'])){?>
	                <!--Only show when a user is login-->
	                <li class="nav-item "><a class="nav-link" href="logout.php?token=<?= $_SESSION['token']; ?>">Logout</a></li>
	                <?php }else{?> 
	                <!--Only show when a user is not login-->
	                <li class="nav-item "><a class="nav-link" href="login.php">Login</a></li>
	                <li class="nav-item "><a class="nav-link" href="register.php">Register</a></li>

	                <?php }?>
	                          
	    		</ul>
			</div>		
    </nav><!--/nav-->


<div class="container"> 
	<div class="row jumbotron">
		<div class="">
			<h2 class="display-3">Store Directory</h2>
			<p class="lead">It contains all the different stores</p>
		</div>
	</div>

	<div class="row">
	<?php


foreach ($user->viewQuery() as $row) {
	$store_name = htmlentities($row['store_name']);
	$store_address = htmlentities($row['store_address']) ;
	$store_user = htmlentities($row['user_id']);
	$time_updated = htmlentities($row['time_updated']);



	?>
	<p>
		<div class="col-lg-3 col-md-6 col-sm-6 d-flex align-items">
			<div class="card">
				<div class="card-block">
					<h4 class="card-header"><?php echo $store_name; ?></h4>
					<div class="card-body">
						<h6 class="card-subtitle mb-2 text-muted">Added by: <?php echo $store_user; ?></h6>
						<p class="card-text">Address: <?php echo $store_address; ?></p>
						<p class="card-text">Date Updated: <?php echo $time_updated; ?></p>
					</div>					
				</div>
			</div>
		</div>
	</p>
		
		<?php }?>
	</div>

</div>

  <!-- Bootstrap JavaScript================================= -->
  	
  	<script src="assets/js/jquery.min.js"></script>
  	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>