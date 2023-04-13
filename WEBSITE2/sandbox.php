<?php 
session_start();
include("connect.php");
$pay = $_SESSION['grand'];
?>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST" id="buyCredits" name="buyCredits">

<input type="hidden" name="business" value="info.cleckart2@gmail.com">
<input type="hidden" name="cmd" value="_xclick" />

<input type="hidden" name="amount" value="<?php echo $pay?> " />

<input type="hidden" name="currency_code" value="GBP" />

<input type="hidden" name="return" value="http://localhost/Cleckart/WEBSITE/paymentscuccess.php">
</form>

<script>
document.getElementById("buyCredits").submit();
</script>