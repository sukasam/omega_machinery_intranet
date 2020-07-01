<?php  

	include ("../../include/config.php");

	include ("../../include/connect.php");

	include ("../../include/function.php");

	include ("config.php");

	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");

	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}

	$param = get_param($a_param,$a_not_exists);

	

	$loc_contact = $_REQUEST['loc_contact']; // ช่าง


	$sr_ctype = $_REQUEST['sr_ctype'];

	$sr_ctype2 = $_REQUEST['sr_ctype2'];

	$dbfosv = $_REQUEST['dbfosv'];

	$sQR = $_REQUEST['sQR'];


	$a_sdate=explode("/",$_REQUEST['date_fm']);

	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	$a_sdate=explode("/",$_REQUEST['date_to']);

	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	

	$service_zone = $_REQUEST['service_zone'];

	

	//$daterriod = " AND `job_open`  between '".$date_fm."' and '".$date_to."'"; 

	//$daterriod = " AND `job_close`  between '".$date_fm."' and '".$date_to."'"; 

		

	if($_REQUEST['priod'] == 0){

		$daterriod = " AND `sr_stime`  between '".$date_fm."' and '".$date_to."'"; 

		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 

	}

	else{

		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 

	}

	
	$condition = "";

	if($service_zone != ""){

		$condition .= " AND fr.service_zone = '".$service_zone."'";

	}


	if($sr_ctype != ""){

		$condition .= " AND fr.service_type = '".$sr_ctype."'";

	}


	if($sr_ctype2 != ""){

		$condition .= " AND fr.ctype = '".$sr_ctype2."'";

	}


	if($loc_contact != ""){

		$condition .= " AND fr.technic_service = '".$loc_contact."'";

	}

	if($dbfosv == 1){
		$condition .= " AND fr.fs_id LIKE 'FO%'";
	}else if($dbfosv == 2){
		$condition .= " AND fr.fs_id LIKE 'SV%'";
	}else{
		$condition .= "";
	}


	$condition .= " AND fr.status_use != 1 AND fr.status_use != 2"; 

	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>เลือกตามโซน/ภาค/เขต ( <?php  if($service_zone){echo get_zone($conn,$service_zone);}else{echo "ทั้งหมด";}?> )</title>

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

	    <th colspan="5" style="text-align:left;font-size:12px;">บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />

รายงานลูกค้าแยกตามโซน/ภาค/เขต (<?php  if($service_zone){echo get_zone($conn,$service_zone);}else{echo "ทั้งหมด";}?>)<br />

ประเภทบริการ : ( <?php  if($sr_ctype){echo get_servicename($conn,$sr_ctype);}else{echo "ทั้งหมด";}?> )

</th>

	    <th colspan="6" style="text-align:right;font-size:11px;vertical-align:bottom;"><?php  echo $dateshow;?><br />

        <br />

        <br /></th>

      </tr>

      <tr>

	  	<?php  if($_REQUEST['sQR'] == 2){?><th width="%">QR Code</th><?php  }?>
        
        <?php  if($_REQUEST['sh1'] == 1){?><th width="%">หมายเลข</th><?php  }?>

        <?php  if($_REQUEST['sh1'] == 1){?><th width="10%">ชื่อลูกค้า / บริษัท </th><?php  }?>

        <?php  if($_REQUEST['sh2'] == 1){?><th width="10%">ชื่อร้าน / สถานที่ติดตั้ง</th><?php  }?>

        <?php  if($_REQUEST['sh3'] == 1){?><th width="10%">อำเภอ/จังหวัด</th><?php  }?>

        <?php  if($_REQUEST['sh4'] == 1){?><th width="10%">กลุ่มลูกค้า</th><?php  }?>

        <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><th width="26%"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbreport">

          <tr>

            <?php  if($_REQUEST['sh5'] == 1){?><th style="border:0;text-align:left;" >สินค้า</th><?php  }?>

            <?php  if($_REQUEST['sh6'] == 1){?><th style="border:0;text-align:left;padding-left:70px;;" >รุ่นเครื่อง/SN</th><?php  }?>

          </tr>

        </table></th><?php  }?>

		<?php  if($_REQUEST['sh9'] == 1){?><th width="10%"><div align="center">ประเภทลูกค้า</div></th><?php  }?>

        <?php  if($_REQUEST['sh7'] == 1){?><th width="10%"><div align="center">วันที่ติดตั้ง</div></th><?php  }?>

        <?php  if($_REQUEST['sh8'] == 1){?><th width="10%"><div align="center">ประเภทงานบริการ</div></th><?php  }?>

        <?php  if($_REQUEST['sh10'] == 1){?><th width="10%"><div align="center">รายชื่อช่าง</div></th><?php  }?>

      </tr>

	  <?php  

	   $sql = "SELECT fr.* FROM s_first_order as fr WHERE 1 ".$condition." ".$daterriod." ORDER BY fr.fo_id DESC";

	  	$qu_fr = @mysqli_query($conn,$sql);

		$sum = 0;

		$sums = 0;

		$sumMachin = 0;

		$checkCus = '';

		while($row_fr = @mysqli_fetch_array($qu_fr)){

			?>

			<tr>

			<?php if($_REQUEST['sQR'] == 2){?><td>
				<?php 
					if($row_fr['cpro1'] != "" && $row_fr['pro_sn1'] != ""){
						?>
						<img src="../../qrcode_gen/qrcode.php?val=<?php echo $row_fr['pro_sn1'];?>" width="80">
						<?php 
					}
					if($row_fr['cpro2'] != "" && $row_fr['pro_sn2'] != ""){
						?>
						<img src="../../qrcode_gen/qrcode.php?val=<?php echo $row_fr['pro_sn2'];?>" width="80">
						<?php 
					}
				?>
			<?php }?>
              
              <td><?php echo $row_fr['fs_id'];?></td>

              <?php  if($_REQUEST['sh1'] == 1){?><td><?php  

				echo $row_fr['cd_name'];?><br />

              <?php  echo $row_fr['cd_tel'];?></td><?php  }?>

              <?php  if($_REQUEST['sh2'] == 1){?><td><?php  echo $row_fr['loc_name']."<br />".$row_fr['loc_address'];?></td> <?php  }?>

              <?php  if($_REQUEST['sh3'] == 1){?><td><?php  echo amphur_name($conn,$row_fr['cd_amphur'])." / ".province_name($conn,$row_fr['cd_province']);?></td>  <?php  }?>

              <?php  if($_REQUEST['sh4'] == 1){?><td><?php echo get_groupcusname($conn,$row_fr['cg_type']);?></td> <?php  }?>

              <?php  if($_REQUEST['sh5'] == 1 || $_REQUEST['sh6'] == 1){?><td style="padding:0;">

              	<table width="92%" border="0" cellpadding="0" cellspacing="0" class="tbreport" style="margin-bottom:5px;">

                <?php  

					$getMachin = findWord(get_proname($conn,$row_fr['cpro1']),'เครื่อง');

					if($row_fr['cpro1'] != ""){

						?>

						<tr>

                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;" width="31%"><?php   

							//if($getMachin === 'yes'){

								$sumMachin += $row_fr['camount1'];

							//}

							echo  get_proname($conn,$row_fr['cpro1']);?></td><?php  }?>

                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;" width="33%"><?php  echo $row_fr['pro_pod1']." / ".$row_fr['pro_sn1'];?></td><?php  }?>

                        </tr>

						<?php 	

					}

				?>

                <?php  

					$getMachin = findWord(get_proname($conn,$row_fr['cpro2']),'เครื่อง');

					if($row_fr['cpro2'] != ""){

						?>

						<tr>

                          <?php  if($_REQUEST['sh5'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  

							//if($getMachin === 'yes'){

								$sumMachin += $row_fr['camount2'];

							//}

						  echo get_proname($conn,$row_fr['cpro2']);?></td><?php  }?>

                          <?php  if($_REQUEST['sh6'] == 1){?><td style="border:0;padding-bottom:0;padding-top:0;"><?php  echo $row_fr['pro_pod2']." / ".$row_fr['pro_sn2'];?></td><?php  }?>

                        </tr>

						<?php 	

					}

				?>

              </table></td><?php  }?>

			  <?php  if($_REQUEST['sh9'] == 1){?><td><div align="center"><?php  echo getcustom_type($conn,$row_fr['ctype']);?></div></td>   <?php  }?>

              <?php  if($_REQUEST['sh7'] == 1){?><td style="padding:0;"><div align="center"><?php echo format_date($row_fr['cs_setting']);?></div>

              	</td><?php  }?>

              <?php  if($_REQUEST['sh8'] == 1){?><td style="padding:0;"><div align="center"><?php echo get_servicename($conn,$row_fr['service_type']);?></div>

              	</td><?php  }?>


              <?php  if($_REQUEST['sh10'] == 1){?><td><?php  echo get_technician_name($conn,$row_fr['technic_service']); ?></td>  <?php  }?>    

            </tr>

			

			<?php 

			//$sum += ($row_fr['cprice1']+$row_fr['cprice2']+$row_fr['cprice3']+$row_fr['cprice4']+$row_fr['cprice5']);

			$sums += 1;

			

		}

		

	  ?>

      <tr>

			  <td colspan="11" align="right"><strong>รวมยอดจำนวนลูกค้าทั้งสิ้น</strong>&nbsp;&nbsp;&nbsp;<strong><?php  echo $sums;?>&nbsp;&nbsp;ราย</strong>&nbsp;&nbsp;&nbsp;&nbsp;<br />

			  <strong>รวมยอดจำนวนเครื่องทั้งสิ้น</strong>&nbsp;&nbsp;&nbsp;<strong><?php  echo $sumMachin;?>&nbsp;&nbsp;เครื่อง</strong>&nbsp;&nbsp;&nbsp;&nbsp;

			  </td>

	  </tr>

    </table>



</body>

</html>