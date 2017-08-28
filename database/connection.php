<?php
/**
* 
*/
class database
{
	public $con;
	public function connect(){
		$this->con =null;
		try {
			$this->con = new PDO('mysql:host=localhost;dbname=anaco','root','');

	 			//set pdo error mode to exception
    		$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		ob_start();
			session_start();
	 		// $con->setAttri
		} catch (PDOException $e) {
				echo "Database Connection Error";
		}

		return $this->con;
	}
}
