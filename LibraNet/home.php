<!DOCTYPE html>
<html>
<head>
    <title>Library Management App</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('/LibraNet/assets/library.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        a button {
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            margin: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        a button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Welcome to the LibraNet!</h1>
        <a href="/LibraNet/auth/register.php"><button>Register</button></a>
        <a href="/LibraNet/auth/login.php"><button>Login</button></a>
    </div>
</body>
</html>