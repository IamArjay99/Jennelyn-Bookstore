<?php
  include("../../function/function.php");
  include("../../include/db.php");
  session_start();
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Jennelyn's Bookstore</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body style="margin-top:0px">
  <div class="container-fluid">
  <div class="row"></div></div>
      
  <nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style='color:rgb(0,3,21); font-family:arial'>Jennelyn's Bookstore</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php" style='font-family:verdana; color:rgb(10,20,14)'>Home</a></li>
        </ul>
      </div>
    </div>
  </nav>

  
  <div class="container">
   <section id="formHolder">
    <div class="row">

        <!-- Brand Box -->
         <div class="col-sm-6 brand" style='margin-top:10px;'>

            <div class="heading">
               <h2> A place </h2>
               <h2> isn't a place </h2><hr>
               <p> Until it has a coffee </p><hr>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">
            <!-- Signup Form -->
            <div class="signup form-peice">
               <form class="signup-form" method="post">
                  <span class="error"><?php echo $error; ?></span>
                  <div class="form-group">
                     <label for="name">Full Name</label>
                     <input type="text" name="fullname" id="name" class="name" required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="email">Email Address</label>
                     <input type="email" name="emailAdress" id="email" class="email" required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="address">Address</label>
                     <input type="text" name="address" id="address" class="addr" required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="phone">Phone Number - <small>Optional</small></label>
                     <input type="number" name="phone" id="phone" class='phone' maxlength='11'>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <input type="submit" value="Submit" name="submit" id="submit" class='btn btn-info btn-round' style='margin-top:30px;'>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
    </div>
   </section>

</div>
 
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script src="index.js"></script>
    
  <?php 
    $error = '';

    if(isset($_POST['submit'])){
        $ip = getIpAdd();
        $c_name = $_POST['fullname'];
        $c_email = $_POST['emailAdress'];
        $c_phone = $_POST['phone'];
        $c_address = $_POST['address'];

        $check = "SELECT * FROM temp_cart";
        $rs_check = mysqli_query($conn, $check);
        if ($rs_check) {
          while ($ck = mysqli_fetch_assoc($rs_check)) {
            if ($c_name === $ck['customer_name']) {
              echo "<script>alert('Your name has been already used, Please use another')</script>";
              echo "<script>window.open('checkout.php', '_SELF')</script>";
            }
          }
            $query = "INSERT INTO customer (customer_name, customer_email, customer_phone, customer_address) 
            VALUES ('$c_name', '$c_email', '$c_phone', '$c_address')";
            $result = mysqli_query($conn, $query);
            if($result){
              echo "<script>alert('Successful')</script>";
              $get_items="SELECT * FROM `cart` WHERE `ip_add`='$ip'";
              $run=mysqli_query($conn, $get_items);
              $check_cart = mysqli_num_rows($run);
            if($check_cart==0){
              //$_SESSION['email']=$c_email;
              echo "<script>window.open('index.php','_self')</script>";
            }
            else {
              $_SESSION['customer_name']=$c_name;
              $session_user = $_SESSION['customer_name'];
              
              echo "<script>window.open('payment.php','_self')</script>"; 
            }
          }
        }
    }
  ?>
</body>
</html>
