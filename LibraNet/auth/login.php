<?php 

session_start();

require_once __DIR__ . '/vendor/autoload.php';

use PHPAuth\Config;
use PHPAuth\Auth;

$db_host = 'localhost';
$db_name = 'db_library';
$db_user = 'root';
$db_password = '';

$dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

$config = new Config($dbh);
$auth = new Auth($dbh, $config);

$loginResult = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginResult = $auth->login($email, $password);
}

if ($loginResult['error'] == false) {
    $_SESSION['loggedin'] = true;
    header('Location: /index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="login.php">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>

    <?php
    if ($loginResult !== null) {
        if ($loginResult['error']) {
            echo '<p style="color: red;">' . $loginResult['message'] . '</p>';
        } else {
            echo '<p style="color: green;">Login successful!</p>';
        }
    }
    ?>
</body>
</html>