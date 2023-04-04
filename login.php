<?php 
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <title>RDCC  | Homepage</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css">
  <link rel="stylesheet" type="text/css" href="css/style.css"> 
  <style type="text/css">
    .banner-img{
      position: fixed;
      background-image: url(images/slide2.png);
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      width: 100%;
      height: 100%;
      filter: blur(3px);
    }
    .banner-text{
      position: absolute;
      top: 15rem;
      left: 30%;
      width: 40%;
      /*transform: translate(-50px,-50px); */
      z-index: 5;
      border-radius: 1rem;
      background: none;
    }
    .content{
      background: white;
      border-radius: 1rem;
      padding: 40px 10px;
      width: 100%;
      height: 100%;
    }
    @media (max-width: 768px){
      .banner-text{
        width: 80%;
        left: 10%;

      }
    }


    /* Full-width input fields */
    input[type=text], input[type=password] {
      font-size: 14px;
      width: 100%;
      padding: 12px 20px;
      margin-top: 0;
      margin-bottom: 10px;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    /* Set a style for all buttons */
    button {
      background-color: #A93226;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      opacity: 0.8;
    }
    label{
      font-size: 16px;
      margin: 0;
    }
    .container {
      padding: 16px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }
  </style>
</head>
<body>

  <!-- header section starts  -->
<nav class="top_nav shadow" style="background: white;">
    <div class="row">
        <a href="#" class="logo pb-2 col-lg-6 col-md-8"><img src="images/logo.jfif" style="width: 63px;">Rangiri Dambulla Central Collage</a>
        <div class="col-lg-2 d-none d-lg-block"></div>
        <div class="col-4 d-none d-lg-block pt-3">
            <p>
                Email : info@rdcc.com <b style="color: black;">|</b> Tel: +9466778980 <b style="color: black;">|</b>
                <a><i class="fab fa-facebook" style="color: blue;"></i></a> 
                <a><i class="fab fa-youtube" style="color: red;"></i></a>
            </p>
        </div>
    </div>
</nav>
 
  <div class="banner-img"></div>
  <div class="banner-text ">
    <center><h1 style="padding-bottom: 2rem; color: white;">Data Management System</h1></center>
    <div class="content">
        <?php 
          if ($_GET['error'] == 'Username or password is incorrect!') { ?>
            <div class="alert alert-danger mt-2 mb-2 ml-5 mr-5" role="alert" style="font-size: 16px;">
              <center>
                <?=$_GET['error']?>
              </center>
            </div>
        <?php } ?>
        <?php 
          if ($_GET['error'] == 'Login Successful!') { ?>
            <div class="alert alert-success mt-2 mb-2 ml-5 mr-5" style="font-size: 16px;" role="alert">
              <center>
                <?php echo $_GET['error'];?>
              </center>
              <?php header( 'refresh:2;url=homepage.php'); ?>
            </div>
        <?php } ?>
        <form class="modal-content col-12 animate" style="border: none;" action="login2.php" method="post">
          <div class="container">
            <label for="uname"><b>NIC</b></label>
            <input type="text" placeholder="Enter NIC" name="nic" required>

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
                                    
              <center><input type="submit" class="btn sub_btn" value="Login" style="border: none;"></center>
          </div>
          <center style="font-size: 13px;">Don't Have an account?<a href="teacher_insert.php" style="text-decoration: none; color: #A93226;"><b> Register now</b></a></center>
        </form>
    </div>
  </div>
</body>
</html>