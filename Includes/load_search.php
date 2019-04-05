<?php
include_once 'dbh.inc.php';
include_once 'database.php';
?>

<?php
$con = new dbh;
if(isset($_POST["query"]))
	
{
	$search = $_POST["query"];
	$school = $_POST["school"];
	echo $school;
	if($_POST["query"] != '')
	{
	$stmt = $con->connect()->prepare("SELECT * FROM Advert 
	INNER JOIN SchoolID ON '$school' = SchoolID.Schoolid
	
	WHERE ISBN LIKE '%".$_POST["query"]."%' ");
	
	}
	else
	{
	$stmt = $con->connect()->prepare("SELECT * FROM Advert");
	
	}
	$stmt->execute();
	echo '<table>';
		echo '<thead>';
		echo '<tr>';
		
		echo '<th>Book Title</th>';
		echo '<th>Author</th>';
		echo '<th>ISBN NR</th>';
		echo '<th>Price</th>';
		echo '<th></th>';
		echo '</tr>';
		echo '</thead>';
			while($row = $stmt->fetch()){
			echo "<tr id='1' class='bg-info'>";
			
			echo '<td> '  .$row["BokNamn"]. '</span></td>';
			
			echo '<td> <i>' .$row["Author"]. '</i></td>';
			echo '<td> <i>' .$row["ISBN"]. '</i></td>';
			echo '<td>' .$row["Price"].' sek</span></td>';
			echo '<td>';
			echo '<button class="button is-primary" id="myBtn" data-target="modal" aria-haspopup="true" value="'.$row["AnonID"].'"">More info</button>';
			echo '</td>';
			echo "</tr>";
		}
		echo '</table>';
	}


?>