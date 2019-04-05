<?php
session_start();
include_once 'Includes/dbh.inc.php';
include_once 'Includes/user.inc.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dahlbergs sida</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.2-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Registrera konto</h3>
                    <p class="subtitle has-text-grey">Fyll i dina uppgifter</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure>
                        <form method="POST">
                            <div class="field">
								<div class="control">
									<p> Enter Username </p>
									<input class="input is-large" type="username" name="Username" placeholder="Username" autofocus="">
								</div>
								</div>
								<div class="field">
                                <div class="control">
								<p> Enter password </p>
                                    <input class="input is-large" type="password" name="Password" placeholder="Your Password">
								</div>
								<div class="control">
								<p> Enter password again </p>
                                    <input class="input is-large" type="password" name="Password2" placeholder="Your Password">
								</div>
								<div class="control">
								<p> Enter mail </p>
                                    <input class="input is-large" type="Mail" name="Email" placeholder="oskar@gmai...">
								</div>
								<div class="control">
								<p> Enter name </p>
                                    <input class="input is-large" type="namn" name="Namn" placeholder="Name">
								</div>
								<div class="control">
								<p> Enter lastname </p>
                                    <input class="input is-large" type="namn" name="Efternamn" placeholder="Lastname">
								</div>
															
								
								<button type="submit" class="button is-block is-info is-large is-fullwidth">Registrera konto</button>
						</form>
					</div>
					<p class="has-text-grey">
                        <a href="login.php">Login</a> &nbsp;·&nbsp;          
                        <a href="../">Need Help?</a>
                    </p>
                </div>
            </div>
        </div>
		</Div>
    </section>
<script async type="text/javascript" src="../js/bulma.js"></script>

  
<?php
if (isset($_POST['Username'])) {
	if (isset($_POST['Password'])) {
				//VARIABLER
				$un = trim($_POST['Username']);
				$pw = $_POST['Password'];
				$pw2 = $_POST['Password2'];
				$mail = $_POST['Email'];
				$Fnamn = trim($_POST['Namn']);
				$Enamn = trim($_POST['Efternamn']);
				//Kollar om användare finns, ålder och password är 8 bokstäver
				
				$object = new User;
						
				if($object->checkEmail($mail)){
											
				if($object->checkUsername($un)){
					if($object->checkPassword($pw, $pw2)){
						$object->registerUser($un, $pw,$mail,$Fnamn,$Enamn,$age);
						echo "Account created";
					}else{
						echo "Lösenordet är för kort eller matchar inte";
					}
					
					
					}else{
						echo "Användarnamnet är upptaget";
					}
				
				}else{
					echo "fel Email";
				}
				}
				}
	


		
?>




</body>
</html>
