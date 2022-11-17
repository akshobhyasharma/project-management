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
    <title>BYSAP: Trader Interface</title>
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

    <div class="product-top-container">
        <span>Manage Products</span>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Product
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="add_product.php" method="post">


                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" id="product_name" name="product_name" class="form-control" required>

                            <label for="description" class="form-label">Description</label>
                            <input type="text" id="description" name="description" class="form-control" required>

                            <label for="price" class="form-label">Price</label>
                            <input type="text" id="price" name="price" class="form-control" required>

                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control" required>

                            <label for="allergy_information" class="form-label">Allergy Information</label>
                            <input type="text" id="allergy_information" name="allergy_information" class="form-control">

                            <label for="discount" class="form-label">Discount</label>
                            <input type="number" id="discount" name="discount" class="form-control">

                            <label for="category" class="form-label">Category</label>
                            <input type="text" id="category" name="category" class="form-control" required>

                            <label for="shop_no" class="form-label">Shop No</label>
                            <input type="number" id="shop_no" name="shop_no" class="form-control" required>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="productsubmit" class="btn btn-primary ms-2">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">


    
    <?php
    
    if(isset($_SESSION['product_success']))
            {
              echo '<p style = "color: green; text-align: center; ">'.$_SESSION["product_success"].'</p>';
            }
    else if(isset($_SESSION['delete_product']))
    {
      echo '<p style = "color: red; text-align: center; ">'.$_SESSION["delete_product"].'</p>';
    }
    else if(isset($_SESSION['edit_product']))
    {
      echo '<p style = "color: green; text-align: center; ">'.$_SESSION["edit_product"].'</p>';
    }
    ?>
        <table class="table table-striped product-table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="color:white; border-bottom: 1px solid #96b4fa; pointer-events: none;">Action</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price (&pound;)</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Allergy Information</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Shop Name</th>
                    <th scope="col">Approve</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_COOKIE['id'])) {
                    $id = $_COOKIE['id'];
                } else if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                }

                $sql = "SELECT * FROM bysap.Shop s, bysap.Product p WHERE s.shop_no = p.shop_no AND user_id = $id";

                $result = oci_parse($connection, $sql);
                oci_execute($result);
                while ($data = oci_fetch_array($result)) {
                    echo "<tr>
                    <th scope='row'><a href = 'edit_product_form.php?id=$data[PRODUCT_ID]'> <i class = 'fas fa-edit'></i></a> <a href = 'delete_product.php?id=$data[PRODUCT_ID]'><i class = 'fas fa-trash'></i></a></th>
                    <td>$data[PRODUCT_ID]</td>
                    <td>$data[PRODUCT_NAME]</td>
                    <td>$data[DESCRIPTION]</td>
                    <td>" . number_format($data['PRICE'], 2) . "</td>
                    <td>$data[STOCK]</td>
                    <td>$data[ALLERGY_INFORMATION]</td>
                    <td>$data[DISCOUNT]</td>
                    <td>$data[SHOP_NAME]</td>
                    <td>$data[APPROVE]</td>
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