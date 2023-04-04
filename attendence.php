<?php 
  error_reporting(1);
  include('connection.php');
  $path = 'attendence.php';
  $date = date("Y-m-d");

//--------ATTENDANCE MAIN-------------------------------------------------------------------------------------------------------
  if (isset($_POST['attendance'])) {
    $boys = $_POST['boys'];
    $girls = $_POST['girls'];
    $incharge_grade = $_POST['incharge_grade'];
    $incharge_class = $_POST['incharge_class']; 

    $sql = "INSERT INTO `tbl_attendance` VALUES ($incharge_grade,$incharge_class,$boys,$girls,'$date')";
    if ($conn->query($sql) === TRUE){  
      header("Location: alert.php?action=success&path=$path");
    } else {
      header("Location: alert.php?action=fail&path=$path");
     }
  }

  if (isset($_POST['update'])) {
     $boys = $_POST['boys'];
    $girls = $_POST['girls'];
    $incharge_grade = $_POST['incharge_grade'];
    $incharge_class = $_POST['incharge_class'];

    $sql = "UPDATE `tbl_attendance` SET `b`=$boys,`g`=$girls where g_id = $incharge_grade and class_id = $incharge_class and date = '$date'";
    if ($conn->query($sql) === TRUE){  
      header("Location: alert.php?action=success&path=$path");
    } else {
      header("Location: alert.php?action=fail&path=$path");
     }
  }
//---------------------------------------------------------------------------------------------------------------------------------
//---------ATTENDANCE EXTRACURRUCULAR---------------------------------------------------------------------------------------------
    //SUBMIT ATTENDENCE
    if (isset($_POST['extracurricular'])) {
      $indexno = $_POST['mytext'];

      foreach ($indexno as $key => $value) {
        //select student deatails
        $sql = "SELECT * from tbl_student WHERE admission=$value";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
              $id = $row['id']; 
              $g_id = $row['g_id'];
              $class_id = $row['class_id']; 
              $gender = $row['gender'];
           } 
        }
        //Insert to tbl_extracurricular
        $sql = "INSERT INTO `tbl_extracurricular` VALUES ($id,$g_id,$class_id,'$gender','$date')";
        if ($conn->query($sql) === TRUE){  
          header("Location: alert.php?action=success&path=$path");
        } else {
          header("Location: alert.php?action=fail&path=$path");
         }
      }
    }
//---------------------------------------------------------------------------------------------------------------------------
  //ADMIN SEARCH
  if (isset($_POST['admin_search'])) {
    $date = $_POST['date'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
  <link rel="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
  <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    body{
      font-family: 'poppins', sans-serif;
      background-color: #A93226;
    }
    .content{
      margin: 8%;
      border-radius: 1rem;
      background-color: #fff;
      padding: 4rem 1 rem 4rem 1rem;
      box-shadow: 0 0 5px 5px rgba(0,0,0, .05);
    }
    .text1{
      font-style: normal;
      font-weight: 600 !important;
    }
    .form-control{
      display: block ;
      widows: 100%;
      font-size: 1.5rem;
      font-weight: 400;
      line-height: 20px;
      border-color: #A93226 !important;
      border-style: solid;
      border-width: 0 0 2px 0 !important;
      padding: 0px !important;
      color: Black;
      height: auto;
      border-radius: 0;
      background-color: #fff;
      background-clip: padding-box;
    }
    .form-control::focus{
      color: black;
      background-color: #fff;
      border-color: white;
      outline: 0;
      box-shadow: none;
    }
    .form-group label{
      font-size: 15px;
    }
    .btn{
      border: none;
    }

    .icon{
          font-size: 15rem; 
          padding: 2rem;
        }
        .del_btn{
          margin-top: 1rem;
          cursor: pointer;
          border: none;
          color: white;
          text-decoration: none;
          background: #A93226;
          font-size: 14px;
          padding: 1rem 1rem;
          border-radius: .5rem; 
          margin-left: 15%;
          margin-right: 15%;
        }
        .dyn_tab button{
          color: white;
          font-weight: 600;
          width: 50%;
        }
        .del_btn:hover {
          opacity: .8;
          color: white;
        }
        .input_fields_wrap input{
          border: 1px solid black;
          padding: 5px 10px;
          margin: 10px 0;
        }
        .add_field_button{
          padding: 10px;
          background: black;
          color: white;
          border-radius: 5px;
        }
        .fa-trash{
          color: white;
          padding: 10px;
          background: #A93226;
          border-radius: 4px;
          margin: 2px;
        }
        @media (max-width: 768px){
          .icon{
            font-size: 10rem;
          }
          .del_btn{
            font-size: 10px;
            margin-left: 4rem;
            margin-right: 4rem;
          }
         }

      
  </style>
</head>
<body>
  <?php include('heading.php'); ?>
  <?php 
    //CHECK FOR ADMIN
    if ($_SESSION['position'] == 0) {
    //ADMIN INTERFACE 
  ?>

      <div class="tab-content" id="nav-tabContent" style="margin-top: 8rem;">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 0rem;">
            <?php 
              include('connection.php'); 
              $sql = "SELECT tbl_attendance.*, tbl_class.class FROM tbl_attendance, tbl_class where tbl_attendance.class_id=tbl_class.class_id and date = '$date'";
              $result = $conn->query($sql);
            ?>
            <center>
              <div class="dataTables_wrapper" style="width: 99%; font-size: 1.5rem"> 
                <h1 class="mb-5" style="font-size: 30px;">Attendance | <?php echo $date; ?> </h1>
                <center>
                  <form method="post" action="attendence.php">
                    <input type="date" name="date" style="border: 1px;border-radius: 7px;padding: 8px;background: #fbdbdb;" required>
                    <input type="submit" name="admin_search" style="background: #A93226; color: white; text-decoration: none; padding: 8px; border-radius: 2px;" value=" Search" >
                  </form>
                </center>
                <?php if ($result->num_rows > 0) { ?>
                  <table id="table1" class="display" style="padding: 1rem;">
                    <thead>
                      <tr id="header" style="background:#eee; color:#A93226;">
                                          
                        <th>Class</th>
                        <th>Boys</th>
                        <th>Girls</th>
                        <th>Total</th>

                      </tr>
                    </thead>

                    <tbody>
                    <?php while($row = $result->fetch_assoc()) { ?>
                      <tr>
                        <td style="background: white;"><?php echo $row['g_id'].'-'.$row['class']; ?></td>
                        <td><?php echo $row['b']; ?></td>
                        <td><?php echo $row['g']; ?></td>
                        <td><?php echo $row['b']+$row['g']; ?></td>
                      </tr> 
                    <?php } ?>
                    </tbody>

                  </table>
                <?php } ?>
              </div> 
            </center>
          </div>
        </div>
      </div>

  <?php 
    } else {
  ?>
  
  <div class="form-body container-fluid mt-3 col-lg-10 col-md-10">
    <nav style="font-size: 16px; margin-top: 5rem;">
      <div class="nav nav-tabs dyn_tab" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Class</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Extracurricular</button>
      </div>
    </nav>
    <div class="tab-content m-0" id="nav-tabContent" style="padding: 0rem;">
      <!--Tab 1 | Class-->
      <div class="tab-pane fade show active " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <?php 

          //extracurricular-boys
            $sql="SELECT count('id') FROM tbl_extracurricular where date = '$date' and gender='male'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
              $extra_b = $row["count('id')"];
             }
            } 

            //extracurricular-girls
            $sql="SELECT count('id') FROM tbl_extracurricular where date = '$date' and gender='female'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
              $extra_g = $row["count('id')"];
             }
            } 

          //SELECT CORRECT ATTENDANCE DETAILS
          $action = $_GET['action'];
          $sql = "SELECT tbl_attendance.* FROM tbl_attendance where g_id = $incharge_grade and class_id = $incharge_class and date = '$date'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) { 

          if ($action == 'update') { 
        ?>
        <!--Update Attendance-->
        <div class="container">
            <div class="row content">
              <div class="col-md-6 mb-md-3 mb-sm-0" style="padding:3rem;">
                <img src="images/attendance.png" class="img-fluid" alt="image">
              </div>
              <div class="col-md-6" style="padding-top:4rem; padding-right: 2rem;">
                <h1 class="text1 mb-3">Update Attendance</h1>
                <hr class="mb-5">
                <form class="mt-4" method="post" action="attendence.php">
                  <input type="hidden" name="incharge_grade" value="<?php echo $incharge_grade; ?>">
                  <input type="hidden" name="incharge_class" value="<?php echo $incharge_class; ?>">
                  <div class="form-group mb-3 ">
                    <label for="boys">Number Of Boys:</label>
                    <input type="number" name="boys" class="form-control mt-3" value="<?php echo $row['b']; ?>">
                  </div>
                  <div class="form-group mb-3">
                    <label for="girls">Number Of Girls:</label>
                    <input type="number" name="girls" class="form-control mt-3" value="<?php echo $row['g']; ?>">
                  </div>
                  <div class="form-group mb-3">
                    <center><input type="submit" name="update" class="btn sub_btn" value="Update"></center>
                  </div>
                </form>
              </div>
            </div>
        </div>
        <?php } else { ?>
        <!--Successfully Message-->
        <div class="container" style="margin-top: 10rem;">
          <center>
            <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding:3rem; border-radius: 1rem;">
              <center><i style="color:#2e8b57;" class="icon fas fa-thumbs-up"></i></center>
              <div>
                <center>
                  <h2 style="font-size: 28px; font-weight: 600;">You Have Submitted Today's Attendance</h2>
                  <hr>
                  <table>
                    <tr>
                      <th style="border:none;padding: 0 20px;"></th>
                      <th style="border:none;padding: 0 20px;"><h4>Class</h4></th>
                      <th style="border:none;padding: 0 20px;"><h4>Extracurricular</h4></th>
                    </tr>
                    <tr>
                      <td><h4 class="mt-3"><i class="fas fa-male"></i>Boys</h4></td>
                      <td><center style="padding-top: 5px;font-size: 13px"><b><?php echo $row['b']; ?></b></center></td>
                      <td><center style="padding-top: 5px;font-size: 13px"><b><?php echo $extra_b; ?></b></center></td>
                    </tr>
                    <tr>
                      <td><h4 class="mt-3"><i class="fas fa-female"></i>Girls</h4></td>
                      <td><center style="padding-top: 5px;font-size: 13px"><b><?php echo $row['g']; ?></b></center></td>
                      <td><center style="padding-top: 5px;font-size: 13px"><b><?php echo $extra_g; ?></b></center></td>
                    </tr>
                  </table>
                </center>
              </div>
              <div class="" style="height: auto; padding-top: 5rem;">
                  <a class="del_btn" href="attendence.php?action=update" style="background: #2e8b57;">Update</a>
                  <a class="del_btn" href="student_overview.php" style="background: blue;">Back</a>
              </div>
            </div>
          </center>
        </div>
        <?php } } } else { ?>

        <!--Submit Attendance-->
        <div class="container">
          <div class="row content">
            <div class="col-md-6 mb-md-3 mb-sm-0" style="padding:3rem;">
              <img src="images/attendance.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6" style="padding-top:4rem; padding-right: 2rem;">
              <h1 class="text1 mb-3">Attendance | Class</h1>
              <hr class="mb-5">
              <form class="mt-4" method="post" action="attendence.php">
                <input type="hidden" name="incharge_grade" value="<?php echo $incharge_grade; ?>">
                <input type="hidden" name="incharge_class" value="<?php echo $incharge_class; ?>">
                <div class="form-group mb-3 ">
                  <label for="boys">Number Of Boys:</label>
                  <input type="number" name="boys" class="form-control mt-3">
                </div>
                <div class="form-group mb-3">
                  <label for="girls">Number Of Girls:</label>
                  <input type="number" name="girls" class="form-control mt-3">
                </div>
                <div class="form-group mb-3">
                  <center><input type="submit" name="attendance" class="btn sub_btn" value="Submit"></center>
                </div>
              </form>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <!--Tab 2 | Extracurricular-->
      <div class="tab-pane fade show " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="container">
          <div class="row content">
            <div class="col-md-6 mb-md-3 mb-sm-0" style="padding:0rem;">
              <img src="images/attendance.png" class="img-fluid" alt="image">
            </div>
            <div class="col-md-6" style="padding-top:4rem; padding-right: 2rem;">
              <h1 class="text1 mb-3">Attendance | Extracurricular</h1>
              <hr class="mb-2">
              <form method="post" action="">
                <div class="input_fields_wrap">
                  <div>
                    <input type="number" name="mytext[]" placeholder="Insert admission no..." required>
                    <button class="add_field_button">Add More Fields</button>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <center><input type="submit" name="extracurricular" class="btn sub_btn" value="Submit"></center>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php  } ?>
    </div>
  </div>

</body>
<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#table1').DataTable();
  } );
</script>

<script>
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
  
  
   $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
  
         //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]" placeholder="Insert admission no..." required/><a href="#" class="remove_field"><i class="fa fa-trash"></i></a></div>'); //add input box
            x++; 
    }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
       
    e.preventDefault(); 
    $(this).parent('div').remove(); 
    x--;
    })
});
  
  </script>




    <!-- custom js file link  -->
    <script src="js/script.js"></script>
    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
</html>
<?php 
  
?>