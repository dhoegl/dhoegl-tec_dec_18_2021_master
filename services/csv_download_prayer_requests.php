<?php
session_start();
require_once('../tec_dbconnect.php');
/* Download Prayer Requests to CSV file; called from 'tec_prayer.php */
$output = "";

//if(isset($_POST['export_csv']))
//{
	header('Content-Type: text/csv');
	header('Content-Disposition:attachment;filename=Active_Prayer_Requests.csv');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');
	$csvoutput = fopen('php://output', 'w');
	
	// $prayer_extract = "SELECT p.prayer_id as 'PRAYER_ID', p.create_date as 'CREATED', p.name as 'NAME', p.updated as 'UPDATED', p.answer as 'ANSWERED', p.title as 'TITLE', p.prayer_text as 'TEXT', u.update_text as 'UPDATE' FROM " . $_SESSION['prayertable'] . " p INNER JOIN " . $_SESSION['prayerupdate'] . " u on p.prayer_id = u.prayer_id WHERE p.approved = 1 and p.visible = 3 ORDER BY CREATED asc";
	$prayer_extract = "SELECT p.prayer_id as 'PRAYER_ID', p.answer as 'ANSWERED', p.create_date as 'CREATED', p.name as 'NAME', p.title as 'TITLE', p.prayer_text as 'TEXT', u.update_text as 'UPDATES', u.update_date as 'UPDATE DATE' FROM " . $_SESSION['prayertable'] . " p LEFT JOIN " . $_SESSION['prayerupdate'] . " u on p.prayer_id = u.prayer_id WHERE p.approved = 1 and p.visible = 3 ORDER BY PRAYER_ID asc";

	$prayer_extract_results = $mysql->query($prayer_extract) or die("A database error has occurred while extracting the church directory Excel file. Please notify your administrator with the following. Error : " . $mysql->errno . $mysql->error);
        $prayer_extract_count = $prayer_extract_results->num_rows;
        
	if($prayer_extract_count > 0)
	{
		$row = $prayer_extract_results->fetch_assoc();		
		$headers = array_keys($row);
		fputcsv($csvoutput, $headers);
		fputcsv($csvoutput, $row);
		While($row = $prayer_extract_results->fetch_assoc()) 
		{
			fputcsv($csvoutput, $row);
		}
		fclose($csvoutput);
		exit;
	}
//}


?>