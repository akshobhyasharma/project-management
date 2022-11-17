<?php
    session_start();
    include 'connection.php';
    $id = $_GET['id'];

    $stat = "UPDATE bysap.cart_items SET wishlist = 'No' WHERE cart_item_no = $id";
    $result = oci_parse($connection, $stat);
    oci_execute($result);
    $_SESSION['cart_success'] = 'Product added to cart successfully.';
    header('location: wishlist.php');


?>