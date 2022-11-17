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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
    <title>BYSAP: Wishlist</title>

<body>

    <?php include 'nav-bar.php' ?>
    <?php include 'secondary-nav.php' ?>
    <?php include 'sidebar.php' ?>

    <?php

    if (isset($_COOKIE['id'])) 
    {
        $user_id = $_COOKIE['id'];
        
    } else if (isset($_SESSION['id'])) 
    {
        $user_id = $_SESSION['id'];
    }
    ?>


    <div class="container-fluid">
        <div class="card card-container mt-5 ext-rounded">
            <div class="header-card">
                <h3>My Wishlist</h3>
            </div>
            <?php

            if (isset($_SESSION['remove_cart_item'])) {
                echo '<p style = "color: red; text-align: center; ">' . $_SESSION["remove_cart_item"] . '</p>';
            }
            else if(isset($_SESSION['cart_success']))
            {
                echo '<p style = "color: green; text-align: center; ">' . $_SESSION["cart_success"] . '</p>';
            }
            ?>

            <div class="row">
                <div class="col-md-12 cart px-5">
                    <div class="title">
                        <div class="row">
                            <div class="col-lg-2 col-5">
                                <h4><b>Product</b></h4>
                            </div>                       
                            <div class="offset-lg-3 offset-1 col-lg-2 col-3 align-self-center text-right text-muted">Price</div>
                            <div class="col-lg-2 col-3 align-self-center text-right text-muted">Total</div>
                        </div>

                    </div>

                    <?php
                        if(isset($user_id))
                        {
                            $sql = "SELECT product_name, price, stock, category, shop_name, discount, product_quantity, cart_item_no FROM bysap.Product p, bysap.Cart_Items c, bysap.Shop s WHERE p.product_id = c.product_id AND s.shop_no = p.shop_no AND wishlist = 'Yes' AND cart_id = (SELECT cart_id FROM bysap.Cart WHERE user_id = $user_id)";

                            $result = oci_parse($connection, $sql);
                            oci_execute($result);
        
                            $count = 0;
                            $total_price = 0.0;
        
                            $has_item = false;
                            while ($data = oci_fetch_array($result)) {
                                $count++;
        
                                echo '<div class="row border-top border-bottom">
                                    <div class="row main align-items-center">
                                    <div class = "col-lg-4 col-5">
                                    <div class = "row">
                                   <div class="col-lg-6 col-12"><img class="prod-img img-fluid" src="images/' . $data['CATEGORY'] . '/' . $data['PRODUCT_NAME'] . '.jpg">
                                   </div>
                                   <div class="col-lg-6 col-12">
                                       <div class="row" style = "font-weight: bold;">'.$data['PRODUCT_NAME'].'</div>
                                       <div class="row">';
                                    if ($data['STOCK'] > 0) {
                                        echo "<span class = 'stock-span'>$data[STOCK] item(s) available in stock.</span>";
                                    } else {
                                        echo '<span class = "out-stock">Out of Stock.</span>';
                                    }
        
                                echo '</div>
                                       <div class="row text-muted">By: '. $data['SHOP_NAME'].'</div>
                                   </div></div></div>
        
                                   
        
                                   <div class="offset-1 col-lg-2 col-3">&pound;';
        
                                if ($data['DISCOUNT']) {
                                    $price = $data['PRICE'] - (($data['DISCOUNT'] / 100) * $data['PRICE']);
        
                                    echo number_format($price, 2);
                                } else {
                                    $price = $data['PRICE'];
                                    echo number_format($data['PRICE'], 2);
                                }
        
        
        
                                echo '</div>
                                   <div class="co-lg-2 col-3">&pound;<span>';
                                if ($data['STOCK'] > 0) {
                                    $total = number_format($data['PRODUCT_QUANTITY'] * $data['PRICE'], 2);
                                    echo $total;
                                } else {
                                    $total = 0.00;
                                    echo ' 0.00';
                                }
        
                                $total_price += $total;
        
        
                                echo '</span></div>
                                   <div class="col text-center mt-lg-0 mt-3" >
                                   <a href  ="remove_cart_items.php?destination=wishlist&id=' . $data['CART_ITEM_NO'] . '"><input type="submit" value="Remove" name="remove" class="btn btn-outline-dark ext-m-rounded cart-button remove-btn  remove-btn1"></a>

                                   <a href  ="move_to_cart.php?id=' . $data['CART_ITEM_NO'].'"><input type="submit" value="Add to Cart" name="move" class="btn btn-outline-dark ext-m-rounded cart-button move-button remove-btn1"></a>
                                   </div>
        
                               </div>
                                </div>';
                                $has_item = true;
                            }
        
        
                            if ($has_item == false) {
                                echo '<h6> No items in wishlist.</h6>';
                            }
                        }
                        
                    

                    ?>

                    <div class="row border-top">
                        <div class="row main align-items-center">
                            <div class="col">
                                <?php
                                    if(isset($user_id))
                                    {
                                        echo '<a href="remove_all_cart_items.php?destination=wishlist&id='.$user_id.'"><button class="btn btn-outline-dark ext-m-rounded cart-button remove-btn" type="submit">Remove all items</button></a>';
                                    }
                                  
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

                
            </div>
        </div>
    </div>


    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/04614f4329.js" crossorigin="anonymous"></script>

    <?php
    unset($_SESSION['remove_cart_item']);
    unset($_SESSION['cart_success']);

    ?>

</body>

</html>
