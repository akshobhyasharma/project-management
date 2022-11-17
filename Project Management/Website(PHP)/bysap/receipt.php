<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="scss/main.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">

</head>

<body>
    

    <!------ Entire receipt page container starts here ---------->

    <div class="container-md">
        <div class="row">

        <?php
            //Include connection.php file to connect to Oracle  Database
            include 'connection.php';

            //Get order and user id from URL
            $order_id = $_GET['order_id'];
            $user_id = $_GET['user_id'];

            $date = date('n/d/Y');

            //Query to fetch all the details of the ordered product
            $stat = "SELECT product_name, price, prod_quantity FROM bysap.order_product o, bysap.product p WHERE o.product_id = p.product_id AND order_id= $order_id";
            $result = oci_parse($connection, $stat);
            oci_execute($result);

            //Query to fetch all details of the customer 
            $stat1 = "SELECT * FROM bysap.Users WHERE user_id = $user_id";
            $result1 = oci_parse($connection,$stat1);
            oci_execute($result1);
            $data1 = oci_fetch_array($result1);

            //Query to fetch the total price of the ordered products 
            $stat2 = "SELECT total_price FROM bysap.Orders WHERE order_id = $order_id";
            $result2 = oci_parse($connection,$stat2);
            oci_execute($result2);
            $data2 = oci_fetch_array($result2);



        ?>
            <div class="receipt-container mx-auto mt-3 p-sm-5 p-0 ps-1">
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <img src="images/logo/logo.png" alt="logo.png">
                            <p style="font-size: 0.75em; margin-top: 3px; margin-bottom: 1px;">Cleckhuddersfax,</p>
                            <p style="font-size: 0.75em;">+44 7911 2536</p>
                            <br></br><br>

                            To,
                            <br>
                            <?php echo $data1['FULLNAME'] ?>
                            <br>
                            <?php echo $data1['ADDRESS'] ?>
                            <br>
                            <?php echo $data1['CONTACT'] ?>
                    </div>
                    <div class="col-sm-6 text-end">
                        <p>
                            Receipt No. BSE<?php echo $order_id; ?>S
                        </p>
                        <p>
                            <?php echo date('M d, Y'); ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center">

                        <h2>RECEIPT</h2>

                    </div>
                    </span>
                    <div class="table-responsive">
                    <table class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Particulars</th>
                                <th>Quantity</th>
                                <th class="text-center">UnitPrice</th>
                                <th class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            while ($data = oci_fetch_array($result)) {
                                echo '<tr>

                                    <td class="col-md-1">' . $count . '</h4>
                                    </td>
                                    <td class="col-md-5">' . $data['PRODUCT_NAME'] . '</h4>
                                    </td>
                                    <td class="col-md-2 text-center">' . $data['PROD_QUANTITY'] . '</td>
                                    <td class="col-md-2 text-center"> &pound;' . number_format($data['PRICE'], 2) . '</td>
                                    <td class="col-md-2 text-center"> &pound;' . number_format(($data['PROD_QUANTITY'] * $data['PRICE']), 2) . '</td>
                                    </tr>';
                                $count++;
                            }
                            ?>

                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-center">
                                    <p>
                                        <strong>Subtotal: </strong>
                                    </p>
                                    <p>
                                        <strong>Discount: </strong>
                                    </p>
                                </td>
                                <td class="text-center">
                                    <p>
                                        <strong> &pound;<?php echo number_format($data2['TOTAL_PRICE'],2) ?></strong>
                                    </p>
                                    <p>
                                        <strong> &pound;0.00</strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td class="text-center">
                                    <h4><strong>Total: </strong></h4>
                                </td>
                                <td class="text-center">
                                    <h4><strong> &pound;<?php echo number_format($data2['TOTAL_PRICE'],2) ?></strong></h4>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                    
                    </div>
                    <div>
                        <b>Payment Method</b>
                        <br>

                        PayPal
                        <h5 class="text-center receipt-msg">
                            Thank you for your order.
                        </h5>
                        <div class="text-center">
                            <p style="margin-bottom: 1px;">Team BYSAP</p>
                        </div>

                    </div>
                </div>

            </div>
            <div class="receipt-btn">
                <button id = "pdf-btn">Save as pdf</button>
                <button onclick="window.location.href='index.php'">Return Home</button>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


        <script>
            const btn = document.querySelector('#pdf-btn');
            const receipt = document.querySelector('.receipt-container');
            btn.addEventListener('click', () => {
                html2pdf().from(receipt).save();

            })
        </script>
</body>

</html>