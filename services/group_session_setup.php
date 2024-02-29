<?php
// Call to extract Group metadata (created to workaround JS->php issue)
    session_start();
    if(!$_SESSION['logged in']) {
        session_destroy();
        header("location:../tec_welcome.php");
        exit();
    }
        if(isset($_POST['group_cat']) ) {
        unset($_SESSION['group_category']);
        $_SESSION["group_category"] = $_POST['group_cat'];
        unset($_SESSION['group_description']);
        $_SESSION["group_description"] = $_POST['group_desc'];
        unset($_SESSION['group_status']);
        $_SESSION["group_status"] = $_POST['group_stat'];

        $listarray = array();
            // Stores profile data into an array
            $buildjson = array('category' => $_SESSION["group_category"], 'description' => $_SESSION["group_description"], 'status' => $_SESSION["group_status"]);
            // Adds each array into the container array
            array_push($listarray, $buildjson);
    }
    header('Content-type: application/json');
	echo json_encode($listarray);

?>