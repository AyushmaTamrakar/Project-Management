



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN</title>
    <script
      src="https://kit.fontawesome.com/6338071364.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="login.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400&family=Orelega+One&family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Concert+One&family=Merriweather+Sans:wght@300;400&family=Mukta:wght@500&family=Orelega+One&family=Playfair+Display&family=Source+Sans+3:wght@300&display=swap" rel="stylesheet">
</head>
<body>
  <style type="text/css">
    .Loghome{
      display: flex;
      justify-content: space-between;
    }

    .Loghome input{
      width: 100px;
    }
    .homebtn{
      background: white;
      color: forestgreen;
      border-radius: 20px;
      padding: 5px 10px 5px 10px;
      border: 1px solid forestgreen;
      margin-left:35px ;
    }
    .homebtn:hover{
      background: forestgreen;
      color: white;
    }
  </style>
  


  <div class="container-fluid">
    <div class="row main-content bg-success text-center">
      <div class="col-md-4 text-center company__info">
        <div class="acc_img"><img src="ClecKart Logo.png" alt="Account Image" ></div>
      </div>
      <div class="col-md-8 col-xs-12 col-sm-12 login_form">
        <div class="container-fluid">
          <div class="row">
            <h2>Welcome To Cleckart</h2>
          </div>
          <div class="row">
            <form method="POST" class="form-group" action="loginto.php">
              <div class="row">
                <input
                  type="text"
                  name="username"
                  id="username1"
                  class="form__input"
                  placeholder="EMAIL"
                />
              </div>
              <div class="row">
                <input
                  type="password"
                  name="password"
                  id="password1"
                  class="form__input"
                  placeholder="Password"
                />
              </div>
            

              <select  class="login_type" name="drop">
                <option value="Customer">Customer</option>
                <option value="Trader">Trader</option>
                <option value="Management">Management</option>
              </select>
              <br />

              <div class="row">
                <input
                  type="checkbox"
                  name="remember_me"
                  id="remember_me"
                  class=""
                />
                <label for="remember_me">Remember me</label>
              </div>
              <div class="Loghome">
                <div class="row" id="login-btn">
                <input type="submit" value="Login" class="btn" name="Login"/>

              </div>
              </div>
            </form>

            <div>
   <A HREF="http://localhost/Cleckart/WEBSITE/HOME.php">
     <input type="submit" name="Home" value="Home" class="homebtn">
   </A>
  </div>
          </div>

          <div class="bottom">
            <div class="row">
            <a href="http://localhost/Cleckart/WEBSITE/forgotpassword.php">Forgot Password?</a>
          </div>
          <div class="row">
            <p>New to Cleckart <a href="http://localhost/Cleckart/WEBSITE/reg/headFoot.php">Create an account</a></p>
          </div>
          </div>

        

        </div>
      </div>
    </div>
  </div>


   <!------------------------------------ FOOTER -------------------------------->
    
    <!-- ***************************** END FOOTER *************************************** -->
</body>
</html>
