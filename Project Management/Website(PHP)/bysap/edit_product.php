<?php
session_start();
include 'connection.php';

if(isset($_POST['productsubmit']))
{
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $shop_no = $_POST['shop_no'];

    if(isset($_POST['allergy_information']) && !empty($_POST['allergy_information']))
    {
        $allergy_information = $_POST['allergy_information'];
    }
    else{
        $allergy_information = '';
    }

    if(isset($_POST['discount']) && !empty($_POST['discount']))
    {
        $discount = $_POST['discount'];
    }
    else{
        $discount = 0;
    }

    $sql = "UPDATE bysap.Product SET product_name = '$product_name', description = '$description', price = '$price', stock = $stock, allergy_information = '$allergy_information', discount = $discount, category = '$category', shop_no = $shop_no WHERE product_id = $product_id";

    $result = oci_parse($connection, $sql);
    oci_execute($result);
    $_SESSION['edit_product'] = 'Product amended successfully.';
    header('location: trader_interface.php');

}

?>