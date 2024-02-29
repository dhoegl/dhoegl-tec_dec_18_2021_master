<?php 
// Process new prayer request and upload to prayer table
// Updated 20211221
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
    // Event Log  trap
    require_once('../includes/event_logs_update.php');
	// Embed jquery script to enable prayer_request_to_sendmail.js
	echo "<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>";
	// Enable sendmail script to notify Admins re: register request
	echo "<script type='text/javascript' src='../js/prayer_request_to_sendmail.js'></script>";

	if(isset($_POST['submitnewprayer'])) 
	{
	// Extract email theme elements from config.xml
	if (file_exists("../_tenant/Config.xml")) {
		$xml = simplexml_load_file("../_tenant/Config.xml");
		$themename = $xml->customer->name;
		$themedomain = $xml->customer->domain;
		$themetitle = $xml->customer->hometitle;
		$themecolor = $xml->customer->banner_color;
		$emailbanner = $xml->customer->email_banner;
		$themeforecolor = $xml->customer->banner_forecolor;
		$themenavlogo = $xml->customer->nav_logo;
		$prayupdatenotifyfrom = $xml->customer->pray_update_notify_from;
} else {
		// echo "<script language='javascript'>";
		// echo "console.log('Failed to open ../_tenant/Config.xml');";
		// echo "</script>";
		// exit("Failed to open ../_tenant/Config.xml.");
	}    
		// Process new Prayer Request: 
		$LoginID = $_SESSION['user_id'];
		$prayer_owner = $_POST['requestorID'];
		$prayer_name = $_POST['fullname'];
		$prayer_onbehalfof = $_POST['onbehalfof'];
// convert to ensure copy/paste doesn't expose special characters
		$prayer_onbehalfof = mb_convert_encoding($prayer_onbehalfof, "UTF-8"); 
		$prayer_onbehalfof_slashed = addslashes(mb_convert_encoding($prayer_onbehalfof, "UTF-8")); 
		$prayer_email_from = $_POST['email'];
		$prayer_visible = $_POST['visible'];
		$prayer_praise = $_POST['praypraise'];
		$prayer_title = $_POST['praytitle'];
		$prayer_text = $_POST['praytext'];
		$prayer_title = mb_convert_encoding($prayer_title, "UTF-8"); // convert to ensure copy/paste doesn't expose special characters
		$prayer_title_slashed = addslashes(mb_convert_encoding($prayer_title, "UTF-8")); // convert to ensure copy/paste doesn't expose special characters
		$prayer_title_slashed_crlf = str_replace("\r\n", "<br />", $prayer_title_slashed);
		$prayer_text = mb_convert_encoding($prayer_text, "UTF-8"); // convert to ensure copy/paste doesn't expose special characters
		$prayer_text_slashed = addslashes(mb_convert_encoding($prayer_text, "UTF-8")); // convert to ensure copy/paste doesn't expose special characters
		$prayer_text_slashed_crlf = str_replace("\r\n", "<br />", $prayer_text_slashed);
		// If PrayerAdmin sends out a prayer request, use On Behalf Of as the name of the prayer requestor 
		if($prayer_onbehalfof) {
			$prayer_name = $prayer_onbehalfof_slashed;
		}
		$newprayerquery = "INSERT INTO " . $_SESSION['prayertable'] . "(owner_id, name, title, pray_praise, visible, prayer_text) VALUES (?,?,?,?,?,?)";
		$newprayerupdate = $mysql->prepare($newprayerquery);
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
				// send prayer request email to church elders for them to contact the requestor directly
				echo "
					<script type='text/javascript'>
					prayerrequesteldernew('$newprayerID', '$prayer_email_from', '$prayer_owner', '$prayer_name', '$LoginID', '$themename', '$themedomain', '$themetitle', '$themecolor', '$themeforecolor', '$emailbanner', '$prayer_title_slashed_crlf', '$prayer_text_slashed_crlf');
					</script>
				";
				/* send prayer request to all Elders */
				// $elderpraymail = @mysql_query("SELECT * FROM " . $_SESSION['logintablename'] . " WHERE elder = 'Y'");
				// $elderpraylink = "https://trinityevangel.ourfamilyconnections.org";								
				// while($elderprayrow = @mysql_fetch_assoc($elderpraymail))
				// 	{
				// 		$elderpraytest = $elderprayrow['email_addr'];									
				// 		$elderprayto = $elderpraytest . " , " . $elderprayto;
				// 	}									
				// $elderpraysubject = "Prayer Request to Elders"."\n..";
				// $elderpraymessage = "Hello Elders! " . "<br /><strong>" . $prayer_name . "</strong> has sent you a prayer request with the following details.<br /><br /><strong>TITLE:</strong> " . $prayer_title . "<br />" . $prayer_text . "." . "<br /><br />To send an email response, use the following email address:<br /><br />" . $prayer_email_from;
				// $elderprayfrom = "elderprayer@ourfamilyconnections.org";
				// $elderprayheaders = "From:" . $elderprayfrom .  "\r\n";
				// $elderprayheaders .= "MIME-Version: 1.0\r\n";
				// $elderprayheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				// mail($elderprayto,$elderpraysubject,$elderpraymessage,$elderprayheaders);
			}
		}
	}
	$mysql -> close();
?>

