<?php
//Last Updated 01/30/2022
// Administration page
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

<!--***************************** Get Config settings from database ***********************************-->
<!--***************************** Get Config settings from database ***********************************-->
<!--***************************** Get Config settings from database ***********************************--> 
<script type="text/javascript">
	var jQ19 = jQuery.noConflict();
    var obj = [];
    var id = 0;
    var settingID = [];
    var settingkey = [];
    var settingvalue = [];
    var settingdescription = [];
    var settings_count;
    var config_settings_response;
	jQ19(document).ready(function() {
		var config_settings = jQ19.ajax({
        url: 'services/tec_getconfigsettings.php',
		type: 'POST',
		dataType: 'json',
		// data: {login_ID: loginID}
		})
        config_settings.done(function (config_settings_response) {
                    //  Get the details for all config settings
                    settings_count = config_settings_response.length;
                    console.log('number of config settings = ' + settings_count);
                    var i = 0;
                    while (config_settings_response[i]) {
                        settingID[i] = config_settings_response[i].settingid;
                        id = settingID[i];
                        settingkey[id] = config_settings_response[i].settingkey;
                        // console.log("p_created[id] = " + p_created[id]);
                        settingvalue[id] = config_settings_response[i].settingvalue;
                        if(id == 1 && settingvalue[id] == 1) {
                            document.getElementById("EnableBirthYear").checked = true;
                        }
                        if(id == 2 && settingvalue[id] == 1) {
                            document.getElementById("RequireNewApproval").checked = true;
                        }
                        if(id == 3 && settingvalue[id] == 1) {
                            document.getElementById("RequireUpdateApproval").checked = true;
                        }
                        if(id == 4 && settingvalue[id] == 1) {
                            document.getElementById("EmailEnable").checked = true;
                        }
                        if(id == 5 && settingvalue[id] == 1) {
                            document.getElementById("EnableUnanswer").checked = true;
                        }
                        if(id == 6 && settingvalue[id] == 1) {
                            document.getElementById("EnableThread").checked = true;
                        }
                        if(id == 7 && settingvalue[id] == 1) {
                            document.getElementById("createmode").checked = true;
                        }
                        if(id == 8 && settingvalue[id] == 1) {
                            document.getElementById("threadedcomm").checked = true;
                        }
                        if(id == 9 && settingvalue[id] == 1) {
                            document.getElementById("enableguest").checked = true;
                        }
                        settingdescription[id] = config_settings_response[i].settingdescription;
                        i++
                    }
                })
    });
</script>


<!--***************************** Global Admins Select ***********************************-->
<!--***************************** Global Admins Select ***********************************-->
<!--***************************** Global Admins Select ***********************************-->

<script type="text/javascript">
var jQ01 = jQuery.noConflict();
jQ01(document).ready(function () {
    jQ01("#global_admin_select").on("click", function () {
        console.log("********** Global Admin button clicked ************");
        // groupName = jQ01("#groupname").text();
        // jQ01("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        jQ01("#ModalGlobalAdminSelect").modal('show');
        });
    })
</script>

<!--***************************** Elder Select ***********************************-->
<!--***************************** Elder Select ***********************************-->
<!--***************************** Elder Select ***********************************-->

<script type="text/javascript">
var jQ01 = jQuery.noConflict();
jQ01(document).ready(function () {
    jQ01("#elder_select").on("click", function () {
        console.log("********** Elder Select button clicked ************");
        // groupName = jQ01("#groupname").text();
        // jQ01("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        jQ01("#ModalElderSelect").modal('show');
        });
    })
</script>

<!--***************************** Deacon Select ***********************************-->
<!--***************************** Deacon Select ***********************************-->
<!--***************************** Deacon Select ***********************************-->

<script type="text/javascript">
var jQ01 = jQuery.noConflict();
jQ01(document).ready(function () {
    jQ01("#deacon_select").on("click", function () {
        console.log("********** Deacon Select button clicked ************");
        // groupName = jQ01("#groupname").text();
        // jQ01("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        jQ01("#ModalDeaconSelect").modal('show');
        });
    })
</script>

<!--***************************** Groups Admin Select ***********************************-->
<!--***************************** Groups Admin Select ***********************************-->
<!--***************************** Groups Admin Select ***********************************-->

<script type="text/javascript">
var jQ01 = jQuery.noConflict();
jQ01(document).ready(function () {
    jQ01("#groups_admin_select").on("click", function () {
        console.log("********** Groups Admin button clicked ************");
        // groupName = jQ01("#groupname").text();
        // jQ01("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        jQ01("#ModalGroupsAdminSelect").modal('show');
        });
    })
</script>

<!--***************************** Prayer Admins Select ***********************************-->
<!--***************************** Prayer Admins Select ***********************************-->
<!--***************************** Prayer Admins Select ***********************************-->

<script type="text/javascript">
var jQ01 = jQuery.noConflict();
jQ01(document).ready(function () {
    jQ01("#prayer_admin_select").on("click", function () {
        console.log("********** Prayer Admins button clicked ************");
        // groupName = jQ01("#groupname").text();
        // jQ01("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        jQ01("#ModalPrayerAdminSelect").modal('show');
        });
    })
</script>

<!--***************************** Registration Admins Select ***********************************-->
<!--***************************** Registration Admins Select ***********************************-->
<!--***************************** Registration Admins Select ***********************************-->

<script type="text/javascript">
var jQ01 = jQuery.noConflict();
jQ01(document).ready(function () {
    jQ01("#registration_admin_select").on("click", function () {
        console.log("********** Registration Admins button clicked ************");
        // groupName = jQ01("#groupname").text();
        // jQ01("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        jQ01("#ModalRegistrationAdminSelect").modal('show');
        });
    })
</script>

</head>
<body>
  <!--Navbar-->
            <?php
            $activeparam = '12'; // sets nav element highlight
            require_once('tec_nav.php');
            require_once('includes/tec_footer.php');
            ?>
<!-- Intro Section -->
<div class="container-fluid profile_bg bottom-buffer">
    <div class="row pt-2">
        <div class="col-sm-6">
            <p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Administration
                </button>
            </p>
        </div><!-- col sm-6 -->
    </div><!-- Row -->
<div class="collapse" id="collapseExample">
    <div class="row">
        <div class="col-12">
            <div class="card card-body">
                <h4 class="card-title">How To</h4>
                <ul class="card-text">
                    <li>Optimize your settings in the cards below.</li>
                </ul>
            </div>
        </div><!-- col-sm-6 -->
    </div><!-- row -->
</div><!--  collapse -->

<!-- Start Here -->
<div class="container-fluid bottom-buffer" id="backsplash">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-image"
                style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                <!-- Content -->
                <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                    <div class="w-100">
                        <h3 class="card-title pt-2"><strong>OURFAMILYCONNECTIONS ADMINISTRATION</strong></h3>
                        <p></p>
                    </div>
                </div>
            </div><!-- Card -->
        </div><!-- Col-md-12 -->
    </div><!-- Row -->

        <!-- ******************************* System Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-4 col-lg-4"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">System</h4>
                <ul class="list-group">
                    <li class="list-group-item">Configuration Settings</li>
                    <li class="list-group-item">Notifications</li>
                    <li class="list-group-item">Domains</li>
                </ul>
                <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadminsystem" id="saveadminsystem" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
           </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Admin Roles Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-4 col-lg-4"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">Administrative Roles</h4>
                <ul class="list-group">
                    <li class="list-group-item" id="global_admin_select"><a href="#">Global Administrators</a></li>
                    <li class="list-group-item" id="elder_select"><a href="#">Elders</a></li>
                    <li class="list-group-item" id="deacon_select"><a href="#">Deacons</a</li>
                    <li class="list-group-item" id="groups_admin_select"><a href="#">Groups Administrators</a</li>
                    <li class="list-group-item" id="prayer_admin_select"><a href="#">Prayer Administrators</a</li>
                    <li class="list-group-item" id="registration_admin_select"><a href="#">Registration Administrators</a></li>
                </ul>
            <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadminadminroles" id="saveadminadminroles" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
            </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Users & Guests Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-4 col-lg-4"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">Users & Guests</h4>
                <ul class="list-group">
                    <li class="list-group-item">Registered Users</li>
                    <li class="list-group-item">Guest Users</li>
                    <li class="list-group-item">Family Management</li>
                    <li class="list-group-item">Members</li>
                    <li class="list-group-item">Suspended Users</li>
                    <li class="list-group-item">Identity Protection</li>
                </ul>
            <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadminusers" id="saveadminusers" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
            </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Subscription & Billing Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-4 col-lg-4"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">Subscription & Billing</h4>
                <ul class="list-group">
                    <li class="list-group-item">Your Services</li>
                    <li class="list-group-item">Licenses</li>
                    <li class="list-group-item">Bills & Payments</li>
                    <li class="list-group-item">Payment Methods</li>
                    <li class="list-group-item">Billing Notifications</li>
                </ul>
                <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadminsubbill" id="saveadminsubbill" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
            </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Profile Card ************************************** -->
    <div class="row pt-2">
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="profile_card">Profile</h4>
                    <div class="card-text bkgrd-white-cell">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="EnableBirthYear">
                            <label class="custom-control-label" for="EnableBirthYear">Enable Birth Year</label>
                        </div>
                    </div>
                <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadminprofile" id="saveadminprofile" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
            </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Calendar Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-4 col-lg-4"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">Calendar</h4>
                <ul class="list-group">
                    <li class="list-group-item">Calendar Sync</li>
                    <li class="list-group-item">Alerts</li>
                </ul>
                <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadmincalendar" id="saveadmincalendar" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
            </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Prayer Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-4 col-lg-4"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">Prayer</h4>
                <div class="card-text bkgrd-white-cell">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="RequireNewApproval">
                        <label class="custom-control-label" for="RequireNewApproval">Require New Prayer Admin Approval</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="RequireUpdateApproval">
                        <label class="custom-control-label" for="RequireUpdateApproval">Require Update Prayer Admin Approval</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="EmailEnable">
                        <label class="custom-control-label" for="EmailEnable">Enable Email to requestor</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="EnableUnanswer">
                        <label class="custom-control-label" for="EnableUnanswer">Enable Prayer Request Unanswer</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="EnableThread">
                        <label class="custom-control-label" for="EnableThread">Enable Threaded Prayer Request Communications</label>
                    </div>
                </div> <!-- card-text -->
                <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadminprayer" id="saveadminprayer" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
            </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Groups Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-4 col-lg-4"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize" id="menu_card">Groups</h4>
                <div class="card-text bkgrd-white-cell">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="createmode">
                        <label class="custom-control-label" for="createmode">Create Mode - Open vs. Restricted</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="threadedcomm">
                        <label class="custom-control-label" for="threadedcomm">Threaded Communication</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="enableguest">
                        <label class="custom-control-label" for="enableguest">Enable Guest Users</label>
                    </div>
                </div> <!-- card-text -->
                <div class="row px-2 d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                            <div class="col-sm-4">
                                <button type="submit" name="saveadmingroups" id="saveadmingroups" class="btn btn-primary btn-sm">Save</button>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            </div>
                        </div><!-- btn-group -->
                </div><!-- row -->
            </div> <!-- card -->
        </div><!--col-xs-6-->
    </div><!-- row -->
        <!-- ******************************* Downloads Card ************************************** -->
    <div class="row pt-2">
        <!-- <div class="col-xs-12 col-sm-8 col-lg-8"> -->
        <div class="col-12">
            <div class="card bg-light border-primary p-3 mt-2">
                <h4 class="card-title text-center text-capitalize">Downloads</h4>
                <ul class="list-group">
                    <li class="list-group-item">Download the <a href='services/pdf_download2.php'class='btn btn-info btn-sm' role='button'>Directory PDF</a></li>
                    <li class="list-group-item">Download the <a href='services/csv_download_directory.php'class='btn btn-info btn-sm' role='button'>Directory CSV</a></li>
                    <li class="list-group-item">Download the <a href='services/csv_download_prayer_requests.php'class='btn btn-info btn-sm' role='button'>Active Prayer Requests CSV</a></li>
                </ul>
            </div> <!-- card -->
        </div> <!-- col-xs-12 -->
    </div><!--row-->
</div>

<!--***************************** Global Admin MODAL ***********************************-->
<!--***************************** Global Admin MODAL ***********************************-->
<!--***************************** Global Admin MODAL ***********************************-->

<div class="modal fade" id="ModalGlobalAdminSelect" tabindex="-1" role="dialog" aria-labelledby="GlobalAdminLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="GlobalAdminLabel">Global Administrators</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <!-- <span id="newgroupname"></span> --> 
                </h6>
                <form class="border border-light p-2" name='globaladmin' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Global Admin List Card ************************************** -->
                                    <div class="card bg-light border-primary px-2 my-2 w-100">
                                        <div class="card-body">
                                            <div class="table-responsive-xs">
                                                <!-- <table id="groupownerslist" class="table table-sm 'display responsive nowrap'" width="100%"> -->
                                                <table id="groupownerslist" class="table table-sm 'display nowrap'" width="100%">
                                                    <thead class="table-light">
                                                            <tr>
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </thead>
                                                    <!-- <tfoot class="table-light"> -->
                                                    <!-- <tfoot>
                                                            <tr> -->
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <!-- <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </tfoot> -->
                                                </table>
                                            </div><!-- table-responsive -->
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </div><!-- col -->
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="GlobalAdminSelect" id="GlobalAdminSelect" class="btn btn-success btn-sm">Done</button>
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                            </div><!-- row -->
                        </div> <!--Table Responsive-->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->

<!--***************************** Elder MODAL ***********************************-->
<!--***************************** Elder MODAL ***********************************-->
<!--***************************** Elder MODAL ***********************************-->

<div class="modal fade" id="ModalElderSelect" tabindex="-1" role="dialog" aria-labelledby="ElderLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ElderLabel">Elders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <!-- <span id="newgroupname"></span> --> 
                </h6>
                <form class="border border-light p-2" name='elder' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Elder List Card ************************************** -->
                                    <div class="card bg-light border-primary px-2 my-2 w-100">
                                        <div class="card-body">
                                            <div class="table-responsive-xs">
                                                <!-- <table id="groupownerslist" class="table table-sm 'display responsive nowrap'" width="100%"> -->
                                                <table id="elderlist" class="table table-sm 'display nowrap'" width="100%">
                                                    <thead class="table-light">
                                                            <tr>
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </thead>
                                                    <!-- <tfoot class="table-light"> -->
                                                    <!-- <tfoot>
                                                            <tr> -->
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <!-- <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </tfoot> -->
                                                </table>
                                            </div><!-- table-responsive -->
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </div><!-- col -->
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="ElderSelect" id="ElderSelect" class="btn btn-success btn-sm">Done</button>
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                            </div><!-- row -->
                        </div> <!--Table Responsive-->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->

<!--***************************** Deacon MODAL ***********************************-->
<!--***************************** Deacon MODAL ***********************************-->
<!--***************************** Deacon MODAL ***********************************-->

<div class="modal fade" id="ModalDeaconSelect" tabindex="-1" role="dialog" aria-labelledby="DeaconLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DeaconLabel">Deacons</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <!-- <span id="newgroupname"></span> --> 
                </h6>
                <form class="border border-light p-2" name='deacons' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Deacon List Card ************************************** -->
                                    <div class="card bg-light border-primary px-2 my-2 w-100">
                                        <div class="card-body">
                                            <div class="table-responsive-xs">
                                                <!-- <table id="groupownerslist" class="table table-sm 'display responsive nowrap'" width="100%"> -->
                                                <table id="deaconlist" class="table table-sm 'display nowrap'" width="100%">
                                                    <thead class="table-light">
                                                            <tr>
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </thead>
                                                    <!-- <tfoot class="table-light"> -->
                                                    <!-- <tfoot>
                                                            <tr> -->
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <!-- <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </tfoot> -->
                                                </table>
                                            </div><!-- table-responsive -->
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </div><!-- col -->
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="DeaconSelect" id="DeaconSelect" class="btn btn-success btn-sm">Done</button>
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                            </div><!-- row -->
                        </div> <!--Table Responsive-->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->

<!--***************************** Groups Admin MODAL ***********************************-->
<!--***************************** Groups Admin MODAL ***********************************-->
<!--***************************** Groups Admin MODAL ***********************************-->

<div class="modal fade" id="ModalGroupsAdminSelect" tabindex="-1" role="dialog" aria-labelledby="GroupsAdminLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="GroupsAdminLabel">Groups Administrators</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <!-- <span id="newgroupname"></span> --> 
                </h6>
                <form class="border border-light p-2" name='groupsadmin' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Groups Admin List Card ************************************** -->
                                    <div class="card bg-light border-primary px-2 my-2 w-100">
                                        <div class="card-body">
                                            <div class="table-responsive-xs">
                                                <!-- <table id="groupownerslist" class="table table-sm 'display responsive nowrap'" width="100%"> -->
                                                <table id="groupsadminlist" class="table table-sm 'display nowrap'" width="100%">
                                                    <thead class="table-light">
                                                            <tr>
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </thead>
                                                    <!-- <tfoot class="table-light"> -->
                                                    <!-- <tfoot>
                                                            <tr> -->
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <!-- <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </tfoot> -->
                                                </table>
                                            </div><!-- table-responsive -->
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </div><!-- col -->
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="GroupsAdminSelect" id="GroupsAdminSelect" class="btn btn-success btn-sm">Done</button>
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                            </div><!-- row -->
                        </div> <!--Table Responsive-->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->

<!--***************************** Prayer Admins MODAL ***********************************-->
<!--***************************** Prayer Admins MODAL ***********************************-->
<!--***************************** Prayer Admins MODAL ***********************************-->

<div class="modal fade" id="ModalPrayerAdminSelect" tabindex="-1" role="dialog" aria-labelledby="PrayerAdminLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PrayerAdminLabel">Prayer Administrators</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <!-- <span id="newgroupname"></span> --> 
                </h6>
                <form class="border border-light p-2" name='prayeradmin' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Prayer Admin List Card ************************************** -->
                                    <div class="card bg-light border-primary px-2 my-2 w-100">
                                        <div class="card-body">
                                            <div class="table-responsive-xs">
                                                <!-- <table id="groupownerslist" class="table table-sm 'display responsive nowrap'" width="100%"> -->
                                                <table id="prayeradminlist" class="table table-sm 'display nowrap'" width="100%">
                                                    <thead class="table-light">
                                                            <tr>
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </thead>
                                                    <!-- <tfoot class="table-light"> -->
                                                    <!-- <tfoot>
                                                            <tr> -->
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <!-- <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </tfoot> -->
                                                </table>
                                            </div><!-- table-responsive -->
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </div><!-- col -->
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="PrayerAdminSelect" id="PrayerAdminSelect" class="btn btn-success btn-sm">Done</button>
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                            </div><!-- row -->
                        </div> <!--Table Responsive-->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->

<!--***************************** Registration Admins MODAL ***********************************-->
<!--***************************** Registration Admins MODAL ***********************************-->
<!--***************************** Registration Admins MODAL ***********************************-->

<div class="modal fade" id="ModalRegistrationAdminSelect" tabindex="-1" role="dialog" aria-labelledby="RegistrationAdminLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RegistrationAdminLabel">Registration Administrators</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <!-- <span id="newgroupname"></span> --> 
                </h6>
                <form class="border border-light p-2" name='registrationadmin' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Registration Admin List Card ************************************** -->
                                    <div class="card bg-light border-primary px-2 my-2 w-100">
                                        <div class="card-body">
                                            <div class="table-responsive-xs">
                                                <!-- <table id="groupownerslist" class="table table-sm 'display responsive nowrap'" width="100%"> -->
                                                <table id="registrationadministratorslist" class="table table-sm 'display nowrap'" width="100%">
                                                    <thead class="table-light">
                                                            <tr>
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </thead>
                                                    <!-- <tfoot class="table-light"> -->
                                                    <!-- <tfoot>
                                                            <tr> -->
                                                                <!-- <th class="dtr-ownercolumn"></th> -->
                                                                <!-- <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </tfoot> -->
                                                </table>
                                            </div><!-- table-responsive -->
                                        </div><!-- card-body -->
                                    </div><!-- card -->
                                </div><!-- col -->
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="RegistrationlAdminSelect" id="RegistrationlAdminSelect" class="btn btn-success btn-sm">Done</button>
                                        </div>
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- btn-group -->
                            </div><!-- row -->
                        </div> <!--Table Responsive-->
                    </div> <!-- modaleditform -->
                </form>
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal fade -->

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