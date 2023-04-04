<?php 
error_reporting(1);
$action = $_GET['action'];
$path='student_overview.php';
include('connection.php');
?>
<!DOCTYPE html>
<html>
<head>
      <title>RDCC  | Homepage</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
      <style type="text/css">
        body{
          background: #eee;
        }
        .icon{
          color: #A93226;
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
      </style>
</head>
<body>

<?php if (isset($action)) { 
    $sql = "DELETE FROM tbl_student WHERE g_id = 14";
    if ($conn->query($sql) === TRUE) {
        //$x = 'success';
    }
    $x = 13;
    while ($x>=6) {
            $y = $x+1;
            $sql="UPDATE `tbl_student` SET `g_id`= $y  WHERE `g_id`=$x";
            echo $sql;
            if ($conn->query($sql) === TRUE) { 
                //header("Location: student_overview.php");
            }
            $x=$x-1; 
    }
    header("Location: alert.php?action=success&path=$path"); 
} else {  ?>
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
              <a class="del_btn" href="stu_bulk_update.php?action=update">Yes,Update</a>
              <a class="del_btn" href="student_overview.php" style="background: blue;">Cancel</a>
          </div>
        </div>
      </center>
    </div>
<?php } ?>
    

    <!--table row click function--->
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
    </script>
</body>

</html>    