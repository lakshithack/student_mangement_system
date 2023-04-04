<?php
error_reporting(0);
include('connection.php');
$path = 'tcr_my_classes.php';

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
  </style>
</head>
<body>

    <?php

        //SUBMIT VALUE
        if (isset($_POST['submit'])) {
            $id = $_POST['tcr_id'];
            $grade = $_POST['grade'];
            $class = $_POST['class'];
            $date = date('Y-m-d');  

            $sql = "SELECT * from tbl_tcr_class_request where tcr_id = $id  ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $sql="UPDATE tbl_tcr_class_request SET g_id=$grade,class_id=$class WHERE tcr_id = $id ";
                if ($conn->query($sql) === TRUE) {
                    header("Location: alert.php?action=success&path=$path");   
                } else {
                    header("Location: alert.php?action=fail&path=$path");
                }
            } else {
                $sql="INSERT INTO `tbl_tcr_class_request` VALUES ($id,$grade,$class,'$date')";
                if ($conn->query($sql) === TRUE) {
                    header("Location: alert.php?action=success&path=$path");
                } else {
                     header("Location: alert.php?action=fail&path=$path");
                }
            }

        }

        $sql = "SELECT class from tbl_class ORDER BY class_id ASC ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
                    $class_id = $row['class'];
                    
           } 
        }
    ?>
        <?php include('heading.php'); ?>
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 8rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                  <center><h1>Incharge Class</h1></center>
                  <hr>
                <form method="post" action="tcr_incharge_edit.php">
                    
                    <div class="row">
                        <input type="hidden" name="tcr_id" value="<?php echo $tcr_id; ?>">
                        <div class="form-floating mt-4 mb-4 col-6">
                            <select class="form-select pt-0 pb-0 col-12" id="grade" name="grade" onchange="populate(this.id,'class')" style="font-size: 14px;" required >
                                <option value="">Grade</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                 <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                            </select>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-6">
                            <select class="form-select pt-0 pb-0" id="class" name="class" style="font-size: 14px;" required >
                                <option value="">Class</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="sub_btn">Submit</button>
                </form>
            </div> 
        </div>
                

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
