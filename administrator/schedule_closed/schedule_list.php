<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางปิดงานบริการ (วันที่ <?php  echo sprintf("%02d",$_GET['day']).'-'.sprintf("%02d",$_GET['month']).'-'.sprintf("%02d",($_GET['year']+543));?> )</title>

<style type="text/css">
	.tbservice{
		
	}
	.tbservice tr{
			
	}
	.tbservice tr th{
		font-size:13px;
		font-weight:bold;
		border:1px solid #CCCCCC;
	}
	.tbservice tr td{
		border:1px solid #CCCCCC;
		font-size:12px;
	}
	a{
		color:#000000;	
	}
</style>

</head>

<body>

<table width="100%" border="0" class="tbservice">
  <tr>
    <th width="9%">ลำดับ</th>
    <th width="16%">Report ID</th>
    <th width="35%">ชื่อลูกค้า - ร้านค้า</th>
    <th width="17%">เบอร์โทร</th>
	<th width="10%">ปิดใบงาน</th>
    <th width="12%">ดาวน์โหลด</th>
  </tr>
  <?php  
  
  	$con = $_GET['year']."-".sprintf("%02d",$_GET['month'])."-".sprintf("%02d",$_GET['day']);		
	
	if($_GET['loccontact'] != ""){
		$loc = " AND loc_contact = '".$_GET['loccontact']."'";
	}
	
	if($_GET['sr_ctype'] != ""){
		$ctype = " AND sr_ctype = '".$_GET['sr_ctype']."'";
	}
	
  	$qu_service = @mysqli_query($conn,"SELECT * FROM s_service_report WHERE job_close = '".$con."' AND st_setting = 1 ". $loc . $ctype." ORDER BY signature_date ASC");
	$romn = 1;
	while($row_serv = @mysqli_fetch_array($qu_service)){
	$chaf = preg_replace("/\//","-",$row_serv["sv_id"]);
	$finfo = get_firstorder($conn,$row_serv['cus_id']);
	
	// if($row_serv['st_setting'] == 0){
	// 	$scstatus = "<a href=\"../../upload/service_report_open/".$chaf.".pdf\" target=\"_blank\" style=\"text-decoration: none;\"><span style=\"color:green;\">".$row_serv['sv_id']."</span></a>";
	// }else{
	// 	$scstatus = "<a href=\"../../upload/service_report_open/".$chaf.".pdf\" target=\"_blank\" style=\"text-decoration: none;\"><span style=\"color:red;\">".$row_serv['sv_id']."</span></a>";
	// }

	$scstatus = "<a href=\"../../upload/service_report_close/".$chaf.".pdf\" target=\"_blank\" style=\"text-decoration: none;\"><span style=\"color:red;\">".$row_serv['sv_id']."</span></a>";
	
  ?>  
  <tr>
    <td style="text-align:center;"><?php  echo sprintf("%03d",$romn);?></td>
    <td style="text-align:center;"><?php  echo $scstatus;?></td>
    <td style="padding-left:10px;padding-right:10px"><?php  echo $finfo['loc_name'];?></td>
	<td style="text-align:center;"><?php  echo $finfo['c_contact']."/".$finfo['c_tel'];?></td>
	<td style="text-align:center;"><?php  echo format_date_th ($row_serv['signature_date'],10);?></td>
    <td style="text-align:center;"><?php  $chaf = preg_replace("/\//","-",$row_serv["sv_id"]);?><a href="../../upload/service_report_open/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icons/icon-48-category.png" width="25" height="25" title="ใบเปิดงาน"/></a><a href="../../upload/service_report_close/<?php  echo $chaf;?>.pdf" target="_blank"><img src="../images/icons/icon-48-section.png" width="25" height="25" title="ใบปิดงาน"/></a></td>
  </tr>
  <?php  $romn++;}?>
</table>
<style>
.button {
    font-family: Verdana, Arial, sans-serif;
    display: inline-block;
    background: #D47100 url(../images/bg-button-green.gif) top left repeat-x !important;
    border: 1px solid #D47100 !important;
    padding: 4px 7px 4px 7px !important;
    color: #fff !important;
    font-size: 11px !important;
    cursor: pointer;
    font-weight: bold;
}
</style>
<br>
<div>
<center><a href="javascript:print();"><input class=button name="btprint" type="button" value=" Print "></a></center>
</div>

</body>
</html>