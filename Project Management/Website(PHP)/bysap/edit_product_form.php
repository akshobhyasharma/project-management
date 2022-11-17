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
    <title>Amend Product</title>
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

    <h3 class = "mt-3 mb-2 text-center">Amend Product</h3>
    <form action="edit_product.php" method="POST" class = "trader-form">



        <?php
        $product_id = $_GET['id'];
        $sql = "SELECT * FROM bysap.Product WHERE product_id = $product_id";

        $result = oci_parse($connection, $sql);
        oci_execute($result);
        $data = oci_fetch_array($result);


        ?>

        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" id="product_name" name="product_name" value="<?php if (isset($data['PRODUCT_NAME'])) echo $data['PRODUCT_NAME']; ?>" class="form-control" required>

        <label for="description" class="form-label">Description</label>
        <input type="text" id="description" name="description" value="<?php if (isset($data['DESCRIPTION'])) echo $data['DESCRIPTION']; ?>" class="form-control" required>

        <label for="price" class="form-label">Price</label>
        <input type="text" id="price" name="price" value="<?php if (isset($data['PRICE'])) echo number_format($data['PRICE'], 2); ?>" class="form-control" required>

        <label for="stock" class="form-label">Stock</label>
        <input type="number" id="stock" name="stock" value="<?php if (isset($data['STOCK'])) echo $data['STOCK']; ?>" class="form-control" required>

        <label for="allergy_information" class="form-label">Allergy Information</label>
        <input type="text" id="allergy_information" name="allergy_information" value="<?php if (isset($data['ALLERGY_INFORMATION'])) echo $data['ALLERGY_INFORMATION']; ?>" class="form-control">

        <label for="discount" class="form-label">Discount</label>
        <input type="number" id="discount" name="discount" value="<?php if (isset($data['DISCOUNT'])) echo $data['DISCOUNT']; ?>" class="form-control">

        <label for="category" class="form-label">Category</label>
        <input type="text" id="category" name="category" value="<?php if (isset($data['CATEGORY'])) echo $data['CATEGORY']; ?>" class="form-control" required>

        <label for="shop_no" class="form-label">Shop No</label>
        <input type="number" id="shop_no" name="shop_no" value="<?php if (isset($data['SHOP_NO'])) echo $data['SHOP_NO']; ?>" class="form-control" required>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='trader_interface.php'" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="productsubmit" class="btn btn-primary ms-2">Save Changes</button>
        </div>
    </form>

    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>