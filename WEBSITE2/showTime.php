<?php 
// session_start();
if(isset($_POST['slot'])){
$slot = $_POST['slot'];
echo $slot;
$time = $_POST['time'];
echo $time;

}
else{
	echo"nope!";
}



?>