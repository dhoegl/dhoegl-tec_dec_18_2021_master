<?php
//Last Updated 01/03/2022
// Initial Analytics management page
session_start();
if(!$_SESSION['logged in']) 
{
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
else {
    require_once('tec_dbconnect.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- BOOTSTRAP - Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/MDBootstrap4191/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
  <!-- Test custom styles (Includes tec style details) -->
  <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">
    <!-- Datatables stylesheet - Bootstrap-specific -->
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


  <!-- Call Moment js for date calc functions -->
  <script src="js/moment.js"></script>
  <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!--******************************* Extract Family Data **************************************-->
<script type="text/javascript" charset="utf-8">
        var $profile_id = <?php echo "'" . $profileID . "'"; ?>;
        var $fullname = <?php echo "'" . $_SESSION['fullname'] . "'"; ?>;
        var $idDirectory = <?php echo "'" . $_SESSION['idDirectory'] . "'"; ?>;
        console.log('At tec_profile Extract Family Data - profile_id = ' + $profile_id);
    </script>



<!--******************************* Includes **************************************-->
<?php
// Get 
    //    include('includes/tec_view_childlist.php');
?>



<!--******************************* /Extract Profile Info **************************************-->
</head>
<body>
  <!--Navbar-->
            <?php
            $activeparam = '8'; // sets nav element highlight
            require_once('tec_nav.php');
            require_once('includes/tec_footer.php');
            ?>

<!-- Start Here -->
<div class="container-fluid bottom-buffer" id="backsplash">
<!-- ******************************* Profile Photo Card ************************************** -->
    <div class="row pt-2">
        <div class="col-xs-12 col-sm-4 col-lg-4">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">Menu</h4>
                <h5 class="card-text" id="email_addr_report">Email Addresses</h5>
                <h5 class="card-text" id="phone_nbr_report">Phone Numbers</h5>
                <h5 class="card-text" id="birthday_report">Birthdays</h5>
                <h5 class="card-text" id="anniversary_report">Anniversaries</h5>
                <h5 class="card-text" id="prayer_req_report">Active Prayer Requests</h5>
            </div> <!-- card -->
        </div><!--col-xs-6-->
        <div class="col-xs-12 col-sm-8 col-lg-8">
            <div class="card bg-light p-3 mt-2">
                            <h4 class="card-title text-center text-capitalize">Report</h4>
            </div> <!-- card -->
        </div> <!-- col-xs-12 -->
    </div><!--row-->
</div>


  <!-- SCRIPTS -->
<!-- JQuery -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- NEW Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


 <!-- Datatables JavaScript plugins -->
    <!-- Copied from https://www.datatables.net/download/index -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.js"></script>
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

  <!-- Call config details based on Tenant Config info -->
  <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
  <!-- Call Image Verify jQuery script -->
  <script src="js/image_verify.js"></script>
  <!-- Setup for child delete script -->
  <script type="text/javascript" src="/js/tec_profile_children_delete.js"></script>

</body>
</html>