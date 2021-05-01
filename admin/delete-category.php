<?php
include('../config/constants.php');

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file is available
    if ($image_name != "") {
        //Image is Available. So remove it
        $path = "../images/category/" . $image_name;
        //REmove the Image
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='alert alert-danger'>Failed to Remove Category Image.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            //Stop the Process
            die();
        }
    }

    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the data is delete from database or not
    if ($res == true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>Category Deleted Successfully.</div>";
        //Redirect to Manage Category
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['delete'] = "<div class='alert alert-danger'>Failed to Delete Category.</div>";
        //Redirect to Manage Category
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    //redirect to Manage Category Page
    header('location:' . SITEURL . 'admin/manage-category.php');
}
