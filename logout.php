<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
  <link rel="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
  <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
<style>

.container{
	margin-top: 20rem;
}
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 10%;
  height: 30px;
  background-color: #A93226;
  border-radius: 1.5rem;
  text-align: center;
  line-height: 30px;
  color: white;
}
img{
	width:  100px;
}
</style>
<body>

<div class="container">
	<center><img src="images/logo.jfif"></center>
	<center><h1>Log out...</h1></center>
	<div class="mt-4" id="myProgress">
		<div id="myBar">10%</div>
		</div>
	</div>
 

<script>
var i = 0;
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 10;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
      } else {
        width++;
        elem.style.width = width + "%";
        elem.innerHTML = width  + "%";
      }
    }
  }

</script>

</body>
<?php 
	if (isset($_SESSION['username'])){

		unset($_SESSION['username']);
	}

	header( 'refresh:2;url=login.php');
	die;  
?>
</html>

