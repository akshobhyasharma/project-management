<?php 


$connection = oci_connect('System', 'Emma123!', '//localhost/xe');
    if (!$connection)
    {
        $m = oci_error();
        echo $m['message'], "\n";
        exit;
   } 
    // oci_close($connection); 
?>
