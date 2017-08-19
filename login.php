<?php $title= "Login Page"; ?>

<?php include "include/header.php"; $message=''; ?>

<?php
if (isset($_POST['submit'])) 
{
	$u_email = $_POST['uemail'];
	$u_password = $_POST['upass'];

	$login_query = "SELECT * FROM users WHERE email=:u_email";
	$statement =$con->prepare($login_query);
	$statement->execute(array(':u_email' => $u_email));

	while ($row = $statement ->fetch()) {
		$us_id = $row['id'];
		$us_user = $row['username'];
		$us_password = $row['password'];
		$us_email = $row['email'];

		
		if (password_verify($u_password, $us_password)) {

			$_SESSION['username'] = $us_user;
			$_SESSION['id'] = $us_id;	
			$_SESSION['status']	= $us_status;
			header('Location: index.php');


		} else {
			$message = "Error with entries";
		
		}
	}

}
?> 

<div class="container">
	<div class="row">
		<p class="text-center"><?php echo $message; ?></p>
	</div>
	<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<form class="form-group" role="form" method="POST" action="">
			    <label class="inputdefault" for="name">Email:</label>
                    <input name="uemail" type="email" class="form-control" placeholder="Enter Email" required><br>
              	<label class="inputdefault" for="email">Password:</label>
                    <input name="upass" type="password" class="form-control" placeholder="Enter Passsword" required><br>
                    
                  
                    	<button name="submit" class="btn btn-light" type="submit">Submit</button>
                 
                       
                </div>
        </form>
        </div>

	</div>
</div>

             


<?php include "include/footer.php"; ?>