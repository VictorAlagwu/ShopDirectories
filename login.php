<?php $title= "Login Page"; ?>
<?php require 'class.user.php'; ?>
<?php $user = new User(); ?>
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

	if($user->login($u_email,$u_password)){
		header('Location: index.php');
	}else{
		$message = "Wrong password";
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