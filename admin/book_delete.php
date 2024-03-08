<?php
include("connection.php");
include("navbar.php");
?>

<?php

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $delete_query = "DELETE FROM books WHERE bid = $book_id";
    if (mysqli_query($db, $delete_query)) {
        ?>
        <script>
            alert("Book Deleted");
            window.location = "books.php";
        </script>
        <?php
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($db);
    }
} else {
    echo "Book ID not specified.";
}
?>