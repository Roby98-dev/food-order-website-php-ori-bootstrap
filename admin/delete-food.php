<?php
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/food/" . $image_name;

        $remove = unlink($path);

        if ($remove == false) {
            //Failed to Remove image
            $_SESSION['upload'] = "<div class='alert alert-danger'>Failed to Remove Image File.</div>";
            //REdirect to Manage Food
            header('location:' . SITEURL . 'admin/manage-food.php');
            //Stop the Process of Deleting Food
            die();
        }
    }

    //3. Delete Food from Database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //CHeck whether the query executed or not and set the session message respectively
    //4. Redirect to Manage Food with Session Message
    if ($res == true) {
        //Food Deleted
        $_SESSION['delete'] = "<div class='alert alert-success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        //Failed to Delete Food
        $_SESSION['delete'] = "<div class='alert alert-danger'>Failed to Delete Food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    //Redirect to Manage Food Page
    //echo "REdirect";
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
