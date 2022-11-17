<?php
session_start();
include 'connection.php';

$id = $_GET['id'];

$query = "DELETE FROM bysap.Cart_Items WHERE cart_item_no = $id";

$result = oci_parse($connection, $query);
oci_execute($result);
$_SESSION['remove_cart_item'] = 'Product removed successfully.';
if(isset($_GET['destination']))
{
    header('location: wishlist.php');   
}
else{
    
    header('location: cart.php');
}

?>