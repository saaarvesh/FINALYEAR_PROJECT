<?php

	class DbOperation {
		private $con;
		
		function __construct() {
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
			$this->con = $db->connect();
		}
		
		function cust_insert($id,$name, $email, $password, $contact, $address) {
			$q = "select * from `customer_registration` where cust_email='$email' and cust_contact='$contact'";
			$data = mysqli_query($this->con, $q);
			$row = mysqli_num_rows($data);
			if($row > 0) {
				return false;
			}
			
			$stmt = "INSERT INTO `customer_registration` (`cust_id`,`cust_name`, `cust_email`, `cust_password`, `cust_contact`, `cust_address`)
			VALUES ('$id','$name', '$email', '$password','$contact','$address')";
			$data2 = mysqli_query($this->con, $stmt);
			
			if($data2) {
				return true;
			} else {
				return false;
			}
		}

		function getUData($email) {
			$stmt = "select * from `customer_registration` where cust_email = '$email'";
			$data = mysqli_query($this->con, $stmt);
			$users = array();
			while($rs = mysqli_fetch_assoc($data)) {
				$user = array();
				$user['name'] = $rs['cust_name'];
				$user['email'] = $rs['cust_email'];
				$user['password'] = $rs['cust_password'];
				$user['contact'] = $rs['cust_contact'];
				$user['address'] = $rs['cust_address'];
				array_push($users, $user);
			}
			return $users;
		}
	
		function Login($email, $password) {
			$sql = "select * from `customer_registration` where cust_email = '$email' and cust_password= '$password'";
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