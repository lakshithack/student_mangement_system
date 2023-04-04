<?php 
	$id = $_POST['userid'];
	include('connection.php');
	$sql = "SELECT * FROM tbl_student WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
    		
    		nic = $row['nic'];

    	}
    }
?>
          <div class="col-12 p-4" style="background: white;">
            <div class="row">
              <div class="col-3">
                <img src="images/profile.jfif" class="p-0" style="width: 150px; height: 150px; border-radius: 2rem;">
              </div>
              <div class="basics col-9">
                <h2 class="name"><?php echo $id; ?></h2>
              </div>
            </div>
          </div>
          <div class="col-12 mt-3 p-4" style="background: white;">
            <h5>Personal information:</h5>
            <div class="pl-5">
              <table>
                <tr><td>Full Name:</td><td>Lakshitha Chamod Karunarathna</td></tr>
                <tr><td>Name with initials:</td><td>M.M.L.C.Karunarathna</td></tr>
                <tr><td>Admission No:</td><td>2344544</td></tr>
                <tr><td>NIC:</td><td>20033010903</td></tr>
                <tr><td>Birth:</td><td>20/12/2003</td></tr>
                <tr><td>Address:</td><td>Sigiriya</td></tr>
                <tr><td>Gender</td><td>Male</td></tr>
                <tr><td>GS zone</td><td>Sigiriya</td></tr>
              </table>
            </div>
          </div>
          <div class="col-12 mt-3 p-4" style="background: white;">
            <h5>Class information:</h5>
            <div class="pl-5">
              <table>
                <tr><td>Stream:</td><td>A/L</td></tr>
                <tr><td>Section:</td><td>Commerce</td></tr>
                <tr><td>Class:</td><td>12-E</td></tr>
                <tr><td>Class Teacher:</td><td>hguojo</td></tr>

              </table>
            </div>
          </div>
          <div class="col-12 mt-3 p-4" style="background: white;">
            <h5>Parents information:</h5>
            <div class="pl-5">
              <table>
                <tr><td>Stream:</td><td>A/L</td></tr>
                <tr><td>Section:</td><td>Commerce</td></tr>
                <tr><td>Class:</td><td>12-E</td></tr>
              </table>
            </div>
          </div>
        </div>
