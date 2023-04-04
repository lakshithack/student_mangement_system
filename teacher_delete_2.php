<?php 
 $id = $_GET['delete_id'];
 $nic = $_GET['nic'];
 echo 'id:'.$id;
 echo 'nic:'.$nic;

include('connection.php');

//Delete all from tbl_teacher_basic
$sql = "DELETE FROM tbl_teacher_basic WHERE tcr_id = $id";
 
if ($conn->query($sql) === TRUE) {
    $x = 'success';
} else {
    $x = 'fail';
}

//Delete * from tbl_teacher
$sql = "SELECT * FROM `tbl_teacher` WHERE tcr_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql = "DELETE FROM tbl_teacher WHERE tcr_id = $id";
    if ($conn->query($sql) === TRUE) {
        $x = 'success';
    } else {
        $x = 'fail';
    }
}

//Delete all from tbl_teacher_class
$sql = "SELECT * FROM `tbl_teacher_class` WHERE tcr_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql = "DELETE FROM tbl_teacher_class WHERE tcr_id = $id";
     
    if ($conn->query($sql) === TRUE) {
        $x = 'success';
    } else {
        $x = 'fail';
    }
}

//Delete all from tbl_teacher_csub
$sql = "SELECT * FROM `tbl_teacher_csub` WHERE tcr_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql = "DELETE FROM tbl_teacher_csub WHERE tcr_id = $id";
     
    if ($conn->query($sql) === TRUE) {
        $x = 'success';
    } else {
        $x = 'fail';
    }
}

//Delete all from tbl_teacher_osub
$sql = "SELECT * FROM `tbl_teacher_osub` WHERE tcr_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql = "DELETE FROM tbl_teacher_osub WHERE tcr_id = $id";
     
    if ($conn->query($sql) === TRUE) {
        $x = 'success';
    } else {
        $x = 'fail';
    }
}

//Delete all from tbl_user
$sql = "SELECT * FROM `tbl_user` WHERE nic = $nic";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql = "DELETE FROM tbl_user WHERE nic = $nic";
     
    if ($conn->query($sql) === TRUE) {
        $x = 'success';
    } else {
        $x = 'fail';
    }
}

if ($x=='success') {
    echo $x;
    header( "refresh:3;url=teacher.php");
} else {
    echo $x;
    echo $conn->error;
    header( "refresh:3;url=teacher.php");
}








        /*$sql = "DELETE FROM tbl_user WHERE nic = $nic";
 
             if ($conn->query($sql) === TRUE) {
                    
                    $sql = "SELECT * FROM `tbl_teacher_basic` WHERE tcr_id = $id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {

                    } else {

                        $sql = "DELETE FROM tbl_teacher WHERE tcr_id = $id";
                        if ($conn->query($sql) === TRUE) {
                                echo "<h1>";
                                            echo "<center>";
                                                echo "Record deleted Successfully";
                                            echo "</center>";
                                        echo "</h1>";
                                        echo "<br>";

                                        header( "refresh:1;url=teacher.php");
                                        echo "<h3>";
                                            echo "<center>";
                                                echo 'Redirected In About 1 Seconds...';
                                            echo "</center>";
                                        echo "</h1>";
                        } else {
                                echo "<h1>";
                                            echo "<center>";
                                                echo "Record deleted Failed";
                                            echo "</center>";
                                        echo "</h1>";
                                        echo "<br>";

                                        header( "refresh:3;url=teacher.php");
                                        echo "<h3>";
                                            echo "<center>";
                                                echo 'Redirected In About 1 Seconds...';
                                            echo "</center>";
                                        echo "</h1>";
                                        echo "<br>";
                                        echo $conn->error;
                        }
                    }
                  } else {
                    echo "<h1>";
                                echo "<center>";
                                    echo "Record deleted Failed";
                                echo "</center>";
                            echo "</h1>";
                            echo "<br>";

                            header( "refresh:3;url=teacher.php");
                            echo "<h3>";
                                echo "<center>";
                                    echo 'Redirected In About 1 Seconds...';
                                echo "</center>";
                            echo "</h1>";
                            echo "<br>";
                            echo $conn->error;
                  }
      } else {
        echo "<h1>";
                    echo "<center>";
                        echo "Record deleted Failed";
                    echo "</center>";
                echo "</h1>";
                echo "<br>";

                header( "refresh:3;url=teacher.php");
                echo "<h3>";
                    echo "<center>";
                        echo 'Redirected In About 1 Seconds...';
                    echo "</center>";
                echo "</h1>";
                echo "<br>";
                echo $conn->error;
      }

      $conn->close();*/
?>