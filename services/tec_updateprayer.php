<?php 
// Process prayer request updates and upload to database
// Updated 20210724
// Called from tec_myprayer.php (for prayer originator)
// Called from tec_prayeradmin.php (for prayer submittal on behalf of user)
session_start();
if(!$_SESSION['logged in']) {
	header("location:../tec_welcome.php");
	exit();
}
// ***************************** Calls to required scripts ********************************
// ***************************** Calls to required scripts ********************************
// ***************************** Calls to required scripts ********************************
require_once('../tec_dbconnect.php');
include_once('../includes/event_logs_update.php');

// Embed jquery script to enable prayer_request_to_sendmail.js
echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";
// Enable sendmail script to notify Admins re: register request
echo "<script type='text/javascript' src='../js/prayer_request_to_sendmail.js'></script>";

// Extract email theme elements from config.xml
if (file_exists("../_tenant/Config.xml")) {
	$xml = simplexml_load_file("../_tenant/Config.xml");
	$themename = $xml->customer->name;
	$themedomain = $xml->customer->domain;
	$themetitle = $xml->customer->hometitle;
	$themecolor = $xml->customer->banner_color;
	$themeforecolor = $xml->customer->banner_forecolor;
	$prayer_email_banner = $xml->customer->email_banner;
	$prayupdatenotifyfrom = $xml->customer->pray_update_notify_from;
} else {
	echo "<script language='javascript'>";
	echo "console.log('Failed to open ../_tenant/Config.xml');";
	echo "</script>";
	// exit("Failed to open ../_tenant/Config.xml.");
}    


if(isset($_POST['ModalSaveupdateexistingprayer'])) 
{
	// Process Prayer Request Update: Called from tec_myprayer.php
	$LoginID = $_SESSION['user_id'];
	$prayer_ID = $_POST['prayerID'];
	$prayer_owner = $_POST['requestorID'];
	$prayer_name = $_POST['fullname'];
	$prayer_email = $_POST['email'];
	$prayer_onbehalfof = $_POST['onbehalfof'];
	$prayer_title = $_POST['prayerTitle'];
	$update_text = $_POST['prayupdatetext'];
	$update_text_slashed = addslashes($update_text);
	// Atttempt to allow carriage return line breaks without uncaught exception error when added into a function
	// $update_text_slashed_crlf = nl2br($update_text_slashed);
	$update_text_slashed_crlf = str_replace("\r\n", "<br />", $update_text_slashed);

	// ***************************** INSERT Prayer Update into prayerupdate Table ********************************
	// ***************************** INSERT Prayer Update into prayerupdate Table ********************************
	// ***************************** INSERT Prayer Update into prayerupdate Table ********************************
		$prayer_answered = "TBD";
		$updateprayerqueryselect = "INSERT INTO " . $_SESSION['prayerupdate'] . "(prayer_id, owner_id, name, update_text) VALUES (?, ?, ?, ?)";
		$updateprayerquery = $mysql->prepare($updateprayerqueryselect);
		$updateprayerquery->bind_param("ssss",$prayer_ID,$prayer_owner,$prayer_name,$update_text);
		$updateprayerquery->execute();

		// Get ID from above Insert
		$updateprayerqueryselect_DirID = $mysql->insert_id;
		if($updateprayerquery->error) {
			echo " SQL query Prayer Update submit error. Error:" . $updateprayerquery->errno . " " . $updateprayerquery->error;
		}
		else {
			eventLogUpdate('prayer_update', "UserID: " .  $prayer_owner, "Prayer Request updated", "PrayerID: " . $prayer_ID);
			// Send prayer request update email to subscribers
			echo "
				<script type='text/javascript'>
				prayerrequestupdate('$prayer_ID', '$prayer_email', '$prayer_owner', '$prayer_name', '$LoginID', '$prayer_answered', '$themename', '$themedomain', '$themetitle', '$themecolor', '$themeforecolor', '$prayer_email_banner', '$prayer_title', '$update_text_slashed_crlf');
				</script>
			";
			// ***************************** UPDATE original Prayer request to acknowledge an Update has been added ********************************
			// ***************************** UPDATE original Prayer request to acknowledge an Update has been added ********************************
			// ***************************** UPDATE original Prayer request to acknowledge an Update has been added ********************************
			$updateprayerqueryupdateselect = "UPDATE " . $_SESSION['prayertable'] . " SET updated = '1'";
			// if($prayer_answered == '1') {
			// 	$updateprayerqueryupdateselect .= ", answer = '1'";
			// }
			$updateprayerqueryupdateselect .= " WHERE prayer_id = '$prayer_ID'";
			$updateprayerqueryupdate = $mysql->query($updateprayerqueryupdateselect) or die(" Error updating Prayer table after update. Error : " . $mysql->errno . " : " . $mysql->error);
		}
		$mysql->close();
		// DO NOT ATTEMPT TO CLOSE A NON-PARAMETERIZED QUERY 

	// if(!$updateprayerquery)
	// 	{
	// 		die("A database error has occurred when attempting to insert Prayer Update table after update. Please notify your administrator with the following. Error : ".mysql_errno().mysql_error());
	// 	}
	// if(!$updateprayerqueryupdate)
	// 	{
	// 		die("A database error has occurred when attempting to modify Prayer table after update. Please notify your administrator with the following. Error : ".mysql_errno().mysql_error());
	// 	}


	}
// header("location:tecfamview.php?id=" . $prayer_owner);
?>

