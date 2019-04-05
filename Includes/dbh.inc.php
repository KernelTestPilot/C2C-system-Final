<?php
class dbh{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $charset;
	
public function connect(){
	$this->servername = "wwwlab.iit.his.se";
	$this->username = "sqllab";
	$this->password = "Tomten2009";
	$this->dbname = "big_data";
	$this->charset = "utf8";
	try{
		
	$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
	$pdo = new PDO($dsn, $this->username, $this->password );
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	return $pdo;
	} catch (PDOException $e){
		echo "connection failed:" .$e->getMessage();
	}
}
}
?>