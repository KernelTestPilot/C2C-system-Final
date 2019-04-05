<?php
include_once 'dbh.inc.php';
include_once 'database.php';
?>


<?php
$con = new dbh;
if(isset($_POST["ID"])){
	$ID = $_POST["ID"];
	if($_POST["ID"] != '')
	{
	$stmt = $con->connect()->prepare("SELECT * FROM Advert
	INNER JOIN ProgramID ON Advert.Programid=ProgramID.Programid
	INNER JOIN SchoolID ON Advert.SchoolID = SchoolID.Schoolid	
	INNER JOIN UserID ON Advert.UserID = UserID.id
	WHERE Advert.AnonID = '$ID'");
	}
	$stmt->execute();
	echo '<div class="columns">';
			while($row = $stmt->fetch()){
				echo '<div class="column">';
				echo '<h2 class="subtitle">';
				echo 'Book:';
				echo '</h2>';
				echo '<p> <strong> Title: </strong> '.$row["BokNamn"]. '</p>';
				echo '<p> <strong> Author: </strong> '.$row["Author"]. '</p>';
				echo '<p> <strong> Price: </strong> '.$row["Price"]. ' Sek</p>';
				echo '</div>';
				echo '<div class="column">';
				echo '<h2 class="subtitle">';
				echo 'Contact to seller:';
				echo '</h2>';
				echo '<p> <strong> Name:</strong> '.$row["Surname"].' '.$row["Lastname"]. '</p>';
				echo '<p> <strong> Mail:</strong> '.$row["Email"]. '</p>';
				echo '<p> <strong> Phone Number: </strong> '.$row["ContactNR"]. '</p>';
				echo '</div>';
				echo '</div>';
				echo '<div class="columns">';
				echo '<div class="column">';
				echo '<h2 class="subtitle">';
				echo 'This book has been used on:';
				echo '</h2>';
				echo '<p> <strong></strong> '.$row["Program"]. '</p>';
				echo '<p> <strong> at school: </strong> '.$row["Schoolname"]. '</p>';
				echo '</div>';
				echo '</div>';
		
				
		}
		echo '</div>';
		
		
}
?>