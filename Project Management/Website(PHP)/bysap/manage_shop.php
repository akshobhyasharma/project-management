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
    <title>BYSAP: Manage Shops</title>
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
        <span>Manage Shops</span>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Shop
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Shop</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="add_shop.php" method="post">


                            <label for="shop_name" class="form-label">Shop Name</label>
                            <input type="text" id="shop_name" name="shop_name" class="form-control" required>

                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" class="form-control" required>

                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" id="contact" name="contact" class="form-control" required>

                          


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="shopsubmit" class="btn btn-primary ms-2">Add Shop</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive"  style ="min-height: 210px;">

    <?php
    
    if(isset($_SESSION['shop_success']))
            {
              echo '<p style = "color: green; text-align: center; ">'.$_SESSION["shop_success"].'</p>';
            }
    else if(isset($_SESSION['shop_delete']))
    {
      echo '<p style = "color: red; text-align: center; ">'.$_SESSION["shop_delete"].'</p>';
    }
    else if(isset($_SESSION['edit_shop']))
    {
      echo '<p style = "color: green; text-align: center; ">'.$_SESSION["edit_shop"].'</p>';
    }
    ?>
        <table class="table table-striped shop-table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="color:white; border-bottom: 1px solid #96b4fa; pointer-events: none;">Action</th>
                    <th scope="col">Shop No</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Shop Name</th>
                    <th scope="col">Address</>
                    <th scope="col">Contact</th>  
                    <th scope="col">Authorized</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_COOKIE['id'])) {
                    $id = $_COOKIE['id'];
                } else if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                }

                $sql = "SELECT * FROM bysap.Shop s WHERE user_id = $id";

                $result = oci_parse($connection, $sql);
                oci_execute($result);
                while ($data = oci_fetch_array($result)) {
                    echo "<tr>
                    <th scope='row'><a href = 'edit_shop_form.php?id=$data[SHOP_NO]'> <i class = 'fas fa-edit'></i></a> <a href = 'delete_shop.php?id=$data[SHOP_NO]'><i class = 'fas fa-trash'></i></a></th>
                    <td>$data[SHOP_NO]</td>
                    <td>$data[USER_ID]</td>
                    <td>$data[SHOP_NAME]</td>
                    <td>$data[ADDRESS]</td>
                    <td>$data[CONTACT]</td>
                    <td>$data[AUTHORIZED]</td>
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
    unset($_SESSION['shop_success']);
    unset($_SESSION['shop_delete']);
    unset($_SESSION['edit_shop']);
    ?>
</body>

</html>