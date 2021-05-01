<?php include_once('partials/menu.php'); ?>

<div class="container">
    <h1 class="text-center mt-5">Add Food</h1>
    <?php
    if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <div class="mb-3">
                        <label class="form-label">Title: </label>
                        <input class="form-control" type="text" name="title" placeholder="Title of the Food">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description: </label>
                        <textarea class="form-control" name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price: </label>
                        <input class="form-control" type="number" name="price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Image: </label>
                        <input class="form-control" type="file" name="image">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category: </label>
                        <select class="form-select" name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>

                                    <option value="<?= $id; ?>"><?= $title; ?></option>

                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
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
                    <div class="mb-3">
                        <input type="submit" name="submit" value="Add Food" class="btn btn-primary">
                    </div>
                </table>
            </form>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            if (isset($_FILES['image']['name'])) {
                //Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    //Get the extension of selected image (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
                    $ext = end(explode('.', $image_name));

                    // Create New Name for Image
                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext; //New Image Name May Be "Food-Name-657.jpg"

                    // Source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //Destination Path for the image to be uploaded
                    $dst = "../images/food/" . $image_name;

                    //Finally Uppload the food image
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image uploaded of not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='alert alert-danger'>Failed to Upload Image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['add'] = "<div class='alert alert-success'>Success to add food</div>";
        ?>
                <script>
                    window.location = "manage-food.php";
                </script>
            <?php
            } else {
                $_SESSION['add'] = "<div class='alert alert-danger'>Failed to Add Food.</div>";
            ?>
                <script>
                    window.location = "manage-food.php";
                </script>
        <?php
            }
        }
        ?>
    </div>
</div>

<?php include_once('partials/footer.php'); ?>