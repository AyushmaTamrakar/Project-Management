<?php 
  include_once('connect.php');

  session_start();

  // session_destroy();
  if(isset($_POST['cart'])){
   if(isset($_SESSION['user'])){
    if(isset($_SESSION['cartAdd'])){
      
      
      $my_products = array_column($_SESSION['cartAdd'], 'productId');
      if($row = in_array($_POST['cart'], $my_products)){
       foreach($_SESSION['cartAdd'] as $key => $value){
         if($value['productId'] === $_POST['cart']){
           $value['Quantity'] += 1;
           $_SESSION['cartAdd'][$key] = $value;
         }
       }
        
      }
      else{
        $count = count($_SESSION['cartAdd']);
        if($count < 20){
         $_SESSION['cartAdd'][$count]= array(
      
        'productId'=> $_POST['cart'],
        'productName' => $_POST['prodName'],
        'productImage' => $_POST['prodImage'],
        'productPrice' => $_POST['prodPrice'],
        'Quantity' => 1
       );
       }
       else{
        echo "<script>alert('Cart out of limit')</script>";
       }
      }      
    }
    else{
      $_SESSION['cartAdd'][0] = array(
        'productId'=> $_POST['cart'],
        'productName' => $_POST['prodName'],
        'productImage' => $_POST['prodImage'],
        'productPrice' => $_POST['prodPrice'],
        'Quantity' => 1
      );
      

    }
    
  }
  }
  if(isset($_POST['remove'])){
    foreach($_SESSION['cartAdd'] as $key => $value){
      if($value['productId']==$_POST['proID']){
        unset($_SESSION['cartAdd'][$key]);
        $_SESSION['cartAdd']= array_values($_SESSION['cartAdd']);
      }
    }
  }

  if(isset($_POST['wish'])){
    if(isset($_SESSION['wishAdd'])){
      $my_products = array_column($_SESSION['wishAdd'], 'productId');
      if(in_array($_POST['wish'], $my_products)){
        echo "<script>alert('Already Added');</script>";
      }
      else{
        $count = count($_SESSION['wishAdd']);
         $_SESSION['wishAdd'][$count]= array(
        'productId' => $_POST['wish'],
        'productName' => $_POST['prodName'],
        'productImage' => $_POST['prodImage'],
        'productPrice' => $_POST['prodPrice']
       );
      }
      
      
    }
    else{
      $_SESSION['wishAdd'][0] = array(
        'productId' => $_POST['wish'],
        'productName' => $_POST['prodName'],
        'productImage' => $_POST['prodImage'],
        'productPrice' => $_POST['prodPrice']
      );
      

    }
  }
  if(isset($_POST['bin'])){
    foreach($_SESSION['wishAdd'] as $key => $value){
      if($value['productId']==$_POST['name']){
        unset($_SESSION['wishAdd'][$key]);
        $_SESSION['wishAdd']= array_values($_SESSION['wishAdd']);
      }
    }
  }

  if(isset($_POST['pro'])){
    $id = $_POST['pro'];
    
    $query1 = "SELECT PROTYPE FROM PRODUCT WHERE PROID = $id";
    $result1  = oci_parse($conn, $query1);
    $protype;
    oci_execute($result1);
      $row = oci_fetch_assoc($result1);
       $protype = $row['PROTYPE'];

       $query = "SELECT IMAGE, NAME, PRICE,DESCRIPTION, ALLERGY_INFO FROM PRODUCT WHERE PROID = $id ";
       $result = oci_parse($conn, $query);
       oci_execute($result);
       $row = oci_fetch_assoc($result);
       $image = $row['IMAGE'];
       $name = $row['NAME'];
       $price = $row['PRICE'];
       $desc = $row['DESCRIPTION'];
       $allergy = $row['ALLERGY_INFO'];


       $query2 = "SELECT IMAGE FROM PRODUCT WHERE  PROID != $id AND PROTYPE = '$protype'";
       $result2 = oci_parse($conn, $query);
       oci_execute($result2);
       while($row = oci_fetch_assoc($result2)){
         $image1 = $row['IMAGE'];
      }
    }


      if(isset($_POST['send'])){
        if(isset($_SESSION['user'])){
          $user = $_SESSION['user'];
        $rate = $_POST['Slider'];
        $message = $_POST['message'];
        $hiddenId = $_POST['hiddenId'];
        $stid=oci_parse($conn, "INSERT INTO STARS (RATEINDEX, COMMENTS, USERNAME, PROID) VALUES(:stars, :message, :name, :ids)");
        oci_bind_by_name($stid, "stars", $rate);
        oci_bind_by_name($stid, "message", $message);
        oci_bind_by_name($stid, "ids", $hiddenId);
        oci_bind_by_name($stid, "name", $user);
        if(oci_execute($stid))
      {
        echo"<script>alert('Your  views have been  added successfully')</script>";
        
      }
      else{
        echo "Something went wrong try again!";
      }
    }
    else{
      header("location:http://localhost/Cleckart/WEBSITE/login.php");
      }
    }
      


    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRODUCT</title>
    <link rel="stylesheet" href="headFoot.css" />
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="wishlist.css">
   
    <script
      src="https://kit.fontawesome.com/6338071364.js"
      crossorigin="anonymous"
    ></script>
       
    <script src="https://kit.fontawesome.com/4d1c2a430c.js" crossorigin="anonymous"></script>
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
        <a href="#">Cart</a>
        <a href="#">Wishlist</a>
        <a href="#">Products</a>
         <a href="http://localhost/Cleckart/WEBSITE/reg/headFoot.php">Sign Up</a>
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
        <form id="tfnewsearch" method="post" action="">
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
       <button type="" submit><a href="login.php" class="log">Login</a></button>
        <button type="" submit><a href="reg/headFoot.php" class="log">Sign Up</a></button>
        <a ><i id="user-btn" class="far fa-user-circle fa-xs"></i></a>
        <a href="#" onclick="on1()"><i class="fas fa-shopping-cart"></i></a>
        <a href="#" onclick="on2()"><i class="far fa-heart"></i></a>

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

    <!--------------------------------- END HEADER ----------------------------------->



  <!-------------------------------PRODUCT PAGE  ------------------------------------------->

  <div class="product-container">
   
      <div class="filt1">
          <div class="filter">
            <form action="" method="POST" id = "filter">
                <h1>Filters</h1>
                <div class="sort1">
                  <h3>Product</h3>
                  <div class="fill">
                    <?php
                      
                      $query = "SELECT DISTINCT(PROTYPE) FROM PRODUCT WHERE STATUS ='Available' ORDER BY PROTYPE ASC ";
                      $result = oci_parse($conn, $query);
                      oci_execute($result);
      
                      while($row = oci_fetch_array($result)){
                        if($row > 0){
                           $checked = [];
                           if(isset($_POST['protype'])){
                             $checked = $_POST['protype'];
                             $check = implode($checked);
                            //  echo $checked;
                           }
                          ?>
                          <label><input type="checkbox" name="protype[]" id="CheckId1" value = "<?php echo $row['PROTYPE']; ?>" 
                          <?php if(in_array($row['PROTYPE'], $checked)){ echo "checked";} ?>
                          onchange="document.getElementById('filter').submit()"  ><?php echo " ". ucfirst($row['PROTYPE']);  ?></label> <br>
                        <?php  
                         }
                         else{
                           echo "Result not found";
                         }
                      }
                   
                      
                    ?>
                  </div>
                </div>
                <div class="sort1">
                    <h3>Shop</h3>
                    <div class="fill">
                    <?php
                      
                      $query = "SELECT DISTINCT(s.SHOPNAME) FROM SHOP s, PRODUCT p WHERE s.SHOPID = p.SHOPID and p.STATUS = 'Available'";
                      $result = oci_parse($conn, $query);
                      oci_execute($result);
      
                      while($row = oci_fetch_array($result)){
                        if($row > 0){
                           $checked = [];
                           if(isset($_POST['shoptype'])){
                             $checked = $_POST['shoptype'];
                             $check = implode($checked);
                            //  echo $checked;
                           }
                          ?>
                          <label><input type="checkbox" name="shoptype[]" id="CheckId2" value = "<?php echo $row['SHOPNAME']; ?>" 
                          <?php if(in_array($row['SHOPNAME'], $checked)){ echo "checked";} ?>
                          onchange="document.getElementById('filter').submit()" ><?php echo " ". ucfirst($row['SHOPNAME']);  ?></label> <br>
                        <?php  
                         }
                         else{
                           echo "Result not found";
                         }
                      }
                   
                      
                    ?>
                    <br>
                    
                </div>
          </div>
          </form>
          </div>
      </div>
      <div class="filt2">
          <div class="product-card">
         <div class="title"><h2>Our Products</h2></div>
         <div class="tiles">
        <?php
        if(isset($_POST['protype'])){
          $proCheck = [];
          $proCheck = $_POST['protype'];
          foreach($proCheck as $rack){
            
            $query = "SELECT IMAGE, NAME, PRICE, PROID FROM PRODUCT WHERE STATUS = 'Available' AND PROTYPE = '$rack' ";
            $result = oci_parse($conn, $query);
            oci_execute($result);
           $flag = 0;
          while($row = oci_fetch_assoc($result)){
            
          echo '<div class="card">';
            echo '<img src="'.$row['IMAGE'].'" alt="" >';
            echo '<div class="container-shade"></div>';
            echo '<div class="card_btn" id="cardB">';
            echo '<form action = "" method = "post">';
            echo '<input type = "hidden" name= "prodName" value = "'.$row['NAME'].'" >';
            echo '<input type = "hidden" name= "prodImage" value = "'.$row['IMAGE'].'"> ';
            echo '<input type = "hidden" name= "prodPrice" value = "'.$row['PRICE'].'" >';

            echo '<button type = "submit" name = "cart" value = "'.$row['PROID'].'" onclick="on1()"><i class="fas fa-shopping-cart"></i></button>';
            echo ' <button type="submit" name = "wish" value = "'.$row['PROID'].'" onclick ="on2()"><i class="far fa-heart"></i></button>';
            echo '<button type = "submit" name = "pro" value = "'.$row['PROID'].'" onclick="on()">';
            echo '<i class="fa-solid fa-ellipsis"></i></button>';
              echo '</form>';
            echo '</div>'; //card-btn ko
            echo ' <div class="price">';
            echo "<p class='prod'>".ucfirst($row['NAME'])."</p>";
            echo '<p class="pric">&#163; '.$row['PRICE'].'</p>';
            echo '</div>'; //price
            echo '</div>'; //card ko div
       //prodcard ko div
        $flag = 1;
      }
      if($flag == 0){
        echo "<h3>No results found</h3>";
      }
      
                
        }     
                
        }
    elseif(isset($_POST['shoptype'])){
          $proCheck = [];
          $proCheck = $_POST['shoptype'];
          foreach($proCheck as $rack){
            $query = "SELECT p.IMAGE, p.NAME, p.PRICE, p.PROID FROM PRODUCT p, SHOP s WHERE s.SHOPID = p.SHOPID AND p.STATUS = 'Available' AND s.SHOPNAME = '$rack'  ";
            $result = oci_parse($conn, $query);
        oci_execute($result);
       $flag = 0;
           
          while($row = oci_fetch_assoc($result)){
            
          echo '<div class="card">';
            echo '<img src="'.$row['IMAGE'].'" alt="" >';
            echo '<div class="container-shade"></div>';
            echo '<div class="card_btn" id="cardB">';
            echo '<form action = "" method = "post">';
            echo '<input type = "hidden" name= "prodName" value = "'.$row['NAME'].'" >';
            echo '<input type = "hidden" name= "prodImage" value = "'.$row['IMAGE'].'"> ';
            echo '<input type = "hidden" name= "prodPrice" value = "'.$row['PRICE'].'" >';

            echo '<button type = "submit" name = "cart" value = "'.$row['PROID'].'" onclick="on1()"><i class="fas fa-shopping-cart"></i></button>';
            echo ' <button type="submit" name = "wish" value = "'.$row['PROID'].'" onclick ="on2()"><i class="far fa-heart"></i></button>';
            echo '<button type = "submit" name = "pro" value = "'.$row['PROID'].'" onclick="on()">';
            echo '<i class="fa-solid fa-ellipsis"></i></button>';
              echo '</form>';
            echo '</div>'; //card-btn ko
            echo ' <div class="price">';
            echo "<p class='prod'>".ucfirst($row['NAME'])."</p>";
            echo '<p class="pric">&#163; '.$row['PRICE'].'</p>';
            echo '</div>'; //price
            echo '</div>'; //card ko div
       //prodcard ko div
       $flag = 1;
      }
     if($flag == 0){
      echo "<h3>No results found</h3>";
    }
      }
     
                
  }
      

      else if(isset($_POST['Search'])){
        if(!empty($_POST['q'])){
            $search = ucwords($_POST['q']);
            $query = "SELECT IMAGE, NAME, PRICE, PROID FROM PRODUCT WHERE STATUS = 'Available' AND NAME = '$search' ";
            $result = oci_parse($conn, $query);
            oci_execute($result);
          $flag = 0;
          while($row = oci_fetch_assoc($result)){
            
          echo '<div class="card">';
            echo '<img src="'.$row['IMAGE'].'" alt="" >';
            echo '<div class="container-shade"></div>';
            echo '<div class="card_btn" id="cardB">';
            echo '<form action = "" method = "post">';
            echo '<input type = "hidden" name= "prodName" value = "'.$row['NAME'].'" >';
            echo '<input type = "hidden" name= "prodImage" value = "'.$row['IMAGE'].'"> ';
            echo '<input type = "hidden" name= "prodPrice" value = "'.$row['PRICE'].'" >';

            echo '<button type = "submit" name = "cart" value = "'.$row['PROID'].'" onclick="on1()"><i class="fas fa-shopping-cart"></i></button>';
            echo ' <button type="submit" name = "wish" value = "'.$row['PROID'].'" onclick ="on2()"><i class="far fa-heart"></i></button>';
            echo '<button type = "submit" name = "pro" value = "'.$row['PROID'].'" onclick="on()">';

            echo '<i class="fa-solid fa-ellipsis"></i></button>';
              echo '</form>';
            echo '</div>'; //card-btn ko
            echo ' <div class="price">';
            echo "<p class='prod'>".ucwords($row['NAME'])."</p>";
            echo '<p class="pric">&#163; '.$row['PRICE'].'</p>';
            echo '</div>'; //price
            echo '</div>'; //card ko div
       //prodcard ko div
         $flag = 1;
      }
       if($flag == 0){
         echo "<h3>No results found</h3>";
       }

                
        }
        else{
          $query = "SELECT IMAGE, NAME, PRICE, PROID, PROTYPE FROM PRODUCT WHERE STATUS = 'Available' ORDER BY NAME ASC";
          $result = oci_parse($conn, $query);
          oci_execute($result);
          $flag = 0;
            while($row = oci_fetch_assoc($result)){
              
            echo '<div class="card">';
              echo '<img src="'.$row['IMAGE'].'" alt="" >';
              echo '<div class="container-shade"></div>';
              echo '<div class="card_btn" id="cardB">';
              echo '<form action = "" method = "post">';
              echo '<input type = "hidden" name= "prodName" value = "'.$row['NAME'].'" >';
              echo '<input type = "hidden" name= "prodImage" value = "'.$row['IMAGE'].'"> ';
              echo '<input type = "hidden" name= "prodPrice" value = "'.$row['PRICE'].'" >';
  
              echo '<button type = "submit" name = "cart" value = "'.$row['PROID'].'" onclick="on1()"><i class="fas fa-shopping-cart"></i></button>';
              echo ' <button type="submit" name = "wish" value = "'.$row['PROID'].'" onclick ="on2()"><i class="far fa-heart"></i></button>';
              echo '<button type = "submit" name = "pro" value = "'.$row['PROID'].'" onclick="on()">';
              echo '<i class="fa-solid fa-ellipsis"></i></button>';
                echo '</form>';
              echo '</div>'; //card-btn ko
              echo ' <div class="price">';
              echo "<p class='prod'>".ucwords($row['NAME'])."</p>";
              echo '<p class="pric">&#163; '.$row['PRICE'].'</p>';
                
              echo '</div>'; //price
              echo '</div>'; //card ko div
         //prodcard ko div
         $flag = 1;
        }
        if($flag == 0){
          echo "<h3>No results found</h3>";
        }
         
        }
      }
        else{

        $query = "SELECT IMAGE, NAME, PRICE, PROID, PROTYPE FROM PRODUCT WHERE STATUS = 'Available' ORDER BY NAME ASC";
        $result = oci_parse($conn, $query);
        oci_execute($result);
        $flag = 0;
          while($row = oci_fetch_assoc($result)){
            
          echo '<div class="card">';
            echo '<img src="'.$row['IMAGE'].'" alt="" >';
            echo '<div class="container-shade"></div>';
            echo '<div class="card_btn" id="cardB">';
            echo '<form action = "" method = "post">';
            echo '<input type = "hidden" name= "prodName" value = "'.$row['NAME'].'" >';
            echo '<input type = "hidden" name= "prodImage" value = "'.$row['IMAGE'].'"> ';
            echo '<input type = "hidden" name= "prodPrice" value = "'.$row['PRICE'].'" >';

            echo '<button type = "submit" name = "cart" value = "'.$row['PROID'].'" onclick="on1()"><i class="fas fa-shopping-cart"></i></button>';
            echo ' <button type="submit" name = "wish" value = "'.$row['PROID'].'" onclick ="on2()"><i class="far fa-heart"></i></button>';
            echo '<button type = "submit" name = "pro" value = "'.$row['PROID'].'" onclick="on()">';
            echo '<i class="fa-solid fa-ellipsis"></i></button>';
              echo '</form>';
            echo '</div>'; //card-btn ko
            echo ' <div class="price">';
            echo "<p class='prod'>".ucwords($row['NAME'])."</p>";
            echo '<p class="pric">&#163; '.$row['PRICE'].'</p>';
              
            echo '</div>'; //price
            echo '</div>'; //card ko div
       //prodcard ko div
       $flag = 1;
      }
      if($flag == 0){
        echo "<h3>No results found</h3>";
      }
       
      }
        ?>   
        </div>
        </div>
        
        <!-- filtw -->
      </div>
      <div id="overlay" >
      <button class = "close" onclick="off()">X</button>
     
     <div class="details">
     <div class="flex-box">
        <div class="left">
            <div class="big-img">
              <?php 
                echo '<img src="'.$image.'">';
                ?>
            </div>
            <div class="like"><h1>Rate Our Products!</h1>
            <div class="images">
            <form method="post" action= "">
              <div class="slidecontainer">
                <input type="range" min="1" max="5" value="3" class="slider" id="myRanges" name="Slider">
                <p>Rating: <span id="demo"></span></p>
              </div>
                <textarea placeholder="Comments" class="textarea" name="message"></textarea><br><br>
                <input type="hidden" value = "<?php echo $id;?>" name="hiddenId" >
              <button type="submit" name="send" class="send-rating" onclick="off()">SUBMIT</button>
              </form>
                </div>
            </div>
        </div>

        <div class="right">
            
            <div class="slogan">Mouthfull of goodness</div>
            <?php 
             if(isset($_POST['pro'])){
              $id = $_POST['pro'];
             
            $query = "select AVG(rateindex) from stars where proid = $id ";
            $result = oci_parse($conn, $query);
            oci_execute($result);
            $row=oci_fetch_assoc($result);
           
          
           echo ' <h3>'.$name.'</h3>';
           echo ' <div class="stars">';
  
          foreach($row as $key => $value){
            echo 'Rating:'.number_format($row[$key],1);
          }
          echo   '</div>';
          echo  '<div class="amount">£'.$price.'</div>';
          echo '<div class="info">';
           echo  ' <div class="box"><h3>Description:<p>'.$desc.'</p></h3></div><br>';
          echo '<div class="box"><h3>Allergy Info:<p>'.$allergy.'</p></h3></div>';
                
           echo ' </div>';}
         
            ?>
            <div class="btn-box">
              <form action="" method = "post"><?php
                echo '<input type = "hidden" name= "prodName" value = "'.$name.'" >';
                echo '<input type = "hidden" name= "prodImage" value = "'.$image.'"> ';
                echo '<input type = "hidden" name= "prodPrice" value = "'.$price.'" >';
                echo '<button class="cart-btn" type = "submit" name = "cart" value = "'.$id.'" onclick="on1()">Add to Cart</button>';
            
                echo ' <button type="submit" class="cart-btn" name = "wish" value = "'.$id.'" onclick ="on2()">Add to WishList</button>';?></form>
            </div>

            <div class="ok">
              <?php 
              if(isset($_POST['pro'])){
                $id = $_POST['pro'];
              
                $query = "SELECT RATEINDEX, COMMENTS, USERNAME FROM STARS WHERE PROID = $id";
                $result = oci_parse($conn, $query);
                oci_execute($result);
                while($row = oci_fetch_assoc($result)){
                  
                  
                  ?>
                <div class="comments-rating">
                  <div class="user-comments">
                    <div class="top-box">
                      <div class="profile">
                        <div class="name-user">
                          <strong><?php echo $row['USERNAME'];?></strong>
                          <span>Rating: <?php echo $row['RATEINDEX'] ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="comments">
                      <p><?php echo $row['COMMENTS'];?></p>
                    </div>
                  </div>
                </div>
                <?php
                }
              }
              ?>
            </div>
        </div>
    </div>
     </div>
    </div>

    <div id="overlay2">
      <button class="close" onclick="off2()">X</button>
      <div class="cart">
        <div class="list">
          <h1>My WishList</h1>
          <?php
             if(isset($_SESSION['wishAdd'])){
               foreach($_SESSION['wishAdd'] as $key => $value){  ?>
                <div class="wishBox">
                            <div class="wishProduct">
                              <div class="wishImage">
                              <img src="<?php echo $value['productImage']?>" alt="Product image">
                              </div>
                              <div class="wishDetails">
                                <h2><?php echo $value['productName']?></h2>
                                <h3>Price: £ &nbsp; <?php echo $value['productPrice'] ?> </h3>
                                <div class="wishAction">
                                  <form action="" method = "post"><?php
                                    echo '<input type = "hidden" name= "prodName" value = "'.$value['productName'].'" >';
                                    echo '<input type = "hidden" name= "prodImage" value = "'.$value['productImage'].'"> ';
                                    echo '<input type = "hidden" name= "prodPrice" value = "'.$value['productPrice'].'" >';
                                    echo '<button class="wish-btn" type = "submit" name = "cart" value = "'.$value['productId'].'" onclick="on1()">Add to Cart</button>';
                                    echo '<button type="submit" name="bin" class="bin"><img src="image/trash.png" class="delete" width="20px" height="20px"></button>';
                                    echo '<input type = "hidden" name = "name" value = "'.$value['productId'].'">';
                                    ?>
                                    
                                </form>
                                </div>
                              </div>
                            </div>
                          </div>

              <?php
               }
             }
          ?>
          
        </div>
      </div>
    </div>    


    <div id="overlay1" >
      <button class = "close" onclick="off1()">X</button>
      <div class="cart">
      <div class="list">
       
      <h1>My Cart</h1>
      <div class=" " style="width: 100%">
        <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
          <thead>
            <tr><?php  ?>
              <th class=""><h2>PRODUCT</h2></th>
              <th class=""><h2>PRODUCT NAME</h2></th>
              <th class=""><h2>QUANTITY</h2></th>
              <th class=""><h2>PRICE</h2></th>
              <th class=""><h2>TOTAL</h2></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total=0;
            $totalQuantity= 0;
            $grandTotal= 0;
            if(isset($_SESSION['cartAdd'])){
              foreach($_SESSION['cartAdd'] as $key => $value){
                $total = $total + $value['productPrice'];
                $totalQuantity += $value['Quantity'];
                $grandTotal += ($value['productPrice'] * $value['Quantity']);
                  $_SESSION['grand'] = $grandTotal;
                echo "<tr>";
                echo "<td><img src = '".$value['productImage']."' width = 100></td>";
                echo '<td>'.$value['productName'].'</td>';
                echo '<td><input class ="iquantity" type="number" name="qValue" value="'.$value['Quantity'].'" onchange="subTotal()" min="1" max="20" onclick="document.getElementById("quantt").submit()"></form></td>';
                echo '<td>';
                echo $value['productPrice'];
                echo '<input type="hidden" value="'.$value['productPrice'].'" class="iprice">';
                echo "</td>";
                echo '<td class= "itotal"></td>';
                echo '<td class= "remove">';
                echo '<form action = "" method = "post" >';
                echo '<button type="submit" name="remove" >Remove</button>';
                echo '<input type = "hidden" name = "proID" value = "'.$value['productId'].'">';
                echo '<input type = "hidden" name = "totalQuant" value = "'.$totalQuantity.'">';
                echo "</form>";
                echo "</td>";
              
                echo "</tr>";
               
              }
            }
            ?>
            <?php $_SESSION['grand'] = $grandTotal;  ?>
          </tbody>
          <tr>
            <td class="k">
              <h3 class="item-name">Grand-Total</h3>
            </td>
            <td class=""></td>
            <td class=""></td>
            <td class=""></td>
            <td class=" grand-total">
              <h3> £ &nbsp;<strong id="grandTotal">$grandTotal</strong></h3>
             
            </td>
           <td><a id="anchor" href="checkout.php">Buy Now</a></td>
          </tr>
        </table>
      </div>
    </div>

    <!------------------------------------------ END CART --------------------------------------->
      </div>
      </div>
  </div>
          
         <!--------------------------------------------------------    FOOTER --------------------------->
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
  
    <script type="text/javascript" defer>
      /******************* MODAL BOX ********************/

let userBox = document.querySelector('.modal-box');

document.querySelector('#user-btn').onclick = () =>{
  userBox.classList.toggle('active');
}

function on(){
    document.getElementById("overlay").style.display = "block";
    localStorage.setItem("over", "ON");
    // sessionStorage.setItem('clicked', true);
  }
 function off() {
  document.getElementById("overlay").style.display = "none";
  localStorage.setItem("over", "Off");
  // sessionStorage.removeItem('cliked');
}
if(localStorage.getItem("over")==="ON"){
         on();
       }
else{
      off();
     }


function on1(){
    document.getElementById("overlay1").style.display = "block";
    localStorage.setItem("cart", "ok");
  off();
  
  }
  
 function off1() {
  document.getElementById("overlay1").style.display = "none";
  localStorage.setItem("cart", "no");
}
 
       let bigImg = document.querySelector('.big-img img');
        function showImg(pic){
            bigImg.src = pic;
        }

     
       
       if(localStorage.getItem("cart")==="ok"){
         on1();
       }
       else{
         off1();
       
       }
       var grand_total = 0;
       var iprice = document.getElementsByClassName('iprice');
       var iquantity = document.getElementsByClassName('iquantity');
       var itotal = document.getElementsByClassName('itotal');
       var gtotal = document.getElementById('grandTotal');
      
       function subTotal(){
          grand_total = 0;
          for(let i=0; i < iprice.length; i++){
            itotal[i].innerText = (iprice[i].value)*(iquantity[i].value);
            grand_total = grand_total + (iprice[i].value)*(iquantity[i].value);
          }
          gtotal.innerText = grand_total;
       }

       subTotal();

       function on2(){
        document.getElementById("overlay2").style.display = "block";
        localStorage.setItem("wish", "k");
      off();
      
      }
      
     function off2() {
      document.getElementById("overlay2").style.display = "none";
      localStorage.setItem("wish", "n");
    }
    if(localStorage.getItem("wish")==="k"){
         on2();
       }
       else{
         off2();
       
       }
       var slider = document.getElementById("myRanges");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
    </script>




  </body>
</html>