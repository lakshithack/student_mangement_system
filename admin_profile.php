<?php 
$id = $_GET['profile_id'];
include('connection.php');

//TEACHER INFORMATION
$sql = "SELECT * from tbl_admin where aid = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
        $id = $row['aid'];
        $f_name = $row['full_name'];
        $nic = $row['nic'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $address = $row['address'];
        $dob = $row['dob'];
        $position = $row['position'];
        $gender = $row['gender'];
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
                        <center><span class="position mt-4">Admin</span></center>
                        <center><h2 class="mt-3" style="color:white;"><?php echo $f_name; ?></h2></center>
                    </div>
                    <hr>
                    <!--CONTACT-->
                    <div class="contact mt-4">
                        <h3 style="color: white;"><B>Contact</B></h3>
                        <div class="details" style="padding-left: 20px;">
                            <div class="mt-3">
                                <b>Phone:</b><br> 
                                <?php echo $mobile; ?>
                            </div>
                            <div class="mt-2">
                                <b>Email:</b><br> 
                                <?php echo $email; ?>
                            </div>
                            <div class="mt-2">
                                <b>Address:</b><br> 
                                <?php echo $address; ?>
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
                            <b>Position</b><br>
                            <?php echo $position; ?>
                        </div>
                        <div class="pt-3">
                            <b>Gender</b><br>
                            <?php echo $gender; ?>
                        </div>

                    </div>

                    <?php if (isset($aid)){ 
                        if ($aid = $id) { ?>
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