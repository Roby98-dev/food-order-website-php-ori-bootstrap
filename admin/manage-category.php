<?php include('partials/menu.php'); ?>

<div class="container">
    <h1 class="text-center mt-5">Manage Category</h1>
    <a href="<?= SITEURL; ?>admin/add-category.php" class="btn btn-primary mb-3">Add Category</a>
    <div class="row">

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>

        <!-- Button to Add Admin -->

        <div class="table-responsive mb-5">
            <table class="table">
                <tr class="table-dark">
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>

                <?php
                //Query to Get all CAtegories from Database
                $sql = "SELECT * FROM tbl_category";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Create Serial Number Variable and assign value as 1
                $no = 1;

                //Check whether we have data in database or not
                if ($count > 0) {
                    //We have data in database
                    //get the data and display
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                ?>
                        <tr>
                            <td><?= $no++; ?>. </td>
                            <td><?= $title; ?></td>
                            <td>
                                <?php
                                if ($image_name != "") {
                                    //Display the Image
                                ?>
                                    <img class="img-fluid img-thumbnail" src="<?= SITEURL; ?>images/category/<?= $image_name; ?>" width="100px">
                                <?php
                                } else {
                                    //DIsplay the MEssage
                                ?>
                                    <img class="img-fluid img-thumbnail" src="../assets/images/dafault/dafault.jpeg" width="100px">
                                <?php
                                }
                                ?>
                            </td>
                            <td><?= $featured; ?></td>
                            <td><?= $active; ?></td>
                            <td>
                                <a href="<?= SITEURL; ?>admin/update-category.php?id=<?= $id; ?>" class="btn btn-secondary">Update</a>
                            </td>
                            <td>
                                <a href="<?= SITEURL; ?>admin/delete-category.php?id=<?= $id; ?>&image_name=<?= $image_name; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php

                    }
                } else {
                    //WE do not have data
                    //We'll display the message inside table
                    ?>

                    <tr>
                        <td colspan="6">
                            <div class="error">No Category Added.</div>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>