<?php

session_start();
include 'connection.php';

if(isset($_POST['productsubmit']))
{
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

    $sql = "INSERT INTO bysap.Product (product_name, description, price, stock, allergy_information, discount, category, shop_no, approve) VALUES ('$product_name', '$description', '$price', $stock, '$allergy_information', $discount, '$category', $shop_no, 'No' )";

    $result = oci_parse($connection, $sql);
    oci_execute($result);
    $_SESSION['product_success'] = 'Product added successfully';
    header('location: trader_interface.php');

}

?>