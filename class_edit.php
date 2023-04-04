<?php
error_reporting(0);
include('connection.php');
$action = $_GET['action'];
$path = 'class.php';

//ADD
if (isset($_POST['add'])) {
    $class = $_POST['class'];
    $stream = $_POST['stream'];
    if ($stream == 3) {
      $section = $_POST['section'];
      echo $section;
    } else {
      $section = 0 ;
    }
    $sql = "SELECT `class` FROM `tbl_class` where class = '$class' and stream = $stream";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header("Location: alert.php?action=copy&path=$path");
    } else {

        $sql = "SELECT `class_id` FROM `tbl_class` where stream = $stream ORDER BY `class_id` DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $class_id = $row['class_id'];
                $class_id = $class_id+1;
            }
        }elseif (empty($class_id)) {
            if ($stream == 1) {
                $class_id = 1; 
            } elseif ($stream == 2) {
                $class_id = 50;
            } elseif ($stream == 3) {
                $class_id = 100;
            }      
        } 

        $sql = "INSERT INTO `tbl_class` VALUES ($class_id,'$class',$stream,$section)";
        if ($conn->query($sql) === TRUE){  
            header("Location: alert.php?action=success&path=$path");
        } else {
            //header("Location: alert.php?action=fail&path=$path");
            echo 'fail';
        }
    }
}

//UPDATE
if (isset($_POST['update'])) {
    $id = $_GET['update_id'];
    $u_class = $_POST['class'];
    $u_stream = $_POST['stream'];
    if ($u_stream == 3) {
      $u_section = $_POST['section'];
    } else {
      $u_section = 0;
    }

    $sql = "SELECT * FROM tbl_class where class='$u_class' and stream = $u_stream";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //header("Location: alert.php?action=copy&path=$path");
        $sql="UPDATE `tbl_class` SET `class`='$u_class',`stream`=$u_stream,`sec_id`=$u_section  WHERE `class_id`=$id";
        echo $sql;
        if ($conn->query($sql) === TRUE) { 
            header("Location: alert.php?action=success&path=$path");
        } else {
            header("Location: alert.php?action=fail&path=$path");
        }
    } else {

        header("Location: alert.php?action=fail&path=$path");
        
    }
}

//DELETE
if ($action == 'delete_con') {
    $id = $_GET['delete_id'];
     $sql = "DELETE FROM tbl_class WHERE class_id = $id ";
    if ($conn->query($sql) === TRUE) {
        header("Location: alert.php?action=success&path=$path");
    } else {
        header("Location: alert.php?action=fail&path=$path");
    }
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
  <style type="text/css">
        body{
            background: #eee;
        }
        .sub_btn{
          margin-top: 1rem;
          display: inline-block;
          background: #A93226;
          color: #f9fafb;
          cursor: pointer;
          font-size: 15px;
          padding: 1rem 2rem;
        }
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

         header{
          background: #A93226;
        }
        body{
            background: #eee;
        }
        .sub_btn{
          margin-top: 1rem;
          display: inline-block;
          background: #A93226;
          color: #f9fafb;
          cursor: pointer;
          font-size: 14px;
          padding: .5rem 1rem;
        }
        .sub_btn:hover{
            color: #f9fafb;
            opacity: .8;
        }
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

         header{
          background: #A93226;
        }
        td, th{
          border: .5px solid gray;
        }
        td a{
          padding-left: 5px;
          padding-right: 5px;
        }
        th{
          justify-content: center;
          align-items: center;
          text-align: center;
        }
        td{
          background: white;
        }

        .form-floating .form-control {
            height: calc(4rem + 1px);
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
        .del_btn:hover {
          opacity: .8;
          color: white;
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
         .icon{
          color: #A93226;
          font-size: 15rem; 
          padding: 2rem;
        }
  </style>
</head>
<body>

    <?php
        include('connection.php');
    ?>
    
    <?php 
      if ($action == 'add') {
        include('heading.php');
    ?>
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 8rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                  <center><h1>Add Class</h1></center>
                  <hr>
                <form method="post" action="class_edit.php">
                    
                    <div class="row">
                        <div class="form-floating col-4 mt-4 mb-4">
                                <input type="text" class="form-control" id="class" placeholder="class" name="class" value="<?php echo $class; ?>" required>
                                <label for="class">Class</label>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-4">
                            <select class="form-select pt-0 pb-0 col-12" id="stream" name="stream" onchange="populate(this.id)" style="font-size: 14px;" >
                                <option value="0">---Stream---</option>
                                    <?php 
                                        $sql = "SELECT * from  tbl_stream  ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                    ?>
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['str_id']; ?>"><?php echo $row['stream']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                        </div>
                        <div class="d-none" id="section_s" style="width: 33%;" name="section_s">
                        <div class="form-floating mt-4 mb-4">
                            <select class="form-select pt-0 pb-0" id="section" name="section" style="font-size: 14px;" >
                                <option>Section</option>
                                    <?php 
                                        $sql = "SELECT * from  tbl_section  ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                    ?>
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['sec_id']; ?>"><?php echo $row['sec_name']; ?></option>
                                    <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                    <center><button type="submit" name="add" class="sub_btn">Add</button></center>
                </form>
            </div> 
        </div>

    <?php 
      } elseif ($action == 'update') {
        include('heading.php');
        $update_id = $_GET['update_id'];

        $sql = "SELECT `class` FROM `tbl_class` where class_id = $update_id  ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $class = $row['class'];
            }
        }
    ?>

        <!--UPDATE-->
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 8rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                  <center><h1>Update Class</h1></center>
                  <hr>
                <form method="post" action="class_edit.php?update_id=<?php echo $update_id; ?>">
                    
                    <div class="row">
                        <div class="form-floating col-4 mt-4 mb-4">
                                <input type="text" class="form-control" id="class" placeholder="class" name="class" value="<?php echo $class; ?>" required>
                                <label for="class">Class</label>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-4">
                            <select class="form-select pt-0 pb-0 col-12" id="stream" name="stream" onchange="populate(this.id)" style="font-size: 14px;" >
                                <option value="0">---Stream---</option>
                                    <?php 
                                        $sql = "SELECT * from  tbl_stream  ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                    ?>
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['str_id']; ?>"><?php echo $row['stream']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                        </div>
                        <div class="d-none" id="section_s" style="width: 33%;" name="section_s">
                        <div class="form-floating mt-4 mb-4">
                            <select class="form-select pt-0 pb-0" id="section" name="section" style="font-size: 14px;">
                                <option value="0">Section</option>
                                    <?php 
                                        $sql = "SELECT * from  tbl_section  ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                    ?>
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['sec_id']; ?>"><?php echo $row['sec_name']; ?></option>
                                    <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                    <center><button type="submit" name="update" class="sub_btn">Update</button></center>
                </form>
            </div> 
        </div>
    <?php 
      } elseif ($action == 'delete') {
        $id = $_GET['delete_id'];
    ?>
 
      <!--DELETE-->
      <div class="container" style="margin-top: 10rem;">
        <center>
          <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
            <center><i class="icon fas fa-exclamation-circle"></i></center>
            <div>
              <center>
                <h1 style="font-size: 35px; font-weight: 600;">Are you sure?</h1>
                <h4 class="mt-3">you won't be able to revert this!</h4>
              </center>
            </div>
            <div class="" style="height: auto; padding-top: 5rem;">
                <a class="del_btn" href="class_edit.php?action=delete_con&delete_id=<?php echo $id; ?>">Yes,Delete it!</a>
                <a class="del_btn" href="class.php" style="background: blue;">Cancel</a>
            </div>
          </div>
        </center> 
      </div>
  <?php 
    }
  ?>


                

<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
<script src="printThis.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable();
  } );
</script>
    <script>
        function populate(s1){
          
          var s1 = document.getElementById(s1);
          if (s1.value <= 2) {
            let section = document.getElementById('section_s');
                if (section.classList == 'd-block'){
                    section.classList.toggle('d-none');
                    section.classList.remove('d-block');
                } 
            } else if (s1.value == 3) {
                let section = document.getElementById('section_s');
                if (section.classList == 'd-none'){
                    section.classList.toggle('d-block');
                    section.classList.remove('d-none');
                } 
            }
        }


    </script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>



</body>
</html>
