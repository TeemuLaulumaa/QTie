<?php
//check php manual
// hhtps://secure.php.net/manual/en/function.session-destroy.php
session_start();
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_unset();
session_destroy();
echo "You're now logged out. Your browser will return to frontpage automatically.";
//sleep (3);
header("Location:  https://users.metropolia.fi/~teemulau/QTie/start.php");
