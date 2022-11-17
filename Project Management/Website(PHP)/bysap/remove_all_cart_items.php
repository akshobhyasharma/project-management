<?php
session_start();
include 'connection.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    if(isset($_GET['destination']))
    {
        $query = "DELETE FROM bysap.Cart_Items WHERE wishlist = 'Yes' AND cart_id = (SELECT cart_id FROM bysap.cart WHERE user_id = $id)";
    }
    else
    {
        $query = "DELETE FROM bysap.Cart_Items WHERE wishlist = 'No' AND cart_id = (SELECT cart_id FROM bysap.cart WHERE user_id = $id)";
    }
    

    $result = oci_parse($connection, $query);
    oci_execute($result);
    
}
else
{
    unset($_SESSION['product']);
}
$_SESSION['remove_cart_item'] = 'All items removed successfully.';

if(isset($_GET['destination']))
{
    header('location: wishlist.php');
}
else{
    header('location: cart.php');
}

?>