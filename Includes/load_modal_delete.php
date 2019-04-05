<?php
include_once 'dbh.inc.php';
include_once 'database.php';
?>


<?php
$con = new dbh;
$Delete = new database;
if(isset($_POST["ID2"])){
	$ID2 = $_POST["ID2"];
	$Book = $Delete->SelectAd($ID2);
	foreach ( $Book as $Books){
		$Courseid = $Books['Courseid'];
		$Programid = $Books['Programid'];
		$InriktningID = $Books['InriktningID'];
		$BokNamn = $Books['BokNamn'];
		$ISBN = $Books['ISBN'];
		$SchoolID = $Books['SchoolID'];
		$Price = $Books['Price'];
	}
	if($Delete -> InsertSaleToDone($Courseid,$Programid,$InriktningID,$BokNamn, $ISBN, $SchoolID, $Price)){
		echo "Your book has been registred as sold";
		echo "<br>";
	}
	if($Delete -> DeleteBook($ID2)){
		echo "Your advertisment has been deleted";
	}else{
		echo "Error";
	}
}
?>