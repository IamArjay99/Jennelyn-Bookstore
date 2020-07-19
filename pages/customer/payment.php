<?php
	include '../../include/db.php';
	include '../../function/function.php';
	session_start();
	if (isset($_SESSION['customer_name'])) {
        $session_user = $_SESSION['customer_name'];
    }
    else {
        header("Location: checkout.php");
    }
?>
<!DOCTYPE>
<html lang="en">
	<head>
		<meta charset="UTP-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Jennelyn's Bookstore</title>

		<!-- Book-store-master -->
		<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
    	<link href="../../assets/css/material-kit.css" rel="stylesheet" />
    	<link href="../../assets/css/styles.css" rel="stylesheet" />
	</head>
	<body>
			<nav class="navbar navbar-fixed-top" role="navigation" id="topnav">
	        <div class="container-fluid">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	    		</button>
	                <a class="navbar-brand" id="id_title">Jennelyn's Bookstore</a>
	            </div>

	            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav">
	                    <li><a>Home</a></li>
	                    <li><a href="logout.php">Buy again</a></li>
	                    <li><a>HI, <?php echo $session_user;?></a></li>
	                    <li class="active"><a>GO TO CART <span class="badge"><?php total_items(); ?></span></a></li>
	                </ul>
	                <form action="results.php" method="GET" class="navbar-form navbar-right">
	                    <div class="form-group label-floating">
	                        <label class="control-label">Search Books</label>
	                        <input type="text" name="user_query" class="form-control" disabled>
	                    </div>
	                    <button type="submit" name="search" class="btn btn-round btn-just-icon btn-primary" disabled><i class="material-icons">search</i><div class="ripple-container"></div></button>
	                </form>
	            </div>
	        </div>
	    </nav>
	    <!-- end of navbar -->
	    <div class='container'>
		    <div class="row">
		    	<div class="col-md-1"></div>
		    	<div class="col-md-10">
		    		<h3>Summary of your order:</h3>
		    		<table class='table table-inverse'>
		    			<thead class="thead-inverse">
			    			<tr>
			    				<th>#</th>
			    				<th>Product</th>
			    				<th>Name</th>
			    				<th>Quantity</th>
			    				<th>Price</th>
			    			</tr>
		    			</thead>
		    			<tbody>
		    				<?php mycart_payment() ?>
		    				<h4>Download your <a href="../../receipt/receipt.php" target="_blank">receipt here!</a></h4>
		    			</tbody>
		    		</table>
		    	</div>
		    	<div class="col-md-1"></div>
		    </div>
	    </div>

        <!--   Core JS Files   -->
		<script src="../../assets/js/jquery.min.js" type="text/javascript"></script>
		<script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="../../assets/js/material.min.js"></script>

		<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
		<script src="../../assets/js/nouislider.min.js" type="text/javascript"></script>

		<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
		<script src="../../assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

		<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
		<script src="../../assets/js/material-kit.js" type="text/javascript"></script>
		<script src="../../assets/js/carousel.js" type="text/javascript"></script>
		<script src="../../assets/js/myscripts.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	
		<?php

			$conn = mysqli_connect("localhost", "root", "", "jennelyn_bookstore");

			function mycart_payment() {
				global $conn;
				$session_user = $_SESSION['customer_name'];

				$ip = getIpAdd();
				$getcart = "SELECT * FROM book_info WHERE id IN (SELECT bookid FROM cart WHERE ip_add LIKE '::1')";
				$cart_items = mysqli_query($conn, $getcart);
				$total_price = 0;
				$count = 1;
				$total_quantity = 0;

				while ($book = mysqli_fetch_array($cart_items)) {
					$price_arr = array($book['book_price']);
					$single_price = $book['book_price'];
					$book_title = $book['book_title'];
					$book_id = $book['id'];
					$book_stocks = $book['book_stocks'];

					echo "<tr>
						<td scope='row'><h3>". $count++ ."</h3></td>
						<td><img src='../../images/". $book['book_cover'] ."' width='50px' height='80px'></td>
						<td><h3>". $book_title ."</h3></td>
						<td><h3>";

					$sql = "SELECT * FROM cart WHERE ip_add='$ip' AND bookid='$book_id'";
					$result = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_array($result)) {
						$quantity = $row['quantity'];
						echo $row['quantity'];
						$cost = $quantity * $single_price;
						$insert_tempcart = "INSERT INTO temp_cart (ip_add, customer_name, bookid, quantity, price, cost, status) 
						VALUES ('$ip', '$session_user', '$book_id', '$quantity', '$single_price', '$cost', 'unread') ";
						$rs1 = mysqli_query($conn, $insert_tempcart);

						/*$update_stocks = $book_stocks - $quantity;
						$update_stocks = "UPDATE book_info SET book_stocks = '$update_stocks' WHERE id = '$book_id'";
						mysqli_query($conn, $update_stocks);*/
					}
					$total_quantity += $quantity;
					$total_qty = $quantity * $single_price;
					$newQuantity = $quantity;
					$newTotal_qty = $total_qty;
					$total_price += $newTotal_qty;

					echo "</h3></td>
						<td><h3> ₱". $single_price ."</h3></td>
					</tr>";
				}
				echo "<tr><td colspan='6' align='right'><h3>TOTAL: ₱". $total_price ."</h3></td>";
				//echo "<td>" . $total_quantity . "</td></tr>";

			}
		?>

	</body>
</html>