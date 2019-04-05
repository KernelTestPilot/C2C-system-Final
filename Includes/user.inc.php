<?php
class User extends dbh{

/*
public $Username = "";	
public $Password = "";	


public function __construct($Username, $Password){
	$this->Username = $Username;
	$this->Password = $Password;
}
*/
public function getUsersWithCountCheck($pw, $un){
	
	$stmt = $this->connect()->prepare("SELECT * FROM UserID WHERE Username=?");
	$stmt->execute([$un]);
	if ($stmt->rowCount()== 1){
		while($row = $stmt->fetch()){
			$id = $row["id"];
			$username = $row["Username"];
			
			$hashed_password = $row["Password"];
			
			$password = trim($pw);
		
			$validPassword = password_verify($password, $row['Password']);
			print_r ($validPassword);
				if($validPassword){
					session_start();
					$_SESSION['name'] = $row['Surname'];
					$_SESSION['id'] = $row['id'];					
					header("Location: index.php");
					return $row['Username'];
			
		}else{
			
			echo "Not working";
		}
		}
	
	}else{
		echo "Vill du registera dig?";
}
}
public function checkUsername($un){
	$stmt = $this->connect()->prepare("SELECT id FROM UserID WHERE Username=?");
	$stmt->execute([$un]);
	if ($stmt->rowCount() == 1){
		$check = False;
		return $check;
	}else{
		$check = true;
		return $check;
	}
		
}
public function checkPassword($pw, $pw2){
	if($pw == $pw2){
	return true;}else{
	return false;}
	
	if((strlen($pw)) < 8){
		$check = false;
		return $check;
	}else{
		$check = true;
		return $check;
	}
		
}
public function checkAge($age){
	if(is_numeric($age)){
		return true;
	}else{
		return false;
	}
		
}
public function checkEmail($mail){
	if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
		return true;
	}else{
		return false;
	}
		
}
public function registerUser($un, $pw,$mail,$Fnamn,$Enamn,$age){
	$param_password = password_hash($pw, PASSWORD_DEFAULT);
	$sql = "INSERT INTO UserID (Username, Password, Email, Surname, Lastname, Age) VALUES (:username, :password, :mail, :fnamn, :enamn, :age)";
	if($stmt = $this->connect()->prepare($sql)){
			$stmt->bindParam(":username", $un, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
			$stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
			$stmt->bindParam(":fnamn", $Fnamn, PDO::PARAM_STR);
			$stmt->bindParam(":enamn", $Enamn, PDO::PARAM_STR);
			$stmt->bindParam(":age", $age, PDO::PARAM_STR);
			if($stmt->execute()){
			header("location: login.php");
			}else{
				  return false;
			}
}
}

public function FirstTime($mail){
	$stmt = $this->connect()->prepare("SELECT Email FROM UserID WHERE Email=?");
	$stmt->execute([$mail]);
	if ($stmt->rowCount() == 1){
		return false;
	}else{
		
		return true;
	}
}
public function FirstTimeInsert($mail,$fbid,$firstname,$lastname){
	$sql = "INSERT INTO UserID (FBid, Email, Surname, Lastname) VALUES (:fb, :mail, :fnamn, :enamn)";
	if($stmt = $this->connect()->prepare($sql)){
			$stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
			$stmt->bindParam(":fnamn", $firstname, PDO::PARAM_STR);
			$stmt->bindParam(":enamn", $lastname, PDO::PARAM_STR);
			$stmt->bindParam(":fb", $fbid, PDO::PARAM_STR);
			if($stmt->execute()){
					
					
					
			}else{
				  return false;
			}
}
}
public function SelectFbUser($fbid){
	$resArr = array();
	$stmt = $this->connect()->prepare("SELECT * FROM UserID WHERE FBid=?");
	$stmt->execute([$fbid]);
	if ($stmt->rowCount() == 1){
		while($row = $stmt->fetch()){
			$resArr[] = $row;
			return $resArr;
		}
}
}

public function SelectUser($id){
	$resArr = array();
	$stmt = $this->connect()->prepare("SELECT * FROM UserID WHERE id=?");
	$stmt->execute([$id]);
	if ($stmt->rowCount() == 1){
		while($row = $stmt->fetch()){
			$resArr[] = $row;
			return $resArr;
		}
}
}
}
?>