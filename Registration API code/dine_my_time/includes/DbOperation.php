<?php

	class DbOperation {
		private $con;
		
		function __construct() {
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
			$this->con = $db->connect();
		}
		
		function cust_insert($name, $email, $password, $contact, $address, $time) {
			$q = "select * from customer_registration where cust_email='$email' and cust_contact='$contact'";
			$data = mysqli_query($this->con, $q);
			$row = mysqli_num_rows($data);
			if($row > 0) {
				return false;
			}
			
			$stmt = "INSERT INTO `customer_registration`(`cust_name`, `cust_email`, `cust_password`, `cust_contact`, `cust_address`, `registration_time`)
			VALUES ('$name', '$email', '$password', '$contact', '$address', '$time')";
			$data2 = mysqli_query($this->con, $stmt);
			
			if($data2) {
				// $this->initWallet($this->con->insert_id);
				return true;
			} else {
				return false;
			}
		}
		
		function getWalletBalance($id) {
			$stmt = "SELECT * FROM `wallet` where cust_id = $id";
			$data = $this->con->query($stmt);
			$obj = $data->fetch_object();
			
			return $obj->amount;
		}
		function getUData($email) {
			$sql = "select * from customer_registration where cust_email = `$email`";
			$data = mysqli_query($this->con, $stmt);
			$users = array();
			while($rs = mysqli_fetch_assoc($data)) {
				$user = array();
				// $user['id'] = $rs['id'];
				$user['name'] = $rs['name'];
				$user['email'] = $rs['email'];
				$user['password'] = $rs['password'];
				$user['contact'] = $rs['contact'];
				$user['address'] = $rs['address'];
				$user['time'] = $rs['time'];
				array_push($users, $user);
			}
			return $users;
		}
	
		function login($email, $password) {
			$sql = "select * from customer_registration where cust_email = '$email' and cust_password= '$password'";
			$stmt = mysqli_query($this->con, $sql);
			$num = mysqli_num_rows($stmt);
			if($num>0){
				return true;
			} else {
				return false;
			}
		
		}
	}

?>