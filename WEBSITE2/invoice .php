<?php 
include_once('connect.php');
 session_start();


 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Invoice </title>
	<link rel="stylesheet" type="text/css" href="invoice.css">
	<script src="invoice.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</head>

<body>
<div class="download">
		<button type="submit" id="download">DOWNLOAD PDF</button>
	
	<div class="wrapper" id="invoice">
		
		<div class="invoice_wrapper" >
			<div class="header">
				<div class="logo_invoice_wrap">
					<div class="logo_sec">
						
						    
		
						<img src="ClecKart Logo.png" alt="ClecKart" width="150px" height="150px">
						<div class="titla_wrap">
							<p class="title_bold"><h1>[<?php 
							$user = $_SESSION['user'];

                           $cdate= date('d/m/Y', strtotime($_SESSION['cDate'])); 
							$cdate=  $_SESSION['cDate']; 
							$ctime = $_SESSION['cTime'];
							$query = "SELECT ORDER_ID FROM ORDERS WHERE USER_NAME='$user' AND ORDERDATE = TO_DATE('".$cdate."','dd-mm-yy') AND ORDERTIME = '$ctime'";
							$result = oci_parse($conn, $query);
							oci_execute($result);
							$row = oci_fetch_assoc($result);
							 // $number ??= $row['ORDER_ID'];
							echo $row['ORDER_ID'];
							?>.]</h1><h3><div id="current_date" name="current_date"></div><div id="day" name="day"></div></h3></p>
							<!-- <p class="sub_title light">Private Limited</p> -->
							<p class = "title_bold"><h4>Collection Date: <?php echo $_SESSION['slot'] . " ". $_SESSION['time'] ?></h4></p>
						</div>
					</div>
					<div class="invoice_sec">
						<p class="invoice_bold">INVOICE</p>
						<p class="invoice_no">
						<span class="bold">ClecKart Pvt.Ltd<BR/>
						<span class="bold">CleckHuddersFax<BR/>
						<span class="bold">+44-675656<BR/>
						<span class="bold">info.Cleckart@gmail.com<BR/>
						<!-- <span class="bold">www.Cleckart.com</span> -->
					<!-- 	<span>INVOICE NO.PHP</span> -->
					</p>
					<!-- <p class="date">
						<span class="bold">Date</span>
						<span>DATE.PHP</span>
					</p> -->
					</div>
				</div>
				<!-- <div class="bill_total_wrap">
					<div class="bill_sec">
						<p>Bill To</p>
						<p class="bold name">NAME.PHP</p>
						<span>ADDRESS.PHP<BR/>
							ADDRESS.PHP
						</span>
					</div>
					<div class="total_wrap">
						<p>Total Due</p>
						<p class="bold price">EURO:£PRICE.PHP</p>
					</div>
				</div> -->
			</div>
			<div class="body">
				<div class="main_table">
					<div class="table_header">
						<div class="row">
							<div class="col col_no"><p class="bold">S.N</p></div>
							<div class="col col_des"><p class="bold">ITEM NAME</p></div>
							<div class="col col_quan"><p class="bold">QUANTITIES</p></div>
							<div class="col col_pri"><p class="bold">PRICE</p></div>
							<div class="col col_amou"><p class="bold">AMOUNT</p></div>
						</div>

					</div>
				
					<div class="table_body">
						<?php 
						$total=0;
						$gtotal=0;
						$discount = 5;

						 foreach($_SESSION['cartAdd'] as $key => $value){
							 $total = $value['productPrice'] * $value['Quantity'];
							$gtotal += $total ;
							$num = $key + 1;
							
						?>
						<div class="row">
							<div class="col col_no"><p class="bold"><?php echo $num; ?></p></div>
							
							<div class="col col_des"><p class="bold"><?php echo $value['productName']; ?></p></div>
							<div class="col col_quan"><p class="bold"><?php echo $value['Quantity']; ?></p></div>
							<div class="col col_pri"><p class="bold">£ &nbsp;<?php echo $value['productPrice']; ?></p></div>
							<div class="col col_amou"><p class="bold itotal">£ &nbsp; <?php echo $total; ?></p></div>
						</div>
							<?php }?>

					</div>
					</div>
				
				<div class="paymethod_grandtotal_wrap">
					<p class="bold">Sub-Total:£&nbsp; <?php echo $gtotal; ?> </p>
					
			
			</div>
		<hr hr style="height:2px;border-width:0;color:gray;background-color:gray">
		<h1>Billing Address:</h1>
		<div class="box">
		<div class="boxed">
			
			
  <p class="bold">NAME:<?php echo $_SESSION['name'];?></p>
   <p class="bold">ADDRESS:<?php echo  $_SESSION['address'].', '.$_SESSION['city'];?></p>
    <p class="bold">PHONE NUMBER:<?php echo  $_SESSION['phone'];?></p>
     <p class="bold">EMAIL:<?php echo  $_SESSION['email']?></p>

</div>
</div>
			</div>

	
			<div class="footer">
				<h3>Thankyou for Shopping with ClecKart!</h3>
				<h4>ClecKart, info.ClecKart@gmail.com</h4>
			</div>
</div>
	</div>
	</div>
	<script>
		  const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

			const d = new Date();
			let day = weekday[d.getDay()];
			document.getElementById("current_date").innerHTML = day;
			
			var today = new Date();

			var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			document.getElementById("day").innerHTML = date;



	</script>
	
</body>
</html>

<?php
unset($_SESSION['cartAdd']);
?>