<?php

include 'connection.php';

$id = $_GET['id'];
$quantity = $_GET['quantity'];
$stock = $_GET['stock'];
$type = $_GET['type'];

if($type ==  'increase')
{
    if($stock > 20)
    {
        $max = 20;
    }
    else 
    {
        $max = $stock;
    }
    if ($quantity < $max)
    {
        $quantity++;
    }

}
else if ($type == 'decrease')
{
    if($quantity > 1)
    {
        $quantity--;
    }
}

$sql = "UPDATE bysap.Cart_Items SET product_quantity = $quantity WHERE cart_item_no = $id";
$result = oci_parse($connection, $sql);
oci_execute($result);
header('location: cart.php');


?>