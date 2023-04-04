<?php 
  include('connection.php'); 

  if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $path = 'cls_incharge_req.php';

    if ($action == 'accept') {
        $id = $_GET['update_id'];

        //GET INFORMATION FROM THE DATABASE
        $sql="SELECT g_id,class_id FROM tbl_tcr_class_request WHERE tcr_id = $id ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $g_id = $row['g_id'];
            $class_id = $row['class_id'];
          }
        }

        $sql="UPDATE tbl_tcr_class_incharge SET g_id=$g_id, class_id=$class_id WHERE tcr_id = $id ";
        if ($conn->query($sql) === TRUE) {
          header("Location: alert.php?action=success&path=$path");   
        } else {
          header("Location: alert.php?action=fail&path=$path");
        }

        $sql = "DELETE FROM tbl_tcr_class_request WHERE tcr_id = $id";
        if ($conn->query($sql) === TRUE) {
          header("Location: alert.php?action=success&path=$path");   
        } else {
          header("Location: alert.php?action=fail&path=$path");
        }

    } elseif ($action == 'reject') {
        $id = $_GET['reject_id'];

        $sql = "DELETE FROM tbl_tcr_class_request WHERE tcr_id = $id";
        if ($conn->query($sql) === TRUE) {
          header("Location: alert.php?action=success&path=$path");   
        } else {
          header("Location: alert.php?action=fail&path=$path");
        }
    }

  }
?>

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
        }
        td a{
          color: white;
          font-size: 10px;
          text-decoration: none;
          background: green;
          padding: 8px;
          border-radius: .6rem;
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

      
          <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 9rem;">
            <?php 
              

              $sql = "SELECT tbl_teacher_basic.nic, tbl_tcr_class_request.req_date, tbl_teacher_basic.tcr_id, tbl_teacher_basic.full_name, tbl_grade.grade, tbl_class.class FROM tbl_tcr_class_request, tbl_teacher_basic, tbl_grade, tbl_class where tbl_teacher_basic.tcr_id=tbl_tcr_class_request.tcr_id and tbl_grade.g_id = tbl_tcr_class_request.g_id and tbl_class.class_id=tbl_tcr_class_request.class_id";
              $result = $conn->query($sql);
            ?>
            <center>
              <div class="dataTables_wrapper" style="width: 99%; font-size: 1.5rem"> 
                <h1 class="mb-5" style="font-size: 30px;">Class Incharge Requests</h1>
                <center>
                </center>

                <?php if ($result->num_rows > 0) { ?>
                  <table id="table1" class="display" style="padding: 1rem;">
                    <thead>
                      <tr id="header" style="background:#eee; color:#A93226;">                  
                        <th>NIC</th>
                        <th>Name</th>
                        <th>Request for</th>
                        <th>Request date</th>
                        <th>action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_assoc()) {  ?>
                      <tr>
                        <td style="background: white;"><?php echo $row['nic'] ?></td>
                        <td style="background: white;"><?php echo $row['full_name'] ?></td>
                        <td style="background: white;"><?php echo $row['grade'].'-'.$row['class']; ?></td>
                        <td style="background: white;"><?php echo $row['req_date'] ?></td>
                        <td>
                          <center>
                            <a href="cls_incharge_req.php?action=accept&update_id=<?php echo $row['tcr_id'] ?>">Accept</a>
                            <a style="background: #A93226;" href="cls_incharge_req.php?action=reject&reject_id=<?php echo $row['tcr_id'] ?>">Reject</a>
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