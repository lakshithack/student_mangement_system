
<?php 

    include('connection.php'); 

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Homepage</title>
    <style type="text/css">
        body{
            background: #eee;
        }
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

         header{
          background: #A93226;
        }


        .banner-img{
          position: fixed;
          opacity: .3;
          background-image: url(images/home_bg.png);
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center center;
          width: 100%;
          height: 100%;
          filter: blur(3px);
        }
         .banner-text{
          position: absolute;
          width: 100%;
          z-index: 5;
          border-radius: 1rem;
          background: none;
        }


        .options{
            border-radius: 1rem;
        }
        .rounded-full {
            border-radius: 100%;
            color: #A93226;
        }
        .secondary-bg {
            background-color: #f1d6d6;
        }

        .dropdown {
          position: relative;
          display: inline-block;
        }

        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }

        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .dropdown-content a:hover {background-color: #ddd;}

        .dropdown:hover .dropdown-content {display: block;}

        .dropdown:hover .dropbtn {background-color: none;}
    </style>

</head>
<body>
    
<?php  include('heading.php'); ?>

<!--Panels--->
        <div class="banner-img"></div>
        <div class="banner-text">

            <div class="container" style="background: white; margin-top: 10rem; height: 300px; border-radius: 1rem;background-image: url('images/slide6.png');background-size:cover;">
                <div class="row">
                    <div class="col-3" style="height: 300px;background:none;"></div>
                    <div class="col-6" style="height: 300px;background:none;">
                        <center>
                            <h1 style="font-size:6rem; margin-top:7rem;"><?php date_default_timezone_set("Asia/Colombo");echo date("h:ia"); ?></h1>
                            <h1 style="font-size:2rem;"><?php echo date('l,F d'); ?></h1>
                        </center>
                    </div>
                    <div class="col-3" style="height: 300px;background:none;"></div>
                </div>
            </div>

        <div class="container px-4" style="margin-top: 2rem; margin-bottom: 45rem;">
                <?php 
                if ($_SESSION['position'] == 0) {
                    $sql = "SELECT COUNT(id) AS stu_count FROM tbl_student;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $stu_count =  $row['stu_count'];
                        }
                    }

                    $sql = "SELECT COUNT(tcr_id) AS tcr_count FROM tbl_teacher_basic;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $tcr_count =  $row['tcr_count'];
                        }
                    }


                ?>
                <div class="row g-3 my-2">
                    <div class=" col-md-3">
                        <div class="options p-5 shadow-sm d-flex justify-content-around align-items-center" onclick="location.href='student_overview.php';"  style="cursor: pointer; background: #08a908;">
                            <div>
                                <h3 class="fs-2">Students</h3>
                                <p class="fs-3"><?php echo $stu_count ?></p>
                            </div>
                            <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="options p-5 shadow-sm d-flex justify-content-around align-items-center" onclick="location.href='teacher.php';" style="background: #d68b00; cursor: pointer;">
                            <div>
                                <h3 class="fs-2">Teachers</h3>
                                <p class="fs-3"><?php echo $tcr_count ?></p>
                            </div>
                            <i
                                class="fas fa-chalkboard-teacher fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="options p-5  shadow-sm d-flex justify-content-around align-items-center" style="background: #c2c200;" >
                            <div>
                                <h3 class="fs-2">Non-academic</h3>
                                <p class="fs-3">150</p>
                            </div>
                            <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="options p-5 shadow-sm d-flex justify-content-around align-items-center " style="background: #0dcaf0;">
                            <div>
                                <h3 class="fs-2">Attendence</h3>
                                <p class="fs-3">150</p>
                            </div>
                            <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>
                <?php 
                }
                if ($_SESSION['position'] == 1) {
                    $sql = "SELECT COUNT(id) AS stu_count FROM tbl_student;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $stu_count =  $row['stu_count'];
                        }
                    }

                    $sql = "SELECT COUNT(tcr_id) AS tcr_count FROM tbl_teacher_basic;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $tcr_count =  $row['tcr_count'];
                        }
                    }

                    $sql = "SELECT COUNT(tcr_id) AS tcr_sub_count FROM tbl_teacher_csub where tcr_id = $tcr_id;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $tcr_sub_count =  $row['tcr_sub_count'];
                        }
                    }
                ?>
                <!--FOR TEACHERS--->
                <div class="row g-3 my-2">

                    <div class=" col-md-3">
                        <div class="options p-5 shadow-sm d-flex justify-content-around align-items-center" onclick="location.href='student_overview.php';"  style="cursor: pointer; background: #08a908;">
                            <div>
                                <h3 class="fs-2">Students</h3>
                                <p class="fs-3"><?php echo $stu_count ?></p>
                            </div>
                            <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    
                    <div class=" col-md-3">
                        <div class="options p-5 shadow-sm d-flex justify-content-around align-items-center" onclick="location.href='tcr_my_classes.php';" style="background: #d68b00; cursor: pointer;">
                            <div>
                                <h3 class="fs-2">My Classes</h3>
                                <p class="fs-3"><?php echo $tcr_count ?></p>
                            </div>
                            <i
                                class="fas fa-chalkboard-teacher fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="options p-5  shadow-sm d-flex justify-content-around align-items-center" onclick="location.href='tcr_my_sub.php';" style="background: #c2c200; cursor: pointer;" >
                            <div>
                                <h3 class="fs-2">My Subjects</h3>
                                 <p class="fs-3"><?php echo $tcr_sub_count ?></p>
                            </div>
                            <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="options p-5 shadow-sm d-flex justify-content-around align-items-center " style="background: #0dcaf0;">
                            <div>
                                <h3 class="fs-2">My Profile</h3>
                                <p class="fs-3">150</p>
                            </div>
                            <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>


<!-- about section starts  

<section class="about" id="about">

    <div class="image">
        <img src="images/logo.jfif" style="width: 60%;">
    </div>

    <div class="content">
        <center><h3 style="color: #A93226;">Our Vision</h3></center>
        <p>Just like Windows, iOS, and Mac OS, Linux is an operating system. In fact, one of the most popular platforms on the planet, Android, is powered by the Linux </p>

        <center><h3 style="color: #A93226;">Our Mission</h3></center>

        <p>The software that manages the boot process of your computer. For most users, this will simply be a splash screen that pops up and eventually goes away to boot into the operating system...</p>
    </div>

</section>--->












<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>