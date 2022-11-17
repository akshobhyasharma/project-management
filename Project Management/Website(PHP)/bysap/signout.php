<?php
    session_start();
    setcookie('name', '', time() - 30);
    setcookie('id', '', time() - 30);
    setcookie('role', '', time() - 30);
    session_unset();
    session_destroy();
    header('Location: index.php');
?>