<?php

session_start();
include 'connection.php';

if(isset($_POST['shopsubmit']))
{
    $shop_no = $_POST['shop_no'];
    $shop_name = $_POST['shop_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $sql = "UPDATE bysap.Shop SET shop_name = '$shop_name', address = '$address', contact = $contact WHERE shop_no = $shop_no";
    $result = oci_parse($connection, $sql);
    oci_execute($result);
    $_SESSION['edit_shop'] = 'Changes saved successfully.';
    header('location: manage_shop.php');

}


?>