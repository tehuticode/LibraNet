<?php 

require_once __DIR__ . '/vendor/autoload.php';

use PHPAuth\Config;
use PHPAuth\Auth;

ob_start();

$db_host = 'localhost';
$db_name = 'db_library';
$db_user = 'root';
$db_password = '';

$dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

$config = new Config($dbh);
$auth = new Auth($dbh, $config);

$registrationResult = null;


if (isset($_POST['email'], $_POST['password'], $_POST['passwordConfirm']) && $_POST['email'] !== '' && $_POST['password'] !== '' && $_POST['passwordConfirm'] !== '') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    $registrationResult = $auth->register($email, $password, $passwordConfirm);

    if (!is_array($registrationResult) || !$registrationResult['error']) {
        // Registration was successful, redirect to login page
        header('Location: login.php');
        exit;
    } else {
        // There was an error, handle it
        if ($registrationResult['message'] === 'Email is already in use') {
            $registrationResult = ['error' => true, 'message' => 'Email is already in use.'];
        } else {
            $registrationResult = ['error' => true, 'message' => 'Email, password or password confirmation is missing.'];
        }
    }
}

ob_end_flush(); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form method="post" action="register.php">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="passwordConfirm">Confirm Password:</label><br>
        <input type="password" id="passwordConfirm" name="passwordConfirm" required><br>
        <input type="submit" value="Register">
    </form>

    <?php
    if ($registrationResult !== null) {
        if ($registrationResult['error']) {
            echo '<p style="color: red;">' . $registrationResult['message'] . '</p>';
        } else {
            echo '<p style="color: green;">Registration successful!</p>';
        }
    }
    ?>
</body>
</html>
