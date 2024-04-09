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
    //Retrieve books from db
    public function getBooks() {
        $sql = "SELECT * FROM books";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $books;
    }
//Edit books in db
    public function editBook($editId) {
        $sql = "SELECT * FROM books WHERE bookID = :editId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':editId' => $editId]);
        
        //Attmepting to log error to see if the editId is being passed
        error_log("SQL query: $sql");
        error_log("editId: $editId");
        error_log("Number of rows: " . $stmt->rowCount());
        
        if($stmt->rowCount() > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data['bookID'] = $row['bookID'];
                $data['bookTitle'] = $row['bookTitle'];
                $data['bookDescript'] = $row['bookDescript'];
                $data['author'] = $row['author'];
            }
    
            return json_encode($data);
        } else {
            return json_encode(array("type" => "error", "message" => "No book found with the provided ID"));
        }
    }
 
    public function updateBook($post) {
        $bookID = $post['bookID'];
        $bookTitle = $post['updateBookTitle'];
        $bookDescript = $post['bookDescript'];
        $author = $post['author'];
    
        $sql = "UPDATE books SET bookTitle = :bookTitle, bookDescript = :bookDescript, author = :author WHERE bookID = :bookID";
        $stmt = $this->conn->prepare($sql);
    
        $params = array(
            ':bookID' => $bookID,
            ':bookTitle' => $bookTitle,
            ':bookDescript' => $bookDescript,
            ':author' => $author
        );
    
        if ($stmt->execute($params)) {
            return json_encode(array("type" => "success", "message" => "Book updated successfully"));
        } else {
            return json_encode(array("type" => "error", "message" => "Book update failed"));
        }
    }
    
}

// This code is responsible for handling book-related operations in LibraNet
$book = new Book();

if (isset($_POST['bookTitle'])) {
    $result = $book->saveBook($_POST);
    error_log("saveBook returned: " . print_r($result, true));
    echo $result;
}

if(isset($_POST['editId'])){
    $result = $book->editBook($_POST['editId']);
    error_log("editId returned: " . print_r($result, true));
    echo $result;
}

if(isset($_POST['bookID'])){
    $result = $book->updateBook($_POST);
    echo $result;
}


?>

