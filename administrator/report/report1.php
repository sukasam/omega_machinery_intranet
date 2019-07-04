<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission ($check_module,$_SESSION[login_id],"read");
	if ($_GET[page] == ""){$_REQUEST[page] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if(isset($_GET['priod'])){$_REQUEST['sh1'] = 1;$_REQUEST['sh2'] = 1;$_REQUEST['sh3'] = 1;$_REQUEST['sh4'] = 1;$_REQUEST['sh5'] = 1;$_REQUEST['sh6'] = 1;$_REQUEST['sh7'] = 1;$_REQUEST['sh8'] = 1;$_REQUEST['sh9'] = 1;$_REQUEST['sh10'] = 1;}
	
	$cd_name = $_REQUEST['cd_name'];
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	if($_REQUEST['priod'] == 0){
		$daterriod = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}
	
	if($_REQUEST['use'] == 0){
		$codi = " AND status_use = 0";
		$serT = "ใช้งาน";
	}elseif($_REQUEST['use'] == 1){
		$codi = " AND status_use = 1";
		$serT = "Stand by";
	}elseif($_REQUEST['use'] == 2){
		$codi = " AND status_use = 2";
		$serT = "ยกเลิก";
	}elseif($_REQUEST['use'] == 3){
		$codi = " AND status_use = 3";
		$serT = "Service";
	}else{
		$codi = "";
		$serT = "";
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เลือกตามชื่อร้าน-ชื่อบริษัท ( <?php  if($cd_name != ""){echo $cd_name;}else{echo $serT."ทั้งหมด";}?> )</title>
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
	    <th colspan="2" style="text-align:left;font-size:12px;"><p>บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />
	      รายงานตามชื่อร้าน-ชื่อบริษัท ( <?php  if($cd_name != ""){echo $cd_name;}else{echo $serT."ทั้งหมด";}?> )</p></th>
	    <th colspan="6" style="text-align:right;font-size:11px;"><?php  echo $dateshow;?></th>
      </tr>
      <tr>
        <?php  if($_REQUEST['sh1'] == 1){?><th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php  }?>
        <?php  if($_REQUEST['sh2'] == 1){?><th width="20%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">จังหวัด</th><?php  }?>
        <?php  if($_REQUEST['sh4'] == 1){?><th width="9%">ประเภทลูกค้า</th><?php  }?>
        <?php  if($_REQUEST['sh5'] == 1){?><th width="8%">กลุ่มลูกค้า</th><?php  }?>
		<?php  if($_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1 || $_REQUEST['sh8'] == 1){?><th width="26%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">
          <tr>
            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;text-align:left;" >สินค้า</th><?php  }?>
            <?php  if($_REQUEST['sh7'] == 1){?><th style="border:0;text-align:left;padding-left:70px;;" >รุ่นเครื่อง/SN</th><?php  }?>
            <?php  if($_REQUEST['sh8'] == 1){?><th style="border:0;text-align:right;padding-right:30px;">ราคาขาย/ค่าเช่า</th><?php  }?>
          </tr>
        </table></th><?php  }?>
        <?php  if($_REQUEST['sh9'] == 1){?><th width="8%">วันที่ติดตั้ง</th><?php  }?>
        <?php  if($_REQUEST['sh10'] == 1){?><th width="4%">ผู้ขาย</th><?php  }?>
      </tr>
      <?php  
		$sql = "SELECT * FROM s_first_order WHERE cd_name LIKE '%".$cd_name."%'".$daterriod." ".$codi." ORDER BY date_forder ASC";
	  	$qu_fr = @mysql_query($sql);
		$sum = 0;
		while($row_fr = @mysql_fetch_array($qu_fr)){
			
			if(substr(get_groupcusname($row_fr['cg_type']),0,2) != "SV" && substr(custype_name($row_fr['ctype']),0,2) != "SR"){
				
			?>
			<tr>
             <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />
              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>
              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['loc_name'];?><br />
              <?php  echo $row_fr['loc_address'];?></td><?php  }?>
              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo province_name($row_fr['cd_province']);?></td><?php  }?>
              <?php  if($_REQUEST['sh4'] == 1){?><td><?php  echo custype_name($row_fr['ctype']);?></td><?php  }?>
              <?php  if($_REQUEST['sh5'] == 1){?><td><?php  echo get_groupcusname($row_fr['cg_type']);?></td><?php  }?>
              <?php  if($_REQUEST['sh6'] == 1 || $_REQUEST['sh7'] == 1 || $_REQUEST['sh8'] == 1){?><td style="padding:0;">
              	<table width="92%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">
                <?php  
					if($row_fr['cpro1'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="31%"><?php  echo get_proname($row_fr['cpro1']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;" width="33%"><?php  echo $row_fr['pro_pod1']." / ".$row_fr['pro_sn1'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;text-align:right;"><?php  echo number_format($row_fr['cprice1']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro2'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo get_proname($row_fr['cpro2']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo $row_fr['pro_pod2']." / ".$row_fr['pro_sn2'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;"><?php  echo number_format($row_fr['cprice2']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro3'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo get_proname($row_fr['cpro3']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo $row_fr['pro_pod3']." / ".$row_fr['pro_sn3'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;"><?php  echo number_format($row_fr['cprice3']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro4'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo get_proname($row_fr['cpro4']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo $row_fr['pro_pod4']." / ".$row_fr['pro_sn4'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;"><?php  echo number_format($row_fr['cprice4']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro5'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo get_proname($row_fr['cpro5']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo $row_fr['pro_pod5']." / ".$row_fr['pro_sn5'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;"><?php  echo number_format($row_fr['cprice5']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro6'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo get_proname($row_fr['cpro6']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo $row_fr['pro_pod6']." / ".$row_fr['pro_sn6'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;"><?php  echo number_format($row_fr['cprice6']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
                <?php  
					if($row_fr['cpro7'] != ""){
						?>
						<tr>
                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo get_proname($row_fr['cpro7']);?></td><?php  }?>
                          <?php  if($_REQUEST['sh7'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo $row_fr['pro_pod7']." / ".$row_fr['pro_sn7'];?></td><?php  }?>
                          <?php  if($_REQUEST['sh8'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;text-align:right;"><?php  echo number_format($row_fr['cprice7']);?>&nbsp;&nbsp;&nbsp;</td><?php  }?>
                        </tr>
						<?php 	
					}
				?>
              </table></td><?php  }?>
              <?php  if($_REQUEST['sh9'] == 1){?><td><?php  echo format_date($row_fr['cs_setting']);?></td><?php  }?>
              <?php  if($_REQUEST['sh10'] == 1){?><td><?php  echo get_sale_id($row_fr['cs_sell']);?></td><?php  }?>
            </tr>
			
			<?php 
			$sum += 1;
			}
		}
	  ?>
       <tr>
		<td colspan="8" style="text-align:right;"> <strong>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>
	  </tr>
    </table>

</body>
</html>