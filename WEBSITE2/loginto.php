<?php
session_start();
include "connect.php";
    if(isset($_POST['Login'])){
        $username = $_POST['username'];
        
        $drop = $_POST['drop'];
        if($drop == 'Trader'){
          $password = sha1($_POST['password']);
        $query = "SELECT EMAIL, CONFIRMPASSWORD FROM TRADER WHERE EMAIL = '$username'AND CONFIRMPASSWORD = '$password' AND STATUS='Active'";
        $result = oci_parse($conn, $query);
        oci_execute($result);
        if ($row = oci_fetch_assoc($result)) {
          $_SESSION['user'] = $username;
            header("location:traderprofile.php");
   } 
        
        else {
            header("location:wrongLogin.html");
     
        
        }
      }
      elseif($drop == 'Customer'){
        $password = $_POST['password'];
         $query = "SELECT NAME, PASSWORD FROM CUSTOMER WHERE EMAIL = '$username' AND PASSWORD = '$password'";
        $result = oci_parse($conn, $query);
        oci_execute($result);
        if ($row = oci_fetch_assoc($result)) {
             $_SESSION['user'] = $username;
            header("location:customerprofile.php");
   } 
        
        else {
            header("location:wrongLogin.html");
     
        
        }
      }
      elseif($drop == 'Management'){
         $password = $_POST['password'];
        if($password == 'Admin' && $username == 'Admin'){
        header("location:adminlogin.php");
    }
            else{
         header("location:wrongLogin.html");
      }
      }

    }
?>