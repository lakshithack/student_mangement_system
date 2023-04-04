<?php
error_reporting(0);
include('connection.php');

if (isset($_POST['submit'])) {
    $grade = $_POST['grade'];
    $class = $_POST['class'];
    $section = $_POST['section'];

    if ($grade > 0 and $class==0 and $section==0) {

        $sql_query = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.g_id = $grade and tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";

    } else if ($grade == 0 and $class==0 and $section > 0) {

        $sql_query = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.section_id = $section and tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";

    } else if ($grade > 0 and $class > 0 and $section==0) {

        $sql_query = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.g_id = $grade and tbl_student.class_id = $class and tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";

    } else if ($grade > 0 and $class > 0 and $section > 0) {

        $sql_query = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.g_id = $grade and tbl_student.class_id = $class and tbl_student.section_id = $section and tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";
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
        include('heading.php'); 
        include('connection.php');

        $sql = "SELECT class from tbl_class ORDER BY class_id ASC ";
        $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
                    $class_id = $row['class'];
                    
           } 
        }
    ?>
    
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 8rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                  <center><h1>Advanced Search</h1></center>
                  <hr>
                <form method="post" action="stu_advanced_search.php">
                    
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
                        <div class="d-block" id="section_s" style="width: 33%;" name="section_s">
                        <div class="form-floating mt-4 mb-4">
                            <?php 
                                $sql = "SELECT * from tbl_section where sec_id>0";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                            ?>
                            <select class="form-select pt-0 pb-0" id="section" name="section" style="font-size: 14px;">
                                <option value="0">Section</option>
                                <?php while($row = $result->fetch_assoc()) { ?>
                                <option value="<?php echo $row['sec_id']; ?>"><?php echo $row['sec_name']; ?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="sub_btn">Submit</button>
                </form>
            </div> 
        </div>
        <?php 
            if (isset($_POST['submit'])) {
                $sql = $sql_query;
                $result = $conn->query($sql);
        ?>
        <center>
            <div class="dataTables_wrapper pt-5" style="width: 95%; font-size: 1.5rem"> 
                <!--<center>
                    <button id="print" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="far fa-file-pdf"></i> print</button>
                </center>--->
                <?php if ($result->num_rows > 0) { ?>
                  <table id="table" class="display" style="padding: 1rem;">
                    <thead>
                      <tr id="header" style="background:#eee; color:#A93226;">
                                          
                        <th>Admission No.</th>
                        <th>Name</th>
                        <th>Grade</th>
                        <th>Class</th>
                        <th>Date Of Birth</th>
                        <th>Telephone</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()) { 
                                    $id = $row['id']; ?>

                      <tr>
                        <td style="background: white;"><?php echo $row['admission'] ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        <td><?php echo $row['class']; ?></td>
                        <td><?php echo $row['dob']; ?></td>
                        <td><?php echo $row['tp_mobile']; ?></td>
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
                <?php } ?>
            </div>
        </center>
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
