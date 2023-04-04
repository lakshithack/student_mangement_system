<?php
/* classes, my subjects, students, my profile */
        error_reporting(0);

        include('connection.php');
        $path = 'teacher';

        //Insert Teacher Basic into table
        if (isset($_POST['submit1'])) {

            //Create tcr_id
            $sql = "SELECT `tcr_id` FROM `tbl_teacher_basic` ORDER BY `tcr_id` DESC LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $tcr_id = $row['tcr_id'];
                    $tcr_id = $tcr_id+1;
                }
            } elseif (empty($tcr_id)) {
                $tcr_id = 1;
            }

            $f_name = $_POST['f_name'];
            $i_name = $_POST['i_name'];
            $nic = $_POST['nic'];
            $gs_zone = $_POST['gs_zone'];
            $spouse_name = $_POST['spouse_name'];
            $tcr_no = $_POST['tcr_no'];
            $salary_no = $_POST['salary_no'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $lan = $_POST['lan'];
            $p_address = $_POST['p_address'];
            $c_address = $_POST['c_address'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $m_status = $_POST['m_status'];
            $nation = $_POST['nation'];
            $religion = $_POST['religion'];
            $grade = $_POST['grade'];
            $stream = $_POST['stream'];
            $psw = $_POST['psw'];
            $c_psw = $_POST['c_psw'];

            $sql = "INSERT INTO `tbl_teacher_basic` VALUES ($tcr_id,'$f_name','$i_name','$nic','$dob','$p_address','$c_address','$email','$mobile','$lan','$spouse_name','$nation','$religion','$m_status','$gender','$gs_zone','$salary_no','$tcr_no',$stream)";
            if ($conn->query($sql) === TRUE){
                $sql = "INSERT INTO `tbl_user` VALUES ('$nic','$psw','1')";
                if ($conn->query($sql) === TRUE){
                    $x='success';
                } else {
                   $x = 'fail';
                }
            } else {
                $x = 'fail';
                $error = $conn->error;
            }
        }

        if (isset($_POST['submit2'])) {
            $id = $_POST['tcr_id'];
            $pre_school = $_POST['pre_school'];
            $first_appointment = $_POST['first_appointment'];
            $c_appointment = $_POST['c_appointment'];
            $appointment_sub = $_POST['appointment_sub'];
            $appointment_medium = $_POST['appointment_medium'];
            $university = $_POST['university'];
            $edu_qua = $_POST['edu_qua'];
            $grade = $_POST['grade'];

            $sql = "INSERT INTO `tbl_teacher` VALUES ($id,'$first_appointment','$pre_school','$c_appointment','$grade','$edu_qua','$university','$appointment_sub','$appointment_medium')";
            echo $sql;
            if ($conn->query($sql) === TRUE){
                header("Location: alert.php?action=success&path=$path");
            } else {
                header("Location: alert.php?action=fail&path=$path");
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
        .parallax {
            /* The image used */
            background-image: url('images/form_bg_2.png');

            /* Full height */
            height: 100%; 

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .parallax .form-body{
            min-height: 500px;
            font-size: 120%;
            padding: .5rem;
            background: white;
            border-radius: 1rem;
            margin-bottom: 6rem;
            
        }
        .dyn_tab button{
          color: #A93226;
          font-weight: 600;
          width: 50%;
        }
        .dyn_tab button:hover{
          color: black;
        }
        .form-body h1{
            font-size: 3rem;
        }
        .form-floating .form-control{
            height: calc(4.5rem + 2px);
        }
        .form-body input{
            font-size: 15px;
        }
        .form-body .row label{
            padding-left: 1.5rem;
            font-size: 14px;
        }
        .form-body label{
            padding-top: 1rem;
            font-size: 15px;
        }


  </style>
</head>
<body>

    <?php

        include('connection.php');

        $sql = "SELECT class from tbl_class ORDER BY class_id ASC ";
        $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
                    $class_id = $row['class'];
                    
           } 
        }
    ?>
    <div class="parallax" style="padding-top: 100px; padding-bottom: 100px; height: auto; ">
        <div class="form-body container mt-3 col-lg-8 col-md-10">
            <center><h1 class="pt-3">Teacher Register</h1></center>
            <hr>
            <nav style="font-size: 16px;">
              <div class="nav nav-tabs dyn_tab" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Basic Information</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" disabled >Other Information</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent" style="padding: 2rem;">

              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <?php if ($x == 'success') { ?>
                    <center>
                        <div class="alert alert-success mt-2 mb-2 ml-5 mr-5 col-11" role="alert">
                            <h3>Data insert successful!</h3> 
                            <p>Please enter 'Next' button to fill other informations.</p>
                        </div>
                    </center>
                <?php } else if ($x == 'fail') { ?>
                    <center>
                        <div class="alert alert-warning mt-2 mb-2 ml-5 mr-5 col-11" role="alert">
                            <h3>Data insert Fail!</h3> 
                            <p><?php echo $error; ?></p>
                        </div>
                    </center>
                <?php  } ?>
                  
                    <div class="<?php if ($x == 'success'){ echo'd-none';} ?>">
                      <form method="post" action="teacher_insert.php" oninput='c_psw.setCustomValidity(c_psw.value != psw.value ? "Passwords do not match." : "")'>
                        <h2>Basic Information</h2>
                        <div class="form-floating mb-4 mt-4 pl-4 col-12">
                            <input type="text" class="form-control" id="f_name" placeholder="f_name" name="f_name" required>
                            <label for="f_name">Full Name</label>
                        </div>
                        <div class="form-floating mb-4 mt-4 pl-4 col-12">
                            <input type="text" class="form-control" id="i_name" placeholder="i_name" name="i_name" required>
                            <label for="i_Name">Name With Initials</label>
                        </div>
                        <div class="form-floating mb-4 mt-4 pl-4 col-12">
                            <input type="text" class="form-control" id="spouse_name" placeholder="spouse_name" name="spouse_name">
                            <label for="spouse_name">Name Of Husband/Wife (Optional) </label>
                        </div>
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="number" class="form-control" id="tcr_no" placeholder="tcr_no" name="tcr_no" required>
                              <label for="tcr_no">Teacher Number</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="number" class="form-control" id="salary_no" placeholder="salary_no" name="salary_no" required>
                              <label for="salary_no">Salary Number</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="text" class="form-control" id="nic" placeholder="nic" name="nic" maxlength="12" required>
                              <label for="nic">NIC</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="text" class="form-control" id="email" placeholder="email" name="email" required>
                              <label for="email">E-Mail</label>
                            </div>
                        </div>
                        <div class="form-floating mt-4 mb-4">
                                <select class="form-select pt-0 pb-0" id="stream" name="stream" style="font-size: 14px;" required>
                                    <option value="">Stream</option>
                                    <option value="1">6-9</option>
                                    <option value="2">O/L</option>
                                    <option value="3">A/L</option>
                                </select>
                            </div>
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="tel" class="form-control" id="mobile" placeholder="mobile" name="mobile" pattern="[0]{1}[7]{1}[0-9]{8}" required>
                              <label for="mobile">Mobile Number</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="tel" class="form-control" id="lan" placeholder="lan" name="lan" pattern="[0]{1}[0-9]{9}">
                              <label for="lan">Lan Number (optional)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="text" class="form-control" id="p_address" placeholder="p_address" name="p_address" required>
                              <label for="p_address">Permanent Address</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="text" class="form-control" id="c_address" placeholder="c_address" name="c_address" required>
                              <label for="c_address">Current Address</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="date" class="form-control" id="dob" name="dob" placeholder="dob" style="font-size: 14px;" required>
                              <label for="dob">Date Of Birth</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                                <select class="form-select pt-0 pb-0" aria-label="gender" name="gender" style="font-size: 14px;" required>
                                  <option value="">Gender</option>
                                  <option value="male">Male</option>
                                  <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                                <select class="form-select pt-0 pb-0" aria-label="nation" name="nation" style="font-size: 14px;" required>
                                  <option value="">Nation</option>
                                  <option value="sinhala">Sinhala</option>
                                  <option value="tamil">Tamil</option>
                                  <option value="muslim">Muslim</option>
                                </select>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                                <select class="form-select pt-0 pb-0" aria-label="religion" name="religion" style="font-size: 14px;" required>
                                  <option value="">Religion</option>
                                  <option value="sinhala">Sinhala</option>
                                  <option value="tamil">Tamil</option>
                                  <option value="muslim">Islam</option>
                                </select>
                            </div>
                        </div>
                        <!---<div class="row">
                            <div class="form-floating mt-4 mb-4 col-4">
                                <select class="form-select pt-0 pb-0 col-12" id="grade" name="grade" onchange="populate(this.id,'class')" style="font-size: 14px;" required>
                                    <option value="">Grade</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                </select>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-4">
                                <select class="form-select pt-0 pb-0" id="class" name="class" style="font-size: 14px;" required>
                                    <option value="">Class</option>
                                </select>
                            </div>
                            <div class="d-block" id="section_s" style="width: 33%;" name="section_s">
                            <div class="form-floating mt-4 mb-4">
                                <select class="form-select pt-0 pb-0" id="section" name="section" style="font-size: 14px;">
                                    <option value="0">Section</option>
                                    <option value="1">Bio</option>
                                    <option value="2">Maths</option>
                                    <option value="3">Commerce</option>
                                    <option value="4">Technical</option>
                                    <option value="5">Art</option>
                                </select>
                            </div>
                            </div>
                        </div>--->
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                                <input type="text" class="form-control" id="gs_zone" placeholder="gs_zone" name="gs_zone" required>
                                <label for="gs_zone">Gs Zone</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                                <select class="form-select pt-0 pb-0" aria-label="m_status" name="m_status" style="font-size: 14px;" required>
                                  <option value="">Marital status</option>
                                  <option value="s">Single</option>
                                  <option value="m">Married</option>
                                  <option value="d">divorced</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                                <input type="password" class="form-control" id="psw" placeholder="psw" name="psw" required>
                                <label for="psw">Password For Login</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                                <input type="password" class="form-control" id="c_psw" placeholder="c_psw" name="c_psw" required>
                                <label for="c_psw">Confirm Password</label>
                            </div>
                        </div>
                        <center class="col-12"><input type="submit" name="submit1" class="btn sub_btn" value="Submit"></center>
                      </form>
                    </div>
                        <div class="row">
                            <?php if (isset($_POST['submit1']) and $x == 'success') { ?>
                                <center class="col-12"><input type="button" name="Next" class="btn sub_btn" value="Next" data-toggle="tab" href="#personal_details" onclick="func1()" style="background: #eee; color: black;"></center>
                            <?php } ?>
                        </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    
                    <form method="post" action="teacher_insert.php">
                        <h2>Other Information</h2>
                        <div class="form-floating mb-4 mt-4 pl-4 col-12">
                            <input type="text" class="form-control" id="pre_school" placeholder="pre_school" name="pre_school" >
                            <label for="pre_school">Previous School</label>
                        </div>
                        <input type="hidden" name="tcr_id" value="<?php echo $tcr_id; ?>">
                        <div class="row">
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="date" class="form-control" id="first_appointment" placeholder="first_appointment" name="first_appointment" pattern="[0]{1}[7]{1}[0-9]{8}" required>
                              <label for="first_appointment">Date Of First Appointment</label>
                            </div>
                            <div class="form-floating mt-4 mb-4 col-6">
                              <input type="date" class="form-control" id="c_appointment" placeholder="c_appointment" name="c_appointment" pattern="[0]{1}[7]{1}[0-9]{8}">
                              <label for="c_appointment">Date Of Appointment To This School</label>
                            </div>
                        </div>
                        <div class="form-floating mb-4 mt-4 pl-4 col-12">
                            <input type="text" class="form-control" id="appointment_sub" placeholder="appointment_sub" name="appointment_sub" >
                            <label for="appointment_sub">Subject Of Appointment</label>
                        </div>
                        <div class="form-floating mt-4 mb-4">
                            <select class="form-select pt-0 pb-0" id="appointment_medium" name="appointment_medium" style="font-size: 14px;">
                                <option value="">Medium Of Appointment</option>
                                <option value="sinhala">Sinhala</option>
                                <option value="tamil">Tamil</option>
                                <option value="english">English</option>
                            </select>
                        </div>
                        <div class="form-floating">
                          <textarea class="form-control" placeholder="Leave a comment here" id="edu_qua" name="edu_qua" style="height: 100px"></textarea>
                          <label for="edu_qua">Educational Qualifications</label>
                        </div>
                        <div class="row">
                            <div class="form-floating mb-4 mt-4 pl-4 col-6">
                                <input type="text" class="form-control" id="university" placeholder="university" name="university" >
                                <label for="university">University</label>
                            </div>
                            <div class="form-floating mb-4 mt-4 pl-4 col-6">
                                <input type="text" class="form-control" id="grade" placeholder="grade" name="grade" >
                                <label for="grade">Grade</label>
                            </div>
                        </div>
                        <hr>
                        
                        
                        <div class="row">
                            <center class="col-6"><input type="button" name="Next" class="btn sub_btn" onclick="window.location.href='teacher.php'" value="Skip" style="background: #eee; color: black;"></center>
                            <center class="col-6"><input type="submit" name="submit2" class="btn sub_btn" value="Submit"></center>
                        </div>
                    </form>

                </div>
            
            </div>
        </div>
    </div>




<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(".multiple-select").select2({
  //maximumSelectionLength: 2
});
</script>
<script src="printThis.js"></script>
    <script>
        function populate(s1,s2){
          var s1 = document.getElementById(s1);
          var s2 = document.getElementById(s2);
          s2.innerHTML = "";
          if(s1.value <= 11){
            var optionArray = [" |Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id <= 6 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
            window.alert(s1.value);
          } else if(s1.value > 11){
            var optionArray = [" |Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id > 6 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
            window.alert(s1.value);
          } 

          for(var option in optionArray){
            var pair = optionArray[option].split("|");
            var newOption = document.createElement("option");
            newOption.value = pair[0];
            newOption.innerHTML = pair[1];
            s2.options.add(newOption);
          }

          if (s1.value <= 11) {
            let section = document.getElementById('section_s');
                if (section.classList == 'd-block'){
                    section.classList.toggle('d-none');
                    section.classList.remove('d-block');
                }
            } else if (s1.value > 11) {
                let section = document.getElementById('section_s');
                if (section.classList == 'd-none'){
                    section.classList.toggle('d-block');
                    section.classList.remove('d-none');
                }
            }
        }


    </script>

    

        <script>
            let nav_home = document.querySelector('#nav-home');
            let nav_home_tab = document.querySelector('#nav-home-tab')
            let nav_profile = document.querySelector('#nav-profile'); 
            let nav_profile_tab = document.querySelector('#nav-profile-tab')
            function func1()
            {
            nav_home.classList.remove('active');
            nav_home.classList.remove('show');
            nav_home_tab.classList.remove('active');
            nav_profile.classList.toggle('active');
            nav_profile.classList.toggle('show');
            nav_profile_tab.classList.toggle('active');
            }
        </script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>



</body>
</html>