<?php
    // $success = array('Accept Success'=>87);
    $success = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
    // header('Content-type: application/json');
    // foreach($success as $x => $val){
    //     echo "$x = $val<br>";
    // }
    echo json_encode($success);


    require('tec_dbconnect.php');
    include('includes/event_logs_update.php');
    // Setup outbound prayer notify email function 
    include('includes/newprayernotify.php');
    // include('tec_sendmail.php');
    // $PrayerID = $_POST['prayerID'];
    $PrayerID = "51";
    // $PrayerName = $_POST['prayerName'];
    $PrayerName = "Test Prayer Name";
    // $PrayerTitle = $_POST['prayerTitle'];
    $PrayerTitle = "Test Prayer Title";
    $text = array();
    $approveprayerquery = "UPDATE " . $_SESSION['prayertable'] . " SET approved = '1'" .  " WHERE prayer_id = '". $PrayerID . "'";
    $approveprayer = $mysql->query($approveprayerquery) or die("A database error occurred when trying to reject new Prayer Request info into Prayer table. See ajax_reject_prayer.php. Error:" . $mysql->errno . " : " . $mysql->error);
    // eventLogUpdate('prayer_update', "Admin ID: " .  $_SESSION['user_id'], "Prayer Request Approve", "prayer_id: " . $PrayerID . " - Requested by: " . $PrayerName);
    prayerrequestapprovemail($PrayerID, $PrayerName, $PrayerTitle);

?>
