<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
require_once "../config.php";
require_once "../Facebook/autoload.php";
// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
$token = $helper->getAccessToken();
$url = 'https://www.facebook.com/logout.php?next=' . 'https://wwwlab.iit.his.se/b17karda/foretag' .
  '&access_token='.$token;
session_destroy();
header('Location: '.$url);

// Finally, destroy the session.
session_destroy();
header('Location: ../index.php');
?>