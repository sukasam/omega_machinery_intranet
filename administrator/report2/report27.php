<?php  
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	
	
	//$daterriod = " AND `job_open`  between '".$date_fm."' and '".$date_to."'"; 
	//$daterriod = " AND `job_close`  between '".$date_fm."' and '".$date_to."'"; 
		
	if($_REQUEST['priod'] == 0){
		
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."<br>ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}

	if ($_REQUEST['priod'] == 0) {

		$daterriod2 = " AND `job_close`  between '" . $date_fm . "' and '" . $date_to . "'";

		list($s_year, $s_month, $s_day) = explode("-", $date_fm);

		$datefm = $s_day . "/" . $s_month . "/" . $s_year;

		list($s_year, $s_month, $s_day) = explode("-", $date_to);

		$dateft = $s_day . "/" . $s_month . "/" . $s_year;
	  }

	  $sql1 = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id AND sv.st_setting = 1 " . $daterriod2 . " ORDER BY sv.job_close ASC";

	  $numclose = @mysqli_num_rows(@mysqli_query($conn, $sql1));



	  if ($_REQUEST['priod'] == 0) {

		$daterriod = " AND `job_open`  between '" . $date_fm . "' and '" . $date_to . "'";

		list($s_year, $s_month, $s_day) = explode("-", $date_fm);

		$datefm = $s_day . "/" . $s_month . "/" . $s_year;

		list($s_year, $s_month, $s_day) = explode("-", $date_to);

		$dateft = $s_day . "/" . $s_month . "/" . $s_year;
	  }

	  $sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id " . $daterriod . " AND sv.st_setting = 0 ORDER BY sv.job_open ASC";

	  $numopen = @mysqli_num_rows(@mysqli_query($conn, $sql));


	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานสรุป</title>
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
รายงานสรุป<br>
<?php  if($loc_contact){echo get_technician_name($conn,$loc_contact);}else{echo "ทั้งหมด";}?> <?php if($openclose == 2 || $openclose == 3){echo "(แยกตามที่".$txtopenclose."ใบงาน)";}else{echo "(แยกตามใบงานทั้งหมด)";}?><br />
</th>
	    <th colspan="2" style="text-align:right;font-size:14px;vertical-align:bottom;"><?php  echo $dateshow;?><br />
        <br />
        <br /></th>
      </tr>
      <tr>
	  	<td colspan="5">
		  <table width="100%" cellspacing="0" cellpadding="0" border="0" class="formFields tdmk">

                      <tr>

                        <th width="83%"><strong style="color:#FF0000;">รายการ</strong></th>

                        <th width="10%"><strong style="color:#FF0000;">จำนวน</strong></th>

                        <th width="7%">&nbsp;</th>

                      </tr>

                      <tr>

                        <td>ใบงานทั้งหมด</td>

                        <td><a><?php echo number_format($numopen + $numclose); ?></a></td>

                        <td><strong>ใบ</strong></td>

                      </tr>

                      <tr>

                        <td>ปิดใบงาน</td>

                        <td>

                          <a href="report2.php?date_fm=<?php echo $_REQUEST['date_fm']; ?>&date_to=<?php echo $_REQUEST['date_to']; ?>&priod=<?php echo $_REQUEST['priod']; ?>" target="_blank"><?php echo number_format($numclose); ?></a>

                        </td>

                        <td><strong>ใบ</strong></td>

                      </tr>

                      <tr>

                        <td>ใบงานค้าง</td>

                        <td><a href="report1.php?date_fm=<?php echo $_REQUEST['date_fm']; ?>&date_to=<?php echo $_REQUEST['date_to']; ?>&priod=<?php echo $_REQUEST['priod']; ?>" target="_blank"><?php echo number_format($numopen); ?></a></td>

                        <td><strong>ใบ</strong></td>

                      </tr>

                      <tr>

                        <td>มูลค่าการใช้</td>

                        <td><?php

                            if ($_REQUEST['priod'] == 0) {

                              $daterriod5 = " AND `job_close`  between '" . $date_fm . "' and '" . $date_to . "'";

                              list($s_year, $s_month, $s_day) = explode("-", $date_fm);

                              $datefm = $s_day . "/" . $s_month . "/" . $s_year;

                              list($s_year, $s_month, $s_day) = explode("-", $date_to);

                              $dateft = $s_day . "/" . $s_month . "/" . $s_year;
                            }

                            $sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id " . $daterriod5 . " AND (sv.cpro1 != '') ORDER BY fr.cd_name ASC";

                            $qu_fr = @mysqli_query($conn, $sql);

                            $sum = 0;

                            while ($row_fr = @mysqli_fetch_array($qu_fr)) {

                              $sum += ($row_fr['cprice1'] + $row_fr['cprice2'] + $row_fr['cprice3'] + $row_fr['cprice4'] + $row_fr['cprice5']);
                            }



                            ?>

                          <a href="report10.php?date_fm=<?php echo $_REQUEST['date_fm']; ?>&date_to=<?php echo $_REQUEST['date_to']; ?>&priod=<?php echo $_REQUEST['priod']; ?>" target="_blank"><?php echo number_format($sum); ?></a>

                          <?php

                          ?></td>

                        <td><strong>บาท</strong></td>

                      </tr>

                      <tr>

                        <td><strong style="color:#FF0000;">รายการ</strong></td>

                        <td><strong style="color:#FF0000;">จำนวน</strong></td>

                        <td>&nbsp;</td>

                      </tr>

                      <?php

                      $typecus = @mysqli_query($conn, "SELECT * FROM s_group_service ORDER BY group_name ASC");

                      while ($roeservice = mysqli_fetch_array($typecus)) {

                      ?>

                        <tr>

                          <td><?php echo $roeservice['group_name']; ?></td>

                          <td>

                            <?php

                            if ($_REQUEST['priod'] == 0) {

                              $daterriod4 = " AND `job_close`  between '" . $date_fm . "' and '" . $date_to . "'";

                              list($s_year, $s_month, $s_day) = explode("-", $date_fm);

                              $datefm = $s_day . "/" . $s_month . "/" . $s_year;

                              list($s_year, $s_month, $s_day) = explode("-", $date_to);

                              $dateft = $s_day . "/" . $s_month . "/" . $s_year;
                            }

                            $sql4 = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id  " . $daterriod4 . " and sv.sr_ctype = '" . $roeservice['group_id'] . "' ORDER BY fr.cd_name ASC";

                            $qu_fr4 = mysqli_num_rows(@mysqli_query($conn, $sql4));

                            ?>

                            <a href="report5.php?date_fm=<?php echo $_REQUEST['date_fm']; ?>&date_to=<?php echo $_REQUEST['date_to']; ?>&priod=<?php echo $_REQUEST['priod']; ?>&sr_ctype=<?php echo $roeservice['group_id']; ?>" target="_blank"><?php echo number_format($qu_fr4); ?></a>

                          </td>

                          <td><strong>ใบ</strong></td>

                        </tr>

                      <?php  } ?>

                    </table>
		  </td>
      </tr>

	  </table>
		  <br><br>
	<center><img src="../images/icons/icon-48-print.png" onClick="javascript:chkPrint();" style="cursor: pointer;"></center>
	<br><br>
</body>
</html>