<?php $title= "Registration Page"; ?>
<?php require 'class.user.php'; ?>
<?php $user = new User(); ?>
<?php include "include/header.php"; ?>
<style>
	.container{
		padding: 70px;
	}
</style>

<?php

		if (isset($_POST['register'])) {

			$username = strip_tags($_POST['uname']) ;
			$email = strip_tags($_POST['uemail']) ;
			$password = strip_tags($_POST['upword']) ;
			$confirm_password = strip_tags($_POST['c_upword']) ;
			
			if ($confirm_password != $password) {
				$message[] = "Password and Confirm Password are not the same";		
			}else{
				try{
					$check_stmt = $user->validation("SELECT username,email FROM users WHERE username = :uname OR email = :email");
					$check_stmt->bindParam(':uname',$username);
					$check_stmt->bindParam(':email',$email);
					$check_stmt->execute();

					$row=$check_stmt->fetch(PDO::FETCH_ASSOC);
					if ($row['username'] == $username) {
						$message[] = "Sorry, Username already taken";
					}elseif($row['email'] == $email){
						$message[] = "Sorry,Email already used";
					}else{
						$u_password = password_hash($password, PASSWORD_DEFAULT);
						
						$user->register($username,$email,$u_password);
					}
				}catch(PDOException $e)
				{

				}
			}

		}

?>
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-3 col-sm-3"></div>
		<div class="col-lg-4 col-md-6 col-sm-6">
			<form method="POST" action="">
				<?php if(isset($message)) 
				{ 
					foreach ($message as $error) {
						
					

					?>
	                			<div class="alert alert-danger text-center">
	                   				 <?php echo $error; ?>
	                			</div>
	            <?php  } }elseif(isset($success_message)){?>
	                			<div class="alert alert-info text-center">
	                   				<a class="btn btn-default " href="login.php"><?php echo $success_message; ?></a>	
	                			</div>
	             <?php }?>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="uname" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="uemail" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="upword" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Confirm Password</label>
					<input type="password" name="c_upword" class="form-control" required>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-btn-light" name="register">Register</button>
				</div>				
 			</form>
		</div>
		<div class="col-lg-4 col-md-3 col-sm-3"></div>
	</div>
</div>
 			





<?php include "include/footer.php"; ?>