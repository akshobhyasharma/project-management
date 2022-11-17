<?php
session_start(); 
$email = htmlentities($_POST['email']);
$sendername = htmlentities($_POST['name']);
$message = htmlentities($_POST['message']);
$to = htmlentities("bysap21@gmail.com");

$mail_content= "$message";

$subject = "Customer Query";
$header = array(
    "From: $email",
    "Sender-name: $name",
    "Reply-to: $email",
    "X-Mailer: PHP/".PHP_VERSION
);

$header = implode("\r\n",$header);

if(mail($to, $subject, $message, $header)){
    $_SESSION['query-pass']="Query send successfully.";
}else{
   $_SESSION['query-failed'] =  "Failed to send query. Try Again.";
}
header('Location: contact.php');
?>
