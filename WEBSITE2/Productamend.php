 <?php
 session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}
 include "connect.php";
      
        $PID = $_GET['id'];
        
        // include "connect.php";
        $query = "SELECT * FROM PRODUCT WHERE PROID=$PID";
       $stid = oci_parse($conn,$query);
       oci_execute($stid);

    ?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Trader Profile</title>
    <link rel="stylesheet" type="text/css" href="try.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400&family=Orelega+One&family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
   
<div class="container">
    <div class="form">
      
        <div class="insert">
            <form method="POST" action="Productupdate.php" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Update Product Details</legend>
                        <input type="hidden" name="id" value="<?php  echo $PID?>"><br><br>
                        <?php while($row=oci_fetch_assoc($stid)){?>
                          <input type="hidden" name="old_image" value="<?php echo "<td data-label=Image>"."<img width=200px height=200px src=".$row['IMAGE'].">"."</td>";?>"><br><br>
                         <label for="name">Name:</label><br>
                        
                        <input type="text" name="name" value="<?php  echo $row['NAME']?>"><br><br>
                        <label for="imagename">Image FileName:</label><br>
                         <?php echo "<td data-label=Image>"."<img width=100px height=100px src=".$row['IMAGE'].">"."</td>";?>
                        <input type="file"  name="file" ><br><br>
                       <!--  <input type="hidden" name="shop" value="<?php  
                        echo $row['SHOP']?>" ><br><br> -->
                         <label for="product">Product Type:</label><br>
                        <input type="text"  value="<?php  echo $row['PROTYPE']?>" name="category" ><br><br>
                         <label for="price">Price:</label><br>
                        <input type="text" name="price"style="width: 25%; min-width: 80px; "  value="<?php  echo $row['PRICE']?>" ><br><br>
                         <label for="name">Stock:</label><br>
                        <input type="text" name="stock" style="width: 25%; min-width: 80px; "  value="<?php  echo $row['STOCK']?>"><br><br>
                        <label for="name">Description:</label><br>
                         <textarea name="description" style="width: 80%; min-width: 80px;height: 10%; "><?php   echo $row['DESCRIPTION']?></textarea><br><br>
                          <label for="name">Allergy Info:</label><br>
                        <textarea name="allergy" style="width: 80%; min-width: 80px; height: 10%; "><?php echo $row['ALLERGY_INFO']?></textarea><br><br>
                    <?php }?>
                        <div class="box-button">
                            <button type="submit" method="post" name="uploadfilesubs" class="button">Update Product</button>
                          
                        </div>
                    </fieldset>
            </form>
        </div>
    </div>
    </div>
</body>
</html>