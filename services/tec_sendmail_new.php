<?php
// Send Mail scripts
// Updated 2021/12/21
// Called from
//  -- prayer_request_to_sendmail.js
// Plus others
// This function will send email to users and admins
// Fixed CASE: prayer_request_user
require_once('../tec_dbconnect.php');
// Event Log  trap
require_once('../includes/event_logs_update.php');
$text = array();
$mailtype = "";
// PHP Function call tp PHP
// Javascript call from jQuery
    $mailtype = $_POST['mailtype'];
    $domain = $_POST['theme_domain'];
    $email_banner = $_POST['prayemail_banner'];
    $customer = $_POST['theme_name'];
    $title = $_POST['theme_title'];
    $headercolorvalue = $_POST['theme_color'];
    $headerforecolorvalue = $_POST['theme_forecolor'];
    // $family_select = $_POST['Family']; //family select for new registrants (possibly unused for email comms)
    // $admin_dir = $_POST['Admin']; //Administrator's Directory ID (possibly unused for email comms)
    $login = $_POST['login_id']; //UserName
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $username = $_POST['user_name'];
    $email = $_POST['email_address'];
    $prayerID = $_POST['prayer_ID']; 
    $prayer_email = $_POST['prayer_email_address'];
    $prayer_source = $_POST['requestor_ID'];
    $prayer_name = $_POST['full_name'];
    $prayer_title = $_POST['prayer_title'];
    $prayer_title = stripslashes($prayer_title);
    $prayer_text = $_POST['prayer_text'];
    $prayer_text = stripslashes($prayer_text);
    $update_text = $_POST['update_text'];
    $update_text = stripslashes($update_text);
    $prayer_answered = $_POST['prayer_answered'];
echo "<script language='javascript'>";
echo "alert('Arrived inside if(!mailtype). mailtype = ' + '$mailtype');";
echo "</script>";

    if($mailtype){
        Switch ($mailtype){

// **************************** ALL CHURCH PRAYER REQUEST ************************************
// **************************** ALL CHURCH PRAYER REQUEST ************************************
// **************************** ALL CHURCH PRAYER REQUEST ************************************
                case 'prayer_request_church':
                // Send notification email to All prayer admins (admin_praynotify = 1) for them to ACCEPT/REJECT the prayer request
                $mailadmins = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE admin_praynotify = '1'";
                $mailquery = $mysql->query($mailadmins) or die("A database error occurred when trying to select prayer admins in Login Table. See tec_newprayer.php. Error : " . $mysql->errno . " : " . $mysql->error);
                while ($mailrow = $mailquery->fetch_assoc())
                {
                    $mailtest = $mailrow['email_addr'];
                    $mailto = $mailtest . " , " . $mailto;
                }
                $mailfrom = "approveprayerrequest@ourfamilyconnections.org";
                $maillink = $domain;
                $mailsubject = "Approve Prayer Request from " . $prayer_name . "\n";
                $praymailmessage = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>";
                $praymailmessage .= "<html lang='en'>";
                $praymailmessage .= "<head>";
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
                                        {width:100% !important; width:100vw !important;}
                                        .m-shell
                                        {width: 100% !important; min-width: 100% !important;}
                                        .m-center 
                                        {text-align: center !important; }
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
                $praymailmessage .= "<tr><td align='center' valign='top'><img src='https://" . $domain . $email_banner . "' width='100%'  style='margin:0; padding:0; border:none; display:block;' border='0' alt='banner' /></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top' height='15' style='font-size:15px; padding:0;'><p>(This was sent from an unmonitored mailbox)</p></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:26px; padding:0'><P>Hello Administrators!</P></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:20px; padding:0'><P>" . $prayer_name . " is requesting your approval of their prayer request</P></td></tr>";
                $praymailmessage .= "<tr><td align='center'><br /></td></tr>";
                $praymailmessage .= "</table>";
            
// Prayer Request Details Table
                $praymailmessage .= "<table width='90%' border='0' cellpadding='10' cellspacing='0' bgcolor='#b3d9fc'>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:bold'>" . $prayer_title . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:normal'>" . $prayer_text . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#FF0000; font-size:14px; font-weight:normal; padding: 10px'>Prayer ID = " . $prayerID . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "</table>";
              
// Prayer Request Footer Table
                $praymailmessage .= "<table width='90%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F2F2F2'>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>Login to the <a href=https://" . $maillink . "/tec_prayeradmin.php>OurFamilyConnections</a> site using your admin credentials, select the <strong><a href=https://" . $maillink . "/tec_prayeradmin.php>**Prayer Admin**</a></strong> menu item, and accept or reject this prayer request.</p></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>Want to send a word of encouragement? Their email address is <a href='mailto:" . $prayer_email . "?subject=Praying for you - " . $prayer_title . "'>" . $prayer_email . "</a></p></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td><p style='font-family:Arial; font-size:14px; font-weight:normal'>Thank you!<br />The OurFamilyConnections team.</p><br /><p><a href=https://" . $maillink . ">" . $customer . "</a></p></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
            
                $praymailmessage .= "</table>";
                $praymailmessage .= "</center>";
            
                $praymailmessage .= "</body></html>";
            
                $mailheaders = "From:" . $mailfrom . "\r\n";
                $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
                // $mailheaders .= "Bcc:" . $mailto . "\r\n";
                $mailheaders .= "MIME-Version: 1.0\r\n";
                $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $emailworks = mail($mailto,$mailsubject,$praymailmessage,$mailheaders);
                if($emailworks){
                    eventLogUpdate('mail', "User: " .  $prayer_name, "Requesting Church prayer approval. SUCCESS" , "prayerID= " . $prayerID);
                    }
                else {
                    eventLogUpdate('mail', "User: " .  $prayer_name, "FAILED Church prayer email sent to administrators." , "prayerID= " . $prayerID);
                }

                $response = "Mailtype received" . " = " . $mailtype;
            break;

// **************************** ELDER PRAYER REQUEST ************************************
// **************************** ELDER PRAYER REQUEST ************************************
// **************************** ELDER PRAYER REQUEST ************************************
            case 'prayer_request_elder':
                // Send notification email to All elders (elder = Y) for them to contact the prayer requestor
                $mailadmins = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE active = '1' AND elder = 'Y'";
                $mailquery = $mysql->query($mailadmins) or die("A database error occurred when trying to select prayer admins in Login Table. See tec_newprayer.php. Error : " . $mysql->errno . " : " . $mysql->error);
                while ($mailrow = $mailquery->fetch_assoc())
                {
                    $mailtest = $mailrow['email_addr'];
                    $mailto = $mailtest . " , " . $mailto;
                }
                $maillink = $domain;
                $mailsubject = "Please Respond - Elder Prayer Request from " . $prayer_name . "\n..";
                $praymailmessage = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>";
                $praymailmessage .= "<html lang='en'>";
                $praymailmessage .= "<head>";
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
                                        {width:100% !important; width:100vw !important; }
                                        .m-shell
                                        {width: 100% !important; min-width: 100% !important;}
                                        .m-center 
                                        {text-align: center !important; }
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
                $praymailmessage .= "<tr><td align='center' valign='top'><img src='https://" . $domain . $email_banner . "' width='100%'  style='margin:0; padding:0; border:none; display:block;' border='0' alt='banner' /></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top' height='15' style='font-size:15px; padding:0;'><p>(This was sent from an unmonitored mailbox)</p></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:26px; padding:0'><P><p>Hello " . $customer . " Elders</p></P></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:20px; padding:0'><p><strong>" . $prayer_name . "</strong> has requested you to pray for them.</p><br /></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:20px; padding:0'><p>Details are as follows:</p></td></tr>";
                $praymailmessage .= "<tr><td align='center'><br /></td></tr>";
                $praymailmessage .= "</table>";
            
// Prayer Request Details Table
                $praymailmessage .= "<table width='90%' border='0' cellpadding='10' cellspacing='0' bgcolor='#b3d9fc'>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:bold'>" . $prayer_title . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:normal'>" . $prayer_text . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#FF0000; font-size:14px; font-weight:normal; padding: 10px'>Prayer ID = " . $prayerID . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "</table>";
              
// Prayer Request Footer Table
                $praymailmessage .= "<table width='90%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F2F2F2'>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>You have three options:</p>";
                $praymailmessage .= "<ul><li>Send a direct email to the requestor at <a href='mailto:" . $prayer_email . "'>" . $prayer_email . "</a></li>";
                $praymailmessage .= "<li>If you have their personal contact information, reach out to them using your desired method.</li>";
                $praymailmessage .= "<li>Login to the <a href=https://" . $maillink . "/tec_prayeradmin.php>OurFamilyConnections</a> site using your admin credentials, and navigate to their Directory entry for additional contact methods.</li></ul>";
                $praymailmessage .= "</td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>For reference, the prayer Request ID is <strong>" . $prayerID . "</strong>.</p></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td><p style='font-family:Arial; font-size:14px; font-weight:normal'>Thank you!<br />The OurFamilyConnections team.</p><br /><p><a href=https://" . $maillink . ">" . $customer . "</a></p></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "</table>";
                $praymailmessage .= "</center>";
                $praymailmessage .= "</body></html>";

                $mailfrom = "elderprayerrequest@ourfamilyconnections.org";
                $mailheaders = "From:" . $mailfrom . "\r\n";
                $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
                $mailheaders .= "MIME-Version: 1.0\r\n";
                $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $emailworks = mail($mailto,$mailsubject,$praymailmessage,$mailheaders);
                if($emailworks){
                    eventLogUpdate('mail', "User: " .  $prayer_name, "Requesting Elder prayer. SUCCESS" , "prayerID= " . $prayerID);
                    }
                else {
                    eventLogUpdate('mail', "User: " .  $prayer_name, "FAILED email send for Elder prayer request." , "prayerID= " . $prayerID);
                }

                $response = "Mailtype received" . " = " . $mailtype;
            break;

// **************************** PRAYER UPDATE ************************************
// **************************** PRAYER UPDATE ************************************
// **************************** PRAYER UPDATE ************************************
            case 'prayer_update':
                // Send notification email to All registered users who have enabled prayer request update notifications (active = 1 & update_prayer_notify = 1 (NOTE THIS IS TEMPORARILY SET TO 2 FOR TESTING PURPOSES))
                $mailadmins = "SELECT email_addr FROM " . $_SESSION['logintablename'] . " WHERE active = '1' AND update_prayer_notify = '2'";
                $mailquery = $mysql->query($mailadmins) or die("A database error occurred when trying to select prayer admins in Login Table. See tec_newprayer.php. Error : " . $mysql->errno . " : " . $mysql->error);
                while ($mailrow = $mailquery->fetch_assoc())
                {
                    $mailtest = $mailrow['email_addr'];
                    $mailto = $mailtest . " , " . $mailto;
                }
                $maillink = $domain;
                $mailsubject = "Updated Prayer Request from " . $prayer_name . "\n..";
                $praymailmessage = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>";
                $praymailmessage .= "<html lang='en'>";
                $praymailmessage .= "<head>";
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
                                        {width:100% !important; width:100vw !important; }
                                        .m-shell
                                        {width: 100% !important; min-width: 100% !important;}
                                        .m-center 
                                        {text-align: center !important; }
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
                $praymailmessage .= "<tr><td align='center' valign='top'><img src='https://" . $domain . $email_banner . "' width='100%'  style='margin:0; padding:0; border:none; display:block;' border='0' alt='banner' /></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top' height='15' style='font-size:15px; padding:0;'><p>(This was sent from an unmonitored mailbox)</p></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:26px; padding:0'><P><p>Hello " . $customer . " family!</p></P></td></tr>";

                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:20px; padding:0'><p><strong>" . $prayer_name . "</strong> has updated their prayer request in the family directory.</p><br /></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; text-align:center; font-size:20px; padding:0'><p>Details are as follows:</p></td></tr>";
                $praymailmessage .= "<tr><td align='center'><br /></td></tr>";
                $praymailmessage .= "</table>";
            
// Prayer Request Details Table
                $praymailmessage .= "<table width='90%' border='0' cellpadding='10' cellspacing='0' bgcolor='#b3d9fc'>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:bold'>" . $prayer_title . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "<tr>";
                $praymailmessage .= "<td style='text-align:center; width:100%'>";
                $praymailmessage .= "<p style='font-family:Arial; color:#57575C; font-size:20px; font-weight:normal'>" . $update_text . "</p>";
                $praymailmessage .= "</td>";
                $praymailmessage .= "</tr>";
                $praymailmessage .= "</table>";
              
// Prayer Request Footer Table
                $praymailmessage .= "<table width='90%' border='0' cellpadding='0' cellspacing='0' bgcolor='#F2F2F2'>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>Please consider these new details in your prayer time.</p></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td style='font-family:Arial; color:#57575C; font-size:14px; font-weight:normal; text-align:left; width:100%'><p>Want to send a word of encouragement? Their email address is <a href='mailto:" . $prayer_email . "?subject=Praying for you - " . $prayer_title . "'>" . $prayer_email . "</a></p></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "<tr><td><p></p></td></tr>";
                $praymailmessage .= "<tr><td><p style='font-family:Arial; font-size:14px; font-weight:normal'>Thank you!<br />The OurFamilyConnections team.</p><br /><p><a href=https://" . $maillink . ">" . $customer . "</a></p></td></tr>";
                $praymailmessage .= "<tr><td align='center' valign='top'><hr style='height:3px;border-width:0;color:gray;background-color:gray'></td></tr>";
                $praymailmessage .= "</table>";
                $praymailmessage .= "</center>";
                $praymailmessage .= "</body></html>";

                $mailfrom = "prayerupdate@ourfamilyconnections.org";
                $mailheaders = "From:" . $mailfrom . "\r\n";
                $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
                $mailheaders .= "Bcc:" . $mailto . "\r\n";
                $mailheaders .= "MIME-Version: 1.0\r\n";
                $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $emailworks = mail($mailfrom,$mailsubject,$praymailmessage,$mailheaders);
                if($emailworks){
                    eventLogUpdate('mail', "User: " .  $prayer_name, "Prayer Request Update. SUCCESS" , "prayerID= " . $prayerID);
                    }
                else {
                    eventLogUpdate('mail', "User: " .  $prayer_name, "FAILED Prayer Request Update." , "prayerID= " . $prayerID);
                }

                $response = "Mailtype received" . " = " . $mailtype;
            break;

// **************************** (non-functional) PRAYER APPROVE OUTBOUND EMAIL ************************************
// **************************** (non-functional) PRAYER APPROVE OUTBOUND EMAIL ************************************
// **************************** (non-functional) PRAYER APPROVE OUTBOUND EMAIL ************************************
            case 'prayer_approve_mail':
                $response = "Mailtype received" . " = " . $mailtype;
            break;

            default:
            echo "none of the above";
        };
    }
    // else
    // {
    //     $response = "ERROR on Mailtype at tec_sendmail_new.php";
    // };
// echo $response;
?>