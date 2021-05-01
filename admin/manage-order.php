<?php include('partials/menu.php'); ?>

<div class="container">
    <h1 class="text-center mt-5 mb-5">Manage Order</h1>
    <div class="row">

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <div class="table-responsive mb-5">
            <table class="table">
                <tr class="table-dark">
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Cust Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Update</th>
                </tr>

                <?php
                //Get all the orders from database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count the Rows
                $count = mysqli_num_rows($res);

                $no = 1;

                if ($count > 0) {
                    //Order Available
                    while ($row = mysqli_fetch_assoc($res)) {
                        //Get all the order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                ?>

                        <tr>
                            <td><?= $no++; ?>. </td>
                            <td><?= $food; ?></td>
                            <td><?= $price; ?></td>
                            <td><?= $qty; ?></td>
                            <td><?= $total; ?></td>
                            <td><?= $order_date; ?></td>
                            <td>
                                <?php
                                if ($status == "Ordered") {
                                    echo "<label class='form-label'>$status</label>";
                                } elseif ($status == "On Delivery") {
                                    echo "<label class='form-label text-primary'>$status</label>";
                                } elseif ($status == "Delivered") {
                                    echo "<label class='form-label text-success'>$status</label>";
                                } elseif ($status == "Cancelled") {
                                    echo "<label class='form-label text-danger'>$status</label>";
                                }
                                ?>
                            </td>
                            <td><?= $customer_name; ?></td>
                            <td><?= $customer_contact; ?></td>
                            <td><?= $customer_email; ?></td>
                            <td><?= $customer_address; ?></td>
                            <td>
                                <a href="<?= SITEURL; ?>admin/update-order.php?id=<?= $id; ?>" class="btn btn-primary">Update</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    //Order not Available
                    echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>