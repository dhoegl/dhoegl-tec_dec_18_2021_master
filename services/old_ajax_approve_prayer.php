<?php
//New Prayer Approve script
//Called from tec_prayeradmin.php
//Last Updated 2021/12/28
// Called from tec_prayeradmin.php

if ( isset($_POST['prayerID']) ) {
    require('../tec_dbconnect.php');
    include('../includes/event_logs_update.php');
    // Setup outbound prayer notify email function 
    include('../includes/newprayernotify.php');
    // include('tec_sendmail.php');
    $PrayerID = $_POST['prayerID'];
    $PrayerName = $_POST['prayerName'];
    $PrayerTitle = $_POST['prayerTitle'];
    $text = array();
    $approveprayerquery = "UPDATE " . $_SESSION['prayertable'] . " SET approved = '1'" .  " WHERE prayer_id = '". $PrayerID . "'";
    $approveprayer = $mysql->query($approveprayerquery) or die("A database error occurred when trying to reject new Prayer Request info into Prayer table. See ajax_reject_prayer.php. Error:" . $mysql->errno . " : " . $mysql->error);
    eventLogUpdate('prayer_update', "Admin ID: " .  $_SESSION['user_id'], "Prayer Request Approve", "prayer_id: " . $PrayerID . " - Requested by: " . $PrayerName);
    // prayerrequestapprovemail($PrayerID, $PrayerName, $PrayerTitle);

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