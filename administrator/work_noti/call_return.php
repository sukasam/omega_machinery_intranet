<?php  
	include_once("../../include/connect.php");
	
	if($_GET['action'] === "chkProject"){
		
		$group_id = $_REQUEST['group_id'];
		$rowSpar = @mysqli_fetch_assoc(@mysqli_query($conn,"SELECT * FROM s_group_typeproduct WHERE group_id ='".$group_id."'"));
		
		if($rowSpar['group_id']){
			echo json_encode(array('status' => 'yes','group_id'=> $rowSpar['group_id'],'group_spro_id'=> $rowSpar['group_spro_id']));
		}else{
			echo json_encode(array('status' => 'no'));
		}
		
	}
?>