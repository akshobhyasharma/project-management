<?php

    session_start();
    include 'connection.php';

    $shop_no = $_GET['id'];

    $state = "DELETE FROM bysap.order_product WHERE product_id IN (SELECT product_id FROM bysap.product WHERE shop_no = $shop_no)";
    $result2 = oci_parse($connection, $state);
    oci_execute($result2);

    $state1 = "DELETE FROM bysap.cart_items WHERE product_id IN (SELECT product_id FROM bysap.product WHERE shop_no = $shop_no)";
    $result3 = oci_parse($connection, $state1);
    oci_execute($result3);

    $state2 = "DELETE FROM bysap.images WHERE product_id IN (SELECT product_id FROM bysap.product WHERE shop_no = $shop_no)";
    $result4 = oci_parse($connection, $state2);
    oci_execute($result4);

    $stat3 = "DELETE FROM bysap.Review WHERE product_id IN (SELECT product_id FROM bysap.product WHERE shop_no = $shop_no)";
    $result5 = oci_parse($connection, $stat3);
    oci_execute($result5);

    $sql = "DELETE FROM bysap.Product WHERE shop_no = $shop_no";
    $result = oci_parse($connection, $sql);
    oci_execute($result);

    $sql1 = "DELETE FROM bysap.Shop WHERE shop_no = $shop_no";
    $result1 = oci_parse($connection, $sql1);
    oci_execute($result1);
    $_SESSION['shop_delete'] = 'Shop removed successfully';
    header('location: manage_shop.php'); 
?>