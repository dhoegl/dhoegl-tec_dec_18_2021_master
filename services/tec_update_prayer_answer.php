<?php
// Updated 20220105 - cleaned up for new TEC prayer module
// Initiated from tec_myprayer.php
session_start();
if(!$_SESSION['logged in']) {
	session_destroy();
	exit();
}

    require_once('../tec_dbconnect.php');
    include('../includes/event_logs_update.php');

	if ( !isset($_POST['answerprayerID'])) {
		 echo 'Required data is missing';
		 return;
	}
	else {
		$answer_select = $_POST['answer_select'];
		$answer_prayerID = $_POST['answerprayerID'];
		if($answer_select == 'answered') {
			echo "<script language='javascript'>";
			echo "console.log('This prayer request has been changed to unanswered');";
			echo "</script>";
		// If YES, and Answered button clicked, this means that the prayer request is changed to unanswered
			$unanswer = "UPDATE " . $_SESSION['prayertable'] . " SET answer = '0' WHERE prayer_id = '" . $answer_prayerID . "'";
			$unanswerquery = $mysql->query($unanswer)or die("A database error has occurred when updating prayer answer to '0' in tec_update_prayer_answer.php. Please notify your administrator with the following. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'UserID: ' . $_SESSION['user_id'], 'Prayer Request changed to UNANSWERED' , 'PrayerID: ' . $answer_prayerID);
		}
		else { // change selection to answered
			echo "<script language='javascript'>";
			echo "console.log('This prayer request has been changed to answered');";
			echo "</script>";
		// If NO, and Answered button clicked, this means that the prayer request has been answered
			$answer = "UPDATE " . $_SESSION['prayertable'] . " SET answer = '1' WHERE prayer_id = '" . $answer_prayerID . "'";
			$answerquery = $mysql->query($answer)or die("A database error has occurred when updating prayer answer to '1' in tec_update_prayer_answer.php. Please notify your administrator with the following. Error #: " . $mysql->errno . " : " . $mysql->error);
			eventLogUpdate('prayer', 'UserID: ' . $_SESSION['user_id'], 'Prayer Request changed to ANSWERED' , 'PrayerID: ' . $answer_prayerID);
	}

	}

?>