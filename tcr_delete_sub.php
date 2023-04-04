<?php 
 include('heading.php');
 $sub_id = $_GET['delete_id'];
 $action = $_GET['action']

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
        body{
          background: #eee;
        }
        .header{
          opacity: 0;
        }
        .top_nav{
          opacity: 0;
        }
        .icon{
          color: #A93226;
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

    <div class="container" style="margin-top: 10rem;">
      <center>
        <div class="col-md-8 col-lg-6 col-sm-10 shadow-lg" style="background: white;padding-top: 5rem; padding-bottom: 5rem; border-radius: 1rem;">
          <center><i class="icon fas fa-exclamation-circle"></i></center>
          <div>
            <center>
              <h1 style="font-size: 35px; font-weight: 600;">Are you sure?</h1>
              <h4 class="mt-3">you won't be able to revert this!</h4>
            </center>
          </div>
          <div class="" style="height: auto; padding-top: 5rem;">
              <a class="del_btn" href="tcr_delete_sub_2.php?delete_id=<?php echo $sub_id; ?>&action=<?php echo $action;?>&tcr_id=<?php echo $tcr_id;?>">Yes,Delete it!</a>
              <a class="del_btn" href="tcr_my_sub.php" style="background: blue;">Cancel</a>
          </div>
        </div>
      </center> 
    </div>

    

    <!--table row click function--->
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
    </script>
</body>

</html>    