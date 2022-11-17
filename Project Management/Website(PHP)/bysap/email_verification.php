<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">
    <title>BYSAP: Successful Registration</title>
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>


    <?php
    include 'connection.php';

    if (isset($_GET['email'])) {

        $email = $_GET['email'];

        $query = "UPDATE bysap.users SET verified = 'Yes' WHERE email = '$email'";

        $result = oci_parse($connection, $query);
        oci_execute($result);

        $query1 = "SELECT * FROM bysap.users WHERE email = '$email'";

        $result1 = oci_parse($connection, $query1);
        oci_execute($result1);
        $data = oci_fetch_array($result1);

        if ($data['ROLE'] == 'Customer') {
            $query2 = "INSERT INTO bysap.cart (user_id) VALUES ($data[USER_ID])";
            $result2 = oci_parse($connection, $query2);
            oci_execute($result2);
        }

        if ($result) {
            echo '<div class="container verification-container">
        <div class="rep-but-2 d-block">
    
          <div class="jumbotron">
            <h1 class="display-3">Thank You!</h1>
            <p class="lead-p">
              <strong>
                <i class="fas fa-envelope fa-3x"></i>
                <h2>You have successfully verified your email.
            </p></strong>
          </div>
        </div>
      </div>';
        }
    } else {
        echo '<p class="text-danger d-block mx-auto">Sorry, some error has occured.</p>';
    }

    ?>

</body>

</html>