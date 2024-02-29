<?php
//New Prayer Reject script
//Called from tec_prayeradmin.php
//Last Updated 2021/12/27
if ( isset($_POST['prayerID']) ) {
    require('../tec_dbconnect.php');
    include('../includes/event_logs_update.php');
    include('tec_sendmail.php');
    $PrayerID = $_POST['prayerID'];
    $PrayerName = $_POST['prayerName'];
    $PrayerTitle = $_POST['prayerTitle'];
    $text = array();
    $regrejectloginquery = "UPDATE " . $_SESSION['prayertable'] . " SET approved = '2'" .  " WHERE prayer_id = '". $PrayerID . "'";
    $regrejectlogin = $mysql->query($regrejectloginquery) or die("A database error occurred when trying to reject new Prayer Request info into Prayer table. See ajax_reject_prayer.php. Error:" . $mysql->errno . " : " . $mysql->error);
    eventLogUpdate('prayer_update', "Admin ID: " .  $_SESSION['user_id'], "Prayer Request Reject", "prayer_id: " . $PrayerID . " - Requested by: " . $PrayerName);

    $success = array("Rejected - Prayer ID = "=>$PrayerID);
    header('Content-type: application/json');
    echo json_encode($success);
}
else{
    $failed = array("Failed - Prayer ID = "=>$PrayerID);
    header('Content-type: application/json');
    echo json_encode($failed);
}
?>