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
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #add8e6, #000080);
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <form method="post" action="register.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="passwordConfirm">Confirm Password:</label>
        <input type="password" id="passwordConfirm" name="passwordConfirm" required>
        <input type="submit" value="Register">
    </form>

    <?php
    if ($registrationResult !== null) {
        if ($registrationResult['error']) {
            echo '<p class="message error">' . $registrationResult['message'] . '</p>';
        } else {
            echo '<p class="message success">Registration successful!</p>';
        }
    }
    ?>
</body>
</html>
