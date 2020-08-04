<?php     
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST["page"] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	$a_sdate=explode("/",$_REQUEST['date_fm']);
	$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
	$a_sdate=explode("/",$_REQUEST['date_to']);
	$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];

	if($_REQUEST['priod'] == 0){
		//$daterriod = " AND `date_open` between '".$date_fm."' and '".$date_to."'"; 
		$dateshow = "เริ่มวันที่ : ".format_date($date_fm)."&nbsp;&nbsp;ถึงวันที่ : ".format_date($date_to); 
	}
	else{
		$dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานสรุป</title>
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
 @media print{
   .noprint{
       display:none;
   }
}
</style>
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
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
	    <th colspan="3" style="text-align:left;font-size:12px;"><p>บริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด<br />
	      รายงานสรุป</p></th>
	    <th colspan="2" style="text-align:right;font-size:11px;"><?php echo $dateshow;?></th>
      </tr>
      <tr>
        <td colspan="5">
			  <div id="TabbedPanels1" class="TabbedPanels">
			    <ul class="TabbedPanelsTabGroup noprint">
			      <li class="TabbedPanelsTab" tabindex="0"><strong>ชื่อร้าน/ชื่อบริษัท</strong></li>
			      <li class="TabbedPanelsTab" tabindex="0"><strong>กลุ่มลูกค้า</strong></li>
                  <li class="TabbedPanelsTab" tabindex="0"><strong>รุ่นเครื่องสินค้า</strong></li>
                  <li class="TabbedPanelsTab" tabindex="0"><strong>ตามประเภทลูกค้า</strong></li>
                  <li class="TabbedPanelsTab" tabindex="0"><strong>ตามชื่อผู้ขาย</strong></li>
		        </ul>
			    <div class="TabbedPanelsContentGroup">
			      <div class="TabbedPanelsContent">
			        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="formFields tdmk">
			          <tr>
			            <th width="83%"><strong style="color:#FF0000;">รายการ</strong></th>
			            <th width="10%"><strong style="color:#FF0000;">จำนวน</strong></th>
			            <th width="7%">&nbsp;</th>
		              </tr>
			          <tr>
			            <td><strong>ชื่อร้าน/ชื่อบริษัท</strong></td>
			            <td><?php  
							if($_REQUEST['priod'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $date_fm);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $date_to);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE 1 ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
			              <a href="report1.php?date_fm=<?php  echo $_REQUEST['date_fm'];?>&date_to=<?php  echo $_REQUEST['date_to'];?>&priod=<?php  echo $_REQUEST['priod'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
			            <td><strong>รายการ</strong></td>
		              </tr>
			          <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
						while($roecus = @mysqli_fetch_array($typecus)){
							?>
			          <?php 	
						}
					  ?>
			          <?php  
					  	$typepro = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
						while($roepro = @mysqli_fetch_array($typepro)){
							?>
			          <?php 	
						}
					  ?>
			          <?php  
					  	$typepod = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
						while($roepod = @mysqli_fetch_array($typepod)){
							?>
			          <?php 	
						}
					  ?>
			          <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($roetypecus = @mysqli_fetch_array($typecus)){
							if(substr($roetypecus['group_name'],0,2) != "SR"){
								?>
			          <?php 	
							}
						}
					  ?>
			          <?php  
					  	$typesale = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
						while($roesale = @mysqli_fetch_array($typesale)){
							?>
			          <?php 	
						}
					  ?>
		            </table>
			      </div>
			      <div class="TabbedPanelsContent">
			        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="formFields tdmk">
			          <tr>
			            <th width="83%"><strong style="color:#FF0000;">รายการ</strong></th>
			            <th width="10%"><strong style="color:#FF0000;">จำนวน</strong></th>
			            <th width="7%">&nbsp;</th>
		              </tr>
			          <tr>
			            <td><strong>กลุ่มลูกค้า</strong></td>
			            <td></td>
			            <td><strong>รายการ</strong></td>
		              </tr>
			          <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
						while($roecus = @mysqli_fetch_array($typecus)){
							?>
			          <tr>
			            <td>&nbsp;&nbsp;&nbsp;- <?php  echo $roecus['group_name'];?></td>
			            <td><?php  
									if($_REQUEST['priod'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $date_fm);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $date_to);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE fr.cg_type = '".$roecus['group_id']."' ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
			              <a href="report3.php?date_fm=<?php  echo $_REQUEST['date_fm'];?>&date_to=<?php  echo $_REQUEST['date_to'];?>&priod=<?php  echo $_REQUEST['priod'];?>&cg_type=<?php  echo $roecus['group_id'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
			            <td>รายการ</td>
		              </tr>
			          <?php 	
						}
					  ?>
			          <?php  
					  	$typepro = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
						while($roepro = @mysqli_fetch_array($typepro)){
							?>
			          <?php 	
						}
					  ?>
			          <?php  
					  	$typepod = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
						while($roepod = @mysqli_fetch_array($typepod)){
							?>
			          <?php 	
						}
					  ?>
			          <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($roetypecus = @mysqli_fetch_array($typecus)){
							if(substr($roetypecus['group_name'],0,2) != "SR"){
								?>
			          <?php 	
							}
						}
					  ?>
			          <?php  
					  	$typesale = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
						while($roesale = @mysqli_fetch_array($typesale)){
							?>
			          <?php 	
						}
					  ?>
		            </table>
			      </div> 
                  <div class="TabbedPanelsContent">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="formFields tdmk">
                      <tr>
                        <th width="83%"><strong style="color:#FF0000;">รายการ</strong></th>
                        <th width="10%"><strong style="color:#FF0000;">จำนวน</strong></th>
                        <th width="7%">&nbsp;</th>
                      </tr>
                      <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
						while($roecus = @mysqli_fetch_array($typecus)){
							?>
                      <?php 	
						}
					  ?>
                      <?php  
					  	$typepro = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
						while($roepro = @mysqli_fetch_array($typepro)){
							?>
                      <?php 	
						}
					  ?>
                      <tr>
                        <td><strong>รุ่นเครื่องสินค้า</strong></td>
                        <td>&nbsp;</td>
                        <td><strong>รายการ</strong></td>
                      </tr>
                      <?php  
					  	$typepod = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
						while($roepod = @mysqli_fetch_array($typepod)){
							?>
                      <tr>
                        <td>&nbsp;&nbsp;&nbsp;- <?php  echo $roepod['group_name'];?></td>
                        <td><?php  
									if($_REQUEST['priod'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $date_fm);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $date_to);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE (fr.pro_pod1 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod2 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod3 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod4 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod5 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod6 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod7 LIKE '%".$roepod['group_name']."%')  ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
                          <a href="report5.php?date_fm=<?php  echo $_REQUEST['date_fm'];?>&date_to=<?php  echo $_REQUEST['date_to'];?>&priod=<?php  echo $_REQUEST['priod'];?>&pro_pod=<?php  echo $roepod['group_name'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
                        <td>รายการ</td>
                      </tr>
                      <?php 	
						}
					  ?>
                      <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($roetypecus = @mysqli_fetch_array($typecus)){
							if(substr($roetypecus['group_name'],0,2) != "SR"){
								?>
                      <?php 	
							}
						}
					  ?>
                      <?php  
					  	$typesale = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
						while($roesale = @mysqli_fetch_array($typesale)){
							?>
                      <?php 	
						}
					  ?>
                    </table>
                  </div>
                  <div class="TabbedPanelsContent">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="formFields tdmk">
                      <tr>
                        <th width="83%"><strong style="color:#FF0000;">รายการ</strong></th>
                        <th width="10%"><strong style="color:#FF0000;">จำนวน</strong></th>
                        <th width="7%">&nbsp;</th>
                      </tr>
                      <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
						while($roecus = @mysqli_fetch_array($typecus)){
							?>
                      <?php 	
						}
					  ?>
                      <?php  
					  	$typepro = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
						while($roepro = @mysqli_fetch_array($typepro)){
							?>
                      <?php 	
						}
					  ?>
                      <?php  
					  	$typepod = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
						while($roepod = @mysqli_fetch_array($typepod)){
							?>
                      <?php 	
						}
					  ?>
                      <tr>
                        <td><strong>ตามประเภทลูกค้า</strong></td>
                        <td>&nbsp;</td>
                        <td><strong>รายการ</strong></td>
                      </tr>
                      <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($roetypecus = @mysqli_fetch_array($typecus)){
							if(substr($roetypecus['group_name'],0,2) != "SR"){
								?>
                      <tr>
                        <td>&nbsp;&nbsp;&nbsp;- <?php  echo $roetypecus['group_name'];?></td>
                        <td><?php  
									if($_REQUEST['priod'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $date_fm);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $date_to);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE fr.ctype = '".$roetypecus['group_id']."' ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
                          <a href="report6.php?date_fm=<?php  echo $_REQUEST['date_fm'];?>&date_to=<?php  echo $_REQUEST['date_to'];?>&priod=<?php  echo $_REQUEST['priod'];?>&ctype=<?php  echo $roetypecus['group_id'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
                        <td>รายการ</td>
                      </tr>
                      <?php 	
							}
						}
					  ?>
                      <?php  
					  	$typesale = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
						while($roesale = @mysqli_fetch_array($typesale)){
							?>
                      <?php 	
						}
					  ?>
                    </table>
                  </div>
                  <div class="TabbedPanelsContent">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" class="formFields tdmk">
                      <tr>
                        <th width="83%"><strong style="color:#FF0000;">รายการ</strong></th>
                        <th width="10%"><strong style="color:#FF0000;">จำนวน</strong></th>
                        <th width="7%">&nbsp;</th>
                      </tr>
                      <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
						while($roecus = @mysqli_fetch_array($typecus)){
							?>
                      <?php 	
						}
					  ?>
                      <?php  
					  	$typepro = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
						while($roepro = @mysqli_fetch_array($typepro)){
							?>
                      <?php 	
						}
					  ?>
                      <?php  
					  	$typepod = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
						while($roepod = @mysqli_fetch_array($typepod)){
							?>
                      <?php 	
						}
					  ?>
                      <?php  
					  	$typecus = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
						while($roetypecus = @mysqli_fetch_array($typecus)){
							if(substr($roetypecus['group_name'],0,2) != "SR"){
								?>
                      <?php 	
							}
						}
					  ?>
                      <tr>
                        <td><strong>ตามชื่อผู้ขาย</strong></td>
                        <td>&nbsp;</td>
                        <td><strong>รายการ</strong></td>
                      </tr>
                      <?php  
					  	$typesale = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
						while($roesale = @mysqli_fetch_array($typesale)){
							?>
                      <tr>
                        <td>&nbsp;&nbsp;&nbsp;- <?php  echo $roesale['group_name'];?></td>
                        <td><?php  
									if($_REQUEST['priod'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$date_fm."' and '".$date_to."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $date_fm);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $date_to);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE fr.cs_sell = '".$roesale['group_id']."' ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
                          <a href="report9.php?date_fm=<?php  echo $_REQUEST['date_fm'];?>&date_to=<?php  echo $_REQUEST['date_to'];?>&priod=<?php  echo $_REQUEST['priod'];?>&cs_sell=<?php  echo $roesale['group_id'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
                        <td>รายการ</td>
                      </tr>
                      <?php 	
						}
					  ?>
                    </table>
                  </div>
		        </div>
		      </div>
		</td>
      </tr>
    </table>

	<br><br>
	<center><img src="../images/icons/icon-48-print.png" onClick="javascript:chkPrint();" style="cursor: pointer;"></center>
	<br><br>

	<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html>