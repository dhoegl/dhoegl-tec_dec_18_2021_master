<?php
// tec_getregisteredusers  
// called from tec_view_registeredusers.php
// Original version of this file was called from tec_view_approvedmembers
// Last Updated: 2022/01/11
session_start();
if(!$_SESSION['logged in']) {
    session_destroy();
    exit();
}
require_once('../tec_dbconnect.php');
/* Query registered users listing from Login table: active = 1 */ 
$registeredusersquery = "SELECT login_ID, church_ID, lastname, firstname, email_addr FROM " . $_SESSION['logintablename'] . " WHERE active = '1'";
$registeredusersqueryresult = $mysql->query($registeredusersquery) or die(" Registered users query error. Error:" . $mysql->error);
$registeredusersquerycount = $registeredusersqueryresult->num_rows;
$listarray = array();
$noID = '0';
$default_no_match = 'no users';
$null = ' ';
$control = "Control";
if ($registeredusersquerycount == 0)
{
    $buildjson = array($select, $noID, $null, $default_no_match, $null);
    array_push($listarray, $buildjson);
    // $no_registered = 'no registered users';
    // $listarray = array('data' => $no_registered);
    $listarray = array('data' => $listarray);
    echo json_encode($listarray);
    exit;
}
// else {
//     $buildjson = array($select, $noID, $null, $default_no_match, $null);
//     array_push($listarray, $buildjson);
    while($registeredusersqueryrow = $registeredusersqueryresult->fetch_assoc()) 
    {
        // $control = "<tr><td></td>";
        // $owner_select = "<td><a class='btn btn-success btn-sm' href=''>Select</a></td>";
        $owner_select_ID = "ID_" . $registeredusersqueryrow['login_ID'];
        $owner_select = "<tr><td><input type='checkbox' id='" . $owner_select_ID . "'></td>";
        
        $lastname = "<td>" . $registeredusersqueryrow['lastname'] . "</td>";
        $firstname = "<td>" . $registeredusersqueryrow['firstname'] . "</td>";
        $email = "<td>" . $registeredusersqueryrow['email_addr'] . "</td>";
        $loginID = "<td>" . $registeredusersqueryrow['login_ID'] . "</td>";
        $churchID = "<td>" . $registeredusersqueryrow['church_ID'] . "</td></tr>";
        // Stores each database record to an array
        // $buildjson = array($control, $owner_select, $fullname, $email, $loginID, $churchID);
        $buildjson = array($owner_select, $lastname, $firstname, $email, $loginID, $churchID);
        // Adds each array into the container array
        array_push($listarray, $buildjson);
    }
// }
// Prepend array with parent element
$listarray = array('data' => $listarray);
header('Content-type: application/json');
echo json_encode($listarray);
?>