<?php
include_once("../../include/aplication_top.php");
header('Content-Type: text/html; charset=UTF-8');
if($_GET['action'] == "amphur"){
	$quamphur = @mysqli_query($conn,"SELECT * FROM s_amphur WHERE province_id ='".$_GET['cd_province']."' ORDER BY amphur_name ASC");
	$listAmphur = '';
	while($row_amphur = @mysqli_fetch_array($quamphur)){
	  
	$listAmphur .='<option value="'.$row_amphur['amphur_id'].'">'.$row_amphur['amphur_name'].'</option>';
	  	
	}
	
	echo $listAmphur;
	
}
?>