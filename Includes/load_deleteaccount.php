<?php
include_once 'dbh.inc.php';
include_once 'database.php';
?>


<?php
$con = new dbh;
$Delete = new database;
if(isset($_POST["ID"])){
	$ID = $_POST["ID"];
	//Tar först bort alla annonser av user
	if($Delete -> DeleteAllBooks($ID)){
	}else{
		echo "Error";
	}
	//Tar bort account
	if($Delete -> DeleteAccount($ID)){
	}else{
		echo "Error";
	}
	
}
?>