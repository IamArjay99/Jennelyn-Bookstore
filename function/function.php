<?php
	//session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'jennelyn_bookstore');

	function getIpAdd() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];

	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

	function cart() {
		global $conn;

		$ip = getIpAdd();
		if (isset($_GET['add_cart'])) {
			$book_id = $_GET['add_cart'];
			$defaultQty = 1;
			$check_product = "SELECT * FROM cart WHERE bookid='$book_id' AND ip_add='$ip'";
			$run_check = mysqli_query($conn, $check_product);
		
			if (mysqli_num_rows($run_check) > 0) {
				//$insert_cart = "INSERT INTO cart (bookid, ip_add, quantity) VALUES ('$book_id', '$ip', '$quantity')";
				//$run_cart = mysqli_query($conn, $insert_cart);
				//echo "Already added";
				//echo "<script>window.open('index.php','_self')</script>";
				//echo "<script>window.alert('Already Added');</script>";
				echo "<script>window.open('cart.php?add_cart=$book_id','_self')</script>";
				//newAdded();
			}
			else {
				$insert_cart = "INSERT INTO cart (bookid, ip_add, quantity) VALUES ('$book_id', '$ip', '$defaultQty')";
				$run_cart = mysqli_query($conn, $insert_cart);
				//echo "Added
				echo "<script>window.open('cart.php?add_cart=$book_id','_self')</script>";
			}
		}	
	}

	function total_items() {
		global $conn;

		$ip = getIpAdd();
		if (isset($_GET['add_cart'])) {
			$get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
			$run = mysqli_query($conn, $get_items);
			$count = mysqli_num_rows($run);
		}
		else {
			$get_items = "SELECT * FROM cart WHERE ip_add='$ip'";
			$run = mysqli_query($conn, $get_items);
			$count = mysqli_num_rows($run);	
		}
		echo $count;
	}

	function newAdded() {
		global $conn;
		$ip = getIpAdd();

		if (isset($_GET['add_cart'])) {
			$book_id = $_GET['add_cart'];
			$getcart = "SELECT * FROM book_info WHERE id = $book_id";
			$cart_items = mysqli_query($conn, $getcart);
			$total_price = 0;
			$count = 1;

			if ($book = mysqli_fetch_array($cart_items)) {
				$price_arr = array($book['book_price']);
				$single_price = $book['book_price'];
				//$quantity = $book['quantity'];
				//$single_price = $quantity * $single_price;
				//$total_price += $single_price;
				$book_title = $book['book_title'];
				$book_id = $book['id'];
				$book_stocks = $book['book_stocks'];

				echo "<tr>
					<td scope='row'><h3>". $count++ ."</h3></td>
					<td scope='row' class='td-actions'>
						<h3><div class='checkbox'>
							<label><input type='checkbox'  name='remove[]' value='" . $book['id'] . "' checked></label>
						</div></h3>
					</td>
					<td><img src='../../images/". $book['book_cover'] ."' width='50px' height='80px'></td>
					<td><h3>". $book_title ."</h3></td>
					<td><h3><input type='number' name='update_quantity' min='0' max='$book_stocks' class='text-right' value='";

				$sql = "SELECT * FROM cart WHERE bookid IN (SELECT id FROM book_info WHERE id='$book_id')";
				$result = mysqli_query($conn, $sql);

				if ($row = mysqli_fetch_array($result)) {
					$quantity = $row['quantity'];
					echo $row['quantity'];
				}
				$total_qty = $quantity * $single_price;
				$newQuantity = $quantity;
				$newTotal_qty = $total_qty;
				$total_price += $newTotal_qty;

				echo "'></h3></td>
					<td><h3> ₱". $single_price ."</h3></td>
				</tr>";
			}
			echo "<tr><td colspan='6' align='right'><h3>TOTAL: ₱". $total_price ."</h3></td></tr>";
		}
	}

	function mycart() {
		global $conn;

		$ip = getIpAdd();
		$getcart = "SELECT * FROM book_info WHERE id IN (SELECT bookid FROM cart WHERE ip_add LIKE '::1')";
		//$qty = "SELECT * FROM cart";
		$cart_items = mysqli_query($conn, $getcart);
		$total_price = 0;
		$count = 1;

		while ($book = mysqli_fetch_array($cart_items)) {
			$price_arr = array($book['book_price']);
			$single_price = $book['book_price'];
			//$quantity = $book['quantity'];
			//$single_price = $quantity * $single_price;
			//$total_price += $single_price;
			$book_title = $book['book_title'];
			$book_id = $book['id'];

			echo "<tr>
				<td scope='row'><h3>". $count++ ."</h3></td>
				<td scope='row' class='td-actions'>
					<h3><div class='checkbox'>
						<label><input type='checkbox'  name='remove[]' value='" . $book['id'] . "'></label>
					</div></h3>
				</td>
				<td><img src='../../images/". $book['book_cover'] ."' width='50px' height='80px'></td>
				<td><h3>". $book_title ."</h3></td>
				<td><h3>";

			$sql = "SELECT * FROM cart WHERE bookid IN (SELECT id FROM book_info WHERE id='$book_id')";
			$result = mysqli_query($conn, $sql);

			while ($row = mysqli_fetch_array($result)) {
				$quantity = $row['quantity'];
				echo $row['quantity'];
			}
			$total_qty = $quantity * $single_price;
			$newQuantity = $quantity;
			$newTotal_qty = $total_qty;
			$total_price += $newTotal_qty;

			echo "</h3></td>
				<td><h3> ₱". $single_price ."</h3></td>
			</tr>";
		}
		echo "<tr><td colspan='6' align='right'><h3>TOTAL: ₱". $total_price ."</h3></td></tr>";
	}

	function getcats() {
		global $conn;

		$query = "SELECT * FROM subjects";
		$result = mysqli_query($conn, $query);
		$fetch = mysqli_num_rows($result);
		if ($fetch > 0) {
			while ($row = mysqli_fetch_array($result)) {
				echo "<li role='presentation'><a href='index.php?book_subject=". $row['name'] ."'>". $row['name'] ."</a></li>";
			}
			
		}

	}

	function getbooks() {
		global $conn;

		if (!isset($_GET['book_subject'])) {
			$query = "SELECT * FROM book_info ORDER BY book_title ASC";
			$result = mysqli_query($conn, $query);

			while ($row = mysqli_fetch_array($result)) {
				echo "<div class='col-lg-4 col-md-6'>
					<div class='card'>
						<img class='card-img' height='200px' width='100px' src='../../images/". $row['book_cover'] ."'>
						<span class='content-card'>
							<h6>". $row['book_title'] ."</h6>
							<h7>". $row['book_author'] ."</h7>
						</span>
						<a href='index.php?add_cart=". $row['id'] ."'><button class='buybtn btn btn-warning btn-round btn-sm'> Add <i class='material-icons'></i></button></a>
						<button class='knowbtn btn btn-warning btn-round btn-sm' data-toggle='modal' data-target='#".$row['id']."'>Know more</button>";

				echo "<div class='modal fade' id='".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		                <div class='modal-dialog'>
		                	<div class='modal-content'>
		                		<div class='modal-header'>
		                			<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
		                			<h4 class='modal-title' id='myModalLabel'>".$row['book_title']."</h4>
		                		</div>
		                		<div class='modal-body'>
		                			".$row['book_description']."<br>". $row['book_copyright'] ."
		                			<br>". $row['book_publisher'] ."<h3 align='right'>₱". $row['book_price'] ."</h3>
		                		</div>
		                	</div>
		                </div>
                    </div>
                    	</div>
                    </div>";    
			}
		}
	}

	function get_bycat() {
		global $conn;

		if (isset($_GET['book_subject'])) {
			$subject_id = $_GET['book_subject'];
			$query = "SELECT * FROM book_info WHERE book_subject = '$subject_id'";
			$result = mysqli_query($conn, $query);
			$count_subject = mysqli_num_rows($result);

			if ($count_subject == 0) {
				echo "<h2>No books found</h2>";
			}
			while ($row = mysqli_fetch_array($result)) {
				echo "<div class='col-lg-4 col-md-6'>
					<div class='card'>
						<img class='card-img' height='200px' width='100px' src='../../images/". $row['book_cover'] ."'>
						<span class='content-card'>
							<h6>". $row['book_title'] ."</h6>
							<h7>". $row['book_author'] ."</h7>
						</span>
						<a href='index.php?add_cart=". $row['id'] ."'><button class='buybtn btn btn-warning btn-round btn-sm'> Add <i class='material-icons'></i></button></a>
						<button class='knowbtn btn btn-warning btn-round btn-sm' data-toggle='modal' data-target='#".$row['id']."'>Know more</button>";

				echo "<div class='modal fade' id='".$row['id']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		                <div class='modal-dialog'>
		                	<div class='modal-content'>
		                		<div class='modal-header'>
		                			<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
		                			<h4 class='modal-title' id='myModalLabel'>".$row['book_title']."</h4>
		                		</div>
		                		<div class='modal-body'>
		                			".$row['book_description']."<br>". $row['book_copyright'] ."
		                			<br>". $row['book_publisher'] ."<h3 align='right'>₱". $row['book_price'] ."</h3>
		                		</div>
		                	</div>
		                </div>
                    </div>
                    	</div>
                    </div>";    
			}
		}
	}
?>


