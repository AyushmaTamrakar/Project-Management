<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  background-color: #fff;
  flex-direction: column;
  margin-top: 20px;
}
.row1{
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  background-color: #fff;
  position:  relative;
  width: 80%;
  justify-content: space-between;
  margin: 0 auto;
  margin-top: 100px;
  margin-bottom: 100px;
}
img{
  position: absolute;
  top:  2px;

}
.col-25,
.col-50, {
  padding: 0 16px;
}

.container {
 /* background-image: url("image/v.jpg");*/
  background-color: #fff;
  padding: 50px 50px 50px 50px;
  border: 5px solid forestgreen;
  border-radius: 20px;
  COLOR:  black;
  margin: 0 auto;
  width: 60%;

}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: forestgreen;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 50%;
  border-radius: 25px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: white;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}
h3{
  text-align:  center;
  color: forestgreen;
  text-transform: uppercase;
}
.title{
  color: forestgreen;
  font-weight: bold;
}
.hour{
  display:  flex;
}
}
.sub-button{
  margin-left: 15px;
  max-width: 300px;
  display: flex;
  justify-content: space-between;
  margin: 0 auto;
  margin-top: 50px;
  justify-content:  center;
}
.sub-button input{
  background-color: forestgreen;
  padding: 5px 15px 5px 15px;
  color: white;
  border-radius: 8px;
  font-size: 20px;
  border: none;
}
.logo{
  display: flex;
  justify-content: center;
  margin-bottom: 200px;
}

@media (max-width: 1300px){
  .container{
    width: 80%;
  }
}
@media (max-width: 900px){
  .container{
    width: 100%;
  }
}
@media (max-width: 715px){
  .slot{
  font-size: 15px;
}
@media (max-width: 570px){
  .tslot{
    font-size: 10px;
  
}
  .sub-button input{
    font-size: 10px;
    padding: 5px 5px 5px 5px;
  }
}

</style>
</head>
<body>



<div class="row1">
    <div class="container">
      <div class="logo">
        <img src="ClecKart Logo.png" width=200px, height=200px>
      </div>
      <form action="/action_page.php">
      

        <div class="row">

          <div class="col-50">
            <h3>Personal Info</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" >

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment Method</h3>
            <div class="icon-container">
              <i class="fa fa-cc-paypal" style="color:navy;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" >
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" >
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" >
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" >
              </div>
              <div class="col-50">
                 <form method="POST" action="invoice.php">      
        
                <label for="delivery" class="title">DELIVERY SLOT</label>
                <label class="slot" for="slot1">
                  <div>
                    <input type="radio" name="slot" value="Wednesday">Wednesday</input>
                  </div>
                  <div class="tslot">
                    <input type="radio" id="box1" name="time" value="10AM-1PM">10AM-1PM</input>
                    <input type="radio" id="box2" name="time" value="1PM-4PM">1PM-4PM</input>
                    <input type="radio" id="box3" name="time" value="4PM-7PM">4PM-7PM</input>
                  </div>
                  </label><br>
                <label class="slot" for="slot2"><div>
                  <input type="radio" id="slot2" name="slot" value="Thursday">Thursday</input>
                </div>
                  <div class="tslot">
                    <input type="radio" id="box4" name="time" value="10AM-1PM">10AM-1PM</input>
                    <input type="radio"id="box5" name="time" value="1PM-4PM">1PM-4PM</input>
                    <input type="radio"id="box6" name="time" value="4PM-7PM">4PM-7PM</input>
                  </div><br>
                  </label>
                <label class="slot" for="slot3">
                  <div><input type="radio" id="slot3" name="slot" value="Friday">Friday</input></div>
                  <div class="tslot">
                    <input type="radio" id="box7" name="time" value="10AM-1PM">10AM-1PM</input>
                    <input type="radio" id="box8" name="time" value="10AM-1PM">1PM-4PM</input>
                    <input type="radio" id="box9" name="time" value="10AM-1PM">4PM-7PM</input></label>
                  </div>
              

              </div><br>
              <div class="hour"><div class="time"><label for="time">Current Day:</label></div><div id="current_date" name="time"></div></div>
               <div>
                 <div class="hour"><div class="time"><label for="time">Current Time:</label></div><div id="current_date2" name="time2"></div></label>
               </div>

               <div class="sub-button">
                 <input type = "submit" class="button" name="submit" class="btn"></input>
                 <input type = "submit" class="button" name="submit" value="Checkout" class="btn"></input>
                  <input type = "submit" class="button" name="submit" value="Home" class="btn"></input>
               </div>
              </div>
            </div>
          </div>
         
        </div>
        
      </form>
    </div>

</div>
<!-- **************************************************************** -->
<script>
  const weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

const d = new Date();
let day = weekday[d.getDay()];
document.getElementById("current_date").innerHTML = day;



var z = new Date(); // for now
let hr = z.getHours(); // => 9
let min = z.getMinutes(); // => 9
let sec = z.getSeconds(); // => 9
document.getElementById("current_date2").innerHTML = hr + ":" + min +":"+ sec;
if(day == "Wednesday" && hr < 10 && min >= 0 && hr<13){
document.getElementById("box1").disabled = true;
document.getElementById("box2").disabled = true;
document.getElementById("box3").disabled = true;

} 
else if(day == "Wednesday" && hr >= 10 && min >= 0 && hr<13){
document.getElementById("box4").disabled = true;
document.getElementById("box1").disabled = true;
document.getElementById("box2").disabled = true;
document.getElementById("box3").disabled = true;

} 

else if(day == "Wednesday" && min>=0 && hr >= 13 && hr <16){
document.getElementById("box4").disabled = true;
document.getElementById("box1").disabled = true;
document.getElementById("box2").disabled = true;
document.getElementById("box3").disabled = true;
document.getElementById("box5").disabled = true;
}
else if(day == "Wednesday"  && min >= 0  && hr >= 16){  
document.getElementById("box4").disabled = true;
document.getElementById("box1").disabled = true;
document.getElementById("box2").disabled = true;
document.getElementById("box3").disabled = true;
document.getElementById("box5").disabled = true;
document.getElementById("box6").disabled = true;
}

// *******************************************************************
else if(day == "Thursday" && hr < 10 && min >= 0 && hr<13){
document.getElementById("box4").disabled = true;
document.getElementById("box5").disabled = true;
document.getElementById("box6").disabled = true;

} 
else if(day == "Thursday" && hr >= 10 && min >= 0 && hr<13){

document.getElementById("box4").disabled = true;
document.getElementById("box5").disabled = true;
document.getElementById("box6").disabled = true;
document.getElementById("box7").disabled = true;

} 

else if(day == "Thursday" && min>=0 && hr >= 13 && hr <16){

document.getElementById("box4").disabled = true;

document.getElementById("box5").disabled = true;
document.getElementById("box6").disabled = true;
document.getElementById("box7").disabled = true;
document.getElementById("box8").disabled = true;
}
else if(day == "Thursday"  && min >= 0  && hr >= 16){
document.getElementById("box4").disabled = true;
document.getElementById("box9").disabled = true;
document.getElementById("box5").disabled = true;
document.getElementById("box6").disabled = true;
document.getElementById("box7").disabled = true;
document.getElementById("box8").disabled = true;
}
// ********************************************************************
else if(day == "Friday"){
document.getElementById("box7").disabled = true;
document.getElementById("box8").disabled = true;
document.getElementById("box9").disabled = true;
} 
else if(day == "Tuesday" && hr >= 10 && min >= 0 && hr<13){

document.getElementById("box1").disabled = true;
} 
else if(day == "Tuesday" && min>=0 && hr >= 13 && hr <16){

document.getElementById("box1").disabled = true;

document.getElementById("box2").disabled = true;
}
else if(day == "Tuesday"  && min >= 0  && hr >= 16){
document.getElementById("box1").disabled = true;
document.getElementById("box2").disabled = true;
document.getElementById("box3").disabled = true;

}

</script>
</body>
</html>
