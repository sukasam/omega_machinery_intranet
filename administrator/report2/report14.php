<?php

include("../../include/config.php");

include("../../include/connect.php");

include("../../include/function.php");

include("config.php");

Check_Permission($conn, $check_module, $_SESSION["login_id"], "read");

if ($_GET["page"] == "") {
	$_REQUEST['page'] = 1;
}

$param = get_param($a_param, $a_not_exists);



$cpro = $_REQUEST['cpro'];

$sr_ctype = $_REQUEST['sr_ctype'];

$ctype = $_REQUEST['ctype'];

$cd_name = $_REQUEST['cd_name'];

$loc_seal = $_REQUEST['loc_seal'];

$a_sdate = explode("/", $_REQUEST['date_fm']);

$date_fm = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

$a_sdate = explode("/", $_REQUEST['date_to']);

$date_to = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];



if ($_REQUEST['priod'] == 0) {

	$daterriod = " AND `sr_stime`  between '" . $date_fm . "' and '" . $date_to . "'";

	$dateshow = "เริ่มวันที่ : " . format_date($date_fm) . "&nbsp;&nbsp;ถึงวันที่ : " . format_date($date_to);
} else {

	$dateshow = "วันที่ดำเนินการ : " . format_date(date("Y-m-d"));
}



$condition = "";


if ($cpro != "") {

	$condition = "AND (sv.sr_id = sv2.sr_id) AND (sv2.lists = '" . $cpro . "')";
}



if ($sr_ctype != "") {

	$condition .= " AND sv.sr_ctype = '" . $sr_ctype . "'";
}



if ($ctype != "") {

	$condition .= " AND sv.sr_ctype2 = '" . $ctype . "'";
}



if ($cd_name != "") {

	$condition .= " AND fr.cd_name LIKE '%" . $cd_name . "%'";
}

if ($loc_seal != "") {

	$condition .= " AND sv.loc_seal LIKE '%" . $loc_seal . "%'";
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>เลือกตาม Installation</title>

	<style type="text/css">
		.tbreport {

			font-size: 13px;

		}

		.tbreport th {

			font-weight: bold;

			text-align: left;

			border-bottom: 1px solid #000000;

			padding: 5;

		}

		.tbreport td {

			padding: 5px;

			vertical-align: top;

			border-bottom: 1px solid #000000;

		}
	</style>

</head>



<body>

	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

		<tr>

			<th colspan="3" style="text-align:left;">บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />

				รายงาน Installation<br />

				ประเภทลูกค้า :

				<?php if ($_POST['ctype'] != "") {
					echo getcustom_type($conn, $_POST['ctype']);
				} else {
					echo "ทั้งหมด";
					
				} ?>
				<?php  if($cpro != ""){echo "(".get_sparpart_id($conn,$cpro).' | '.get_sparpart_name($conn,$cpro).")";}?>
			</th>

			<th colspan="4" style="text-align:right;"><?php echo $dateshow; ?></th>

		</tr>

		<tr>

			<?php if ($_REQUEST['sh9'] == 1) { ?><th width="5%">เลขที่ติดตั้ง</th><?php  } ?>

			<?php if ($_REQUEST['sh1'] == 1) { ?><th width="15%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php  } ?>

			<?php if ($_REQUEST['sh2'] == 1) { ?><th width="15%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  } ?>

			<?php if ($_REQUEST['sh3'] == 1) { ?>

				<th width="17%">รุ่นเครื่อง / S/N</th><?php  } ?>

			<?php if ($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1 || $_REQUEST['sh10'] == 1) { ?><th width="40%">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

						<tr>

							<?php if ($_REQUEST['sh4'] == 1) { ?><td style="border-bottom:none;" align="center" width="50%"><strong>รายการอะไหล่</strong></td><?php  } ?>

							<?php if ($_REQUEST['sh5'] == 1) { ?><td style="border-bottom:none;" align="center" width="25%"><strong>จำนวน</strong></td><?php  } ?>

							<?php if ($_REQUEST['sh10'] == 1) { ?><td style="border-bottom:none;" align="<?php if($_REQUEST['sh6'] == 1 && $_REQUEST['sh10'] == 1){echo "center";}else{echo "right";}?>" width="25%"><strong>ราคาต้นทุน</strong></td><?php  } ?>

							<?php if ($_REQUEST['sh6'] == 1) { ?><td style="border-bottom:none;text-wrap: nowrap;" align="<?php if($_REQUEST['sh6'] == 1 && $_REQUEST['sh10'] == 1){echo "center";}else{echo "right";}?>" width="25%"><strong>ราคาขาย</strong></td><?php  } ?>

							

						</tr>

					</table>
				</th><?php  } ?>

			<?php if ($_REQUEST['sh7'] == 1) { ?>

				<th width="10%" style="text-wrap: nowrap;text-align: center;"><strong>วันที่ส่งงาน</strong></th><?php  } ?>

			<?php if ($_REQUEST['sh8'] == 1) { ?><th width="5%" style="text-align: center;"><strong>ผู้เบิก</strong></th><?php  } ?>

		</tr>

		<?php



		$dbservice = "s_service_report4";

		$dbservicesub = "s_service_report4sub";


		$sql = "SELECT fr.*,sv.*,sv2.r_id,sv2.codes,sv2.lists,sv2.units,sv2.prices,sv2.amounts,sv2.opens,sv2.remains FROM s_first_order as fr, " . $dbservice . " as sv, " . $dbservicesub . " as sv2 WHERE sv.cus_id = fr.fo_id " . $condition . " " . $daterriod . " GROUP by sv.sr_id ORDER BY sv.sr_id DESC";

		//echo $sql = "SELECT fr.cd_name,fr.cd_address,fr.loc_name, sv.* FROM ".$tableDB." as fr, ".$dbservice." as sv, ".$dbservicesub." as sv2 WHERE sv.cus_id = fr.fo_id ".$condition." ".$daterriod." GROUP by sv.sr_id ORDER BY sv.sr_id DESC";

		$qu_fr = @mysqli_query($conn, $sql);

		$sum = 0;

		$sumUnit = 0;

		$sumre = 0;

		$totals = 0;

		$spartpart = 0;

		$totalsall = 0;
		
		$totalsallUnit = 0;

		$totalsSumOther = 0;

		$totalsAllSumOther = 0;

		while ($row_fr = @mysqli_fetch_array($qu_fr)) {

		?>

			<tr>

				<?php if ($_REQUEST['sh9'] == 1) { ?><td><?php echo $row_fr['sv_id']; ?></td><?php  } ?>

				<?php if ($_REQUEST['sh1'] == 1) { ?><td><?php echo $row_fr['cd_name']; ?><br />

						<?php echo $row_fr['cd_tel']; ?></td><?php  } ?>

				<?php if ($_REQUEST['sh2'] == 1) { ?><td><?php echo $row_fr['loc_name']; ?><br />

						<?php echo $row_fr['loc_address']; ?></td><?php  } ?>

				<?php if ($_REQUEST['sh3'] == 1) { ?><td><?php echo $row_fr['loc_seal']; ?> / <?php echo $row_fr['loc_sn']; ?></td><?php  } ?>

				<?php if ($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1 || $_REQUEST['sh10'] == 1) { ?><td style="padding:0;">

						<?php

						$qu_pfirst = @mysqli_query($conn, "SELECT * FROM " . $dbservicesub . " WHERE sr_id = '" . $row_fr['sr_id'] . "'");

						?>

						<table border="0" width="100%" cellspacing="0" cellpadding="0" class="tbreport">

							<?php

							$totalamount = 0;

							$sum = 0;
							$sumUnit = 0;

							$total = 0;
							$totalUnit = 0;
							

							while ($row = @mysqli_fetch_array($qu_pfirst)) {

								if (!empty($row['codes']) ||  !empty($row['lists'])) {

									if(empty($cpro)){

										$total = $row['prices'] * $row['opens'];
									
										$totalUnit = get_sparpart_uniprice($conn, $row['lists']) * $row['opens'];

										$totalamount += $row['opens'];

									?>

										<tr>

											<?php if ($_REQUEST['sh4'] == 1) { ?><td style="border-bottom:none;width: 50%;"><?php echo get_sparpart_id($conn, $row['lists']) . ' | ' . get_sparpart_name($conn, $row['lists']); ?></td><?php  } ?>

											<?php if ($_REQUEST['sh5'] == 1) { ?><td align="center" style="border-bottom:none;width: 14%;"><?php echo $row['opens']; ?></td><?php  } ?>

											<?php if ($_REQUEST['sh10'] == 1) { ?><td align="right" style="border-bottom:none;width: 18%;padding-right: 20px;"><?php echo number_format($totalUnit, 2); ?></td><?php } ?>

											<?php if ($_REQUEST['sh6'] == 1) { ?><td align="right" style="border-bottom:none;width: 18%;padding-right: 20px;"><?php echo number_format($total, 2); ?></td><?php } ?>

										</tr>

									<?php

										$sum += $total;
										$sumUnit += $totalUnit;
										$spartpart += 1;

									}else{

										if($cpro === $row['lists']){
											$total = $row['prices'] * $row['opens'];
											$totalUnit = get_sparpart_uniprice($conn, $row['lists']) * $row['opens'];
											$totalamount += $row['opens'];
	
										?>
	
											<tr>
	
												<?php if ($_REQUEST['sh4'] == 1) { ?><td style="border-bottom:none;width: 50%;"><?php echo get_sparpart_id($conn, $row['lists']) . ' | ' . get_sparpart_name($conn, $row['lists']); ?></td><?php  } ?>
	
												<?php if ($_REQUEST['sh5'] == 1) { ?><td align="center" style="border-bottom:none;width: 14%;"><?php echo $row['opens']; ?></td><?php  } ?>
	
												<?php if ($_REQUEST['sh10'] == 1) { ?><td align="right" style="border-bottom:none;width: 18%;padding-right: 20px;"><?php echo number_format($totalUnit, 2); ?></td><?php } ?>
	
												<?php if ($_REQUEST['sh6'] == 1) { ?><td align="right" style="border-bottom:none;width: 18%;padding-right: 20px;"><?php echo number_format($total, 2); ?></td><?php } ?>
	
											</tr>
	
										<?php
	
											$sum += $total;
											$sumUnit += $totalUnit;
	
											$spartpart += 1;
										}
									}
								}
							}



							$totalsall += $sum;

							$totalsallUnit += $sumUnit;

							?>

							<tr>

								<td style="border-bottom:none;"><strong>รวม (<?php if ($_REQUEST['sh10'] == 1) { ?>ราคาต้นทุน<?php } ?> /  <?php if ($_REQUEST['sh6'] == 1) { ?>ราคาอะไหล่<?php } ?>) </strong></td>

								<td style="border-bottom:none;">&nbsp;</td>

								<?php if ($_REQUEST['sh10'] == 1) { ?><td align="right" ; style="border-bottom:none;padding-right: 20px;"><strong><?php echo number_format($sumUnit, 2); ?></strong></td><?php } ?>

								<?php if ($_REQUEST['sh6'] == 1) { ?><td align="right" ; style="border-bottom:none;padding-right: 20px;"><strong><?php echo number_format($sum, 2); ?></strong></td><?php } ?>

							</tr>

						</table>

						<table border="0" width="100%" cellspacing="0" cellpadding="0" class="tbreport">

							<?php
							//echo "SELECT * FROM  s_service_report4 WHERE sr_id = '".$row_fr['sv.sr_id']."'";
							$qu_pfirsttotal = @mysqli_query($conn, "SELECT * FROM  s_service_report4 WHERE sr_id = '" . $row_fr['sr_id'] . "'");

							?>



							<?php

							$totalOther = 0;

							$rowOtherTotal = @mysqli_fetch_array($qu_pfirsttotal);

							$totalOther = $rowOtherTotal['mn_1'] + $rowOtherTotal['mn_2'] + $rowOtherTotal['mn_3'] + $rowOtherTotal['mn_4'] + $rowOtherTotal['mn_5'];

							$totalsSumOther += $totalOther;

							$totalsAllSumOther += ($sum+$totalOther);

							?>

							<tr>

								<td style="border-bottom:none;"><strong>รวมค่าใช้จ่ายอื่น (ค่าน้ำมัน, ที่พัก, ทางด่วน)</strong></td>

								<td style="border-bottom:none;">&nbsp;</td>

								<td align="right" ; style="border-bottom:none;padding-right: 20px;"><strong><?php echo number_format($totalOther, 2); ?></strong></td>

							</tr>
							<tr>

								<td style="border-bottom:none;"><strong>ใช้จ่ายรวม (ค่าอะไหล่และอื่นๆ (จากช่างค่าน้ำมัน, ค่าทางด่วน, ที่พัก))</strong></td>

								<td style="border-bottom:none;">&nbsp;</td>

								<td align="right" ; style="border-bottom:none;padding-right: 20px;"><strong><?php echo number_format($sum+$totalOther, 2); ?></strong></td>

							</tr>

						</table>





					</td><?php  } ?>

				<?php if ($_REQUEST['sh7'] == 1) { ?><td style="padding:0;text-align: center;"><?php echo format_date($row_fr['sr_stime']); ?></td><?php  } ?>

				<?php if ($_REQUEST['sh8'] == 1) { ?><td style="padding:0;"><?php echo get_technician_name($conn, $row_fr['loc_contact']); ?></td><?php  } ?>

			</tr>

		<?php

			$sumre += 1;
		}

		?>

		<?php if ($_REQUEST['sh10'] == 1) { ?>
		<tr>

		<td colspan="7" style="text-align:right;"> <strong>ราคาต้นทุนอ่ะไหล่ทั้งหมด&nbsp;&nbsp;<?php echo number_format($totalsallUnit, 2); ?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

		</tr>
		<?php }?>

		<?php if ($_REQUEST['sh6'] == 1) { ?>

		<tr>

			<td colspan="7" style="text-align:right;"> <strong>ราคาขายอ่ะไหล่ทั้งหมด&nbsp;&nbsp;<?php echo number_format($totalsall, 2); ?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

		</tr>
		<?php }?>


		<tr>

			<td colspan="7" style="text-align:right;"> <strong>รวมค่าใช้จ่ายอื่น ทั้งสิ้น&nbsp;&nbsp;<?php echo number_format($totalsSumOther, 2); ?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

		</tr>

		<tr>

			<td colspan="7" style="text-align:right;"> <strong>รวมค่าใช้จ่ายรวม (ค่าอะไหล่และอื่นๆ) ทั้งสิ้น&nbsp;&nbsp;<?php echo number_format($totalsAllSumOther, 2); ?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

		</tr>

		<tr>

			<td colspan="7" style="text-align:right;"> <strong>จำนวน<?php if ($_POST['sr_stock'] == "s_service_report2") {
																		echo 'ใบเบิก';
																	} else {
																		echo "ใบยืม";
																	} ?>ทั้งหมด&nbsp;&nbsp;<?php echo $sumre; ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

		</tr>

		<tr>

			<td colspan="7" style="text-align:right;"> <strong>รวมอะไหล่ที่เบิก&nbsp;&nbsp;<?php echo $spartpart; ?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

		</tr>

	</table>



</body>

</html>