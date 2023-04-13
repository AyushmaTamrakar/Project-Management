<?php
session_start();
 include_once('connect.php');


 $cfname = "";
$nameerr= "";

$clname = "";
$clnameerr= "";

$adder = "";
$addererr= "";

$maile= "";
$maileerr = "";

$pass = "";
$passerr = "";

$cpass = "";
$cpasserr = "";


$conterr= "";

$gend = "";
$genderr = "";

$check = "";
$checkErr = "";

$dob = "";
$doberr = "";


$query = "SELECT EMAIL FROM TRADER ";
            $result=oci_parse($conn, $query);
            oci_execute($result);
            $arr = [];
            while($row = oci_fetch_assoc($result)){
            $arr[] = $row;

            }

            $query1 = "SELECT EMAIL FROM CUSTOMER ";
            $result1=oci_parse($conn, $query1);
            oci_execute($result1);
            $arr1 = [];
            while($row = oci_fetch_assoc($result1)){
            $arr1[] = $row;

            }

if (isset($_POST['customerSubmit'])){

 

// $dob = date('m/d/Y',strtotime($_POST['DOB']));
  // $dob = to_date($_POST['DOB'],'dd/mm/yyyy');
  // $dob=$_POST['DOB'];



if(empty($_POST['Name']) && empty($_POST['LastName']) && empty($_POST['Email'])&& empty($_POST['Password']) && empty($_POST['cPassword']) && empty($_POST['Address'])&& empty($_POST['Contact'])&& empty($_POST['Gender']) && empty($_POST['DOB'])){
  $bigError ="All fields required!";
}
else{
// -----first name ----
   
   if (empty($_POST["Name"])) {
    $nameerr = "Name is required";
  } else {
    $cfname = test_input($_POST["Name"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$cfname)) {
      $nameerr = "Only letters and white space allowed";
    }
   
  }
// --------------last name -----------
   if (empty($_POST["LastName"])) {
    $clnameerr = "Last Name is required";
  } else {
    $clname = test_input($_POST["LastName"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$clname)) {
      $clnameerr = "Only letters and white space allowed";
    }
   
  }
// -------------address-------------
    if (empty($_POST["Address"])) {
    $addererr = "Address is required";
  } else {
    $adder = test_input($_POST["Address"]);
  }
// --------------email-------------
   if (empty($_POST["Email"])) {
    $maileerr = "Email is required";
  } else {
    $maile = test_input($_POST["Email"]);
    // check if e-mail address is well-formed
    if (!filter_var($maile, FILTER_VALIDATE_EMAIL)) {
      $maileerr = "Invalid email format";
    }
  }
// ---------password------------
  if (empty($_POST["Password"])) {
    $passerr = "Password is required";
}
  else {
    $pass = test_input($_POST["Password"]);
    if(!preg_match('@[A-Z]@', $pass) || !preg_match('@[a-z]@', $pass) || !preg_match('@[0-9]@', $pass) || !preg_match('@[^\w]@', $pass) || strlen($pass) < 8) {
    $passerr =  "Uppercase,Lowercase,Number,SpecialChar";
    }
    else{
      $pass = test_input($_POST["Password"]);
    }
  }
// -----------conform password ---------------
  if (empty($_POST["cpassword"])) {
    $cpasserr = "Please confirm the password";
  } 
  else{
    $cpass = test_input($_POST["cpassword"]);
    if($pass != $cpass){
     $cpasserr = "Doesnot match the password"; 
    }
     else{
      $pass = test_input($_POST["Password"]);
    }
  }
 // ------------contact--------
  if (empty($_POST["Contact"])) {
    $conterr = "Contact is required";
  } 
  else {
    $cont = test_input($_POST["Contact"]);
    if(strlen($cont)<10 || strlen($cont)>10){
       $conterr = "Contact should be 10 digits";
    }
    if(!is_numeric($cont)){
        $conterr = "Contact should be only number";
    } 
  }
  //-------------checkbox----------
   if(isset($_POST['check']));
    else{
      $checkErr = "Please check the terms and conditions";
    }

     if (empty($_POST["DOB"])) {
    $doberr = "Date of Birth is required";
  }
  else{
   
    $dob= date('d/m/Y', strtotime($_POST['DOB']));   
  }
// ----------------gender-------------
  if(isset($_POST['Gender'])){
    $gend = $_POST['Gender'];
  }
  elseif(empty($_POST['Gender'])){
    $genderr = "Gender is required";
  }
 

 
 if(empty($nameerr)&&empty($clnameerr)&&empty($addererr)&&empty($maileerr)&&empty($passerr)&&empty($cpasserr)&&empty($conterr)&&empty($genderr)&&empty($checkErr)&&empty($doberr)){
    if(isset($arr1)){
             
             $my_product1 = array_column($arr1, 'EMAIL');
      if($row = in_array($_POST['Email'], $my_product1)){
         echo "<script>alert('Email already taken please try a new email!')</script>";
       }

 //        }
        else{

           
 $arr1 = array("EMAIL" => $_POST['Email']);
  $stid = oci_parse($conn,"INSERT INTO Customer (Name, LastName, Address, Email, Password, Contact, Gender, DOB) VALUES(:cfname, :clname, :adder, :maile, :pass, :cont, :gend, TO_DATE('".$dob."','dd-mm-yy'))");
   


  oci_bind_by_name($stid, ":cfname", $cfname);
  oci_bind_by_name($stid, ":clname", $clname);
  oci_bind_by_name($stid, ":adder", $adder);
  oci_bind_by_name($stid, ":maile", $maile);
  oci_bind_by_name($stid, ":pass", $pass);
  oci_bind_by_name($stid, ":cont", $cont);
  oci_bind_by_name($stid, ":gend", $gend);
   // oci_bind_by_name($stid, ":dob", $dob);

  if(oci_execute($stid))
{
  // echo "Customer added successfully!";
  // header("location:123.php");
  // ************************************************
  $to = $maile;
$subject = "Cleckart Customer";

$message = "Thankyou very much for being a cusotmer of cleckart. We value you the most. Now you can login to the site with you details.Username: ".$cfname." Password: ".$pass;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <cleckart.info@gmail.com>' . "\r\n";
// $headers .= 'Cc: neavan84@gmail.com' . "\r\n";

if(mail($to,$subject,$message,$headers))
{
    header("location:congrats(Customer).html");

}

else{
    echo "Unable to send email";
}
// ****************************************************
}
else{
  echo "Something went wrong try again!";
}
}
}
}}}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//  ------------------------------------------------

if(isset($_POST['traderSubmit'])){
  
  
    if(empty($_POST['traderName']) && empty($_POST['PANNumber']) && empty($_POST['email'])&& empty($_POST['contact']) && empty($_POST['address']) && empty($_POST['contact'])&& empty($_POST['password'])&& empty($_POST['confirmPassword']) && empty($_POST['shopType'])){
        $bigError ="All fields required!";
    }
    else{
        // TRADER NAME Validation
        if(empty($_POST['traderName'])){
            $nameError = "Name is required";
        }
        else{
            $traderName = htmlentities($_POST['traderName']);
        }
        // Email Validation
        if(!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
          // session_start();
            $_SESSION['email']= $_POST['email'];
           
        }
        elseif(empty($_POST['email'])){
           $emailReqError ="Email is required!<br>";    
        }
        else{
            $emailError ="Please enter a valid email address";
        }
        // pan number validation
        if (!empty($_POST['PANNumber']) && preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $_POST['PANNumber'])) {
            $PANNumber = strtoUpper($_POST['PANNumber']);
         
        }
        elseif(!empty($_POST['PANNumber']) && !preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $_POST['PANNumber'])){
            $panError = "PAN Number should be in format e.g.,ABCDE1234F";
        }
        else{
            $panReqError = "PAN Number is required!";
        }
        //----------------- contact validation-----------------------------------
        if(!empty($_POST['contact']) && preg_match("/^[0-9]{3}[-|\s]?[0-9]{4}[-|\s]?[0-9]{4}$/", $_POST['contact']) ){
            $contact = $_POST['contact'];
  
        }
        elseif(!empty($_POST['contact']) && !preg_match("/^[0-9]{3}[-|\s]?[0-9]{4}[-|\s]?[0-9]{4}$/", $_POST['contact']) ){
           $contactError1 = "Invalid phone number";
        }
        elseif(empty($_POST['contact']) ){           
            $contactError = "Contact is required";
        }
        // address validation
        if(!empty($_POST['address'])&& preg_match("/^[a-zA-Z ]*$/",$_POST['address'])){
            $addres = $_POST['address'];
            
        }
        elseif(!empty($_POST['address'])&& preg_match("/^[0-9]*$/",$_POST['address'])){
            $addrError1 = "Invalid address";
        }
        elseif(empty($_POST['address'])){        
            $addrError = "Address is required";
        }
        // shop type validation
        if(!empty($_POST['shopType']) && preg_match("/^[a-zA-Z ]*$/",$_POST['shopType'])){
            $shopType = $_POST['shopType'];
           
        }
        elseif(!empty($_POST['shopType']) &&preg_match("/^[0-9 ]*$/",$_POST['shopType'])){
            $shopError = "Should not contain numbers";
        }
        elseif(!empty($_POST['shopType']) &&preg_match("/^[a-zA-Z@ ]*$/",$_POST['shopType'])){
            $shopError1 = "Should not contain characters";
        }
        else{
            $shopReqError = "Shop Type is required";
        }
         $shopType2 = $_POST['shopType2'];
        // password validation
        if(!empty($_POST['password']) && strlen($_POST['password'])>=6 && preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/',$_POST['password']) ){
             $password  = $_POST['password'];
          }
          elseif(empty($_POST['password'])){
            $errorPass = "Password is required!<br>";
          }
          elseif(strlen($_POST['password'])<8){
            $errorPassL = "Password must be more than 6 letters.";
          }
          elseif(preg_match('/(?=.*\d)(?=.*[A-Z])/',$_POST['password'])){
            $errorPass1 = "Must contain atleast one small letter.";
          }
          elseif(preg_match('/(?=.*\d)(?=.*[a-z])/',$_POST['password'])){
            $errorPass2 = "Must contain atleast one capital letter.";
          }
          elseif(preg_match('/(?=.*[a-z])(?=.*[A-Z])/',$_POST['password'])){
            $errorPass3 = "Must contain atleast one number";
          }
          elseif(preg_match('/(?=.*\d)/',$_POST['password'])){
            $errorPass4 = "Must contain atleast one small letter and one capital letter.";
          }
          elseif(preg_match('/(?=.*[A-Z])/',$_POST['password'])){
            $errorPass5 = "Must contain atleast one small letter and a number.";
          }
          elseif(preg_match('/(?=.*[a-z])/',$_POST['password'])){
            $errorPass6 = "Must contain atleast one capital letter and a number.";
          }
          elseif(!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/',$_POST['password'])){
            $errorPass7 = "Must contain atleast one capital letter, small letter and a number";
          }

        //  confirm password validation
        if(!empty($_POST['confirmPassword']) && $_POST['confirmPassword']== $_POST['password']){
            $confirmPassword = sha1($_POST['confirmPassword']);
           
        }
        elseif(empty($_POST['confirmPassword']) ){
          $confError1 = "Password confirmation is required";
        }
        else{
            $confError = "Must be identical to password";
        }
        if(!isset($_POST['consent'])){
          $consentError = "Must agree to the terms and conditions";
        }
        elseif(isset($_POST['consent'])){
          $consent = $_POST['consent'];
        }
        if(isset($arr)){
             
             $my_product = array_column($arr, 'EMAIL');
      if($row = in_array($_POST['email'], $my_product)){
         echo "<script>alert('Email already exist')</script>";
       }

 //        }
        else{

           
 $arr = array("EMAIL" => $_POST['email']);
       if(empty($bigError) && empty($nameError) && empty($emailReqError)&& empty($emailError) && empty($panError) && empty($panReqError) && empty($contactError1) && empty($contactError) && empty($addrError1)&& empty($addrError)&& empty($shopError1)&& empty($shopError)&& empty($shopReqError)&& empty($errorPass)&& empty($errorPassL)&& empty($errorPass1)&& empty($errorPass7)&& empty($errorPass2)&& empty($errorPass3)&& empty($errorPass4)&& empty($errorPass5)&& empty($errorPass6)&& empty($confError1)&& empty($confError)&& empty($consentError)){
            $stid = oci_parse($conn, "INSERT INTO Trader(traderName, PANNumber, email, confirmPassword, address, contact) VALUES(:traderName,:PANNumber, :email, :confirmPassword, :address, :contact)");
            oci_bind_by_name($stid,":traderName",$traderName);
            oci_bind_by_name($stid,":email", $_SESSION['email']);
            oci_bind_by_name($stid, ":PANNumber", $PANNumber);
            oci_bind_by_name($stid, ":contact", $contact);
            oci_bind_by_name($stid, ":address", $addres);
            oci_bind_by_name($stid, ":confirmPassword", $confirmPassword);
           // } 
            $MAIL = $_SESSION['email'];
              if(oci_execute($stid)){
               $to = "cleckart.info@gmail.com";
               $subject = "New Trader Request";

              $message = "Trader request alert!!. Check the database with the following informations. Name:".$traderName."<html>
                <head>
                <title>Verify</title>
                </head>
                <body>
                <p>Verify the user?</p>
                <table>
                <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Veirfy</th>
                </tr>
                <tr>
                <td>".$traderName."</td>
                <td>".$_SESSION['email']."</td>
                 <td>".$address."</td>
                <td><a href='http://localhost/Cleckart/WEBSITE/reg/verify.php?email2=$MAIL'>Verify</a></td>

                </tr>
                </table>
                </body>
                </html>";
                 session_write_close ();
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

              // More headers
              $headers .= 'From: <cleckart.info@gmail.com>' . "\r\n";
              // $headers .= 'Cc: neavan84@gmail.com' . "\r\n";

              if(mail($to,$subject,$message,$headers))
              {
                  // echo"Trader request sent to cleckasrt you will be informed soon, Thank you!";
                header("location:emailSent.html");

              }

              else{
                  echo "Unable to send email";
              }
            }
            else{
              echo"something went wrong!";
            }
            $stid4 = oci_parse($conn, "SELECT TRADERID from TRADER where EMAIL = '". $_SESSION['email'] ."'");
            if(oci_execute($stid4)){
            while($row = oci_fetch_assoc($stid4))
            {
              $myid = $row['TRADERID'];
              if(isset($_POST['shopType']) && !empty($_POST['shopType2'])){
                     $stid2 = oci_parse($conn, "INSERT INTO SHOP (ShopRef, ShopName, TRADERID) VALUES (1, :shopType, :trid1)");
                      $stid3 = oci_parse($conn, "INSERT INTO SHOP (ShopRef, ShopName, TRADERID) VALUES (2, :shopType2, :trid2)");
                    oci_bind_by_name($stid2,":trid1",$myid);
                    oci_bind_by_name($stid2, ":shopType", $shopType);
                    oci_bind_by_name($stid3,":trid2",$myid);
                    oci_bind_by_name($stid3, ":shopType2", $shopType2);
                  if(oci_execute($stid2)){
                  echo".";
                 }
                 else{
                  echo ".";
                 }
                  
                 if(oci_execute($stid3)){
                  echo".";
                 }
                 else{
                  echo ".";
                 }
            }
                
          elseif(isset($_POST['shopType']) && empty($_POST['shopType2'])){
            $stid2 = oci_parse($conn, "INSERT INTO SHOP (ShopRef, ShopName, TRADERID) VALUES (1, :shopType, :trid1)");
            oci_bind_by_name($stid2,":trid1",$myid);
            oci_bind_by_name($stid2, ":shopType", $shopType);
             if(oci_execute($stid2)){
                  echo"Shop1 inserted!";
                 }
                 else{
                  echo "error1";
                 }
          }
          else{
            echo"No shop inserted!";
          }
        }}
}}
        }
      
     }
    
 }



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>REGISTER</title>
    <link rel="stylesheet" href="headFoot.css" />
    <link rel="stylesheet" href="register.css" />
    <link rel="stylesheet" href="wishlist.css" />
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
         <a href="#">Sign Up</a>
        <a href="http://localhost/Cleckart/WEBSITE/login.php">Login</a>
            <a href="http://localhost/Cleckart/WEBSITE/contact.php">Contact Us</a>
         <a href="http://localhost/Cleckart/WEBSITE/customerprofile.php">Profile</a>

      </div>
      <label for="nav-toggle" class="nav-toggle-lable">
        <img src="image/menu.png" height="20px" width="20px">
      </label>
      <div id="logo">
        <a href="home.html"><img src="image/Logo.png" height="120px" width="170px" /></a>
      </div>
      <div class="search">
                 <form id="tfnewsearch" method="post" action="../cart.php">
          <input
            type="text"
            class="tftextinput"
            placeholder="Search in ClecKart..."
            name="q"
            size="21"
            maxlength="120"
          /><button type = "submit" class="tfbutton"  name = "Search">Search</button>
        </form>
      </div>
      <div class="links">
        <button type="submit"><a href ="http://localhost/Cleckart/WEBSITE/login.php">LogIn</a></button>
       <!--  <button type="" submit>Sign Up</button> -->
        <a ><i id="user-btn" class="far fa-user-circle fa-xs"></i></a>
        <a href="#" ><i class="fas fa-shopping-cart"></i></a>
        <a href="#"><i class="far fa-heart"></i></a>

      <?php if(isset($_SESSION['user'])){
        echo '<div class="modal-box">';
         
            echo "<img width=70px height=70px src=".$_SESSION['img'].">"."<br>";
            echo $_SESSION['name']."<br>"; 
            echo $_SESSION['email']; 
          
           echo '<div class="modal-button">
            <button class="edit-button"><a href="Logout.php">Logout</a></button>
            <button class="edit-button"><a href="http://localhost/Cleckart/WEBSITE/customerprofile.php">Edit Profile</a></button>';
             }
             // else{
             //  header("location:login.php");
             // }
             echo ' </div>';
      ?>
        
        </div>
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

    <!-- registration start -->
    <div id="box">
      <div class="form-box">
        <div class="register">
          <div class="button-box">
            <div id="btn"></div>
            <button class="toggle-btn" onclick="customerRegister()" id ="cust">
              Customer
            </button>
            <button class="toggle-btn" onclick="traderRegister()" id="trad">
              Trader
            </button>
          </div>
          <div class="customer">
            <form
              action=""
              method="post"
              class="form"
              id="customer"
              
            >
              <div class="error">
                <?php if(isset($bigError)) echo $bigError; ?>
              </div>
              <input
                type="text"
                name="Name"
                id="firstName"
                placeholder="First Name"
                class="input-field"
                value="<?php if(isset($cfname)){echo $cfname;} ?>"
              />
              <input
                type="text"
                placeholder="Last Name"
                class="input-field"
                name="LastName"
                value="<?php if(isset($clname)){echo $clname;} ?>"
              />
         
              <br />
              <div class="errorhalf"><?php if(isset($nameerr)){echo $nameerr;} ?> </div>
              <div class="errorhalf"><?php if(isset($clnameerr)){echo $clnameerr;} ?></div>
              <input
                type="text"
                name="Email"
                id=""
                placeholder="Email Address"
                class="input-field full"
                value="<?php if(isset($maile)){echo $maile;} ?>"
              />
              <br />
              <div class="error"><?php if(isset($maileerr)){echo $maileerr;} ?></div>
              <input
                type="password"
                name="Password"
                id=""
                placeholder="Password"
                class="input-field"
                value="<?php if(isset($pass)){echo $pass;} ?>"
              />
              <input
                type="password"
                name="cpassword"
                id=""
                placeholder="Confirm Password"
                class="input-field"
                value="<?php if(isset($cpass)){echo $cpass;} ?>"
              />
              <br />
              <div class="errorhalf"> <?php if(isset($passerr)){echo $passerr;} ?></div>
              <div class="errorhalf"><?php if(isset( $cpasserr)){echo $cpasserr;} ?></div>
              <input
                type="text"
                name="Address"
                id=""
                placeholder="Address"
                class="input-field full"
                value="<?php if(isset($adder)){echo $adder;} ?>"
              />
              <br />
              <div class="error"> <?php if(isset($addererr)){echo $addererr;} ?></div>
              <input
                type="text"
                name="Contact"
                id=""
                placeholder="Contact"
                class="input-field"
                value="<?php if(isset($cont)){echo $cont;}  ?>"
              />

              <label class="gender">Gender</label>
              <select for="Gender" class="gender1" name = "Gender">
                <option disabled selected hidden>Select</option>
                <option value="Male" id="Gender" >Male</option>
                <option value="Female"  id="Gender">Female</option>
                <option value="Other"  id="Gender">Other</option>
              </select>

            <br>
              <div class="errorhalf"> <?php if(isset($conterr)){echo $conterr;} ?></div>
              <div class="errorhalf"> <?php if(isset($genderr)){echo $genderr;} ?></div>
            
   
                <label class= "dob">DOB</label>
                <input
                  type="date"
                  name="DOB"
                  id=""

                  class="input-field"
                  value="<?php echo $dob;?>"
                />
                
                <div class="error"><?php if(isset($doberr)){echo $doberr;} ?></div>
               <br>
          
              <!-- <div class="gender">
                <label>Gender</label>
                <label>Male</label>
                <input type="radio" value="male" name="gender" class="radio" />
                <label>Female</label>
                <input
                  type="radio"
                  value="female"
                  name="gender"
                  class="radio"
                />
                <label>Other</label>
                <input type="radio" value="other" name="gender" class="radio" />
              </div> -->
             
              <p class="policy1">
              <input type="checkbox" name="check" id="" value="<?php if(isset($_POST['check']) && $_POST['check']!="") echo 'checked="checked"';?>" >
                By Creating a Customer account, I agree to ClecKart's Privacy
                Policy and Condition of Use.
              </p>
              <div class="error"> <?php if(isset($checkErr)){}  echo $checkErr;?></div>
              <div class="createacc">
                <button type="submit" class="input-field submit" name="customerSubmit">
                create account
              </button>
              </div>
              <p class="link">Already have an account?<a href="http://localhost/Cleckart/WEBSITE/login.php" target="_blank" rel="noopener noreferrer" class="loginpls">LOGIN</a>
              </p>
            </form>
          </div>
          <div class="trader">
            <!-- trader form -->
            <form action="" method="post" class="form" id="trader" >
            <div class="error"> 
              <?php 
              if(isset($bigError)){
                echo $bigError;
              }
              elseif(isset($consentError)){
                echo $consentError;
              }
                 ?>
            </div>  
            <input
                type="text"
                name="traderName"
                id="traderName"
                placeholder="Trader Name"
                class="input-field full"
                value = "<?php if(isset($_POST['traderName'])) echo $_POST['traderName']; ?>"
              />

              <br />
              <div class="error">
                <?php 
                if(isset($nameError)) 
                  echo $nameError; 
                ?></div>
              <input
                type="text"
                name="PANNumber"
                id="PANNumber"
                placeholder="PAN Number"
                class="input-field full"
                maxlength = "10"
                value = "<?php if(isset($_POST['PANNumber'])) echo $_POST['PANNumber']; ?>"
              />
              <div class="error">
              <?php
              if(isset($panError)){ 
                echo $panError;
              }
              elseif(isset($panReqError)){
                echo $panReqError;
              }
              ?>
              </div>
              <input
                type="text"
                name="email"
                id=""
                placeholder="Email Address"
                class="input-field full"
                value = "<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"
              />
              <br />
              <div class="error"> 
              <?php
              if(isset($emailError)){
                echo $emailError;
              }
              elseif(isset($emailReqError)){
                echo $emailReqError;
              }
              ?></div>
              <input
                type="password"
                name="password"
                id="password"
                placeholder="Password"
                class="input-field"
                value = "<?php if(isset($_POST['password'])) echo $_POST['password']; ?>"
              />
              <input
                type="password"
                name="confirmPassword"
                id="confirmPassword"
                placeholder="Confirm Password"
                class="input-field"
                value = "<?php if(isset($_POST['confirmPassword'])) echo $_POST['confirmPassword']; ?>"
              />
              <br />
              <div class="errorhalf">
              <?php 
              if(isset($errorPass)){
                echo $errorPass;
              }
              elseif(isset($errorPassL)){
                echo $errorPassL;
              }
              elseif(isset($errorPass1)){
                echo $$errorPass1;
              }
              elseif(isset($errorPass2)){
                echo $errorPass2;
              }
              elseif(isset($errorPass3)){
                echo $errorPass3;
              }
              elseif(isset($errorPass4)){
                echo $errorPass4;
              }
              elseif(isset($errorPass5)){
                echo $errorPass5;
              }
              elseif(isset($errorPass6)){
                echo $errorPass6;
              }
              elseif(isset($errorPass7)){
                echo $errorPass7;
              }
              ?></div>
              <div class="errorhalf">
              <?php 
              if(isset($confError)){
                echo $confError;
              }
              elseif(isset($confError1)){
                echo $confError1;
              }

              ?></div>
              <input
                type="text"
                name="address"
                id="address"
                placeholder="Address"
                class="input-field full"
                value = "<?php if(isset($_POST['address'])) echo $_POST['address']; ?>"
              />
              <br />
              <div class="error">
                <?php
                  if(isset($addrError)){
                    echo $addrError;
                  }
                  elseif(isset($addrError1)){
                    echo $addrError1;
                  }
                ?>
              </div>
              <input
                type="text"
                name="contact"
                id="contact"
                placeholder="Contact"
                class="input-field"
                value = "<?php if(isset($_POST['contact'])) echo $_POST['contact']; ?>"
              /><br><br>
              <input
                type="text"
                name="shopType"
                id="shopType"
                placeholder="Shop Type1"
                class="input-field"
                value = "<?php if(isset($_POST['shopType'])) echo $_POST[
                'shopType']; ?>"
              />
              <input
                type="text"
                name="shopType2"
                id="shopType2"
                placeholder="Shop Type2"
                class="input-field"
                value = "<?php if(isset($_POST['shopType2'])) echo $_POST['shopType2']; ?>"
              />
              

            

              <br />
              <div class="errorhalf">
                <?php
                if(isset($contactError)){
                  echo $contactError;
                }
                elseif(isset($contactError1)){
                  echo $contactError1;
                }
                elseif(isset($co)){
                  echo $co;
                }
                ?>
              </div>
              <div class="errorhalf">
              <?php
              if(isset($shopError)){
                echo $shopError;
              }
              elseif(isset($shopError1)){
                echo $shopError1;
              }
              elseif(isset($shopReqError)){
                echo $shopReqError;
              }
              ?></div>
             <br><br>
              <p class="policy1">
                CONSENT*<br />
                <input
                  type="checkbox"
                  name="consent"
                  id="consent"
                  class="check-box "
                />
                Yes, I agree to the
                <a href="http://" class="loginpls">Terms and Conditions</a> and
                <a href="http://" class="loginpls">Privacy Policy</a> of ClecKart.
              </p>
              <div class="error"> 
              <?php 
              if(isset($consentError)){
                echo $consentError;
              }
                 ?></div>
              <button type="submit" class="input-field submit" name = "traderSubmit" onSubmit="trash()">
                create account
              </button>
              <p class="link">
                Already have an account?
                <a href="http://localhost/Cleckart/WEBSITE/login.php" target="_blank" rel="noopener noreferrer" class="loginpls">LOGIN</a>
        </p>
            </form>
          </div>
        </div>

        <div class="image">
          <img src="image/Logo.png" alt="" />
        </div>
      </div>
    </div>

    <!-- registration end -->

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
              ><i class="far fa-envelope"></i>cleckart.info@gmail.com</a
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

    <script>
      var x = document.getElementById("customer");
      var y = document.getElementById("trader");
      var z = document.getElementById("btn");
      var b;
      

      function customerRegister() {
        x.style.left = "3px";
        y.style.visibility = "hidden";
        z.style.left = 0;
        console.log("Customer");
        localStorage.setItem("toggle", "HeyCustomer");
      
      }
     function traderRegister() {
        x.style.left = "-900px";
        y.style.visibility="visible";
        y.style.left = "3px";
        z.style.left = "50%";
        console.log("trader"); 
        localStorage.setItem("toggle", "HeyTrader");
      }

       if(localStorage.getItem("toggle")==="HeyTrader"){
         traderRegister();
       }
       else{
         customerRegister();
       }
     
    </script>

  </body>
</body>
</html>
