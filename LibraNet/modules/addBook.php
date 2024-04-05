<?php
ini_set('log_errors', 1);
ini_set('error_log', 'php-errors.log');

include $_SERVER['DOCUMENT_ROOT'] . "/LibraNet/utilities/DBconnect.php";

class Book {
    public $conn;
    
    public function __construct() {
    $db = new DBconnect("localhost", "root", "", "db_library");
    $this->conn = $db->conn;
    }

    public function saveBook($post) {
        $bookTitle = $post['bookTitle'];
        $bookDescript = $post['bookDescript'];
        $author = $post['author'];
    
        $sql = "INSERT INTO books(bookTitle, bookDescript, author) VALUES (:bookTitle, :bookDescript, :author)";
        $stmt = $this->conn->prepare($sql);
    
        $params = array(
            ':bookTitle' => $bookTitle,
            ':bookDescript' => $bookDescript,
            ':author' => $author
        );
    
        if ($stmt->execute($params)) {
            return json_encode(array("type" => "success", "message" => "Book saved successfully"));
        } else {
            return json_encode(array("type" => "error", "message" => "Book save failed"));
        }
    }
}

// Create a new Book instance and handle saving if 'bookTitle' is POSTed.
     if (isset($_POST['bookTitle'])) {
        $book = new Book();
        $result = $book->saveBook($_POST);
        error_log("saveBook returned: " . print_r($result, true));
        echo $result;
    } 
   

/* 

    error_log("POST data: " . print_r($_POST, true));

if (isset($_POST['addBook'])) {
    error_log("addBook is set in POST data");
    $book = new Book();
    error_log("Book object created: " . print_r($book, true));
    $result = $book->saveBook($_POST);
    error_log("saveBook returned: " . print_r($result, true));
    echo $result;
} else {
    error_log("addBook is not set in POST data");
} */

?>

