
<?php 
	$id = $_GET['profile_id'];

	include('connection.php'); 

  $sql = "SELECT tbl_student.*, tbl_class.*, tbl_section.*, tbl_stream.* FROM tbl_student, tbl_class, tbl_section, tbl_stream where tbl_student.id = $id and tbl_class.class_id = tbl_student.class_id and tbl_section.sec_id = tbl_student.section_id and tbl_stream.str_id=tbl_student.streamid";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        $nic =  $row['nic'];
	        $f_name = $row['full_name'];
	        $i_name = $row['name_with_int'];
	        $admission = $row['admission'];
	        $dob = $row['dob'];
	        $address = $row['address'];
	        $g_id = $row['g_id'];
	        $class = $row['class'];
	        $mobile = $row['tp_mobile'];
	        $gs_zone = $row['gs_zone'];
	        $gender = $row['gender'];
	        $stream = $row['stream'];
	        $section = $row['sec_name'];
	        /*$par_nic = $row['par_nic'];
	        $par_fname = $row['f_name'];
	        $par_mobile = $row['mobile'];
	        $par_lan = $row['tp_lan'];
	        $par_gender = $row['par_gender'];
	        $par_position =  $row['position'];	*/

	    }
	}

	$sql = "SELECT tbl_parent.* from tbl_parent, tbl_student where tbl_student.id = $id and tbl_parent.s_id = tbl_student.id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        $par_nic = $row['par_nic'];
	        $par_fname = $row['f_name'];
	        $par_mobile = $row['mobile'];
	        $par_lan = $row['tp_lan'];
	        $par_gender = $row['par_gender'];
	        $par_position =  $row['position'];	

	    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8">
      <title>RDCC  | Homepage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
      <!--Customer-link-->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
      <style type="text/css">
      	header{
          background: #A93226;
        }
        span{
        	background: yellow;
			    width: 50px;
			    height: 25px;
			    padding: 5px;
        }
        td{
        	width: 50%;
        	font-size: 16px;
        	padding: 5px;
        }
        .span_back{
        	background: whitesmoke;
        	margin-top: 4px;
    			position: fixed;
        }
        .span_back a{
        	font-size: 12px;
        	color: black;
        	text-decoration: none;
        }
      </style>
</head>
<body>
	<?php include('heading.php'); ?>
	<div class="container-fluid" style="margin-top: 5rem;">
		<div class="row" style="margin-top: 1rem;">
			<div class="col-3" style = "height: 93rem; background: #f1d6d6;">
				<span class="span_back"><a href="student_overview.php"><i class="fas fa-angle-left"></i> Back</a></span>
				<center><img class="mt-4" src="images/profile.jpg" style="width: 250px; height: 250px; padding-top: 2rem;"></center>
			</div>
			<div class="col-9" style="background: white; height: 400px; padding-top: 2rem;">

				<div class="row pl-4"><h1 style="color: red; font-size: 28px;"><?php echo $f_name; ?></h1><span>Student</span></div>
				<hr style="border-top: 2px solid rgba(0,0,0,.1);">

				<div class="col-12 mt-3 p-4" style="background: white;">
		      <h2 style="font-size: 20px;">Personal information:</h2> 
		        <div class="pl-5">
			        <table class="mt-4" style="width: 60%;">
			          <tr><td><b>Full Name:</b></td><td><?php echo $f_name; ?></td></tr>
			          <tr><td><b>Name with initials:</b></td><td><?php echo $i_name; ?></td></tr>
			          <tr><td><b>Admission No:</b></td><td><?php echo $admission; ?></td></tr>
			          <tr><td><b>NIC:</b></td><td><?php echo $nic; ?></td></tr>
			          <tr><td><b>Birth:</b></td><td><?php echo $dob; ?></td></tr>
			          <tr><td><b>Address:</b></td><td><?php echo $address; ?></td></tr>
			          <tr><td><b>Gender</b></td><td><?php echo $gender; ?></td></tr>
			          <tr><td><b>GS zone</b></td><td><?php echo $gs_zone; ?></td></tr>
			        </table>
		      	</div>	
				</div>
				<div class="col-12 mt-3 p-4" style="background: white;">
		      <h2 style="font-size: 20px;">Class information:</h2>
		        <div class="pl-5">
			        <table class="mt-4" style="width: 60%;">
			    <tr><td><b>Stream:</b></td><td><?php echo $stream; ?></td></tr>
                <tr><td><b>Section:</b></td><td><?php echo $section; ?></td></tr>
                <tr><td><b>Class:</b></td><td><?php echo $g_id.'-'.$class; ?></td></tr>
                <tr><td><b>Class Teacher:</b></td><td>hguojo</td></tr>
			        </table>
		      	</div>	
				</div>
				<div class="col-12 mt-3 p-4" style="background: white;">
		      <h2 style="font-size: 20px;">Parents information:</h2>
		        <div class="pl-5">
			        <table class="mt-4" style="width: 60%;">
			          <tr><td><b>Full Name:</b></td><td><?php echo $par_fname; ?></td></tr>
                <tr><td><b>NIC:</b></td><td><?php echo $par_nic; ?></td></tr>
                <tr><td><b>Mobile:</b></td><td><?php echo $par_mobile; ?></td></tr>
                <tr><td><b>Lan :</b></td><td><?php echo $par_lan; ?></td></tr>
                <tr><td><b>Gender :</b></td><td><?php echo $par_gender; ?></td></tr>
                <tr><td><b>Position :</b></td><td><?php echo $par_position; ?></td></tr>
			        </table>
		      	</div>	
				</div>
	</div>
</div>
</div>


<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
