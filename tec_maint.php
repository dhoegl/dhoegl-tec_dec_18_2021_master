<?php
// TEC Maintenance Splash Page
// Updated 20220104
// moved from tec_maint repo
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >
    <title>Scheduled Maintenance - OurFamilyConnections</title>
<!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
    <link href="css/bootstrap453/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
    <link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
    <link href="css/MDBootstrap4191/style.css" rel="stylesheet">
    <link href="css/tec_css_style.css" rel="stylesheet" />
    <link href="css/tec_welcome_style.css" rel="stylesheet" />

</head>
<body>
  <!--Footer-->
    <?php
        require_once('includes/tec_footer_maint.php');
    ?>

    <header>
        <!-- Navbar -->
<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-dark primary-color"> -->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark orange darken-4">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <?php
    ?>
  </div>
</nav>  

        <div class="container-fluid">
            <div class="heavy-rain-gradient">
                <div class="row mt-5 pt-5 mx-auto">
                    <div class="card mx-auto mt-3 pt-5" style="width: 100%">
                        <div class="card mx-auto img-fluid" style="width: 50%;">
                            <img src="/images/ourfamilyconnections4.png" class="card-img-top" alt="..." />
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                        </div>
                        <div class="card-body text-center">
                            <div class="text-center">
                                <h3 class="white-text">
                                    <i class="white-text"></i>Sorry for the inconvenience while we make a few improvements
                                </h3>
                                <h3 class="white-text">
                                    <i class="white-text"></i>We will be back online shortly
                                </h3>
                            </div><!--text-center-->
                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--Row-->
            </div><!--gradient-->
        </div><!--container-->
    </header>
            <!--</div>-->
        <!--</div>-->

    <!--</main>-->
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
    <!--<script>
        new WOW().init();
    </script>-->

</body>
</html>