<?php
    include 'connect.php';

    if (isset($_GET['book_isbn'])) {
        $book_isbn = $_GET['book_isbn'];
        $sql = "DELETE FROM book_info WHERE book_isbn = '$book_isbn'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Deleted Successfully')</script>";
            echo "<script>window.open('books.php', '_SELF')</script>";
        }
        
    }



?>