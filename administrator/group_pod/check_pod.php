<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	
	$qrFO = mysqli_query($conn,"SELECT * FROM s_first_order WHERE 1 AND (pro_pod1 != '' OR pro_pod2 != '' OR pro_pod3 != '' OR pro_pod4 != '' OR pro_pod5 != '' OR pro_pod6 != '' OR pro_pod7 != '') ORDER BY fo_id ASC;");

	while($row = mysqli_fetch_array($qrFO)){
		set_time_limit(0);
//		echo $row['pro_pod1'];
//		exit();
		if($row['pro_pod1'] != ''){
			$qu1 = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name LIKE = '%".$row['pro_pod1']."%'");
			if(@mysqli_num_rows($qu1) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_pod` (`group_id`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['pro_pod1']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_pod2'] != ''){
			$qu2 = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name LIKE '%".$row['pro_pod2']."%'");
			if(@mysqli_num_rows($qu2) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_pod` (`group_id`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['pro_pod2']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_pod3'] != ''){
			$qu3 = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name LIKE '%".$row['pro_pod3']."%'");
			if(@mysqli_num_rows($qu3) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_pod` (`group_id`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['pro_pod3']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_pod4'] != ''){
			$qu4 = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name LIKE '%".$row['pro_pod4']."%'");
			if(@mysqli_num_rows($qu4) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_pod` (`group_id`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['pro_pod4']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_pod5'] != ''){
			$qu5 = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name LIKE '%".$row['pro_pod5']."%'");
			if(@mysqli_num_rows($qu5) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_pod` (`group_id`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['pro_pod5']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_pod6'] != ''){
			$qu6 = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name LIKE '%".$row['pro_pod6']."%'");
			if(@mysqli_num_rows($qu6) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_pod` (`group_id`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['pro_pod6']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		if($row['pro_pod7'] != ''){
			$qu7 = mysqli_query($conn,"SELECT * FROM s_group_pod WHERE group_name LIKE '%".$row['pro_pod7']."%'");
			if(@mysqli_num_rows($qu7) == 0){
				@mysqli_query($conn,"INSERT INTO `s_group_pod` (`group_id`, `group_name`, `create_by`, `create_date`, `update_by`, `update_date`, `delete_by`, `delete_date`) VALUES (NULL, '".$row['pro_pod7']."', 'admin', '".date("Y-m-d H:i:s")."', NULL, '0000-00-00 00:00:00.000000', NULL, '0000-00-00 00:00:00.000000');");
			}
		}
		//exit();
	}
?>