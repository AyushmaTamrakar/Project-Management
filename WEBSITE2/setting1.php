<?php 
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}
?>





<?php

include_once('connect.php');
 


  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['uploadfilesub'])){
        
      $filename = $_FILES['image']['name'];
    
    $filetmpname= $_FILES['image']['tmp_name'];
    $folder = 'imageuploaded/'.$filename;

     move_uploaded_file($filetmpname, $folder);  

     $name = ucfirst($_POST['name']);
   
      $shop = $_POST['shop'];
       $type = ucfirst($_POST['category']);
        $price = $_POST['price'];
         $stock = $_POST['stock'];
         $description = $_POST['description'];
         $allergy = $_POST['allergy'];
         // if($_SESSION['name'] == $_SESSION['restrict2'] || $_SESSION['name']==$_SESSION['restrict3']){
         //    echo"<alert>('Product laready added')</alter>";
         // }

 
 if($_POST['shop'] == $_SESSION['shopA']){
    $query = "SELECT NAME FROM PRODUCT ";
            $result=oci_parse($conn, $query);
            oci_execute($result);
            $arr = [];
            while($row = oci_fetch_assoc($result)){
            $arr[] = $row;

            }

         if(isset($arr)){
             
             $my_product = array_column($arr, 'NAME');
      if($row = in_array($_POST['name'], $my_product)){
         echo "<script>alert('Already added')</script>";
       }

        
        else{

           


  $stid = oci_parse($conn,"INSERT INTO Product (NAME, IMAGE, PROTYPE, DESCRIPTION, ALLERGY_INFO, PRICE, STOCK, SHOPID) VALUES(:name, :image, :type, :description, :allergy, :price, :stock, :ids)");
  oci_bind_by_name($stid, ":name", $name);
  oci_bind_by_name($stid, ":image",$folder);
  oci_bind_by_name($stid, ":ids", $_SESSION['ids']);
  oci_bind_by_name($stid, ":type", $type);
  oci_bind_by_name($stid, ":description", $description);
  oci_bind_by_name($stid, ":allergy", $allergy);
  oci_bind_by_name($stid, ":price", $price);
  oci_bind_by_name($stid, ":stock", $stock);
   
  if(oci_execute($stid))
{
      $arr = array("NAME" => $_POST['name']);

  echo"<script>alert('Product added successfully')</script>";
 

}

else{
  echo "Something went wrong try again!";
}
}
}
}
elseif($_POST['shop'] == $_SESSION['shopB']){
     $query = "SELECT NAME FROM PRODUCT ";
            $result=oci_parse($conn, $query);
            oci_execute($result);
            $arr = [];
            while($row = oci_fetch_assoc($result)){
            $arr[] = $row;

            }

         if(isset($arr)){
             
             $my_product = array_column($arr, 'NAME');
      if($row = in_array($_POST['name'], $my_product)){
         echo "<script>alert('Already added')</script>";
       }

        
        else{
  $stid8 = oci_parse($conn,"INSERT INTO Product (NAME, IMAGE, PROTYPE, DESCRIPTION, ALLERGY_INFO, PRICE, STOCK, SHOPID) VALUES(:name, :image, :type, :description, :allergy, :price, :stock, :ids9)");
  oci_bind_by_name($stid8, ":name", $name);
  oci_bind_by_name($stid8, ":image",$folder);
  oci_bind_by_name($stid8, ":ids9", $_SESSION['ids9']);
  oci_bind_by_name($stid8, ":type", $type);
  oci_bind_by_name($stid8, ":description", $description);
  oci_bind_by_name($stid8, ":allergy", $allergy);
  oci_bind_by_name($stid8, ":price", $price);
  oci_bind_by_name($stid8, ":stock", $stock);
   
  if(oci_execute($stid8))
{
     
   echo"<script>alert('Product added successfully')</script>";
 

}

else{
  echo "Something went wrong try again!";
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
    <title>Trader Profile</title>
    <link rel="stylesheet" type="text/css" href="try.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400&family=Orelega+One&family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="form">
        <div class="profile">
             <?php echo "<td data-label=Image>"."<img width=80px height=250px src=".$_SESSION['img'].">"."</td>";?>
            <h4>
                <?php   
            if(isset($_SESSION['user'])){
                echo $_SESSION['user'];
                echo '<br/>';
            }
            else{
              
                echo $_SESSION['error'];
            } 
            ?>
        
    </h4><br/>
            <h2 class="button-set"><a href="traderprofile.php">Edit Profile Settings</a></h2>
        </div>
        <div class="insert">
            <form method="POST" action=" " enctype="multipart/form-data">
                    <fieldset>
                        <!--  -->
                        <legend>Enter New Product Details</legend>
                       
                        <label for="name">Name:</label><br>
                     
                        <input type="text" name="name" >  <?php $restrict =  $_SESSION['name'];?><br><br>
                        <label for="imagename">Image FileName:</label><br>
                        <input type="file"  name="image" ><br><br>
                         <label for="shop">Shop:</label><br>
                       <!--  <input type="text" name="shop" ><br><br> -->
                       <select name="shop">
                        <?php 
                        $hello = $_SESSION['user'];
                            $stid1 = "SELECT S.SHOPNAME FROM SHOP S , TRADER T WHERE T.TRADERID = S.TRADERID AND EMAIL='$hello' AND SHOPREF=1";
                            $que = oci_parse($conn, $stid1);
                            if(oci_execute($que)){
                                while($row=oci_fetch_assoc($que)){
                                    $_SESSION['shopA'] = $row['SHOPNAME'];
                                    $shopA = $_SESSION['shopA'];
                                    $stid1 = oci_parse($conn, "SELECT SHOPID FROM SHOP WHERE SHOPNAME='$shopA' ");
                                     if(oci_execute($stid1)){
                                        while($row = oci_fetch_assoc($stid1)){
                                            $_SESSION['ids'] = $row['SHOPID'];
                                            
                                        }
                                     }
                            echo"<option value='".$shopA."'>$shopA</option>";
                                }
                            }
                             $stid3 = "SELECT S.SHOPNAME FROM SHOP S , TRADER T WHERE T.TRADERID = S.TRADERID AND EMAIL='$hello' AND SHOPREF=2";
                            $que = oci_parse($conn, $stid3);
                            if(oci_execute($que)){
                                while($row2=oci_fetch_assoc($que)){
                                    $_SESSION['shopB'] = $row2['SHOPNAME'];
                                     $shopB = $_SESSION['shopB'];
                                    $stid9 = oci_parse($conn, "SELECT SHOPID FROM SHOP WHERE SHOPNAME='$shopB' ");
                                     if(oci_execute($stid9)){
                                        while($row7 = oci_fetch_assoc($stid9)){
                                            $_SESSION['ids9'] = $row7['SHOPID'];
                                            
                                        }
                                     }
                            echo"<option value='".$shopB."'>$shopB</option>";
                                }
                            }






                        ?>
                          </option>
                        </select><br><br>
                         <label for="product">Product Type:</label><br>
                        <input type="text" name="category" ><br><br>
                         <label for="price">Price:</label><br>
                        <input type="text" name="price"style="width: 25%; min-width: 80px; "  ><br><br>
                         <label for="name">Stock:</label><br>
                        <input type="text" name="stock" style="width: 25%; min-width: 80px; "><br><br>
                        <label for="name">Description:</label><br>
                        <textarea name="description" style="width: 80%; min-width: 80px;height: 10%; "></textarea><br><br>
                        <label for="name">Allergy Info:</label><br>
                        <textarea name="allergy" style="width: 80%; min-width: 80px; height: 10%; "></textarea><br><br>
                        <div class="box-button">
                            <button type="submit" method="post" name="uploadfilesub" class="button">Add Product</button>
                            <input type="reset" value="Clear" class="button">
                            <button type="submit" method="post" class="button"><a href="logout.php">Logout</a></button>
                        </div>
                    </fieldset>
            </form>
        </div>
    </div>
<!-- ********************************shop1******************** -->
    <div class="shop1">
    <?php
     
    include_once('connect.php');
    if(isset($_SESSION['shopA']) && !isset($_SESSION['shopB'])){
         echo "<h2>".$_SESSION['shopA']."</h2>";
         
        $query = "SELECT P.PROID, P.NAME, P.IMAGE, P.PROTYPE, P.PRICE, P.STOCK FROM PRODUCT P, SHOP S WHERE P.SHOPID = S.SHOPID AND S.SHOPNAME='".$_SESSION['shopA']."'";
       $stid = oci_parse($conn,$query);
        // $result = mysqli_query($connection, $query);
       oci_execute($stid);

 
       
    
        echo "<table cellpadding=10px border=1 width=60%>";
        echo "<tr>
                <th>Product ID</th>
                <th>Name</th>
                 <th>Image</th>
                <th>Product Type</th>
                <th class=tbl-small width=10px>Price</th>
                <th class=tbl-small>Stock</th>
               
                <th>Amend</th>
                <th>Delete</th>
            </tr>";

       while($row=oci_fetch_assoc($stid)){
        $id = $row['PROID'];
        
            echo "<tr>";
            echo "<td data-label=Product ID width=auto>".$row['PROID']."</td>";
            echo "<td data-label=Name>".$row['NAME']."</td>";
            echo "<td data-label=Image>"."<img width=50px height=50px src=".$row['IMAGE'].">"."</td>";
            echo "<td data-label=Product Type>".$row['PROTYPE']."</td>";
            echo "<td data-label=Price>".$row['PRICE']."</td>";
            echo "<td data-label=Stock>".$row['STOCK']."</td>";

          
            echo "<td>"."<a href='Productamend.php?id=$id' class='button'>Amend</a>"."</td>";
            echo "<td>"."<a href='Productdelete.php?id=$id' class='button'>Delete</a>"."</td>";
           
              
             
            echo "</tr>";

         
        }
        echo "</table>";
          
    }

    ?>
</div>
<!-- **************************shop2*************************************** -->
  <div class="shop2">
    <?php
     
    include_once('connect.php');
    if(isset($_SESSION['shopB']) && !isset($_SESSION['shopA'])){
        echo "<h2>".$_SESSION['shopB']."</h2>";
         
        $query = "SELECT P.PROID, P.NAME, P.IMAGE, P.PROTYPE, P.PRICE, P.STOCK FROM PRODUCT P, SHOP S WHERE P.SHOPID = S.SHOPID AND S.SHOPNAME='".$_SESSION['shopB']."'";
       $stid = oci_parse($conn,$query);
        // $result = mysqli_query($connection, $query);
       oci_execute($stid);
        echo "<table cellpadding=10px border=1 width=60%>";
        echo "<tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Product Type</th>
                <th class=tbl-small width=10px>Price</th>
                <th class=tbl-small>Stock</th>
                <th>Amend</th>
                <th>Delete</th>
            </tr>";

        while($row=oci_fetch_assoc($stid)){
            $id = $row['PROID'];
            // $_SESSION['restrict3'] = $row['NAME'];
            echo "<tr>";
            echo "<td data-label=Product ID width=auto>".$row['PROID']."</td>";
            echo "<td data-label=Name>".$row['NAME']."</td>";
              echo "<td data-label=Image>"."<img width=50px height=50px src=".$row['IMAGE'].">"."</td>";
            echo "<td data-label=Product Type>".$row['PROTYPE']."</td>";
            echo "<td data-label=Price>".$row['PRICE']."</td>";
            echo "<td data-label=Stock>".$row['STOCK']."</td>";

         
           echo "<td>"."<a href='Productamend.php?id=$id' class='button'>Amend</a>"."</td>";
            echo "<td>"."<a href='Productdelete.php?id=$id' class='button'>Delete</a>"."</td>";
            echo "</tr>";
        }
        echo "</table>";

        // "<img src='.images/".$row[imagename]."'>"
}
    ?>
    
          
</div>
<!-- *************************************************************************************** -->

  <div class="shop1">
    <?php
     
    include_once('connect.php');
    if(isset($_SESSION['shopA']) && isset($_SESSION['shopB'])){
         echo "<h2>".$_SESSION['shopA']."</h2>";
         
        $query = "SELECT P.PROID, P.NAME, P.IMAGE, P.PROTYPE, P.PRICE, P.STOCK FROM PRODUCT P, SHOP S WHERE P.SHOPID = S.SHOPID AND S.SHOPNAME='".$_SESSION['shopA']."'";
       $stid = oci_parse($conn,$query);
        // $result = mysqli_query($connection, $query);
       oci_execute($stid);


       
    
        echo "<table cellpadding=10px border=1 width=60%>";
        echo "<tr>
                <th>Product ID</th>
                <th>Name</th>
                 <th>Image</th>
                <th>Product Type</th>
                <th class=tbl-small width=10px>Price</th>
                <th class=tbl-small>Stock</th>
               
                <th>Amend</th>
                <th>Delete</th>
            </tr>";

       while($row=oci_fetch_assoc($stid)){
        $id = $row['PROID'];
        
            echo "<tr>";
            echo "<td data-label=Product ID width=auto>".$row['PROID']."</td>";
            echo "<td data-label=Name>".$row['NAME']."</td>";
            echo "<td data-label=Image>"."<img width=50px height=50px src=".$row['IMAGE'].">"."</td>";
            echo "<td data-label=Product Type>".$row['PROTYPE']."</td>";
            echo "<td data-label=Price>".$row['PRICE']."</td>";
            echo "<td data-label=Stock>".$row['STOCK']."</td>";

          
            echo "<td>"."<a href='Productamend.php?id=$id' class='button'>Amend</a>"."</td>";
            echo "<td>"."<a href='Productdelete.php?id=$id' class='button'>Delete</a>"."</td>";
           
              
             
            echo "</tr>";

         
        }
        echo "</table>";
         echo "<h2>".$_SESSION['shopB']."</h2>";
         
        $query = "SELECT P.PROID, P.NAME, P.IMAGE, P.PROTYPE, P.PRICE, P.STOCK FROM PRODUCT P, SHOP S WHERE P.SHOPID = S.SHOPID AND S.SHOPNAME='".$_SESSION['shopB']."'";
       $stid = oci_parse($conn,$query);
        // $result = mysqli_query($connection, $query);
       oci_execute($stid);
        echo "<table cellpadding=10px border=1 width=60%>";
        echo "<tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Product Type</th>
                <th class=tbl-small width=10px>Price</th>
                <th class=tbl-small>Stock</th>
                <th>Amend</th>
                <th>Delete</th>
            </tr>";

        while($row=oci_fetch_assoc($stid)){
            $id = $row['PROID'];
            echo "<tr>";
            echo "<td data-label=Product ID width=auto>".$row['PROID']."</td>";
            echo "<td data-label=Name>".$row['NAME']."</td>";
              echo "<td data-label=Image>"."<img width=50px height=50px src=".$row['IMAGE'].">"."</td>";
            echo "<td data-label=Product Type>".$row['PROTYPE']."</td>";
            echo "<td data-label=Price>".$row['PRICE']."</td>";
            echo "<td data-label=Stock>".$row['STOCK']."</td>";

         
           echo "<td>"."<a href='Productamend.php?id=$id' class='button'>Amend</a>"."</td>";
            echo "<td>"."<a href='Productdelete.php?id=$id' class='button'>Delete</a>"."</td>";
            echo "</tr>";
        }
        echo "</table>";
          
    }

    ?>
</div>

</div>
</body>
</html>