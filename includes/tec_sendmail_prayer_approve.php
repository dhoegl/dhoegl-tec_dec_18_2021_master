<?php
// Isolated call from tec_prayeradmin for prayer request approval email
function oldest_prayerrequestapprovemail($mailtype, $prayerID, $prayerName, $prayerTitle)
{
    $mailtype = $_POST['mailtype'];
    $prayerID = $_POST['prayer_ID']; 
    $prayer_name = $_POST['full_name'];
    $prayer_title = $_POST['prayer_title'];
    // case 'prayer_approve_mail'

        //     case 'approved_member':
// *************** THIS CASE IS NON-FUNCTIONAL - SEE TEC_SENDMAIL.PHP
        //     $maillink = $domain;
        //     $mailto = $email;
        //     $mailsubject = "Approved access to the " . $customer . " family directory" . "\n..";
        //     $mailmessage = "<html><body>";
        //     $mailmessage .= "<p>(This was sent from an unmonitored mailbox)</p>";
        //     $mailmessage .= "<p style='background-color: " .  $headercolorvalue . "; font-size: 30px; font-weight: bold; color: " . $headerforecolorvalue . "; padding: 25px; width=100%;'>";
        //     $mailmessage .= $customer . "</p>";
        //     $mailmessage .= "<p>Hello <strong>" . $firstname . " " . $lastname . "</strong></p>";
        //     $mailmessage .= "<p>You have been approved to access " . $customer . "'s directory site!</p>";
        //     $mailmessage .= "<p>Click on the link below to login<br /></p>";
        //     $mailmessage .= "<p><a href=http://" . $maillink . ">" . $customer . "</a></p>";
        //     $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
        //     $mailmessage .= "</body></html>";
        //     $mailfrom = "noreply@ourfamilyconnections.org";
        //     $mailheaders = "From:" . $mailfrom . "\r\n";
        //     $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
        //     $mailheaders .= "MIME-Version: 1.0\r\n";
        //     $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        //     mail($mailto,$mailsubject,$mailmessage,$mailheaders);
        //     $response = "Mailtype received" . " = " . $mailtype;
        echo "<script language='javascript'>";
        echo "console.log('Reached tec_sendmail_prayer_approve successfully - Prayer ID = " . $prayerID . "');";
        echo "</script>";

};
?>