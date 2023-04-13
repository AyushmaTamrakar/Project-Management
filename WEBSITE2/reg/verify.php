<?php
session_start();
include_once('connect.php');
$EMAILZ=$_GET['email2'];
	$stid = oci_parse($conn, "UPDATE TRADER set STATUS='Active' WHERE EMAIL='$EMAILZ'");
	 if(oci_execute($stid)){
               $to = $EMAILZ;
               $subject = "Congratulations!!!!";

              $message = "Congratualtions on being the trader of CleckKart. Please login now with you email and password!.<head>
                <title>Confirm</title>
                </head>
                <body>
                <p>Please donot forward this mail, keep it confidential!</p>
                <table>
                <tr>
                <th>Email To Login</th>
                <th>Login</th>
                </tr>
                <tr>
                <td>".$EMAILZ."</td>
                 <td><a href='http://localhost/Cleckart/WEBSITE/login.php'>LOGIN</a></td>
                </tr>
                </table>
                </body>
                </html>";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

              // More headers
              $headers .= 'From: <info.cleckart@gmail.com>' . "\r\n";
              // $headers .= 'Cc: neavan84@gmail.com' . "\r\n";

              if(mail($to,$subject,$message,$headers))
              {
                  header("location:traderConfirm.html");

              }

              else{
                  echo "Unable to send email";
              }
          
        }

            
            else{
              echo"something went wrong!";
            }



?>