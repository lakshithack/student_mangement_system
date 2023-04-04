<?php
session_start();
error_reporting(0);
include('includes/config.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
$exid=$_GET['exid'];
$class=$_GET['cid'];
$action=$_GET['submit'];

$sql = "SELECT sec_id,class_name from class where class_id=:cid";
$query = $dbh->prepare($sql);
$query->bindParam(':cid', $class, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{foreach($results as $result)
{$secid=$result->sec_id; $clname=$result->class_name;}}

//Submit Marks by Student

if(isset($_POST['submit'])) {

$indexno=$_POST['indexno'];
$marks=array();
$marks=$_POST['marks'];

for($i=0;$i<count($marks);$i++){
    $mark=$marks[$i];
  $sid=$_SESSION['sid1'][$i];
$sql="INSERT INTO result(exam_id,class_id,index_no,sub_id,marks) VALUES(:exid,:cid,:indexno,:sid,:mark); DELETE from result WHERE marks='delete'";
$query = $dbh->prepare($sql);
$query->bindParam(':exid',$exid,PDO::PARAM_STR);
$query->bindParam(':cid',$class,PDO::PARAM_STR);
$query->bindParam(':indexno',$indexno,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':mark',$mark,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Result info added successfully";
}
else 
{
$error="Something went wrong. Please try again";
}}}

//Submit Marks by Subject

if (isset($_POST['upload']))
{
    $subid=$_POST['subid'];

    $allowed_extension = array('xls', 'csv', 'xlsx');
    $file_array = explode(".", $_FILES["import_file"]["name"]);
    $file_extension = end($file_array);

    if(in_array($file_extension, $allowed_extension))
    {
        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($_FILES['import_file']['tmp_name'], $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($file_name);

        unlink($file_name);

        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row)
        {
            $indexno=$row['0'];
            $mark=$row['1'];

            $sql="INSERT INTO result(exam_id,class_id,index_no,sub_id,marks) VALUES(:exid,:cid,:indexno,:sid,:mark); DELETE from result WHERE marks='delete'";
            $query = $dbh->prepare($sql);
            $query->bindParam(':exid',$exid,PDO::PARAM_STR);
            $query->bindParam(':cid',$class,PDO::PARAM_STR);
            $query->bindParam(':indexno',$indexno,PDO::PARAM_STR);
            $query->bindParam(':sid',$subid,PDO::PARAM_STR);
            $query->bindParam(':mark',$mark,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId)
            {
                $msg="Result info imported successfully";
            }
            else 
            {
                $error="Something went wrong. Please try again";
            }
        }
    }
    else
    {
        $error="Invalid file type. Only files with the following extensions are allowed: csv, xls, xlsx.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Submit Marks</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>


    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Submit Marks - <?php echo htmlentities($clname); ?></h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                                        <li><a href="add-result.php"> Student Result</a></li>                                
                                        <li class="active"> Submit Marks</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                                <div class="panel-body">
                                                    <style>.btnz{background-color: rgba(0, 0, 0, 0.1);}.btnz:hover{background-color: rgba(0, 0, 0, 0.15);}</style>
                                                    <a href="add-result.php" class="btn btn-secondary btn-labeled btnz"><span class="btn-label btn-label-left"><i class="fa fa-arrow-left"></i></span>Go Back</a>
                                                </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
<?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                        <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } if ($action=="std") { ?>
                                                <form class="form-horizontal" method="post">

<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label ">Student</label>
                                                        <div class="col-sm-10">
<select name="indexno" class="form-control" id="default" required="required">
<option value="">Select Student</option>
<?php

$sql = "SELECT name,index_no FROM student WHERE class_id=:cid order by index_no";
$query = $dbh->prepare($sql);
$query->bindParam(':cid', $class, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<option value="<?php echo htmlentities($result->index_no); ?>"><?php echo htmlentities($result->index_no. ' - '. $result->name); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                      
                                                        <div class="col-sm-10">
                                                    <div  id="result">
                                                    </div>
                                                        </div>
                                                    </div>
                                                    
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <span class="help-block">Fill in only the marks of the subjects relevent to the student. Leave the rest blank.</span>
</div>
</div>
<div class="form-group">
                                                        <label for="date" class="col-sm-2 control-label">Marks</label>
                                                        <div class="col-sm-10">
                                                    <div id="subject">
<?php
$_SESSION['sid1']=array();
 $stmt = $dbh->prepare("SELECT DISTINCT subject.* FROM subjectcombination inner join subject on subject.sub_id=subjectcombination.sub_id WHERE sec_id=:secid order by subject.sub_id");
 $stmt->execute(array(':secid' => $secid));
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
array_push($_SESSION['sid1'],$row['sub_id']);
?>
  <p> <?php echo htmlentities($row['sub_name']); ?><input type="number" name="marks[]" value="" class="form-control" placeholder="Enter marks out of 100" autocomplete="off" min="0" max="100"></p>
  
<?php } ?>
                                                    </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-success">Submit Result</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            <?php } if ($action=="up") { ?>
                                                
                                                <form class="form-horizontal" enctype="multipart/form-data" method="post">

<div class="form-group">
                                                        <label for="subid" class="col-sm-2 control-label ">Subject</label>
                                                        <div class="col-sm-10">
<select name="subid" class="form-control" id="subid" required="required">
<option value="">Select Subject</option>
<?php

$sql = "SELECT DISTINCT subject.* FROM subjectcombination inner join subject on subject.sub_id=subjectcombination.sub_id WHERE sec_id=:secid order by subject.sub_id";
$query = $dbh->prepare($sql);
$query->bindParam(':secid', $secid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<option value="<?php echo htmlentities($result->sub_id); ?>"><?php echo htmlentities($result->sub_name); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>

<div class="form-group">
<label for="date" class="col-sm-2 control-label ">Upload Excel/CSV file</label>
<div class="col-sm-10">
<input type="file" name="import_file" class="form-control" accept=".xls,.xlsx,.csv" required="required">
</div>
</div>

                                                    <div class="form-group">
                                                      
                                                        <div class="col-sm-10">
                                                    <div  id="result">
                                                    </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="upload" id="submit" class="btn btn-success">Upload Result</button>
                                                        </div>
                                                    </div>
<br><div class="form-group">
<span class="help-block col-sm-offset-2 col-sm-10">Please enter data in the format shown in the image below.</span>
<div class="col-sm-offset-2 col-sm-10">
<img src="images/marks.webp">
</div>
</div>
                                                </form>

                                            <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
