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
        include('heading.php'); 
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
            <nav style="font-size: 16px;">
              <div class="nav nav-tabs dyn_tab" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Singel Add</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Bulk Add</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent" style="padding: 2rem;">

              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">  
                  <center><h1>Grade 6 Student Applications</h1></center>
                  <hr>
                  <form method="post" action="student_insert_2.php">
                    <h2>Student Information</h2>
                    <div class="form-floating mb-4 mt-4 pl-4 col-12">
                        <input type="text" class="form-control" id="f_name" placeholder="f_name" name="f_name" required>
                        <label for="f_name">Full Name</label>
                    </div>
                    <div class="form-floating mb-4 mt-4 pl-4 col-12">
                        <input type="text" class="form-control" id="i_name" placeholder="i_name" name="i_name" required>
                        <label for="i_Name">Name With Initials</label>
                    </div>
                    <div class="row">
                        <div class="form-floating mt-4 mb-4 col-6">
                          <input type="number" class="form-control" id="admission" placeholder="admission" name="admission" required>
                          <label for="admission">Admission No.</label>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-6">
                          <input type="text" class="form-control" id="nic" placeholder="nic" name="nic" maxlength="12">
                          <label for="nic">NIC (Optional)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-floating mt-4 mb-4 col-6">
                          <input type="tel" class="form-control" id="mobile" placeholder="mobile" name="mobile" pattern="[0]{1}[7]{1}[0-9]{8}" required>
                          <label for="mobile">Mobile</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-floating mt-4 mb-4 col-8">
                          <input type="text" class="form-control" id="address" placeholder="address" name="address" required>
                          <label for="address">Address</label>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-4">
                          <input type="date" class="form-control" id="dob" name="dob" placeholder="dob" style="font-size: 14px;" required>
                          <label for="dob">Date Of Birth</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-floating mt-4 mb-4 col-6">
                            <select class="form-select pt-0 pb-0" aria-label="gender" name="gender" style="font-size: 14px;" required>
                              <option selected>Gender</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                    <div class="form-floating mt-4 mb-4 col-6">
                        <input type="text" class="form-control" id="gs_zone" placeholder="gs_zone" name="gs_zone" required>
                        <label for="gs_zone">Gs Zone</label>
                    </div>

                    <h2>Parents Information</h2>
                    <div class="row">
                        <div class="form-floating mb-4 mt-4 pl-4 col-8">
                            <input type="text" class="form-control" id="par_fname" placeholder="par_fname" name="par_fname" required>
                            <label for="par_fname">Full Name</label>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-4">
                          <input type="text" class="form-control" id="par_nic" placeholder="par_nic" name="par_nic" maxlength="12" required>
                          <label for="par_nic">NIC</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-floating mt-4 mb-4 col-6">
                          <input type="tel" class="form-control" id="par_mobile" placeholder="par_mobile" name="par_mobile" pattern="[0]{1}[7]{1}[0-9]{8}" required>
                          <label for="par_mobile">Mobile</label>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-6">
                          <input type="tel" class="form-control" id="lan" placeholder="lan" name="lan" pattern="[0]{1}[6]{1}[0-9]{8}">
                          <label for="lan">LAN (Optional)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-floating mt-4 mb-4 col-6">
                            <select class="form-select pt-0 pb-0" aria-label="par_gender" name="par_gender" style="font-size: 14px;" required>
                                <option selected>Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-floating mt-4 mb-4 col-6">
                            <select class="form-select pt-0 pb-0" aria-label="par_position" name="par_position" style="font-size: 14px;" required>
                                <option value="0">Position</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn sub_btn">Submit</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
            
            </div>
        </div>
    </div>




<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
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

    <!-- custom js file link  -->
    <script src="js/script.js"></script>



</body>
</html>
