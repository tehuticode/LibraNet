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

    if ($loginResult !== null && $loginResult['error'] == false) {
        $_SESSION['loggedin'] = true;
        header('Location: /LibraNet/index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #d8bfd8, #800080);
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
        </style>
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