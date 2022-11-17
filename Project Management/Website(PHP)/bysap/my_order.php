<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYSAP: My Orders </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
    <!-- Top Nav Bar -->
    <?php include 'nav-bar.php' ?>
    <?php include 'secondary-nav.php' ?>
    <?php include 'sidebar.php' ?>

    <div class="product-top-container">
        <span>My Orders</span>
    </div>
    <div class="table-responsive">

        <table class="table table-striped product-table table-hover">
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Shop Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price (&pound;)</th>
                    <th scope="col">Slot Day</th>
                    <th scope="col">Slot Time</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_COOKIE['id'])) {
                    $id = $_COOKIE['id'];
                } else if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                }

                $sql = "SELECT * FROM bysap.orders o, bysap.order_product op, bysap.product p, bysap.collection_slot s, bysap.shop sh, bysap.cart c
                WHERE o.order_id = op.order_id AND op.product_id = p.product_id AND o.slot_no = s.slot_no AND p.shop_no = sh.shop_no AND o.cart_id = c.cart_id AND o.cart_id = (SELECT cart_id FROM bysap.cart WHERE user_id = $id)";

                $result = oci_parse($connection, $sql);
                oci_execute($result);
                while ($data = oci_fetch_array($result)) {
                    echo "<tr>
                    <td>$data[ORDER_ID]</td>
                    <td>$data[SHOP_NAME]</td>
                    <td>$data[PRODUCT_NAME]</td>
                    <td>$data[PROD_QUANTITY]</td>
                    <td>" .number_format($data['PRICE'] * $data['PROD_QUANTITY'], 2). "</td>
                    <td>$data[SLOT_DAY]</td>
                    <td>$data[SLOT_TIME]</td>
                    
                </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <?php
    unset($_SESSION['product_success']);
    unset($_SESSION['delete_product']);
    unset($_SESSION['edit_product']);
    ?>
</body>

</html>