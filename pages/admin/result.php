<?php
    include 'connect.php';
    include 'run_delete.php';
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
        <title></title>
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
                        <form role="search" method="GET" action="result.php">
                            <div class="input-container">
                                <i class="fa fa-search"></i>
                                <input type="search" name="search_query" placeholder="Search">
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
                                                <a href="notification.php"> View All </a>
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
                                <li class='active'>
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
                                <li>
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
                    <div class="title-block">
                        <h3 class="title"> Jennelyn's Bookstore </h3>
                        <p class="title-description"> Search Books </p>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="card-title-block">
                                        <h3 class="title"> <?php if (isset($_GET['search_query'])) { echo $_GET['search_query']; } ?> </h3>
                                    </div>
                                    <section class="section">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th> Title </th>
                                                    <th> Author </th>
                                                    <th> Publisher </th>
                                                    <th> Copyright </th>
                                                    <th> ISBN </th>
                                                    <th> Stocks </th>
                                                    <th> &nbsp </th>
                                                    <th> &nbsp </th>
                                                    <th> &nbsp </th>
                                                </tr>
                                            </thead>

                                            <?php
                                                if (isset($_GET['search_query'])) {
                                                $search_query = $_GET['search_query'];
                                                $query = "SELECT * FROM book_info WHERE book_title LIKE '%$search_query%' OR book_author LIKE '%$search_query%' OR book_subject LIKE '%$search_query%' OR book_isbn LIKE '%search_query%' OR book_copyright LIKE '%$search_query%' OR book_publisher LIKE '%$search_query%'";
                                                $result = mysqli_query($conn, $query);
                                                $count = mysqli_num_rows($result);

                                                if ($count > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td> <?php echo $row['book_title'];?> </td>
                                                    <td> <?php echo $row['book_author'];?> </td>
                                                    <td> <?php echo $row['book_publisher'];?> </td>
                                                    <td> <?php echo $row['book_copyright'];?> </td>
                                                    <td> <?php echo $row['book_isbn'];?> </td>
                                                    <td> <?php echo $row['book_stocks'];?> </td>
                                                    <td> <a href="view.php?id=<?php echo $row['id'] ?>" class="btn btn-info"> View </a> </td>
                                                    <td> <a href="update.php?id=<?php echo $row['id'] ?>" class="btn btn-success"> Update </a> </td>
                                                    <td> <a href="run_delete.php?book_isbn=<?php echo $row['book_isbn'] ?>" class="btn btn-danger"> Delete </a> </td>
                                                </tr>
                                            </tbody>
                                            <?php
                                                    }
                                                }
                                                else {
                                                    echo "No result";
                                                }
                                                }
                                            ?>

                                        </table>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>

    </body>

</html>
