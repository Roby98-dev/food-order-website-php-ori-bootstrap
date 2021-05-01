<?php

if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='alert alert-danger'>Please login to access Admin Panel.</div>";
    header('location:' . SITEURL . 'admin/login.php');
}
