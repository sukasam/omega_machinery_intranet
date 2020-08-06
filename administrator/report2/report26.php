<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");

	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$loc_contact = $_REQUEST['loc_contact'];
	//$openclose = $_REQUEST['openclose'];

	$openclose = 1;
	$frdata = $_REQUEST['frdata'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	
	//$daterriod = " AND `job_open`  between '".$date_fm."' and '".$date_to."'"; 
	//$daterriod = " AND `job_close`  between '".$date_fm."' and '".$date_to."'"; 
		
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `sr_stime`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."<br>ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}

	
	$condition = "";
	
	$txtopenclose = '';
	if($openclose == 2){
		$condition .= " AND sv.st_setting = 0 "; 
		$txtopenclose = 'เปิด';
	}else if($openclose == 3){
		$condition .= " AND sv.st_setting = 1 "; 
		$txtopenclose = 'ปิด';
	}else{
		$txtopenclose = 'ทั้งหมด';
		$condition .= "";
	}

	// if($_REQUEST['otVal'] == 1){
	// 	$condition .= " AND (`ot_time` != '' OR `ot_dateto` != '' OR `ot_datefm` != '')"; 
	// }
	
	if($loc_contact != ""){
		$condition .= " AND sv.loc_contact = '".$loc_contact."'";
	}

	if($frdata == 2){
		$condition .= " AND sv.fs_id LIKE 'FO%'";
	}else if($frdata == 3){
		$condition .= " AND sv.fs_id LIKE 'SV%'";
	}
	// if($sr_ctype != ""){
	// 	$condition .= " AND sv.sr_ctype = '".$sr_ctype."'";
	// }
	
	// if($ctype != ""){
	// 	$condition .= " AND sv.sr_ctype2 = '".$ctype."'";
	// }
	
	// if($cpro != ""){
	// 	$condition .= " AND (sv.cpro1 = '".$cpro."' OR sv.cpro2 = '".$cpro."' OR sv.cpro3 = '".$cpro."' OR sv.cpro4 = '".$cpro."' OR sv.cpro5 = '".$cpro."')";
	// }
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามรายชื่อช่าง ( <?php  if($loc_contact){echo get_technician_name($conn,$loc_contact);}else{echo "ตามรายชื่อช่างทั้งหมด";}?> )</title>
<style type="text/css">
 .tbreport{
 	font-size:14px;
 }
 .tbreport th{
	font-weight:bold;
	text-align:left;
	border-bottom:1px solid #000000;
	padding:5;
 }
 .tbreport td{
	 padding:5px;
	 vertical-align:top;
	 border-bottom:1px solid #000000;
 }
 body{
	 font-size:18px;
 }
 .tdLinegay{
	border-bottom: 1px solid #dddddd !important;
 }
 .tdLineblack{
	 border-bottom: 1px solid #b6b5b5 !important;
}
</style>

<script>
function chkPrint(){
	setTimeout(function () { window.print(); }, 500);
	// window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
}
</script>
</head>

<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
	  <tr>
	    <th colspan="3" style="text-align:left;font-size:14px;">บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />
รายงานสรุป (แยกตามรายชื่อช่าง) <br>
<?php  if($loc_contact){echo get_technician_name($conn,$loc_contact);}else{echo "ตามรายชื่อช่างทั้งหมด";}?> <?php if($openclose == 2 || $openclose == 3){echo "(แยกตามที่".$txtopenclose."ใบงาน)";}else{echo "(แยกตามใบงานทั้งหมด)";}?><br />
</th>
	    <th colspan="2" style="text-align:right;font-size:14px;vertical-align:bottom;"><?php  echo $dateshow;?><br />
        <br />
        <br /></th>
      </tr>
      <tr>
	  	<th width="40%" class="tdLinegay">รายการ </th>
		<th width="20%" class="tdLinegay" style="white-space: nowrap;"><center>จำนวน</center></th>
		<th width="20%" class="tdLinegay" style="white-space: nowrap;"><center><img src="../icons/favorites_use.png" width="15" height="15"> ไม่เข้าบริการ</center></th>
		<th width="20%" class="tdLinegay" style="white-space: nowrap;"><center><img src="../icons/favorites_close.png" width="15" height="15"> เข้าบริการ</center></th>
		<th width="20%" class="tdLinegay" style="white-space: nowrap;"><center>ลักษณนาม</center></th>
      </tr>

	  <?php  
	  	checkTotalOpenCloseService($conn,$condition,$daterriod);
		$open = getTotalOpenCloseService($conn,$condition,$daterriod,2);
		$close = getTotalOpenCloseService($conn,$condition,$daterriod,3);
		$closeNotSV = getTotalOpenCloseService($conn,$condition,$daterriod,4);
		
	  ?>
      <!-- <tr>
			  <td colspan="3" align="right"><strong>ให้บริการตามรายชื่อช่างทั้งหมด</strong>&nbsp;&nbsp;&nbsp;<strong><?php  echo $sums;?>&nbsp;&nbsp;รายการ</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  </tr> -->

	  <tr>
		<td class="tdLineblack">เปิดใบงานทั้งหมด</td>
		<td class="tdLineblack"><center><?php echo $open;?></center></td>
		<td class="tdLineblack"></td>
		<td class="tdLineblack"></td>
		<td class="tdLineblack"><center>ใบ</center></td>
	</tr>
	<tr>
		<td class="tdLinegay">ปิดใบงานทั้งหมด</td>
		<td class="tdLinegay"><center><?php echo $close;?></center></td>
		<td class="tdLinegay"></td>
		<td class="tdLinegay"></td>
		<td class="tdLinegay"><center>ใบ</center></td>
	</tr>
	<tr>
		<td class="tdLineblack">ปิดใบงาน/เข้าบริการ</td>
		<td class="tdLineblack"></td>
		<td class="tdLineblack"></td>
		<td class="tdLineblack"><center><?php echo number_format($close-$closeNotSV);?></center></td>
		<td class="tdLineblack"><center>ใบ</center></td>
	</tr>
	<tr>
		<td class="tdLinegay">ปิดใบงาน/ไม่เข้าบริการ</td>
		<td class="tdLinegay"></td>
		<td class="tdLinegay"><center><?php echo $closeNotSV;?></center></td>
		<td class="tdLinegay"></td>
		<td class="tdLinegay"><center>ใบ</center></td>
	</tr>
	<tr>
		<td class="tdLineblack">ใบงานคงค้าง</td>
		<td class="tdLineblack"><center><?php echo number_format($open-$close);?></center></td>
		<td class="tdLineblack"></td>
		<td class="tdLineblack"></td>
		<td class="tdLineblack"><center>ใบ</center></td>
	</tr>
	<tr>
	  	<th width="40%">แยกตามประเภทลูกค้า (ข้อมูลจากการปิดใบงานทั้งหมด)</th>
		<th width="20%" style="white-space: nowrap;"></th>
		<td></td>
		<td></td>
		<th width="20%" style="white-space: nowrap;"></th>
      </tr>
	  <?php
	 	  $sqlTypeCus = "SELECT * FROM s_group_custommer ORDER BY group_name ASC";
		  $quTypeCus = @mysqli_query($conn,$sqlTypeCus);
		  $runLine = 0;
		  $sumTotolType = 0; 
		  $sumTotolNotS = 0; 
		  $sumTotolServ = 0; 
		  while($row_typecus = @mysqli_fetch_array($quTypeCus)){

			$closeType = getTotalOpenCloseService($conn,$condition,$daterriod,5,$row_typecus['group_id']);

			if($closeType >= 1){
				$classLine = '';
				if($runLine % 2 == 0){
					$classLine = 'tdLinegay';
				}else{
					$classLine = 'tdLineblack';
				}

				$closeTypeNotS = getTotalOpenCloseService($conn,$condition,$daterriod,6,$row_typecus['group_id'],2);
				$closeTypeS = getTotalOpenCloseService($conn,$condition,$daterriod,6,$row_typecus['group_id'],1);

			  ?>
			  <tr>
					<td class="<?php echo $classLine;?>"><?php echo $row_typecus['group_name'];?></td>
					<td class="<?php echo $classLine;?>"><center><?php echo number_format($closeType);?></center></td>
					<td class="<?php echo $classLine;?>"><center><?php echo number_format($closeTypeNotS)?></center></td>
					<td class="<?php echo $classLine;?>"><center><?php echo number_format($closeTypeS)?></center></td>
					<td class="<?php echo $classLine;?>"><center>ใบ</center></td>
				</tr>
			  <?php
			  $sumTotolType += $closeType; 
			  $sumTotolNotS += $closeTypeNotS; 
			  $sumTotolServ += $closeTypeS; 
			  $runLine++;
			}
		  }
	  ?>
	  <tr>
		<td class="tdLineblack">รวมทั้งหมด</td>
		<td class="tdLineblack"><center><?php echo number_format($sumTotolType);?></center></td>
		<td class="tdLineblack"><center><?php echo number_format($sumTotolNotS);?></center></td>
		<td class="tdLineblack"><center><?php echo number_format($sumTotolServ);?></center></td>
		<td class="tdLineblack"><center>ใบ</center></td>
	</tr>
    </table>
		  <br><br>
	<center><img src="../images/icons/icon-48-print.png" onClick="javascript:chkPrint();" style="cursor: pointer;"></center>
	<br><br>
</body>
</html>