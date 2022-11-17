<?php
    include 'connection.php';
    $order_id = $_GET['order_id'];

    $stat = "SELECT * FROM bysap.Orders WHERE order_id = $order_id";
    $result = oci_parse($connection, $stat);
    oci_execute($result);
    $data =oci_fetch_array($result);

    $stat1 = "DELETE FROM bysap.Orders WHERE order_id = $order_id";
    $result1 = oci_parse($connection, $stat1);
    oci_execute($result1);

    $stat2 = "SELECT * FROM bysap.Collection_Slot WHERE slot_no = $data[SLOT_NO]";
    $result2 = oci_parse($connection, $stat2);
    oci_execute($result2);
    $data2 =oci_fetch_array($result2);

    $data2['TOTAL_ORDERS']--;
    $stat3 = "UPDATE bysap.Collection_Slot SET total_orders = $data2[TOTAL_ORDERS] where slot_no = $data[SLOT_NO]";
    $result3 = oci_parse($connection, $stat3);
    oci_execute($result3);


    header('location: cart.php');
?>

