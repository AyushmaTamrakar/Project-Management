<?php
 session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}
 include "connect.php";
  $filename = $_FILES['file']['name'];
    
    $filetmpname= $_FILES['file']['tmp_name'];
    $folder = 'imageuploaded/'.$filename;

    move_uploaded_file($filetmpname, $folder);
 $ProductID = $_POST['id'];
 $Name = $_POST['name'];
// $Image = $_POST['file'];
 $Type = $_POST['category'];
 $Price= $_POST['price'];
 $Stock = $_POST['stock'];
 $Description = $_POST['description'];
 $Allergy = $_POST['allergy'];

$query2 = "UPDATE PRODUCT SET NAME = '$Name', PROTYPE = '$Type', DESCRIPTION= '$Description', ALLERGY_INFO='$Allergy', PRICE = '$Price', STOCK = '$Stock', IMAGE = '$folder'  WHERE PROID = '$ProductID' ";
$stid = oci_parse($conn, $query2);
if(oci_execute($stid)){
    echo"Product updated successfully!";
    header("location:setting1.php");
}
else{
     echo"something went wromng!";
}  

?>
