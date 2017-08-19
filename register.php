<?php $title= "Registration Page"; ?>

<?php include "include/header.php"; ?>


<?php

		if (isset($_POST['register'])) {

			$username =  strip_tags($_POST['uname']) ;
			$email =  strip_tags($_POST['uemail']) ;
			$password =  strip_tags($_POST['upassword']) ;
			$status = "User";
			// if () {
			// 	# code...
			// }
			$u_password = password_hash($password, PASSWORD_DEFAULT);
			
			try {
				$userQuery = "INSERT INTO users (username, email, password ,status) VALUES (:username, :email, :u_password, :status)";

				$statement = $con->prepare($userQuery);
				$statement->bindParam(':username',$username);
				$statement->bindParam(':email',$email);
				$statement->bindParam(':u_password',$u_password);
				$statement->bindParam(':status',$status);
				$statement->execute();

				// return $statement;

				 if ($statement->rowCount() == 1) {
				 	echo "Registration Successful";
					header('Location:login.php');
				 }
					
			} catch (PDOException $e) {
				die($e->getMessage());
			}
			
			

		}

?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form method="POST" action="">
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
					<input type="password" name="upassword" class="form-control" required>
				</div>

<button type="submit" class="btn btn-btn-light" name="register">Register</button>
 			</form>
		</div>
	</div>
</div>
 			





<?php include "include/footer.php"; ?>