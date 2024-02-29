<?php
// ****************************** Get Config Settings **************************************
// Called by tec_admin.php + many other pages  
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}
   require_once('../tec_dbconnect.php');

		// $masterconfigsettingsquery = "SELECT * FROM " . $_SESSION['configsettingstable'] . " ORDER BY settingID";
		$masterconfigsettingsquery = "SELECT * FROM " . $_SESSION['configsettingstable'];
		$masterconfigsettingsresult = $mysql->query($masterconfigsettingsquery) or die(" SQL query error at config settings query. Error #: " . $mysql->errno . " : " . $mysql->error);
		$masterconfigsettingscount = $masterconfigsettingsresult->num_rows;

		$listarray = array();

		while($masterrow = $masterconfigsettingsresult->fetch_assoc()) {
                $mastersettingid = $masterrow['settingID'];
                $mastersettingkey = $masterrow['setting_key'];
				$mastersettingvalue = $masterrow['setting_value'];
				$mastersettingdescription = $masterrow['setting_description'];
				// Stores each database record to an array 
					$buildjson = array('settingid' => $mastersettingid, 'settingkey' => $mastersettingkey, 'settingvalue' => $mastersettingvalue, 'settingdescription' => $mastersettingdescription); 
 					// Adds each array into the container array 
 					array_push($listarray, $buildjson); 
			}
	header('Content-type: application/json');
	echo json_encode($listarray); 

?>


