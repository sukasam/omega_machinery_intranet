<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ปฏิทินงานฝ่ายขาย (วันที่ <?php  echo sprintf("%02d",$_GET['day']).'-'.sprintf("%02d",$_GET['month']).'-'.sprintf("%02d",($_GET['year']+543));?> )</title>

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
    <!-- <th width="10%">Report ID</th> -->
    <th width="26%">ชื่อร้านค้า</th>
    <th width="10%">เบอร์โทร</th>
	<!-- <th width="10%">รุ่นเครื่อง</th> -->
	<th width="10%">เวลา</th>
	<th width="15%">พนักงานขาย</th>
    <th width="10%">วันที่เปิด</th>
  </tr>
  <?php  
  
  	$con = $_GET['year']."-".sprintf("%02d",$_GET['month'])."-".sprintf("%02d",$_GET['day']);		
	
	if($_GET['cs_sale'] != ""){
		$loc = " AND ss.cs_sale = '".$_GET['cs_sale']."'";
	}

	

	// echo "SELECT * FROM s_group_tracking as st,s_sale_schedule as ss WHERE st.group_type = 'sale_schedule' AND st.group_date = '".$con."' ".$loc." GROUP BY st.fo_id";
	
  	$qu_service = @mysqli_query($conn,"SELECT * FROM s_group_tracking as st,s_sale_schedule as ss WHERE st.group_type = 'sale_schedule' AND st.fo_id = ss.fo_id AND st.group_date = '".$con."' ".$loc);
	$romn = 1;
	while($row_serv = @mysqli_fetch_array($qu_service)){
	
	$rowColor = "";
	$rowColor = "green";
	$scstatus = "<a href=\"../job_tracking/index.php?tab=sale_schedule&fo_id=".$row_serv['fo_id']."\" target=\"_blank\" style=\"text-decoration: none;\"><span style=\"color:".$rowColor.";\">".$row_serv["cd_name"]."</span></a>";

	$tecService = getsalename($conn,$row_serv['cs_sale']);

  ?>  
  <tr>
    <td style="text-align:center;color:<?php echo $rowColor;?>"><?php  echo sprintf("%03d",$romn);?></td>
    <!-- <td style="text-align:center;color:<?php echo $rowColor;?>"><?php  echo $scstatus;?></td> -->
    <td style="padding-left:10px;padding-right:10px;color:<?php echo $rowColor;?>"><?php  echo $scstatus;?></td>
    <td style="text-align:center;color:<?php echo $rowColor;?>"><?php  echo $row_serv['cd_tel'];?></td>
	<!-- <td style="text-align:center;color:<?php echo $rowColor;?>"><?php  echo $row_serv["loc_seal"];?></td> -->
	<td style="text-align:center;color:<?php echo $rowColor;?>"><?php  echo $row_serv['group_time'];?></td>
	<td style="text-align:center;color:<?php echo $rowColor;?>"><?php  echo $tecService;?></td>
    <td style="text-align:center;color:<?php echo $rowColor;?>"><?php  echo format_date_th ($row_serv['date_forder'],7);?></td>
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