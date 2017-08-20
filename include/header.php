<?php require 'database/connection.php'; ?>
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
