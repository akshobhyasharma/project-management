<?php
    include 'connection.php';
    $cart_id = $_GET['cart_id'];
    $user_id = $_GET['user_id'];
    $order_id = $_GET['order_id'];
    $date = date('n/d/Y');

    $sql1 = "SELECT * FROM bysap.Orders WHERE order_id = $order_id";
    $result1 = oci_parse($connection, $sql1);
    oci_execute($result1);
    $data = oci_fetch_array($result1);

   
    if(isset($_GET['product_id']))
    {
        $sql4 ="INSERT INTO bysap.Order_Product (prod_quantity, product_id, order_id) VALUES ($_GET[quantity], $_GET[product_id], $order_id)";
        $result4 = oci_parse($connection, $sql4);
        oci_execute($result4);
    }
    else {
        $sql4 ="INSERT INTO bysap.Order_Product (prod_quantity, product_id, order_id) SELECT product_quantity, product_id, $order_id FROM bysap.Cart_Items WHERE cart_id = $cart_id AND wishlist = 'No'";
        $result4 = oci_parse($connection, $sql4);
        oci_execute($result4);

        $sql = "DELETE FROM bysap.Cart_Items WHERE cart_id = $cart_id AND wishlist = 'No'";
        $result = oci_parse($connection, $sql);
        oci_execute($result);
    }
    


   

    $sql2 = "INSERT INTO bysap.Payment (payment_date, total_amount, order_id, user_id) VALUES (to_date('$date', 'MM/DD/YYYY'), '$data[TOTAL_PRICE]', $order_id, $user_id)";
    $result2 = oci_parse($connection, $sql2);
    oci_execute($result2);

    $sql3 = "UPDATE bysap.Orders SET status = 'Purchased' WHERE order_id = $order_id";
    $result3 = oci_parse($connection, $sql3);
    oci_execute($result3);


    $sql5 = "SELECT * FROM bysap.order_product WHERE order_id = $order_id";
    $result5 = oci_parse($connection, $sql5);
    oci_execute($result5);
    while ($data5 = oci_fetch_array($result5))
    {
        $sql6 = "SELECT * FROM bysap.product WHERE product_id = $data5[PRODUCT_ID]";
        $result6 = oci_parse($connection, $sql6);
        oci_execute($result6);
        $data6 = oci_fetch_array($result6);

        $new_stock = $data6['STOCK'] - $data5['PROD_QUANTITY'];
        $sql7 = "UPDATE bysap.product SET stock = $new_stock WHERE product_id = $data5[PRODUCT_ID]";
        $result7 = oci_parse($connection, $sql7);
        oci_execute($result7);
}

    header("location: receipt.php?order_id=$order_id&user_id=$user_id");
