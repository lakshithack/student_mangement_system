<?php
error_reporting(0);
include('connection.php');
$action = $_GET['action'];
$tcr_id = $_GET['tcr_id'];
echo 'tcr'.$tcr_id;

        //SUBMIT
        if (isset($_POST['tcr_add_sub'])) {
            $sub = $_POST['tsubject'];
            $tcr_id_sub = $_POST['tcr_id_sub'];

            //CHECK COPIES
            $sql = "SELECT * from  tbl_teacher_$action where tcr_id = $tcr_id_sub and sub_id=$sub ";
            echo $sql;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
               header("location:tcr_add_sub_2.php?action=copy");
            } else {
                //ADD TO THE DATABASE
                $sql = "INSERT INTO `tbl_teacher_$action` values($tcr_id_sub,$sub)";
                if ($conn->query($sql) === TRUE){
                    header("location:tcr_add_sub_2.php?action=success");
                } else {
                    header("location:tcr_add_sub_2.php?action=fail");
                }
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


  </style>
</head>
<body>

    <?php
        include('heading.php'); 
        include('connection.php');
        
    ?> 
    
        <div class="p-4" style="width: 100%; background: white; height: auto; margin-top: 9rem;">
            <div class="form-body container mt-3 col-lg-8 col-md-10">
                <center><h1>Add Subject</h1></center>
                <hr>
                <form method="post" action="tcr_add_sub.php?action=<?php echo $action; ?>">
                    <div class="row">
                        <center>
                            <div class="form-floating mt-4 mb-4 col-5">   
                                <select class="form-select pt-0 pb-0" id="tsubject" name="tsubject" style="font-size: 14px;" required>
                                    <option value="">--Subject--</option>
                                    <?php 
                                        $sql = "SELECT * from  tbl_subject where stream = 1 ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                    ?>
                                    <?php while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['sub_id']; ?>"><?php echo $row['subject']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php } ?>
                            </div>
                        </center>
                        <input type="hidden" name="tcr_id_sub" value="<?php echo $tcr_id ?>">
                    </div> 
                    <center><input type="submit" name="tcr_add_sub" class="sub_btn" value="Add"></center>
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
    

    <!-- custom js file link  -->
    <script src="js/script.js"></script>



</body>
</html>

