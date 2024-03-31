<?php
include "utilities/DBconnect.php";
$db = new DBconnect("localhost", "root", "", "db_library");
$conn = $db->getConnection();

if ($db->getConnection()) {
    echo "";
} else {
    echo "Not connected to database.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraNet Systems</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <!-- insert font awesome/icons -->

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        <h1>LibraNet Systems</h1>
    </div>
    
</body>
</html>