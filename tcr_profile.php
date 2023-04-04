<?php 
$id = $_GET['profile_id'];
include('connection.php');

//TEACHER INFORMATION
$sql = "SELECT tbl_teacher_basic.* , tbl_stream.stream as stream_name, tbl_teacher.* FROM tbl_teacher_basic, tbl_stream, tbl_teacher where tbl_teacher_basic.tcr_id = tbl_teacher.tcr_id and tbl_teacher_basic.stream = tbl_stream.str_id and tbl_teacher_basic.tcr_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
        //BASIC
        $id = $row['tcr_id'];
        $f_name = $row['full_name'];
        $nic = $row['nic'];
        $dob = $row['dob'];
        $c_address = $row['c_address'];
        $email = $row['email'];
        $lan = $row['tp_lan'];
        $mobile = $row['tp_mobile'];
        $nation = $row['nation'];
        $religion = $row['religion'];
        $gender = $row['gender'];
        $gs_zone = $row['divisional_secretariat_division'];
        $tcr_no = $row['tcr_no'];
        $slry_no = $row['salary_no'];
        $stream = $row['stream_name'];

        if ($row['marital_status'] == 's'){
            $m_status = 'single';
        } else {
            $m_status = 'married';
        }

        //OTHER
        $qualification = $row['educational_qualifications'];
        $university = $row['university'];
    }
}

//INCHARGE CLASS
$sql = "SELECT tbl_tcr_class_incharge.g_id, tbl_class.class from tbl_tcr_class_incharge, tbl_class where tbl_tcr_class_incharge.class_id = tbl_class.class_id and tbl_tcr_class_incharge.tcr_id = $id and tbl_tcr_class_incharge.states = 'accept'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
        $incharge_class = $row['g_id'].'-'.$row['class'];
    }
} else {
    $incharge_class = 'Not set';
}

//TEACHING SUBJECTS
$sql = "SELECT tbl_subject.subject FROM tbl_subject, tbl_teacher_csub WHERE tbl_teacher_csub.sub_id = tbl_subject.sub_id and tbl_teacher_csub.tcr_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $csub = '';
    while($row = $result->fetch_assoc()) { 
        $csub .= $row['subject'].'<br>';
    }
}

//TEACHING CLASS
$sql = "SELECT tbl_teacher_class.g_id , tbl_class.class FROM tbl_teacher_class, tbl_class WHERE tbl_teacher_class.class_id = tbl_class.class_id and tbl_teacher_class.tcr_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $tcr_class = '';
    while($row = $result->fetch_assoc()) { 
        $tcr_class .= $row['g_id'].'-'.$row['class'].'<br>';
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
        <link rel="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
        <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
		<title>hh</title>

		<style type="text/css">
			.profile-row{
                background: #A93226;
                height: 900px;
            }
            .left{
                background: #A93226;
            }
            .left .profile img{
                width: 200px; 
                height: 200px;
                border: 5px solid white;
                border-radius: 50%;
            }
            .left .contact .details{
                color: white;
                font-size: 13px;
            }
            .right{
                border-radius: 70px 0 0 0;
                margin-top: 15px;
                height: auto;
                background: white;
            }
            .right .action a{
                cursor: pointer;
                background: #A93226;
                color: white;
                padding: 1rem 2rem 1rem 2rem;
                text-decoration: none;
            }
            .right .action a:hover{
                opacity: .7;
            }
            .position {
                background: black;
                color: white;
                padding: 6px;
                border-radius: 4px;
            }
		</style>
	</head>
	<body>
		<?php include('heading.php'); ?>

		<div class="container-fluid" style="margin-top:48px;">
            <div class="profile-row row">            
                <div class="left col-4 p-5">
                    <!--PROFILE--->
                    <div class="profile mt-5">
                        <center><img src="images/profile.jpg" class="img-fluid mb-4"></center>
                        <center><span class="position mt-4">Teacher</span></center>
                        <center><h2 class="mt-3" style="color:white;"><?php echo $f_name; ?></h2></center>
                    </div>
                    <hr>
                    <!--CONTACT-->
                    <div class="contact mt-4">
                        <h3 style="color: white;"><B>Contact</B></h3>
                        <div class="details" style="padding-left: 20px;">
                            <div class="mt-3">
                                <b>Phone:</b><br> 
                                <?php echo $mobile; ?><br><?php if (isset($lan)) { echo $lan; } ?>
                            </div>
                            <div class="mt-2">
                                <b>Email:</b><br> 
                                <?php echo $email; ?>
                            </div>
                            <div class="mt-2">
                                <b>Address:</b><br> 
                                <?php echo $c_address; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right col-8 p-5">

                    <h3><b>BASIC INFORMATION</b></h3><hr>
                    <div class="edu pt-3" style="padding-left:30px; font-size:14px;">
                        <div>
                            <b>Full name:</b><br>
                            <?php echo $f_name; ?>
                        </div>
                        <div class="pt-3">
                            <b>NIC:</b><br>
                            <?php echo $nic; ?>
                        </div>
                        <div class="pt-3">
                            <b>Date of birth:</b><br>
                            <?php echo $dob; ?>
                        </div>
                        <div class="pt-3">
                            <b>Nation:</b><br>
                            <?php echo $nation; ?>
                        </div>
                        <div class="pt-3">
                            <b>Religion</b><br>
                            <?php echo $religion; ?>
                        </div>
                        <div class="pt-3">
                            <b>Marital Status</b><br>
                            <?php echo $m_status; ?>
                        </div>
                        <div class="pt-3">
                            <b>Gender</b><br>
                            <?php echo $gender; ?>
                        </div>
                        <div class="pt-3">
                            <b>GS Zone</b><br>
                            <?php echo $gs_zone; ?>
                        </div>

                    </div>

                    <h3 class="mt-5"><b>EDUCATION</b></h3><hr>
                    <div class="edu pt-3" style="padding-left:30px; font-size:14px;">
                        <div>
                            <b>Qualifications:</b><br>
                            <?php echo $qualification; ?>
                        </div>
                        <div class="pt-3">
                            <b>University</b><br>
                            <?php echo $university; ?>
                        </div>
                    </div>

                    <h3 class="mt-5"><b>INTERNAL</b></h3><hr>
                    <div class="internal" style="padding-left:30px; font-size:14px;">
                        <div class="pt-3">
                            <div class="pt-3">
                            <b>Teacher No:</b><br>
                            <?php echo $tcr_no ?>
                        </div>
                            <b>Salary No:</b><br>
                            <?php echo $slry_no ?>
                        </div>
                        <div class="pt-3">
                            <b>Stream:</b><br>
                            <?php echo $stream ?>
                        </div>
                        <div class="pt-3">
                            <b>Incharge Class:</b><br>
                            <?php echo $incharge_class ?>
                        </div>
                        <div class="pt-3">
                            <b>Classes taught:</b><br>
                            <?php echo $tcr_class ?>
                        </div>
                        <div class="pt-3">
                            <b>Subjects taught:</b><br>
                            <?php echo $csub ?>
                        </div>
                    </div>

                    <?php if (isset($tcr_id)){ 
                        if ($tcr_id = $id) { ?>
                    <div class="action">
                        <center><a class="col-12">Edit Profile</a><center>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>

        <!-- custom js file link  -->
    	<script src="js/script.js"></script>
        <script src='https://code.jquery.com/jquery-3.5.1.js'></script>

	</body>
</html>