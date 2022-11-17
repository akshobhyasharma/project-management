<?php
session_start();
include 'connection.php';

$email =$_POST['email'];
$password = sha1($_POST['password']);


$query = "SELECT user_id, fullname, email, password, verified, role FROM bysap.users WHERE email = '$email' AND password = '$password'";

$result = oci_parse($connection, $query);
oci_execute($result);
$data = oci_fetch_array($result);



if(oci_num_rows($result) > 0){

    if($data['VERIFIED'] == 'Yes')
    {
        
        //Set cookie to the customer's credentials for a longer time 
        if(isset($_POST['remember']))
        {
            setcookie('id', $data['USER_ID'], time() + 86400 *30);
            setcookie('name', $data['FULLNAME'], time() + 86400 *30);
            setcookie('role', $data['ROLE'], time() + 86400 *30);

            if($data['ROLE'] == 'Customer')
            {
                if(isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
                {
                    $statement ="SELECT cart_id FROM bysap.cart WHERE user_id = $data[USER_ID]";
                    $result = oci_parse($connection, $statement);
                    oci_execute($result);
                    $data = oci_fetch_array($result);


                    $statement1 = "DELETE FROM bysap.Cart_Items WHERE cart_id = $data[CART_ID]";
                    $result1 = oci_parse($connection, $statement1);
                    oci_execute($result1);

                    foreach($_SESSION['product'] as $id => $qty)
                    {
                        $statement2 = "INSERT INTO bysap.Cart_Items (product_quantity, product_id, cart_id, wishlist) VALUES ($qty, $id, $data[CART_ID], 'No')";
                        $result2 = oci_parse($connection, $statement2);
                        oci_execute($result2);

                    }
                    header("location: checkout.php?quantity=$_GET[quantity]&price=$_GET[price]");
                }
                else
                {
                    header('location: index.php');
                }
                
            }
            else if($data['ROLE'] == 'Trader')
            {
                header('location: trader_interface.php');
            }
        }
        else
        {
            //Set session variable to store customer's credentials for an active session
            $_SESSION['name'] = $data['FULLNAME'];
            $_SESSION['id'] = $data['USER_ID'];
            $_SESSION['role'] = $data['ROLE'];

            if($data['ROLE'] == 'Customer')
            {

               if(isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
                {

                    $statement ="SELECT cart_id FROM bysap.cart WHERE user_id = $_SESSION[id]";
                    $result = oci_parse($connection, $statement);
                    oci_execute($result);
                    $data = oci_fetch_array($result);


                    $statement1 = "DELETE FROM bysap.Cart_Items WHERE cart_id = $data[CART_ID]";
                    $result1 = oci_parse($connection, $statement1);
                    oci_execute($result1);

                    foreach($_SESSION['product'] as $id => $qty)
                    {
                        $statement2 = "INSERT INTO bysap.Cart_Items (product_quantity, product_id, cart_id, wishlist) VALUES ($qty, $id, $data[CART_ID], 'No')";
                        $result2 = oci_parse($connection, $statement2);
                        oci_execute($result2);

                    }
                    header("location: checkout.php?quantity=$_GET[quantity]&price=$_GET[price]");
                }
                else
                {
                     header('location: index.php');
                }
            }
            else if($data['ROLE'] == 'Trader')
            {
               header('location: trader_interface.php');
            }
    
        }
       }

    else{
    
        $_SESSION['InvalidLogin'] = "Please verify your email.";

        if(isset($_GET['quantity']) && isset($_GET['price']))
        {
            header("Location: signin.php?quantity=$_GET[quantity]&price=$_GET[price]");

        }
        else{
            header("Location: signin.php");
        }
       
    }

}
else{
    $_SESSION['InvalidLogin'] = "Invalid email address or password.";
    if(isset($_GET['quantity']) && isset($_GET['price']))
        {
            header("Location: signin.php?quantity=$_GET[quantity]&price=$_GET[price]");

        }
        else{
            header("Location: signin.php");
        }
}


?>