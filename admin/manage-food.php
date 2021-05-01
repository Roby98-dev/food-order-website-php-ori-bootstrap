<?php include_once('partials/menu.php'); ?>

<div class="container">
    <h1 class="text-center mt-5">Manage Food</h1>
    <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn btn-primary mb-3">Add Food</a>
    <div class="row">

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <div class="table-responsive mb-5">
            <table class="table">
                <tr class="table-dark">
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>

                <?php
                //Create a SQL Query to Get all the Food
                $sql = "SELECT * FROM tbl_food";

                //Execute the qUery
                $res = mysqli_query($conn, $sql);

                //Count Rows to check whether we have foods or not
                $count = mysqli_num_rows($res);

                $no = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        //get the values from individual columns
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                ?>

                        <tr>
                            <td><?= $no++; ?>. </td>
                            <td><?= $title; ?></td>
                            <td>$<?= $price; ?></td>
                            <td>
                                <?php
                                if ($image_name == "") {
                                ?>
                                    <img class="img-fluid img-thumbnail" src="../assets/images/dafault/dafault.jpeg" width="100px">
                                <?php
                                } else {
                                ?>
                                    <img src="<?= SITEURL; ?>images/food/<?= $image_name; ?>" width="100px">
                                <?php
                                }
                                ?>
                            </td>
                            <td><?= $featured; ?></td>
                            <td><?= $active; ?></td>
                            <td>
                                <a href="<?= SITEURL; ?>admin/update-food.php?id=<?= $id; ?>" class="btn btn-secondary">Update Food</a>
                            </td>
                            <td>
                                <a href="<?= SITEURL; ?>admin/delete-food.php?id=<?= $id; ?>&image_name=<?= $image_name; ?>" class="btn btn-danger">Delete Food</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    //Food not Added in Database
                    echo "<tr> <td colspan='7' class='alert alert-danger'> Food not Added Yet. </td> </tr>";
                }
                ?>
            </table>
        </div>
    </div>

</div>

<?php include('partials/footer.php'); ?>