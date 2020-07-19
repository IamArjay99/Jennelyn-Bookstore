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
	                    <li class="active"><a href="index.php">Home</a></li>
	                    <li><a href="login.php">ADMINISTRATOR</a></li>
	                    <li><a>HI, GUEST</a></li>
	                    <li><a href="cart.php">GO TO CART<span class="badge"><?php total_items(); ?></span></a></li>

	                </ul>
	                <form action="results.php" method="get" class="navbar-form navbar-right">
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

		<div class="row">
            <div class="col-md-12">
                <div class="carousel slide multi-item-carousel" id="theCarousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-xs-4" id="bk1">
                                <img src="../../assets/images/TLE.jpeg">
                                <div class="c-content "><b>Technology and Livelihood Education in the Global Community</b><br> by Cristina A. Villanueva<br><br>
                                    <p>Technology and Livelihood Education in the Global Community is a subject that helps student to be trained about the daily aspects of life and learn daily works</p>
                                    <p></p>

                                </div>

                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-4" id="bk2">
                                <img src="../../assets/images/florante_at_laura.jpg">
                                <div class="c-content "><b>Florante at Laura</b><br> by Francisco Balagtas<br><br>Adapted from some historical pictures or paintings that tell of what happened in early times in the Greek Empire.
                                </div>

                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-4" id="bk4">
                                <img src="../../assets/images/global_math.jpg">
                                <div class="c-content "><b>Global Mathematics</b><br> by Wilfredo A. Abrilla<br><br>This Book provides a fundamental reassessment of mathematics education in the digital era.
                                </div>

                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-4" id="bk3">
                                <img src="../../assets/images/lahing_kayumanggi.jpeg">
                                <div class="c-content "><b>Lahing Kayumaggi</b><br> by Simplicio P. Bisa, Paulina B. Bisa<br>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
                    <a class="right carousel-control" href="#theCarousel" data-slide="next"></a>
                </div>
            </div>
        </div>
        <!-- carosel end -->

        <div class="container-fluid">
        	<div class="row">
	        	<div class="col-lg-2 col-md-2" id="myScrollspy">
	                <ul data-offset-top="225" data-spy="affix" class="nav nav-pills  nav-stacked">
                    	<li role="presentation"><a href="index.php">All books</a></li>
                    	<?php getcats();?>

                	</ul>
	            </div>
	            <div class="col-lg-10 col-md-10" id="mainarea">
	            	<div class="container-fluid">
	            		<?php cart(); ?>
	            		<!-- adding books -->
	            		<div class="row">
	            			<?php
	            				if (isset($_GET['search'])) {
	            					$search_query = $_GET['user_query'];
	            					$sql = "SELECT * FROM book_info WHERE book_title LIKE '%$search_query%' OR book_author LIKE '%$search_query%' OR book_subject LIKE '%$search_query%'";
	            					$result = mysqli_query($conn, $sql);
	            					$queryResult = mysqli_num_rows($result);
	            					//echo $queryResult;
	            					if ($queryResult > 0) {
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
		            				else {
										echo "There are no results matching your search";
									}
								}
	            			?>
	            		</div>
	            	</div>
	            </div>
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

	    <!--<script src="../js/jquery.js"></script>
	    <script src="../js/proper.js"></script>
	    <script src="../js/javascript.js"></script>-->
	</body>
</html>