<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}
include"connect.php";
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
     $filename = $_FILES['file']['name'];
    
    $filetmpname= $_FILES['file']['tmp_name'];
    $folder = 'imageuploaded/'.$filename;

     move_uploaded_file($filetmpname, $folder);  
    $name = $_POST['name'];
    $mails = $_POST['email'];
    $pan = $_POST['pan'];
    $add = $_POST['addr'];
    // $image = $_POST['file'];

    $query = "UPDATE TRADER SET TRADERNAME = '$name', PANNUMBER = '$pan', EMAIL='$mails', ADDRESS = '$add', PROFILEPIC = '$folder' WHERE TRADERID ='".$_SESSION['ID']."'";
    $stid = oci_parse($conn, $query);
    if(oci_execute($stid)){
        echo".";
    }
    else{
        echo"Unalbe to upload image!";
    }
 }
$query = "SELECT * FROM TRADER WHERE EMAIL= '". $_SESSION['user']."'";
    $stid5 = oci_parse($conn, $query);
    if(oci_execute($stid5)){
        while($row = oci_fetch_assoc($stid5)){
             $_SESSION['ID'] = $row['TRADERID'];
            $_SESSION['name'] = $row['TRADERNAME'];
            $_SESSION['email'] = $row['EMAIL'];
             $_SESSION['password'] = $row['CONFIRMPASSWORD'];
             $_SESSION['addr'] = $row['ADDRESS'];
             $_SESSION['pan'] = $row['PANNUMBER'];
              $_SESSION['img'] = $row['PROFILEPIC'];
             
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trader Profile</title>
    <link rel="stylesheet" type="text/css" href="try.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400&family=Orelega+One&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="headFoot.css" />
    <script src="home.js" defer></script>
    <script
      src="https://kit.fontawesome.com/6338071364.js"
      crossorigin="anonymous"
    ></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400;600&family=Orelega+One&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400;600&family=Mukta:wght@500;600;800&family=Orelega+One&family=Playfair+Display&family=Source+Sans+3:wght@300;600&display=swap" rel="stylesheet">

</head>
  <body>
    
     <!-- ------------------------------------------HEADER START --------------------------------------------->
    <header class="header">
      <input type="checkbox" id="nav-toggle"class="nav-toggle">
      <div class="side">
         <a href="http://localhost/Cleckart/WEBSITE/home.php">Home</a>
        <a href="http://localhost/Cleckart/WEBSITE/aboutus.php">About Us</a>
        <a href="http://localhost/Cleckart/WEBSITE/cart.php">Cart</a>
        <a href="http://localhost/Cleckart/WEBSITE/cart.php">Wishlist</a>
        <a href="http://localhost/Cleckart/WEBSITE/cart.php">Products</a>
         <a href="http://localhost/Cleckart/WEBSITE/reg/headFoot.php">Sign Up</a>
        <a href="http://localhost/Cleckart/WEBSITE/login.php">Login</a>
            <a href="http://localhost/Cleckart/WEBSITE/contact.php">Contact Us</a>
         <a href="#">Profile</a>

      </div>
      <label for="nav-toggle" class="nav-toggle-lable">
        <img src="image/menu.png" height="20px" width="20px">
      </label>
      <div id="logo">
        <a href="home.html"><img src="image/Logo.png" height="120px" width="170px" /></a>
      </div>
      <!--div class="search">
        <form id="tfnewsearch" method="get" action="http://www.google.com">
          <input
            type="text"
            class="tftextinput"
            placeholder="Search in ClecKart..."
            name="q"
            size="21"
            maxlength="120"
          /><input type="submit" value="search" class="tfbutton" />
        </form>
      </div-->
      <div class="links">
         <button type="" submit><a href="login.php" class="log">Login</a></button>
        <button type="" submit><a href="reg/headFoot.php">Sign Up</a></button>
        <a ><i id="user-btn" class="far fa-user-circle fa-xs"></i></a>
        <a href="#" ><i class="fas fa-shopping-cart"></i></a>
        <a href="#"><i class="far fa-heart"></i></a>

        <!-- <div class="modal-box">
          <img src="image/man.jpg">
          <h2>Usernaem</h2>
          <h2>jndjnjd@gmail.com</h2>
          <div class="modal-button">
            <button class="edit-button">Logout</button>
            <button class="edit-button">Edit Profile</button>
          </div>
        
        </div> -->
      </div>
    </header>
    <div class="dummy">
    </div>
    <!-- nav2 -->
    <nav class="nav2">
      <ul>
        <li>
          <a href="http://localhost/Cleckart/WEBSITE/cart.php"
            >Products<!--i class="fas fa-air-freshener"--></i
          ></a>
        </li>
        <li>
          <a href="http://localhost/Cleckart/WEBSITE/aboutus.php">About Us<!--i class="fas fa-shopping-cart"--></i></a>
        </li>
        <li>
          <a href="http://localhost/Cleckart/WEBSITE/contact.php">Contact Us<!--i class="far fa-air-freshener"--></i></a>
        </li>
      </ul>
    </nav>

    <!-------------------------------------------------------- END HEADER -------------------------------------------------------------->

    <div class="containermid">
    <div class="form">
        <div class="profile">
           <!--  <img src="" alt=" UPLOAD PROFILE IMAGE" class="avatar"> -->
            <?php echo "<img width=100px height=250px src=".$_SESSION['img'].">";?>
            <h4><?php   
            if(isset($_SESSION['user'])){
                echo $_SESSION['user'];
                echo '<br/>';
            }
            else{
              
                echo $_SESSION['error'];
            } 
            ?></h4><br/>
            <h2 class="button-set"><a href="changepassword.php">Change Password</a></h2>
             <h2 class="button-set"><a href="http://localhost:8080/apex/f?p=103:LOGIN_DESKTOP:5995714440442:::::">View Dashboard</a></h2>
            
        </div>
        <div class="insert">
            <form method="POST" action=" " enctype="multipart/form-data">
                    <fieldset>
                        <legend>Edit Your Details</legend>
                         <label for="pp">Profile Pic:</label><br>
                       <input type = "file" name="file"></input><br><br>
                        <label for="name">Name:</label><br>
                        <input type="text" name="name" value="<?php  echo "".$_SESSION['name'].""; ?>"><br><br>
                         <label for="email">Email:</label><br>
                        <input type="text" name="email" value="<?php  echo "".$_SESSION['email'].""; ?>"><br><br>
                        <label for="pan no.">PAN NUMBER:</label><br>
                        <input type="text" name="pan" value="<?php  echo "".$_SESSION['pan'].""; ?>"><br><br>
                        <!--  <label for="price">New Password:</label><br>
                        <input type="text" name="price"><br><br>
                         <label for="name">Confirm Password:</label><br>
                        <input type="text" name="stock"><br><br> -->
                         <label for="addr">Address:</label><br>
                        <input type="text" name="addr" value="<?php  echo "".$_SESSION['addr'].""; ?>"><br><br>
                        <div class="box-button">
                            <button type="submit" onClick="window.location.reload();" method="post" name="profile" class="button" >Save</button>
                             <button type=""  class="button"><a href="setting1.php">View Shops</a></button>
                           
                            <button type="button" method="" class="button"><a href="logout.php">Logout</a></button>
                        </div>
                    </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- <script src="traderprofile.js"></script> -->
        <!--------------------------------------------------------    FOOTER ----------------------------------------------------------->
    <footer>
      <div class="container">
        <div class="first box">
          <h2>Quick Links</h2>
          <p class="link">
                <a href="http://localhost/Cleckart/WEBSITE/home.php">Home</a>
            <a href="http://localhost/Cleckart/WEBSITE/login.php">Login</a>
            <a href="http://localhost/Cleckart/WEBSITE/cart.php">Products</a>
            <a href="http://localhost/Cleckart/WEBSITE/aboutus.php">About US</a>
          </p>
        </div>
        <div class="second box">
          <h2>Contact Us</h2>
          <p class="link">
            <a
              href="https://www.google.com/maps/place/Sherpa+Mall/@27.7105497,85.3156752,17z/data=!3m1!4b1!4m5!3m4!1s0x39eb19015ce34aa3:0x833d1f9f02d0db2d!8m2!3d27.710545!4d85.3178639"
              ><i class="fas fa-map-marker-alt"></i>Cleckhuddersfax</a
            >
            <a href="tel:+9770913582040"
              ><i class="fas fa-phone"></i>+9770913582040</a
            >
            <a href="mailto:clekart@gmail.com"
              ><i class="far fa-envelope"></i>info.clekart@gmail.com</a
            >
          </p>
        </div>
       <div class="third box">
          <h2>Information</h2>
          <p class="link">
            <a href="http://localhost/Cleckart/WEBSITE/aboutus.php"
              >About Us
            </a>
            <a href="http://localhost/Cleckart/WEBSITE/terms.html"
              >Privacy Policy
            </a>
            <a href="http://localhost/Cleckart/WEBSITE/contact.php"
              >Office location
            </a>
          </p>
        </div>        
         
        </div>
      
    
    </footer>
    <div class="bottom-box">&copy; 2020 ClecKart. All Rights Reserved.</div>
    <!-- ***************************** END FOOTER *************************************** -->

    <script type="text/javascript">
      /******************* MODAL BOX ********************/

let userBox = document.querySelector('.modal-box');

document.querySelector('#user-btn').onclick = () =>{
  userBox.classList.toggle('active');
}
    </script>

  </body>
</body>
</html>

