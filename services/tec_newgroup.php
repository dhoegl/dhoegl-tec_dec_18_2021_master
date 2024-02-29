<?php 
// Process new Group and upload to groups tables 
// Created 20220108
// Called from tec_groups.php
// Updatetd 20220125 - Fixed bugs so that new group can be created and all tables updated
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	exit();
}
// ***************************** Calls to required scripts ********************************
// ***************************** Calls to required scripts ********************************
// ***************************** Calls to required scripts ********************************
	require_once('../tec_dbconnect.php');
    // Event Log  trap
    require_once('../includes/event_logs_update.php');
	// Embed jquery script to enable prayer_request_to_sendmail.js
	echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";

	if(isset($_POST['submitnewgroup'])) 
	{
	// Extract email theme elements from config.xml
// 	if (file_exists("../_tenant/Config.xml")) {
// 		$xml = simplexml_load_file("../_tenant/Config.xml");
// 		$themename = $xml->customer->name;
// 		$themedomain = $xml->customer->domain;
// 		$themetitle = $xml->customer->hometitle;
// 		$themecolor = $xml->customer->banner_color;
// 		$emailbanner = $xml->customer->email_banner;
// 		$themeforecolor = $xml->customer->banner_forecolor;
// 		$themenavlogo = $xml->customer->nav_logo;
// } else {
// 	}    
		// Process new Group: 
		$LoginID = $_SESSION['user_id'];
		$group_owner = $_POST['requestorID'];
		$group_name = $_POST['groupname'];
		$newgroupquery = "INSERT INTO " . $_SESSION['groupstablename'] . "(owner_id, name, title, pray_praise, visible, prayer_text) VALUES (?,?,?,?,?,?)";
		$newgroupupdate = $mysql->prepare($newgroupquery);
		$newprayerupdate->bind_param("ssssss",$prayer_owner,$prayer_name,$prayer_title,$prayer_praise,$prayer_visible,$prayer_text);
		$newprayerupdate->execute();
		// Get Prayer ID from above Insert
		$newprayerID = $mysql->insert_id;
		echo "<script language='javascript'>";
		echo "console.log('New Prayer Request ID = " . $newprayerID . "');";
		echo "</script>";
		if($newprayerupdate->error) {
			echo " SQL query New Prayer submit error. Error:" . $newprayerupdate->errno . " " . $newprayerupdate->error;
		}
		else {
			eventLogUpdate('prayer', "UserID: " .  $prayer_owner, "New Prayer Request submitted", "PrayerID: " . $newprayerID);
			if($prayer_visible == '3') //All Church
			{
				// send prayer request email to administrators for approval
				echo "
					<script type='text/javascript'>
					prayerrequestnew('$newprayerID', '$prayer_email_from', '$prayer_owner', '$prayer_name', '$LoginID', '$themename', '$themedomain', '$themetitle', '$themecolor', '$themeforecolor', '$emailbanner', '$prayer_title_slashed_crlf', '$prayer_text_slashed_crlf');
					</script>
				";
			}
			if($prayer_visible == '1') //Elders Only
			{
				echo "
					<script type='text/javascript'>
					prayerrequesteldernew('$newprayerID', '$prayer_email_from', '$prayer_owner', '$prayer_name', '$LoginID', '$themename', '$themedomain', '$themetitle', '$themecolor', '$themeforecolor', '$emailbanner', '$prayer_title_slashed_crlf', '$prayer_text_slashed_crlf');
					</script>
				";
			}
		}
	}
	$mysql -> close();
?>

