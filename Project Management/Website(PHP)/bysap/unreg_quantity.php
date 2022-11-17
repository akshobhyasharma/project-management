<?php
    session_start();
    $product_id = $_GET['id'];
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
$_SESSION['product'][$product_id] = $quantity;
header('location: cart.php');

?>