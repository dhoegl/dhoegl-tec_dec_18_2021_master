<?php 
//Last Updated 05/31/2021: Admin accept/reject script for prayer requests
//Last Updated 10/09/2021: Update admin accept/reject script for prayer requests
//Last Updated 12/13/2021: Continue updates to admin accept/reject script for prayer requests
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
$sessname = session_name();
$sessid = session_id();
$profileID = $_SESSION['idDirectory'];
require_once('tec_dbconnect.php');


//Query for users requesting to register but not yet approved
// $sqlquery = "SELECT * FROM " . $_SESSION['logintablename'] . " WHERE active = 0";
// $result = $mysql->query($sqlquery) or die("A database error occurred when trying to select registrants for Dir and Login Table. See tec_regadmin.php. Error : " . $mysql->errno . " : " . $mysql->error);

// Mysql_num_row is count of table rows returned. Expect at least 1
// $count = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- BOOTSTRAP 4 - Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel='icon' href='/_tenant/images/favicon.ico' type='image/x-icon' >
    <title></title>

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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
    <!-- Test custom styles (Includes tec style details) -->
    <link href="css/tec_css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="_tenant/css/tenant.css" rel="stylesheet">

    <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css"> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


    <!-- Call Moment js for date calc functions -->
    <script src="js/moment.js"></script>
    <!-- JQuery -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/jquery.min.js"></script> -->

    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.1.0.min.js"></script>



<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->

<?php
// Get Unapproved Prayer List
   include('includes/tec_view_unapprovedprayerlist.php');
   
// Enable sendmail script to notify Admins re: prayer request
echo "<script type='text/javascript' src='../js/prayer_request_to_sendmail.js'></script>";

// Get Unapproved Prayer jQuery
//    include('/includes/tec_get_unapprovedprayer_jquery.php');

// Get All Prayer List
//    include('/includes/tec_view_allprayerlist.php');
   
// Get All Prayer jQuery
//    include('/includes/tec_get_allprayer_jquery.php');
   
?>
<!-- **************************** Call Accept Ajax when 'Approve Yes' button is clicked ******************** -->
<!-- **************************** Call Accept Ajax when 'Approve Yes' button is clicked ******************** -->
<!-- **************************** Call Accept Ajax when 'Approve Yes' button is clicked ******************** -->

<script>
        // Ajax call to accept prayer request when 'Approve Yes' button is clicked
        // function prayapprove(PrayerID, PrayerName, PrayerTitle) {
        //     console.log("Made it into the prayapprove function");
        //     var jQ14 = jQuery.noConflict();
        //     jQ14(document).ready(function () {
            // jQ14.ajaxSetup({ cache: false }); // for iPhones so they get fresh data
            // jQ14.ajax({
                // cache: false,
            	// headers: { "cache-control": "no-cache" },
            //     url: '../services/ajax_approve_prayer.php',
            //     type: 'POST',
            //     dataType: 'json',
            //     data: { prayerID: PrayerID, prayerName: PrayerName, prayerTitle: PrayerTitle }
            // })
            //     .done(function (response) {
                    //  Get the result
                    // console.log("ajax approve success response text = ");
                    // console.log(response);
                    // alert("Prayer request has been approved and is now visible on the Prayer page.");
                    // Initializes prayer_request_to_sendmail.js which then transits to tec_sendmail_new.php to send outbound email.
                    // prayerrequestapprovemail(prayerID, prayeremailfrom, prayerowner, prayername, LoginID, Answered, themename, themedomain, themetitle, themecolor, themeforecolor, prayertitle, updatetext) 
                    // prayerrequestapprovemail(PrayerID, PrayerName, PrayerTitle);
                    // location.reload();
                    // return;
                // })
                // .fail(function (response) {
                    //  Get the result
        //             console.log("ajax approve failure response text = ");
        //             console.log(response);
        //             alert("A problem has occurred with your approval at tec_prayadmin. " + response + " Please copy this error and contact your OurFamilyConnections administrator for details.");
        //             location.reload();
        //             return;
        //         });
        //     });
        // };
    </script>


<!-- **************************** Call Reject Ajax when 'Reject Yes' button is clicked ******************** -->
<!-- **************************** Call Reject Ajax when 'Reject Yes' button is clicked ******************** -->
<!-- **************************** Call Reject Ajax when 'Reject Yes' button is clicked ******************** -->

<script>
        // Ajax call to reject prayer request when 'Reject Yes' button is clicked
        function prayreject(PrayerID, PrayerName, PrayerTitle) {
            console.log("Made it into the prayreject function");
            var jQ13 = jQuery.noConflict();
            jQ13(document).ready(function () {
            jQ13.ajaxSetup({ cache: false }); // for iPhones so they get fresh data
            jQ13.ajax({
                // cache: false,
            	// headers: { "cache-control": "no-cache" },
                url: '../services/ajax_reject_prayer.php',
                type: 'POST',
                dataType: 'json',
                data: { prayerID: PrayerID, prayerName: PrayerName, prayerTitle: PrayerTitle }
            })
                .done(function (response) {
                    //  Get the result
                    console.log("ajax reject success response text = ");
                    console.log(response);
                    alert("Prayer request has been disabled in the database.");
                    location.reload();
                    return;
                })
                .fail(function (response) {
                    //  Get the result
                    console.log("ajax reject failed response text = ");
                    console.log(response);
                    alert("A problem has occurred with your rejection at tec_prayeradmin. " + response + " Please copy this error and contact your OurFamilyConnections administrator for details.");
                    location.reload();
                    return;
                });
            });
        };
    </script>

<!-- **************************** Get Which Prayer Item's 'Approve' button was clicked ******************** -->
<!-- **************************** Get Which Prayer Item's 'Approve' button was clicked ******************** -->
<!-- **************************** Get Which Prayer Item's 'Approve' button was clicked ******************** -->

<script type="text/javascript">
var $approveclickbuttonid = "NA";
var $approveURL = "NA";
var testforSelect = "0";
var jQ15 = jQuery.noConflict();
jQ15(document).ready(function () {
    jQ15.ajaxSetup({ cache: false }); // for iPhones so they get fresh data
    jQ15("#unapprovedprayertable tbody").off("click", '.prayer_approve');
    jQ15("#unapprovedprayertable tbody").on("click", '.prayer_approve', function () {
        var testforChild = "0";
        var PrayerID = "0";
        var PrayerDate = "0";
        var PrayerName = "0";
        var PrayerEmail = "0";
        var PrayerTitle = "0";
        var testforChild = jQ15(this).closest('tr');
        if (testforChild.hasClass("child")) {
            // console.log("Child IS closest TR class");
            console.log("Approve clicked hasClass = Child");
            PrayerID = testforChild.prev("tr").find(".prayer_ID").text();
            jQ15("#prayerID_Approve").html("<h6 style='font-weight:bold;'> PrayerID: </h6><h6 style='font-weight:normal;'>" + PrayerID + "</h6>");
            PrayerDate = testforChild.prev("tr").find(".prayer_update").text();
            jQ15("#prayerdate_Approve").html("<h6 style='font-weight:bold;'> Date: </h6><h6 style='font-weight:normal;'>" + PrayerDate + "</h6>");
            PrayerName = testforChild.prev("tr").find(".prayer_who").text();
            jQ15("#prayerfullname_Approve").html("<h6 style='font-weight:bold;'> From: </h6><h6 style='font-weight:normal;'>" + PrayerName + "</h6>");
            PrayerEmail = testforChild.prev("tr").find(".prayer_email").text();
            PrayerTitle = testforChild.prev("tr").find(".prayer_title").text();
            jQ15("#prayertitle_Approve").html("<h6 style='font-weight:bold;'> Title: </h6><h6 style='font-weight:normal;'>" + PrayerTitle + "</h6>");
            PrayerText = testforChild.prev("tr").find(".full_text").text();
            jQ15("#prayertext_Approve").html("<h6 style='font-weight:bold;'> Text: </h6><h6 style='font-weight:normal;'>" + PrayerText + "</h6>");
            // Display the Approve popup
            jQ15("#ModalPrayerApprove").modal('show');
        }
        else {
            // console.log("Child IS NOT closest TR class");
            console.log("Approve clicked hasClass <> Child");
            PrayerID = jQ15(this).closest('tr').find(".prayer_ID").text();
            jQ15("#prayerID_Approve").html("<h6 style='font-weight:bold;'> PrayerID: </h6><h6 style='font-weight:normal;'>" + PrayerID + "</h6>");
            PrayerDate = jQ15(this).closest('tr').find(".prayer_update").text();
            jQ15("#prayerdate_Approve").html("<h6 style='font-weight:bold;'> Date: </h6><h6 style='font-weight:normal;'>" + PrayerDate + "</h6>");
            PrayerName = jQ15(this).closest('tr').find(".prayer_who").text();
            // console.log("ChurchCode = " + ChurchCode);
            jQ15("#prayerfullname_Approve").html("<h6 style='font-weight:bold;'> From: </h6><h6 style='font-weight:normal;'>" + PrayerName + "</h6>");
            PrayerEmail = jQ15(this).closest('tr').find(".prayer_email").text();
            PrayerTitle = jQ15(this).closest('tr').find(".prayer_title").text();
            // console.log("UserName = " + UserName);
            jQ15("#prayertitle_Approve").html("<h6 style='font-weight:bold;'> Title: </h6><h6 style='font-weight:normal;'>" + PrayerTitle + "</h6>");
            PrayerText = jQ15(this).closest('tr').find(".full_text").text();
            jQ15("#prayertext_Approve").html("<h6 style='font-weight:bold;'> Text: </h6><h6 style='font-weight:normal;'>" + PrayerText + "</h6>");
            // Display the Approve popup
            jQ15("#ModalPrayerApprove").modal('show');
        }

        // **************************** Get Which Approved Member 'Approve Yes' button was selected ********************
        // **************************** Get Which Approved Member 'Approve Yes' button was selected ********************
        // **************************** Get Which Approved Member 'Approve Yes' button was selected ********************
        jQ15("#modal_approvepray_submit").off("click");
        jQ15("#modal_approvepray_submit").on("click", function () {
            console.log("Approve Yes clicked");
            console.log("Prayer ID = " + PrayerID);
            console.log("Prayer Date = " + PrayerDate);
            console.log("Prayer Name = " + PrayerName);
            console.log("Prayer Email = " + PrayerEmail);
            console.log("Prayer Title = " + PrayerTitle);
            console.log("Prayer Text = " + PrayerText);

            // The next line was an attempt to fix a bug that causes iPhone to throw an ajax error when rejecting an applicant. Works fine on desktop.
            // Mobile (iOS) fails to execute the ajax call below. Attempting to re-direct this call into a function (regreject)
            // prayapprove(PrayerID, PrayerName, PrayerTitle);
            jQ15.ajax({
                // cache: false,
            	// headers: { "cache-control": "no-cache" },
                // url: '../services/ajax_approve_prayer.php',
                url: '../includes/newprayernotify.php',
                type: 'POST',
                dataType: 'json',
                data: { prayerID: PrayerID, prayerDate: PrayerDate, prayerName: PrayerName, prayerEmail: PrayerEmail, prayerTitle: PrayerTitle, prayerText: PrayerText }
            })
                .done(function (response) {
                    //  Get the result
                    console.log("ajax approve success response text = ");
                    console.log(response);
                    alert("Prayer request has been approved and is now visible on the Prayer page.");
                    // Initializes prayer_request_to_sendmail.js which then transits to tec_sendmail_new.php to send outbound email.
                    // prayerrequestapprovemail(prayerID, prayeremailfrom, prayerowner, prayername, LoginID, Answered, themename, themedomain, themetitle, themecolor, themeforecolor, prayertitle, updatetext) 
                    // prayerrequestapprovemail(PrayerID, PrayerName, PrayerTitle);
                    location.reload();
                    return;
                })
                .fail(function (response) {
                    //  Get the result
                    console.log("ajax approve failure response text = ");
                    console.log(response);
                    alert("A problem has occurred with your approval at tec_prayadmin. " + response + " Please copy this error and contact your OurFamilyConnections administrator for details.");
                    location.reload();
                    return;
                });
        });
    });
});
</script>


<!-- **************************** Get Which Prayer Item's 'Reject' button was clicked ******************** -->
<!-- **************************** Get Which Prayer Item's 'Reject' button was clicked ******************** -->
<!-- **************************** Get Which Prayer Item's 'Reject' button was clicked ******************** -->

<script type="text/javascript">
var sname = "<?php echo $sessname ?>;";
var sid = "<?php echo $sessid ?>;";
var loggedin = "<?php echo $_SESSION['logged in'] ?>;";
var $rejectclickbuttonid = "NA";
var $rejectURL = "NA";
var testforSelect = "0";
var jQ11 = jQuery.noConflict();
jQ11(document).ready(function () {
    jQ11.ajaxSetup({ cache: false }); // for iPhones so they get fresh data
    jQ11("#unapprovedprayertable tbody").off("click", '.prayer_reject');
    jQ11("#unapprovedprayertable tbody").on("click", '.prayer_reject', function () {
        var testforChild = "0";
        var PrayerID = "0";
        var PrayerName = "0";
        var PrayerTitle = "0";
        var testforChild = jQ11(this).closest('tr');
        if (testforChild.hasClass("child")) {
            // console.log("Child IS closest TR class");
            console.log("Reject clicked hasClass = Child");
            PrayerID = testforChild.prev("tr").find(".prayer_ID").text();
            jQ11("#prayerID_Reject").html("<h6 style='font-weight:bold;'> PrayerID: </h6><h6 style='font-weight:normal;'>" + PrayerID + "</h6>");
            PrayerName = testforChild.prev("tr").find(".prayer_who").text();
            jQ11("#prayerfullname_Reject").html("<h6 style='font-weight:bold;'> From: </h6><h6 style='font-weight:normal;'>" + PrayerName + "</h6>");
            PrayerTitle = testforChild.prev("tr").find(".prayer_title").text();
            jQ11("#prayertitle_Reject").html("<h6 style='font-weight:bold;'> Title: </h6><h6 style='font-weight:normal;'>" + PrayerTitle + "</h6>");
            // Display the Reject popup
            jQ11("#ModalPrayerReject").modal('show');
        }
        else {
            // console.log("Child IS NOT closest TR class");
            console.log("Reject clicked hasClass <> Child");
            PrayerID = jQ11(this).closest('tr').find(".prayer_ID").text();
            jQ11("#prayerID_Reject").html("<h6 style='font-weight:bold;'> PrayerID: </h6><h6 style='font-weight:normal;'>" + PrayerID + "</h6>");
            PrayerName = jQ11(this).closest('tr').find(".prayer_who").text();
            // console.log("ChurchCode = " + ChurchCode);
            jQ11("#prayerfullname_Reject").html("<h6 style='font-weight:bold;'> From: </h6><h6 style='font-weight:normal;'>" + PrayerName + "</h6>");
            PrayerTitle = jQ11(this).closest('tr').find(".prayer_title").text();
            // console.log("UserName = " + UserName);
            jQ11("#prayertitle_Reject").html("<h6 style='font-weight:bold;'> Title: </h6><h6 style='font-weight:normal;'>" + PrayerTitle + "</h6>");
            // Display the Reject popup
            jQ11("#ModalPrayerReject").modal('show');
        }

        // **************************** Get Which Rejected Member 'Reject Yes' button was selected ********************
        // **************************** Get Which Rejected Member 'Reject Yes' button was selected ********************
        // **************************** Get Which Rejected Member 'Reject Yes' button was selected ********************
        jQ11("#modal_rejectpray_submit").off("click");
        jQ11("#modal_rejectpray_submit").on("click", function () {
        // jQ11("#modal_rejectpray_submit").click(function () {
            console.log("Reject Yes clicked");
            console.log("Prayer ID = " + PrayerID);
            console.log("Prayer Name = " + PrayerName);
            console.log("Prayer Title = " + PrayerTitle);
            // The next line was an attempt to fix a bug that causes iPhone to throw an ajax error when rejecting an applicant. Works fine on desktop.
            // Mobile (iOS) fails to execute the ajax call below. Attempting to re-direct this call into a function (regreject)
            prayreject(PrayerID, PrayerName, PrayerTitle);

        });
    });
});
    </script>

<!-- **************************** Get Which Prayer Item's 'View' button was clicked ******************** -->
<!-- **************************** Get Which Prayer Item's 'View' button was clicked ******************** -->
<!-- **************************** Get Which Prayer Item's 'View' button was clicked ******************** -->

<script type="text/javascript">
var sname = "<?php echo $sessname ?>;";
var sid = "<?php echo $sessid ?>;";
var loggedin = "<?php echo $_SESSION['logged in'] ?>;";
var $rejectclickbuttonid = "NA";
var $rejectURL = "NA";
var testforSelect = "0";
var jQ30 = jQuery.noConflict();
jQ30(document).ready(function () {
    jQ30.ajaxSetup({ cache: false }); // for iPhones so they get fresh data
    jQ30("#unapprovedprayertable tbody").off("click", '.prayer_view');
    jQ30("#unapprovedprayertable tbody").on("click", '.prayer_view', function () {
        var testforChild = "0";
        var PrayerID = "0";
        var PrayerDate = "0";
        var PrayerName = "0";
        var PrayerEmail = "0";
        var PrayerTitle = "0";
        var PrayerText = "0";
        var testforChild = jQ30(this).closest('tr');
        if (testforChild.hasClass("child")) {
            // console.log("Child IS closest TR class");
            console.log("Prayer View clicked hasClass = Child");
            PrayerID = testforChild.prev("tr").find(".prayer_ID").text();
            jQ30("#prayerID_View").html("<h6 style='font-weight:bold;'> PrayerID: </h6><h6 style='font-weight:normal;'>" + PrayerID + "</h6>");
            PrayerDate = testforChild.prev("tr").find(".prayer_update").text();
            jQ30("#prayerdate_View").html("<h6 style='font-weight:bold;'> Date: </h6><h6 style='font-weight:normal;'>" + PrayerDate + "</h6>");
            PrayerName = testforChild.prev("tr").find(".prayer_who").text();
            jQ30("#prayerfullname_View").html("<h6 style='font-weight:bold;'> From: </h6><h6 style='font-weight:normal;'>" + PrayerName + "</h6>");
            PrayerEmail = testforChild.prev("tr").find(".prayer_email").text();
            jQ30("#prayeremail_View").html("<h6 style='font-weight:bold;'> Email: </h6><h6 style='font-weight:normal;'>" + PrayerEmail + "</h6>");
            PrayerTitle = testforChild.prev("tr").find(".prayer_title").text();
            jQ30("#prayertitle_View").html("<h6 style='font-weight:bold;'> Title: </h6><h6 style='font-weight:normal;'>" + PrayerTitle + "</h6>");
            PrayerText = testforChild.prev("tr").find(".full_text").text();
            jQ30("#prayertext_View").html("<h6 style='font-weight:bold;'> Text: </h6><h6 style='font-weight:normal;'>" + PrayerText + "</h6>");
            // Display the View popup
            jQ30("#ModalPrayerView").modal('show');
        }
        else {
            // console.log("Child IS NOT closest TR class");
            console.log("Prayer View clicked hasClass <> Child");
            PrayerID = jQ30(this).closest('tr').find(".prayer_ID").text();
            jQ30("#prayerID_View").html("<h6 style='font-weight:bold;'> PrayerID: </h6><h6 style='font-weight:normal;'>" + PrayerID + "</h6>");
            PrayerDate = jQ30(this).closest('tr').find(".prayer_update").text();
            jQ30("#prayerdate_View").html("<h6 style='font-weight:bold;'> Date: </h6><h6 style='font-weight:normal;'>" + PrayerDate + "</h6>");
            PrayerName = jQ30(this).closest('tr').find(".prayer_who").text();
            jQ30("#prayerfullname_View").html("<h6 style='font-weight:bold;'> From: </h6><h6 style='font-weight:normal;'>" + PrayerName + "</h6>");
            PrayerEmail = jQ30(this).closest('tr').find(".prayer_email").text();
            jQ30("#prayeremail_View").html("<h6 style='font-weight:bold;'> Email: </h6><h6 style='font-weight:normal;'>" + PrayerEmail + "</h6>");
            PrayerTitle = jQ30(this).closest('tr').find(".prayer_title").text();
            jQ30("#prayertitle_View").html("<h6 style='font-weight:bold;'> Title: </h6><h6 style='font-weight:normal;'>" + PrayerTitle + "</h6>");
            PrayerText = jQ30(this).closest('tr').find(".full_text").text();
            jQ30("#prayertext_View").html("<h6 style='font-weight:bold;'> Text: </h6><h6 style='font-weight:normal;'>" + PrayerText + "</h6>");
            // Display the View popup
            jQ30("#ModalPrayerView").modal('show');
        }

        // **************************** Get Which Prayer Request View 'Send Email' button was selected ********************
        // **************************** Get Which Prayer Request View 'Send Email' button was selected ********************
        // **************************** Get Which Prayer Request View 'Send Email' button was selected ********************
        jQ30("#modal_prayemail_submit").off("click");
        jQ30("#modal_prayemail_submit").on("click", function () {
            console.log("modal_prayemail_submit clicked");
            console.log("Prayer ID = " + PrayerID);
            console.log("Prayer Date = " + PrayerDate);
            console.log("Prayer Name = " + PrayerName);
            console.log("Prayer Email = " + PrayerEmail);
            console.log("Prayer Title = " + PrayerTitle);
            console.log("Prayer Text = " + PrayerText);
            window.location.href = "mailto:" + PrayerEmail + "?subject=About your prayer request: " + PrayerTitle;
        });
    });
});
    </script>

</head>
<body>
    <!--Navbar-->
    <?php
    $activeparam = '11'; // sets nav element highlight
    require_once('tec_nav.php');
    require_once('includes/tec_footer.php');
    ?>
    <!-- Intro Section -->
    <div class="container-fluid profile_bg bottom-buffer">
        <div class="row pt-2">
            <div class="col-sm-12">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Using the Prayer Admin page
                </button>
            </div><!-- col sm-12 -->
        </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">Approving and Rejecting Prayer Requests</h4>
                        <ul class="card-text">
                            <li>Click the <span><img src="https://datatables.net/examples/resources/details_open.png"></img></span> icon to display more details</li>
                            <li>
                                Click on
                                <span class="btn btn-success btn-sm">Approve</span> to approve the prayer request. The request will immediately be visible on the Prayer page.
                            </li>
                            <li>
                                Click on
                                <span class="btn btn-danger btn-sm">Reject</span> to reject the prayer request. The request will remain in our database, but flagged as rejected and will no longer be visible or accessible.
                            </li>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
                <div class="col-sm-6">
                    <div class="card card-body">
                        <h4 class="card-title">
                            Click on the
                            <span class="btn btn-primary btn-sm">View</span> button to view the entire prayer request
                        </h4>
                        <ul class="card-text">
                            <li>You can send an email to the registration request originator directly from your email client when it pops up</li>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-6 -->
            </div><!-- row -->
        </div><!-- collapse -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-image"
                    style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                    <!-- Content -->
                    <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                        <div class="w-100">
                            <h3 class="card-title pt-2"><strong>PRAYER ADMINISTRATION</strong></h3>
                            <p>Approve or Reject new prayer requests.</p>
                        </div>
                    </div>
                </div><!-- Card -->
            </div><!-- Col-md-12 -->
        </div><!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card bg-light border-primary px-2 my-2 w-100">
                    <div class="card-body">
                        <div class="table-responsive-xs">
							<table id="unapprovedprayertable" class="table table-sm table-striped 'display responsive nowrap'" width="100%">
								<thead class="table-dark">
									<tr>
										<th class="dtr-prayeradmincolumn"></th>
										<th>ID</th>
										<th>Date</th>
										<th>From</th>
										<th>Email</th>
										<th>Type</th>
										<th>Title</th>
										<th>Approve</th>
										<th>Reject</th>
										<th>View</th>
										<th>Text</th>
									</tr>
								</thead>
								<tfoot class="table-dark">
									<tr>
										<th class="dtr-prayeradmincolumn"></th>
										<th>ID</th>
										<th>Date</th>
										<th>From</th>
										<th>Email</th>
										<th>Type</th>
										<th>Title</th>
										<th>Approve</th>
										<th>Reject</th>
										<th>View</th>
										<th>Text</th>
									</tr>
								</tfoot>
							</table>
						</div> <!-- table-responsive -->
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col-sm-12 -->
        </div> <!-- Row -->
	</div> <!-- Container -->


    <!--***************************** Approve Prayer Request MODAL ***********************************-->
    <!--***************************** Approve Prayer Request MODAL ***********************************-->
    <!--***************************** Approve Prayer Request MODAL ***********************************-->

    <div class="modal fade" id="ModalPrayerApprove" tabindex="-1" role="dialog" aria-labelledby="ModalPrayerApprove" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalApprovePray">
                        Approve Prayer Request
                        <br />Click
                        <strong>Approve Yes or Cancel</strong> when done.
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- modal-header -->
                <div class="modal-body">
                    <h6>
                        <span id="prayerID_Approve"></span>
                        <span id="prayerfullname_Approve"></span>
                        <span id="prayertitle_Approve"></span>
                        <span id="prayertext_Approve"></span>
                    </h6>
                    <form name='approvepray' method='post' action="javascript:void(0);">
                        <div class="modal-footer">
                            <input type="submit" name="approvepraysubmit" id="modal_approvepray_submit" class="btn btn-primary" value="Approve Yes" />
                            <button type="button" id="modal_cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div><!-- modal-footer -->
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal-fade -->

    <!--***************************** Reject Prayer Request MODAL ***********************************-->
    <!--***************************** Reject Prayer Request MODAL ***********************************-->
    <!--***************************** Reject Prayer Request MODAL ***********************************-->

    <div class="modal fade" id="ModalPrayerReject" tabindex="-1" role="dialog" aria-labelledby="ModalPrayerReject" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRejectPray">
                        Reject Prayer Request
                        <br />Click
                        <strong>Reject Yes or Cancel</strong> when done.
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- modal-header -->
                <div class="modal-body">
                    <h6>
                        <!-- <span id="loginReject"></span> -->
                        <span id="prayerID_Reject"></span>
                        <span id="prayerfullname_Reject"></span>
                        <span id="prayertitle_Reject"></span>
                        <!-- <span id="prayertext_Reject"></span> -->
                    </h6>
                    <form name='rejectpray' method='post' action="javascript:void(0);">
                        <div class="modal-footer">
                            <input type="submit" name="rejectpraysubmit" id="modal_rejectpray_submit" class="btn btn-primary" value="Reject Yes" />
                            <button type="button" id="modal_cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div><!-- modal-footer -->
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal-fade -->

    <!--***************************** Prayer Request View MODAL ***********************************-->
    <!--***************************** Prayer Request View MODAL ***********************************-->
    <!--***************************** Prayer Request View MODAL ***********************************-->

    <div class="modal fade" id="ModalPrayerView" tabindex="-1" role="dialog" aria-labelledby="ModalPrayerView" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalViewPray">
                        View Prayer Request
                        <br />Click
                        <strong>Send Email or Cancel</strong> when done.
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- modal-header -->
                <div class="modal-body">
                    <h6>
                        <!-- <span id="loginReject"></span> -->
                        <span id="prayerID_View"></span>
                        <span id="prayerdate_View"></span>
                        <span id="prayerfullname_View"></span>
                        <span id="prayeremail_View"></span>
                        <span id="prayertitle_View"></span>
                        <span id="prayertext_View"></span>
                    </h6>
                    <form name='prayview' method='post' action="javascript:void(0);">
                        <div class="modal-footer">
                            <input type="submit" name="prayemailsubmit" id="modal_prayemail_submit" class="btn btn-primary" value="Send Email" />
                            <button type="button" id="modal_cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div><!-- modal-footer -->
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal-fade -->




    <!-- SCRIPTS -->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script> -->
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <!-- Datatables JavaScript plugins - Bootstrap-specific -->
    <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script>
    <!-- Attempt Dec 18 2021 -->
    <!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>
    <!-- Call Image Verify jQuery script -->
    <script src="js/image_verify.js"></script>


</body>
</html>