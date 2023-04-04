<?php 
$id = $_GET['update_id'];
echo 'id:'.$id;
$_SESSION['student_id'] = $id;

include('connection.php');

$sql = "SELECT tbl_student.*, tbl_class.*, tbl_section.*, tbl_stream.* FROM tbl_student, tbl_class, tbl_section, tbl_stream where tbl_student.id = $id and tbl_class.class_id = tbl_student.class_id and tbl_section.sec_id = tbl_student.section_id and tbl_stream.str_id=tbl_student.streamid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nic =  $row['nic'];
        $f_name = $row['full_name'];
        $i_name = $row['name_with_int'];
        $admission = $row['admission'];
        $nic = $row['nic'];
        $dob = $row['dob'];
        $address = $row['address'];
        $mobile = $row['tp_mobile'];
        $gs_zone = $row['gs_zone'];
        $gender = $row['gender'];
        /*$par_nic = $row['par_nic'];
        $par_fname = $row['f_name'];
        $par_mobile = $row['mobile'];
        $par_lan = $row['tp_lan'];
        $par_gender = $row['par_gender'];
        $position = $row['position'];*/
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
    } else {
            $x = 'not set';
            $par_nic = $x;
            $par_fname = $x;
            $par_mobile = $x;
            $par_lan = $x;
            $par_gender = $x;
            $par_position =  $x;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $id; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
  <style type="text/css">
        .parallax {
            /* The image used */
            background-image: url('images/form_bg.png');

            /* Full height */
            height: 100%; 

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .parallax .form-body{
            font-size: 120%;
            padding: 2rem;
            background: white;
            border-radius: 2rem;
            margin-bottom: 6rem;
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
    <?php include('heading.php'); ?>
    <div class="parallax" style="padding-top: 100px; padding-bottom: 100px; height: auto; ">
        <div class="form-body container mt-3 col-lg-8 col-md-10">
          <center><h1>Update Student Details</h1></center>
          <hr>
          <form method="post" action="student_update_2.php">
            <h2>Student Information</h2>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-floating mb-4 mt-4 pl-4 col-12">
                <input type="text" class="form-control" id="f_name" placeholder="f_name" name="f_name" value="<?php echo $f_name; ?>" required>
                <label for="f_name">Full Name</label>
            </div>
            <div class="form-floating mb-4 mt-4 pl-4 col-12">
                <input type="text" class="form-control" id="i_name" placeholder="i_name" name="i_name" value="<?php echo $i_name; ?>" required>
                <label for="i_Name">Name With Initials</label>
            </div>
            <div class="row">
                <div class="form-floating mt-4 mb-4 col-6">
                  <input type="number" class="form-control" id="admission" placeholder="admission" name="admission" value="<?php echo $admission; ?>" required>
                  <label for="admission">Admission No.</label>
                </div>
                <div class="form-floating mt-4 mb-4 col-6">
                  <input type="text" class="form-control" id="nic" placeholder="nic" name="nic" maxlength="12" value="<?php echo $nic; ?>">
                  <label for="nic">NIC (Optional)</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mt-4 mb-4 col-6">
                  <input type="tel" class="form-control" id="mobile" placeholder="mobile" name="mobile" pattern="[0]{1}[7]{1}[0-9]{8}" value="<?php echo $mobile; ?>" required>
                  <label for="mobile">Mobile</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mt-4 mb-4 col-8">
                  <input type="text" class="form-control" id="address" placeholder="address" name="address" value="<?php echo $address; ?>" required>
                  <label for="address">Address</label>
                </div>
                <div class="form-floating mt-4 mb-4 col-4">
                  <input type="date" class="form-control" id="dob" name="dob" placeholder="dob" style="font-size: 14px;" value="<?php echo $dob; ?>" required>
                  <label for="dob">Date Of Birth</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mt-4 mb-4 col-6">
                    <select class="form-select pt-0 pb-0" aria-label="gender" name="gender" style="font-size: 14px;" required>
                      <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mt-4 mb-4 col-4">
                    <?php
                        $sql = "SELECT * from tbl_grade";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                    ?>
                    <select class="form-select pt-0 pb-0 col-12" id="grade" name="grade" onchange="populate(this.id,'class')" style="font-size: 14px;" required>
                        <option value="">Grade</option>
                        <?php while($row = $result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['g_id']; ?>"><?php echo $row['grade']; ?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="form-floating mt-4 mb-4 col-4">
                    <select class="form-select pt-0 pb-0" id="class" name="class" style="font-size: 14px;" required>
                        <option value="">Class</option>
                    </select>
                </div>
                <div class="d-block" id="section_s" style="width: 33%;" name="section_s">
                <div class="form-floating mt-4 mb-4">
                    <?php
                        $sql = "SELECT * from tbl_section where sec_id > 0";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                    ?>
                    <select class="form-select pt-0 pb-0" id="section" name="section" style="font-size: 14px;">
                        <option value="0">Section</option>
                        <?php while($row = $result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['sec_id']; ?>"><?php echo $row['sec_name']; ?></option>
                        <?php } } ?>
                    </select>
                </div>
                </div>
            </div>
            <div class="form-floating mt-4 mb-4 col-6">
                <input type="text" class="form-control" id="gs_zone" placeholder="gs_zone" name="gs_zone" value="<?php echo $gs_zone; ?>" required>
                <label for="gs_zone">Gs Zone</label>
            </div>

            <h2>Parents Information</h2>
            <div class="row">
                <div class="form-floating mb-4 mt-4 pl-4 col-8">
                    <input type="text" class="form-control" id="par_fname" placeholder="par_fname" name="par_fname" value="<?php echo $par_fname; ?>" required>
                    <label for="par_fname">Full Name</label>
                </div>
                <div class="form-floating mt-4 mb-4 col-4">
                  <input type="text" class="form-control" id="par_nic" placeholder="par_nic" name="par_nic" maxlength="12" value="<?php echo $par_nic; ?>" required>
                  <label for="par_nic">NIC</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mt-4 mb-4 col-6">
                  <input type="tel" class="form-control" id="par_mobile" placeholder="par_mobile" name="par_mobile" pattern="[0]{1}[7]{1}[0-9]{8}" value="<?php echo $par_mobile; ?>" required>
                  <label for="par_mobile">Mobile</label>
                </div>
                <div class="form-floating mt-4 mb-4 col-6">
                  <input type="tel" class="form-control" id="lan" placeholder="lan" name="lan" value="<?php echo $par_lan; ?>" pattern="[0]{1}[6]{1}[0-9]{8}">
                  <label for="lan">LAN (Optional)</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mt-4 mb-4 col-6">
                    <select class="form-select pt-0 pb-0" aria-label="par_gender" name="par_gender" style="font-size: 14px;" required>
                        <option value="<?php echo $par_gender; ?>"><?php echo $par_gender; ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-floating mt-4 mb-4 col-6">
                    <select class="form-select pt-0 pb-0" aria-label="par_position" name="par_position" style="font-size: 14px;" required>
                        <option value="<?php echo $par_position; ?>"><?php echo $par_position; ?></option>
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
    </div>

    <!--Script for select class-->
    <script>
        function populate(s1,s2){
          var s1 = document.getElementById(s1);
          var s2 = document.getElementById(s2);
          s2.innerHTML = "";
          if(s1.value <= 11){
            var optionArray = [" 0|Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id <= 6 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
          } else if(s1.value < 12){
            var optionArray = [" 0|Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id <= 6 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
          } else if(s1.value > 11){
            var optionArray = [" 0|Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id >= 100 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
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

    <!-- custom js file link  -->
    <script src="js/script.js"></script>



</body>
</html>
