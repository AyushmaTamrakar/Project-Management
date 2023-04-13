<?php 
session_start();
include_once('connect.php');
$id=   $_SESSION['productId'] ;
   $cDate= date('d/m/Y', strtotime($_SESSION['cDate'])); 
  $cDate = $_SESSION['cDate'];
  $cTime = $_SESSION['cTime'];
  if(isset($_SESSION['user'])){
   $email = $_SESSION['user'];
 $query = "SELECT CUSTOMERID FROM CUSTOMER WHERE EMAIL = '$email'";
 $result = oci_parse($conn, $query);
 oci_execute($result);

 $row= oci_fetch_assoc($result);
 $customerid = $row['CUSTOMERID'];
 
}
  $custid = $customerid;
$orderId = "SELECT ORDER_ID FROM ORDERS WHERE ORDERTIME ='$cTime' AND ORDERDATE =TO_DATE('".$cDate."','dd-mm-yy') AND  CUSTOMER_ID ='$custid'";
$resultid = oci_parse($conn, $orderId);
oci_execute($resultid);
$idorder = oci_fetch_assoc($resultid);
$fool = $idorder['ORDER_ID'];
$query1="UPDATE ORDERS SET PAYMENT ='PAID' WHERE ORDER_ID = '$fool'";
$result4 = oci_parse($conn, $query1);
oci_execute($result4);

$query7 = "UPDATE ORDER_ITEM SET PAYMENT ='PAID' WHERE ORDERID ='$fool'";
$result7 = oci_parse($conn, $query7);
oci_execute($result7);
if(oci_execute($result7)){
	echo "Updated successfully";
}
// $jpt = $_GET['id'];
// echo $jpt;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment Successful</title>
	<script
      src="https://kit.fontawesome.com/6338071364.js"
      crossorigin="anonymous"
    ></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400&family=Mukta:wght@500;600&family=Orelega+One&family=Playfair+Display&family=Radio+Canada:wght@600&family=Source+Sans+3:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="confirmation.css">
</head>
<body>
	<div class="container">
		<div class="logo">
			<img src="img/Logo1.png" width="50px" height="35px">
		</div>
		<div class="info">
			<img src="img/verified.png" width="100px" height="100px">
			<h1>Payment Confirmed!</h1>
			<p><a href="http://localhost/Cleckart/WEBSITE/invoice%20.php">GET INVOICE</a></p> 
		</div>
	</div>
</body>
</html>