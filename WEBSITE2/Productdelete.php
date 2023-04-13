<?php
 session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}
include "connect.php";
unset($_SESSION['arr']);
 $ProductID = $_GET['id'];
$query = "DELETE FROM PRODUCT WHERE PROID = '$ProductID'";
$stid = oci_parse($conn, $query);
if(oci_execute($stid)){
	echo"Product deleted successfully!";
	header("location:setting1.php");
}
else{
	echo"something went wromng!";
}
?>