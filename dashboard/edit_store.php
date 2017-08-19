<?php require '../database/connection.php'; ?>
<?php $title='User Page'; ?>

<?php
 if(isset($_SESSION['username'])) 
 {
 	
$user_name = $_SESSION['username'];
 ?>

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
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	
	 <!-- Fontawesome CSS================================= -->
	<link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
	 <!-- Bootstrap CSS================================= -->
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	
</head>
<body>

	<nav class="navbar navbar-toggleable-md navbar-light bd-faded">
<!-- 	<nav class="navbar  navbar-light bd-faded"> -->
	    		<button type="button" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	                <span class="navbar-toggler-icon"></span>   
	    		</button>
	    		<a class="navbar-brand" href="#">Anakle</a>

	        <div class="collapse navbar-collapse" id="navbarNav" class="navbar-toggler navbar-toggler-right">
	            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
	                <li class="nav-item active"><a class="nav-link" href="../index.php">Vist Site</a></li>
	                <li class="nav-item "><a class="nav-link" href="../logout.php">Logout</a></li>       
	    		</ul>
			</div>		
    </nav><!--/nav-->
<?php 


if (isset($_POST['add'])) {
	
	$store_name =  strip_tags($_POST['store_name']);
	$store_address =  strip_tags($_POST['store_address']);
	try{

		$add_store = "INSERT INTO stores (store_name,store_address,user_id,time_created) VALUES (:store_name,:store_address,:user_id,now())";

		$add_stmt = $con->prepare($add_store);
		$add_stmt->bindParam(':store_name', $store_name);
		$add_stmt->bindParam(':store_address', $store_address);
		$add_stmt->bindParam(':user_id', $user_name);
		

		$add_stmt->execute();
		echo "Added Succefully";
		header('Location:index.php');
		
	}catch(PDOException $e){
		die($e->getMessage());
	}


}





?>
<div class="container">
	<div class="row jumbotron">
		<div class="">
			<h2 class="display-3">User Dashboard</h2>
			<p class="lead">It contains all the different stores</p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5 col-md-12 col-sm-12">
			
          		<?php
if (isset($_GET['edit'])) {

	$query = "SELECT * FROM stores WHERE id = :store_id";
	$stmt = $con-> prepare($query);
	$stmt->bindParam(':store_id', $store_id);
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		$store_name = $row['store_name'];
		$store_address = $row['store_address'];
		$user_id = $row['user_id'];
		$time_created = $row['time_created'];

		// if ($user_name == $user_id) {		
		?>


          		<h2>UPDATE STORE</h2>
			    <form method="POST" action="" role="form">
                    <div class="form-group">
                       <label for="cat_title">Store Name</label>
                        <input type="text" name="s_name"  class="form-control" value="<?php echo $store_name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Store Address</label>
                            <input type="text" name="s_address" class="form-control" value="<?php echo $store_address; ?>"></input>
                    </div>
                    <div class="form-group">
                    	<button name="update" class="btn btn-light" type="submit">UPDATE STORE</button>
                    </div>
          		</form>


<?php 

			if (isset($_POST['update'])) {
				$s_name = strip_tags($_POST['s_name']);
				$s_address = strip_tags($_POST['s_address']);
	
					$edit_q = "UPDATE stores SET store_name = :s_name, store_address = :s_address, user_id = :user_name,time_updated=now(), time_created = :time_created WHERE id = :store_id";

					$edit_stmt = $con->prepare($edit_q);
					$edit_stmt->bindParam(':s_name',$s_name);
					$edit_stmt->bindParam(':s_address',$s_address);
					$edit_stmt->bindParam(':user_name',$user_name);
					$edit_stmt->bindParam(':time_created',$time_created);

					$edit_stmt->execute();

					header('Location:index.php');
				
				
				
			  }
		// }else{
		// 	echo "<script>alert('jgjjg');</script>Sorry, Store details can only be edited by User who created it";
		// 	header('Location:error.php');
	
		// }


	}
}
          	?>




		</div>
		<div class="col-lg-7 col-md-12 col-sm-12">
		</div>
	</div>
</div>







   <!-- Bootstrap JavaScript================================= -->
  	
  	<script src="../assets/js/jquery.min.js"></script>
  	<script src="../assets/js/umd/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
 </body>
 </html>

 <?php 	
 }else{
 	header('Location: ../login.php');
 	echo "Please log-in";
 }?>