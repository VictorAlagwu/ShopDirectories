<?php

/* Class for the dsashboard */
require_once '../database/connection.php';
class Dashboard 
{
	
	private $con;
	function __construct()
	{
		$db = new Database();
		$this->con = $db->connect();
	}
	public function viewStore($query){
		return $this->con->prepare($query);
	}
	public function addStore($store_name,$store_address,$user_name){
			try{

				$add_store = "INSERT INTO stores (store_name,store_address,user_id,time_created) VALUES (:store_name,:store_address,:user_id,now())";

				$add_stmt = $this->con->prepare($add_store);
				$add_stmt->bindParam(':store_name', $store_name);
				$add_stmt->bindParam(':store_address', $store_address);
				$add_stmt->bindParam(':user_id', $user_name);
				

				$add_stmt->execute();
				return true;
				
				
			}catch(PDOException $e){
				die($e->getMessage());
			}
	}
	public function viewEdit($query){
		return $this->con->prepare($query);
	}
	public function editStore($s_name,$s_address,$user_name,$store_id,$time_created){

		try {
			$edit_q = "UPDATE stores SET store_name = :s_name, store_address = :s_address, user_id = :user_name,time_updated=now(), time_created = :time_created WHERE id = :store_id";

					$edit_stmt = $this->con->prepare($edit_q);
					$edit_stmt->bindParam(':s_name',$s_name);
					$edit_stmt->bindParam(':s_address',$s_address);
					$edit_stmt->bindParam(':user_name',$user_name);
					$edit_stmt->bindParam(':store_id',$store_id);
					$edit_stmt->bindParam(':time_created',$time_created);

					$edit_stmt->execute();

					
		} catch (PDOException $e) {
			die($e->getMessage());
		}
				
	}
	public function deleteStore($query){
		return $this->con->prepare($query);
	}
	
}