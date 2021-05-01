<?php
include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="container">
    <h1 class="text-center mt-5">Manage Admin</h1>
    <a href="add-admin.php" class="btn btn-primary mt-2 mb-3">Add Admin</a>
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

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>

        <!-- Button to Add Admin -->

        <br /><br />

        <div class="table-responsive mb-5">
            <table class="table">
                <tr class="table-dark">
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Update Admin</th>
                    <th>Reset password</th>
                    <th>Delete Admin</th>
                </tr>

                <?php
                $sql = "SELECT * FROM tbl_admin ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);

                    $no = 1;

                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                ?>

                            <tr>
                                <td><?= $no++; ?>. </td>
                                <td><?= $full_name; ?></td>
                                <td><?= $username; ?></td>
                                <td>
                                    <a href="<?= SITEURL; ?>admin/update-admin.php?id=<?= $id; ?>" class="btn btn-secondary">Update</a>
                                </td>
                                <td>
                                    <a href="<?= SITEURL; ?>admin/update-password.php?id=<?= $id; ?>" class="btn btn-primary">Reset password</a>
                                </td>
                                <td>
                                    <a href="<?= SITEURL; ?>admin/delete-admin.php?id=<?= $id; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        echo "Data not found";
                    }
                }
                ?>
            </table>
        </div>

    </div>
</div>
<!-- Main Content Setion Ends -->

<?php include('partials/footer.php'); ?>