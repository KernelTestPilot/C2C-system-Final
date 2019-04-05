<?php
require_once "config.php";
include_once 'Includes/dbh.inc.php';
include_once 'Includes/user.inc.php';
unset($_SESSION['school']);

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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bulma Version 0.7.2-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/dropdown.css">
	<link rel="stylesheet" type="text/css" href="css/lander.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<script src="https://cldup.com/S6Ptkwu_qA.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script async type="text/javascript" src="js/bulma.js"></script>
	<script async type="text/javascript" src="js/geoLoc.js"></script>
	<script async type="text/javascript" src="js/test.js"></script>
	<script async type="text/javascript" src="js/particle.js"></script>



</head>
<body>
<div id="particles-js"></div>
<?php
	if (isset ($_SESSION['userData'])){
		$FirstLogin = new User;
		if($FirstLogin->FirstTime($_SESSION['userData']['email'])){
			$FirstLogin->FirstTimeInsert($_SESSION['userData']['email'],$_SESSION['userData']['id'],$_SESSION['userData']['first_name'],$_SESSION['userData']['last_name']);
					echo '<div id="dialog" title="Welcome to Ready start study">';
					echo '<p>We store your email, firstname and lastname for you to be able to buy and sell on this site</p>';
					echo '</div>';
		}else{
			
		}
		$User = $FirstLogin->SelectFbUser($_SESSION['userData']['id']);
		foreach ( $User as $Users){
		$_SESSION['name'] = $Users['Surname'];	
		$_SESSION['id'] = $Users['id'];}
		
	}
	?>
<main>
 <!-- START NAV -->

               
        </div>
<div class="content-wrapper">

		<section class="hero is-landing is-large">
        <div class="hero-head">
		<?php if (isset($_SESSION['id'])){
	echo '
			 <nav class="navbar">
                <div class="container">
                    <div class="navbar-brand">
                        <a class="navbar-item">
                            Ready-Start-Study
                        </a>
                        <span class="navbar-burger burger" data-target="mainNavbar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                    <div id="mainNavbar" class="navbar-menu">
                        <div class="navbar-end">
                       
                            <a class="navbar-item">';
							echo $_SESSION['name'];
							echo '
                                
                            </a>
                            <span class="navbar-item">
                                <a class="button is-info is-inverted is-outlined" href="UserPage/logout.php">
                                    <span>Logout</span>
                                </a>
                            </span>
							
                        </div>
                    </div>
                </div>
            </nav>
			 <!-- END NAV --> ';}else{
	echo '
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-brand">
                        <a class="navbar-item">
                            Ready-Start-Study
                        </a>
                        <span class="navbar-burger burger" data-target="mainNavbar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                    <div id="mainNavbar" class="navbar-menu">
                        <div class="navbar-end">
                       
                            <a class="navbar-item" href="login.php">
                                Login
                            </a>
                            <span class="navbar-item">
                                <a class="button is-info is-inverted is-outlined" href="register.php">
                                    <span>Register</span>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </nav>';}

    
?>
        </div>

        
	  
</div>
</section>
<section>
<div class="hero-body">
	
			<div class="text">
			<h1>Ready-start-Study</h1>
			<p>Slogan goes here</p>
				<div class="container">
						<div class="dropdown">
					<button id="dash" type="button" class="button  arrow" value="Submit" onclick="myFunction()" >
					Search for closest school
						</button>
					<div id="myDropdown" class="dropdown-content">
					<p id="location" </p>
					</div>
					</div>
				</div>
					
			</div>
	</div>
</section>
<section>
<div class="test123">

</div>
    </section>
	</div>
	</div>
<script>
  $( function() {
    $( "#dialog" ).dialog();
  } );
  </script>
<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
</script>

</main>
</body>
</html>
