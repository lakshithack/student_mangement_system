<?php 

?>
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
      
</head>
<body>

<?php 
    $delete_id = $_GET['delete_id'];
    $class_id = $_GET['class_id'];
    $sub_id = $_GET['sub_id'];

    include('connection.php');
    $sql = "DELETE FROM tbl_teacher_class WHERE tcr_id = $delete_id and class_id = '$class_id' and sub_id = $sub_id";
        if ($conn->query($sql) === TRUE) {
            echo "<h1>";
                echo "<center>";
                    echo "Record deleted Successfully";
                echo "</center>";
            echo "</h1>";
            echo "<br>";

            header( "refresh:1;url=update_tcr_classes.php");
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

            header( "refresh:3;url=update_tcr_classes.php");
            echo "<h3>";
                echo "<center>";
                    echo 'Redirected In About 1 Seconds...';
                echo "</center>";
            echo "</h1>";
            echo "<br>";
            echo $conn->error;
        }
    
?>
</body>

</html>    