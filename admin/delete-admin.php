<?php
include('../config/constants.php');
$id = $_GET['id'];

//2. Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if ($res == true) {
    $_SESSION['delete'] = "<div class='alert alert-success'>Admin Deleted Successfully.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    $_SESSION['delete'] = "<div class='alert alert-danger'>Failed to Delete Admin. Try Again Later.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}
