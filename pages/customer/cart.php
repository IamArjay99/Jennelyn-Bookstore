<?php
	include '../../include/db.php';
	include '../../function/function.php';
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
	                <a class="navbar-brand" href="index.php" id="id_title">Jennelyn's Bookstore</a>
	            </div>

	            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav">
	                    <li><a href="index.php">Home</a></li>
	                    <li><a href="../login.php">ADMINISTRATOR</a></li>
	                    <li><a>HI, GUEST</a></li>
	                    <li class="active"><a href="cart.php">GO TO CART<span class="badge"><?php total_items(); ?></span></a></li>
	                </ul>
	                <form action="results.php" method="GET" class="navbar-form navbar-right">
	                    <div class="form-group label-floating">
	                        <label class="control-label">Search Books</label>
	                        <input type="text" name="user_query" class="form-control">
	                    </div>
	                    <button type="submit" name="search" class="btn btn-round btn-just-icon btn-primary"><i class="material-icons">search</i><div class="ripple-container"></div></button>
	                </form>
	            </div>
	        </div>
	    </nav>
	    <!-- end of navbar -->

	    <div class="container">
	    	<table class="table-striped table">
	    		<thead class="thead-inverse">
	    			<tr>
	    				<th>#</th>
	    				<th>Edit</th>
	    				<th colspan='2'>Product</th>
	    				<th>Quantity</th>
	    				<th>Price</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<form method="POST"> 
	    				<?php
	    					if (isset($_GET['bookid'])) {
	    						newAdded();
	    					echo "<div align='right'>
	    						<button name='update_cart' type='submit' class='btn btn-success'>Update</button>
	    						<button name='delete_cart' type='submit' class='btn btn-danger'>Delete</button>
	    					</div>";
	    					}
	    					else {
	    						if (isset($_GET['add_cart'])) {
	    						newAdded();
	    					echo "<div align='right'>
	    						<button name='update_cart' type='submit' class='btn btn-success'>Update</button>
	    						<button name='delete_cart' type='submit' class='btn btn-danger'>Delete</button>
	    					</div>";
	    						}
	    						else {
	    						mycart();
	    					echo "<div align='right'>
	    						<button name='delete_cart' type='submit' class='btn btn-danger'>Delete</button>
	    					</div>";
	    						}
	    					}
	    				?>
	    			</form>
	    		</tbody>
	    	</table>
	    </div>

	    <?php 
	    	if (!isset($_GET['add_cart'])) {
	    		echo '<div class="container" align="left" >
	    			<h3><a style="text-decoration:none" href="checkout.php">CHECKOUT</a></h3>
        		</div>';
	    	}
	    ?>

        <?php
        	$ip = getIpAdd();

        	if (isset($_POST['delete_cart'])) {
        		if (isset($_POST['remove'])) {
        			foreach ($_POST['remove'] as $remove_id) {
        				$delete_books = "DELETE FROM cart WHERE bookid = '$remove_id' AND ip_add = '$ip'";
        				$run_delete = mysqli_query($conn, $delete_books);
        				if ($run_delete) {
        					header("Refresh:0.5; URL=cart.php");
        				}
        			}
        		}	
        	}
        	if (isset($_POST['update_cart'])) {
        		if (isset($_POST['remove'])) {
        			foreach ($_POST['remove'] as $update_id) {
        				$newQuantity = $_POST['update_quantity'];
        				$update_books = "UPDATE cart SET quantity='$newQuantity' WHERE bookid IN (SELECT id FROM book_info WHERE id='$update_id') AND ip_add = '$ip'";
	        			$run_update = mysqli_query($conn, $update_books);
	        			if ($run_update) {
	        				header("Refresh:0.5; URL=cart.php");
	        				//echo "Updated successfully";
	        			}
        			}
        		}	
        	}

        ?>

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

	    <!--<script src="../js/jquery.js"></script>
	    <script src="../js/proper.js"></script>
	    <script src="../js/javascript.js"></script>-->
	</body>
</html>