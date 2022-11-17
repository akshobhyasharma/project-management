<?php
session_start();
include 'connection.php';
$day = $_POST['day'];
$time = $_POST['time'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

$sql = "SELECT * FROM bysap.Collection_Slot WHERE slot_time = '$time' AND slot_day = TO_DATE('$day', 'MM/DD/YYYY')";
$result = oci_parse($connection, $sql);
oci_execute($result);
$data = oci_fetch_array($result);

if (!$data) {
    $sql1 = "INSERT INTO bysap.Collection_Slot (slot_time, slot_day) VALUES ('$time', TO_DATE('$day', 'MM/DD/YYYY'))";
    $result1 = oci_parse($connection, $sql1);
    oci_execute($result1);
}

$sql2 = "SELECT slot_no, total_orders FROM bysap.Collection_Slot WHERE slot_day = TO_DATE('$day', 'MM/DD/YYYY') AND slot_time = '$time'";
$result2 = oci_parse($connection, $sql2);
oci_execute($result2);
$data2 = oci_fetch_array($result2);

if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

$sql3 = "SELECT cart_id FROM bysap.Cart WHERE user_id = $user_id";
$result3 = oci_parse($connection, $sql3);
oci_execute($result3);
$data3 = oci_fetch_array($result3);

$sql4 = "INSERT INTO bysap.Orders (total_quantity, subtotal, total_price, status, cart_id, slot_no) VALUES ($quantity, '$price', '$price', 'Pending', $data3[CART_ID], $data2[SLOT_NO])";
$result4 = oci_parse($connection, $sql4);
oci_execute($result4);

$sql5 = "SELECT MAX(order_id) AS order_id FROM bysap.Orders";
$result5 = oci_parse($connection, $sql5);
oci_execute($result5);
$data5 = oci_fetch_array($result5);

if ($data2['TOTAL_ORDERS'] < 20) {
    $data2['TOTAL_ORDERS']++;
    $sql6 = "UPDATE bysap.Collection_Slot SET total_orders = $data2[TOTAL_ORDERS] WHERE slot_no = $data2[SLOT_NO]";
    $result6 = oci_parse($connection, $sql6);
    oci_execute($result6);
}
else{
    $_SESSION['slot_limit'] = 'Slot limit(20) exceeded.';
    header("location: checkout.php?quantity=$quantity&price=$price");
}




?>

<?php
//Set variables for paypal form
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
//Test PayPal API URL
$paypal_email = 'bysap21@gmail.com';
?>


<form action="<?php echo $paypal_url; ?>" method="post" class="paypal-form">
    <!-- Paypal business test account email id so that you can collect the payments. -->
    <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
    <!-- Buy Now button. -->
    <input type="hidden" name="cmd" value="_xclick">
    <!-- Details about the item that buyers will purchase. -->

    <input type="hidden" name="item_name" value="<?php echo $data5['ORDER_ID']; ?>">
    <input type="hidden" name="item_number" value="<?php echo $data5['ORDER_ID']; ?>">
    <input type="hidden" name="amount" value="<?php echo $price; ?>">
    <input type="hidden" name="currency_code" value="GBP">
    <!-- URLs -->
    <input type='hidden' name='cancel_return' value='http://localhost/bysap/cancel_order.php?order_id=<?php echo $data5['ORDER_ID']?>'>

    <?php
  if(isset($_GET['product_id']))
  {
      echo "<input type='hidden' name='return' value='http://localhost/bysap/payment_success.php?cart_id=$data3[CART_ID]&user_id=$user_id&order_id=$data5[ORDER_ID]&product_id=$_GET[product_id]&quantity=$_GET[quantity]'>";
  }
  else{
    echo "<input type='hidden' name='return' value='http://localhost/bysap/payment_success.php?cart_id=$data3[CART_ID]&user_id=$user_id&order_id=$data5[ORDER_ID]'>";
  }
  ?>
</form>

<script>
    const form = document.querySelector('.paypal-form');
    form.submit();
</script>