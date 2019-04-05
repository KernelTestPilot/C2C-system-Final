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
    <link rel="stylesheet" type="text/css" href="../css/site.css">
	<link rel="stylesheet" type="text/css" href="../css/flextable.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script async type="text/javascript" src="../js/bulma.js"></script>

	
</head>
<body>
<?php

	  $Courses = new Database;
	  $ID = $Courses->GetSchoolID($school);

?> 
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



	
<section class="hero is-info is-bold">
 <div class="hero-body">
    <div class="container">
	  
	
      <h1 class="title">User settings </h1>
     
	  


 
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
	  
	
      <h1 class="title">User profile settings </h1>
	   
	  

    </div>
	<div class="container">
		<div class="columns is-mobile is-centered">
		<div class="column is-half">
<article class="message is-success">
  <div class="message-body">
  Here you can delete your account <strong>all your user info will be deleted.</strong>
  </div>
</article>
		<h1> Remove your account </h1>
		<?php
		echo '<button class="button is-danger" id="myBtn2" data-target="modal" aria-haspopup="true" value="'.$_SESSION['id'].'"">Delete  Account</button>';
		?>
		</div>
		<div class="column is-half">
		<article class="message is-success">
  <div class="message-body">
  Mark the book as sold will remove the advertisement <strong>thanks for using our service</strong>
  </div>
</article>
		<h2> Your books on the market: </h2>
		<?php
		$Usersetting = New database;
		$Usersetting->FillSalesDelete($_SESSION['school'],$_SESSION['id']);
		?>
		</div>
	</div>

</section>
<div id="modal2" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Delete book from market</p>
      <button class="delete" aria-label="close" onclick="closeModals()" ></button>
    </header>
				

    <section class="modal-card-body">
		<p id="adverts">
	</p>
    </section>
	
    <footer class="modal-card-foot">
      <button class="button" onclick="closeModals()">close</button>
    </footer>
  </div>
</div>
<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Ready-Start-Study</strong> 
    </p>
  </div>
</footer>
<script>
$(document).on('click',"#myBtn2",function() {
    var ID = $(this).val();


  $.ajax({
        type:'POST',
        url:'../Includes/load_deleteaccount.php',
        data:{ID:ID},
        success:function(msg){
            if(msg){
				window.location.href = ("logout.php");
            }else{
                
            }
        }
	
    });
});
</script>
<script>
$(document).on('click',"#myBtn",function() {
    var ID2 = $(this).val();


  $.ajax({
        type:'POST',
        url:'../Includes/load_modal_delete.php',
        data:{ID2:ID2},
        success:function(msg){
            if(msg){
				$('.modal-card-body').html(msg);
			   var openmodal = document.getElementById('modal2').style.display='flex';
				
            }else{
                
            }
        }
	
    });
});
</script>
<script>
function closeModals() {
  var x = document.getElementById('modal2');
  if (x.style.display === 'none') {
    x.style.display = 'block';
  } else {
    x.style.display = 'none';
	location.reload();
  }
} 

</script> 
</body>
</html>

