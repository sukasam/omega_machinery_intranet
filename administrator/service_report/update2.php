<?php
include("../../include/config.php");
include("../../include/connect.php");
include("../../include/function.php");
include("config.php");

if ($_POST["mode"] <> "") {
	$param = "";
	$a_not_exists = array();
	$param = get_param($a_param, $a_not_exists);

	$a_sdate = explode("/", $_POST['sr_stime']);
	$_POST['sr_stime'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

	$a_sdate = explode("/", $_POST['job_open']);
	$_POST['job_open'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

	$a_sdate = explode("/", $_POST['job_close']);
	$_POST['job_close'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

	$a_sdate = explode("/", $_POST['job_balance']);
	$_POST['job_balance'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

	if ($_POST['ot_dateto'] != "") {
		$a_sdate = explode("/", $_POST['ot_dateto']);
		$_POST['ot_dateto'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
	}

	if ($_POST['ot_datefm'] != "") {
		$a_sdate = explode("/", $_POST['ot_datefm']);
		$_POST['ot_datefm'] = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];
	}

	$_POST['cprice1'] = preg_replace("/,/", "", $_POST['cprice1']);
	$_POST['cprice2'] = preg_replace("/,/", "", $_POST['cprice2']);
	$_POST['cprice3'] = preg_replace("/,/", "", $_POST['cprice3']);
	$_POST['cprice4'] = preg_replace("/,/", "", $_POST['cprice4']);
	$_POST['cprice5'] = preg_replace("/,/", "", $_POST['cprice5']);

	if ($_POST["mode"] == "update") {

		if ($_POST['approve'] == "") {
			$_POST['approve'] = 0;
		}

		if ($_POST['supply'] == "") {
			$_POST['supply'] = 0;
		}

		if ($_POST['st_setting'] == "") {
			$_POST['st_setting'] = 0;
		}

		$_POST['detail_recom'] = nl2br($_POST['detail_recom']);
		$_POST['detail_recom2'] = nl2br($_POST['detail_recom2']);
		$_POST['detail_calpr'] = nl2br($_POST['detail_calpr']);

		$_POST['job_last'] = get_lastservice_f($conn, $_POST['cus_id'], $_POST['sv_id']);


		foreach ($_POST['ckl_list2'] as $value) {
			$ckllist .= $value . ',';
		}

		$_POST['ckl_list'] = substr($ckllist, 0, -1);

		$_POST['ckl_list'];


		foreach ($_POST['ckw_list2'] as $value) {
			$ckwlist .= $value . ',';
		}

		$_POST['ckw_list'] = substr($ckwlist, 0, -1);

		$_POST['ckw_list'];


		foreach ($_POST['ckf_list2'] as $value) {
			$checklist .= $value . ',';
		}

		$_POST['ckf_list'] = substr($checklist, 0, -1);

		$_POST['ckf_list'];


		include("../include/m_update.php");

		$id = $_REQUEST[$PK_field];

		if ($_REQUEST['taget'] == "service") {

			$chkHCustomerAP = checkHCustomerApplove($conn, $id);

			if ($chkHCustomerAP !== '' && $chkHCustomerAP != NULL) {

				$dateCsign = substr(checkHCustomerDate($conn,$id),11);
				$current_time = $dateCsign;
				$from_time = "19:00:00";
				$to_time = "08:00:00";
				
				if (TimeIsBetweenTwoTimes($current_time, $from_time, $to_time)):
					//echo 'OT Time';
					$conOT = ", `ot_time` = '".substr(checkHCustomerDate($conn,$id),11,5)."'";
				else:
					//echo 'Working Time'; ช่วงเวลางาน
					$conOT = "";
				endif;


				@mysqli_query($conn, "UPDATE `s_service_report` SET `latitude` = '" . $_SESSION["LATITUDE"] . "', `longitude` = '" . $_SESSION["LONGITUDE"] . "', `st_setting` = 1, `approve` = 1 ".$conOT." WHERE `sr_id` = " . $id . ";");

				@mysqli_query($conn, "UPDATE `s_first_order` SET `latitude` = '" . $_SESSION["LATITUDE"] . "', `longitude` = '" . $_SESSION["LONGITUDE"] . "' WHERE `fo_id` = " . $_POST['cus_id'] . ";");

			}
		}

		$checkSImg = '';
		$numImg = 1;

		for ($i = 0; $i < count($_FILES["fileSUpload"]["name"]); $i++) {

			if (trim($_FILES["fileSUpload"]["tmp_name"][$i]) != "") {

				@unlink("../../upload/service_images/" . $listSImg[$i]);

				$mname = "";
				$mname = gen_random_num(3);
				$filename = "";
				$name_data = explode(".", $_FILES['fileSUpload']['name'][$i]);
				$type = $name_data[1];
				$new_images = $numImg . date('YmdHis') . $mname . "." . $type;

				$images = $_FILES["fileSUpload"]["tmp_name"][$i];

				$checkSImg .= $new_images . ',';

				//copy($_FILES["fileSUpload"]["tmp_name"][$i],"../../upload/service_images/".$_FILES["fileSUpload"]["name"][$i]);
				$width = 400; //*** Fix Width & Heigh (Autu caculate) ***//
				$size = GetimageSize($images);
				$height = round($width * $size[1] / $size[0]);
				$images_orig = ImageCreateFromJPEG($images);
				$photoX = ImagesX($images_orig);
				$photoY = ImagesY($images_orig);
				$images_fin = ImageCreateTrueColor($width, $height);
				ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
				ImageJPEG($images_fin, "../../upload/service_images/" . $new_images);
				ImageDestroy($images_orig);
				ImageDestroy($images_fin);
			}

			$numImg++;
		}

		$service_image = substr($checkSImg, 0, -1);

		if ($service_image) {
			@mysqli_query($conn, "UPDATE `s_service_report` SET `service_image` = '" . $service_image . "' WHERE `sr_id` = " . $id . ";");
		}

		include_once("../mpdf54/mpdf.php");
		include_once("form_serviceclose.php");
		$mpdf = new mPDF('UTF-8');
		$mpdf->SetAutoFont();
		$mpdf->WriteHTML($form);
		$chaf = preg_replace("/\//", "-", $_POST['sv_id']);
		$mpdf->Output('../../upload/service_report_close/' . $chaf . '.pdf', 'F');

		if ($_REQUEST['taget'] == "service") {
			if ($_POST['chkSignature'] != "") {
				/*signature.php?mode=update&sr_id=<?php echo $_GET['sr_id'];?>&page=<?php echo $_GET['page'];?>&taget=service&cus_id=<?php echo $_GET['cus_id'];?>*/

				header("location:signature.php?mode=update&sr_id=" . $_POST['sr_id'] . "&taget=service&cus_id=" . $_POST['cus_id']);
			} else {
				header("location:service.php?cus_id=" . $_POST['cus_id']);
			}
		} else {
			header("location:index.php?" . $param);
		}
	}
}
if ($_GET['mode'] == "add") {
	Check_Permission($conn, $check_module, $_SESSION["login_id"], "add");
}
if ($_GET['mode'] == "update") {
	Check_Permission($conn, $check_module, $_SESSION["login_id"], "update");
	$sql = "select * from $tbl_name where $PK_field = '" . $_GET[$PK_field] . "'";
	$query = @mysqli_query($conn, $sql);
	while ($rec = @mysqli_fetch_array($query)) {
		$$PK_field = $rec[$PK_field];
		foreach ($fieldlist as $key => $value) {
			$$value = $rec[$value];
		}
	}

	$a_sdate = explode("-", $sr_stime);
	$sr_stime = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

	$a_sdate = explode("-", $job_open);
	$job_open = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

	$a_sdate = explode("-", $job_close);
	$job_close = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

	$a_sdate = explode("-", $job_balance);
	$job_balance = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

	$finfo = get_firstorder($conn, $cus_id);

	$a_sdate = explode("-", $finfo['date_quf']);
	$sr_date_quf = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

	$a_sdate = explode("-", $finfo['date_qut']);
	$sr_date_qut = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];

	if ($ot_dateto != "") {
		$a_sdate = explode("-", $ot_dateto);
		$ot_dateto = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
	}

	if ($ot_datefm != "") {
		$a_sdate = explode("-", $ot_datefm);
		$ot_datefm = $a_sdate[2] . "/" . $a_sdate[1] . "/" . $a_sdate[0];
	}


	$ckl_list = explode(',', $ckl_list);
	$ckw_list = explode(',', $ckw_list);
	$ckf_list = explode(',', $ckf_list);
}


$v = date("YmdHis");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">

<HEAD>
	<TITLE><?php echo $s_title; ?></TITLE>
	<META content="text/html; charset=utf-8" http-equiv=Content-Type>
	<LINK rel=stylesheet type=text/css href="../css/reset.css?v=<?php echo $v; ?>" media=screen>
	<LINK rel=stylesheet type=text/css href="../css/style.css?v=<?php echo $v; ?>" media=screen>
	<LINK rel=stylesheet type=text/css href="../css/invalid.css?v=<?php echo $v; ?>" media=screen>
	<SCRIPT type=text/javascript src="../js/jquery-1.9.1.min.js?v=<?php echo $v; ?>"></SCRIPT>
	<!--
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js?v=<?php echo $v; ?>"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js?v=<?php echo $v; ?>"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js?v=<?php echo $v; ?>"></SCRIPT>
-->
	<SCRIPT type=text/javascript src="ajax.js?v=<?php echo $v; ?>"></SCRIPT>
	<META name=GENERATOR content="MSHTML 8.00.7600.16535">

	<script language="JavaScript" src="../Carlender/calendar_us.js?v=<?php echo $v; ?>"></script>
	<link rel="stylesheet" href="../Carlender/calendar.css?v=<?php echo $v; ?>">

	<script>
		function confirmDelete(delUrl, text) {
			if (confirm("Are you sure you want to delete\n" + text)) {
				document.location = delUrl;
			}
		}
		//----------------------------------------------------------
		function check(frm) {
			if (frm.group_name.value.length == 0) {
				alert('Please enter group name !!');
				frm.group_name.focus();
				return false;
			}
		}

		function CountChecks(whichlist, maxchecked, latestcheck, numsa) {

			var listone = new Array();

			for (var t = 1; t <= numsa; t++) {
				listone[t - 1] = 'checkbox' + t;
			}

			// End of customization.
			var iterationlist;
			eval("iterationlist=" + whichlist);
			var count = 0;
			for (var i = 0; i < iterationlist.length; i++) {
				if (document.getElementById(iterationlist[i]).checked == true) {
					count++;
				}
				if (count > maxchecked) {
					latestcheck.checked = false;
				}
			}
			if (count > maxchecked) {
				// alert('Sorry, only ' + maxchecked + ' may be checked.');
			}
		}

		function checkSignature() {
			console.log('checkSignature');
			document.getElementById("chkSignature").value = '1';
			setTimeout(function() {
				document.getElementById("form1").submit();
			}, 1000);
		}

		// $("#ot_dateto").change(function() {
		// 	alert("Handler for .change() called.");
		// });
		// $("#ot_datefm").change(function() {
		// 	alert("Handler for .change() called.");
		// });
	</script>
</HEAD>
<?php include("../../include/function_script.php"); ?>

<BODY>
	<DIV id=body-wrapper>
		<?php include("../left.php"); ?>
		<DIV id=main-content>
			<NOSCRIPT>
			</NOSCRIPT>
			<?php include('../top.php'); ?>
			<P id=page-intro><?php if ($mode == "add") { ?>Enter new information<?php  } else { ?>แก้ไข [<?php echo $page_name; ?>]<?php  } ?> </P>
			<UL class=shortcut-buttons-set>
				<LI><A class=shortcut-button href="javascript:history.back()"><SPAN><IMG alt=icon src="../images/btn_back.gif"><BR>
							กลับ</SPAN></A></LI>
			</UL>
			<!-- End .clear -->
			<DIV class=clear></DIV><!-- End .clear -->
			<DIV class=content-box>
				<!-- Start Content Box -->
				<DIV class=content-box-header align="right">

					<H3 align="left"><?php echo $check_module; ?></H3>
					<DIV class=clear>

					</DIV>
				</DIV><!-- End .content-box-header -->
				<DIV class=content-box-content>
					<DIV id=tab1 class="tab-content default-tab">
						<form action="update2.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
							<div class="formArea">
								<fieldset>
									<legend><?php echo $page_name; ?> </legend>
									<style>
										.bgheader {
											font-size: 12px;
											position: absolute;
											margin-top: 98px;
											padding-left: 586px;
										}

										table tr td {
											vertical-align: top;
											padding: 5px;
										}

										.tb1 {
											margin-top: 5px;
										}

										.tb1 tr td {
											border: 1px solid #000000;
											font-size: 12px;
											font-family: Verdana, Geneva, sans-serif;
											padding: 5px;
										}

										.tb2,
										.tb3 {
											border: 1px solid #000000;
											margin-top: 5px;
										}

										.tb2 tr td {
											font-size: 12px;
											font-family: Verdana, Geneva, sans-serif;
											padding: 5px;
										}

										.tb3 tr td {
											font-size: 12px;
											font-family: Verdana, Geneva, sans-serif;
											padding: 5px;
										}

										.tb3 img {
											vertical-align: bottom;
										}

										.ccontact {
											font-size: 12px;
											font-family: Verdana, Geneva, sans-serif;
										}

										.ccontact tr td {}

										.cdetail {
											border: 1px solid #000000;
											padding: 5px;
											font-size: 12px;
											font-family: Verdana, Geneva, sans-serif;
											margin-top: 5px;
										}

										.cdetail ul li {
											list-style: none;

										}

										.cdetail2 ul li {
											list-style: none;
											float: left;
										}

										.clear {
											margin: 0;
											padding: 0;
											clear: both;
										}

										.tblf5 {
											border: 1px solid #000000;
											font-size: 12px;
											font-family: Verdana, Geneva, sans-serif;
											margin-top: 5px;
										}

										p.tby1 {
											font-size: 12px;
											font-weight: bold;
											padding-top: 2px;
											padding-bottom: 2px;
										}
									</style>

									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td style="text-align:right;font-size:12px;">
												<div style="position:relative;text-align:center;">
													<img src="../images/form/header_service_report.png" width="100%" border="0" style="max-width:1182px;" />
												</div>
											</td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
										<tr>
											<td width="43%"><strong>ชื่อลูกค้า :</strong>
												<!-- <select name="cus_id" id="cus_id" onChange="checkfirstorder(this.value,'cusadd','cusprovince','custel','cusfax','contactid','datef','datet','cscont','cstel','sloc_name','sevlast','prolist');" style="width:300px;">
                	<option value="">กรุณาเลือก</option>
                	<?php
					$qu_cusf = @mysqli_query($conn, "SELECT * FROM s_first_order ORDER BY cd_name ASC");
					while ($row_cusf = @mysqli_fetch_array($qu_cusf)) {
					?>
							<option value="<?php echo $row_cusf['fo_id']; ?>" <?php if ($row_cusf['fo_id'] == $cus_id) {
																					echo 'selected';
																				} ?>><?php echo $row_cusf['cd_name'] . " (" . $row_cusf['loc_name'] . ")"; ?></option>
							<?php
						}
							?>
                </select>-->
												<?php echo get_customername($conn, $cus_id); ?>
												<input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>">
											</td>
											<td width="57%"><strong>ประเภทบริการลูกค้า :</strong>
												<select name="sr_ctype" id="sr_ctype">
													<!--<option value="">กรุณาเลือก</option>-->
													<?php
													$qu_cusftype = @mysqli_query($conn, "SELECT * FROM s_group_service ORDER BY group_name ASC");
													while ($row_cusftype = @mysqli_fetch_array($qu_cusftype)) {
													?>
														<option value="<?php echo $row_cusftype['group_id']; ?>" <?php if ($row_cusftype['group_id'] == $sr_ctype) {
																														echo 'selected';
																													} ?>><?php echo $row_cusftype['group_name']; ?></option>
													<?php
													}
													?>
												</select>
												<strong>ประเภทลูกค้า :</strong>
												<select name="sr_ctype2" id="sr_ctype2">
													<!--<option value="">กรุณาเลือก</option>-->
													<?php
													$qu_cusftype2 = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");
													while ($row_cusftype2 = @mysqli_fetch_array($qu_cusftype2)) {
													?>
														<option value="<?php echo $row_cusftype2['group_id']; ?>" <?php if ($row_cusftype2['group_id'] == $sr_ctype2) {
																														echo 'selected';
																													} ?>><?php echo $row_cusftype2['group_name']; ?></option>
													<?php
													}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td><strong>ที่อยู่ :</strong> <span id="cusadd"><?php echo $finfo['cd_address']; ?></span></td>
											<td><strong>เลขที่บริการ :</strong><input type="text" name="sv_id" value="<?php if ($sv_id == "") {
																															echo check_servicereport($conn);
																														} else {
																															echo $sv_id;
																														}; ?>" id="sv_id" class="inpfoder" style="border:0;">
												<!--<input type="text" name="sv_id" value="<?php if ($sv_id == "") {
																								echo "SR";
																							} else {
																								echo $sv_id;
																							}; ?>" id="sv_id" class="inpfoder" style="border:0;">-->&nbsp;&nbsp;<strong>เลขที่สัญญา :</strong><span id="contactid"><?php echo $finfo['fs_id']; ?></span><br><br>
												<strong>การรับประกัน:</strong> <?php if ($finfo['garun_id']) {
																					echo $finfo['garun_id'];
																				} else {
																					echo '0';
																				} ?> <strong>เดือน &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เริ่ม:</strong> <?php echo $sr_date_quf; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong> สิ้นสุด: </strong><?php echo $sr_date_qut; ?>
											</td>
										</tr>
										<tr>
											<td</td> </tr> <tr>
												<td><strong>โทรศัพท์ :</strong> <span id="custel"><?php echo $finfo['cd_tel']; ?></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> <span id="cusfax"><?php echo $finfo['cd_fax']; ?></span></td>
												<td><strong>วันที่ :</strong> <span id="datef"></span><input type="text" name="job_open" readonly value="<?php if ($job_open == "") {
																																								echo date("d/m/Y");
																																							} else {
																																								echo $job_open;
																																							} ?>" class="inpfoder" style="width: 70px;" />
													<script language="JavaScript">
														new tcal({
															'formname': 'form1',
															'controlname': 'job_open'
														});
													</script><strong> วันที่เข้าบริการ :</strong> <span id="datet"></span><input type="text" name="job_close" readonly value="<?php if ($job_close == "") {
																																													echo date("d/m/Y");
																																												} else {
																																													echo $job_close;
																																												} ?>" class="inpfoder" style="width: 70px;" />
													<script language="JavaScript">
														new tcal({
															'formname': 'form1',
															'controlname': 'job_close'
														});
													</script><input type="hidden" name="job_balance" value="<?php if ($job_balance == "") {
																												echo date("d/m/Y");
																											} else {
																												echo $job_balance;
																											} ?>" class="inpfoder" style="width: 70px;" />&nbsp;&nbsp;&nbsp;<strong>เวลา :</strong> <input type="time" name="job_closetime" value="<?php echo $job_closetime; ?>" class="inpfoder" style="width: 70px;text-align: center;" /><input type="hidden" name="job_opentime" value="<?php echo $job_opentime; ?>" class="inpfoder" style="width: 70px;text-align: center;" />
												</td>
										</tr>
										<tr>
											<td><strong>ชื่อผู้ติดต่อ :</strong> <span id="cscont"><?php echo $finfo['c_contact']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</strong> <span id="cstel"><?php echo $finfo['c_tel']; ?></span></td>
											<td><strong>บริการครั้งล่าสุด : </strong> <span id="sevlast"><?php echo get_lastservice_f($conn, $cus_id, $sv_id); ?></span> &nbsp;&nbsp;&nbsp;&nbsp;<strong>บริการครั้งต่อไป :</strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><input type="text" name="sr_stime" readonly value="<?php if ($sr_stime == "") {
																																																																																												echo date("d/m/Y");
																																																																																											} else {
																																																																																												echo $sr_stime;
																																																																																											} ?>" class="inpfoder" style="width: 70px;" />
													<script language="JavaScript">
														new tcal({
															'formname': 'form1',
															'controlname': 'sr_stime'
														});
													</script>
												</span></td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2">
										<tr>
											<td width="33%"><strong>สถานที่ติดตั้ง / ส่งสินค้า : </strong><span id="sloc_name"><?php echo $finfo['loc_name']; ?></span><br />
												<br>
												<strong>เลือกสินค้า :</strong>
												<span id="prolist">
													<?php
													$prolist = get_profirstorder($conn, $cus_id);
													//$lispp = explode(",",$prolist);
													$plid = "<select name=\"bbfpro\" id=\"bbfpro\" onchange=\"get_podsn(this.value,'lpa1','lpa2','lpa3','" . $cus_id . "','" . substr($finfo['fs_id'], 0, 2) . "')\">
													<option value=\"\">กรุณาเลือก</option>";

													if (substr($finfo['fs_id'], 0, 2) == "SV") {
														for ($i = 0; $i < count($prolist); $i++) {
															$plid .= "<option value=" . $i . ">" . get_proname2($conn, $prolist[$i]) . "</option>";
														}
													} else {
														for ($i = 0; $i < count($prolist); $i++) {
															$plid .= "<option value=" . $i . ">" . get_proname($conn, $prolist[$i]) . "</option>";
														}
													}

													echo $plid .=	 "</select>";
													?>
												</span>
												<br>
												<br />
												<strong>เครื่องล้างจาน / ยี่ห้อ : </strong><span style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;" id="lpa1">
													<input type="text" name="loc_pro" value="<?php echo $loc_pro; ?>" id="loc_pro" class="inpfoder" style="width:50%;">
												</span><br>
												<br />
												<strong>รุ่นเครื่อง : </strong><span id="lpa2"><input type="text" name="loc_seal" value="<?php echo $loc_seal; ?>" id="loc_seal" class="inpfoder" style="width:20%;"></span>&nbsp;&nbsp;&nbsp;<strong>S/N</strong>&nbsp;<span id="lpa3"><input type="text" name="loc_sn" value="<?php echo $loc_sn; ?>" id="loc_sn" class="inpfoder" style="width:20%;"></span><br /><br />
												<strong>เครื่องป้อนน้ำยา : </strong><input type="text" name="loc_clean" value="<?php echo $loc_clean; ?>" id="loc_clean" class="inpfoder" style="width:50%;"><br />
												<br>
												<strong>ช่างบริการประจำ :</strong>
												<select name="loc_contact" id="loc_contact">
													<option value="">กรุณาเลือก</option>
													<?php
													$qu_custec = @mysqli_query($conn, "SELECT * FROM s_group_technician ORDER BY group_name ASC");
													while ($row_custec = @mysqli_fetch_array($qu_custec)) {
													?>
														<option value="<?php echo $row_custec['group_id']; ?>" <?php if ($row_custec['group_id'] == $loc_contact) {
																													echo 'selected';
																												} ?>><?php echo $row_custec['group_name'] . " (Tel : " . $row_custec['group_tel'] . ")"; ?></option>
													<?php
													}
													?>
												</select></td>
											<td width="33%"><strong>ปริมาณน้ำยา</strong><br />
												<br />
												<strong>ปริมาณน้ำยาล้าง : </strong>
												<input type="text" name="cl_01" value="<?php echo $cl_01; ?>" id="cl_01" class="inpfoder" style="width:20%;">
												<strong>ml / rack</strong><br />
												<br />
												<strong>ปริมาณน้ำยาช่วยแห้ง : </strong>
												<input type="text" name="cl_02" value="<?php echo $cl_02; ?>" id="cl_02" class="inpfoder" style="width:20%;">
												<strong>ml / rack</strong><br />
												<br />
												<strong>ความเข้มข้น : </strong>
												<input type="text" name="cl_03" value="<?php echo $cl_03; ?>" id="cl_03" class="inpfoder" style="width:20%;">
												<strong>%</strong><br />
												<br />
												<strong>สต๊อกน้ำยา C =</strong>
												<input type="text" name="cl_04" value="<?php echo $cl_04; ?>" id="cl_04" class="inpfoder" style="width:5%;">
												<strong>ถัง R = </strong>
												<input type="text" name="cl_05" value="<?php echo $cl_05; ?>" id="cl_05" class="inpfoder" style="width:5%;">
												<strong>ถัง A =</strong>
												<input type="text" name="cl_06" value="<?php echo $cl_06; ?>" id="cl_06" class="inpfoder" style="width:5%;">
												<strong>ถัง</strong><br />
												<strong><br />
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;WG = </span></strong>
												<input type="text" name="cl_07" value="<?php echo $cl_07; ?>" id="cl_07" class="inpfoder" style="width:5%;">
												<strong> ถัง RG = </strong>
												<input type="text" name="cl_08" value="<?php echo $cl_08; ?>" id="cl_08" class="inpfoder" style="width:5%;">
												<strong> ถัง </strong></td>
											<td style="width: 25%;"><strong>ช่างเข้าบริการ</strong><br /><br />
												<?php
												$tecList = array("", $tec_service1, $tec_service2, $tec_service3);
												for ($i = 1; $i <= 3; $i++) {

												?>
													<?php echo $i; ?>. <select name="tec_service<?php echo $i; ?>" id="tec_service<?php echo $i; ?>">
														<option value="">กรุณาเลือก</option>
														<?php
														$qu_custec = @mysqli_query($conn, "SELECT * FROM s_group_technician ORDER BY group_name ASC");
														while ($row_custec = @mysqli_fetch_array($qu_custec)) {
														?>
															<option value="<?php echo $row_custec['group_id']; ?>" <?php if ($row_custec['group_id'] == $tecList[$i]) {
																														echo 'selected';
																													} ?>><?php echo $row_custec['group_name']; ?></option>
														<?php
														}
														?>
													</select><br><br>
												<?php
												}
												?>
												<strong>เบี้ยเลี้ยง วันที่ :</strong> <input type="text" name="ot_dateto" id="ot_dateto" value="<?php echo $ot_dateto; ?>" class="inpfoder" style="width: 70px;" />
												<script language="JavaScript">
													new tcal({
														'formname': 'form1',
														'controlname': 'ot_dateto'
													});
												</script>
												<strong> ถึง วันที่ :</strong> <input type="text" name="ot_datefm" id="ot_datefm" value="<?php echo $ot_datefm; ?>" class="inpfoder" style="width: 70px;" />
												<script language="JavaScript">
													new tcal({
														'formname': 'form1',
														'controlname': 'ot_datefm'
													});
												</script>
												<br><br>
												<strong>โอที :</strong> <input type="time" name="ot_time" value="<?php echo $ot_time; ?>" class="inpfoder" style="width: 70px;text-align: center;" />
												&nbsp;&nbsp;<strong>รวมจำนวน : <span id="rsOtday"><?php echo diffDate(date_format(date_create($ot_dateto), "Y-m-d"), date_format(date_create($ot_datefm), "Y-m-d")) ?></span> วัน</strong>
											</td>
										</tr>
									</table>
									<!--
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3">
  <tr>
    <td width="48%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><strong>รายการตรวจเช็ค</strong></td>
      </tr>
      <tr>
        <td width="50%"><strong>ระบบไฟฟ้า</strong></td>
        <td width="50%"><strong>ระบบประปา</strong></td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="1" id="checkbox" <?php if (@in_array('1', $ckl_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ตรวจเช็คชุดควบคุม</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="1" id="checkbox6" <?php if (@in_array('1', $ckw_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ตรวจเช็คน้ำรั่ว/ซึมภายนอก</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="2" id="checkbox2" <?php if (@in_array('2', $ckl_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ตรวจเช็ค/ขัน Terminal</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="2" id="checkbox7" <?php if (@in_array('2', $ckw_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ถอดล้างตะแกรงกรองเศษอาหาร</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="3" id="checkbox3" <?php if (@in_array('3', $ckl_list)) {
																					echo 'checked="checked"';
																				} ?>>
          วัดแรงดันไฟฟ้า และกระแสไฟฟ้า</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="3" id="checkbox8" <?php if (@in_array('3', $ckw_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ถอดล้างสแตนเนอร์ Solinoid Value</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="4" id="checkbox4" <?php if (@in_array('4', $ckl_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ตรวจเช็ค Heater</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="4" id="checkbox9" <?php if (@in_array('4', $ckw_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ถอดล้างแขนฉีด/หัวฉีดน้ำ</td>
      </tr>
      <tr>
        <td ><input type="checkbox" name="ckl_list2[]" value="5" id="checkbox5" <?php if (@in_array('5', $ckl_list)) {
																					echo 'checked="checked"';
																				} ?>>
          ตรวจเช็คมอเตอร์</td>
        <td ><input type="checkbox" name="ckw_list2[]" value="5" id="checkbox10" <?php if (@in_array('5', $ckw_list)) {
																						echo 'checked="checked"';
																					} ?>>
          ทำความสะอาดภายใน/ภายนอก</td>
      </tr>
    </table></td>
    <td width="22%" style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><strong>รายละเอียดการบริการและการแจ้งซ่อม</strong></td>
      </tr>
      <tr>
        <td><div class="setting" id="slapp">
          <div class="sc_wrap">
            <ul>
              <?php
				$qu_fix = @mysqli_query($conn, "SELECT * FROM s_group_fix ORDER BY group_name ASC");
				$numfix = @mysqli_num_rows($qu_fix);
				$nd = 1;
				while ($row_fix = @mysqli_fetch_array($qu_fix)) {
				?>
              <li>
                <input type="checkbox" name="ckf_list2[]" onClick="CountChecks('listone',5,this,<?php echo $numfix; ?>)" value="<?php echo $row_fix['group_id']; ?>" id="checkbox<?php echo $nd; ?>" <?php if (@in_array($row_fix['group_id'], $ckf_list)) {
																																																			echo 'checked="checked"';
																																																		} ?>>
                <label for="checkbox<?php echo $nd; ?>" style="font-weight:normal;"><?php echo $row_fix['group_name']; ?></label>
              </li>
              <?php
					$nd++;
				}
				?>
            </ul>
            <div class="clear"></div>
          </div>
        </div></td>
      </tr>
    </table></td>
     <td width="30%" style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td style="text-align:center;"><strong>รายละเอียดการให้บริการ / ข้อเสนอแนะ</strong></td>
       </tr>
       <tr>
         <td style="text-align:left;"><span style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
           <textarea name="detail_recom2" class="inpfoder" id="detail_recom2" style="width:50%;height:180px;"><?php echo strip_tags($detail_recom2); ?></textarea>
         </span></td>
       </tr>
     </table></td>
  </tr>
</table>
-->

									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb3 tblistChk">
										<tr>
											<td colspan="2">
												<p style="text-align: center;"><strong>รายการตรวจเช็ค</strong></p>
											</td>
										</tr>
										<tr>
											<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tblistChk">
													<tr>
														<td width="50%"><strong>ระบบไฟฟ้า</strong></td>
													</tr>
													<tr>
														<td style="vertical-align:top;"><input type="checkbox" name="ckl_list2[]" value="1" id="checkbox" <?php if (@in_array('1', $ckl_list)) {
																																								echo 'checked="checked"';
																																							} ?>>
															ตรวจเช็คชุดควบคุม</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckl_list2[]" value="2" id="checkbox2" <?php if (@in_array('2', $ckl_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ตรวจเช็ค/ขัน Terminal</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckl_list2[]" value="3" id="checkbox3" <?php if (@in_array('3', $ckl_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															วัดแรงดันไฟฟ้า และกระแสไฟฟ้า</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckl_list2[]" value="4" id="checkbox4" <?php if (@in_array('4', $ckl_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ตรวจเช็ค Heater</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckl_list2[]" value="5" id="checkbox5" <?php if (@in_array('5', $ckl_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ตรวจเช็คมอเตอร์</td>
													</tr>
												</table>
											</td>
											<td>
												<table>
													<tr>
														<td width="50%"><strong>ระบบประปา</strong></td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckw_list2[]" value="1" id="checkbox6" <?php if (@in_array('1', $ckw_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ตรวจเช็คน้ำรั่ว/ซึมภายนอก</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckw_list2[]" value="2" id="checkbox7" <?php if (@in_array('2', $ckw_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ถอดล้างตะแกรงกรองเศษอาหาร</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckw_list2[]" value="3" id="checkbox8" <?php if (@in_array('3', $ckw_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ถอดล้างสแตนเนอร์ Solinoid Value</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckw_list2[]" value="4" id="checkbox9" <?php if (@in_array('4', $ckw_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ถอดล้างแขนฉีด/หัวฉีดน้ำ</td>
													</tr>

													<tr>
														<td><input type="checkbox" name="ckw_list2[]" value="5" id="checkbox10" <?php if (@in_array('5', $ckw_list)) {
																																	echo 'checked="checked"';
																																} ?>>
															ทำความสะอาดภายใน/ภายนอก</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td width="50%" style="vertical-align:top;">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td><strong>รายละเอียดการบริการและการแจ้งซ่อม</strong></td>
													</tr>
													<tr>
														<td>
															<div class="setting" id="slapp" style="height: auto;">
																<div class="sc_wrap">

																	<?php
																	$qu_fix = @mysqli_query($conn, "SELECT * FROM s_group_fix ORDER BY group_name ASC");
																	$numfix = @mysqli_num_rows($qu_fix);
																	$nd = 1;
																	while ($row_fix = @mysqli_fetch_array($qu_fix)) {
																	?>
																		<div style="margin-bottom: 5px;">
																			<input type="checkbox" name="ckf_list2[]" value="<?php echo $row_fix['group_id']; ?>" id="checkbox<?php echo $nd; ?>" <?php if (@in_array($row_fix['group_id'], $ckf_list)) {
																																																		echo 'checked="checked"';
																																																	} ?>> <?php echo $row_fix['group_name']; ?>
																		</div>
																	<?php
																	}
																	?>

																	<!--
            <ul>
              <?php
				$qu_fix = @mysqli_query($conn, "SELECT * FROM s_group_fix ORDER BY group_name ASC");
				$numfix = @mysqli_num_rows($qu_fix);
				$nd = 1;
				while ($row_fix = @mysqli_fetch_array($qu_fix)) {
				?>
              <li class="mmlist">
                <input type="checkbox" name="ckf_list2[]" onClick="CountChecks('listone',5,this,<?php echo $numfix; ?>)" value="<?php echo $row_fix['group_id']; ?>" id="checkbox<?php echo $nd; ?>" <?php if (@in_array($row_fix['group_id'], $ckf_list)) {
																																																			echo 'checked="checked"';
																																																		} ?>>
              
               <input type="checkbox" name="ckf_list2[]" value="<?php echo $row_fix['group_id']; ?>" id="checkbox<?php echo $nd; ?>" <?php if (@in_array($row_fix['group_id'], $ckf_list)) {
																																			echo 'checked="checked"';
																																		} ?>>
               
                <label for="checkbox<?php echo $nd; ?>" style="font-weight:normal;"><?php echo $row_fix['group_name']; ?></label>
              </li>
              <?php
					$nd++;
				}
				?>
            </ul>
-->
																	<div class="clear"></div>
																</div>
															</div>
														</td>
													</tr>
												</table>
											</td>
											<td width="50%" style="vertical-align:top;">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td style="text-align:center;"><strong>รายละเอียดการให้บริการ / ข้อเสนอแนะ</strong></td>
													</tr>
													<tr>
														<td style="text-align:left;"><span style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
																<textarea name="detail_recom2" class="inpfoder" id="detail_recom2" style="width:50%;height:180px;"><?php echo strip_tags($detail_recom2); ?></textarea>
															</span></td>
													</tr>
													<?php
													//if($_GET['taget'] == 'service'){
													$srImg = getServiceImg($conn, $_GET['sr_id']);
													$sImg = explode(',', $srImg);
													$svImgArray = array();
													$svImgesArray = array();
													for ($v = 0; $v < count($sImg); $v++) {
														$svImgArray[] = substr($sImg[$v], 0, 1);
														$svImgesArray[] = $sImg[$v];
													}

													?>
													<tr>
														<td style="text-align:left;">
															<center><strong>รูปภาพเข้าให้บริการ</strong></center><br>
															<table>
																<tr>
																	<td colspan="2"><strong>ภาพก่อนบริการ</strong></td>
																</tr>
																<tr>
																	<td>1.</td>
																	<td><input type="file" name="fileSUpload[]"></td>
																	<td style="text-align: right;"><?php if (in_array('1', $svImgArray)) {
																										$key = array_search('1', $svImgArray);
																									?><a href="../../upload/service_images/<?php echo $svImgesArray[$key]; ?>" target="_blank"><img src="../images/icon2/mediamanager.png" width="25"></a><?php } ?></td>
																</tr>
																<tr>
																	<td>2.</td>
																	<td><input type="file" name="fileSUpload[]"></td>
																	<td style="text-align: right;"><?php if (in_array('2', $svImgArray)) {
																										$key = array_search('2', $svImgArray);
																									?><a href="../../upload/service_images/<?php echo $svImgesArray[$key]; ?>" target="_blank"><img src="../images/icon2/mediamanager.png" width="25"></a><?php } ?></td>
																</tr>
																<tr>
																	<td>3.</td>
																	<td><input type="file" name="fileSUpload[]"></td>
																	<td style="text-align: right;"><?php if (in_array('3', $svImgArray)) {
																										$key = array_search('3', $svImgArray);
																									?><a href="../../upload/service_images/<?php echo $svImgesArray[$key]; ?>" target="_blank"><img src="../images/icon2/mediamanager.png" width="25"></a><?php } ?></td>
																</tr>
																<tr>
																	<td colspan="2"><strong>ภาพหลังบริการ</strong></td>
																</tr>
																<tr>
																	<td>4.</td>
																	<td><input type="file" name="fileSUpload[]"></td>
																	<td style="text-align: right;"><?php if (in_array('4', $svImgArray)) {
																										$key = array_search('4', $svImgArray);
																									?><a href="../../upload/service_images/<?php echo $svImgesArray[$key]; ?>" target="_blank"><img src="../images/icon2/mediamanager.png" width="25"></a><?php } ?></td>
																</tr>
																<tr>
																	<td>5.</td>
																	<td><input type="file" name="fileSUpload[]"></td>
																	<td style="text-align: right;"><?php if (in_array('5', $svImgArray)) {
																										$key = array_search('5', $svImgArray);
																									?><a href="../../upload/service_images/<?php echo $svImgesArray[$key]; ?>" target="_blank"><img src="../images/icon2/mediamanager.png" width="25"></a><?php } ?></td>
																</tr>
																<tr>
																	<td>6.</td>
																	<td><input type="file" name="fileSUpload[]"></td>
																	<td style="text-align: right;"><?php if (in_array('6', $svImgArray)) {
																										$key = array_search('6', $svImgArray);
																									?><a href="../../upload/service_images/<?php echo $svImgesArray[$key]; ?>" target="_blank"><img src="../images/icon2/mediamanager.png" width="25"></a><?php } ?></td>
																</tr>
															</table>
														</td>
													</tr>
													<?php
													//}
													?>
												</table>
											</td>
										</tr>
									</table>

									<?php

									//$serviceID = substr($sv_id,3);
									$serviceID = $sv_id;
									//echo $serviceID;
									$row_service2 = @mysqli_fetch_array(@mysqli_query($conn, "SELECT * FROM s_service_report2 WHERE srid = '" . trim($serviceID) . "'"));

									?>
									<br>
									<p class="tby1"><strong>รายละเอียดการเปลี่ยนอะไหล่ / รายการใช้อุปกรณ์การติดตั้ง</strong> (เลขที่ใบเบิก <a href="../service_report2/update.php?mode=update&sr_id=<?php echo $row_service2['sr_id']; ?>&page=1&keyword=<?php echo $row_service2['sv_id']; ?>" target="_blank"><?php echo $row_service2['sv_id']; ?></a>)</p>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
										<tr>
											<td width="5%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
											<td width="65%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
											<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
											<td width="15%" style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / ต่อหน่วย</strong></td>
										</tr>

										<?php
										$qu_sr2 = @mysqli_query($conn, "SELECT * FROM s_service_report2sub WHERE sr_id = '" . $row_service2['sr_id'] . "' AND codes != ''");
										$brf = 1;
										while ($rowSRV = @mysqli_fetch_array($qu_sr2)) {
										?>

											<tr>
												<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php echo $brf; ?></td>
												<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:left;"><?php echo get_sparpart_name($conn, $rowSRV['lists']); ?></td>
												<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php if ($rowSRV['opens'] != 0) {
																																												echo $rowSRV['opens'];
																																											} ?></td>
												<td style="border:1px solid #000000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><?php if ($rowSRV['prices'] != 0) {
																																												echo number_format($rowSRV['prices']);
																																											} ?></td>
											</tr>

										<?php
											$brf++;
										}
										?>

									</table>
									<br>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
										<tr>
											<td width="33%" style="border:1px solid #000000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
															<strong><?php echo get_technician_name($conn, $loc_contact); ?></strong>
														</td>
													</tr>
													<tr>
														<td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ช่างบริการ</strong></td>
													</tr>
													<tr>
														<td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ <?php echo format_date_th(checkHCustomerDate($conn, $sr_id), 8); ?></strong></td>
													</tr>
												</table>
											</td>
											<td width="33%" style="border:1px solid #000000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
															<?php

															$chkHCustomerAP = checkHCustomerApplove($conn, $sr_id);

															//echo "sss".$chkHCustomerAP;

															$hCustomerSignature = '';

															if ($_GET['taget'] === "service") {

																if ($chkHCustomerAP !== '' && $chkHCustomerAP != NULL) {
																	echo $hCustomerSignature = '<img src="../../upload/customer/signature/' . $chkHCustomerAP . '" height="50" border="0" />';
																} else {
															?>
																	<!--						<input type="button" name="Cancel" value=" ลายเช็นผู้รับบริการ " class="button bt_cancel" onClick="window.location='signature.php?mode=update&sr_id=<?php echo $_GET['sr_id']; ?>&page=<?php echo $_GET['page']; ?>&taget=service&cus_id=<?php echo $_GET['cus_id']; ?>';" style="width: 100%;height: 40px;">-->

																	<input type="button" name="btSignature" value=" ลายเช็นผู้รับบริการ " class="button bt_cancel" onClick="checkSignature();" style="width: 100%;height: 40px;">

															<?php
																}
															} else {

																if ($chkHCustomerAP !== '' && $chkHCustomerAP != NULL) {
																	echo $hCustomerSignature = '<img src="../../upload/customer/signature/' . $chkHCustomerAP . '" height="50" border="0" />';
																} else {
																	echo $hCustomerSignature = '<img src="../../upload/customer/signature/none.png" height="50" border="0" />';
																}
															}
															?>
														</td>
													</tr>
													<tr>
														<td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้รับบริการ</strong></td>
													</tr>
													<tr>
														<td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ <?php echo format_date_th(checkHCustomerDate($conn, $sr_id), 8); ?></strong></td>
													</tr>
												</table>
											</td>
											<td width="33%" style="border:1px solid #000000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>นายไพโรจน์ เพ็ชรประสิทธิ์</strong></td>
													</tr>
													<tr>
														<td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้ตรวจสอบ</strong></td>
													</tr>
													<tr>
														<td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ <?php echo format_date_th(checkHCustomerDate($conn, $sr_id), 8); ?></strong></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ccontact">
										<tr>
											<td valign="bottom" style="text-align:left;">&nbsp;</td>
											<td valign="bottom" style="text-align:right;font-size:15px;"><strong>สายด่วน...งานบริการ 086-319-3766</strong></td>
										</tr>
									</table>
								</fieldset>
							</div><br>
							<div class="formArea">
								<div style="text-align: center;">
									<?php
									if ($_GET['taget'] === "service") {
										if ($chkHCustomerAP !== '' && $chkHCustomerAP != NULL) {
									?>
											<input type="submit" name="Submit" value=" บันทึก " class="button bt_save">
										<?php
										}
									} else {
										?>
										<input type="submit" name="Submit" value=" บันทึก " class="button bt_save">
									<?php
									}
									?>

									<input type="button" name="Cancel" value=" ยกเลิก " class="button bt_cancel" onClick="window.history.back()">
								</div>
								<?php
								$a_not_exists = array();
								post_param($a_param, $a_not_exists);
								?>
								<input name="mode" type="hidden" id="mode" value="<?php echo $_GET[mode]; ?>">
								<input name="detail_calpr" type="hidden" id="detail_calpr" value="<?php echo strip_tags($detail_calpr); ?>">
								<input name="detail_recom" type="hidden" id="detail_recom" value="<?php echo strip_tags($detail_recom); ?>">
								<input name="supply" type="hidden" id="supply" value="<?php echo $supply; ?>">
								<input name="st_setting" type="hidden" id="st_setting" value="<?php echo $st_setting; ?>">
								<input name="approve" type="hidden" id="approve" value="<?php echo $approve; ?>">
								<input name="taget" type="hidden" id="taget" value="<?php echo $_GET['taget']; ?>">
								<input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>" value="<?php echo $_GET[$PK_field]; ?>">
								<input name="chkSignature" type="hidden" id="chkSignature" value="">
								<input name="srid" type="hidden" id="mode" value="<?php echo $row_service2['sr_id']; ?>">
							</div>
						</form>
					</DIV>
				</DIV><!-- End .content-box-content -->
			</DIV><!-- End .content-box -->
			<!-- End .content-box -->
			<!-- End .content-box -->
			<DIV class=clear></DIV><!-- Start Notifications -->
			<!-- End Notifications -->

			<?php include("../footer.php"); ?>
		</DIV><!-- End #main-content -->
	</DIV>
	<?php if ($msg_user == 1) { ?>
		<script language=JavaScript>
			alert('Username ซ้ำ กรุณาเปลี่ยน Username ใหม่ !');
		</script>
	<?php  } ?>
</BODY>

</HTML>