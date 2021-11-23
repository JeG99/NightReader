<?php

class User {
	private $conn;
	private $table_name = "NightReader_Users";

	public $uid;
	public $first_name;
	public $last_name;
	public $user;
	public $pass;
	public $email;
	public $status;

	public function __construct($db) {
		$this->conn = $db;
	}

	function login() {
		$query = "
			SELECT USER.USER_ID, USER.USER_FNAME, USER.USER_LNAME, USER.USERNAME, USER.PASSWORD, USER.USER_EMAIL, USER.STATUS
			FROM " . $this->table_name . " USER
			WHERE USER.USER_EMAIL = :email AND USER.STATUS = 'active'
			LIMIT 0, 1";

		$stmt = $this->conn->prepare($query);

		$this->email = htmlspecialchars(strip_tags($this->email));
		$stmt->bindParam(":email", $this->email);

		if($stmt->execute()) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(strcmp($this->pass, $row['PASSWORD']) === 0) {
				$this->uid = $row['USER_ID'];
				$this->first_name = $row['USER_FNAME'];
				$this->last_name = $row['USER_LNAME'];
				$this->user = $row['USERNAME'];
				$this->status = $row['STATUS'];
				//return "Succesfully logged in.";
				return 1;
			} 
			else if($row == null) {
				//return "ERROR: This email is not registered.";
				return 2;
			} 
			else {
				//return "ERROR: Check your email or password.";	
				return 3;
			}
		}	
		else {
			//return "ERROR: Server not available";
			return 4; 
		}
	}

	function signup() {
		$query = "
			INSERT INTO " . $this->table_name . "
			SET USER_FNAME=:user_fname, USER_LNAME=:user_lname, USERNAME=:username, PASSWORD=:password, USER_EMAIL=:user_email";

		$stmt = $this->conn->prepare($query);

		$this->first_name = htmlspecialchars(strip_tags($this->first_name));
		$this->last_name = htmlspecialchars(strip_tags($this->last_name));
		$this->user = htmlspecialchars(strip_tags($this->user));
		$this->pass = htmlspecialchars(strip_tags($this->pass));
		$this->email = htmlspecialchars(strip_tags($this->email));

		$stmt->bindParam(":user_fname", $this->first_name);
		$stmt->bindParam(":user_lname", $this->last_name);
		$stmt->bindParam(":username", $this->user);
		$stmt->bindParam(":password", $this->pass);
		$stmt->bindParam(":user_email", $this->email);

		if($stmt->execute()) {
			return true;
		}

		return false;
		
	}

	function changepass() {
		$query = "
			UPDATE " . $this->table_name . "
			SET PASSWORD = :password
			WHERE USER_EMAIL = :user_email AND STATUS = 'active'";

		$stmt = $this->conn->prepare($query);

		$this->pass = htmlspecialchars(strip_tags($this->pass));
		$this->email = htmlspecialchars(strip_tags($this->email));

		$stmt->bindParam(":password", $this->pass);
		$stmt->bindParam(":user_email", $this->email);
		
		if($stmt->execute()) {
			return true;
		}

		return false;
	}
/*
	function read() {
		$query = "
			SELECT USER.USER_ID, USER.USER_FNAME, USER.USER_LNAME, USER.USERNAME, USER.PASSWORD, USER.USER_EMAIL, USER.STATUS
			FROM " . $this->table_name . " USER
			ORDER BY USER.USER_ID ASC";
		
		$transaction = $this->conn->prepare($query);
		$transaction->execute();
		
		return $transaction;
	}

	function create() {
		$query = "
			INSERT INTO " . $this->table_name . "
			SET USER_FNAME=:user_fname, USER_LNAME=:user_lname, USERNAME=:username, PASSWORD=:password, USER_EMAIL=:user_email";

		$transaction = $this->conn->prepare($query);

		$this->first_name = htmlspecialchars(strip_tags($this->first_name));
		$this->last_name = htmlspecialchars(strip_tags($this->last_name));
		$this->user = htmlspecialchars(strip_tags($this->user));
		$this->pass = htmlspecialchars(strip_tags($this->pass));
		$this->email = htmlspecialchars(strip_tags($this->email));

		$transaction->bindParam(":user_fname", $this->first_name);
		$transaction->bindParam(":user_lname", $this->last_name);
		$transaction->bindParam(":username", $this->user);
		$transaction->bindParam(":password", $this->pass);
		$transaction->bindParam(":user_email", $this->email);

		if($transaction->execute()) {
			return true;
		}

		return false;
	}

	function readOne() {
		$query = "
			SELECT USER.USER_ID, USER.USER_FNAME, USER.USER_LNAME, USER.USERNAME, USER.PASSWORD, USER.USER_EMAIL
			FROM " . $this->table_name . " USER
			WHERE USER.USER_ID = ? AND USER.STATUS = 'active'
			LIMIT 0, 1";

		$transaction = $this->conn->prepare($query);
		$transaction->bindParam(1, $this->uid);
		$transaction->execute();

		$row = $transaction->fetch(PDO::FETCH_ASSOC);

		$this->uid = $row['USER_ID'];
		$this->first_name = $row['USER_FNAME'];
		$this->last_name = $row['USER_LNAME'];
		$this->user = $row['USERNAME'];
		$this->pass = $row['PASSWORD'];
		$this->email = $row['USER_EMAIL'];
	}

	function match() {
		$query = "
			SELECT USER.USER_ID, USER.USER_FNAME, USER.USER_LNAME, USER.USERNAME, USER.STATUS
			FROM " . $this->table_name . " USER
			WHERE USER.USER_EMAIL = ? AND USER.PASSWORD = ? AND USER.STATUS = 'active'
			LIMIT 0, 1";

		$transaction = $this->conn->prepare($query);
		$transaction->bindParam(1, $this->email);
		$transaction->bindParam(2, $this->pass);
		$transaction->execute();

		$row = $transaction->fetch(PDO::FETCH_ASSOC);

		$this->uid = $row['USER_ID'];
		$this->first_name = $row['USER_FNAME'];
		$this->last_name = $row['USER_LNAME'];
		$this->user = $row['USERNAME'];
		$this->status = $row['STATUS'];
	}

	function update() {
		$query = "
			UPDATE " . $this->table_name . "
			SET USER_FNAME = :user_fname,
				USER_LNAME = :user_lname,
				USERNAME = :username,
				PASSWORD = :password,
				USER_EMAIL = :user_email
			WHERE USER_ID = :user_id AND STATUS = 'active'";

		$transaction = $this->conn->prepare($query);

		$this->uid = htmlspecialchars(strip_tags($this->uid));
		$this->first_name = htmlspecialchars(strip_tags($this->first_name));
		$this->last_name = htmlspecialchars(strip_tags($this->last_name));
		$this->user = htmlspecialchars(strip_tags($this->user));
		$this->pass = htmlspecialchars(strip_tags($this->pass));
		$this->email = htmlspecialchars(strip_tags($this->email));

		$transaction->bindParam(":user_id", $this->uid);
		$transaction->bindParam(":user_fname", $this->first_name);
		$transaction->bindParam(":user_lname", $this->last_name);
		$transaction->bindParam(":username", $this->user);
		$transaction->bindParam(":password", $this->pass);
		$transaction->bindParam(":user_email", $this->email);

		if($transaction->execute()) {
			return true;
		}

		return false;
	}
*/
	function delete() {
		$query = "
			UPDATE " . $this->table_name . "
			SET STATUS = 'deleted'
			WHERE USER_ID = :user_id AND STATUS = 'active'";

		$stmt = $this->conn->prepare($query);

		$this->uid = htmlspecialchars(strip_tags($this->uid));
		//$this->pass = htmlspecialchars(strip_tags($this->pass));
		//$this->email = htmlspecialchars(strip_tags($this->email));

		$stmt->bindParam(":user_id", $this->uid);
		//$stmt->bindParam(":password", $this->pass);
		//$stmt->bindParam(":user_email", $this->email);
		
		if($stmt->execute()) {
			return true;
		}

		return false;
	}

	function search($keywords) {
		$query = 
			"SELECT USER.USER_ID, USER.USER_FNAME, USER.USER_LNAME, USER.USERNAME, USER.PASSWORD, USER.USER_EMAIL
			FROM " . $this->table_name . " USER
			WHERE USER.USERNAME LIKE ? OR 
				  USER.USER_EMAIL LIKE ? OR
				  USER.USER_LNAME LIKE ? OR 
				  USER.USER_FNAME LIKE ? AND
				  USER.STATUS = 'active'
			ORDER BY USER.USER_ID DESC";

		$stmt = $this->conn->prepare($query);

		$keywords = htmlspecialchars(strip_tags($keywords));
		$keywords = "%{keywords}%";

		$stmt->bindParam(1, $keywords);	
		$stmt->bindParam(2, $keywords);
		$stmt->bindParam(3, $keywords);
		$stmt->bindParam(4, $keywords);

		$stmt->execute();

		return stmt();
	}

	public function getUid() {
		return $this->uid;
	}

	public function setUid($id) {
		$this->uid = $id;
	}

	public function getFirstName() {
		return $this->first_name;
	}

	public function setFirstName($fname) {
		$this->first_name = $fname;
	}

	public function getLastName() {
		return $this->last_name;
	}

	public function setLastName($lname) {
		$this->last_name = $lname;
	}

	public function getUsername() {
		return $this->user;
	}

	public function setUsername($username) {
		$this->user = $username;
	}

	public function getPassword() {
		return $this->pass;
	}

	public function setPassword($password) {
		$this->pass = $password;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($mail) {
		$this->email = $mail;
	}

	public function toArray() {
		return [
			"id" => $this->getUid(),
			"fname" => $this->getFirstName(),
			"lname" => $this->getLastName(),
			"username" => $this->getUsername(),
			"password" => $this->getPassword(),
			"email" => $this->getEmail()
		];
	}
}

?>