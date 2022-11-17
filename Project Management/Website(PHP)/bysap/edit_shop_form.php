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
    <title>Amend Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
    <!-- Top Nav Bar -->
    <?php include 'trader_navbar.php' ?>

    <h3 class = "mt-3 mb-2 text-center">Amend Shop</h3>
    <form action="edit_shop.php" method="POST" class = "trader-form" >



        <?php
        $shop_no = $_GET['id'];
        $sql = "SELECT * FROM bysap.Shop WHERE shop_no = $shop_no";

        $result = oci_parse($connection, $sql);
        oci_execute($result);
        $data = oci_fetch_array($result);


        ?>

        <input type="hidden" name="shop_no" value ="<?php echo $shop_no;?>">
        <label for="shop_name" class="form-label">Shop Name</label>
        <input type="text" id="shop_name" name="shop_name" value = "<?php echo $data['SHOP_NAME']?>" class="form-control" required>

        <label for="address" class="form-label">Address</label>
        <input type="text" id="address" name="address" value = "<?php echo $data['ADDRESS']?>"class="form-control" required>

        <label for="contact" class="form-label">Contact</label>
        <input type="text" id="contact" name="contact" value = "<?php echo $data['CONTACT']?>"class="form-control" required>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='manage_shop.php'" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="shopsubmit" class="btn btn-primary ms-2">Save Changes</button>
        </div>
    </form>

    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>