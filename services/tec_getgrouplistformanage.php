<?php
// ****************************** Get Group Data **************************************
// Called by tec_groups.php 
// Created 20220113 - Necessary for capturing all group metadata that is not being displayed in the Group Admin table
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('../tec_dbconnect.php');

// Query groups listing: both active and inactive
		$groupquery = "SELECT g.group_id AS groupid, g.group_status AS groupstatus, g.create_date AS createdate, g.group_name AS groupname, l.fullname AS groupcreatedby, g.group_description AS groupdescription, c.category_name AS groupcategory FROM " . $_SESSION['groupstablename'] . " g INNER JOIN " . $_SESSION['logintablename'] . " l on g.group_created_by_id = l.login_ID INNER JOIN " . $_SESSION['groupcattablename'] . " c on g.group_category_id = c.category_id ORDER BY g.group_name ASC";
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
				$groupid = $activerow['groupid'];
				$groupstatus = $activerow['groupstatus'];
				if($groupstatus == 1)
				{
					$groupstatus = "Active";
				}
				else{
					$groupstatus = "Inactive";
				}
				$groupcreatedate = date("M d, Y", strtotime($activerow['createdate']));
				$groupname = $activerow['groupname'];	
				$groupcreatedby = $activerow['groupcreatedby'];				
				$groupdesc = $activerow['groupdescription'];				
				$groupcategory = $activerow['groupcategory'];

				// Stores each database record to an array 
					$buildjson = array('group_id' => $groupid, 'group_status' => $groupstatus, 'create_date' => $groupcreatedate, 'group_name' => $groupname, 'group_created_by' => $groupcreatedby, 'group_desc' => $groupdesc, 'group_category' => $groupcategory); 
 					// Adds each array into the container array 
 					array_push($listarray, $buildjson); 
			}
			// Prepend array with parent element
			// $listarray = array('data' => $listarray);
	header('Content-type: application/json');
	echo json_encode($listarray); 

?>


