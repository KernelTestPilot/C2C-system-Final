<?php
class Database extends dbh{
	

public function GetSchoolID($school){
	$stmt = $this->connect()->prepare("SELECT * FROM SchoolID WHERE Schoolname=?");
	$stmt->execute([$school]);
	if ($stmt->rowCount()== 1){
		while($row = $stmt->fetch()){
			$SchoolID = $row["Schoolid"];
			return $SchoolID;		
		}
}
}
public function GetProgram($school){
	$output ='';
	$stmt = $this->connect()->prepare("SELECT * FROM ProgramID WHERE Schoolid=?");
	$stmt->execute([$school]);
	if ($stmt->rowCount()){
		
		while($row = $stmt->fetch()){
			#$Course = $row["Program"];
			$output .= '<option value="'.$row["Programid"].'">'.$row["Program"].'</option>';
			#echo "<option value='".$row['Programid']."'>".$row['Program']."</option>";
			
		}
			return $output;
	}
}

public function FillCourse($school){
	$output = '';
	$stmt = $this->connect()->prepare("SELECT DISTINCT Kursnamn FROM CourseID WHERE Schoolid=? order by Kursnamn");
	$stmt->execute([$school]);
	if ($stmt->rowCount()){
		
		while($row = $stmt->fetch()){
			
			
			$output .= '<option value="'.$row["Courseid"].'">'.$row["Kursnamn"].'</option>';
			
		}
		return $output;
	}
}

public function GetInrikning($school){
	$output = '';
	$stmt = $this->connect()->prepare("SELECT * FROM Inriktning WHERE Schoolid=? order by Inriktning");
	$stmt->execute([$school]);
	if ($stmt->rowCount()){
		
		while($row = $stmt->fetch()){
			
			
			$output .= '<option value="'.$row["InriktningID"].'">'.$row["Inriktning"].'</option>';
			
		}
		return $output;
	}
}

public function FillSales($school){
	$output = '';
	$stmt = $this->connect()->prepare
	("SELECT * 
	FROM Advert
	INNER JOIN ProgramID ON Advert.Programid=ProgramID.Programid
	INNER JOIN SchoolID ON '$school' = SchoolID.Schoolid
	");
	
	
	$stmt->execute();
	if ($stmt->rowCount()){
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

}
public function InsertSale($isbnr, $title, $author, $publisher, $Phone, $program, $inriktning, $school, $UserID, $price){
	
	//FORTSÄTT SEN
	$sql = "INSERT INTO Advert (BokNamn, UserID, ISBN, publisher, SchoolID, Author, Price, ContactNR, mail, InriktningID,Programid) VALUES (:title, :UserID, :ISBN, :publisher, :SchoolID, :Author, :price, :ContactNR, :mail,:inriktningid,:programid)";
	if($stmt = $this->connect()->prepare($sql)){
			
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":UserID", $UserID, PDO::PARAM_INT);
			$stmt->bindParam(":ISBN", $isbnr, PDO::PARAM_INT);
			$stmt->bindParam(":publisher", $publisher, PDO::PARAM_STR);
			$stmt->bindParam(":SchoolID", $school, PDO::PARAM_INT);
			$stmt->bindParam(":Author", $author, PDO::PARAM_STR);
			$stmt->bindParam(":price", $price, PDO::PARAM_INT);
			$stmt->bindParam(":ContactNR", $Phone, PDO::PARAM_INT);
			$stmt->bindParam(":mail", $Email, PDO::PARAM_STR);
			$stmt->bindParam(":inriktningid", $inriktning, PDO::PARAM_INT);
			$stmt->bindParam(":programid", $program, PDO::PARAM_INT);
			if($stmt->execute()){
				echo "thanks for your submission";
	
			}else{
				  return false;
			}
}
}


public function FillSalesDelete($school,$uid){
	$output = '';
	$stmt = $this->connect()->prepare
	("SELECT * 
	FROM Advert
	WHERE UserID = '$uid'
	");
	
	
	$stmt->execute();
	if ($stmt->rowCount()){
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
			echo '<button class="button is-success" id="myBtn" data-target="modal" aria-haspopup="true" value="'.$row["AnonID"].'"">Mark as sold</button>';
			echo '</td>';
			echo "</tr>";
		}
		echo '</table>';
		
	}

}

public function SelectAd($AnonID){
	$BookArray = array();
	$stmt = $this->connect()->prepare("SELECT * FROM Advert WHERE AnonID=?");
	$stmt->execute([$AnonID]);
	if ($stmt->rowCount() == 1){
		while($row = $stmt->fetch()){
			$BookArray[] = $row;
			return $BookArray;
		}
}
}

public function InsertSaleToDone($Courseid,$Programid,$InriktningID,$BokNamn, $ISBN, $SchoolID, $Price){
	$sql = "INSERT INTO SoldBooks (Courseid, Programid, InriktningID, BokNamn,ISBN,SchoolID,Price) VALUES (:Courseid, :Programid, :InriktningID, :BokNamn, :ISBN, :SchoolID, :Price)";
	if($stmt = $this->connect()->prepare($sql)){
			$stmt->bindParam(":Courseid", $Courseid, PDO::PARAM_STR);
			$stmt->bindParam(":Programid", $Programid, PDO::PARAM_STR);
			$stmt->bindParam(":InriktningID", $InriktningID, PDO::PARAM_STR);
			$stmt->bindParam(":BokNamn", $BokNamn, PDO::PARAM_STR);
			$stmt->bindParam(":ISBN", $ISBN, PDO::PARAM_STR);
			$stmt->bindParam(":SchoolID", $SchoolID, PDO::PARAM_STR);
			$stmt->bindParam(":Price", $Price, PDO::PARAM_STR);
			if($stmt->execute()){
					
					
					
			}else{
				  return false;
			}
}
}

public function DeleteBook($AnonID){
	$stmt = $this->connect()->prepare("DELETE 
	FROM Advert
	WHERE AnonID = ?
	");
	$stmt->execute([$AnonID]);
	if ($stmt->rowCount()){
	return true;	
		
		
	}
}

public function DeleteAllBooks($UserID){
	$stmt = $this->connect()->prepare("DELETE 
	FROM Advert
	WHERE UserID = ?
	");
	$stmt->execute([$UserID]);
	if ($stmt->rowCount()){
	return true;	
		
		
	}
}
public function DeleteAccount($UserID){
	$stmt = $this->connect()->prepare("DELETE 
	FROM UserID
	WHERE id = ?
	");
	$stmt->execute([$UserID]);
	if ($stmt->rowCount()){
	return true;	
		
		
	}
}

public function GetAllmoney($schoolid){
	$Price = array();
	$stmt = $this->connect()->prepare("SELECT Price FROM SoldBooks WHERE SchoolID=?");
	$stmt->execute([$schoolid]);
		while($row = $stmt->fetchAll(PDO::FETCH_COLUMN)){
			$Price = $row;
			return $Price;
		}
}

}



?>