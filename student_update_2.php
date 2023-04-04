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
	$path = 'student_overview.php';
	$id = $_POST['id'];
	echo 'id:'.$id;
	$admission = $_POST['admission'];
	$nic = $_POST['nic'];
	$f_name = $_POST['f_name'];
	$i_name = $_POST['i_name'];
	$dob = $_POST['dob'];
	$address = $_POST['address'];
	$mobile = $_POST['mobile'];
	$gs_zone = $_POST['gs_zone'];
	$gender = $_POST['gender'];
	$section_id = $_POST['section'];
	$grade = $_POST['grade'];
	$class_id = $_POST['class'];
	$par_fname = $_POST['par_fname'];
	$par_nic = $_POST['par_nic'];
	$par_mobile = $_POST['par_mobile'];
	$par_lan = $_POST['lan'];
	$par_position = $_POST['par_position'];
	$par_gender = $_POST['par_gender'];
	$lan = $_POST['lan'];

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

	include('connection.php');

	$sql="UPDATE `tbl_student` SET `admission`=$admission,`nic`='$nic',`name_with_int`='$i_name',`full_name`='$f_name',`dob`='$dob',`address`='$address',`tp_mobile`='$mobile',`gs_zone`='$gs_zone',`gender`='$gender',`streamid`='$stream',`section_id`= '$section_id',`g_id`=$grade,`class_id`=$class_id WHERE `id`=$id";


	if ($conn->query($sql) === TRUE) { 
			//$sql = "UPDATE tbl_parent SET `par_nic`='$par_nic',`s_id`=$id,`f_name`='$par_fname',`mobile`='$par_mobile',`tp_lan`='$par_lan',`position`='$par_position',`par_gender`='$par_gender' WHERE `par_nic`='$par_nic'";

			$sql = "SELECT tbl_parent.* from tbl_parent, tbl_student where tbl_student.id = $id and tbl_parent.s_id = tbl_student.id";
	    $result = $conn->query($sql);
	    if ($result->num_rows > 0) {

	    	$sql="UPDATE `tbl_parent` SET `par_nic`='$par_nic', `f_name`='$par_fname',`mobile`='$par_mobile',`tp_lan`='$par_lan',`position`='$par_position',`par_gender`='$par_gender' WHERE `s_id`=$id";
	    	if ($conn->query($sql) === TRUE) { 

		    		header("Location: alert.php?action=success&path=$path");

	    	} else {

	    		header("Location: alert.php?action=fail&path=$path");

	    	}

	    } else {
	    			$sql = "INSERT INTO `tbl_parent` VALUES ($id,'$par_nic','$par_fname','$par_mobile','$par_lan','$par_position','$par_gender')";
            if ($conn->query($sql) === TRUE){ 

            	header("Location: alert.php?action=success&path=$path");
                
            } else {
                header("Location: alert.php?action=fail&path=$path");
            }
	    }
		
	} else { 
           
        header("Location: alert.php?action=fail&path=$path");

      }
?>
</body>
</html>

