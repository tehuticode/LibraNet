<?php
require_once "modules/addBook.php";
include_once "utilities/DBconnect.php";
$db = new DBconnect("localhost", "root", "", "db_library");
$conn = $db->getConnection();

if (!$conn) {
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
                            <button class="btn btn-success btn-md" data-bs-toggle="modal" data-bs-target="#addBook">Add Book</button>
                        </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="15%">ID</th>
                                    <th width="55%">Title</th> 
                                    <th width="30%">Management</th>      
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //Get all book list
                             $book = new Book();
                             $books = $book->getBooks();
                             $no = 0;
                             foreach ($books as $book):
                                $no++;
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td>
                                    <h4><?php echo $book['bookTitle']; ?></h4>
                                   <small><?php echo $book['author']; ?></small> 
                                <td>
                                <button class="btn btn-primary btn-sm editButton"  id="<?php echo isset($book['bookID']) ? $book['bookID'] : ''; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit Book</button>
                                    <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete Book</button>
                                </td>
                             </tr>
                             <?php endforeach; ?>
                               
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        

<!-- Modal for adding new book -->
<div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-book-open"></i> Add Book</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addBookForm">
            <div class="form-group">
                <label for="bookTitle">Title</label>
                <input type="text" name="bookTitle" class="form-control" required placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="bookDescript">Description</label>
                <input type="text" name="bookDescript" class="form-control" required placeholder="Brief description">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" class="form-control" required placeholder="Enter author">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addBookBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for editing details of book -->
<div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-pen-to-square"></i> Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editBookForm">
            <div class="form-group">
                <label for="bookTitle">Title</label>
                <input type="text" name="bookTitle" id="editBookTitle" class="form-control" required placeholder="Enter title">
                <input type="hidden" name="editId" id="bookId">
            </div>
            <div class="form-group">
                <label for="bookDescript">Description</label>
                <input type="text" name="bookDescript" id="editBookDescript" class="form-control" required placeholder="Brief description">
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="editAuthor" class="form-control" required placeholder="Enter author">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editBookBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for alerts -->
<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Alert</h1>
     
      <div class="modal-body">
        <div class="alert"></div>
      </div>
    </div>
  </div>
</div>


<!--jQuery -->
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $("#addBookBtn").on('click', function(){
            event.preventDefault();
            $.post('modules/addBook.php', $('form#addBookForm').serialize(), function(data){
                var data = JSON.parse(data);
                
                if (data.type == 'success') {
                    $('#addBook').modal('hide');
                    $('#alert').modal('show');
                    $('#alert.alert').addClass('alert-success').append(data.message).delay(20000).fadeOut('slow', function(){
                       location.reload();
                    });
                }else {
                    $('#addBook').modal('hide');
                    $('#alert').modal('show');
                    $('#alert.alert').addClass('alert-danger').append(data.message).delay(20000).fadeOut('slow', function(){
                       location.reload();
                    });
                }
            });
        });

      $(".editButton").on('click', function(e){
          $('#editBookModal').modal('show');
          e.preventDefault();
          $.post('modules/addBook.php', {editId: e.target.id}, function(data){
              try {
                  var parsedData = JSON.parse(data);
                  $('#editBookTitle').val(parsedData.bookTitle);
                  $('#bookDescript').val(parsedData.bookDescript);
                  $('#author').val(parsedData.author);
                  $('#BookId').val(parsedData.bookId);
              } catch (error) {
                  console.error("Parsing error: ", error);
                  console.log("Raw response: ", data);
              }
    });
});
    });

    
</script> -->
<script type="text/javascript">
   // Wait for the document to be fully loaded
$(document).ready(function(){

// Function to handle the response from server
function handleResponse(data, successClass, failureClass) {
    // Hide the addBook modal
    $('#addBook').modal('hide');
    // Show the alert modal
    $('#alert').modal('show');
    // Determine the class for the alert based on the response type
    var alertClass = data.type === 'success' ? successClass : failureClass;
    // Add the alert class, append the message, delay for 15 seconds, fade out and then reload the page
    $('#alert.alert').addClass(alertClass).append(data.message).delay(15000).fadeOut('slow', function(){
        location.reload();
    });
}

// Function to handle POST requests
function handlePost(url, data, success) {
    // Make a POST request to the specified URL with the provided data
    $.post(url, data, function(response){
        try {
            // Try to parse the response
            var parsedData = JSON.parse(response);
            // Call the success function with the parsed data
            success(parsedData);
        } catch (error) {
            // Log any parsing errors
            console.error("Parsing error: ", error);
            console.log("Raw response: ", response);
        }
    });
}

// Event handler for the addBookBtn click event
$("#addBookBtn").on('click', function(event){
    // Prevent the default form submission
    event.preventDefault();
    // Make a POST request to add a book
    handlePost('modules/addBook.php', $('form#addBookForm').serialize(), function(data) {
        // Handle the response
        handleResponse(data, 'alert-success', 'alert-danger');
    });
});

// Event handler for the editButton click event
$(".editButton").on('click', function(e){
    // Show the editBookModal
    $('#editBookModal').modal('show');
    // Prevent the default action
    e.preventDefault();
    // Make a POST request to get the book details
    handlePost('modules/addBook.php', {editId: e.target.id}, function(data) {
        // Fill the form fields with the book details
        $('#editBookTitle').val(data.bookTitle);
        $('#editBookDescript').val(data.bookDescript);
        $('#editAuthor').val(data.author);
        $('#bookID').val(data.bookID);
        
    });
});
});
</script>

</body>
</html>
