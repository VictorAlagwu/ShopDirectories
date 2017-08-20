<?php $title= "Login Page"; ?>

<?php include "include/header.php"; ?>
<style>
	.container{
		padding: 70px;
	}
</style>

<?php
if (isset($_POST['submit'])) 
{
	$u_email = $_POST['uemail'];
	$u_password = $_POST['upass'];

	$login_query = "SELECT * FROM users WHERE email=:u_email";
	$statement =$con->prepare($login_query);
	$statement->bindParam(':u_email',$u_email);
	$statement->execute();
			while ($row = $statement ->fetch()) {
				$us_id = $row['id'];
				$us_user = $row['username'];
				$us_password = $row['password'];
				$us_email = $row['email'];

					
						if (password_verify($u_password, $us_password)) {

							$_SESSION['username'] = $us_user;
							$_SESSION['id'] = $us_id;	
							$_SESSION['status']	= $us_status;
							
//Generate a secure token using openssl_random_pseudo_bytes.
$myToken = bin2hex(openssl_random_pseudo_bytes(24));
//Store the token as a session variable.
$_SESSION['token'] = $myToken;
							header('Location: index.php');


						} else {
							$message = "Wrong password";
						
						}
					
			}

}
?> 

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-3"></div>
		<div class="col-lg-4 col-md-6">
			<form class="form-group" role="form" method="POST" action="">
				<?php if(isset($message)) { ?>
        			<div class="alert alert-danger text-center">
           				 <?php echo $message; ?>
        			</div>
        		<?php  }else{?>
        			<div class="alert alert-info text-center">
           				<a class="btn btn-default " href="register.php"> Click to register</a>	
        			</div>
        		<?php }?>
	       		<div class="form-group">
	       			<label for="name">Email:</label>
	                <input name="uemail" type="email" class="form-control" placeholder="Enter Email" required>
	       		</div>
	       		<div class="form-group">
	       			<label for="email">Password:</label>
	                <input name="upass" type="password" class="form-control" placeholder="Enter Passsword" required>
	       		</div>
	            <div class="for-group text-center">
	                <button name="submit" class="btn btn-light" type="submit">Submit</button>
	            </div>
	                    	
	                 
	                       
	                </div>
	        </form>
	        </div>

		</div>
		<div class="col-lg-4 col-md-3"></div>
</div>

             


<?php include "include/footer.php"; ?>