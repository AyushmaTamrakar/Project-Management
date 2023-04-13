<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="home.css" />
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
  <body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://kit.fontawesome.com/4d1c2a430c.js" crossorigin="anonymous"></script>
     <!-- header start -->
    <header class="header">
      <input type="checkbox" id="nav-toggle"class="nav-toggle">
      <div class="side">
        <a href="#">Home</a>
        <a href="http://localhost/Cleckart/WEBSITE/aboutus.php">About Us</a>
        <a href="http://localhost/Cleckart/WEBSITE/cart.php">Cart</a>
        <a href="http://localhost/Cleckart/WEBSITE/cart.php">Wishlist</a>
        <a href="http://localhost/Cleckart/WEBSITE/cart.php">Products</a>
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
         <form id="tfnewsearch" method="post" action="cart.php">
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
        <button type="" submit><a href="reg/headFoot.php">Sign Up</a></button>
       <!--   <button type="" submit>Sign Up</button> -->
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

    <!--------- END HEADER ----------------->
    

    <!------------------------------------------ END CART --------------------------------------->
      
    <!------------------------- SLIDER --------------------->
    <div class="slider">
      <div class="slide active">
        <img src="image/s1.png" alt="" />
        <div class="info">
          <h2>CLECKART</h2>
          <p>
            Mouthful Of Goodness
          </p>
        </div>
      </div>
      <div class="slide">
        <img src="image/s8.png" alt="" />
        <div class="info">
          <h2>CLECKART</h2>
          <p>
            Mouthful Of Goodness
          </p>
        </div>
      </div>
      <div class="slide">
        <img src="image/s7.jpg" alt="" />
        <div class="info">
          <h2>CLECKART</h2>
          <p>
            Mouthful Of Goodness
          </p>
        </div>
      </div>
      <div class="slide">
        <img src="image/s5.jpg" alt="" />
        <div class="info">
          <h2>CLECKART</h2>
          <p>
            Mouthful Of Goodness
          </p>
        </div>
      </div>
      <div class="slide">
        <img src="image/s4.jpg" alt="" />
        <div class="info">
          <h2>CLECKART</h2>
          <p>
            Mouthful Of Goodness
          </p>
        </div>
      </div>
      <div class="navigation">
        <i class="fas fa-chevron-left prev-btn"></i>
        <i class="fas fa-chevron-right next-btn"></i>
      </div>
      <div class="navigation-visibility">
        <div class="slide-icon active"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
      </div>
    </div>

    <!--------------------------------- SLIDER END -------------------------------------->
      <h1 class="title">Top Products</h1>

     <section class="product23">
<!--   <h2 class="product-category">Featured Products</h2> -->
  <button class="pre-btn"><img class="button1" src="arrow.png"  alt=""></button>
  <button class="nxt-btn"><img class="button2" src="arrow.png" alt=""></button>
  <div class="product-container">
<?php
 include"connect.php";
         $query2 = "select p.proid, p.name, p.image, p.price, avg(s.rateindex) from product p, stars s where p.proid = s.proid and (s.rateindex) > 4  group by p.name,p.image, p.price, p.proid";
              $stid2=oci_parse($conn, $query2);
              oci_execute($stid2);
              while($row2 = oci_fetch_assoc($stid2)){
                $id = $row2['PROID'];
    echo '<div class="product-card">';
    echo '<div class="product-image">';
    echo'<a href="http://localhost/Cleckart/WEBSITE/cart.php"><img src="'.$row2['IMAGE'].'" class="product-thumb" alt=""></a>';
      echo'</div>';
      echo'<div class = "product-info">';
       for($i = 1 ; $i<=5 ; $i++){
              echo'<i class="fa-solid fa-star"></i>';
            }
        echo'<h2 class="product-brand">'.$row2['NAME'].'</h2>';
        echo'<span class="price">£'.$row2['PRICE'].'</span>';
        $query3 = "select AVG(rateindex) from stars where proid = $id ";
            $result3 = oci_parse($conn, $query3);
            oci_execute($result3);
            $row3=oci_fetch_assoc($result3);
           
          
         
           echo ' <div class="ratings">';
  
          foreach($row3 as $key => $value){

            echo 'Rating:'.number_format($row3[$key],1);
           
            echo'</div>';
          }
          echo'</div>';
       echo'</div>';
       }
          
        

  

  
  ?>
    
  </div>
</section>


    <!-- Top Selling Products-->
    <!-- <div class="mid">
      <h1 class="best">Our Best Selling Products</h1>
      <div class="mid-color">
        <div class="mid-section">
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          <div class="rating">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
          </div>
          </div>

          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          <div class="rating">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
          </div>
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          <div class="rating">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
          </div>
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          <div class="rating">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
            <img src="image/star.png">
          </div>
          </div>

        </div>
      </div>
      
    </div> -->
    <!-- End Top Sellong Products-->


    
    <!-- Shops -->
    <div class="mid">
      <h1 class="title">Top Sellers</h1>
      <div class="mid-color1">
        <div class="owl-carousel owl-theme">
          <a href="butcher.html" target="_blank">
            <div class="item" id="s1">
              <img src="Logos/1.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">COPLANET</h2>
            </div>
          </a>
          <a href="fishmonger.html" target="_blank">
            <div class="item" id="s2">
              <img src="Logos/2.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">JONES BAKERY</h2>
            </div>
          </a>
          <a href="greengrocer.html" target="_blank">
            <div class="item" id="s3">
              <img src="Logos/3.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">BRANDON FARM</h2>
            </div>
          </a>
          <a href="bakery.html" target="_blank">
            <div class="item" id="s4">
              <img src="Logos/4.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">BUTCHERY -Fresh Meat</h2>
            </div>
          </a>
          <a href="deli.html" target="_blank">
            <div class="item" id="s5">
              <img src="Logos/5.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">Delicious Green</h2>
            </div>
        </a>
        <a href="butcher.html" target="_blank">
            <div class="item" id="s1">
              <img src="Logos/6.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">Fresh Picked Garden</h2>
            </div>
          </a>
          <a href="fishmonger.html" target="_blank">
            <div class="item" id="s2">
              <img src="Logos/7.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">FISHRED</h2>
            </div>
          </a>
          <a href="greengrocer.html" target="_blank">
            <div class="item" id="s3">
              <img src="Logos/8.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">BAGAN SIAPI</h2>
            </div>
          </a>
          <a href="deli.html" target="_blank">
            <div class="item" id="s5">
              <img src="Logos/9.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">THE DELI SHOP</h2>
            </div>
        </a>
          
          <a href="deli.html" target="_blank">
            <div class="item" id="s5">
              <img src="Logos/10.png" alt="image" class="mid-img-shop">
              <h2 class="mid-info">BONE & SHANK</h2>
            </div>
        </a>
        </div>
      </div>
      
    </div>
    <!--------------------------------- End Shops ------------------------------->


    <!--------------------------------------- Featured-------------------------------------->
    <!--div class="mid-box">
      <h1 class="pro-box">Featured Products</h1>
      <div class="mid-color">
        <div class="section-box">
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
      
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
          
          </div>
          <div class="product">
            <img src="Logos/product-01.png" alt="image" class="mid-img">
          <h2 class="mid-info">Product Name</h2>
        
          </div>
        </div>
      </div>
      
    </div-->
    <!------------------------------------------- FEATURED--------------------------------->



    <!---------------------------- IMAGE GRID ------------------------------->
    <!--div class="container-grid">
      <div class="grid">
        <img src="image/grid-01.png" width="100%">
      </div>
    </div-->

    <!---------------------------- END IMAGE GRID ------------------------------>

    <!-- Shops -->

  <!--   <div class="mid"> -->
      <h1 class="title">Featured Products</h1>
     <section class="product23">
<!--   <h2 class="product-category">Featured Products</h2> -->
  <button class="pre-btn"><img class="button1" src="arrow.png"  alt=""></button>
  <button class="nxt-btn"><img class="button2" src="arrow.png" alt=""></button>
  <div class="product-container">
<?php
 include"connect.php";
         $query = "SELECT NAME, PRICE, PROID, IMAGE FROM PRODUCT WHERE STATUS='Available'";
              $stid=oci_parse($conn, $query);
              oci_execute($stid);
              while($row = oci_fetch_assoc($stid)){
    echo '<div class="product-card">';
    echo '<div class="product-image">';
  
    echo'<a href="http://localhost/Cleckart/WEBSITE/cart.php"><img src="'.$row['IMAGE'].'" width="200px"
  height="400px" class="product-thumb" alt=""></a>';
      echo'</div>';
      echo'<div class = "product-info">';
        echo'<h2 class="product-brand">'.$row['NAME'].'</h2>';
        echo'<span class="price">£'.$row['PRICE'].'</span>';
        
      echo'</div>';
    echo'</div>';
  }
  ?>
    
  </div>
</section>
 <!--    </div> -->
    <!--------------------------------- End Shops ------------------------------->





    <!---------------------------------- LOG0 --------------------------------------->
    <div class="shop-logos">
      <div class="partner">
          <h2>Our Shopping Partners</h2>
        </div>
        <div class="partner-img">
          <img src="Logos/1.png">
          <img src="Logos/3.png">
          <img src="Logos/2.png">
          <img src="Logos/4.png">
          <img src="Logos/5.png">
          <img src="Logos/6.png">
          <img src="Logos/10.png">
          <img src="Logos/8.png">
          <img src="Logos/9.png">
          <img src="Logos/7.png">
        </div>
      
    </div>


    <!------------------------- SLIDER 2 --------------------->
    <div class="text-slider">
            <div class="text">
                <span>Happy Shopping!&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shop only the best at ClecKart&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 Bringing you best deals with goods straight from the goodness of Earth&nbsp;&nbsp<img src="image/plant.png" width="40px" height="40px">&nbsp;&nbsp;&nbsp;</span>

            </div>
    </div>
    
    <!--------------------------------- SLIDER END -------------------------------------->



    <!------------------------------------ FOOTER -------------------------------->
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
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    responsive:{
        0:{
            items:2
        },
        440:{
            items:3
        },
        800:{
            items:4
        },
        1500:{
            items:5
        }

    }
})









</script>
  </body>
</html>