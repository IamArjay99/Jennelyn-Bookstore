<?php
	include 'connect.php';
    session_start();

    if (isset($_SESSION['first_name'])) {
        $session_user = $_SESSION['first_name'];
    }
    else {
        header("Location: ../login.php");
    }

    if (isset($_GET['customer_name'])) {
        $customer_name = $_GET['customer_name'];
        if (isset($_GET['status'])) {
            $delete = "DELETE FROM temp_cart WHERE customer_name = '$customer_name'";
            $delete2 = "DELETE FROM customer WHERE customer_name = '$customer_name'";
            mysqli_query($conn, $delete2);
            if ($run_delete = mysqli_query($conn, $delete)) {
                header("Location: index.php");
            }
            else {
                header("Location: notification.php?customer_name=$customer_name");
            }
        }
    }

    if (isset($_GET['customer_name'])) {
        $customer_name = $_GET['customer_name'];
        if (!isset($_GET['status'])) {
            $query = "UPDATE temp_cart SET status = 'read' WHERE customer_name = '$customer_name'";
            $rs = mysqli_query($conn, $query);
            if ($rs) {
                $slct = "SELECT * FROM book_info WHERE id IN (SELECT bookid FROM temp_cart WHERE customer_name = '$customer_name')";
                $r_slct = mysqli_query($conn, $slct);
                if ($r_slct) {
                    while ($bk = mysqli_fetch_array($r_slct)) {
                        $book_stocks = $bk['book_stocks'];
                        $book_id = $bk['id'];

                        $lc = "SELECT * FROM temp_cart WHERE customer_name = '$customer_name' AND bookid = '$book_id'";
                        if ($rlc = mysqli_query($conn, $lc)) {
                            while ($bk2 = mysqli_fetch_array($rlc)) {
                                $temp_qty = $bk2['quantity'];

                                $update_stocks = $book_stocks - $temp_qty;
                                $update_stocks = "UPDATE book_info SET book_stocks = '$update_stocks' WHERE id = '$book_id'";
                                $rsupdt = mysqli_query($conn, $update_stocks);
                                if ($rsupdt) {
                                    header("Location: index.php");
                                }
                            }
                        }
                    }
                }
            }
            else {
                header("Location: notification.php?customer_name=$customer_name");
            }
        }
    }
?>