<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	
	$qrPOD = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE 1");

	while($row = mysqli_fetch_array($qrPOD)){
		set_time_limit(0);
		
		$quSN = mysqli_query($conn,"SELECT * FROM s_group_sn WHERE group_pod = '".$row['group_id']."'");
		$numSN = mysqli_num_rows($quSN);
		
		if($numSN <= 0){
			mysqli_query($conn,"DELETE FROM `s_group_pod` WHERE `s_group_pod`.`group_id` = ".$row['group_id']);
		}
		
		
	}

?>