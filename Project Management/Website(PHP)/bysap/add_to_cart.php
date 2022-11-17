<?php
session_start();
include 'connection.php';

if (isset($_POST['addtocart'])) {
    $product_id = $_GET['id'];
    $quantity = $_POST['quantity'];

    if (isset($_COOKIE['id'])) {
        $user_id = $_COOKIE['id'];
    } else if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    }

    $stat = "SELECT cart_id FROM bysap.Cart WHERE user_id = $user_id";
    $result = oci_parse($connection, $stat);
    oci_execute($result);
    $data = oci_fetch_array($result);

    $stat1 = "SELECT COUNT(*) AS COUNT FROM bysap.Cart_Items WHERE cart_id = $data[CART_ID]";
    $result1 = oci_parse($connection, $stat1);
    oci_execute($result1);
    $data1 = oci_fetch_array($result1);

    if ($data1['COUNT'] < 20) {

        $stat2 = "SELECT * FROM bysap.Cart_Items WHERE cart_id = $data[CART_ID] AND product_id = $product_id";
        $result2 = oci_parse($connection, $stat2);
        oci_execute($result2);
        $data2 = oci_fetch_array($result2);

        if (!$data2) {

            $stat3 = "INSERT INTO bysap.Cart_Items (product_quantity, product_id, cart_id, wishlist) VALUES ($quantity, $product_id, $data[CART_ID], 'No')";
            $result3 = oci_parse($connection, $stat3);
            oci_execute($result3);
            $_SESSION['cart_success'] = 'Product added to cart successfully.';
        } else {
            $_SESSION['cart_failure'] = 'Product is already in cart.';
        }
    }
    else
    {
        $_SESSION['cart_failure'] = 'Cart limit(20) exceeded.';
    }



    header("location: prod_description.php?id=$product_id");
}
