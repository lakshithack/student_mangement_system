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
<?php  
	include('connection.php');

				$sql = "SELECT `id` FROM `tbl_student` ORDER BY `id` DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $s_id = $row['id'];
                $s_id = $s_id+1;
            }
        }elseif (empty($s_id)) {
            $s_id = 1;
        }          

	
	$f_name = $_POST['f_name'];
	$i_name = $_POST['i_name'];
	$admission = $_POST['admission'];
	$nic = $_POST['nic'];
	$mobile = $_POST['mobile'];
	$address = $_POST['address'];
	$dob = $_POST['dob'];
	$grade = $_POST['grade'];
	$gender = $_POST['gender'];
	$class_id = $_POST['class'];
	$gs_zone = $_POST['gs_zone'];
	$par_fname = $_POST['par_fname'];
	$par_nic = $_POST['par_nic'];
	$par_mobile = $_POST['par_mobile'];
	$lan = $_POST['lan'];
	$par_position = $_POST['par_position'];
	$par_gender = $_POST['par_gender'];

	//select stream and section
	if ($grade < 10 ) {
		$stream = 1;
		$section_id = 'none';
	} else if ($grade < 12 and $grade > 9 ) {
		$stream = 2;
		$section_id = 'none';
	} else if ($grade >= 12 ) {
		$stream = 3;
		$section_id = $_POST['section'];
	}


	echo 'section'.$section_id;

	$sql = "INSERT INTO `tbl_student` VALUES ($s_id,$admission,'$nic','$i_name','$f_name','$dob','$address','$mobile','$gs_zone','$gender','$stream','$section_id',$grade,$class_id)";

    if ($conn->query($sql) === TRUE){
    	$sql = "INSERT INTO tbl_parent VALUES($s_id,'$par_nic','$par_fname','$par_mobile','$lan','$par_position','$par_gender')";
    	if ($conn->query($sql) === TRUE){ ?>

    		<div class="container" style="margin-top: 10rem;">
		      <center>
		        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
		          <center><i class="icon far fa-check-circle " style="color: green;"></i></center>
		          <div>
		            <center>
		              <h1 style="font-size: 35px; font-weight: 600;">Success</h1>
		              <h4 class="mt-3">Student Details added to database.</h4>
		            </center>
		          </div>
		        </div>
		      </center>
		    </div>

    		<?php header( "refresh:2;url=student_overview.php");
		} else { ?>
	    	<div class="container" style="margin-top: 10rem;">
		      <center>
		        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
		          <center><i class="icon fas fa-exclamation-triangle" style="color:#A93226;"></i></i></center>
		          <div>
		            <center>
		              <h1 style="font-size: 35px; font-weight: 600;">Something went wrong!</h1>
		              <h4 class="mt-3"><?php echo $conn->error; ?></h4>
		            </center>
		          </div>
		        </div>
		      </center>
		    </div>

	    	
	    	<?php header( "refresh:2;url=teacher.php");
		}
	} else { ?>
	    	<div class="container" style="margin-top: 10rem;">
		      <center>
		        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
		          <center><i class="icon fas fa-exclamation-triangle" style="color:#A93226;"></i></i></center>
		          <div>
		            <center>
		              <h1 style="font-size: 35px; font-weight: 600;">Something went wrong!</h1>
		              <h4 class="mt-3"><?php echo $conn->error; ?></h4>
		            </center>
		          </div>
		        </div>
		      </center>
		    </div>
	    	
	    	<?php header( "refresh:2;url=teacher.php");
		}
?>

</body>
</html>