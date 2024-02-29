<?php
//New Prayer Approve script
//Called from tec_prayeradmin.php
//Last Updated 2021/12/30
// Send email to members with 'new_prayer_notify = '2''
// Updated 20211228
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:tec_welcome.php");
	exit();
}
if ( isset($_POST['prayerID']) ) {
	require('../tec_dbconnect.php');
	include('event_logs_update.php');
	$PrayerID = $_POST['prayerID'];
	$PrayerDate = $_POST['prayerDate'];
	$PrayerName = $_POST['prayerName'];
	$PrayerEmail = $_POST['prayerEmail'];
	$PrayerTitle = $_POST['prayerTitle'];
	$PrayerText = $_POST['prayerText'];
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
		}
	else {
		// echo "<script language='javascript'>";
		// echo "console.log('Failed to open ../_tenant/Config.xml');";
		// echo "</script>";
		// exit("Failed to open ../_tenant/Config.xml.");
	}    

	$approveprayerquery = "UPDATE " . $_SESSION['prayertable'] . " SET approved = '1'" .  " WHERE prayer_id = '". $PrayerID . "'";
	$approveprayer = $mysql->query($approveprayerquery) or die("A database error occurred when trying to reject new Prayer Request info into Prayer table. See ajax_reject_prayer.php. Error:" . $mysql->errno . " : " . $mysql->error);
	eventLogUpdate('prayer_update', "Admin ID: " .  $_SESSION['user_id'], "Prayer Request Approve", "prayer_id: " . $PrayerID . " - Requested by: " . $PrayerName);

	$prayernotifyquery = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE new_prayer_notify = '2'";
	$prayernotifyresult = $mysql->query($prayernotifyquery) or die("Prayer Notify function failed at db SELECT. Please notify your administrator with the following. Error : " . $mysql->errno . " : " . $mysql->error);
	while($prayernotifyrow = $prayernotifyresult->fetch_assoc()) {
		$praymailseed = $prayernotifyrow['email_addr'];
		$praymailto = $praymailseed . " , " . $praymailto;
	}
	$praymailfrom = "newprayer@ourfamilyconnections.org";
	$praymaillink = $themedomain;
	$praymailsubject = "New Prayer Request from " . $PrayerName . "\n";
	$praymailmessage = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>";
	$praymailmessage .= "<html lang='en'>";
	$praymailmessage .= "<head>";
	// $praymailmessage .= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
	// $praymailmessage .= "<meta name='viewport' content='width=device-width, initial-scale=1'>";
	// $praymailmessage .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
	$praymailmessage .= "<meta http-equiv='Content-type' content='text/html; charset=utf-8' />
						<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1' />
						<meta http-equiv='X-UA-Compatible' content='IE=edge' />
						<meta name='format-detection' content='date=no' />
						<meta name='x-apple-disable-message-reformatting' />";
						// <meta name='format-detection' content='address=no' />
						// <meta name='format-detection' content='telephone=no' />

	$praymailmessage .= "<title></title>";
	$praymailmessage .= "<style type='text/css'>
						* {-webkit-text-size-adjust: none}
						body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f4f4f4; -webkit-text-size-adjust:none }
						table {max-width: 500px !important}
						a { color:#b04d4d; text-decoration:none }
						p { padding:0 !important; margin:0px 5px 0px 5px !important } 
						img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
						.mcnPreviewText { display: none !important; }

						/* Mobile styles */
						@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) 
						{
							u + .body .gwfw
							{ width:100% !important; width:100vw !important; }
							.m-shell
							{ width: 100% !important; min-width: 100% !important; }
							.m-center 
							{ text-align: center !important; }
							.center 
							{ margin: 0 auto !important; }
							.p10 
							{ padding: 10px !important; }
							.p30-20 
							{ padding: 30px 20px !important; }
							.td 
							{ width: 100% !important; min-width: 100% !important; }
							.m-br-15 
							{ height: 15px !important; }
							.m-td,
							.m-hide 
							{ display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }
							.m-block 
							{ display: block !important; }
							.fluid-img img 
							{ width: 100% !important; max-width: 100% !important; height: auto !important; }
							.logo img 
							{ width: 100% !important; max-width: 190px !important; height: auto !important; }
							.column,
							.column-top,
							.column-bottom 
							{ float: left !important; width: 100% !important; display: block !important; }
							.content-spacing 
							{ width: 15px !important; }
						}
						</style>";
	$praymailmessage .= "</head>";
	$praymailmessage .= "<body style='margin:0; padding:0; background-color:#FFFFFF;'>";
	$praymailmessage .= "<center>";

// Prayer Request Header Table
	$praymailmessage .= "<table width='90%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F2F2F2'>";
	$praymailmessage .= "<tr><td align='center' valign='top'><img src='https://" . $themedomain . $emailbanner . "' width='100%'  style='margin:0; padding:0; border:none; display:block;' border='0' alt='banner' /></td></tr>";
	$praymailmessage .= "<tr><td align='center' valign='top' height='15' style='font-size:15px; padding:0;'><p>(This was sent from an unmonitored mailbox)</p></td></tr>";
    $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
	$praymailmessage .= "<tr><td style='text-align:center; font-size:26px; padding:0'><P>Hello!</P></td></tr>";
	$praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:20px; padding:0'><P>" . $PrayerName . " is requesting prayer</P></td></tr>";
	$praymailmessage .= "<tr><td align='center'><br /></td></tr>";
	$praymailmessage .= "</table>";

	// Prayer Request Details Table
    $praymailmessage .= "<table width='90%' border='0' cellpadding='10' cellspacing='0' bgcolor='#b3d9fc'>";
	$praymailmessage .= "<tr><td><p></p></td></tr>";
	$praymailmessage .= "<tr>";
	$praymailmessage .= "<td style='text-align:center; width:100%'>";
	$praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:bold'>" . $PrayerTitle . "</p>";
	$praymailmessage .= "</td>";
    $praymailmessage .= "</tr>";
    $praymailmessage .= "<tr>";
    $praymailmessage .= "<td style='text-align:center; width:100%'>";
	$praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:normal'>" . $PrayerText . "</p>";
	$praymailmessage .= "</td>";
    $praymailmessage .= "</tr>";
    $praymailmessage .= "</table>";
  
// Prayer Request Footer Table
	$praymailmessage .= "<table width='90%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F2F2F2'>";
	$praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
	$praymailmessage .= "<tr><td><p></p></td></tr>";
	$praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>Please consider this request in your prayer time.</p></td></tr>";
	$praymailmessage .= "<tr><td><p></p></td></tr>";
	$praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>Want to send a word of encouragement? Their email address is <a href='mailto:" . $PrayerEmail . "?subject=Praying for you - " . $PrayerTitle . "'>" . $PrayerEmail . "</a></p></td></tr>";
	$praymailmessage .= "<tr><td><br /></td></tr>";
	$praymailmessage .= "<tr><td><p style='font-family:Arial; font-size:14px; font-weight:normal'>Thank you!<br />The OurFamilyConnections team.</p><br /><p><a href=https://" . $praymaillink . ">" . $themename . "</a></p></td></tr>";
	$praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";

	$praymailmessage .= "</table>";
	$praymailmessage .= "</center>";

	$praymailmessage .= "</body></html>";
	$praymailheaders = "From:" . $praymailfrom . "\r\n";
	$praymailheaders .= "Reply-To:" . $praymailfrom . "\r\n";
    $praymailheaders .= "Bcc:" . $praymailto . "\r\n";
	$praymailheaders .= "MIME-Version: 1.0\r\n";
	$praymailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$praymailworks = mail($praymailfrom,$praymailsubject,$praymailmessage,$praymailheaders);
	if($praymailworks){
		eventLogUpdate('mail', "User: " .  $PrayerName, "Prayer Request Approved Sendmail. SUCCESS" , "prayerID= " . $PrayerID);
		}
	else {
		eventLogUpdate('mail', "User: " .  $PrayerName, "FAILED Prayer Approved Sendmail." , "prayerID= " . $PrayerID);
	};
    $success = array("Approved - Prayer ID = "=>$PrayerID);
    header('Content-type: application/json');
    echo json_encode($success);
	}
	else{
		$failed = array("Failed - Prayer ID = "=>$PrayerID);
		header('Content-type: application/json');
		echo json_encode($failed);
	}
?>