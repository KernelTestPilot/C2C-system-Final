<?php
include_once 'dbh.inc.php';
include_once 'geo.inc.php';
include_once 'user.inc.php';
include_once 'gpscord.php';
include_once 'place.inc.php';
include_once 'database.php';
include_once 'book.inc.php';
?>
<?php
	$sendform = new Database;
	$isbnr =$_POST['ISBNl'];
	$title =$_POST['titlel'];
	$author =$_POST['authorl'];
	$publisher =$_POST['publisherl'];
	$Phone =$_POST['phonel'];
	$program =$_POST['programl'];
	$inriktning =$_POST['inriktningl'];
	$school =$_POST['schooll'];
	$UserID =$_POST['UserIDl'];
	$price =$_POST['pricel'];
	
	

	$sendform -> InsertSale($isbnr, $title, $author, $publisher, $Phone, $program, $inriktning, $school, $UserID, $price);
	
	
	
?>