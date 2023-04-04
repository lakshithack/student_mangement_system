
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
  <link rel="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
  <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>

    <title>Homepage</title>
    <style type="text/css">
        body{
            background: #eee;
        }
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');

         header{
          background: #A93226;
        }
        .dyn_tab button{
          color: #A93226;
          font-weight: 600;
          width: 33.33%;
        }
        .dyn_tab button:hover{
          color: black;
        }

        td, th{
          border: .5px solid gray;
          padding: 5px;
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
    <body>
        <?php 
            include('heading.php');

            if ($_SESSION['position']==0){ 
        ?>

      <!--DYNAMIC TABS--->
      <nav style="margin-top: 6rem; font-size: 17px;">
        <div class="nav nav-tabs dyn_tab" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">6-9</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">O/L</button>
          <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">A/L</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 0rem;">
            <?php 
              include('connection.php'); 

              $sql = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.streamid = 1 and tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";
              $result = $conn->query($sql);
            ?>
            <center>
              <div class="dataTables_wrapper" style="width: 99%; font-size: 1.5rem"> 
                <h1 class="mb-5" style="font-size: 30px;">Students | 6-9</h1>
                <center>
                  <a href="student_insert.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-user-plus"></i> Add Student</a>
                  <a href="stu_advanced_search.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-search"></i> Advanced Search</a>
                  <a href="stu_bulk_update.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-edit"></i> Bulk Update</a>
                </center>

                <?php if ($result->num_rows > 0) { ?>
                  <table id="table1" class="display" style="padding: 1rem;">
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
          </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 0rem;">
            <?php 
              include('connection.php'); 

              $sql = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.streamid = 2 and tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";
              $result = $conn->query($sql);
            ?>
            <center>
              <div class="dataTables_wrapper" style="width: 99%; font-size: 1.5rem"> 
                <h1 class="mb-5" style="font-size: 30px;">Students | O/L</h1>
                <center>
                  <a href="student_insert.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-user-plus"></i> Add Student</a>
                  <a href="stu_advanced_search.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-search"></i> Advanced Search</a>
                </center>

                <?php if ($result->num_rows > 0) { ?>
                  <table id="table2" class="display" style="padding: 1rem;">
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
          </div>
        </div>


        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
          <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 0rem;">
            <?php 
              include('connection.php'); 

              $sql = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.streamid = 3 and tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";
              $result = $conn->query($sql);
            ?>
            <center>
              <div class="dataTables_wrapper" style="width: 99%; font-size: 1.5rem"> 
                <h1 class="mb-5" style="font-size: 30px;">Students | A/L</h1>
                <center>
                  <a href="student_insert.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-user-plus"></i> Add Student</a>
                  <a href="stu_advanced_search.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-search"></i> Advanced Search</a>
                </center>

                <?php if ($result->num_rows > 0) { ?>
                  <table id="table3" class="display" style="padding: 1rem;">
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
          </div>
        </div>
      </div>
    <?php } ?>
    <!--FOR TEACHERS-->
      <?php 
      if ($_SESSION['position']==1) { ?>
        <!--DYNAMIC TABS--->
      <nav style="margin-top: 6rem; font-size: 17px;">
        <div class="nav nav-tabs dyn_tab" id="nav-tab" role="tablist">
          <button style="width:50%;" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Class Students</button>
          <button style="width:50%;" class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Overview</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 0rem;">
            <?php 
              include('connection.php'); 

              $sql = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id and tbl_student.g_id=$incharge_grade and tbl_student.class_id=$incharge_class";
              $result = $conn->query($sql);
            ?>
            <center>
              <div class="dataTables_wrapper" style="width: 99%; font-size: 1.5rem"> 
                <h1 class="mb-5" style="font-size: 30px;">Students | <?php echo $incharge_grade.'-'.$incharge_class_name ?></h1>
                  <div class="row justify-content-center mb-4">
                      <div class="col-6 col-lg-2 pt-5 p-0">
                        <a href="student_insert.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-user-plus"></i> Add Student</a>
                      </div>
                      <div class="col-6 col-lg-2 pt-5 p-0">
                        <a href="stu_advanced_search.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-search"></i> Advanced Search</a>
                      </div>
                      <div class="col-6 col-lg-2 pt-5 p-0">
                        <a href="stu_advanced_search.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-edit"></i> Bulk Update</a>
                      </div>
                  </div>
                <?php if ($result->num_rows > 0) { ?>
                  <center><table id="table1" class="display" style="padding: 1rem 1rem 1rem 0;">
                    <thead>
                      <tr id="header" style="background:#eee; color:#A93226;">
                                          
                        <th>Admission No.</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()) { 
                                    $id = $row['id']; ?>

                      <tr>
                        <td style="background: white;"><?php echo $row['admission'] ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['grade'].'-'.$row['class']; ?></td>
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

                  </table></center>
                <?php } ?>
              </div> 
            </center>
          </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 0rem;">
            <?php 
              include('connection.php'); 

              $sql = "SELECT tbl_student.id,tbl_student.admission,tbl_student.full_name,tbl_student.tp_mobile,tbl_student.dob,tbl_class.class,tbl_grade.grade from tbl_student, tbl_class, tbl_grade WHERE tbl_student.class_id=tbl_class.class_id and tbl_student.g_id=tbl_grade.g_id";
              $result = $conn->query($sql);
            ?>
            <center>
              <div class="dataTables_wrapper" style="width: 99%; font-size: 1.5rem"> 
                <h1 class="mb-5" style="font-size: 30px;">Students Overview</h1>
                <div class="row justify-content-center mb-4">
                      <div class="col-12 p-sm-5 pt-5 p-0">
                        <a href="stu_advanced_search.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-search"></i> Advanced Search</a>
                      </div>
                </div>

                <?php if ($result->num_rows > 0) { ?>
                  <table id="table2" class="display" style="padding: 1rem 0;">
                    <thead>
                      <tr id="header" style="background:#eee; color:#A93226;">
                                          
                        <th>Admission No.</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()) { 
                                    $id = $row['id']; ?>

                      <tr>
                        <td style="background: white;"><?php echo $row['admission'] ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['grade'].'-'.$row['class']; ?></td>
                        <td>
                          <center>
                            <a href="student_profile.php?profile_id=<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></a>
                          </center>
                        </td>
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

      <?php } ?> 

        

<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
<script src="printThis.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#table1').DataTable();
  } );
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table2').DataTable();
  } );
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table3').DataTable();
  } );
</script>


    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    </body>
</html>