<?php 
$alert = $_GET['action'];
$path = $_GET['path'];
header( 'refresh:2;url='.$path);
?>
<!DOCTYPE html>
<html>
<head>
	<title>homapage</title>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<style type="text/css">
        body{
          background: #eee;
        }
        .icon{
          font-size: 15rem; 
          padding: 2rem;
        }
        .del_btn{
          margin-top: 1rem;
          cursor: pointer;
          border: none;
          color: white;
          text-decoration: none;
          background: #A93226;
          font-size: 14px;
          padding: 1rem 1rem;
          border-radius: .5rem; 
          margin-left: 15%;
          margin-right: 15%;

        }
        .del_btn:hover {
          opacity: .8;
          color: white;
        }
        @media (max-width: 768px){
          .icon{
            font-size: 10rem;
          }
          .del_btn{
            font-size: 10px;
            margin-left: 4rem;
            margin-right: 4rem;
          }
         }
    </style>
</head>
<body>

	<?php 
		if ($alert == 'success') {
	?>
			<div class="container" style="margin-top: 10rem;">
				<center>
			        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
			          <center><i class="icon far fa-check-circle " style="color: green;"></i></center>
			          <div>
			            <center>
			              <h1 style="font-size: 25px; font-weight: 600;">Success</h1>
			            </center>
			          </div>
			        </div>
				</center>
			</div>
	<?php 
	} elseif ($alert == 'fail') {
	?>
	<div class="container" style="margin-top: 10rem;">
		      <center>
		        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
		          <center><i class="icon fas fa-exclamation-triangle" style="color:#A93226;"></i></i></center>
		          <div>
		            <center>
		              <h3 style="font-size: 25px; font-weight: 600;">Something went wrong!</h3>
		            </center>
		          </div>
		        </div>
		      </center>
	</div>
	<?php 
	} elseif ($alert == 'copy') {
	?>
	<div class="container" style="margin-top: 10rem;">
		      <center>
		        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
		          <center><i class="icon fas fa-exclamation-triangle" style="color:orange;"></i></i></center>
		          <div>
		            <center>
		              <h3 style="font-size: 25px; font-weight: 600;">All ready In the database</h3>
		            </center>
		          </div>
		        </div>
		      </center>
	</div>
	<?php 
	} elseif ($alert == 'no_tcr') {
	?>
	<div class="container" style="margin-top: 10rem;">
		      <center>
		        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
		          <center><i class="icon fas fa-exclamation-triangle" style="color:red;"></i></i></center>
		          <div>
		            <center>
		              <h3 style="font-size: 25px; font-weight: 600;">Teacher not found</h3>
		            </center>
		          </div>
		        </div>
		      </center>
	</div>
	<?php 
	}
	?>

</body>
</html>