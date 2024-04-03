<?php
ini_set('log_errors', 1);
ini_set('error_log', 'php-errors.log');

include $_SERVER['DOCUMENT_ROOT'] . "/LibraNet/utilities/DBconnect.php";

class Book {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function saveBook($post) {
        $requiredFields = ['bookTitle', 'bookDescript', 'author'];
        foreach ($requiredFields as $field) {
            if (empty($post[$field])) {
                return json_encode(["type" => "error", "message" => "Missing required field: $field"]);
            }
        }

        $bookTitle = $post['bookTitle'];
        $bookDescript = $post['bookDescript'];
        $author = $post['author'];

        $sql = "INSERT INTO books (bookTitle, bookDescript, author) VALUES (:bookTitle, :bookDescript, :author)";
        $stmt = $this->conn->prepare($sql);

        $result = $stmt->execute([
            'bookTitle' => $bookTitle,
            'bookDescript' => $bookDescript,
            'author' => $author
        ]);

        if ($result) {
            return json_encode(["type" => "success", "message" => "Book saved successfully"]);
        } else {
            error_log("Book save failed: " . $stmt->errorInfo()[2]);
            return json_encode(["type" => "error", "message" => "Book save failed"]);
        }
    }
}

// Create a new Book instance and handle saving if 'addBook' is POSTed.
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addBook'])) {
    $db = new DBconnect("localhost", "root", "", "db_library");
    $book = new Book($db->getConnection());
    echo $book->saveBook($_POST);
}
?>

