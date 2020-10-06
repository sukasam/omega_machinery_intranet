<?php  
include_once("../../include/connect.php");

//header('Content-Type: text/html; charset=tis-620');

if($_GET['action'] === "updateDate"){

	$dateArray = explode("-",$_GET['date']);
	$date = ($dateArray[0]).'-'.$dateArray[1].'-'.$dateArray[2];
	$sv_id = $_GET['sv_id'];
	
	mysqli_query($conn,"UPDATE `s_service_report` SET `job_balance` = '".$date."' WHERE `sv_id` = '".$sv_id."';");

	echo json_encode(array('status' => 'yes'));


}
?>