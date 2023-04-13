<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details Page</title>
    <link rel="stylesheet" href="detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <nav>
        <div class="logo"><img src="ClecKart Logo.png" width=100px, height=100px></div>
       
    </nav>

    <div class="flex-box">
        <div class="left">
            <div class="big-img">
                <img src="avocado.jpg">
            </div>
            <div class="like"><h2>You May Also Like</h2></div>
            <div class="images">
                <div class="small-img">
                    <img src="brin.jpg" onclick="showImg(this.src)">
                </div>
                <div class="small-img">
                    <img src="brocoli.jpg" onclick="showImg(this.src)">
                </div>
                <div class="small-img">
                    <img src="carrot.jpg" onclick="showImg(this.src)">
                </div>
                <div class="small-img">
                    <img src="beet.jpg" onclick="showImg(this.src)">
                </div>
            </div>
        </div>

        <div class="right">
            <div class="link">Product</div>
            <div class="slogan">Mouthfull of goodness</div>
            <h3>Product Name</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price">£50</div>
            <div class="info">
                <div class="box"><h3>Description:<p>Avocados provide a substantial amount of monounsaturated fatty acids and are rich in manyTrusted Source vitamins and minerals</p></h3></div><br>
                 <div class="box"><h3>Allergy Info:<p>Avocados provide a substantial amount of monounsaturated fatty acids and are rich in manyTrusted Source vitamins and minerals</p></h3></div>
                
            </div>
            <div class="quantity">
                <p><h3>Quantity :</h3></p>
                <input type="number" min="1" max="5" value="1">
            </div>
            <div class="btn-box">
                <button class="cart-btn">Add to Cart</button>
                <button class="buy-btn">Add to wishlist</button>
            </div>
        </div>
    </div>


    <script>
        let bigImg = document.querySelector('.big-img img');
        function showImg(pic){
            bigImg.src = pic;
        }
    </script>
</body>
</html>