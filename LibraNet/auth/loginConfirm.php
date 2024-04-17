<?php 

require_once __DIR__ . '/vendor/autoload.php';

use PHPAuth\Config;
use PHPAuth\Auth;

// db info
$db_host = 'localhost';
$db_name = 'db_library';
$db_user = 'root';
$db_password = '';

// db connection

$dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

// auth intialization
$config = new Config($dbh);
$auth = new Auth($dbh, $config);

// check the user login status
if($auth->isLogged()) {
    echo "User is logged in <br />";
    $currentUser = $auth->getCurrentUser();
    var_dump($currentUser);
} else {
    echo "User is not logged in <br />";
}
?>