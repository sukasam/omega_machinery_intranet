<?php  

	include ("../../include/config.php");

	include ("../../include/connect.php");

	include ("../../include/function.php");

	include ("config.php");

	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");

	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}

	$param = get_param($a_param,$a_not_exists);

	

//	$cpro = $_REQUEST['cpro'];

//	$sr_ctype = $_REQUEST['sr_ctype'];		

//	$ctype = $_REQUEST['ctype'];

//	$cd_name = $_REQUEST['cd_name'];

	$loc_contact = $_REQUEST['loc_contact'];

	$opentake = $_REQUEST['opentake'];

	$status_type = $_REQUEST['status_type'];

	$sr_stock = $_REQUEST['sr_stock'];

	$type_service = $_REQUEST['type_service'];

	$loc_seal = $_REQUEST['loc_seal'];

	$loc_sn = $_REQUEST['loc_sn'];

	$a_sdate=explode("/",$_REQUEST['date_fm']);

	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	$a_sdate=explode("/",$_REQUEST['date_to']);

	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	if(!empty($_REQUEST['sr_stime'])){
		$a_sdate=explode("/",$_REQUEST['sr_stime']);
		$sr_stime = $a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	}
	
	

	if($_REQUEST['priod'] == 0){

		$daterriod = " AND `ref_date`  between '".$date_fm."' and '".$date_to."'"; 

		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 

	}

	else{

		$dateshow = "วันที่ดำเนินการ : ".format_date(date("Y-m-d")); 

	}

	

	$condition = "";



//	if($cpro != ""){

//		$condition = "AND (sv2.lists = '".$cpro."')";

//	}

//	

//	if($opentake == 0){

//		$condition .= " AND sv.st_setting = '".$opentake."'";

//	}else if($opentake == 1){

//		$condition .= " AND sv.st_setting = '".$opentake."'";

//	}else{

//		$condition .= " ";

//	}

//	
	if($sr_stime != ""){

		$condition .= " AND sv.sr_stime = '".$sr_stime."'";

	}

	if($loc_seal != ""){

		$condition .= " AND sv.loc_seal = '".$loc_seal."'";

	}

	if($loc_sn != ""){

		$condition .= " AND sv.loc_sn = '".$loc_sn."'";

	}

	if($status_type != ""){

		$condition .= " AND sv.status_type = '".$status_type."'";

	}

	if($sr_stock != ""){

		$condition .= " AND sv.sr_stock = '".$sr_stock."'";

	}

	if($type_service != ""){

		$condition .= " AND sv.type_service = '".$type_service."'";

	}

	
//	if($cd_name != ""){

//		$condition .= " AND fr.cd_name LIKE '%".$cd_name."%'";

//	}

	if($loc_contact != ""){

		$condition .= " AND sv.loc_contact2 LIKE '%".$loc_contact."%'";

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>เลือกตามใบรายงานซ่อมเครื่องเก่า</title>

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

</style>

</head>



<body>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

	  <tr>

	    <th colspan="5" style="text-align:left;">บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />

รายงานซ่อมเครื่องเก่า<br />
ประเภทใบบริการ  : <?php if($type_service == 2){echo 'เครื่องล้างแก้ว';}else if($type_service == 3){echo 'เครื่องผลิตน้ำแข็ง';}else if($type_service == 1){echo 'เครื่องล้างจาน';}else{echo 'ทั้งหมด';}?></th>

	    <th colspan="8" style="text-align:right;"><?php  echo $dateshow;?></th>

      </tr>

      <tr>

        <?php  if($_REQUEST['sh16'] == 1){?><th width="5%">เลขที่ใบซ่อมเครื่อเก่า</th><?php  }?>

		<th width="5%">รุ่นเครื่อง / SN</th>

        <?php  if($_REQUEST['sh1'] == 1){?><th width="15%">ชื่อร้าน / ถอดจาก<br>สถานที่จะไปติดตั้ง</th><?php  }?>

		<th width="5%">FO ที่ยกเลิก</th>

        <?php   /*if($_REQUEST['sh2'] == 1){?><th width="15%">ชื่อร้าน | สถานที่ติดตั้ง</th><?php  }*/?>

        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">รายละเอียดการเปลี่ยน</th><?php  }?>

		

        <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1){?><th width="30%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

          <tr>

            <?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="45%"><strong>รหัสอะไหล่ / รายการอะไหล่</strong></td><?php  }?>

            <?php  if($_REQUEST['sh5'] == 1){?><td style="border-bottom:none;" width="30%"><strong>จำนวน / ต่อหน่วย</strong></td><?php  }?>

			<td style="border-bottom:none;" width="20%"><strong>ยอดเงิน</strong></td>

<!--            <?php  if($_REQUEST['sh8'] == 1){?><td style="border-bottom:none;" width="25%"><strong>รวมมูลค่า</strong></td><?php  }?>-->

          </tr>

        </table></th><?php  }?>

        <?php  /*if($_REQUEST['sh8'] == 1){?><th width="5%"><strong>รวมมูลค่า</strong></th><?php  }*/?>

		<th width="5%">สถานะเครื่อง</th>

		<th width="5%">สต็อกเครื่อง</th>

        <?php  if($_REQUEST['sh6'] == 1){?><th width="5%"><strong>วันที่เบิก</strong></th><?php  }?>

        <?php  if($_REQUEST['sh7'] == 1){?><th width="5%"><strong>วันที่ถอดเครื่อง</strong></th><?php  }?>

		<?php  if($_REQUEST['sh7'] == 1){?><th width="5%"><strong>วันที่ซ่อมเสร็จ</strong></th><?php  }?>

        <?php  if($_REQUEST['sh9'] == 1){?><th width="5%" style="text-wrap: nowrap;"><strong>ผู้เบิก</strong></th><?php  }?>

      </tr>

      <?php  

	  	

		

		$dbservice = "s_service_report6";

		$dbservicesub = "s_service_report6sub";

	  

		$sql = "SELECT * FROM ".$dbservice." as sv, ".$dbservicesub." as sv2 WHERE sv.sr_id = sv2.sr_id ".$condition." ".$daterriod." GROUP BY sv.sr_id ORDER BY sv.sr_id DESC";

	  	$qu_fr = @mysqli_query($conn,$sql);

		$sum = 0;

		$totals = 0;

		$sumTotalAll = 0;

		$moneyTCTota = 0;

		while($row_fr = @mysqli_fetch_array($qu_fr)){

			

			$moneyTC = $row_fr['money1']+$row_fr['money2']+$row_fr['money3']+$row_fr['money4']+$row_fr['money5']+$row_fr['money6'];

			
			if(!empty($row_fr['cus_id'])){
				$finfo = get_firstorder($conn,$row_fr['cus_id']);
				$row_fr['cus_name'] =  $finfo['cd_name'];
				$row_fr['cus_location'] = $finfo['loc_name'];
			}

			$status_type_color = '';

			if($row_fr['status_type'] === '2'){
			}else if($row_fr['status_type'] === '3'){
			}else if($row_fr['status_type'] === '5'){
			}else if($row_fr['status_type'] === '4'){
				$status_type_color = 'color:#d767db;';
			}else{
				$status_type_color = 'color:blue;';
			}
		
			?>

			<tr style="<?php echo $status_type_color;?>">

              <?php  if($_REQUEST['sh16'] == 1){?><td><?php  echo $row_fr['sv_id'];?></td><?php  }?>

			  <td><?php  echo $row_fr['loc_seal'];?> / <?php  echo $row_fr['loc_sn'];?></td>

              <?php  if($_REQUEST['sh1'] == 1){?><td><strong>ชื่อร้าน: </strong><?php  echo $row_fr['cus_name'];?><br />
			<strong>ถอดจาก: </strong><?php  echo $row_fr['takeout'];?><br>
			<strong>สถานที่จะไปติดตั้ง: </strong><?php echo $row_fr['cus_location']?></td><?php  }?>

              <?php  /*if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['cus_location'];?><br />

              <?php  echo $row_fr['loc_address'];?></td><?php  }*/?>

			  <td><?php  echo $row_fr['srid'];?></td>

              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo $row_fr['detail_recom'];?></td><?php  }?>

              <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh8'] == 1){?><td style="padding:0;">

              	<?php  

				$qu_pfirst = @mysqli_query($conn,"SELECT * FROM ".$dbservicesub." WHERE sr_id = '".$row_fr['sr_id']."'");

				?>

				<table border="0" width="90%" cellspacing="0" cellpadding="0" class="tbreport">

				<?php 

				$totalamount = 0;

				$totalTA = 0;

				while($row = @mysqli_fetch_array($qu_pfirst)){

					if($row['codes 	'] != "" || $row['lists'] != ""){

						$total = $row['prices']*$row['opens'];

						$totalamount += $row['opens'];

					?>

					<tr style="<?php echo $status_type_color;?>">

					  <?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="50%"><?php  echo get_sparpart_id($conn,$row['lists']).' | '.get_sparpart_name($conn,$row['lists']);?></td><?php  }?>

					  <?php  if($_REQUEST['sh5'] == 1){?><td align="center" style="border-bottom:none;" width="25%"><?php  echo $row['opens'];?> * (<?php echo $row['prices'];?>)</td><?php  }?>


					  <td align="right" style="border-bottom:none;" width="25%"><?php  echo number_format($row['opens']*$row['prices']);?></td>
<!--					  <?php  if($_REQUEST['sh8'] == 1){?><td align="right" style="border-bottom:none;" width="25%"><?php  echo number_format($total,2);?></td><?php  }?>-->

					</tr>

				<?php  

					$sumTotalAll += $total;

					$totalTA +=	$total;

					

					}	

				}

					$totals += $totalamount

					

				?>

				<tr style="<?php echo $status_type_color;?>">

				<?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="50%"><strong>รวม (ราคาต้นทุน / ราคาอะไหล่)</strong></td><?php  }?>

				<?php  if($_REQUEST['sh5'] == 1){?><td align="center" style="border-bottom:none;" width="25%"></td><?php  }?>

				<td align="right" style="border-bottom:none;" width="25%"><strong><?php  echo number_format($totalTA+$moneyTC,2);?></strong></td>

				</tr>

                </table>

              </td><?php  }?>

              <?php /* if($_REQUEST['sh8'] == 1){?><td style="padding:0;font-size: 11px;"><strong><?php  echo number_format($totalTA+$moneyTC,2);?></strong></td><?php  }*/?>

			  <td>
			 <?php 
			 if($row_fr['status_type'] === '2'){
				echo $status_type = 'รอล้าง/ทำความสะอาด';
			}else if($row_fr['status_type'] === '3'){
				echo $status_type = 'ซ่อมหนัก (รอตัดซาก)';
			}else if($row_fr['status_type'] === '4'){
				echo $status_type = 'นำไปติดตั้งแล้ว';
			}else if($row_fr['status_type'] === '5'){
				echo $status_type = 'พร้อมใช้ / จองแล้ว';
			}else{
				echo $status_type = 'พร้อมใช้';
			}
			 ?> 
			 </td>

			 <td>
			 <?php 
			 if($row_fr['sr_stock'] === '1'){
				echo $sr_stock = 'ออฟฟิต สุขาภิบาล5';
			}else if($row_fr['sr_stock'] === '2'){
				echo $sr_stock = 'โรงงานลาดหลุมแก้ว	';
			}else{
				echo $sr_stock = '-';
			}
			 ?> 
			 </td>

              <?php  if($_REQUEST['sh6'] == 1){?><td style="padding:0;"><?php  echo format_date($row_fr['job_open']);?></td><?php  }?>

              <?php  if($_REQUEST['sh7'] == 1){?><td style="padding:0;"><?php  echo format_date($row_fr['job_out']);?></td><?php  }?>

			  <?php  if($_REQUEST['sh7'] == 1){?><td style="padding:0;"><?php  echo format_date($row_fr['sr_stime']);?></td><?php  }?>

              <?php  if($_REQUEST['sh9'] == 1){?><td style="padding:0;"><?php  echo get_technician_name($conn,$row_fr['loc_contact']);?></td><?php  }?>

            </tr>

			<?php 

			$sum += 1;

			$moneyTCTota += $moneyTC; 

		}

	  ?>

      <tr>

			  <td colspan="13" style="text-align:right;"> <strong>จำนวน<?php  if($_POST['sr_stock'] == "s_service_report6"){echo 'ใบซ่อมเครื่อเก่า';}else{echo "ใบซ่อมเครื่อเก่า";}?>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>

      <tr>

			  <td colspan="13" style="text-align:right;"> <strong>รวมอะไหล่ที่เบิก&nbsp;&nbsp;<?php  echo $totals;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>

	  <tr>

			  <td colspan="13" style="text-align:right;"> <strong>คิดเป็นมูลค่ารวมทั้งสิ้น&nbsp;&nbsp;<?php  echo number_format($sumTotalAll+$moneyTCTota,2);?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

	  </tr>

    </table>



</body>

</html>