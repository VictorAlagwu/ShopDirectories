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
    <meta name="Victor Alagwu" content="">
	
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
	                <li class="nav-item "><a class="nav-link"  href="../logout.php?token=<?= $_SESSION['token']; ?>">Logout</a></li>       
	    		</ul>
			</div>		
    </nav><!--/nav-->


   <!--PHP CODE TO ADD NEW STORE AND IT DETAILS ======= --> 
<?php 
	if (isset($_POST['add'])) {
	
			$store_name =  strip_tags($_POST['store_name']);
			$store_address =  strip_tags($_POST['store_address']);
			
				if (!isset($_POST['token'])){
			    	throw new Exception('No token found!');
				}
			 //Compare session token with post token
				if(strcasecmp($_POST['token'], $_SESSION['token']) != 0){
				    throw new Exception('Token mismatch!');
				}
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

<!--JUMBOTRON=========-->
	<div class="row jumbotron">
			<h2 class="display-3">User Dashboard</h2>
			<p class="lead">Allow User to enter their own store details</p>
	</div>


	<div class="row">
		<div class="col-lg-5 col-md-12 col-sm-12">
			<h2>ADD STORE</h2>
			    <form method="POST" action="" role="form">
                    <div class="form-group">
                       <label for="cat_title">Store Name</label>
                        <input type="text" name="store_name"  class="form-control">
                    </div>
                    <div>
                    	<!--Hidden field containing our session token-->
   					 <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                    </div>
                  	
                    <div class="form-group">
                        <label>Store Address</label>
                        <input type="text" name="store_address" class="form-control"></input>
                    </div>
                    <div class="form-group text-center">
                    	<button name="add" class="btn btn-light" type="submit">ADD STORE</button>
                    </div>
          		</form>





<!--UPDATING SECTION ========-->
          		<?php
if (isset($_GET['edit'])) {
	$store_id = $_GET['edit'];
	$query = "SELECT * FROM stores WHERE id = :store_id";
	$stmt = $con-> prepare($query);
	$stmt->bindParam(':store_id', $store_id);
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		$store_name = htmlentities($row['store_name']) ;
		$store_address = htmlentities($row['store_address']);
		$user_id = htmlentities($row['user_id']);
		$time_created = htmlentities($row['time_created']);

		if ($user_name == $user_id) {		
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
                    <div class="form-group text-center">
                    	<button name="update" class="btn btn-light" type="submit">UPDATE STORE</button>
                    </div>
          		</form>


<?php 

			if (isset($_POST['update'])) {
				$s_name = strip_tags($_POST['s_name']);
				$s_address = strip_tags($_POST['s_address']);
		try {
			$edit_q = "UPDATE stores SET store_name = :s_name, store_address = :s_address, user_id = :user_name,time_updated=now(), time_created = :time_created WHERE id = :store_id";

					$edit_stmt = $con->prepare($edit_q);
					$edit_stmt->bindParam(':s_name',$s_name);
					$edit_stmt->bindParam(':s_address',$s_address);
					$edit_stmt->bindParam(':user_name',$user_name);
					$edit_stmt->bindParam(':store_id',$store_id);
					$edit_stmt->bindParam(':time_created',$time_created);

					$edit_stmt->execute();

					header('Location:index.php');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
					
				
				
				
			  }
		}else{
			echo "<script>alert('Sorry, can only be modify by user who created it');</script>";
			
	
		}


	}
}
          	?>

<!-- /UPDATING SECTION-==========-->


		</div>
		<div class="col-lg-7 col-md-12 col-sm-12">
			<div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
	                    <tr>
	                    	<th>ID</th>
	                    	<th>Store Name</th>
	                    	<th>Store Address</th>
	                    	<th>Added by </th>
	                    	<th>Time Added</th>
	                    	<th>Time Updated</th>
	                    	<th>Edit</th>
	                    	<th>Delete</th>
	                    </tr>
	                </thead>
	                <tbody>
	                <?php
$s_query = "SELECT * FROM stores";
$s_stmt = $con->prepare($s_query);
$s_stmt->execute();
while ($s_row = $s_stmt->fetch()) {
	$s_id =htmlentities($s_row['id']); 
	$s_name =htmlentities($s_row['store_name']) ;
	$s_address = htmlentities($s_row['store_address']);
	$s_user = htmlentities($s_row['user_id']);
	$s_time_update = htmlentities($s_row['time_updated']);
	$s_time_create = htmlentities($s_row['time_created']);



	                ?>
	                	<tr>
	                		<td><?php echo $s_id; ?></td>
	                		<td><?php echo $s_name; ?></td>
	                		<td><?php echo $s_address; ?></td>
	                		<td><?php echo $s_user; ?></td>
	                		<td><?php echo $s_time_create;?></td>
	                		<td><?php echo $s_time_update; ?></td>
	                		<td><a href="index.php?edit=<?php echo $s_id; ?>"><span class="fa fa-edit" style="color: #265a88;"></span></a></td>
	                		<td><a href="index.php?del=<?php echo $s_id; ?>"><span class="fa fa-trash" style="color: #265a88;"></span></a></td>
	                	</tr>
	                	<?php }?>
	                	<?php
if (isset($_GET['del'])) {
		$store_id = $_GET['del'];

		if ($us_status != "Admin") {
			
				echo "<script>alert('Sorry, Only Admins can delete any data');</script>";
				header('Location:../error.php');
		}else{

		$delete_query = "DELETE FROM stores WHERE id = :store_id ";
		$delete_stmt = $con->prepare($delete_query);
		$delete_stmt->bindParam(':store_id',$store_id);
		$delete_stmt->execute();
		header('Location: index.php');
		}
		
	}

	                	?>
	                </tbody>
	            </table>
	        </div>
		</div>
	</div>
</div>







   <!--  JavaScript Files ================================= -->
  	
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