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
include_once '../Includes/gpscord.php';
include_once '../Includes/place.inc.php';
include_once '../Includes/database.php';
if(!isset($_SESSION['id'])){
	header('Location: ../login.php');
}else{
}
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
</head>
<body>
<div class="content-wrapper">
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
<?php
//NEW OBJECT TO SELECT * FROM USERS
$UserInfo = new User;
$User = $UserInfo->SelectUser($_SESSION['id']);
$UserID = $_SESSION['id'];
?>


	
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
          <li class="is-active">
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
      <h1 class="title">Books</h1>
	  
    </div>
	</section>
	<section>
	<div class="container">
	<div class="columns is-mobile is-centered">

	
	<div class="column">
	<?php 
	echo '<h2 class="subtitle">';
	   echo "$school";
	echo "</h2>";
	  $Courses = new Database;
	  $ID = $Courses->GetSchoolID($school);
?>
	<form method="post" id="books">
	<div class="field is-grouped is-grouped-centered has-addons has-addons-right">
	
	<div class="control">
<p> ISBN Auto Fill form </p>	
	<input class="input is-primary" type="text" id="search" placeholder="ISBN NR">
	</div>
	<div class="control">
	<br>
	<button class="button is-primary" id="button" type="button"> Search </button>
	</div>
	</div>
		
	
		<div class="field is-grouped is-grouped-centered">
			<div class="control">
			
			<p> ISBN </p>
			<input type="text" class="input is-medium" id="ISBN">
			</div>
		</div>
	
		<div class="field is-grouped is-grouped-centered">
			<div class="control">
			<h1> Book Title </h1>
			<input type="text" class="input is-medium" id="title">
			</div>
		</div>
	
	
		<div class="field is-grouped is-grouped-centered">
			<div class="control">
			<h1> Book Author </h1>
			<input type="text" class="input is-medium" id="authors">
			</div>
		</div>
			
	
		<div class="field is-grouped is-grouped-centered">
			<div class="control">
			<h1> Book Publisher </h1>
			<input type="text" class="input is-medium" id="publisher">
			</div>
		</div>
		
		<div class="field is-grouped is-grouped-centered">
			<div class="control">
			<h1> Price </h1>
			<input type="text" class="input is-medium" id="price">
			</div>
		</div>
	
	 <!-- end auto fill book--->
	 <!-- User info--->
	  <!--Setting user variables--->
	<div class="field is-grouped is-grouped-centered">
		<div class="control">
		<p> Phone number </p>
		<input type="text" class="input is-medium" id="Phone">
		</div>
	</div>
	
	<div class="field is-grouped is-grouped-centered">
		<div class="select is-rounded is-info">
		<select  name="Program" id="Program" class="is-focused">
		<option value=""> Show All Courses </option>
		<?php echo   $Courses->GetInrikning($ID);?>	
		</select>
		</div>
	</div>
	
	<div class="field is-grouped is-grouped-centered">
		<div class="select is-rounded is-info">
		<select  name="show_course" id="show_course" class="is-focused">
		<?php echo   $Courses->GetProgram($ID);?> 
		</select>
		</div>
	</div>
	
	<?php echo '<input type="hidden" id="userID" name="idtest" value="' . htmlspecialchars($UserID) . '">'; ?>
	<?php echo '<input type="hidden" id="school" name="idtest" value="' . htmlspecialchars($ID) . '">'; ?>
		
		<div class="field is-grouped is-grouped-centered">
		<div class="control">
		<button class="button is-primary" value="Submit" id="submit">Submit</button>
		</div>
		</div>
	</form>
	</div>
	
	<!-- end auser info--->


   
 
</div>
<div id="display">
</div>
  </section>



<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Books4sale</strong>
    </p>
  </div>
</footer>
<script async type="text/javascript" src="../js/bulma.js"></script>
<script>  
 $(document).ready(function(){  
      $('#Program').change(function(){  
           var Program = $(this).val();  
           $.ajax({  
                url:"../Includes/load_data.php",  
                method:"POST",  
                data:{Program:Program},  
                success:function(data){  
                     $('#show_course').html(data);  
                }  
           });  
      });  
 });  
 </script>
<script>  
 $(document).ready(function(){  
      $('#show_course').change(function(){  
           var show_course = $(this).val();
		   
           $.ajax({  
                url:"../Includes/load_data.php",  
                method:"POST",  
                data:{show_course:show_course, school: <?php echo $ID ?>},  
                success:function(data){  
                     $('#annonser').html(data);  
                }  
           });  
      });  
 });  
 </script>
<script>
   function bookSearch(){
	   var search = document.getElementById('search').value
	   console.log(search)
	   let change = document.querySelector('#title')
	   let change2 = document.querySelector('#authors')
	   let change3 = document.querySelector('#publisher')   
	   let change4 = document.querySelector('#ISBN')
	   $.ajax({
		   url:"https://www.googleapis.com/books/v1/volumes?q=isbn:" + search,
		   dataType:"json",
		   type:"GET",
		   success: function(data){
			   for(i = 0; i < data.items.length; i++) {
				   
				   change.value = data.items[i].volumeInfo.title
				   change2.value = data.items[i].volumeInfo.authors
				   change3.value = data.items[i].volumeInfo.publisher
				   change4.value = search
				
			   }
				console.log(data)
	   },
	   
	   })
   }
   document.getElementById('button').addEventListener('click', bookSearch,false)
   </script>
   <script>
   $(document).ready(function(){
	   $("#submit").click(function(){
		   var isbn = $("#ISBN").val();
		   var title = $("#title").val();
		   var author = $("#authors").val();
		   var publisher = $("#publisher").val();
		   var inriktning = $("#Program").val();
		   var program = $("#show_course").val();
		   var price = $("#price").val();
		   var school = $("#school").val();
		   var phone = $("#Phone").val();
		   var UserID = $("#userID").val();
		   
		   var dataString = 'ISBNl=' + isbn + '&titlel=' + title + '&authorl=' + author + '&publisherl=' + publisher + '&pricel=' + price + '&schooll=' + school + '&inriktningl=' + inriktning + '&programl=' + program + '&phonel=' + phone + '&UserIDl=' + UserID;
		   if(phone=='' || isbn=='' || title=='' || inriktning=='' || program=='' || price=='')
			{
				
				alert("Please fill out the form"); 
			}
			else{
				$.ajax({
					type: "POST",
					url: "../Includes/sendForm.php",
					data: dataString,
					cache:false,
					success:function(result){
						$("#display").html(result);
					}
					
				});
				
			}
			return false;
	   });
   });
					
					</script>
</main>
</body>
</html>