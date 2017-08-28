<?php

/*
This class is meant to be for every activities carried out by the user
*/
require_once 'database/connection.php';
class User{

	private $con;

	function __construct(){
		//It is meant to load everytime an instance of this class is called
		$db =new database();	
		$this->con = $db->connect();
	}

	public function validation($query){
		$check_stmt= $this->con->prepare($query);
		return $check_stmt;
	}

	public function register($username,$email,$password){


			try {
							$status = "User";
							$userQuery = "INSERT INTO users (username, email, password ,status) VALUES (:username, :email, :u_password, :status)";

							$statement = $this->con->prepare($userQuery);
							$statement->bindParam(':username',$username);
							$statement->bindParam(':email',$email);
							$statement->bindParam(':u_password',$password);
							$statement->bindParam(':status',$status);
							$statement->execute();

							

							 if ($statement->rowCount() == 1) {
							 	$success_message = "Registration Successful,Click to login";
								
							 }
								
						} catch (PDOException $e) {
							die($e->getMessage());
						}
	}
	public function viewQuery(){
		return $query = $this->con->query("SELECT * FROM stores");
	}
	public function login($email,$password){
		try {
			$login_query = "SELECT * FROM users WHERE email=:u_email";
			$statement =$this->con->prepare($login_query);
			$statement->bindParam(':u_email',$email);
			$statement->execute();
			while ($row = $statement ->fetch()) {
				$us_id = $row['id'];
				$us_user = $row['username'];
				$us_password = $row['password'];
				$us_email = $row['email'];

					if ($statement->rowCount() == 1) {
						if (password_verify($password, $us_password)) {

							$_SESSION['username'] = $us_user;
							$_SESSION['id'] = $us_id;	
							$_SESSION['status']	= $us_status;
							
							//Generate a secure token using openssl_random_pseudo_bytes.
							$myToken = bin2hex(openssl_random_pseudo_bytes(24));
							//Store the token as a session variable.
						$_SESSION['token'] = $myToken;
							return true;


						} else {
							return false;
						
						}
					}				
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public function logout(){
		
	}
}

