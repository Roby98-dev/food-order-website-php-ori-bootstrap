<?php include('partials/menu.php'); ?>

<div class="container">
    <h1 class="text-center mt-5">Add Admin</h1>

    <br><br>

    <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name:</label>
                    <input class="form-control" type="text" name="full_name" placeholder="Enter Your Name">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input class="form-control" type="text" name="username" placeholder="Your Username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input class="form-control" type="password" name="password" placeholder="Your Password">
                </div>
                <div class="col-auto">
                    <input type="submit" name="submit" value="Add Admin" class="btn btn-primary mt-3 mb-5">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error(''));

    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='alert alert-success'>Admin Added Successfully.</div>";
        //Redirect Page to Manage Admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['add'] = "<div class='alert alert-danger'>Failed to Add Admin.</div>";
        //Redirect Page to Add Admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>

<?php include('partials/footer.php'); ?>