<?php include('partials/menu.php'); ?>

<div class="container">
    <h1 class="text-center mt-5">Add Category</h1>

    <br><br>

    <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>

    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
            <!-- Add CAtegory Form Starts -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title: </label>
                    <input class="form-control" type="text" name="title" placeholder="Category Title">
                </div>
                <div class="mb-3">
                    <label class="form-label">Select Image: </label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="mb-3">
                    <label class="form-label">Featured: </label>
                    <input class="form-check-input" type="radio" name="featured" value="Yes"> Yes
                    <input class="form-check-input" type="radio" name="featured" value="No"> No
                </div>
                <div class="mb-3">
                    <label class="form-label">Active: </label>
                    <input class="form-check-input" type="radio" name="active" value="Yes"> Yes
                    <input class="form-check-input" type="radio" name="active" value="No"> No
                </div>
                <div class="col-auto">
                    <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                </div>
            </form>
            <!-- Add CAtegory Form Ends -->
        </div>

        <?php
        if (isset($_POST['submit'])) {
            //1. Get the Value from CAtegory Form
            $title = $_POST['title'];

            if (isset($_POST['featured'])) {
                //Get the VAlue from form
                $featured = $_POST['featured'];
            } else {
                //SEt the Default VAlue
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {

                    //Auto Rename our Image
                    //Get the Extension of our image (jpg, png, gif, etc) e.g. "specialfood1.jpg"
                    $ext = end(explode('.', $image_name));

                    //Rename the Image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; // e.g. Food_Category_834.jpg

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;

                    //Finally Upload the Image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        //SEt message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                        //Redirect to Add CAtegory Page
                        header('location:' . SITEURL . 'admin/add-category.php');
                        //STop the Process
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            //2. Create SQL Query to Insert CAtegory into Database
            $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

            //3. Execute the Query and Save in Database
            $res = mysqli_query($conn, $sql);

            //4. Check whether the query executed or not and data added or not
            if ($res == true) {
                //Query Executed and Category Added
                $_SESSION['add'] = "<div class='alert alert-success'>Category Added Successfully.</div>";
                //Redirect to Manage Category Page
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                //Failed to Add CAtegory
                $_SESSION['add'] = "<div class='alert alert-danger'>Failed to Add Category.</div>";
                //Redirect to Manage Category Page
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>