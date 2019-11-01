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
	$condition = "";
	$getMonth = $_GET['month']-1;
	
	$condition.= " AND (service_type = 8";
	
	if($getMonth % 2 != 0){
		$condition.= " OR service_type = 37";
	}
	
	if($getMonth != 2 || $getMonth != 4 || $getMonth != 6 || $getMonth != 8 || $getMonth != 10 || $getMonth != 12){
		$condition.= " OR service_type = 38";
	}
	
	if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){
		$condition.= " OR service_type = 39";
	}
	
	if($getMonth == 4 || $getMonth == 8 || $getMonth == 12){
		$condition.= " OR service_type = 97";
	}
	
	if($getMonth == 6 || $getMonth == 12){
		$condition.= " OR service_type = 100";
	}
	
	$condition.= ")";

	
	 $sqlSched = "SELECT * FROM `s_first_order` WHERE `technic_service` = ".$_GET['loccontact'].$condition." ORDER BY `cd_province` ,`loc_name` ASC;";
	
	$quSched = mysqli_query($conn,$sqlSched);
	
?>

<div align="center"><span class="currentdate">งานบริการประจำเดือน <?php  echo format_month_th(date ("F", mktime(0,0,0,$_GET['month']-1,1,$_GET['year'])))." ".(date ("Y", mktime(0,0,0,$_GET['month']-1,1,$_GET['year']))+543); ?></spanbr>
  <br>(<?php echo get_technician_name($conn,$_GET['loccontact']);?>)<br><br>
</div>

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
      <th>เลขที่ FO</th>
    </tr>
    <?php 
	  $runRow = 1;
	  while($rowSched = mysqli_fetch_array($quSched)){
		  
		  if(getCheckProGen($conn,$rowSched['cpro1']) == 1){
			  ?>
			  <tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro1']);?></td>
				  <td><?php echo $rowSched['pro_pod1'];?></td>
				  <td><?php echo $rowSched['pro_sn1'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php echo get_servicename($conn,$rowSched['service_type']);?></td>
				  <td><?php echo $rowSched['fs_id'];?></td>
	  		  </tr>
			  <?php
		  }
		  
		  if(getCheckProGen($conn,$rowSched['cpro2']) == 1){
			  ?>
			  <tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro2']);?></td>
				  <td><?php echo $rowSched['pro_pod2'];?></td>
				  <td><?php echo $rowSched['pro_sn2'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php echo get_servicename($conn,$rowSched['service_type']);?></td>
				  <td><?php echo $rowSched['fs_id'];?></td>
	  		  </tr>
			  <?php
		  }
		  
		  /*if($rowSched['cpro2'] == 1 || $rowSched['cpro2'] == 2 || $rowSched['cpro2'] == 99 || $rowSched['cpro2'] == 148 || $rowSched['cpro2'] == 201){
			  
			  if($rowSched['cpro1'] == 147){
				  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){
				  ?>
				<tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro1']);?></td>
				  <td><?php echo $rowSched['pro_pod1'];?></td>
				  <td><?php echo $rowSched['pro_sn1'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php if($rowSched['cpro1'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
				</tr>
				  <?php
				  }
			  }else{
				  ?>
				<tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro1']);?></td>
				  <td><?php echo $rowSched['pro_pod1'];?></td>
				  <td><?php echo $rowSched['pro_sn1'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php if($rowSched['cpro1'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
				</tr>
				  <?php
			  }
			  
			  if($rowSched['cpro2'] == 147){
				  if($getMonth == 3 || $getMonth == 6 || $getMonth == 9 || $getMonth == 12){
				   ?>
				   <tr>
					  <td><?php echo $runRow++;?></td>
					  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
					  <td><?php echo get_proname($conn,$rowSched['cpro2']);?></td>
					  <td><?php echo $rowSched['pro_pod2'];?></td>
					  <td><?php echo $rowSched['pro_sn2'];?></td>
					  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
					  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
					  <td><?php if($rowSched['cpro2'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
					</tr>
				  <?php
				  }
			  }else{
				   ?>
			   <tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro2']);?></td>
				  <td><?php echo $rowSched['pro_pod2'];?></td>
				  <td><?php echo $rowSched['pro_sn2'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php if($rowSched['cpro2'] == 147){echo "งานบริการประจำ 3 เดือน/ครั้ง";}else{echo get_servicename($conn,$rowSched['type_service']);}?></td>
				</tr>
			  <?php
			  }
			  
			 
		  }else{
			  ?>
				<tr>
				  <td><?php echo $runRow++;?></td>
				  <td style="text-align: left;"><?php echo $rowSched['loc_name'];?></td>
				  <td><?php echo get_proname($conn,$rowSched['cpro1']);?></td>
				  <td><?php echo $rowSched['pro_pod1'];?></td>
				  <td><?php echo $rowSched['pro_sn1'];?></td>
				  <td><?php echo province_name($conn,$rowSched['cd_province']);?></td>
				  <td><?php echo custype_name($conn,$rowSched['ctype']);?></td>
				  <td><?php echo get_servicename($conn,$rowSched['type_service']);?></td>
				</tr>
			<?php
		 }*/
		  
	  }
	?>
  </tbody>
</table>
</body>
</html>