<?php  

	include ("../../include/config.php");

	include ("../../include/connect.php");

	include ("../../include/function.php");

	include ("config.php");

	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");

	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}

	$param = get_param($a_param,$a_not_exists);

	

	$cpro = $_REQUEST['cpro'];
	$sr_ctype = $_REQUEST['sr_ctype'];		
	$ctype = $_REQUEST['ctype2'];
	$cd_name = $_REQUEST['cd_name'];
	$cd_id = $_REQUEST['cd_id'];
	$loc_contact = $_REQUEST['loc_contact'];
	// $opentake = $_REQUEST['opentake'];

	
	// 0 = รวม IT, SR, และ RO, 1 = IT, 2 = SR, 3 = RO
	$dataFroms = $_REQUEST['dataFroms'];

	

	$a_sdate=explode("/",$_REQUEST['date_fm']);

	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	$a_sdate=explode("/",$_REQUEST['date_to']);

	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	

	if($_REQUEST['priod'] == 0){

		$daterriod = " AND `sr_stime`  between '".$date_fm."' and '".$date_to."'"; 

		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 

	}

	else{

		$dateshow = "วันที่ดำเนินการ : ".format_date(date("Y-m-d")); 

	}

	

	$condition = "";



	if($cpro != ""){

		$condition = "AND (sv.sr_id = sv2.sr_id) AND (sv2.lists = '".$cpro."')";

	}

	

	// if($opentake == 0){

	// 	$condition .= " AND sv.st_setting = '".$opentake."'";

	// }else if($opentake == 1){

	// 	$condition .= " AND sv.st_setting = '".$opentake."'";

	// }else{

	// 	$condition .= " ";

	// }

	

	if($sr_ctype != ""){

		$condition .= " AND sv.sr_ctype = '".$sr_ctype."'";

	}

	

	if($ctype != ""){

		$condition .= " AND sv.sr_ctype2 = '".$ctype."'";

	}

	

	if($cd_name != ""){

		$condition .= " AND (fr.cd_name LIKE '%".$cd_name."%' OR fr.loc_name LIKE '%".$cd_name."%')";
		// $condition .= " AND (fr.fo_id = ".$cd_id.")";
		

	}

	if($loc_contact != ""){

		$condition .= " AND sv.loc_contact2 = '".$loc_contact."'";

	}

	if($dataFroms != ""){

		$coDataFrom = '';

		if($dataFroms == 1){
			$condition .= " AND sv.srid LIKE 'IT%'";
			$coDataFrom = "(IT)";
		}else if($dataFroms == 1){
			$condition .= " AND sv.srid LIKE 'SR%'";
			$coDataFrom = "(SR)";
		}else if($dataFroms == 3){
			$condition .= " AND sv.srid LIKE RO%'";
			$coDataFrom = "(RO)";
		}else{
			$condition .= " AND (sv.srid LIKE 'IT%' OR sv.srid LIKE 'SR%' OR sv.srid LIKE 'RO%')";
			$coDataFrom = "";
		}
	}

	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>เลือกตามใบเบิก</title>

<style type="text/css">

 .tbreport{

 	font-size:13px;

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

	    <th colspan="4" style="text-align:left;">บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />

เลือกตามการใช้อะไหล่<br />

ประเภทใบบริการ  : <?php if($ctype != ""){echo getcustom_type($conn,$ctype);}else{echo 'ทั้งหมด';}?> <?php  if($cpro != ""){echo "(".get_sparpart_id($conn,$cpro).' | '.get_sparpart_name($conn,$cpro).")";}?></th>

	    <th colspan="5" style="text-align:right;"><?php  echo $dateshow;?></th>

      </tr>

      <tr>

        <?php  if($_REQUEST['sh16'] == 1){?><th width="5%">เลขที่ใบเบิก</th><?php  }?>

        <?php  if($_REQUEST['sh1'] == 1){?><th width="16%">ชื่อลูกค้า / บริษัท + เบอร์โทร</th><?php  }?>

        <?php  if($_REQUEST['sh2'] == 1){?><th width="15%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>

        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">รายละเอียดการเปลี่ยน</th><?php  }?>

        <?php  if($_REQUEST['sh4'] == 1 || $_REQUEST['sh5'] == 1){?><th width="30%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

          <tr>

            <?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="50%"><strong>รายการอะไหล่</strong></td><?php  }?>

            <?php  if($_REQUEST['sh5'] == 1){?><td style="border-bottom:none;" width="25%"><strong>จำนวน</strong></td><?php  }?>

            <?php  if($_REQUEST['sh8'] == 1){?><td style="border-bottom:none;" width="25%"><strong>ราคาต้นทุน</strong></td><?php  }?>

          </tr>

        </table></th><?php  }?>

		<!-- <?php  if($_REQUEST['sh8'] == 1){?><th width="6%"><strong>รวมมูลค่า</strong></th><?php  }?> -->

        <?php  if($_REQUEST['sh6'] == 1){?><th width="6%"><strong>วันที่เบิก</strong></th><?php  }?>

        <?php  if($_REQUEST['sh7'] == 1){?><th width="6%"><strong>วันที่คืน</strong></th><?php  }?>

        <?php  if($_REQUEST['sh9'] == 1){?><th width="8%"><strong>ผุ้เบิก</strong></th><?php  }?>

      </tr>

      <?php  

	  	

		

		$dbservice = "s_service_report2";

		$dbservicesub = "s_service_report2sub";

	  

		$sql = "SELECT * FROM s_first_order as fr, ".$dbservice." as sv, ".$dbservicesub." as sv2 WHERE sv.cus_id = fr.fo_id AND sv.sr_id = sv2.sr_id ".$condition." ".$daterriod." GROUP by sv.sr_id ORDER BY sv.sr_id DESC";

	  	$qu_fr = @mysqli_query($conn,$sql);

		$sum = 0;

		$totals = 0;

		$sumTotalAll = 0;

		while($row_fr = @mysqli_fetch_array($qu_fr)){

			?>

			<tr>

              <?php  if($_REQUEST['sh16'] == 1){?><td style="text-wrap: nowrap;"><a href="../../upload/service_report_close/<?php echo $row_fr['srid'];?>.pdf" target="_blank"><?php  echo $row_fr['sv_id'];?></a> <?php echo $coDataFrom;?>
				<?php echo "<br>".$row_fr['srid'];?>
			</td><?php  }?>

              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  echo $row_fr['cd_name'];?><br />

              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>

              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['loc_name'];?><br />

              <?php  echo $row_fr['loc_address'];?></td><?php  }?>

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

					if($row['codes'] != "" || $row['lists'] != ""){


						if($cpro != ""){
							if($cpro === $row['lists']){
								

						$totalamount += $row['opens'];

						$priceUnit = get_sparpart_uniprice($conn,$row['lists']);
						$total = $priceUnit*$row['opens'];
						$totalTA +=	$total;
								?>

							<tr>
		
							  <?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="50%"><?php  echo get_sparpart_id($conn,$row['lists']).' | '.get_sparpart_name($conn,$row['lists']);?></td><?php  }?>
		
							  <?php  if($_REQUEST['sh5'] == 1){?><td align="center" style="border-bottom:none;" width="25%"><?php  echo $row['opens'];?></td><?php  }?>
		
							  <?php  if($_REQUEST['sh8'] == 1){?><td align="right" style="border-bottom:none;" width="25%"><?php  echo number_format($priceUnit,2);?></td><?php  }?>
		
							</tr>
		
						<?php  
							$sumTotalAll += $total;
							}
						}else{

						$totalamount += $row['opens'];

						$priceUnit = get_sparpart_uniprice($conn,$row['lists']);
						$priceUnit = get_sparpart_uniprice($conn,$row['lists']);
						$total = $priceUnit*$row['opens'];
						$totalTA +=	$total;
							?>

							<tr>
		
							  <?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="50%"><?php  echo get_sparpart_id($conn,$row['lists']).' | '.get_sparpart_name($conn,$row['lists']);?></td><?php  }?>
		
							  <?php  if($_REQUEST['sh5'] == 1){?><td align="center" style="border-bottom:none;" width="25%"><?php  echo $row['opens'];?></td><?php  }?>
		
							  <?php  if($_REQUEST['sh8'] == 1){?><td align="right" style="border-bottom:none;" width="25%"><?php  echo number_format($priceUnit,2);?></td><?php  }?>
		
							</tr>
		
						<?php  
							$sumTotalAll += $total;
						}

					}	

				}

					$totals += $totalamount


					?>
					<tr>
						
						<?php  if($_REQUEST['sh4'] == 1){?><td style="border-bottom:none;" width="50%"><strong>รวม (ราคาต้นทุน / ราคาอะไหล่)</strong></td><?php  }?>

						<?php  if($_REQUEST['sh5'] == 1){?><td align="center" style="border-bottom:none;" width="25%"></td><?php  }?>

						<?php  if($_REQUEST['sh8'] == 1){?><td align="right" style="border-bottom:none;" width="25%"><strong><?php echo number_format($totalTA,2);?></strong></td><?php  }?>

					</tr>
					<?php

				?>

                </table>


              </td><?php  }?>

			  <!-- <?php  if($_REQUEST['sh8'] == 1){?><td style="padding:0;"><?php  echo number_format($totalTA,2);?></td><?php  }?> -->

              <?php  if($_REQUEST['sh6'] == 1){?><td style="padding:0;"><?php  echo format_date($row_fr['job_open']);?></td><?php  }?>

              <?php  if($_REQUEST['sh7'] == 1){?><td style="padding:0;"><?php  echo format_date($row_fr['sr_stime']);?></td><?php  }?>

              <?php  if($_REQUEST['sh9'] == 1){?><td style="padding:0;"><?php  echo get_technician_name($conn,$row_fr['loc_contact']);?></td><?php  }?>

            </tr>

			<?php 

			$sum += 1;

		}

	  ?>

      <tr>

			  <td colspan="9" style="text-align:right;"> <strong>จำนวน<?php  if($_POST['sr_stock'] == "s_service_report2"){echo 'ใบเบิก';}else{echo "ใบเบิก";}?>ทั้งหมด&nbsp;&nbsp;<?php  echo $sum;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>

      <tr>

			  <td colspan="9" style="text-align:right;"> <strong>รวมอะไหล่ที่เบิก&nbsp;&nbsp;<?php  echo $totals;?>&nbsp;&nbsp;รายการ&nbsp;&nbsp;</strong></td>

	  </tr>

	  <tr>

			  <td colspan="9" style="text-align:right;"> <strong>คิดเป็นมูลค่ารวมทั้งสิ้น&nbsp;&nbsp;<?php  echo number_format($sumTotalAll,2);?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</strong></td>

	  </tr>

    </table>



</body>

</html>