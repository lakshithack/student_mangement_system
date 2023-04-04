<?php 
session_start();

?>
<?php 
	include('connection.php');

	$nic = $_POST['nic'];
	$password = $_POST['psw'];

	$sql = "SELECT * FROM `tbl_user` WHERE nic = '$nic'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
       
            // output data of each row
            while($row = $result->fetch_assoc()) {
                  
                  if ($nic == $row['nic'] and $password == $row['password']) {
                    $_SESSION['username'] = $nic;
                    $_SESSION['position'] = $row['position'];
                    header("Location: login.php?error=Login Successful!");
                  } else {
                    header("Location: login.php?error=Username or password is incorrect!");
                  }
               
            }
            
      } else {
          header("Location: login.php?error=Username or password is incorrect!");
      }

?>