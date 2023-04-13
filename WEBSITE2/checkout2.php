 <?php 
if(isset($_POST['submit'])){
  if(!empty($_POST['time'])){$slot = $_POST['time'];
echo $slot;}

$slot1 = $_POST['slot'];
echo $slot1;
}
?>
 <form method="POST" action="">      
              
      <label for="delivery">DELIVERY SLOT</label><br>
     <input type="radio" name="slot" value="Wednesday">Wednesday
      <input type="checkbox" id="box1" name="time" value="10AM-1PM">10AM-1PM
        <input type="checkbox" id="box2" name="time">1PM-4PM
      <input type="checkbox" id="box3" name="time">4PM-7PM<br>
      <input type="radio" id="slot2" name="slot">Thursday
      <input type="checkbox" id="box4" name="time">10AM-1PM
      <input type="checkbox"id="box5" name="time">1PM-4PM
      <input type="checkbox"id="box6" name="time">4PM-7PM<br>
      <input type="radio" id="slot3" name="slot">Friday
      <input type="checkbox" id="box7" name="time">10AM-1PM
      <input type="checkbox" id="box8" name="time">1PM-4PM
      <input type="checkbox" id="box9" name="time">4PM-7PM<br>
      <button type = "submit" class="button" name="submit" >CHECKOUT</button>
           
        
      
      </form>