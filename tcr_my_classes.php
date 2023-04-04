<?php
error_reporting(0);
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


  </style>
</head>
<body>

    <?php
        include('heading.php'); 
        include('connection.php');

        //SELECT INCHARGE CLASS
        $sql = "SELECT tbl_tcr_class_incharge.g_id, tbl_class.class from tbl_tcr_class_incharge,tbl_class where tbl_tcr_class_incharge.class_id = tbl_class.class_id and tbl_tcr_class_incharge.tcr_id = $tcr_id"; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) { 
                    $incharge_class = $row['g_id'].'-'.$row['class'];
                }
            } else {
                $incharge_class = "Not set";
            }
        $date = date('Y-m-d');        
    ?>
    
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 9rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                  <center><h1>My Classes</h1></center>
                  <hr>
                  <div class="row col-12 mb-4">
                      <div class="incharge_class col-lg-3 col-sm-6 col-sm-6 col-6" style="background: #76bf76f7; padding: 10px; border-radius: 10px;">
                          <span class="col-6" style="font-size: 13px;">Incharge Class : </span><span class="col-6" style="font-size: 13px; margin-left: 30px;"><b><?php echo $incharge_class; ?></b></span>
                      </div>
                      <button class="ml-4 col-lg-1 col-sm-2 col-sm-2 col-xs-2 col-2" style="background: #d46f6f; margin-left: 12px; padding: 10px; border-radius:10px; font-size: 13px;" onclick="window.location.href='tcr_incharge_edit.php'">Edit</button>
                      <?php 
                        $sql = "SELECT tbl_tcr_class_request.g_id, tbl_class.class FROM tbl_tcr_class_request, tbl_class  WHERE tbl_tcr_class_request.class_id = tbl_class.class_id and tcr_id = $tcr_id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { 
                                $class = $row['g_id'].'-'.$row['class'];
                            }
                         ?>
                        <span style="padding-top:10px; margin-left:10px; font-size:14px; color: orange; font-weight:600;" class="col-2 ml-5"><i class="fas fa-exclamation-triangle"></i> Pending for <?php echo $class; ?> </span>
                      <?php } else{ ?>
                        <span style="padding-top:10px; margin-left:10px; font-size:14px; color: green; font-weight:600;" class="col-2 ml-5"><i class="fas fa-check-circle"></i> Accepted</span>
                      <?php } ?>
                    </div>
                  <div class="row">
                    <center>
                        <button class="col-lg-2" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px; margin:5px; font-size: 13px" onclick="window.location.href='tcr_my_class_edit.php?action=add';"><i class="fas fa-user-plus"></i> Add Class</button>
                        <button class="col-lg-2" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px; margin:5px; font-size: 13px" onclick="window.location.href='tcr_my_class_edit.php?action=update&update_id=<?php echo $tcr_id; ?>';"><i class="fas fa-user-plus"></i> Update Class</button>
                    </center>
                  </div>
                  <form>
                    <?php 
                        $sql = "SELECT tbl_teacher_class.*, tbl_subject.subject, tbl_class.class FROM tbl_teacher_class, tbl_subject, tbl_class where tbl_teacher_class.sub_id = tbl_subject.sub_id and tbl_teacher_class.class_id = tbl_class.class_id and tbl_teacher_class.tcr_id = $tcr_id ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $grade = $row['g_id'];
                                $class = $row['class'];
                                $subject = $row['subject'];
                    ?>
                                <div class="row">
                                    <div class="form-floating mb-4 mt-4 pl-4 col-5">
                                        <input type="text" class="form-control" id="f_name" placeholder="f_name" name="f_name" value="<?php echo $grade.'-'.$class; ?>" disabled>
                                        <label for="f_name">Class</label>
                                    </div>
                                    <div class="form-floating mb-4 mt-4 pl-4 col-2">
                                        <center><span style="position: absolute; padding-top: 1rem;"><i class="fas fa-arrow-right" style="font-size: 24px;"></i></span></center>
                                    </div>
                                    <div class="form-floating mb-4 mt-4 pl-4 col-5">
                                        <input type="text" class="form-control" id="sub" placeholder="sub" name="sub" value="<?php echo $subject; ?>" disabled>
                                        <label for="sub">Subject</label>
                                    </div>
                                </div>
                    <?php }} ?>
                  </form>

                
            </div> 
        </div>
        <?php 
            if (isset($_POST['submit'])) {
                $sql = $sql_query;
                $result = $conn->query($sql);
        ?>
        <!--<center style="margin-bottom: 80px;">
            <div class="dataTables_wrapper" style="width: 100%; font-size: 1.5rem; border-top: 2px solid #A93226; padding: 20px; background: white;"> 
                <center>
                    <button id="print" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="far fa-file-pdf"></i> print</button>
                </center>
        <?php if ($result->num_rows > 0) { ?>
                  <table id="table" class="display" style="padding: 1rem;">
                    <thead>
                      <tr id="header" style="background:#eee; color:#A93226;">
                                          
                        <th>Teacher No.</th>
                        <th>Full Name</th>
                        <th>NIC</th>
                        <th>Salary No.</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()) { 
                                    $id = $row['id']; ?>

                      <tr>
                        <td style="background: white;"><?php echo $row['tcr_no'] ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['nic']; ?></td>
                        <td><?php echo $row['salary_no']; ?></td>
                        <td><?php echo $row['tp_mobile']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                          <center>
                            <a href="student_profile.php?profile_id=<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></a>
                            <a href="student_update.php?update_id=<?php echo $row['id'] ?>"><i class="fas fa-user-edit pr-3 pl-3"></i></a>
                            <a style="color: red;" href="student_delete.php?delete_id=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></a>
                          </center>
                        </td>
                      </tr>
                            
                    <?php } ?>
                    </tbody>

                  </table>
                </center>
                <?php } ?>
            </div>
        </center> -->   
      <?php } ?>


                

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
