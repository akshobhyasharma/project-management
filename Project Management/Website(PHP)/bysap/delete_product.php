<?php
    session_start();
    include 'connection.php';
    $product_id = $_GET['id'];

    $state = "DELETE FROM bysap.order_product WHERE product_id = $product_id";
    $result2 = oci_parse($connection, $state);
    oci_execute($result2);

    $state1 = "DELETE FROM bysap.cart_items WHERE product_id = $product_id";
    $result3 = oci_parse($connection, $state1);
    oci_execute($result3);

    $state2 = "DELETE FROM bysap.images WHERE product_id = $product_id";
    $result4 = oci_parse($connection, $state2);
    oci_execute($result4);

    $sql = "DELETE FROM bysap.Review WHERE product_id = $product_id";
    $result = oci_parse($connection, $sql);
    oci_execute($result);

    $sql1 = "DELETE FROM bysap.Product WHERE product_id = $product_id";
    $result1 = oci_parse($connection, $sql1);
    oci_execute($result1);
    $_SESSION['delete_product'] = 'Product removed successfully.';
    header('location: trader_interface.php'); 
?>