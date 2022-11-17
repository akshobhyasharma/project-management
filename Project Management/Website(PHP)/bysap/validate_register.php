<?php
include 'connection.php';
session_start();

if (isset($_POST['firstname'])) {
    $firstname = htmlentities($_POST['firstname']);
}
if (isset($_POST['lastname'])) {
    $lastname = htmlentities($_POST['lastname']);
}

if ($lastname) {
    $fullname = $firstname . ' ' . $lastname;
} else {
    $fullname = $firstname;
}


$email = htmlentities($_POST['email']);
if (isset($_POST['customersubmit'])) {
    $role = 'Customer';
    $_SESSION['Customer'] = 1;
} else if (isset($_POST['tradersubmit'])) {
    $role = 'Trader';
    $_SESSION['Trader'] = 1;
}


$uppercase = preg_match('@[A-Z]@', $_POST['password']);
$lowercase = preg_match('@[a-z]@', $_POST['password']);
$number = preg_match('@[0-9]@', $_POST['password']);



if ($uppercase && $lowercase && $number && strlen($_POST['password']) >= 8) {
    if ($_POST['password'] == $_POST['confirmpassword']) {
        $password = htmlentities(sha1($_POST['password']));
    } else {
        $_SESSION['mismatch'] = '<h6>Password does not match.</h6>';
    }
} else {
    $_SESSION['error'] = '<h6>Password must contain at least 8 characters, one uppercase, one lowercase and a number.</h6>';
}

$address = htmlentities($_POST['address']);
$contact = htmlentities($_POST['contact']);


if (isset($_POST['gender'])) {
    $gender = htmlentities($_POST['gender']);
} else {
    $gender = null;
}

$dob = htmlentities($_POST['dob']);

if (isset($password)) {

    $query = "INSERT INTO bysap.users (fullname, email, password, role, address, contact, gender,user_date, verified) VALUES ('$fullname', '$email', '$password', '$role', '$address', $contact,'$gender', TO_DATE('$dob', 'YYYY-MM-DD'), 'No')";

    $result = oci_parse($connection, $query);
    oci_execute($result);
  
    if($role == 'Trader')
    {
        $query1 = "SELECT * FROM bysap.users WHERE email = '$email'";
        $result1 = oci_parse($connection, $query1);
        oci_execute($result1);
        $data = oci_fetch_array($result1);

        $query2 = "INSERT INTO bysap.shop (user_id, shop_name, authorized) VALUES ($data[USER_ID], '$_POST[shopname]', 'No')";

        $result2 = oci_parse($connection, $query2);
        oci_execute($result2);

    }

    if ($result) {

        //Send email verification mail after successful registration
        $to_email = "$email";
        $subject = "Email Verification";
        $body = "Please click the link below to verify your email address: <br> <a href = 'localhost/bysap/email_verification.php?email=$email'>Verify Email</a>";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...";
        } else {
            echo "Email sending failed...";
        }

        echo '<script>window.open("verification_msg.php")</script>';

        if(isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price'])){

            echo '<script>window.location = "signin.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'"</script>';
        }
        else{
            echo '<script>window.location = "signin.php"</script>';
        }

    }
}
else{

    if(isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price'])){

        header('location: register.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'');
    }
    else{
        header('Location: register.php');
    }
    }
   

?>