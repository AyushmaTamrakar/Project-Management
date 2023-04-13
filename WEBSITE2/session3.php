<?php
    include "connect.php";
    if(isset($_SESSION['user'])){
        echo "Welcome ".$_SESSION['user'];
        echo '<br/>';
    }
    else{
        include "login.php";
        echo $_SESSION['error'];
    }
?>