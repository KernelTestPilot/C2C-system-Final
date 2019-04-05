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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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



	
<section class="hero is-medium is-primary is-bold">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Ready-Start-Study
      </h1> 
      <h2 class="subtitle">
         <?php echo "$school"; ?>
		
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
          <li class="is-active">
            <a href=<?php echo "aboutus.php?school=".urlencode($school)."" ?> >Company info</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</section>
<section class="section">

<div class="container">
<div class="columns is-mobile is-centered">
		<div class="column is-half">
      <h1 class="title">About us</h1>
	  
    </div>
	</div>
	
	<div class="column is-centered">
<h1 class="title">Who are we ?</h1>
<p class="subtitle is-5"> Ready Start Study was invented 2019 in correlation to a study project. It's a company that strives to provide students with used course literature. Our solution will provide a simpler way for students to buy and sell used course literature.</p>
</div>
<div class="container">
          

            <nav class="columns">
                <div class="column has-text-centered">
                    <article class="media">
                        <figure class="media-left">
                            <span class="icon has-text-success">
                                <i class="fab fa-sellsy fa-3x"></i>
                            </span>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <h4 class="heading"><strong>Sell</strong></h4>
                                <p>Sell your used books. We aim to make every school exclusive for what books you need for your courses.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="column has-text-centered">
                    <article class="media">
                        <figure class="media-left">
                            <span class="icon has-text-success">
                                <i class="fas fa-shopping-cart fa-3x"></i>
                            </span>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <h4 class="heading"><strong>Buy</strong></h4>
                                <p>Buy books based on your location, we <strong> DONT SHIP </strong>. The idea is to buy from people on your school, so you can get the books cheaper.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="column has-text-centered">
                    <article class="media">
                        <figure class="media-left">
                            <span class="icon has-text-success">
                                <i class="fas fa-book fa-3x"></i>
                            </span>
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                    <h4 class="heading"><strong>Simple</strong></h4>
                                    <p>See what books are closest to you, and just pick them up!
                                    </p>
                            </div>
                        </div>
                    </article>
                </div>
            </nav>
        </div>
<div class="column is-centered">
<h1 class="title">Value Proposition</h1>
<p class="subtitle is-4">
The product we will offer is a platform that is designed for students in Sweden. The platform will provide a simpler way of selling or buying used course literature. We will make use of location services to distribute the user with the closest option of course literature. We also want to avoid shipping to make the whole process much simpler.</p>
</div>

<div class="column is-centered">
<p class="title"> Team </p>
<p class="subtitle is-4">
The product we will offer is a platform that is designed for students in Sweden. The platform will provide a simpler way of selling or buying used course literature. We will make use of location services to distribute the user with the closest option of course literature. We also want to avoid shipping to make the whole process much simpler.</p>
</div>

<div class="column is-centered">
<p class="title"> Goals </p>
<p class="subtitle is-4">
We want to make life simplier for all students and help the environment with our solution. Our goal is that all students are using our platform for the purpose of selling or buying used course literature.</p>
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

</body>
</html>