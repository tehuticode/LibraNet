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
    <!--icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-book"></i>
                        Libra<span>Net</span>
                    </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <button class="btn btn-success btn-md">Add Book</button>
                        </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="15%">ID</th>
                                    <th width="55%">Title</th> 
                                    <th width="30%">Manage Book</th>      
                                </tr>
                            </thead>
                            <tbody>
                                <td>12345</td>
                                <td>ABC</td>
                                <td>
                                    <button class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit Book</button>
                                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete Book</button>
                                </td>
                            
                               
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
</body>
</html>
