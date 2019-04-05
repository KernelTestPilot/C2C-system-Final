<?php
require_once "../config.php";

	  if(isset($_GET['school'])){
		 $school = $_GET['school'];
		 $_SESSION["school"] = $school;
		
	  }else{
		  header ('../index.php');
	  }
include_once '../Includes/dbh.inc.php';
include_once '../Includes/user.inc.php';
include_once '../Includes/place.inc.php';
include_once '../Includes/database.php';


?>
<?php

	  $Courses = new Database;
	  $ID = $Courses->GetSchoolID($school);
?> 
<?php
		$CalcSchools = New database;
		$MoneySchool = $CalcSchools ->GetAllmoney($ID);		
		//bar stuff //
		$total = 15000;
		$currentvalue = array_sum($MoneySchool);
		$percent = round(($currentvalue/$total) * 100,1);
?>
<?php
//Chart fun
	$ChartArray = New database;
  $MoneyHIS = $ChartArray ->GetAllmoney($ID);
  $MoneyKTH = $ChartArray ->GetAllmoney(2);
  $MoneyLTH = $ChartArray ->GetAllmoney(3);
 $HIS = $currentvalue = array_sum($MoneyHIS);
 
 $KTH = $currentvalue = array_sum($MoneyKTH);

 $LTH = $currentvalue = array_sum($MoneyLTH);
 
$dataPoints = array( 
	array("y" => $HIS, "label" => "HIS" ),
	array("y" => $KTH, "label" => "KTH" ),
	array("y" => $LTH, "label" => "LTH" ),

);
 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
     <title>Ready-Start-Study</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.2-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script async type="text/javascript" src="../js/bulma.js"></script>
	<style type='text/css'>
	.outer{
	height:25px;
	width:200px;
	border:solid 1px #000;
	position: relative;
	}

	.inner{
	height:25px;
	width:<?php echo $percent ?>%;
	border-right:solid 1px #000;
	background-color: #71e8c5;
	position: relative;
  overflow: hidden;
	}
	
	</style>
</head>
<body>
<section>
 <!-- START NAV -->
<?php
if (isset($_SESSION['id'])){
	echo '
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="../">
                        <img src="../img/logo.png" alt="Logo">
                    </a>
                <span class="navbar-burger burger" data-target="navbarMenu">
                        <span></span>
                <span></span>
                <span></span>
                </span>
            </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item is-active" href="help.php">
                            Home
                        </a>  
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">';
                                echo $_SESSION["name"];
								echo '
                            </a>;
							
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="userdashboard.php?school='.urlencode($school).'">
                                    Dashboard
                                </a>                    							
							<a class="navbar-item" href="usersettings.php?school='.urlencode($school).'">
                                    Settings
                                </a>
								<a href="logout.php">
                            <hr class="navbar-divider">
                            <div class="navbar-item">
                                Logout
								</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
	
    <!-- END NAV --> ';}else{
	echo '<nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="../">
                        <img src="../images/bulma.png" alt="Logo">
                    </a>
                <span class="navbar-burger burger" data-target="navbarMenu">
                        <span></span>
                <span></span>
                <span></span>
                </span>
            </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item is-active" href="../index.php">
                            Home
                        </a>  
                    <div class="navbar-item is-active">
                       <a class="navbar-item is-active" href="../login.php">
                            Login
                        </a>  
      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>';}

    
?>
</section>



	
<section class="hero is-medium is-primary is-bold">
 <div class="hero-body">
    <div class="container">
      <h1 class="title">User settings </h1>
	  <h2 class="subtitle">
         <?php  echo $_SESSION["name"] ?>
		
      </h2>
</div>
</div>
<div class="hero-foot">
    <nav class="tabs is-boxed is-fullwidth">
      <div class="container">
        <ul>
          <li>
            <a href="../index.php">Home</a>
          </li>
          <li>
            <a href=<?php echo "site.php?school=".urlencode($school)."" ?> >Books</a>
          </li>
          <li>
           <a href=<?php echo "sale.php?school=".urlencode($school)."" ?> >Start selling </a>
          </li>
          <li>
            <a href=<?php echo "aboutus.php?school=".urlencode($school)."" ?> >Company info</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</section>
<section class="section">
    <div class="container">
      <h1 class="title">Highscore of  <strong>Schools</strong> </h1>
    </div>
	<div class="container">
		<div class="columns is-mobile is-centered">
		<div class="column is-mobile is-half">
		
		
		<p class="subtitle is-4">
		Progress bar for <strong><?php echo $school ?></strong>
		
		</p>
		
		<p>
		<?php 
		$currentvalue = array_sum($MoneySchool);
		echo "$currentvalue SEK is $percent% of $total SEK. <p />";
		?>
		
		
		</p>
		<div class="outer"> 
		<div class="inner">
		</div>
		</div>
		</div>
		<div class="column is-half">
		<p class="subtitle is-4">
		Schools with the money <strong>earned </strong>
		
		</p>
		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
		</div>
	</div>

</section>

<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Ready-Start-Study</strong> 
    </p>
  </div>
</footer>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Highscore of Schools"
	},
	axisY: {
		title: "Money saved"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</body>
</html>

