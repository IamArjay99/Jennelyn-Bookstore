<?php
    include 'admin/connect.php';
    session_start();
?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Jennelyn's Bookstore </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="admin/css/vendor.css">
        <!-- Theme initialization -->
        <link rel="stylesheet" href="admin/css/app-purple.css">
    </head>

    <?php
        if (isset($_GET['login'])) {
            $username = mysqli_real_escape_string($conn, $_GET['username']);
            $password = mysqli_real_escape_string($conn, $_GET['password']);

            $sql = "SELECT * FROM admin WHERE admin_username='$username' AND admin_password='$password'";

            $result = $conn->query($sql);

            if (!$row = $result->fetch_assoc()) {
                $msg = "Your username or password is incorrect!";
                echo "<script type='text/javascript'>alert('$msg')</script>";
            }
            else {
                $_SESSION['first_name'] = $row['first_name'];
                header("location: admin/index.php");
            }
        }
    ?>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title" style='font-family:georgia'> ADMINISTRATOR </h1>
                    </header>
                    <div class="auth-content">
                        <p class="text-center">LOGIN TO CONTINUE</p>
                        <form id="login-form" action="login.php" method="GET" novalidate="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="email" class="form-control underlined" name="username" id="username" placeholder="Your username" required> </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Your password" required> </div>
                            <div class="form-group">
                                <label for="remember">
                                    <input class="checkbox" id="remember" type="checkbox">
                                    <span>Remember me</span>
                                </label>
                                <a href="forgot_password.php" class="forgot-btn pull-right">Forgot password?</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary" name='login'>Login</button>
                            </div>
                            <div class="form-group">
                                <p class="text-muted text-center">Do not have an account?
                                    <a href="signup.php">Sign Up!</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center">
                    <a href="customer/index.php" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back to dashboard </a>
                </div>
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="admin/js/vendor.js"></script>
        <script src="admin/js/app.js"></script>
    </body>
</html>