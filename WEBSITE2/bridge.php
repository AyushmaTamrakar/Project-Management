<?php
session_start();
include_once('connect.php');

if(isset($_POST['submit'])){
    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $slot = $_POST['slot'];
    $time = $_POST['time'];
    $currentDate = $_POST['cdate'];

    $currentTime = $_POST['ctime'];

    
echo $currentDate."<br>";
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
    $_SESSION['phone']= $phone;
    $_SESSION['address']= $address;
    $_SESSION['city']=$city;
    $_SESSION['slot'] = $slot;
    $_SESSION['time'] =$time;
    $_SESSION['cDate'] = $currentDate;
    $_SESSION['cTime'] = $currentTime;
    
    
}

// $_SESSION['user']='tamrakar.ayusma2002@gmail.com';
if(isset($_SESSION['user'])){
   $email = $_SESSION['user'];
 $query = "SELECT CUSTOMERID FROM CUSTOMER WHERE EMAIL = '$email'";
 $result = oci_parse($conn, $query);
 oci_execute($result);

 $row= oci_fetch_assoc($result);
 $customerid = $row['CUSTOMERID'];
 
}



 if(isset($_SESSION['user']) && isset($customerid) 
     && isset($_SESSION['grand']) && isset($_SESSION['slot']) 
     && isset($_SESSION['time']) && isset($_SESSION['cTime']) ){
  $user = $_SESSION['user'];
  $time = $_SESSION['time'];
  $slot = $_SESSION['slot'];
  $grand = $_SESSION['grand'];
  $custID = $customerid;

   $cDate= date('d/m/Y', strtotime($currentDate)); 
  $cDate = $_SESSION['cDate'];
   $cTime = $_SESSION['cTime'];
   $query1= "INSERT INTO ORDERS(CUSTOMER_ID, ORDER_TOTAL, USER_NAME, SLOTTIME, SLOTDATE, ORDERDATE, ORDERTIME) VALUES('$custID', '$grand', '$user', '$time', '$slot', TO_DATE('".$cDate."','dd-mm-yy'), '$cTime')";
   $result1 = oci_parse($conn, $query1);
   oci_execute($result1);
}






foreach($_SESSION['cartAdd'] as $key => $value){
    $productId = $value['productId'];
    $_SESSION['productId'] = $productId;
    $unit_price = $value['productPrice'];
    $quantity = $value['Quantity'];


    $user = $_SESSION['user'];
     $cDate= date('d/m/Y', strtotime($currentDate)); 
    $cDate=  $_SESSION['cDate']; 
    echo $cDate;
    $ctime = $_SESSION['cTime'] ;
    $query = "SELECT ORDER_ID FROM ORDERS WHERE USER_NAME='$user' AND ORDERDATE = TO_DATE('".$cDate."','dd-mm-yy') AND ORDERTIME = '$ctime'";

    $result = oci_parse($conn, $query);
    oci_execute($result);
    $row = oci_fetch_assoc($result);
    echo "<br>";
    $orderId = $row['ORDER_ID'];
    // echo $orderId."<br>";

    $queryTrad = "SELECT TRADER.TRADERID FROM TRADER JOIN SHOP ON TRADER.TRADERID = SHOP.TRADERID JOIN PRODUCT ON SHOP.SHOPID = PRODUCT.SHOPID WHERE PROID = '$productId'";
    $resultTrad = oci_parse($conn, $queryTrad);
    oci_execute($resultTrad);
    while($row= oci_fetch_assoc($resultTrad)){
    $traderId = $row['TRADERID'];
    }


    $query = "INSERT INTO ORDER_ITEM (ORDERID, PRODUCTID, UNIT_PRICE, QUANTITY, TRADERID) VALUES('$orderId','$productId', '$unit_price','$quantity','$traderId')";
    $result = oci_parse($conn, $query);
    if(oci_execute($result)){
        echo "Inserted Successfully";
    }
    $query ="SELECT STOCK FROM PRODUCT WHERE PROID = '$productId'";
    $result = oci_parse($conn, $query);
    oci_execute($result);
    $row = oci_fetch_assoc($result);
    $stock =  $row['STOCK'];
    
   $query = "UPDATE PRODUCT SET STOCK = $stock - $quantity WHERE PROID = '$productId' ";
   $result = oci_parse($conn, $query);
   oci_execute($result);
  


  $query5 ="SELECT STOCK FROM PRODUCT WHERE PROID = '$productId'";
    $result5 = oci_parse($conn, $query5);
    oci_execute($result5);
    $row = oci_fetch_assoc($result5);
    $stock =  $row['STOCK'];
    if($stock<=0){
        $query2 = "UPDATE PRODUCT SET STATUS = 'Unavailable' AND STOCK = 0 WHERE PROID = '$productId'";
        $result4 = oci_parse($conn, $query2);
        oci_execute($result4);
    }

    
}
// echo $productId."<br>". $unit_price. "<br> ". $quantity;



 


header("location:sandbox.php");

?>