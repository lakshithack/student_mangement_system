<?php 
session_start();
include('connection.php');
if (isset($_SESSION['username'])) { 
    $username = $_SESSION['username'];
?>
<style type="text/css">
    .top_nav{
      padding: 0rem 5rem;
      font-size: 12px;
      height: 6.5rem;
      background: red;
    }
    .top_nav .navbar a{
      color: white;
      font-weight: 600;
    }

    .top_nav .logo {
      font-family: 'Dancing Script', cursive;
      text-decoration: none;
      margin: none;
      font-size: 1.9rem;
      color: black;
      font-weight: bolder;
    }

    .top_nav p {
      color: #A93226;
      font-family: sans-serif;
      font-weight: 600;
      font-size: 1.3rem;
    }

    .top_nav i{
      font-size: 1.8rem;
      padding: 5px;

    }

    /*header*/

    .header {
      background: #A93226;
      position: fixed;
      top: 6.5rem;
      left: 0;
      right: 0;
      padding: .5rem 1%;
      z-index: 1000;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
    }

    .header.active {
      background: #A93226;
      top: 0;
      -webkit-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
              box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .header .logo {
      margin-right: auto;
      font-size: 2.5rem;
      color: #10221b;
      font-weight: bolder;
    }

    .header .navbar a {
      text-decoration: none;
      font-weight: 600;
      margin-left: 0rem;
      font-size: 1.7rem;
      color: white;
    }

    .header .navbar a:hover{
      text-decoration: none;
    }

    .header .navbar a:hover {
      color: #219150;
    }

    .header .navbar #nav-close {
      font-size: 5rem;
      cursor: pointer;
      color: #10221b;
      display: inline-block;
    }

    .header .icons div {
      font-size: 2.5rem;
      margin-left: 0rem;
      cursor: pointer;
      color: white;
    }

    .header .icons a:hover,
    .header .icons div:hover {
      color: #219150;
    }
    .header .dropdown-content a{
      color: black;
      background: white;
      font-size: 15px;
    }

    .header #menu-btn {
        font-size: 18px;
        color: white;
        display: inline-block;
    }

    .header #search-btn {
        padding: 9px 0px 0px 15px;
        font-size: 18px;
        color: white;
        display: inline-block;
    }

    .search-form {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: rgba(0, 0, 0, 0.8);
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
      -webkit-box-pack: center;
          -ms-flex-pack: center;
              justify-content: center;
      z-index: 10000;
      -webkit-transform: translateY(-110%);
              transform: translateY(-110%);
    }

    .search-form.active {
      -webkit-transform: translateY(0%);
              transform: translateY(0%);
    }

    .search-form #close-search {
      position: absolute;
      top: 1.5rem;
      right: 2.5rem;
      cursor: pointer;
      color: #fff;
      font-size: 6rem;
    }

    .search-form #close-search:hover {
      color: #219150;
    }

    .search-form form {
      width: 70rem;
      margin: 0 2rem;
      padding-bottom: 2rem;
      border-bottom: 0.2rem solid #fff;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
    }

    .search-form form input {
      width: 100%;
      font-size: 2rem;
      color: #fff;
      text-transform: none;
      background: none;
      padding-right: 2rem;
    }

    .search-form form input::-webkit-input-placeholder {
      color: #aaa;
    }

    .search-form form input:-ms-input-placeholder {
      color: #aaa;
    }

    .search-form form input::-ms-input-placeholder {
      color: #aaa;
    }

    .search-form form input::placeholder {
      color: #aaa;
    }

    .search-form form label {
      font-size: 3rem;
      cursor: pointer;
      color: #fff;
    }

    .search-form form label:hover {
      color: #219150;
    }
    .header.icons{
        padding-left: 12rem;
    }
    .header .icons a {
        text-decoration: none;
        font-weight: 600;
        margin-left: 0rem;
        font-size: 1.7rem;
    }
    .name {
        border: 2px solid black;
        margin-left: 2rem;
        padding: 4px;
        padding-left: 15px;
        padding-right: 15px;  
        border-radius: 12px;
    }

    @media (max-width: 768px) {
        .icons{
        }
    }

    @media (max-width: 450px) {
        .header.icons{
            width: 100%;
            padding-left: 3px;
        }
        .header.icons.padding{
            width: 20%;
        }
    }
</style>
</head>
<body>
<!-- header section starts  -->
<nav class="top_nav shadow" style="background: white;">
    <div class="row">
        <a href="#" class="logo pb-2 col-lg-6 col-md-8"><img src="images/logo.jfif" style="width: 63px;">Rangiri Dambulla National School</a>
        <div class="col-lg-2 d-none d-lg-block"></div>
        <div class="col-4 d-none d-lg-block pt-3">
            <div class="row">
                <p>
                    Email : info@rdcc.com <b style="color: black;">|</b> Tel: +9466778980 <b style="color: black;">|</b>
                    <a><i class="fab fa-facebook" style="color: blue;"></i></a> 
                    <a><i class="fab fa-youtube" style="color: red;"></i></a>
                </p>
            </div>
        </div>
    </div>
</nav>
<?php 
if ($_SESSION['position'] == 0) {
    $sql = "SELECT aid from tbl_admin where nic=$username; ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $aid = $row['aid'];
            $session_username = $aid;
        }
    }
?>
<header class="header col-12">
    <div class="row col-12">
        <div class="icons col-lg-3 col-md-2 col-sm-12">
          <div class="row col-12">
            <div id="menu-btn" class="fas fa-bars d-block d-lg-none col-1" style="padding: 8px 2px 2px 5px;"></div>
            <div class="col-9 d-block d-md-none"></div>
            <div id="search-btn" class="fas fa-search col-1 d-block d-md-none"></div>

            <div class="dropdown col-1 d-block d-md-none">
              <a class="dropbtn col-1"><i class="fas fa-user"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-8">
            <nav class="navbar">
                <div id="nav-close" class="fas fa-times d-block d-md-none"></div>
                <a href="homepage.php">Homepage</a>
                <div class="dropdown">
                  <a class="dropbtn">Students</a>
                  <div class="dropdown-content">
                    <a href="student_overview.php" style="color: black;">Overview</a>
                    <a href="attendence.php" style="color: black;">Attendance</a>
                  </div>
                </div>
                <a href="teacher.php">Teachers</a>
                <div class="dropdown">
                  <a class="dropbtn">Category</a>
                  <div class="dropdown-content">
                    <a href="section.php" style="color: black;">Sections</a>
                    <a href="grade.php" style="color: black;">Grades</a>
                    <a href="class.php" style="color: black;">Classes</a>
                    <a href="subject.php" style="color: black;">Subjects</a>
                  </div>
                </div>
                <a href="homepage.php">Reports</a>
            </nav>
        </div>
        <div class="icons col-lg-3 col-md-2 d-none d-md-block">
            <div class="row col-12">
                <div class="col-6"></div>
                <div class="col-6">
                      <div class="row col-12">
                        <div class="col-8"></div>
                        <!--<div id="search-btn" class="fas fa-search col-6 m-0"></div>-->
                        <div class="dropdown col-4">
                            <a class="dropbtn" style="padding-bottom: 4px; padding-top:5px ; border-radius: 50%;background: white;"><i style="color:#A93226;" class="fas fa-user"></i></a>
                            <div class="dropdown-content m-0" style="left: -110px;">
                              <a href="admin_profile.php?profile_id=<?php echo $aid; ?>" style="font-size: 14px;">My profile</a>
                              <a href="logout.php" style="font-size: 14px;">Log out</a>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php
} else {
    $sql = "SELECT tcr_id,stream from tbl_teacher_basic where nic=$username; ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tcr_id = $row['tcr_id'];
            $tcr_stream = $row['stream'];

        }
    }

    $sql = "SELECT tbl_tcr_class_incharge.*, tbl_class.class from tbl_tcr_class_incharge,tbl_class where tbl_tcr_class_incharge.tcr_id=$tcr_id and tbl_tcr_class_incharge.class_id=tbl_class.class_id; ";
     $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $incharge_grade = $row['g_id'];
            $incharge_class = $row['class_id'];
            $incharge_class_name = $row['class'];
        }
    }
?>
<header class="header col-12">
    <div class="row col-12">
        <div class="icons col-lg-3 col-md-2 col-sm-12">
          <div class="row col-12">
            <div id="menu-btn" class="fas fa-bars d-block d-lg-none col-1" style="padding: 8px 2px 2px 5px;"></div>
            <div class="col-9 d-block d-md-none"></div>
            <div id="search-btn" class="fas fa-search col-1 d-block d-md-none"></div>

            <div class="dropdown col-1 d-block d-md-none">
              <a class="dropbtn col-1"><i class="fas fa-user"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-8">
            <nav class="navbar">
                <div id="nav-close" class="fas fa-times d-block d-md-none"></div>
                  <a href="homepage.php">Homepage</a>
                  <div class="dropdown">
                    <a class="dropbtn">Students</a>
                    <div class="dropdown-content">
                      <a href="student_overview.php" style="color: black;">View</a>
                      <a href="attendence.php" style="color: black;">Attendance</a>
                    </div>
                  </div>
                  <a href="tcr_my_sub.php">My Subjects</a>
                  <a href="tcr_my_classes.php">My Classes</a>
                  <a href="homepage.php">Reports</a>
                  <a href="tcr_profile.php?profile_id=<?php echo $tcr_id; ?>" class="d-block d-md-none">My Profile</a>
                  <a href="logout.php" class="d-block d-md-none">Log Out</a>
            </nav>
        </div>
        <div class="icons col-lg-3 col-md-2 d-none d-md-block">
            <div class="row col-12">
                <div class="col-8"></div>
                <div class="col-4">
                      <div class="row col-12">
                        <!--<div id="search-btn" class="fas fa-search col-6 m-0"></div> -->
                        <div class="dropdown col-6">
                            <a class="dropbtn"><i class="fas fa-user"></i></a>
                            <div class="dropdown-content m-0" style="left: -110px;">
                              <a href="tcr_profile.php?profile_id=<?php echo $tcr_id; ?>" style="font-size: 14px;">My profile</a>
                              <a href="logout.php" style="font-size: 14px;">Log out</a>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php } ?>
<!-- search form  -->

<div class="search-form">

    <div id="close-search" class="fas fa-times"></div>

    <form action="">
        <input type="search" name="" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form>
</div>
<?php 
} else {
    header("Location: login.php");
}
?>
