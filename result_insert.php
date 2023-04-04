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
            font-size: 120%;
            min-height: 500px;
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
        hr{
            color: #A93226;
            height: 2px;
        }
        .sub_btn{
          margin-top: 1rem;
          display: inline-block;
          background: #A93226;
          color: #f9fafb;
          cursor: pointer;
          font-size: 15px;
          padding: .6rem 1.5rem;
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
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent" style="padding: 2rem;">

              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">                      
                  <center><h1>Insert Student Exam Results</h1></center>
                  <hr>
                  <form method="post" action="student_insert_2.php">
                    <div class="form-floating mb-4 mt-4 pl-4 col-12">
                        <input type="number" class="form-control" id="f_name" placeholder="f_name" name="f_name" required>
                        <label for="f_name">Admission No.</label>
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
                                    <option value="1">commerce</option>
                                    <option value="2">art</option>
                                    <option value="3">maths</option>
                                    <option value="4">Technical</option>
                                    <option value="5">Bio</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!--SUBJECTS FOR UNDER GRADE 9--->
                    <div id="subject_9" class="d-none">
                        <?php for ($x = 0; $x <= 1; $x++) {?>
                            <div class="row">
                                <div class="form-floating mt-4 mb-4 col-6">
                                    <select class="form-select pt-0 pb-0 col-12" id="sub" name="sub" style="font-size: 14px;" required>
                                        <option value="">Subject</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="form-floating mb-4 mt-4 pl-4 col-6">
                                    <input type="number" class="form-control" id="f_name" placeholder="f_name" name="f_name" required style="height: calc(3.8rem + 0px);">
                                    <label for="f_name" style="padding-top: .7rem;">Marks</label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!--SUBJECTS FOR GRADE 10 AND GRADE 11--->
                    <div id="subject_11" class="d-none">
                        <?php for ($x = 0; $x <= 2; $x++) {?>
                            <div class="row">
                                <div class="form-floating mt-4 mb-4 col-6">
                                    <select class="form-select pt-0 pb-0 col-12" id="sub" name="sub"  style="font-size: 14px;" required>
                                        <option value="">Subject</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="form-floating mb-4 mt-4 pl-4 col-6">
                                    <input type="number" class="form-control" id="f_name" placeholder="f_name" name="f_name" required style="height: calc(3.8rem + 0px);">
                                    <label for="f_name" style="padding-top: .7rem;">Marks</label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!--SUBJECTS FOR GRADE 12 AND GRADE 13--->
                    <div id="subject_13" class="d-none">
                        <?php for ($x = 0; $x <= 3; $x++) {?>
                            <div class="row">
                                <div class="form-floating mt-4 mb-4 col-6">
                                    <select class="form-select pt-0 pb-0 col-12" id="sub" name="sub" style="font-size: 14px;" required>
                                        <option value="">Subject</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="form-floating mb-4 mt-4 pl-4 col-6">
                                    <input type="number" class="form-control" id="f_name" placeholder="f_name" name="f_name" required style="height: calc(3.8rem + 0px);">
                                    <label for="f_name" style="padding-top: .7rem;">Marks</label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <button type="submit" class="sub_btn">Submit</button>
                   </form>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
            </div>
        </div>
    </div>


    

    <script>
        function populate(s1,s2){
            var s1 = document.getElementById(s1);
            var s2 = document.getElementById(s2);
            s2.innerHTML = "";
            /*Select Class*/
            if(s1.value <= 11){
                var optionArray = [" |Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id < 50 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
            } else if(s1.value > 11){
                var optionArray = [" |Class",<?php $sql = "SELECT class_id,class from tbl_class where class_id >= 50 "; $result = $conn->query($sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) { $class_id = $row['class_id']; $class = $row['class']; echo '"'.$class_id.'|'.$class.'",'; } } ?>];
            } 

            for(var option in optionArray){
                var pair = optionArray[option].split("|");
                var newOption = document.createElement("option");
                newOption.value = pair[0];
                newOption.innerHTML = pair[1];
                s2.options.add(newOption);
            }

            /*Check Section*/
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

            /*Select Subject*/
            let subject_9 = document.getElementById('subject_9');
            let subject_11 = document.getElementById('subject_11');
            let subject_13 = document.getElementById('subject_13');
            if (s1.value <= 9) {
                if (subject_9.classList != 'd-block'){
                   subject_9.classList = 'd-block';
                   subject_11.classList = 'd-none';
                   subject_13.classList = 'd-none';
                } 
            } 
            else if (s1.value <= 11) {
                if (subject_11.classList != 'd-block'){
                   subject_9.classList = 'd-none';
                   subject_11.classList = 'd-block';
                   subject_13.classList = 'd-none';
                } 
            } 
            else if (s1.value <= 13) {
                if (subject_13.classList != 'd-block'){
                   subject_9.classList = 'd-none';
                   subject_11.classList = 'd-none';
                   subject_13.classList = 'd-block';
                } 
            }            



        }


    </script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>



</body>
</html>
