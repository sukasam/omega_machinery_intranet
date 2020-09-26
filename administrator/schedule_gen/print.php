<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	Check_Permission($conn,$check_module,$_SESSION['login_id'],"read");
	if ($_GET['page'] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>ใบปะหน้างานบริการประจำเดือน</title>
</head>

<body onLoad="window.print();">
<!--onLoad="window.print();window.close();"-->
<style>
	body{
		font-size:8px;	
	}
	.tableSc{
		font-size:8px;
	}
	.tableSc tr th{
		text-align: center;
    	vertical-align: middle;
		border: 1px solid #dddddd;
		padding: 2px;
	}	
	.tableSc tr td{
		text-align: center;
    	vertical-align: middle;
		border: 1px solid #dddddd;
		padding: 2px;
	}	
</style>

<?php
	$getMonth = $_GET['month']-1;
	
	//$condition.= getScheduleService();
	$condition = " AND (service_month != '0' AND service_month != '')";
	$condition.= " AND (service_type != '0' AND service_type != '')";
	
	$sqlSched = "SELECT * FROM `s_first_order` WHERE `technic_service` = ".$_GET['loccontact'].$condition." AND status_use != '2' AND status_use != '1' ORDER BY `cd_province` ,`loc_name` ASC;";
	
	$quSched = mysqli_query($conn,$sqlSched);
	
?>

<div align="center"><span class="currentdate">งานบริการประจำเดือน <?php  echo format_month_th(date ("F", mktime(0,0,0,$_GET['month']-1,1,$_GET['year'])))." ".(date ("Y", mktime(0,0,0,$_GET['month']-1,1,$_GET['year']))+543); ?></spanbr>
  <br>(<?php echo get_technician_name($conn,$_GET['loccontact']);?>)<br><br>
</div>

<?php
	$getMonth = $_GET['month']-1;
	
	//$condition.= getScheduleService();
	$condition = " AND (service_month != '0' AND service_month != '')";
	$condition.= " AND (service_type != '0' AND service_type != '')";
	
	$sqlSched = "SELECT * FROM `s_first_order` WHERE `technic_service` = ".$_GET['loccontact'].$condition." AND status_use != '2' AND status_use != '1' ORDER BY `cd_province` ,`loc_name` ASC;";
	
	$quSched = mysqli_query($conn,$sqlSched);
	
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableSc">
  <tbody>
    <tr>
      <th>ลำดับ</th>
      <th>ลูกค้า</th>
      <th>เครื่อง</th>
      <th>รุ่น</th>
      <th>S/N</th>
      <th>จังหวัด</th>
      <th>ชนิดลูกค้า</th>
      <th>ระยะเวลา</th>
      <th>ID</th>
	  <th>วันเข้าบริการ</th>
<!--      <th>ดาวโหลด</th>-->
    </tr>
    <?php 
	  $runRow = 1;
	  while($rowSched = mysqli_fetch_array($quSched)){
		  
		  if(getScheduleService($rowSched['service_month'],$getMonth,$rowSched['service_type']) == 1){
		  
			  $getFileSH = getScheduleFile($conn,$_GET['loccontact'],$_GET['month']-1,$rowSched['fs_id']);

			  $dateSVAr = explode("-",getServiceSchedule($conn,$_GET['loccontact'],$rowSched['fs_id'],$_GET['year'],$_GET['month']-1)); 
			  $dateSV = $dateSVAr[2].'/'.$dateSVAr[1].'/'.$dateSVAr[0];

			  if(getCheckProGen($conn,$rowSched['cpro1'],$rowSched['fs_id']) == 1){

				  ?>
				  <tr>
					  <td><?php echo $runRow++;?></td>
					  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
					  <td><?php if(substr($rowSched['fs_id'],0,2) == "SV"){echo get_proname2($conn,$rowSched['cpro1']);}else{echo get_proname($conn,$rowSched['cpro1']);}?></td>
					  <td><?php echo $rowSched['pro_pod1'];?></td>
					  <td><?php echo $rowSched['pro_sn1'];?></td>
					  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
					  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
					  <td><?php echo get_servicename($conn,$rowSched['service_type']);?></td>
					  <td><?php echo $rowSched['fs_id'];?></td>
					  <td><?php echo $dateSV;?></td>
				  </tr>
				  <?php
			  }

			  if(getCheckProGen($conn,$rowSched['cpro2'],$rowSched['fs_id']) == 1){
				  ?>
				  <tr>
					  <td><?php echo $runRow++;?></td>
					  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
					  <td><?php if(substr($rowSched['fs_id'],0,2) == "SV"){echo get_proname2($conn,$rowSched['cpro2']);}else{echo get_proname($conn,$rowSched['cpro2']);}?></td>
					  <td><?php echo $rowSched['pro_pod2'];?></td>
					  <td><?php echo $rowSched['pro_sn2'];?></td>
					  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
					  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
					  <td><?php echo get_servicename($conn,$rowSched['service_type']);?></td>
					  <td><?php echo $rowSched['fs_id'];?></td>
					  <td><?php echo $dateSV;?></td>
				  </tr>
				  <?php
			  }
		  }
	  }
	?>
  </tbody>
</table>
</body>
</html>