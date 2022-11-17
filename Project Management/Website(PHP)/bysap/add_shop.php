<?php
    session_start();
    include 'connection.php';

    if(isset($_POST['shopsubmit']))
    {
            if(isset($_COOKIE['id']))
        {
            $user_id = $_COOKIE['id'];
        }
        else if(isset($_SESSION['id']))
        {
            $user_id = $_SESSION['id'];
        }

            $shop_name = $_POST['shop_name'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];

            $query = "SELECT COUNT(*) AS COUNT FROM bysap.shop WHERE user_id = $user_id";
            $result1 = oci_parse($connection, $query);
            oci_execute($result1);
            $data1 = oci_fetch_array($result1);

            if($data1['COUNT'] < 10)
            {
                $sql = "INSERT INTO bysap.Shop (user_id, shop_name, address, contact, authorized) VALUES ($user_id, '$shop_name', '$address', $contact, 'No')";
                $result = oci_parse($connection, $sql);
                oci_execute($result);
                $_SESSION['shop_success'] = 'Shop added successfully';
            }
            else 
            {
                $_SESSION['shop_delete'] = 'Shop limit (10) exceeded.';
            }
    }
    header('location: manage_shop.php');

 

?>