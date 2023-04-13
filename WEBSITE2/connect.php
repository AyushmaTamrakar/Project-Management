

<?php $conn = oci_connect('Admin2', 'Avantika@2058!#', '//localhost/xe'); if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; } else {
   // print "Connected to Oracle!"; 
   } 
    // oci_close($conn);


    ?>