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
                                            $sel = "SELECT * FROM stocks WHERE status = 'unread' ORDER BY 'date_' DESC LIMIT 10";
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

                                                    $sl = "SELECT * FROM book_info WHERE id = '$rw[bookid]' ORDER BY id DESC LIMIT 10";
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
                                <li class='active'>
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
                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="col col-12 col-sm-12 col-md-6 col-xl-5 stats-col">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title"> Stats </h4>
                                            <p class="title-description"><hr></p>
                                        </div>
                                        <div class="row row-sm stats-container">
                                            <div class="col-12 col-sm-6 stat-col">
                                                <div class="stat-icon">
                                                    <i class="fa fa-rocket"></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value">
                                                    <?php
                                                        $sl = "SELECT * FROM book_info";
                                                        $rsl = mysqli_query($conn, $sl);
                                                        $csl = mysqli_num_rows($rsl);
                                                        if ($csl > 0) {
                                                            echo $csl;
                                                        }
                                                    ?></div>
                                                    <div class="name"> Active items </div>
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: <?php echo ($csl/100)*100;?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 stat-col">
                                                <div class="stat-icon">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value">
                                                    <?php
                                                        $total = 0;
                                                        $get_user = "SELECT * FROM temp_cart";
                                                        $r_user = mysqli_query($conn, $get_user);
                                                        $c_user = mysqli_num_rows($r_user);
                                                        if ($c_user > 0) {
                                                            while ($wr = mysqli_fetch_array($r_user)) {
                                                                $item_sold = $wr['quantity'];
                                                                $total += $item_sold;
                                                            }
                                                            echo $total;
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class="name"> Items sold </div>
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: <?php echo ($total/2000)*100;?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6  stat-col">
                                                <div class="stat-icon">
                                                    <i class="fa fa-line-chart"></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value">
                                                    <?php
                                                        //$total = 0;
                                                        $get_user = "SELECT * FROM temp_cart";
                                                        $r_user = mysqli_query($conn, $get_user);
                                                        $c_user = mysqli_num_rows($r_user);
                                                        if ($c_user > 0) {
                                                            while ($wr = mysqli_fetch_array($r_user)) {
                                                                $item_sold = $wr['cost'];
                                                                $total += $item_sold;
                                                            }
                                                            $monthly = $total/12;
                                                            echo "₱".round($monthly);
                                                        }
                                                    ?>
                                                    </div>
                                                    <div class="name"> Monthly income </div>
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: <?php echo ($monthly/50000)*100?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6  stat-col">
                                                <div class="stat-icon">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value"> 
                                                    <?php
                                                        $get_user = "SELECT * FROM customer";
                                                        $r_user = mysqli_query($conn, $get_user);
                                                        $c_user = mysqli_num_rows($r_user);
                                                        echo $c_user;
                                                    ?> </div>
                                                    <div class="name"> Total users </div>
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: <?php echo ($c_user/100)*100?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6  stat-col">
                                                <div class="stat-icon">
                                                    <i class="fa fa-line-chart"></i>
                                                </div>
                                                <div class="stat">
                                                    <div class="value">
                                                    <?php
                                                        $weekly = $monthly/4; 
                                                        echo "₱".round($weekly);
                                                    ?>
                                                    </div>
                                                    <div class="name"> Weekly income </div>
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: <?php echo ($weekly/10000)*100?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 stat-col">
                                                <div class="stat-icon">
                                                    <span>₱</span>
                                                </div>
                                                <div class="stat">
                                                    <div class="value"> 
                                                    <?php
                                                        $total_ = 0;
                                                        $ds = "SELECT * FROM temp_cart";
                                                        $dss = mysqli_query($conn, $ds);
                                                        $dsss = mysqli_num_rows($dss);
                                                        if ($dsss > 0) {
                                                            while ($pq = mysqli_fetch_array($dss)) {
                                                                $item_sold_ = $pq['cost'];
                                                                $total_ += $item_sold_;
                                                            }
                                                            echo "₱".round($total_);
                                                        }
                                                    ?></div>
                                                    <div class="name"> Total income </div>
                                                </div>
                                                <div class="progress stat-progress">
                                                    <div class="progress-bar" style="width: <?php echo ($total/1000000)*100?>%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-12 col-sm-12 col-md-6 col-xl-7 history-col">
                                <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                                    <div class="card-header bordered">
                                        <div class="header-block">
                                            <h3 class="title"> Recently Added </h3>
                                            <a href="add_book.php" class="btn btn-primary btn-sm"> Add new </a>
                                        </div>
                                    </div>
                                    <ul class="item-list striped">
                                        <li class="item item-list-header">
                                            <div class="item-row">
                                                <div class="item-col item-col-header fixed item-col-img xs"></div>
                                                <div class="item-col item-col-header item-col-title">
                                                    <div>
                                                        <span>Title</span>
                                                    </div>
                                                </div>
                                                <div class="item-col item-col-header item-col-sales">
                                                    <div>
                                                        <span>Sales</span>
                                                    </div>
                                                </div>
                                                <div class="item-col item-col-header item-col-stats">
                                                    <div class="no-overflow">
                                                        <span>Stocks</span>
                                                    </div>
                                                </div>
                                                <div class="item-col item-col-header item-col-date">
                                                    <div>
                                                        <span>Published</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <?php
                                                $get_data = "SELECT * FROM book_info ORDER BY id DESC LIMIT 4";
                                                $qp = mysqli_query($conn, $get_data);
                                                $cqp = mysqli_num_rows($qp);
                                                if ($cqp > 0) {
                                                    while ($disp = mysqli_fetch_array($qp)) {
                                            ?>
                                            <div class="item-row">
                                                <div class="item-col fixed item-col-img xs">
                                                    <a href="view.php?id=<?php echo $disp['id'] ?>">
                                                        <div class="item-img xs rounded" style="background-image: url('../../images/<?php echo $disp['book_cover'];?>')"></div>
                                                    </a>
                                                </div>
                                                <div class="item-col item-col-title no-overflow">
                                                    <div>
                                                        <a href="view.php?id=<?php echo $disp['id'] ?>" class="">
                                                            <h4 class="item-title no-wrap"> <?php echo $disp['book_title'];?> </h4>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="item-col item-col-sales">
                                                    <div class="item-heading">Sales</div>
                                                    <div> <?php
                                                        $total_sales = 0;
                                                        $sales = "SELECT * FROM temp_cart WHERE bookid = '$disp[id]'";
                                                        $rs_sales = mysqli_query($conn, $sales);
                                                        while ($saless = mysqli_fetch_assoc($rs_sales)) {
                                                            $total_sales += $saless['quantity'];
                                                        }
                                                        echo $total_sales;
                                                    ?> </div>
                                                </div>
                                                <div class="item-col item-col-stats">
                                                    <div class="item-heading">Stocks</div>
                                                    <div> <?php echo $disp['book_stocks'];?> </div>
                                                </div>
                                                <div class="item-col item-col-date">
                                                    <div class="item-heading">Published</div>
                                                    <div> <?php echo date('F j, Y',strtotime($disp['time_added']));?> </div>
                                                </div>
                                            </div>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="section">
                        <div class="row sameheight-container">
                            
                        </div>
                    </section>
                </article>

            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>

	</body>

</html>
