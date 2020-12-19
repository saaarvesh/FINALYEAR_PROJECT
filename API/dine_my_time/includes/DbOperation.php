<?php

	class DbOperation {
		private $con;
		
		function __construct() {
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
			$this->con = $db->connect();
		}
		
		function res_insert($id, $name, $email, $password, $contact, $address, $status, $image){
			$q = "select * from `restaurant_registration` where res_email='$email' and res_contact='$contact'";
			$data = mysqli_query($this->con, $q);
			$row = mysqli_num_rows($data);
			if($row > 0) {
				return false;
			}
			$stmt = "INSERT INTO `restaurant_registration` (`res_id`,`res_name`, `res_email`, `res_password`, `res_contact`, `res_address`, `registration_status`, `res_image`)
			VALUES ('$id','$name', '$email', '$password','$contact','$address', '$status', '$image')";
			$data2 = mysqli_query($this->con, $stmt);
			
			if($data2) {
				return true;
			} else {
				return false;
			}




		}
		function cust_insert($name, $email, $password, $contact, $address) {
			// $created = date('Y-m-d H:i:s');
			$q = "select * from `customer_registration` where cust_email='$email' or cust_contact='$contact'";
			$data = mysqli_query($this->con, $q);
			$row = mysqli_num_rows($data);
			if($row > 0) {
				return false;
			}
			
			$stmt = "INSERT INTO `customer_registration` (`cust_name`, `cust_email`, `cust_password`, `cust_contact`, `cust_address`)
			VALUES ('$name', '$email', '$password','$contact','$address')";
			$data2 = mysqli_query($this->con, $stmt);
			
			if($data2) {
				return true;
			} else {
				return false;
			}
		}

		function getRData($email) {
			$stmt = "select * from `restaurant_registration` where res_email = '$email'";
			$data = mysqli_query($this->con, $stmt);
			$users = array();
			while($rs = mysqli_fetch_assoc($data)) {
				$user = array();
				$user['name'] = $rs['res_name'];
				$user['email'] = $rs['res_email'];
				// $user['password'] = $rs['cust_password'];
				$user['contact'] = $rs['res_contact'];
				$user['address'] = $rs['res_address'];
				$user['created'] = $rs['registration_time'];
				array_push($users, $user);
			}
			return $users;
		}

		function getUData($email) {
			$stmt = "select * from `customer_registration` where cust_email = '$email'";
			$data = mysqli_query($this->con, $stmt);
			$users = array();
			while($rs = mysqli_fetch_assoc($data)) {
				$user = array();
				$user['name'] = $rs['cust_name'];
				$user['email'] = $rs['cust_email'];
				// $user['password'] = $rs['cust_password'];
				$user['contact'] = $rs['cust_contact'];
				$user['address'] = $rs['cust_address'];
				$user['created'] = $rs['registration_time'];
				array_push($users, $user);
			}
			return $users;
		}

		function getAData($email) {
			$stmt = "select * from `admin_login` where admin_email = '$email'";
			$data = mysqli_query($this->con, $stmt);
			$users = array();
			while($rs = mysqli_fetch_assoc($data)) {
				$user = array();
				$user['name'] = $rs['admin_name'];
				$user['email'] = $rs['admin_email'];
				
				array_push($users, $user);
			}
			return $users;
		}
	
		function resLogin($email, $password) {
			$sql = "select * from `restaurant_registration` where res_email = '$email' and res_password= '$password'";
			$stmt = mysqli_query($this->con, $sql);
			$num = mysqli_num_rows($stmt);
			if($num>0){
				return true;
			} else {
				return false;
			}
		
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

		function adminLogin($email, $password){
			$sql = "select * from `admin_login` where admin_email = '$email' and admin_password= '$password'";
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