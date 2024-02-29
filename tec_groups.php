<?php 
session_start();
// Updated 20220108 - New Group Module  
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
    require_once('tec_dbconnect.php');
    require_once('fpdf/fpdf.php');
    // Event Log  trap
    include('includes/event_logs_update.php');

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
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />


  <!-- Call Moment js for date calc functions -->
  <script src="js/moment.js"></script>
  <!-- JQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>


<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts -->
<!-- jQuery functions & scripts  -->

<?php
// Get User Login details
    include('includes/tec_get_loggedinuser.php');

// Get registered users List
    include('includes/tec_view_registeredusers.php');

// Get existing groups List
    include('includes/tec_view_groups.php');
?>

<!--***************************** Owner list update for new Group ***********************************-->
<!--***************************** Owner list update for new Group ***********************************-->
<!--***************************** Owner list update for new Group ***********************************-->

<script type="text/javascript">
var groupname = "0";
var jQ11 = jQuery.noConflict();
jQ11(document).ready(function () {
    jQ11("#group_owner_select").on("click", function () {
        console.log("********** Owner SELECT button clicked ************");
        groupName = jQ11("#groupname").text();
        jQ11("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        // Display New Group Owner Select popup
        jQ11("#ModalGroupOwnerSelect").modal('show');

        // **************************** Get Which Owner was selected ********************
        var OwnerSelected = "";
        var OwnerUnselected = "";
        // Visually present which row checkbox is clicked, while also extinguishing the previously-clicked checkbox
        jQ11("#groupownerslist tbody").off("click", '.owner_select', function () {
        });
        jQ11("#groupownerslist tbody").on("click", '.owner_select', function () {
        // if checkbox is checked
            OwnerSelected = jQ11(this).closest("tr").find("td.loginID_hidden").text();
            var OwnercheckBoxID = "OwnerID_" + OwnerSelected;
            console.log("OwnercheckBoxID = " + OwnercheckBoxID);
            var checkBox = document.getElementById(OwnercheckBoxID);
            if(checkBox.checked == true) {
                jQ11(this).closest("tr").css({"background": "lightgreen"});
                OwnerSelected = "0";
                console.log("Selected = " + OwnerSelected); 
            }
            else {
                jQ11(this).closest("tr").css({"background": "white"});
                OwnerUnselected = "0";
                OwnerUnselected = jQ11(this).closest("tr").find("td.loginID_hidden").text();
                console.log("UnSelected = " + OwnerUnselected);
            }
        });
    });
});

</script>

<!--***************************** Member list update for new Group ***********************************--> 
<!--***************************** Member list update for new Group ***********************************-->
<!--***************************** Member list update for new Group ***********************************-->

<script type="text/javascript">
var groupname = "0";
var jQ11 = jQuery.noConflict();
jQ11(document).ready(function () {
    jQ11("#group_member_select").on("click", function () {
        console.log("********** Member SELECT button clicked ************");
        // groupName = jQ11("#groupname").text();
        // jQ11("#newgroupname").html("<h6> Group Name: " + groupName + "</h6>");
        // Display New Group Owner Select popup
        jQ11("#ModalGroupMemberSelect").modal('show');
        // **************************** Get Which Member was selected ********************
        var MemberSelected = "";
        var MemberUnselected = "";
        // Visually present which row checkbox is clicked, while also extinguishing the previously-clicked checkbox
        jQ11("#groupmemberslist tbody").off("click", '.member_select', function () {
        });
        jQ11("#groupmemberslist tbody").on("click", '.member_select', function () {
        // if checkbox is checked
        MemberSelected = jQ11(this).closest("tr").find("td.loginID_hidden").text();
            var MembercheckBoxID = "MemberID_" + MemberSelected;
            console.log("MembercheckBoxID = " + MembercheckBoxID);
            var checkBox = document.getElementById(MembercheckBoxID);
            if(checkBox.checked == true) {
                jQ11(this).closest("tr").css({"background": "lightgreen"});
                MemberSelected = "0";
                console.log("Selected = " + MemberSelected); 
            }
            else {
                jQ11(this).closest("tr").css({"background": "white"});
                MemberUnselected = "0";
                MemberUnselected = jQ11(this).closest("tr").find("td.loginID_hidden").text();
                console.log("UnSelected = " + MemberUnselected);
            }
        });



    });
});

</script>

<!--***************************** Get Master Group List - Necessary for extraction of hidden fields pulled from tec_getgroups script ***********************************-->
<!--***************************** Get Master Group List - Necessary for extraction of hidden fields pulled from tec_getgroups script ***********************************-->
<!--***************************** Get Master Group List - Necessary for extraction of hidden fields pulled from tec_getgroups script ***********************************-->
<script type="text/javascript">
	var jQ19 = jQuery.noConflict();
    var loginID = <?php echo $_SESSION['user_id']; ?>;
    var masterresponse;
    var obj = [];
    var id = 0;
    var p_status = [];
    var p_created = [];
    var p_createdby = [];
    var p_name = [];
    var p_owner = [];
    var p_desc = [];
    var p_cat = [];
    var p_members = [];
    var activegroupcount;
	jQ19(document).ready(function() {
		var mastergroup = jQ19.ajax({
        url: 'services/tec_getgrouplistformanage.php',
		type: 'POST',
		dataType: 'json',
		data: {login_ID: loginID}
		})
        mastergroup.done(function (masterresponse) {
                    //  Get the details for all active prayer requests
                    activegroupcount = masterresponse.length;
                    console.log('number of active groups = ' + activegroupcount);
                    var i = 0;
                    while (masterresponse[i]) {
                        obj[i] = masterresponse[i].group_id;
                        // console.log('obj[i] = ' + obj[i]);
                        id = obj[i];
                        p_status[id] = masterresponse[i].group_status;
                        // console.log("p_status[id] = " + p_status[id]);
                        p_created[id] = masterresponse[i].create_date;
                        // console.log("p_created[id] = " + p_created[id]);
                        p_name[id] = masterresponse[i].group_name;
                        p_createdby[id] = masterresponse[i].group_created_by;
                        p_desc[id] = masterresponse[i].group_desc;
                        p_cat[id] = masterresponse[i].group_category;
                        i++
                    }
                })
    });
</script>

<!-- **************************** Get Which Group Item's 'MANAGE' button was clicked ******************** -->
<!-- **************************** Get Which Group Item's 'MANAGE' button was clicked ******************** -->
<!-- **************************** Get Which Group Item's 'MANAGE' button was clicked ******************** -->

<script type="text/javascript">
	var testforChild = "0";
    var LoginID = "0";
    var groupID = "0";
    var groupStatus = "0";
    var groupCreated = "0";
    var groupName = "0";
    var groupOwner = "0";
    var groupDesc = "0";
    var groupCategory = "0";
    
    var jQ12 = jQuery.noConflict();
	jQ12(document).ready(function() {
        // Invoke Manage Group modal
        jQ12("#groupstable tbody").off("click", '.manage_column');
        jQ12("#groupstable tbody").on("click", '.manage_column', function () {
        testforChild = jQ12(this).closest('tr');
        if (testforChild.hasClass("child")) {
            console.log("Child IS closest TR class **** HAS CHILD ****");
            groupID = testforChild.prev("tr").find(".indexcol").text();
            // clickbuttonid = groupID;
            // $group_ID = groupID;
//********************* Load Group Data into Modal **************************
            group_ID = groupID;
            // var mastergroup = jQ12.ajax({
            //     url: 'services/group_session_setup.php',
            //     type: 'POST',
            //     dataType: 'json',
            //     data: {
            //         group_cat: p_cat[group_ID],
            //         group_desc: p_desc[group_ID],
            //         group_stat: p_status[group_ID],
            //     },
            // });
            // The ajax call succeeded.
            // mastergroup.done(function (data)
            // {
            //     console.log('category = ' + data[0].category);
            //     console.log('description = ' + data[0].description);
            //     console.log('status = ' + data[0].status);
                    
            jQ12("#ModalEditgroupID").html(group_ID);
            console.log("Group ID = " + group_ID);
            groupCreated = p_created[group_ID];
            jQ12("#ModalEditgroupCreated").html(groupCreated);
            console.log("Group Created = " + groupCreated);
            groupName = p_name[group_ID];
            jQ12("#ModalEditgroupName").attr("value",groupName);
            console.log("Group Name = " + groupName);
            groupCategory = p_cat[group_ID];
            // jQ12("#ModalEditgroupCategory").html(groupCategory);
            // jQ12("#ModalEditgroupCategory").attr("value",groupCategory);
            document.getElementById("ModalEditgroupCategory").value = groupCategory;
            console.log("Group Category = " + groupCategory);
            // groupStatus = p_status[group_ID];
            // jQ12("#ModalEditgroupStatus").attr("value",groupStatus);
            // $groupStatus = groupStatus;
            // console.log("Group Status = " + groupStatus);
            groupCreatedBy = p_createdby[group_ID];
            jQ12("#ModalEditgroupCreatedBy").attr("value",groupCreatedBy);
            console.log("Group Created By = " + groupCreatedBy);
            groupDesc = p_desc[group_ID];
            // jQ12("#ModalEditgroupDesc").attr("value",groupDesc);
            document.getElementById("ModalEditgroupDesc").value = groupDesc;
            console.log("Group Description = " + groupDesc);
            // Display Group Details popup
            jQ12("#ModalGroupManage").modal('show');
            // });
        }
        else {
            console.log("Child IS NOT closest TR class **** NOT CHILD ****");
            groupID = jQ12(this).closest('tr').find(".indexcol").text();
//********************* Load Group Data into Modal **************************
            group_ID = groupID;

            // var mastergroup = jQ12.ajax({
            //     url: 'services/group_session_setup.php',
            //     type: 'POST',
            //     dataType: 'json',
            //     data: {
            //         group_cat: p_cat[group_ID],
            //         group_desc: p_desc[group_ID],
            //         group_stat: p_status[group_ID],
            //     },
            // });
            // The ajax call succeeded.
            // mastergroup.done(function (data) {
            //     console.log('category = ' + data[0].category);
            //     console.log('description = ' + data[0].description);
            //     console.log('status = ' + data[0].status);

            jQ12("#ModalEditgroupID").html(group_ID);
            console.log("Group ID = " + group_ID);
            groupCreated = p_created[group_ID];
            jQ12("#ModalEditgroupCreated").html(groupCreated);
            console.log("Group Created = " + groupCreated);
            groupName = p_name[group_ID];
            jQ12("#ModalEditgroupName").attr("value",groupName);
            console.log("Group Name = " + groupName);
            groupCategory = p_cat[group_ID];
            // jQ12("#ModalEditgroupCategory").html(groupCategory);
            // jQ12("#ModalEditgroupCategory").attr("value",groupCategory);
            document.getElementById("ModalEditgroupCategory").value = groupCategory;
            console.log("Group Category = " + groupCategory);
            // groupStatus = p_status[group_ID];
            // jQ12("#ModalEditgroupStatus").attr("value",groupStatus);
            // $groupStatus = groupStatus;
            // console.log("Group Status = " + groupStatus);
            groupCreatedBy = p_createdby[group_ID];
            jQ12("#ModalEditgroupCreatedBy").attr("value",groupCreatedBy);
            console.log("Group Created By = " + groupCreatedBy);
            groupDesc = p_desc[group_ID];
            // jQ12("#ModalEditgroupDesc").attr("value",groupDesc);
            document.getElementById("ModalEditgroupDesc").value = groupDesc;
            console.log("Group Description = " + groupDesc);
            // Display Group Details popup
            jQ12("#ModalGroupManage").modal('show');
            // });
        }
    });
});
</script>


<!-- **************************** Get Which Group Item's 'Send Email' button was clicked ******************** -->
<!-- **************************** Get Which Group Item's 'Send Email' button was clicked ******************** -->
<!-- **************************** Get Which Group Item's 'Send Email' button was clicked ******************** -->
<script type="text/javascript">
	var jQ30 = jQuery.noConflict();
	jQ30(document).ready(function() {
        // Send Email using client email application
        jQ30("#groupstable tbody").off("click", '.email_column');
        jQ30("#groupstable tbody").on("click", '.email_column', function () {
        var testforChild = "0";
        var LoginID = "0";
        var Email = "0";
        var testforChild = jQ30(this).closest('tr');
        if (testforChild.hasClass("child")) {
            console.log("Child IS closest TR class");
            // LoginID = testforChild.prev("tr").find(".loginid").text();
            Email = testforChild.prev("tr").find(".group_name").text();
            window.location.href = "mailto:" + Email + "?subject=Message to the group...";
        }
        else {
            console.log("Child IS NOT closest TR class");
            // LoginID = jQ30(this).closest('tr').find(".loginid").text();
            // jQ30("#loginidReject").html("<h6> LoginID: " + LoginID + "</h6>");
            Email = jQ30(this).closest('tr').find(".group_name").text();
            // jQ30("#emailReject").html("<h6> Email: " + Email + "</h6>");
            window.location.href = "mailto:" + Email + "?subject=Message to the group...";
        }

        });
    });
</script>

</head>
<body>

<!-- ****************************** Navbar ********************************** -->
<!-- ****************************** Navbar ********************************** -->
<!-- ****************************** Navbar ********************************** -->
<?php
$activeparam = '5'; // sets nav element highlight
require_once('tec_nav.php');
require_once('includes/tec_footer.php');
?>
<!-- Intro Section -->
<div class="container-fluid profile_bg bottom-buffer">
            <div class="row pt-2">
                <div class="col-xs-6">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        How to...
                    </button>
                </div><!-- col xs-6 -->
                <!-- <div class="col-xs-6">
                        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseRequests" aria-expanded="false" aria-controls="collapseRequests">
                            My Requests
                        </button>
                </div> -->
                <div class="col-xs-6">
                    <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#ModalGroupNew" aria-expanded="false">
                        New Group
                    </button>
                    <!-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            New Group
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" data-toggle="modal" data-target="#ModalGroupNew" type="button">New Group</button> -->
                            <!-- <button class="dropdown-item" data-toggle="modal" data-target="" type="button">Export Prayer Requests</button> -->
                        <!-- </div>
                    </div>dropdown -->
                </div><!-- col xs-6 -->
            </div><!-- row -->
        <div class="collapse" id="collapseExample">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-body">
                        <h4 class="card-title">
                            Managing Groups 
                        </h4>
                        <ul class="card-text">
                            <li>The table below lists all created Groups</li>
                            <li>Click on a header arrow to sort columns ascending or descending</li>
                            <li>Use the Search box to locate a specific Group</li>
                            <li>Navigate pages using the Page Selector at the bottom of the page</li>
                            <li>Click the <span><img src="https://datatables.net/examples/resources/details_open.png"></img></span> icon to display more details</li>
                            <li>Click the <span class="btn btn-success btn-sm">Manage</span> button on a row below to see more information about a specific Group</li>
                            <li>Click the <span class="btn btn-primary btn-sm">Send Email</span> button on a row below to send an email to the Group</li>
                            <li>On the New Group popup</li>
                            <ul>
                                <li>Click the <span class="btn btn-success btn-sm">Add Owners</span> button to add owners to the Group</li>
                                <li>Click the <span class="btn btn-success btn-sm">Add Members</span> button to add members to the Group</li>
                            </ul>
                            <li>On the Group Manage popup</li>
                            <ul>
                                <li>Update the Group Name, Category, or Description field as needed</li>
                                <li>Click the <span class="btn btn-success btn-sm">Owners</span> button to add or remove owners from the Group</li>
                                <li>Click the <span class="btn btn-success btn-sm">Members</span> button to add or remove members from the Group</li>
                                <li>Click the <span class="btn btn-primary btn-sm">Save</span> button to update the details for the Group</li>
                            </ul>
                        </ul>
                    </div><!-- card -->
                </div><!-- col-sm-12 -->
            </div><!-- row -->
        </div><!-- collapse -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-image"
                        style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">
                        <!-- Content -->
                        <div class="text-white text-center d-flex align-items-center rgba-black-strong">
                            <div class="w-100">
                                <h3 class="card-title pt-2"><strong>GROUPS</strong></h3>
                                <p>View and Manage Groups created for your church.</p>
                            </div>
                        </div>
                    </div><!-- Card -->
                </div><!-- Col-md-12 -->
            </div><!-- Row -->
<!-- ******************************* Group List Card ************************************** -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bg-light border-primary px-2 my-2 w-100">
                        <div class="card-body">
                            <div class="table-responsive-xs">
                                <table id="groupstable" class="table table-sm table-striped 'display responsive nowrap'" width="100%">
                                    <thead class="table-dark">
                                            <tr>
                                                <th class="dtr-groupcolumn"></th>
                                                <th>id</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Name</th>
                                                <th>Owner</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Manage</th>
                                                <th>Email</th>
                                            </tr>
                                    </thead>
                                    <tfoot class="table-dark">
                                            <tr>
                                                <th class="dtr-groupcolumn"></th>
                                                <th>id</th>
                                                <th>Status</th>
                                                <th>Created</th>
                                                <th>Name</th>
                                                <th>Owner</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Manage</th>
                                                <th>Email</th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div><!-- table-responsive -->
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col-sm-12 -->
            </div><!-- row -->
</div> <!-- Container -->


<!--***************************** New Group MODAL ***********************************-->
<!--***************************** New Group MODAL ***********************************-->
<!--***************************** New Group MODAL ***********************************-->

<div class="modal fade" id="ModalGroupNew" tabindex="-1" role="dialog" aria-labelledby="NewGrouprModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="NewGrouprModalLabel">New Group<br />Click Submit when done.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> <!-- modal-header -->
            <div class="modal-body">
                <form class="border border-light p-2" name='newgroup' method='post' action='services/tec_newgroup.php'>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-3">
                                    <label for="groupname">Group Name:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Name..." type="text" id="groupname" name='groupname' class="form-control" size="40" />
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-3">
                                    <label for="groupcategory">Category:</label>
                                </div>
                                <div class="col-9">
                                    <select class="custom-select" name="groupcategory" id="groupcategory">
                                        <?php
                                            $category_query = "SELECT * from " . $_SESSION['groupcattablename'];
                                            $category_result = $mysql->query($category_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                                            while($category_row = $category_result->fetch_assoc())
                                            {
                                                $category_optionvalue = $category_row['category_name'];
                                                echo "<option value='" . $category_optionvalue . "'";
                                            echo ">" . $category_optionvalue . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div><!-- row -->
                            <!-- <div class="row">
                                <div class="col-3">
                                    <label for="groupstatus">Status:</label>
                                </div>
                                <div class="col-9">
                                    <select class="custom-select" name="groupstatus" id="groupstatus">
                                        <option value="Active" selected>Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-3">
                                    <label for="group_owner_select">Owners & Members:</label>
                                </div>
                                <div class="col-9">
                                    <!-- <select class="custom-select" name="group_owner_select" id="group_owner_select"> -->
                                    <button type="button" id="group_owner_select" name='group_owner_select' class="btn btn-success btn-sm">Add Owners</button>
                                    <button type="button" id="group_member_select" name='group_member_select' class="btn btn-success btn-sm">Add Members</button>
                                        <?php
                                            // $groupowner_query = "SELECT * from " . $_SESSION['logintablename'] . " WHERE active = '1' order by fullname";
                                            // $groupowner_result = $mysql->query($groupowner_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                                            // while($groupowner_row = $groupowner_result->fetch_assoc())
                                            // {
                                            //     $groupowner_optionvalue = $groupowner_row['fullname'];
                                            //     $selectedowner = $groupowner_row['fullname'];		
                                            //     echo "<option value='" . $groupowner_optionvalue . "'";
                                            // echo ">" . $selectedowner . "</option>";
                                            // }
                                        ?>
                                    </select>
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-3">
                                    <label for="groupdesc">Description:</label>
                                </div>
                                <div class="col-9">
                                    <textarea placeholder="Description..." id="groupdesc" name='groupdesc' class="form-control" rows="5"></textarea>
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <?php				
                                    $fullname = $_SESSION['fullname']; 
                                    echo "<input type='hidden' name='fullname' value= '" . $fullname . "' />";
                                    $email = $_SESSION['email'];
                                    echo "<input type='hidden' name='email' value= '" . $email . "' />";
                                    $requestorID = $_SESSION['user_id'];
                                    echo "<input type='hidden' name='requestorID' value= '" . $requestorID . "' />";
                                ?>
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="submitnewgroup" id="submitnewgroup" class="btn btn-primary btn-sm">Submit</button>
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


<!--***************************** Group Owner MODAL ***********************************-->
<!--***************************** Group Owner MODAL ***********************************-->
<!--***************************** Group Owner MODAL ***********************************-->

<div class="modal fade" id="ModalGroupOwnerSelect" tabindex="-1" role="dialog" aria-labelledby="NewGrouprOwnerLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewGrouprOwnerLabel">Add Owners</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <!-- <span id="newgroupname"></span> --> 
                </h6>
                <form class="border border-light p-2" name='newgroupowner' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Owner List Card ************************************** -->
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
                                            <button type="submit" name="OwnerSelect" id="OwnerSelect" class="btn btn-success btn-sm">Done</button>
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


<!--***************************** Group Member MODAL ***********************************-->
<!--***************************** Group Member MODAL ***********************************-->
<!--***************************** Group Member MODAL ***********************************-->

<div class="modal fade" id="ModalGroupMemberSelect" tabindex="-1" role="dialog" aria-labelledby="NewGrouprMemberLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewGrouprMemberLabel">Add Members</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- modal-header -->
            <div class="modal-body">
                <h6>
                    <span id="newgroupname"></span>
                </h6>
                <form class="border border-light p-2" name='newgroupmember' method='post' action=''>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <div class="row">
                                <!-- <div class="col-3">
                                    <label for="groupowner">Add Owners:</label>
                                </div> -->
                                <div class="col-12">
<!-- ******************************* Owner List Card ************************************** -->
                                    <div class="card bg-light border-primary px-2 my-2 w-100">
                                        <div class="card-body">
                                            <div class="table-responsive-xs">
                                                <!-- <table id="groupownerslist" class="table table-sm 'display responsive nowrap'" width="100%"> -->
                                                <table id="groupmemberslist" class="table table-sm 'display nowrap'" width="100%">
                                                    <thead class="table-light">
                                                            <tr>
                                                                <!-- <th class="dtr-membercolumn"></th> -->
                                                                <th>Select</th>
                                                                <th>Last Name</th>
                                                                <th>First Name</th>
                                                                <th>Email</th>
                                                                <th>loginID</th>
                                                                <th>churchID</th>
                                                            </tr>
                                                    </thead>
                                                    <!-- <tfoot class="table-dark">
                                                            <tr> -->
                                                                <!-- <th class="dtr-membercolumn"></th> -->
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
                                            <button type="submit" name="MemberSelect" id="MemberSelect" class="btn btn-success btn-sm">Done</button>
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




<!--***************************** Manage Group MODAL ***********************************-->
<!--***************************** Manage Group MODAL ***********************************-->
<!--***************************** Manage Group MODAL ***********************************-->

<div class="modal fade" id="ModalGroupManage" tabindex="-1" role="dialog" aria-labelledby="ManageGrouprModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ManageGrouprModalLabel">Manage Group<br />Click Save when done.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> <!-- modal-header  -->
            <div class="modal-body">
                <form class="border border-light p-2" name='managegroup' method='post' action='services/tec_managegroup.php'>
                    <!-- <table id="newpraytable" border='0' cellpadding='0' cellspacing='1' > -->
                    <div class="modaleditform text-center border border-light p-2">
                        <div class="table-responsive">
                            <!-- <div class="row">
                                <div class="col-3">
                                    <label for="ModalEditgroupID">Group ID:</label>
                                </div>
                                <div class="col-9">
                                    <p id="ModalEditgroupID"></p>
                                </div>
                            </div> -->
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <label for="ModalEditgroupName">Group Name:</label>
                                </div>
                                <div class="col-9">
                                    <input placeholder="Name..." type="text" id="ModalEditgroupName" name='ModalEditgroupName' class="form-control" size="40" />
                                </div>
                            </div><!-- row -->
                            <!-- <div class="row">
                                <div class="col-3">
                                    <label for="ModalEditgroupCreated">Created:</label>
                                </div>
                                <div class="col-9">
                                    <p id="ModalEditgroupCreated"></p>
                                </div>
                            </div> -->
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <label for="ModalEditgroupCategory">Category:</label>
                                </div>
                                <div class="col-9">
                                    <select class="custom-select" name="ModalEditgroupCategory" id="ModalEditgroupCategory">
                                        <?php
                                            $category_query = "SELECT * from " . $_SESSION['groupcattablename'];
                                            $category_result = $mysql->query($category_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                                            while($category_row = $category_result->fetch_assoc())
                                            {
                                                $category_optionvalue = $category_row['category_name'];
                                                echo "<option value='" . $category_optionvalue . "'";
                                            echo ">" . $category_optionvalue . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div><!-- row -->
                            <!-- <div class="row">
                                <div class="col-3">
                                    <label for="ModalEditgroupStatus">Status:</label>
                                </div>
                                <div class="col-9">
                                    <select class="custom-select" name="ModalEditgroupStatus" id="ModalEditgroupStatus">
                                        <option value="Active" selected>Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>row -->
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <label for="ModalEditgroupCreatedBy">Created By:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="ModalEditgroupCreatedBy" name='ModalEditgroupCreatedBy' class="form-control" size="40" />
                                </div>
                            </div><!-- row -->
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <label for="ModalEditgroupOwner">Owners & Members:</label>
                                </div>
                                <div class="col-9">
                                    <!-- <select class="custom-select" name="group_owner_select" id="group_owner_select"> -->
                                    <button type="button" id="ModalEditgroupOwner" name='ModalEditgroupOwner' class="btn btn-success btn-sm">Owners</button>
                                    <button type="button" id="ModalEditgroupMember" name='ModalEditgroupMember' class="btn btn-success btn-sm">Members</button>
                                        <?php
                                            // $groupowner_query = "SELECT * from " . $_SESSION['logintablename'] . " WHERE active = '1' order by fullname";
                                            // $groupowner_result = $mysql->query($groupowner_query) or die(" SQL query error. Error:" . $mysql->errno . " : " . $mysql->error);
                                            // while($groupowner_row = $groupowner_result->fetch_assoc())
                                            // {
                                            //     $groupowner_optionvalue = $groupowner_row['fullname'];
                                            //     $selectedowner = $groupowner_row['fullname'];		
                                            //     echo "<option value='" . $groupowner_optionvalue . "'";
                                            // echo ">" . $selectedowner . "</option>";
                                            // }
                                        ?>
                                    </select>
                                </div>
                            </div><!-- row -->
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <label for="ModalEditgroupDesc">Description:</label>
                                </div>
                                <div class="col-9">
                                    <textarea placeholder="Description..." id="ModalEditgroupDesc" name='ModalEditgroupDesc' class="form-control" rows="5"></textarea>
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <?php				
                                    $fullname = $_SESSION['fullname']; 
                                    echo "<input type='hidden' name='fullname' value= '" . $fullname . "' />";
                                    $email = $_SESSION['email'];
                                    echo "<input type='hidden' name='email' value= '" . $email . "' />";
                                    $requestorID = $_SESSION['user_id'];
                                    echo "<input type='hidden' name='requestorID' value= '" . $requestorID . "' />";
                                ?>
                            </div><!-- row -->
                            <div class="row px-2 d-flex justify-content-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Modal Buttons">
                                        <div class="col-sm-4">
                                            <button type="submit" name="Updategroup" id="Updategroup" class="btn btn-primary btn-sm">Save</button>
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



<!--***************************** SCRIPTS ***********************************-->
<!--***************************** SCRIPTS ***********************************-->
<!--***************************** SCRIPTS ***********************************-->
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/MDBootstrap4191/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <!-- <script type="text/javascript" src="js/MDBootstrap4191/bootstrap.min.js"></script> -->
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/MDBootstrap4191/mdb.min.js"></script>
    <!-- Tenant Configuration JavaScript Call in tec_nav -->
    <!-- Datatables JavaScript plugins - Bootstrap-specific -->
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/r-2.2.7/datatables.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.23/r-2.2.6/datatables.min.js"></script>
    <!-- Jan20 Attempt -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

    <!-- Tenant Configuration JavaScript Call -->
    <script type="text/javascript" src="/js/tec_config_ajax_call.js"></script>

</body>
</html>
