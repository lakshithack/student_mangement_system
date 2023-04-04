
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <title>Homepage</title>
    <style type="text/css">
        body{
            background: #eee;
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
    <body>
        <?php 
            include('heading.php');
        ?>

        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 8rem;">
          <?php 
            include('connection.php'); 

            $sql = "SELECT tbl_result.*, tbl_student.*, tbl_class.class from tbl_result, tbl_student, tbl_class where tbl_student.admission=tbl_result.admission and tbl_class.class_id = tbl_student.class_id";
            $result = $conn->query($sql);
          ?>
              <center>
                  <div class="dataTables_wrapper" style="width: 95%; font-size: 1.5rem">  
                    <h1 class="mb-5" style="font-size: 26px;"><i class="fas fa-file" title="Edit Mode"></i> Exam Results</h1>
                    <center>
                        <a href="result_insert.php" style="background: #f1d6d6; color: black; text-decoration: none; padding: 10px; border-radius: 10px;"><i class="fas fa-user-plus"></i> Add Result</a>
                    </center>
                  <?php if ($result->num_rows > 0) { ?>

                        <table id="table" class="display" style="margin-top: 2rem;">
                          <thead>
                                <tr id="header" style="background:#eee ;color:#A93226;">
                                  
                                  <th>Admission</th>
                                  <th>Name</th>
                                  <th>Class</th>
                                  <th>Total</th>
                                  <th>Place</th>
                                  <th>Action</th>

                                </tr>
                          </thead>
              
                  <?php while($row = $result->fetch_assoc()) { 
                            $id = $row['id']; ?>
                            <tbody>
                              <tr>
                                  <td style="background: white;"><?php echo $row['admission'] ?></td>
                                  <td><?php echo $row['full_name']; ?></td>
                                  <td><?php echo $row['g_id'].'-'.$row['class'];; ?></td>
                                  <td><?php echo $row['tp_mobile']; ?></td>
                                  <td><?php echo $row['tp_mobile']; ?></td>
                                  <td>
                                    <center>
                                      <a href="student_profile.php?profile_id=<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></a>
                                      <a href="student_update.php?update_id=<?php echo $row['id'] ?>"><i class="fas fa-user-edit pr-3 pl-3"></i></a>
                                      <a href="student_delete.php?delete_id=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></a>
                                    </center>
                                  </td>
                              </tr>
                             
                          </tbody>
                    
                  <?php } ?>

                  </table>
                </div>

              </center>
        <?php } ?>
        </div>

<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable();
} );
</script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    </body>
</html>