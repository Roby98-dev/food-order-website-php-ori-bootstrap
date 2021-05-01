<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Poinsla Food Order Website</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-12 col-sm-12 mt-5 mb-5">
                <div class="card bg-dark text-light py-5 px-3">
                    <h1 class="text-center mt-3 mb-5">Login</h1>
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                    if (isset($_SESSION['no-login-message'])) {
                        echo $_SESSION['no-login-message'];
                        unset($_SESSION['no-login-message']);
                    }
                    ?>
                    <br><br>

                    <!-- Login Form Starts HEre -->
                    <form action="" method="POST">
                        <label class="form-label" for="">Username:</label> <br>
                        <input class="form-control mb-3" type="text" name="username" placeholder="Enter Username">

                        <label class="form-label" for="">Password:</label>
                        <input class="form-control mb-5" type="password" name="password" placeholder="Enter Password">

                        <input type="submit" name="submit" value="Login" class="btn btn btn-primary">
                    </form>
                    <!-- Login Form Ends HEre -->

                    <p class="text-center mt-5">Created by | <a href="www.poinsla.com">Poinsla.com</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='alert alert-success'>Login Successful.</div>";
        $_SESSION['user'] = $username;

        header('location:' . SITEURL . 'admin/');
    } else {
        $_SESSION['login'] = "<div class='alert alert-danger text-center'>Username or Password did not match.</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}

?>