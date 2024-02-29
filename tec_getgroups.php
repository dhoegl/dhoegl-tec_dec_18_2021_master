<?php
// ****************************** Get Group Data **************************************
// Called by tec_view_groups.php 
// Created 20220108
// Updated 20220112 - INNER JOIN group_category and login tables for group metadata 
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('tec_dbconnect.php');

// Query groups listing: both active and inactive
		$groupquery = "SELECT g.group_id AS groupid, g.group_status AS groupstatus, g.create_date AS createdate, g.group_name AS groupname, l.fullname AS groupowner, g.group_description AS groupdescription, c.category_name AS groupcategory FROM " . $_SESSION['groupstablename'] . " g INNER JOIN " . $_SESSION['logintablename'] . " l on g.group_created_by_id = l.login_ID INNER JOIN " . $_SESSION['groupcattablename'] . " c on g.group_category_id = c.category_id ORDER BY g.group_name ASC";
		$groupresult = $mysql->query($groupquery) or die(" SQL query error at select groups. Error #: " . $mysql->errno . " : " . $mysql->error);
		$groupcount = $groupresult->num_rows;

		$listarray = array();
		$empty_list = array();

		if ($groupcount == 0)
		{
            $buildjson = array(" ", " ", " ", "no group data", " ", "no group data", " ", " ", " ", );
            array_push($listarray, $buildjson);
            $listarray = array('data' => $listarray);
            echo json_encode($listarray);
            exit;
		}
		while($activerow = $groupresult->fetch_assoc()) {
				$groupcontrol = "<tr><td></td>";
				$groupid = "<td>" . $activerow['groupid'] . "</td>";
				$groupstatus = $activerow['groupstatus'];
				if($groupstatus == 1)
				{
					$groupstatus = "<td>Active</td>";
				}
				else{
					$groupstatus = "<td>Inactive</td>";
				}
				$groupcreatedate = "<td>" . date("M d, Y", strtotime($activerow['createdate'])) . "</td>";
				$groupname = "<td>" . $activerow['groupname'] . "</td>";				
				$groupowner = "<td>" . $activerow['groupowner'] . "</td>";				
				$groupdesc = "<td>" . $activerow['groupdescription'] . "</td>";				
				$groupcategory = "<td>" . $activerow['groupcategory'] . "</td>";
				$group_manage_button = "<td><button type='button' class='btn btn-success btn-sm' data-toggle='modal'>Manage</button></td>";
				$group_email_button = "<td><button type='button' class='btn btn-primary btn-sm email_column' data-toggle='modal' data-target='#ModalTBD'>Send Email</button></td></tr>";

				// Stores each database record to an array 
					$buildjson = array($groupcontrol, $groupid, $groupstatus, $groupcreatedate, $groupname, $groupowner, $groupdesc, $groupcategory, $group_manage_button, $group_email_button); 
 					// Adds each array into the container array 
 					array_push($listarray, $buildjson); 
			}
			// Prepend array with parent element
			$listarray = array('data' => $listarray);
	header('Content-type: application/json');
	echo json_encode($listarray); 

?>


