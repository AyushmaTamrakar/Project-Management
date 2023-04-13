<?php
session_start();

include_once("connect.php");

// click on the save button
if (isset($_POST['passwordChange'])){
 
if(empty($_POST['oldp']) && empty($POST['conp']) && empty($_POST['newp'])){
    $bigerror="*Please fill all the  passwords fields to change the password!";
}
else{
    $username = $_POST['oldp'];
    $newp = $_POST['newp'];
    $cpass = $_POST['conp'];

    if($cpass != $newp){
        $error = "Password does not match";
    }
    else if(!preg_match('@[A-Z]@', $_POST['newp']) || !preg_match('@[a-z]@', $_POST['newp']) || !preg_match('@[0-9]@', $_POST['newp']) || !preg_match('@[^\w]@',  $_POST['newp']) || strlen( $_POST['newp']) < 6)
    {
       $error3 = "one Uppercase,one Lowercase, one Number, one SpecialChar and length >6 needed!";
    }
    else if(empty ($error) && empty($error3)){
        $query = "UPDATE CUSTOMER SET PASSWORD = '$cpass' WHERE EMAIL = '$username'";
        $result = oci_parse($conn, $query);
        if(oci_execute($result)){
            // echo "Updated successfully";
            $to = $username;
            $subject = "PAssword Updated";

            $message = "Dear valued customer this is to inform you that your password has been updated to ".$cpass;

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <cleckart.info@gmail.com>' . "\r\n";
            // $headers .= 'Cc: neavan84@gmail.com' . "\r\n";

            if(mail($to,$subject,$message,$headers))
            {
                echo"<script>alert('Password Updated successfully you have reveived an email.')</script>";

            }

            else{
                echo "Unable to send email";
            }
        }
        else{
            echo "NOOOOOOOOOO";
        }

    }
    
    }

}








?>














































<html>
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
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
                        <legend>Change Password.</legend>
                         <div class="error">
                            <?php if(isset($bigerror)) echo $bigerror; ?>
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
                    
                        <label for="old_password">Username/Email:</label><br>
                        <input type="text" name="oldp" ><br><br>
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

