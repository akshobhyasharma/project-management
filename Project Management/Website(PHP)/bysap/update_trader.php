<?php
session_start();

include 'connection.php';

if (isset($_POST['updateconfirm'])) {
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['user_date']) && isset($_POST['address']) && isset($_POST['contact']))
    {
        $fullname = $_POST['firstname'].' '.$_POST['lastname'];
        $user_id = $_POST['user_id'];

        if (!empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['confirmpassword'])) {
            
            $sql = "SELECT password FROM bysap.Users WHERE user_id = $user_id";
            $result = oci_parse($connection, $sql);
            oci_execute($result);
            $data = oci_fetch_array($result);

            if (sha1($_POST['oldpassword']) == $data['PASSWORD']) {
                $uppercase = preg_match('@[A-Z]@', $_POST['newpassword']);
                $lowercase = preg_match('@[a-z]@', $_POST['newpassword']);
                $number = preg_match('@[0-9]@', $_POST['newpassword']);



                if ($uppercase && $lowercase && $number && strlen($_POST['newpassword']) >= 8) {
                    if ($_POST['newpassword'] == $_POST['confirmpassword']) {
                        $password = htmlentities(sha1($_POST['newpassword']));

                        $sql1 = "UPDATE bysap.Users SET fullname = '$fullname', email = '$_POST[email]', password = '$password', user_date = TO_DATE('$_POST[user_date]', 'YYYY-MM-DD'), address = '$_POST[address]', contact = $_POST[contact] WHERE  user_id = $user_id";

                        $result1 = oci_parse($connection, $sql1);
                        oci_execute($result1);
                        $_SESSION ['setup_successful'] = 'Changes Saved';
                        $_SESSION['name'] = $_POST['firstname'];
                        setcookie('name', $_POST['firstname'], time() + 86400 *30);
                    } 
                    else
                    {
                        $_SESSION['setup_error'] = 'Password does not match.';
                    }
                } else {
                    $_SESSION['setup_error'] = 'Password must contain at least 8 characters, one uppercase, one lowercase and a number.';
                }
            } 
            else
            {
                $_SESSION['setup_error'] = 'Incorrect Password';
            }
        }
        else
        {
            $sql2 = "UPDATE bysap.Users SET fullname = '$fullname', email = '$_POST[email]', user_date = TO_DATE('$_POST[user_date]', 'YYYY-MM-DD'), address = '$_POST[address]', contact = $_POST[contact] WHERE  user_id = $user_id";

            $result2 = oci_parse($connection, $sql2);
            oci_execute($result2);
            $_SESSION ['setup_successful'] = 'Changes Saved';
            $_SESSION['name'] = $_POST['firstname'];
            setcookie('name', $_POST['firstname'], time() + 86400 *30);
        }
    }
}

header("location: setup_trader.php?id=$_POST[user_id]");
