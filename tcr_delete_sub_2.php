<?php 
$action = $_GET['action'];
$sub_id = $_GET['delete_id'];
$tcr_id = $_GET['tcr_id'];
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
      
  <style type="text/css">
  </style>
</head>
<body>

<?php 

    include('connection.php');
    $sql = "DELETE FROM tbl_teacher_$action WHERE tcr_id = $tcr_id and sub_id = $sub_id";
        if ($conn->query($sql) === TRUE) {
            echo "<h1>";
                echo "<center>";
                    echo "Record deleted Successfully";
                echo "</center>";
            echo "</h1>";
            echo "<br>";

            header( "refresh:1;url=tcr_my_sub.php");
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

            header( "refresh:3;url=tcr_my_sub.php");
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