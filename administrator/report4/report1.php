<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if(isset($_GET['cg_type'])){$_REQUEST['sh1'] = 1;$_REQUEST['sh2'] = 1;$_REQUEST['sh3'] = 1;$_REQUEST['sh4'] = 1;$_REQUEST['sh5'] = 1;$_REQUEST['sh6'] = 1;$_REQUEST['sh7'] = 1;$_REQUEST['sh8'] = 1;$_REQUEST['sh9'] = 1;$_REQUEST['sh10'] = 1;}
	
	$cd_name = $_REQUEST['cd_name'];
	$ctype = $_REQUEST['ctype'];
	$cg_type = $_REQUEST['cg_type'];
	$pro_type = $_REQUEST['pro_type'];
	$cs_sale = $_REQUEST['cs_sale'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `st.group_date`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}
	
	$condition = "";
	
	
	if($cd_name != ""){
		$condition .= " AND ss.cd_name LIKE '%".$cd_name."%'";
	}

	if($cg_type != ""){
		$condition .= " AND ss.cg_type = '".$cg_type."'";
	}
	
	if($ctype != ""){
		$condition .= " AND ss.ctype = '".$ctype."'";
	}

	if($pro_type != ""){
		$condition .= " AND ss.pro_type = '".$pro_type."'";
	}

	if($cs_sale != ""){
		$condition .= " AND ss.cs_sale = '".$cs_sale."'";
	}
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามตารางงายฝ่ายขาย</title>
<style type="text/css">
 .tbreport{
 	font-size:10px;
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
</style>
</head>

<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
	  <tr>
	    <th colspan="2" style="text-align:left;font-size:12px;">บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />
        รายงานตารางงานฝ่ายขาย <?php if($cs_sale != ""){echo ": ".getsalename($conn, $cs_sale);}?></th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <?php  if($_REQUEST['sh1'] == 1){?><th width="15%">ชื่อลูกค้า / ที่อยู่ /บริษัท + เบอร์โทร</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="10%">กลุ่มลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">ประเภทลูกค้า</th><?php  }?>
		<?php  if($_REQUEST['sh4'] == 1){?><th width="10%">ประเภทสินค้า</th><?php  }?>
        <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><th><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh5'] == 1){?><th style="border:0;" width="20%">วันที่นัดลูกค้า</th><?php  }?>
			<?php  if($_REQUEST['sh8'] == 1){?><th style="border:0;" width="18%"><center>สถานะลูกค้า</center></th><?php  }?>
			<?php  if($_REQUEST['sh9'] == 1){?><th style="border:0;" width="18%"><center>คาดหวัง</center></th><?php  }?>
            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;" width="39%">รายละเอียด</th><?php  }?>
          </tr><?php  }?>
        </table></th>
        <?php  if($_REQUEST['sh7'] == 1){?><th width="10%">ผู้ขาย</th><?php  }?>
      </tr>
      <?php  
	    
		$sql = "SELECT * FROM s_group_tracking as st,s_sale_schedule as ss WHERE st.group_type = 'sale_schedule' AND st.fo_id = ss.fo_id ".$condition." GROUP BY st.fo_id";
	  	$qu_fr = @mysqli_query($conn,$sql);
		$sum = 0;
		while($row_fr = @mysqli_fetch_array($qu_fr)){
			?>
			<tr>
              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
			  <?php echo "<strong>ที่อยู่ : </strong>".$row_fr['cd_address'];?>
			  <br />
              <?php  echo "<strong>เบอร์โทร : </strong>".$row_fr['cd_tel'];?></td><?php  }?>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo get_groupcusname($conn, $row_fr['cg_type']);?></td><?php  }?>
              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo getcustom_type($conn,$row_fr['ctype']);?></td><?php  }?>
			  <?php  if($_REQUEST['sh4'] == 1){?><td><?php  echo protype_name($conn,$row_fr['pro_type']);?></td><?php  }?>
              <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><td style="padding:0;">
              	<table width="96%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
					<?php
						$sqlSale = "SELECT * FROM s_group_tracking WHERE group_type = 'sale_schedule' AND fo_id = '".$row_fr['fo_id']."'";
						$qu_Sale = @mysqli_query($conn,$sqlSale);
						while($row_sale = @mysqli_fetch_array($qu_Sale)){
					?>
					<tr>
						<?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="20%"><?php  echo format_date_th ($row_sale['group_date'],7)." / ".$row_sale['group_time']. ' น.';?></td><?php  }?>
						<?php  if($_REQUEST['sh8'] == 1){?> <td style="border:0;padding-bottom:0;" width="18%"><center><?php  if($row_fr['status_cus'] == 3){echo "โทรศัพท์";}else if($row_fr['status_cus'] == 2){echo "เข้าพบ";}else if($row_fr['status_cus'] == 1){echo "สำรวจตลาด";}else{echo $row_fr['status_cus_other'];}?></center></td><?php  }?>
						<?php  if($_REQUEST['sh9'] == 1){?> <td style="border:0;padding-bottom:0;" width="18%"><center><?php  echo $row_fr['hope_cus'];?>%</center></td><?php  }?>
						<?php  if($_REQUEST['sh6'] == 1){?> <td style="border:0;padding-bottom:0;" width="39%"><?php  echo $row_fr['group_detail'];?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
					</tr>
					<?php
						}
					?>
              </table></td><?php  }?>
              <?php  if($_REQUEST['sh7'] == 1){?><td><?php  echo getsalename($conn,$row_fr['cs_sale']);?></td><?php  }?>
            </tr>
			<?php 
			$sum += 1;	
		}
	  ?>
      <tr>
		<td colspan="6" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>