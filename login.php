<?php
	require_once "config.php";
	if(!session_id()) {
    session_start();
}
	if (isset($_SESSION['access_token'])) {
		header('Location: index.php');
		exit();
	}

	$redirectURL = "https://wwwlab.iit.his.se/b17karda/foretag/fb-callback.php";
	$permissions = ['email'];
	$loginURL = $helper->getLoginUrl($redirectURL, $permissions);
?>


<?php
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
                    <h3 class="title has-text-grey">Login</h3>
                    <p class="subtitle has-text-grey">Please login to proceed.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="img/loginbook.png">
                        </figure>

						
                        <form method="POST">
                            <div class="field">
								<div class="control">
									
										<input class="input is-large" type="username" name="Username" placeholder="Ditt användarnamn" autofocus="">
								</div>
								</div>
								<div class="field">
                                <div class="control">
                                    <input class="input is-large" type="password" name="Password" placeholder="Your Password">
								</div>
								<div class="field">
                                <label class="checkbox">
								<input type="checkbox">
								Remember me
								</label>
							</div>
	
								<button type="submit" class="button is-block is-info is-large is-fullwidth">Login</button>
								<figure class="image is-578x134">
								<a href="<?php echo $loginURL ?>"> <img src="img/fblogo.png" /> </a>
								</figure>
								
						</form>
					</div>
					<p class="has-text-grey">
                        <a href="register.php">Sign Up</a> &nbsp;·&nbsp;
                        <a href="../">Forgot Password</a> &nbsp;·&nbsp;
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
        $un = $_POST['Username'];
			if (isset($_POST['Password'])) {
			$pw = $_POST['Password'];
				$object = new User;			
				$object->getUsersWithCountCheck($pw, $un);
				}
		}
?>

</body>
</html>
