<?php
	include 'connect.php';
    session_start();

    if (isset($_SESSION['first_name'])) {
        $session_user = $_SESSION['first_name'];
    }
    else {
        header("Location: ../login.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jennelyn's Bookstore</title>
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
        <link rel="stylesheet" href="css/app-purple.css">
	</head>
	<body>
		 <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="header-block header-block-search">
                        <form role="search">
                            <div class="input-container">
                                <i class="fa fa-search"></i>
                                <input type="search" placeholder="Search">
                                <div class="underline"></div>
                            </div>
                        </form>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <sup>
                                        <span class="counter">
                                            <?php
                                                $get_books = "SELECT * FROM book_info";
                                                $query = mysqli_query($conn, $get_books);
                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    $stocks = $row['book_stocks'];
                                                    $book_id = $row['id'];
                                                    if ($stocks < 10) {
                                                        $sql = "SELECT * FROM stocks WHERE bookid = '$book_id'";
                                                        $rsc = mysqli_query($conn, $sql);
                                                        if ($rsc) {
                                                            $upd = "UPDATE stocks SET book_stocks = '$stocks', status = 'unread' WHERE bookid = '$book_id'";
                                                            mysqli_query($conn, $upd);
                                                        }
                                                    }
                                                }

                                                $notif = "SELECT * FROM stocks WHERE status='unread'";
                                                $sql = mysqli_query($conn, $notif);
                                                $sql_c = mysqli_num_rows($sql);

                                                $get_cart = "SELECT * FROM temp_cart WHERE status = 'unread'";
                                                $result = mysqli_query($conn, $get_cart);
                                                $count = mysqli_num_rows($result);

                                                $total_notif = $sql_c + $count;

                                                if (($count > 0) OR ($sql_c > 0)) {
                                                    echo $total_notif;
                                                }                                            
                                            ?>
                                        </span>
                                    </sup>
                                </a>
                                <div class="dropdown-menu notifications-dropdown-menu">
                                    <ul class="notifications-container">
                                        <?php
                                            $sel = "SELECT * FROM stocks WHERE status = 'unread' ORDER BY 'date_'";
                                            $res_sel = mysqli_query($conn, $sel);
                                            $cnt_sel = mysqli_num_rows($res_sel);
                                            if ($cnt_sel > 0) {
                                                while ($rw = mysqli_fetch_array($res_sel)) {
                                                    echo "<li>
                                                        <a href='view.php?id=". $rw['bookid'] ."' class='notification-item'>
                                                            <div class='img-col'>
                                                                <div class='img'><i class='fa fa-warning fa-2x'></i></div>
                                                            </div>
                                                            <div class='body-col'>
                                                                <p style='";
                                                                        if ($rw['status'] == 'unread') {
                                                                            echo 'font-weight:bold';
                                                                        }
                                                    echo "'>Stocks Alert!<br>The stocks for ";

                                                    $sl = "SELECT * FROM book_info WHERE id = '$rw[bookid]'";
                                                    $rs = mysqli_query($conn, $sl);
                                                    while ($rws = mysqli_fetch_array($rs)) {
                                                        echo $rws['book_title'];
                                                    }

                                                    echo " is now at ". $rw['book_stocks'] ."</p><br>
                                                                <small><i>" . date('F j, Y, g:i a',strtotime($rw['date_'])) . "</i></small>
                                                            </div>
                                                        </a>
                                                    </li>";
                                                }
                                            }

                                            $get_cart = "SELECT * FROM temp_cart WHERE status = 'unread' ORDER BY 'date_' DESC LIMIT 5";
                                            $result = mysqli_query($conn, $get_cart);
                                            $count = mysqli_num_rows($result);
                                            if ($count > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <li>
                                            <a href="notification.php?customer_name=<?php echo $row['customer_name'];?>" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img"><i class="fa fa-shopping-cart fa-2x"></i></div>
                                                </div>
                                                <div class="body-col">
                                                    <p style="
                                                    <?php
                                                        if ($row['status'] == 'unread') {
                                                            echo 'font-weight:bold';
                                                        }

                                                    ?>">New order from <?php echo $row['customer_name']; ?><br>
                                                        <?php
                                                            $customer_name = $row['customer_name'];
                                                            $book_id = $row['bookid'];

                                                            $select = "SELECT book_title FROM book_info WHERE id IN (SELECT bookid FROM temp_cart WHERE customer_name = '$customer_name' AND bookid = '$book_id')";
                                                            $rst = mysqli_query($conn, $select);
                                                            //$count_ = mysqli_num_rows($result);
                                                            if ($book = mysqli_fetch_array($rst)) {
                                                                echo " Book of " . $book['book_title'] . "<br> Quantity: " . $row['quantity'];
                                                            }
                                                            echo "<br><small><i>" . date('F j, Y, g:i a',strtotime($row['date_'])) . "</i></small>";
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                                }
                                            }
                                        
                                        ?>
                                    </ul>
                                    <footer>
                                        <ul>
                                            <li>
                                                <a href=""> View All </a>
                                            </li>
                                        </ul>
                                    </footer>
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('../../assets/images/profile-default.png')"> </div>
                                    <span class="name"> <?php echo $session_user; ?> </span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="profile.php">
                                        <i class="fa fa-user icon"></i> Profile </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">
                                        <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                             <span style='font-family:georgia'>ADMINISTRATOR</span> 
                            </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li>
                                    <a href="index.php">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-book"></i> Books
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="books.php"> All Books </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=Computer"> Computer </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=Economics"> Economics </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=English"> English </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=Filipino"> Filipino </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=History"> History </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=MAPEH"> MAPEH </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=Mathematics"> Mathematics </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=Science"> Science </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=TLE"> TLE </a>
                                        </li>
                                        <li>
                                            <a href="subject.php?book_subject=Values"> Values </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="add_book.php">
                                        <i class="fa fa-plus-square"></i> Add Books
                                    </a>
                                </li>
                                <li class='active'>
                                    <a href="notification.php">
                                        <i class="fa fa-credit-card"></i> Transaction
                                    </a>
                                </li>
                                <li>
                                    <a href="customers.php">
                                        <i class="fa fa-users"></i> Customers </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>

                <article class="content dashboard-page">
                    <section class="section">
                        <?php
                            if (isset($_GET['customer_name'])) {
                                $customer_name = $_GET['customer_name'];

                                echo "<div class='row'>";

                                $get_profile = "SELECT * FROM customer WHERE customer_name = '$customer_name'";
                                $query_get_profile = mysqli_query($conn, $get_profile);
                                $count_get_profile = mysqli_num_rows($query_get_profile);
                                if ($count_get_profile > 0) {
                                    echo "<div class='col-md-4'>";
                                    while ($profile = mysqli_fetch_array($query_get_profile)) {
                                        echo "<h3>PROFILE</h3><br>
                                        <p><b>FULLNAME: </b><i> ". $profile['customer_name'] . "</i></p><br>
                                        <p><b>EMAIL ADDRESS: </b><i> ". $profile['customer_email'] . "</i></p><br>
                                        <p><b>PHONE NUMBER: </b><i> ". $profile['customer_phone'] . "</i></p><br>
                                        <p><b>ADDRESS: </b><i> ". $profile['customer_address'] . "</i></p>";
                                    }
                                    echo "</div>";
                                }
                                echo "<div class='col-md-8'><h3>ORDER</h3>
                                    <table class='table table-bordered table-hover'><thead class='thead-inverse'>
                                        <tr>
                                            <th>#</th>
                                            <th colspan='2'>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>";
                                    $count = 1;
                                    $total_cost = 0;

                                    $get_cart = "SELECT * FROM temp_cart WHERE customer_name = '$customer_name'";
                                    $query_get_cart = mysqli_query($conn, $get_cart);
                                    $count_get_cart = mysqli_num_rows($query_get_cart);

                                    echo "<tbody>";
                                        if ($count_get_cart > 0) {
                                            while ($book = mysqli_fetch_array($query_get_cart)) {
                                                $bookid = $book['bookid'];
                                                $cost = $book['cost'];
                                                $total_cost += $cost;
                                                echo "<tr>
                                                <td><h3>". $count++ ."</h3></td>";
                                                $get_book = "SELECT * FROM book_info WHERE id IN (SELECT bookid FROM temp_cart WHERE customer_name = '$customer_name' AND bookid = '$bookid')";
                                                $query_get_book = mysqli_query($conn, $get_book);
                                                while ($row = mysqli_fetch_array($query_get_book)) {
                                                    echo "<td><img src='../../images/". $row['book_cover'] ."' width='50px' height='80px'></td>
                                                        <td><h3>". $row['book_title'] ."</h3></td>";
                                                }

                                                echo "<td><h3>". $book['quantity'] ."</h3></td>
                                                    <td><h3> ₱". $book['price'] ."</h3></td>
                                                </tr>";
                                            }
                                            echo "<tr><td colspan='6' align='right'><h3>Total: ₱". $total_cost ."</h3></td></tr>";
                                        }

                                echo "<tbody></table>
                                    <div align='right' class='mt-5'>
                                    <form method='GET' action='notification.php'>
                                        <a href='run_notif.php?customer_name=". $customer_name ."&status=cancel_order' class='btn btn-danger' name='cancel_order'>CANCEL ORDER</a>
                                        <a href='run_notif.php?customer_name=". $customer_name ."' class='btn btn-success' name='paid'>PAID</a>
                                    </form>
                                    </div>
                                    </div>
                                </div>";
                            }
                        ?>
                    </section>
                    <section>
                        <?php if (!isset($_GET['customer_name'])) {
                            $num = 0;
                            
                            $select_ = "SELECT * FROM temp_cart";
                            $r_select_ = mysqli_query($conn, $select_);
                        ?>

                        <table class='table table-striped table-bordered table-hover'>
                            <tr>
                                <th> # </th>
                                <th> Customer Name </th>
                                <th> Product </th>
                                <th> Quantity </th>
                                <th> Total Cost </th>
                            </tr>
                            <?php
                            if ($r_select_) {
                                while ($dis = mysqli_fetch_assoc($r_select_)) { ?>
                            <tr>
                                <td><?php echo $num+=1;?></td>
                                <td><?php echo $dis['customer_name'];?></td>
                                <td><?php 
                                    $sle = "SELECT * FROM book_info WHERE id = '$dis[bookid]'";
                                    $fetc = mysqli_query($conn, $sle);
                                    while ($slee = mysqli_fetch_assoc($fetc)) {
                                        echo $slee['book_title'];
                                    }
                                ?></td>
                                <td><?php echo $dis['quantity'];?></td>
                                <td><?php echo '₱'.$dis['cost'];?></td>
                            </tr><?php } ?>
                        </table> 
                        <h5>Download all <a href="../../receipt/transaction.php" class='text-primary' target='_blank'>transaction here!</a></h5>      
                        <?php  }
                            }
                        ?>
                    </section>
                </article>
            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>

	</body>

</html>