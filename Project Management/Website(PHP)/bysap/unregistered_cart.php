<?php
    session_start();
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $in_cart = false;

    if(!isset($_SESSION['product']))
    {
        $_SESSION['product'] = array();
    }
    if(count($_SESSION['product']) > 0)
    {
        if(count($_SESSION['product'])<20)
        {
            foreach($_SESSION['product'] as $id => $qty)
            {
                if($id == $product_id)
                {
                    $in_cart = true;
                    break;

                }
            }
            if($in_cart == true)
            {
                $_SESSION['cart_failure'] = 'Product is already in cart.';
            }
            else 
            {
                $_SESSION['product'][$product_id] = $quantity;
                $_SESSION['cart_success'] = 'Product added to cart successfully.';
            }
        }
        else{
            $_SESSION['cart_failure'] = 'Cart limit(20) exceeded.';
        }
    }
    else{
        $_SESSION['product'][$product_id] = $quantity;
        $_SESSION['cart_success'] = 'Product added to cart successfully.';
    }
    header("location: prod_description.php?id=$product_id");
    

?>


                   