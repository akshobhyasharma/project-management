<?php
    session_start();
    include 'connection.php';
    $product_id = $_GET['id'];
    $cart_id = $_GET['cart_id'];

    $stat1 = "SELECT * FROM bysap.cart_items WHERE cart_id = $cart_id AND product_id = $product_id";
    $result1 = oci_parse($connection, $stat1);
    oci_execute($result1);
    $data1 = oci_fetch_array($result1);

    if($data1)
    {
        if($data1['WISHLIST'] == 'Yes')
        {
            $stat2 = "DELETE FROM bysap.cart_items WHERE cart_id = $cart_id AND product_id = $product_id AND wishlist = 'Yes'";

            $_SESSION['cart_failure'] = 'Product removed from wishlist.';
        }
        else{
            $_SESSION['remove_cart_item'] = 'Product already in cart.';
        }
       
        
    }
    else
    {
        $stat2 = "INSERT INTO bysap.cart_items (product_quantity, product_id, cart_id, wishlist) VALUES  (1, $product_id, $cart_id, 'Yes')";

        $_SESSION['cart_success'] = 'Product added to wishlist successfully.';
    }

    $result2 = oci_parse($connection, $stat2);
    oci_execute($result2);

    if(isset($_GET['category']))
    {
        header("location: shop.php?category=$_GET[category]");
    }
    else if(isset($_GET['k']))
    {
        header("location: search.php?k=$_GET[k]");
    }

    else {
        header('location: index.php');
    }
  

?>