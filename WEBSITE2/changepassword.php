<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}
include_once("connect.php");

// click on the save button
if (isset($_POST['passwordChange'])){
 $word = sha1($_POST['oldp']);
if(empty($_POST['oldp']) && empty($POST['cpass']) && empty($_POST['newp'])){
    $bigerror="*Please fill all the  passwords fields to change the password!";
}
else{
    $query = "SELECT CONFIRMPASSWORD FROM TRADER WHERE EMAIL= '". $_SESSION['user']."'";
    $stid = oci_parse($conn, $query);
    if(oci_execute($stid)){
        while($row=oci_fetch_assoc($stid)){
            $_SESSION['pass'] = $row['CONFIRMPASSWORD'];
            $pass =  $_SESSION['pass'];
            if($pass != $word){
                $error1 = "Current Password Does not match!";
            }
            else{
                if(empty($_POST['newp'])){
                     $error2 = "Please set a new password!";
                }
                else{
                   if(!preg_match('@[A-Z]@', $_POST['newp']) || !preg_match('@[a-z]@', $_POST['newp']) || !preg_match('@[0-9]@', $_POST['newp']) || !preg_match('@[^\w]@',  $_POST['newp']) || strlen( $_POST['newp']) < 6){
                    $error3 = "one Uppercase,one Lowercase, one Number, one SpecialChar and length >6 needed!";
                   }
                   
            }
            }
            if(!isset($_POST['conp'])){
                $error4 = "Please confirm your password";
            }
            elseif(isset($_POST['conp']) && $_POST['conp'] != $_POST['newp']){
                $error5 = "New password doesnot match with";
            }
            elseif(isset($_POST['conp']) && $_POST['conp'] == $_POST['newp']){
                  $pass1 = sha1($_POST['conp']);
                $que = "UPDATE TRADER SET CONFIRMPASSWORD ='$pass1' WHERE EMAIL = '". $_SESSION['user']."'";
                $stid10 = oci_parse($conn, $que);
                if(oci_execute($stid10)){
                        $answer =  "Password has been updated!";
                }
            }

        
    }
    }

}
}









?>














































<html>
<head>
    <meta charset="UTF-8">
    <title>Trader Password Change</title>
    <link rel="stylesheet" type="text/css" href="changepassword.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400&family=Orelega+One&family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="form">
       
        <div class="insert">
            <div class="Logo">
                <img src="ClecKart Logo.png">
            </div>
            <form method="POST" action=" " enctype="multipart/form-data">
                    <fieldset>
                        <legend>Edit Your Password</legend>
                         <div class="error">
                            <?php if(isset($bigerror)) echo $bigerror; ?>
                          </div>
                           <div class="error">
                            <?php if(isset($error1)) echo $error1; ?>
                          </div>
                           <div class="error">
                            <?php if(isset($error2)) echo $error2; ?>
                          </div>
                          <div class="error">
                            <?php if(isset($error3)) echo $error3; ?>
                          </div>
                           <div class="error">
                            <?php if(isset($error4)) echo $error4; ?>
                          </div>
                        <div class="error">
                            <?php if(isset($error5)) echo $error5; ?>
                          </div> 
                           <div class="done">
                            <?php if(isset($answer)) echo $answer; ?>
                          </div> 
                    
                        <label for="old_password">Current Password:</label><br>
                        <input type="password" name="oldp" ><br><br>
                         <label for="new_password">New Password:</label><br>
                        <input type="password" name="newp"><br><br>
                         <label for="confirm_password">Confirm Password:</label><br>
                        <input type="password" name="conp"><br><br>
                            <button type="submit" method="post" name="passwordChange" class="button" >Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                             
                           <button type="" method="" name="" class="button"><a href="traderprofile.php">Go Back</a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <button type="button" method="" class="button"><a href="logout.php">Logout</a></button>
                        </div>
                    </fieldset>
            </form>
        </div>
    </div>
</div>

</body>
</html>

