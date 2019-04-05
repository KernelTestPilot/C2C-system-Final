<?php
include_once 'dbh.inc.php';
include_once 'database.php';
?>

<?php
$con = new dbh;

$output = '';
if(isset($_POST["Program"]))
{
	$Program = $_POST["Program"];
	if($_POST["Program"] != '')
	{		
	$stmt = $con->connect()->prepare("SELECT * FROM ProgramID WHERE inriktningid= '".$_POST["Program"]."'");
	}
	else
	{
	$stmt = $con->connect()->prepare("SELECT DISTINCT Program FROM ProgramID  order by Program");
	
	}
	$stmt->execute();
	if ($stmt->rowCount()){
		while($row = $stmt->fetch()){
				
			$output .= ' <option value="'.$row["Programid"].'">'.$row["Program"].'</option>';
			
		}
		echo $output;
	}

}


if(isset($_POST["show_course"]) && ($_POST["school"]) )
	
{
	$Course = $_POST["show_course"];
	$school = $_POST["school"];

	if($_POST["show_course"] != '')
	{
	
	
	$stmt = $con->connect()->prepare("SELECT * FROM Advert
	INNER JOIN ProgramID ON Advert.Programid=ProgramID.Programid
	INNER JOIN SchoolID ON '$school' = SchoolID.Schoolid	
	
	WHERE Advert.Programid = '".$_POST["show_course"]."'");
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
			echo '<button class="button is-primary" id="myBtn" data-target="modal" aria-haspopup="true" value="'.$row["AnonID"].'" onclick="myFunction()">More info</button>';
			echo '</td>';
			echo "</tr>";
		}
		echo '</table>';
	}


?>