<?php
session_start();
// Updated 20220105 - clean up for new TEC prayer module
// Logic is: If a prayer request is answered, it will no longer be allowed to be updated or edited
// Initiated from tec_myprayer.php
if(!$_SESSION['logged in']) {
	session_destroy();
	header("location:../tec_welcome.php");
	exit();
}

    require_once('../tec_dbconnect.php');

// Check prayer answered status - called from tec_myprayer.php    
	if ( !isset($_GET['answerprayerID']) ) {
		 echo 'Required data is missing';
		 return;
	}
	else {
		$answer_prayerID = $_GET['answerprayerID'];
		$answerprayerquery = "SELECT * FROM " . $_SESSION['prayertable'] . " WHERE prayer_id = '" . $answer_prayerID . "'";
		$answerresult = $mysql->query($answerprayerquery) or die(" SQL query prayer answer check error. Error #: " . $mysql->errno . " : " . $mysql->error);
		// $answercount = $answerresult->num_rows;

		$answerarray = array();
//		$messageYES = "YES - Prayer is answered";
//		$messageNO = "NO - Prayer is NOT not answered";
		$messageYES = "YES";
		$messageNO = "NO";
        $answered = "ANSWERED";
        $unanswered = "UNANSWERED";
    
		$row = $answerresult->fetch_assoc();
		if($row['answer'] == '1')
		{
			// Value of '1' denotes that the prayer request has been answered
			// MessageYES indicates that prayer request has been answered
			$message = array('Message' => $messageYES, 'Status' => $answered);
			array_push($answerarray, $message);
			$answerarray = array('answermessage' => $answerarray); 
			header('Content-type: application/json');
			echo json_encode($answerarray); 
		}
		else {
//      MessageNO indicates that prayer request is NOT being followed by user
            $message = array('Message' => $messageNO, 'Status' => $unanswered);
			array_push($answerarray, $message); 
			$answerarray = array('answermessage' => $answerarray); 
			header('Content-type: application/json');
			echo json_encode($answerarray); 
 
		}
	}
?>

