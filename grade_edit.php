<?php
error_reporting(0);
include('connection.php');
$action = $_GET['action'];
$id = $_GET['update_id'];
$path = 'grade';

//UPDATE
if (isset($_POST['update'])) {
    $g_id = $_POST['g_id'];
    $u_grade = $_POST['grade'];
    $sec_tcr = $_POST['sec_tcr'];
    $u_stream = $_POST['stream'];

    $sql = "SELECT * FROM tbl_teacher_basic where nic='$sec_tcr'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $sql = "SELECT * FROM tbl_grade where sec_tcr_id='$sec_tcr'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            header("Location: alert.php?action=copy&path=$path");
        } else {

            $sql="UPDATE `tbl_grade` SET `sec_tcr_id`='$sec_tcr' WHERE `g_id`=$g_id";
            if ($conn->query($sql) === TRUE) { 
                header("Location: alert.php?action=success&path=$path");
            } else {
                header("Location: alert.php?action=fail&path=$path");
            }
        }

    } else {
        header("Location: alert.php?action=no_tcr&path=$path");
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

        if ($action == 'update') {
            include('heading.php'); 
    ?>
    
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 9rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                <center><h1>Update Grade</h1></center>
                <hr>
                <?php 
                    $sql = "SELECT * FROM tbl_grade where g_id=$id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) { 
                            $grade=$row['grade'];
                            $sec_tcr=$row['sec_tcr_id'];
                            $str_id = $row['stream'];
                        }
                    }
                ?>
                <form method="post" action="grade_edit.php">
                    <div class="row">
                        <input type="hidden" name="g_id" value="<?php echo $id; ?>">
                            <div class="form-floating col-4">
                                <input type="text" class="form-control" id="grade" placeholder="grade" name="grade" value="<?php echo $grade ?>" readonly>
                                <label for="grade">Grade</label>
                            </div>

                            <div class="form-floating  col-4">
                                <input type="text" class="form-control" id="sec_tcr" placeholder="sec_tcr" name="sec_tcr" value="<?php echo $sec_tcr; ?>" required>
                                <label for="sec_tcr">Incharge Teacher's NIC</label>
                            </div>

                            <div class="form-floating col-4">  
                                <?php 
                                    $sql = "SELECT * from  tbl_stream where str_id = $str_id ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) { 
                                            $stream = $row['stream'];
                                        }
                                    }
                                ?>
                                <input type="text" class="form-control" id="stream" placeholder="stream" name="stream" value="<?php echo $stream ?>" readonly>
                                <label for="stream">Stream</label>
                            </div>
                    </div> 
                    <center><input type="submit" name="update" class="sub_btn" value="Update"></center>
                </form>
                
            </div> 
        </div>
    <?php } ?>
        
<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
<script src="printThis.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable();
  } );
</script>
    

    <!-- custom js file link  -->
    <script src="js/script.js"></script>



</body>
</html>

