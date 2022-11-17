<?php
session_start();
include 'connection.php';
    if (isset($_POST['messagesubmit'])) {
        $rating = $_POST['rating'];

        if (isset($_POST['message'])) {
            $message = $_POST['message'];
        } else {
            $message;
        }

        $product_id = $_POST['product_id'];
        $user_id = $_POST['user_id'];

        $query = "SELECT review_id FROM bysap.Review WHERE product_id = $product_id and user_id = $user_id";

        $result = oci_parse($connection, $query);
        oci_execute($result);
        $data = oci_fetch_array($result);

        if ($data)
        {
            $_SESSION['review_status'] = 'false';
        } 
        else 
        {
            $query1 = "INSERT INTO bysap.Review (message, rating, product_id, user_id) VALUES ('$message', $rating,$product_id, $user_id)";

            $result1 = oci_parse($connection, $query1);
            oci_execute($result1);
           
            $_SESSION['review_status'] = 'true';

        }
    }
    header("location: prod_description.php?id=$product_id");

?>