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
    <title>BYSAP: Cart</title>
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">

<body>
    <!-- Include navigation menus -->
    <?php include 'nav-bar.php' ?>
    <?php include 'secondary-nav.php' ?>
    <?php include 'sidebar.php' ?>


    <?php
    //Get user id that is stored in cookie or session
    if (isset($_COOKIE['id'])) 
    {
        $user_id = $_COOKIE['id'];
        
    } else if (isset($_SESSION['id'])) 
    {
        $user_id = $_SESSION['id'];
    }
    ?>

<!-- Entire page container starts here -->
    <div class="container-fluid shopping-cart">
        <div class="card card-container mt-5 ext-rounded">
            <div class="header-card">
                <h3>Shopping Cart</h3>
            </div>
            <?php

            //Display message after removing cart items
            if (isset($_SESSION['remove_cart_item'])) {
                echo '<p style = "color: red; text-align: center; ">' . $_SESSION["remove_cart_item"] . '</p>';
            }
            ?>

            <div class="row">
                <div class="col-lg-8 cart px-5">
                    <div class="title">
                        <div class="row">
                            <div class="col-xl-3 col-5">
                                <h4><b>Product</b></h4>
                            </div>
                            
                            <div class="offset-xl-1 col-xl-2 col-3 align-self-center text-center text-muted">Quantity</div>
                            <div class="col-xl-2 col-2 align-self-center text-center text-muted">Price</div>
                            <div class="col-xl-2 col-2 align-self-center text-center text-muted">Total</div>
                        </div>

                    </div>

                    <?php
                        if(isset($user_id))
                        {
                            $sql = "SELECT product_name, price, stock, category, shop_name, discount, product_quantity, cart_item_no FROM bysap.Product p, bysap.Cart_Items c, bysap.Shop s WHERE p.product_id = c.product_id AND s.shop_no = p.shop_no AND wishlist = 'No' AND cart_id = (SELECT cart_id FROM bysap.Cart WHERE user_id = $user_id)";

                            $result = oci_parse($connection, $sql);
                            oci_execute($result);
        
                            $count = 0;
                            $total_price = 0.0;
        
                            $has_item = false;
                            while ($data = oci_fetch_array($result)) {
                                $count++;
        
                                echo '<div class="row border-top border-bottom">
                                    <div class="row main align-items-center">
                                    <div class="col-xl-4 col-5">
                                    <div class ="row">
                                   <div class="col-lg-6"><img class="prod-img img-fluid" src="images/' . $data['CATEGORY'] . '/' . $data['PRODUCT_NAME'] . '.jpg">
                                   </div>
                                   <div class="col-lg-6" >
                                       <div class="row" style = "font-weight: bold;">'.$data['PRODUCT_NAME'].'</div>
                                       <div class="row">';
                                    if ($data['STOCK'] > 0) {
                                        echo "<span class = 'stock-span'>$data[STOCK] item(s) available in stock.</span>";
                                    } else {
                                        echo '<span class = "out-stock">Out of Stock.</span>';
                                    }
        
                                echo '</div>
                                       <div class="row text-muted">By: '. $data['SHOP_NAME'].'</div>
                                   </div>
                                   </div>
                                   </div>
        
                                    <div class="col-xl-2 col-3">
                                        <div class ="d-flex justify-content-center">
                                        <a href = "change_quantity.php?type=decrease&id='.$data['CART_ITEM_NO'].'&stock='.$data['STOCK'].'&quantity='.$data['PRODUCT_QUANTITY'].'" class="border incdec-link btn-minus"><i class="fas fa-minus"></i></a>';
                
                                        if ($data['STOCK'] > 0) {
                                            if ($data['STOCK'] > $data['PRODUCT_QUANTITY']) {
                                                echo '<input type = "text" class="quantity" name = "quantity" value = "' . $data['PRODUCT_QUANTITY'] . '"  style = " pointer-events: none; text-align:center; ">';
                                            } else {
                                                echo '<input type = "text" class="quantity" name = "quantity" value = "' . $data['STOCK'] . '"  style = " pointer-events: none; ">';
                                            }
                                        } else {
                                            echo '<input type = "text" class="quantity" name = "quantity" value = "0"  style = "pointer-events: none; ">';
                                        }
        
                                            echo '<a href = "change_quantity.php?type=increase&id='.$data['CART_ITEM_NO'].'&stock='.$data['STOCK'].'&quantity='.$data['PRODUCT_QUANTITY'].'" class="border incdec-link btn-plus" style ="cursor: pointer;"><i class="fas fa-plus"></i></a>
                                    </div>
                                    </div>
        
                                   <div class="col-2 text-center">&pound;';
        
                                if ($data['DISCOUNT']) {
                                    $price = $data['PRICE'] - (($data['DISCOUNT'] / 100) * $data['PRICE']);
        
                                    echo number_format($price, 2);
                                } else {
                                    $price = $data['PRICE'];
                                    echo number_format($data['PRICE'], 2);
                                }
        
        
        
                                echo '</div>
                                   <div class="col-2 text-center">&pound;<span>';
                                if ($data['STOCK'] > 0) {
                                    $total = number_format($data['PRODUCT_QUANTITY'] * $data['PRICE'], 2);
                                    echo $total;
                                } else {
                                    $total = 0.00;
                                    echo ' 0.00';
                                }
        
                                $total_price += $total;
        
        
                                echo '</span></div>
                                   <div class="col-xl-2 text-center mt-2">
                                   <a href  ="remove_cart_items.php?id=' . $data['CART_ITEM_NO'] . '"><input type="submit" value="Remove" name="remove" class="btn btn-outline-dark ext-m-rounded cart-button remove-btn remove-btn1"></a>
                                   </div>
        
                               </div>
                                </div>';
                                $has_item = true;
                            }
        
        
                            if ($has_item == false) {
                                echo '<h6> No items in cart.</h6>';
                            }
                        }
                        else 
                        {
                            $count = 0;
                            $total_price = 0.0;
                            $has_item = false;
                           if(isset($_SESSION['product']))
                           {
                            
                                foreach($_SESSION['product'] as $id => $quantity)
                                {
                                    $sql200 = "SELECT * FROM bysap.product p, bysap.shop s WHERE p.shop_no = s.shop_no AND product_id =$id";
                                    $result200 = oci_parse($connection, $sql200);
                                    oci_execute($result200);
                                    $data200 = oci_fetch_array($result200);
                                    $count++;
        
                                echo '<div class="row border-top border-bottom">
                                    <div class="row main align-items-center">
                                   <div class="col-2"><img class="prod-img img-fluid" src="images/' . $data200['CATEGORY'] . '/' . $data200['PRODUCT_NAME'] . '.jpg">
                                   </div>
                                   <div class="col-2">
                                       <div class="row" style = "font-weight: bold;">'.$data200['PRODUCT_NAME'].'</div>
                                       <div class="row">';
                                    if ($data200['STOCK'] > 0) {
                                        echo "<span class = 'stock-span'>$data200[STOCK] item(s) available in stock.</span>";
                                    } else {
                                        echo '<span class = "out-stock">Out of Stock.</span>';
                                    }
        
                                echo '</div>
                                       <div class="row text-muted">By: '. $data200['SHOP_NAME'].'</div>
                                   </div>
        
                                   <div class="col-2"> 
                                   <div class="d-flex justify-content-center">
                                   <a href = "unreg_quantity.php?type=decrease&id='.$id.'&stock='.$data200['STOCK'].'&quantity='.$quantity.'" class="border incdec-link btn-minus"><i class="fas fa-minus"></i></a>';
        
                                if ($data200['STOCK'] > 0) {
                                    if ($data200['STOCK'] > $quantity) {
                                        echo '<input type = "text" class="quantity" name = "quantity" value = "' . $quantity. '"  style = "pointer-events: none; text-align:center; ">';
                                    } else {
                                        echo '<input type = "text" class="quantity" name = "quantity" value = "' . $data200['STOCK'] . '"  style = "pointer-events: none; ">';
                                    }
                                } else {
                                    echo '<input type = "text" class="quantity" name = "quantity" value = "0"  style = " pointer-events: none; ">';
                                }
        
                                echo '<a href = "unreg_quantity.php?type=increase&id='.$id.'&stock='.$data200['STOCK'].'&quantity='.$quantity.'" class="border incdec-link btn-plus" style ="cursor: pointer;"><i class="fas fa-plus"></i></a>
                                </div>
                                    </div>
        
                                   <div class="col-2 text-center">&pound;';
        
                                if ($data200['DISCOUNT']) {
                                    $price = $data200['PRICE'] - (($data200['DISCOUNT'] / 100) * $data200['PRICE']);
        
                                    echo number_format($price, 2);
                                } else {
                                    $price = $data200['PRICE'];
                                    echo number_format($data200['PRICE'], 2);
                                }
        
        
        
                                echo '</div>
                                   <div class="col-2 text-center">&pound;<span>';
                                if ($data200['STOCK'] > 0) {
                                    $total = number_format($quantity * $data200['PRICE'], 2);
                                    echo $total;
                                } else {
                                    $total = 0.00;
                                    echo ' 0.00';
                                }
        
                                $total_price += $total;
        
        
                                echo '</span></div>
                                   <div class="col-xl-2">
                                   <a href  ="remove_unreg_cart.php?id='. $id.'"><input type="submit" value="Remove" name="remove" class="btn btn-outline-dark ext-m-rounded cart-button remove-btn remove-btn1"></a>
                                   </div>
        
                               </div>
                                </div>';
                                $has_item = true;
                                   
                                    
                                }
                           }
                           else{
                               echo 'No items in cart.';
                           }
                        }
                    

                    ?>

                    <div class="row border-top">
                        <div class="row main align-items-center">
                            <div class="col">
                                <?php
                                    if(isset($user_id))
                                    {
                                        echo '<a href="remove_all_cart_items.php?id='.$user_id.'"><button class="btn btn-outline-dark ext-m-rounded cart-button remove-btn" type="submit">Remove all items</button></a>';
                                    }
                                    else
                                    {
                                        echo '<a href="remove_all_cart_items.php"><button class="btn btn-outline-dark ext-m-rounded cart-button remove-btn" type="submit">Remove all items</button></a>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 summary px-5">
                    <div>
                        <h5><b>Order Summary</b></h5>
                    </div>
                    <hr>
                    <div class="order-row d-flex">
                        <div class="col">Total items: </div>
                        <div class="col text-right"><?php echo $count ?></div>
                    </div>

                    <div class="order-row d-flex">
                        <div class="col">Sub Total: </div>
                        <div class="col text-right"> &pound;<input class="sub-total" type = "text" name ="sub-total" value = "<?php echo number_format($total_price, 2) ?>"></div>
                    </div>
                    <div class="order-row d-flex mt-2">
                        <div class="col">Coupon Code: </div>
                        <div class="col text-right"><input class="cart-input px-2" id="code" placeholder="Enter code"></div>
                    </div>
                    <div class="order-row d-flex">
                        <div class="col">Discount: </div>
                        <div class="col text-right"> &pound;0.00</div>
                    </div>

                    <div class="order-row d-flex totals">
                        <div class="col">TOTAL:</div>
                        <div class="col text-right">&pound;<input class="total" type = "text" name ="total" value = "<?php echo number_format($total_price, 2) ?>"></div>
                    </div>

                    <form action="checkout.php" method="GET">
                        <input type="hidden" name="quantity" value = "<?php echo $count;?>">
                        <input type="hidden" name="price" value = "<?php echo number_format($total_price, 2)?>">

                    <?php
                    if($has_item == true)
                    {
                        if(isset($user_id))
                        {
                            echo '<input type="submit" name="checkout" value="PROCEED TO CHECKOUT" class="btn btn-outline-dark ext-m-rounded mt-4 cart-button">';
                        }
                        else
                        {
                            echo '<input type="submit" name="checkout" value="PROCEED TO CHECKOUT" class="btn btn-outline-dark ext-m-rounded mt-4 cart-button" formaction = "signin.php">';
                        }
                        
                    }
                    else {
                        echo ' <input type="submit" name="checkout" value="PROCEED TO CHECKOUT" class="btn btn-outline-dark ext-m-rounded mt-4 cart-button" style = "pointer-events: none; background-color: gray; color: white;">';
                    }
                    
                    ?>
                   
                    </form>
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
    ?>

</body>


</html>