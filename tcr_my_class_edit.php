<?php
error_reporting(1);
include('connection.php');
$action = $_GET['action'];
$path = 'tcr_my_classes.php';

//ADD
if (isset($_POST['add'])) {
    $tcr_id = $_POST['tcr_id'];
    $grade = $_POST['grade'];
    $class = $_POST['class'];
    $subject = $_POST['subject'];

    //SEARCH DUPLICATES
    $sql = "SELECT * FROM `tbl_teacher_class` WHERE `tcr_id`=$tcr_id AND `g_id`=$grade AND `class_id`=$class AND sub_id=$subject" ;
    echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header("Location: alert.php?action=copy&path=$path");
    } else {

        $sql = "INSERT INTO `tbl_teacher_class` VALUES ($tcr_id,$grade,$class,$subject)";
        echo $sql;
        if ($conn->query($sql) === TRUE){  
            header("Location: alert.php?action=success&path=$path");
        } else {
            header("Location: alert.php?action=fail&path=$path");
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
    $id = $_GET['d_id'];
    $grade = $_GET['g'];
    $class_id = $_GET['c'];
    $sub_id = $_GET['s'];
    $path = 'tcr_my_class_edit.php?action=update&update_id=$id';
     $sql = "DELETE FROM tbl_teacher_class WHERE tcr_id = $id and g_id=$grade and class_id=$class_id and sub_id=$sub_id ";
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
          text-decoration: none;
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
                <form method="post" action="tcr_my_class_edit.php">
                    <input type="hidden" name="tcr_id" value="<?php echo $tcr_id; ?>">
                    <div class="row">
                        <div class="form-floating mt-4 mb-4 col-4">
                            <?php 
                                $sql = "SELECT * from tbl_grade";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                            ?>
                            <select class="form-select pt-0 pb-0 col-12" id="grade" name="grade" onchange="populate(this.id,'class')" style="font-size: 14px;" >
                                <option value="0">Grade</option>
                                <?php while($row = $result->fetch_assoc()) { ?>
                                <option value="<?php echo $row['g_id']; ?>"><?php echo $row['grade']; ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-4">
                            <select class="form-select pt-0 pb-0" id="class" name="class" style="font-size: 14px;" >
                                <option value="0">Class</option>
                            </select>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-4">   
                                <select class="form-select pt-0 pb-0" id="subject" name="subject" style="font-size: 14px;" required>
                                    <option value="">--Subject--</option>
                                    <?php 
                                        $sql = "SELECT * from  tbl_subject where stream = $tcr_stream ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                    ?>
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['sub_id']; ?>"><?php echo $row['subject']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
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
    ?>

        <!--UPDATE-->
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 8rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                <center><h1>Update Class</h1></center>
                <hr>
                <?php 
                    $sql = "SELECT tbl_teacher_class.*, tbl_subject.subject, tbl_class.class FROM tbl_teacher_class, tbl_subject, tbl_class where tbl_teacher_class.sub_id = tbl_subject.sub_id and tbl_teacher_class.class_id = tbl_class.class_id and tbl_teacher_class.tcr_id = $tcr_id ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                                $grade = $row['g_id'];
                                $class_id = $row['class_id'];
                                $class = $row['class'];
                                $sub_id = $row['sub_id'];
                                $subject = $row['subject'];
                ?>
                                <div class="row">
                                    <div class="form-floating mb-4 mt-4 pl-4 col-5">
                                        <input type="text" class="form-control" id="f_name" placeholder="f_name" name="f_name" value="<?php echo $grade.'-'.$class; ?>" disabled>
                                        <label for="f_name">Class</label>
                                    </div>
                                    <div class="form-floating mb-4 mt-4 pl-4 col-1">
                                        <center><span style="position: absolute; padding-top: 1rem;"><i class="fas fa-arrow-right" style="font-size: 24px;"></i></span></center>
                                    </div>
                                    <div class="form-floating mb-4 mt-4 pl-4 col-5">
                                        <input type="text" class="form-control" id="sub" placeholder="sub" name="sub" value="<?php echo $subject; ?>" disabled>
                                        <label for="sub">Subject</label>
                                    </div>
                                    <div class="col-1" style="padding: 25px 10px;">
                                        <a style="color:red; font-size: 13px;" href="tcr_my_class_edit.php?action=delete_con&d_id=<?php echo $tcr_id;?>&g=<?php echo $grade;?>&c=<?php echo $class_id;?>&s=<?php echo $sub_id;?>"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                    <?php }} ?>
            </div> 
            <center><a href="tcr_my_classes.php" class="sub_btn">Ok</a></center>
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
        function populate(s1,s2){
          var s1 = document.getElementById(s1);
          var s2 = document.getElementById(s2);
          s2.innerHTML = "";
          if(s1.value < 10){
            var optionArray = [" 0|Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id <= 6 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
          } else if(s1.value < 12){
            var optionArray = [" 0|Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id <= 6 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
          } else if(s1.value > 11){
            var optionArray = [" 0|Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id >= 100 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
          } 

          for(var option in optionArray){
            var pair = optionArray[option].split("|");
            var newOption = document.createElement("option");
            newOption.value = pair[0];
            newOption.innerHTML = pair[1];
            s2.options.add(newOption);
          }

          if (s1.value <= 11) {
            let section = document.getElementById('section_s');
                if (section.classList == 'd-block'){
                    section.classList.toggle('d-none');
                    section.classList.remove('d-block');
                }
            } else if (s1.value > 11) {
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
