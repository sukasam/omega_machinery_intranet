<?php 
	include ("../../include/config.php");
	include ("../../include/connect.php");
	include ("../../include/function.php");
	include ("config.php");
	Check_Permission($conn,$check_module,$_SESSION["login_id"],"read");
	if ($_GET["page"] == ""){$_REQUEST['page'] = 1;	}
	$param = get_param($a_param,$a_not_exists);
	
	if($_GET["action"] == "delete"){
		$code = Check_Permission($conn,$check_module,$_SESSION["login_id"],"delete");		
		if ($code == "1") {
			$sql = "delete from $tbl_name  where $PK_field = '".$_GET[$PK_field]."'";
			@mysqli_query($conn,$sql);			
			header ("location:index.php");
		} 
	}
	
	if($_GET["action"] == "chksum"){
		$_POST['date_fm'];
		$_POST['date_to'];
		
		$a_sdate=explode("/",$_REQUEST['date_fm']);
		$date_fm=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		$a_sdate=explode("/",$_REQUEST['date_to']);
		$date_to=$a_sdate[2]."-".$a_sdate[1]."-".$a_sdate[0];
		
		if($_POST['priod'] == 0){
			@header("Location:?mid=16&act=11&res=show&df=".$date_fm."&dt=".$date_to."&poi=".$_POST['priod']."");
		}else{
			@header("Location:?mid=16&act=11&res=show&poi=".$_POST['priod']."");
		}
		
		
		//
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE><?php  echo $s_title;?></TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<LINK rel=stylesheet type=text/css href="../css/reset.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/style.css" media=screen>
<LINK rel=stylesheet type=text/css href="../css/invalid.css" media=screen>
<SCRIPT type=text/javascript src="../js/jquery-1.3.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/simpla.jquery.configuration.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/facebox.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/jquery.wysiwyg.js"></SCRIPT>
<SCRIPT type=text/javascript src="../js/popup.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.7600.16535">

<script language="JavaScript" src="../Carlender/calendar_us.js"></script>
<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link rel="stylesheet" href="../Carlender/calendar.css">

<script>
function confirmDelete(delUrl,text) {
  if (confirm("Are you sure you want to delete\n"+text)) {
    document.location = delUrl;
  }
}
//----------------------------------------------------------
function check5(frm){
		if (frm.pro_pod.value.length==0){
			alert ('กรุณากรอกชื่อรุ่นเครื่อง !!');
			frm.pro_pod.focus(); return false;
		}		
}
function check8(frm){
		if (frm.cs_company.value.length==0){
			alert ('กรุณากรอกชื่อช่างติดตั้งเครื่อง !!');
			frm.cs_company.focus(); return false;
		}		
}
function check9(frm){
		if (frm.cs_sell.value.length==0){
			alert ('กรุณากรอกชื่อผู้ขาย !!');
			frm.cs_sell.focus(); return false;
		}		
}
</script>
<link href="../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</HEAD>
<?php  include ("../../include/function_script.php"); ?>
<BODY>
<DIV id=body-wrapper>
<?php  include("../left.php");?>
<DIV id=main-content>
<NOSCRIPT>
</NOSCRIPT>
<?php  include('../top.php');?>
<P id=page-intro><?php  echo $page_name; ?></P>

<UL class=shortcut-buttons-set>
  <LI><A class=shortcut-button href="../report/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
        <strong>First Order</strong></SPAN></A></LI>
  <LI><A class=shortcut-button href="../report2/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-section.png"><BR>
        <strong>Service Report</strong></SPAN></A></LI>
  <LI><A class=shortcut-button href="../report3/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
        <strong>Stock Machine</strong></SPAN></A></LI>
</UL>
  
  <!-- End .shortcut-buttons-set -->
<DIV class=clear></DIV><!-- End .clear -->
<DIV class=content-box><!-- Start Content Box -->
<DIV class=content-box-header align="right" style="padding-right:15px;">

<H3 align="left"><?php  echo $page_name; ?></H3>
<DIV class=clear>

</DIV></DIV><!-- End .content-box-header -->
<DIV class=content-box-content>
<DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
  <UL class=shortcut-buttons-set>
      <LI><A class=shortcut-button href="../report/?mid=16&act=1"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ชื่อร้าน/ชื่อบริษัท</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=2"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามจังหวัด</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=3"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>กลุ่มลูกค้า</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=4"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามสินค้า</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=5"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>รุ่นเครื่อง</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=6"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ประเภทลูกค้า</strong></SPAN></A></LI>
      <!--<LI><A class=shortcut-button href="../report/?mid=16&act=7"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามช่วงเวลา</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=8"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ช่างติดตั้งเครื่อง</strong></SPAN></A></LI>-->
      <LI><A class=shortcut-button href="../report/?mid=16&act=9"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามชื่่อผู้ขาย</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=10"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตารางคุมสัญญา</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=11"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>รายงานสรุป</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=12"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>เงินประกันลูกค้าเช่า</strong></SPAN></A></LI>
      <LI><A class=shortcut-button href="../report/?mid=16&act=14"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ติดตามสถานะงาน (FO/SV/PJ)</strong>
      </SPAN></A></LI>
  </UL>
  <div class="clear"></div>
</DIV><!-- End #tab1 -->


</DIV><!-- End .content-box-content -->
</DIV>

<?php  
	if($_GET['act'] == 1){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามชื่อร้าน-ชื่อบริษัท</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report1.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check1(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">ชื่อร้าน-ชื่อบริษัท</td>
                            <td width="90%"><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">สถานะ</td>
                            <td><span class="name">
                              <input name="use" type="radio" value="0" checked>
                              <img src="../icons/favorites_use.png" width="15" height="15">                              ใช้งาน
                              &nbsp;
                              <input name="use" type="radio" value="1">
                              <img src="../icons/favorites_stranby.png" width="15" height="15"> Stand by
                              <input name="use" type="radio" value="2">
                              <img src="../icons/favorites_close.png" width="15" height="15"> ยกเลิก</span>
                              <input name="use" type="radio" value="3">
                              <img src="../icons/favorites_service.png" width="15" height="15"> Service</span>
                              <!--<input name="use" type="radio" value="3"> ทั้งหมด</span>--></td>
                             </td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
<input name="sh2" type="checkbox" id="sh2" value="1" checked>
ชื่อร้าน / สถานที่ติดตั้ง
<input name="sh3" type="checkbox" id="sh3" value="1" checked>
                            จังหวัด
                            <input name="sh4" type="checkbox" id="sh4" value="1" checked>
                            ประเภทลูกค้า
                            <br>
                            <input name="sh5" type="checkbox" id="sh5" value="1" checked>
                            กลุ่มลูกค้า
<input name="sh6" type="checkbox" id="sh6" value="1" checked>
สินค้า 
<input name="sh7" type="checkbox" id="sh7" value="1" checked>
รุ่นเครื่อง/SN/
<input name="sh8" type="checkbox" id="sh8" value="1" checked>
ราคาขาย/ค่าเช่า

<input name="sh9" type="checkbox" id="sh9" value="1" checked>
วันที่ติดตั้ง
<input name="sh10" type="checkbox" id="sh10" value="1" checked>
ผู้ขาย</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 2){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามจังหวัด</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report2.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check2(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">จังหวัด</td>
                            <td width="90%">
                            <select name="cd_province" id="cd_province" class="inputselect">
							<?php 
                                $quprovince = @mysqli_query($conn,"SELECT * FROM s_province ORDER BY province_id ASC");
                                while($row_province = @@mysqli_fetch_array($quprovince)){
                                  ?>
                                    <option value="<?php  echo $row_province['province_id'];?>" <?php  if($cd_province == $row_province['province_id']){echo 'selected';}?>><?php  echo $row_province['province_name'];?></option>
                                  <?php 	
                                }
                            ?>
                        </select>
                            </td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh31" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
                              <input name="sh2" type="checkbox" id="sh32" value="1" checked>
                              ชื่อร้าน / สถานที่ติดตั้ง
                              <input name="sh4" type="checkbox" id="sh34" value="1" checked>
                              ประเภทลูกค้า <br>
                              <input name="sh5" type="checkbox" id="sh35" value="1" checked>
                              กลุ่มลูกค้า
                              <input name="sh6" type="checkbox" id="sh36" value="1" checked>
                              สินค้า
                              <input name="sh7" type="checkbox" id="sh37" value="1" checked>
                              รุ่นเครื่อง/SN/
                              <input name="sh8" type="checkbox" id="sh38" value="1" checked>
                              ราคาขาย/ค่าเช่า
                              <input name="sh9" type="checkbox" id="sh39" value="1" checked>
                              วันที่ติดตั้ง
                              <input name="sh10" type="checkbox" id="sh40" value="1" checked>
                            ผู้ขาย</td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 3){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามกลุ่มลูกค้า</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report3.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">กลุ่มลูกค้า</td>
                            <td width="90%">
                            <select name="cg_type" id="cg_type" class="inputselect">
								<?php 
                                    $qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
                                    while($row_cgtype = @@mysqli_fetch_array($qucgtype)){
                                      ?>
                                        <option value="<?php  echo $row_cgtype['group_id'];?>" <?php  if($cg_type == $row_cgtype['group_id']){echo 'selected';}?>><?php  echo $row_cgtype['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select>
                            </td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทลูกค้า</td>
                            <td><select name="ctype" id="ctype" class="inputselect">
                            	<option value="">เลือกประเภทลูกค้า</option>
                              <?php 
                                    $quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @@mysqli_fetch_array($quccustommer)){
                                     if(substr($row_cgcus['group_name'],0,2) != "SR"){
										?>
                              <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                              <?php 		 
									 }
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                            <td nowrap class="name">รุ่นเครื่อง</td>
                            <td><select name="pro_pod" id="pro_pod" class="inputselect" style="width:250px;">
                              <option value="">กรุณาเลือกรายการ</option>
                              <?php 
                                          $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
                                          while($row_qupros1 = @@mysqli_fetch_array($qupros1)){
                                            ?>
                              <option value="<?php  echo $row_qupros1['group_name'];?>"><?php  echo $row_qupros1['group_name'];?></option>
                              <?php 	
                                          }
                                      ?>
                            </select>
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh41" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
                              <input name="sh2" type="checkbox" id="sh42" value="1" checked>
                              ชื่อร้าน / สถานที่ติดตั้ง
                              <input name="sh3" type="checkbox" id="sh43" value="1" checked>
                              ประเภทลูกค้า <br>
                              <input name="sh4" type="checkbox" id="sh44" value="1" checked>
                              ประเภทสินค้า
                              <input name="sh5" type="checkbox" id="sh46" value="1" checked>
                              รุ่นเครื่อง/SN/
                              <input name="sh6" type="checkbox" id="sh47" value="1" checked>
                              ราคาขาย/ค่าเช่า
                              
                              <input name="sh7" type="checkbox" id="sh49" value="1" checked>
                            ผู้ขาย</td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 4){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามรายการสินค้า</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report4.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check4(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">รายการสินค้า</td>
                            <td width="90%">
                            <select name="cpro" id="cpro" class="inputselect" style="width:450px;">
                                  <?php 
                                      $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
                                      while($row_qupro1 = @@mysqli_fetch_array($qupro1)){
                                        ?>
                                          <option value="<?php  echo $row_qupro1['group_id'];?>" <?php  if($cpro1 == $row_qupro1['group_id']){echo 'selected';}?>><?php  echo $row_qupro1['group_name'];?></option>
                                        <?php 	
                                      }
                                  ?>
                              </select>
                            <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pro.php?protype=cpro');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh20" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
                              <input name="sh2" type="checkbox" id="sh21" value="1" checked>
                              ชื่อร้าน / สถานที่ติดตั้ง
                              <input name="sh4" type="checkbox" id="sh22" value="1" checked>
                              ประเภทลูกค้า <br>
                              <input name="sh5" type="checkbox" id="sh23" value="1" checked>
                              กลุ่มลูกค้า
                              <input name="sh6" type="checkbox" id="sh24" value="1" checked>
                              สินค้า
                              <input name="sh7" type="checkbox" id="sh25" value="1" checked>
                              รุ่นเครื่อง/SN/
                              <input name="sh8" type="checkbox" id="sh26" value="1" checked>
                              ราคาขาย/ค่าเช่า
                              <input name="sh9" type="checkbox" id="sh27" value="1" checked>
                              วันที่ติดตั้ง
                              <input name="sh10" type="checkbox" id="sh28" value="1" checked>
                            ผู้ขาย</td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 5){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามรุ่นเครื่อง</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report5.php" method="post" name="form1" id="form1" target="_blank">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">รุ่นเครื่อง</td>
                            <td width="90%"><select name="pro_pod" id="pro_pod" class="inputselect" style="width:250px;">
                                        <option value="">กรุณาเลือกรายการ</option>
                                      <?php 
                                          $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
                                          while($row_qupros1 = @@mysqli_fetch_array($qupros1)){
                                            ?>
                                              <option value="<?php  echo $row_qupros1['group_name'];?>"><?php  echo $row_qupros1['group_name'];?></option>
                                            <?php 	
                                          }
                                      ?>
                                  </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh29" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
                              <input name="sh2" type="checkbox" id="sh30" value="1" checked>
                              ชื่อร้าน / สถานที่ติดตั้ง
                              <input name="sh4" type="checkbox" id="sh33" value="1" checked>
                              ประเภทลูกค้า <br>
                              <input name="sh5" type="checkbox" id="sh45" value="1" checked>
                              กลุ่มลูกค้า
                              <input name="sh6" type="checkbox" id="sh48" value="1" checked>
                              สินค้า
                              <input name="sh7" type="checkbox" id="sh50" value="1" checked>
                              รุ่นเครื่อง/SN/
                              <input name="sh8" type="checkbox" id="sh51" value="1" checked>
                              ราคาขาย/ค่าเช่า
                              <input name="sh9" type="checkbox" id="sh52" value="1" checked>
                              วันที่ติดตั้ง</td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 6){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามประเภทลูกค้า</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report6.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check6(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
                            <td width="90%">
                            <select name="ctype" id="ctype" class="inputselect">
								<?php 
                                    $quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @@mysqli_fetch_array($quccustommer)){
                                     if(substr($row_cgcus['group_name'],0,2) != "SR"){
										?>
                                        <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                                       <?php 		 
									 }
                                    }
                                ?>
                            </select>
                           </td>
                          </tr>
                           <tr >
                            <td width="10%" nowrap class="name">รายการสินค้า</td>
                            <td width="90%">
                            <select name="cpro" id="cpro" class="inputselect" style="width:450px;">
                                  <option value="">กรุณาเลือกรายการ</option>
                                  <?php 
                                      $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
                                      while($row_qupro1 = @@mysqli_fetch_array($qupro1)){
                                        ?>
                                          <option value="<?php  echo $row_qupro1['group_id'];?>" <?php  if($cpro1 == $row_qupro1['group_id']){echo 'selected';}?>><?php  echo $row_qupro1['group_name'];?></option>
                                        <?php 	
                                      }
                                  ?>
                              </select>
                            <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pro.php?protype=cpro');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr >
                            <td width="10%" nowrap class="name">รุ่นเครื่อง</td>
                            <td width="90%"><select name="pro_pod" id="pro_pod" class="inputselect" style="width:250px;">
                                        <option value="">กรุณาเลือกรายการ</option>
                                      <?php 
                                          $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
                                          while($row_qupros1 = @@mysqli_fetch_array($qupros1)){
                                            ?>
                                              <option value="<?php  echo $row_qupros1['group_name'];?>"><?php  echo $row_qupros1['group_name'];?></option>
                                            <?php 	
                                          }
                                      ?>
                                  </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh54" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
                              <input name="sh2" type="checkbox" id="sh55" value="1" checked>
                              ชื่อร้าน / สถานที่ติดตั้ง
                              
                              <input name="sh3" type="checkbox" id="sh57" value="1" checked>
                              กลุ่มลูกค้า
<input name="sh5" type="checkbox" id="sh59" value="1" checked>
                              รุ่นเครื่อง/SN/<br>
                              <input name="sh6" type="checkbox" id="sh60" value="1" checked>
                              ราคาขาย/ค่าเช่า
                              <input name="sh7" type="checkbox" id="sh12" value="1" checked>
                              รายการของแถม
<input name="sh8" type="checkbox" id="sh61" value="1" checked>
                              วันที่ติดตั้ง 
                              <input name="sh4" type="checkbox" id="sh11" value="1" checked>
การรับประกัน
                              <input name="sh9" type="checkbox" id="sh13" value="1" checked>
                              ผู้ขาย</td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 7){
			?>
			<DIV class=content-box><!-- Start Content Box --><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 8){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามชื่อช่างติดตั้งเครื่อง</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report8.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">ชื่อช่างติดตั้งเครื่อง</td>
                            <td width="90%"><input name="cs_company" type="text" id="cs_company"  value="" size="100"></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                              ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                      </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
?>

<?php  
	if($_GET['act'] == 9){
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามชื่อผู้ขาย</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              	<form action="report9.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check9(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr >
                            <td width="10%" nowrap class="name">ชื่อผู้ขาย</td>
                            <td width="90%">
                            <select name="cs_sell" id="cs_sell" style="width:250px;">
							<?php 
                                $qusaletype = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
                                while($row_saletype = @@mysqli_fetch_array($qusaletype)){
                                  ?>
                                    <option value="<?php  echo $row_saletype['group_id'];?>"><?php  echo $row_saletype['group_name'];?></option>
                                  <?php 	
									}
								?>
							</select>
							</td>
                          </tr>
                          
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
                            <td width="90%">
                            <select name="ctype" id="ctype">
                            	<option value="">กรุณาเลือกรายการ</option>
								<?php 
                                    $quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @@mysqli_fetch_array($quccustommer)){
                                     if(substr($row_cgcus['group_name'],0,2) != "SR"){
										?>
                                        <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                                       <?php 		 
									 }
                                    }
                                ?>
                            </select>
                           </td>
                          </tr>
                          
                          <tr >
                            <td width="10%" nowrap class="name">ประเภทสินค้า</td>
                            <td width="90%">
                            <select name="pro_type" id="pro_type">
                            	<option value="">กรุณาเลือกรายการ</option>
								<?php 

									$quprotype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");

									while($row_protype = @mysqli_fetch_array($quprotype)){

									  ?>

										<option value="<?php  echo $row_protype['group_id'];?>" <?php  if($pro_type == $row_protype['group_id']){echo 'selected';}?>><?php  echo $row_protype['group_name'];?></option>

									  <?php 	

									}

								?>

							</select>
                           </td>
                          </tr>
                          
                          
<!--
                          <tr >
                            <td width="10%" nowrap class="name">รายการสินค้า</td>
                            <td width="90%">
                            <select name="cpro" id="cpro" class="inputselect" style="width:450px;">
                                  <option value="">กรุณาเลือกรายการ</option>
                                  <?php 
                                      $qupro1 = @mysqli_query($conn,"SELECT * FROM s_group_typeproduct ORDER BY group_name ASC");
                                      while($row_qupro1 = @@mysqli_fetch_array($qupro1)){
                                        ?>
                                          <option value="<?php  echo $row_qupro1['group_id'];?>" <?php  if($cpro1 == $row_qupro1['group_id']){echo 'selected';}?>><?php  echo $row_qupro1['group_name'];?></option>
                                        <?php 	
                                      }
                                  ?>
                              </select>
                            <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pro.php?protype=cpro');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
-->
                          <tr >
                            <td width="10%" nowrap class="name">รุ่นเครื่อง</td>
                            <td width="90%"><select name="pro_pod" id="pro_pod" class="inputselect" style="width:250px;">
                                        <option value="">กรุณาเลือกรายการ</option>
                                      <?php 
                                          $qupros1 = @mysqli_query($conn,"SELECT * FROM s_group_pod ORDER BY group_name ASC");
                                          while($row_qupros1 = @@mysqli_fetch_array($qupros1)){
                                            ?>
                                              <option value="<?php  echo $row_qupros1['group_name'];?>"><?php  echo $row_qupros1['group_name'];?></option>
                                            <?php 	
                                          }
                                      ?>
                                  </select><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=pro_pod');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh54" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
                              <input name="sh2" type="checkbox" id="sh55" value="1" checked>
                              ชื่อร้าน / สถานที่ติดตั้ง
                              
                              <input name="sh3" type="checkbox" id="sh57" value="1" checked>
                              กลุ่มลูกค้า
<input name="sh5" type="checkbox" id="sh59" value="1" checked>
                              รุ่นเครื่อง/SN/<br>
                              <input name="sh6" type="checkbox" id="sh60" value="1" checked>
                              ราคาขาย/ค่าเช่า
                              <input name="sh7" type="checkbox" id="sh12" value="1" checked>
                              รายการของแถม
<input name="sh8" type="checkbox" id="sh61" value="1" checked>
                              วันที่ติดตั้ง 
                              <input name="sh4" type="checkbox" id="sh11" value="1" checked>
การรับประกัน
                              <input name="sh9" type="checkbox" id="sh13" value="1" checked>
                              ผู้ขาย</td>
                          </tr>
                          
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
	
	if($_GET['act'] == 10){
			?>
            <script type="text/javascript">
            	function getopenlist(id){
					for(var i=1;i<=4;i++){
						document.getElementById('box'+i).style.display='none';	
					}
					document.getElementById('box'+id).style.display='';	
					//document.getElementById('boxlist'+id).style.display='';
				}
				function getopensublist(id){
					for(var i=1;i<=3;i++){
						document.getElementById('boxlist'+i).style.display='none';	
					}
					document.getElementById('boxlist'+id).style.display='';	
				}
            </script>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามตารางคุมสัญญา</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
             
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td>
                          <iframe id="form-iframe" src="control_contact.php"  style="margin:0; width:100%; height:700px; border:none; overflow:hidden;" scrolling="no" onload="AdjustIframeHeightOnLoad()"></iframe>                        </td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
	}
	
	if($_GET['act'] == 12){
		
			?>
			<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">เลือกตามเงินประกัน</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report12.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check1(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                        <tr>
                          	<td>รหัสลูกค้า</td>
                            <td><input name="cusid" type="text" id="cusid"  value="" style="width:40%;">
                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_id.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                          <tr >
                            <td width="10%" nowrap class="name">ชื่อร้าน-ชื่อบริษัท</td>
                            <td width="90%"><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>
                           <tr >
                            <td width="10%" nowrap class="name">กลุ่มลูกค้า</td>
                            <td width="90%">
                            <select name="cg_type" id="cg_type" class="inputselect">
                            <option value="">เลือกกลุ่มลูกค้า</option>
								<?php 
                                    $qucgtype = @mysqli_query($conn,"SELECT * FROM s_group_type ORDER BY group_name ASC");
                                    while($row_cgtype = @@mysqli_fetch_array($qucgtype)){
                                      ?>
                                        <option value="<?php  echo $row_cgtype['group_id'];?>" <?php  if($cg_type == $row_cgtype['group_id']){echo 'selected';}?>><?php  echo $row_cgtype['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select>
                            </td>
                          </tr>
                          <tr >
                            <td nowrap class="name">ประเภทลูกค้า</td>
                            <td><select name="ctype" id="ctype" class="inputselect">
                            	<option value="">เลือกประเภทลูกค้า</option>
                              <?php 
                                    $quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
                                    while($row_cgcus = @@mysqli_fetch_array($quccustommer)){
                                     if(substr($row_cgcus['group_name'],0,2) != "SR"){
										?>
                              <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>
                              <?php 		 
									 }
                                    }
                                ?>
                            </select></td>
                          </tr>
                          <tr >
                          
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td><span class="name">
                              <input name="priod" type="radio" value="0" checked>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1">
                            ไม่กำหนดช่วงเวลา</span></td>
                          </tr>
                          
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่</td>
                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>
                          </tr>
                          <tr>
                            <td width="10%" nowrap class="name">ถึงวันที่</td>
                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                          </tr>
                          <tr>
                            <td nowrap class="name">รายการแสดง</td>
                            <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>
                              ชื่อลูกค้า / บริษัท + เบอร์โทร
<input name="sh2" type="checkbox" id="sh2" value="1" checked>
ชื่อร้าน / สถานที่ติดตั้ง
<input name="sh3" type="checkbox" id="sh3" value="1" checked>
                            จังหวัด
                            <input name="sh4" type="checkbox" id="sh4" value="1" checked>
                            ประเภทลูกค้า
                            <br>
                            <input name="sh5" type="checkbox" id="sh5" value="1" checked>
                            กลุ่มลูกค้า
<input name="sh6" type="checkbox" id="sh6" value="1" checked>
สินค้า 
<input name="sh7" type="checkbox" id="sh7" value="1" checked>
รุ่นเครื่อง/SN/
<input name="sh8" type="checkbox" id="sh8" value="1" checked>
ราคาขาย/ค่าเช่า

<input name="sh9" type="checkbox" id="sh9" value="1" checked>
วันที่ติดตั้ง
<input name="sh10" type="checkbox" id="sh10" value="1" checked>
เงินประกัน</td>
                          </tr>
                          <tr>
                            <td nowrap class="name">&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                    </fieldset>
                </div><br>
                <div class="formArea">
                  <input type="submit" name="Submit" value="Submit" class="button">
                </div>
              </form>
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
			<?php 
		
	}

	if($_GET['act'] == 11){?>

		<DIV class=content-box><!-- Start Content Box -->
            <DIV class=content-box-header align="right" style="padding-right:15px;">
            
            <H3 align="left">รายงานสรุป</H3>
            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->
            <DIV class=content-box-content>
            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="?action=chksum" method="post" name="form1" id="form1">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                          <tr>
                            <td width="10%" nowrap class="name">เริ่มวันที่
                               <input type="text" name="date_fm" readonly value="<?php  if($_GET['df'] != ""){list ($s_year, $s_month, $s_day) = explode ("-", $_GET['df']);echo $s_day."/".$s_month."/".$s_year;}else{echo date("d/m/Y");}?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script>
                               &nbsp;&nbsp; ถึงวันที่ 
                              <input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>
                            <td width="90%"><span class="name">
                              <input name="priod" type="radio" value="0" <?php  if($_GET['poi']== 0){echo 'checked';}?>>
                              กำหนดช่วงเวลา&nbsp;
                              <input name="priod" type="radio" value="1" <?php  if($_GET['poi'] == 1){echo 'checked';}?>>
                              ไม่กำหนดช่วงเวลา </span>&nbsp;&nbsp;<input type="submit" name="Submit" value="Submit" class="button">
                            
                            </td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                  </fieldset>
                </div> <br>              
              </form>
              
              <?php  
			  	if($_GET['res'] == "show"){
					?>
			  <table width="100%" border="1" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td>
                        <div align="right"><?php 
                        	if($_GET['poi'] == 0){
								echo $dateshow = "เริ่มวันที่ : ".format_date($_GET['df'])."&nbsp;&nbsp;ถึงวันที่ : ".format_date($_GET['dt']); 
							}else{
								echo $dateshow = "วันที่ค้นหา : ".format_date(date("Y-m-d")); 	
							}
						?></div>
                        </td>
                      </tr>
                    </table>
			  <div id="TabbedPanels1" class="TabbedPanels">
			    <ul class="TabbedPanelsTabGroup">
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
							if($_GET['poi'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$_GET['df']."' and '".$_GET['dt']."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['df']);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['dt']);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE 1 ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
			              <a href="report1.php?date_fm=<?php  echo $datefm;?>&date_to=<?php  echo $dateft;?>&priod=<?php  echo $_GET['poi'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
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
									if($_GET['poi'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$_GET['df']."' and '".$_GET['dt']."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['df']);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['dt']);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE fr.cg_type = '".$roecus['group_id']."' ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
			              <a href="report3.php?date_fm=<?php  echo $datefm;?>&date_to=<?php  echo $dateft;?>&priod=<?php  echo $_GET['poi'];?>&cg_type=<?php  echo $roecus['group_id'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
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
									if($_GET['poi'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$_GET['df']."' and '".$_GET['dt']."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['df']);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['dt']);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE (fr.pro_pod1 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod2 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod3 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod4 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod5 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod6 LIKE '%".$roepod['group_name']."%' OR fr.pro_pod7 LIKE '%".$roepod['group_name']."%')  ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
                          <a href="report5.php?date_fm=<?php  echo $datefm;?>&date_to=<?php  echo $dateft;?>&priod=<?php  echo $_GET['poi'];?>&pro_pod=<?php  echo $roepod['group_name'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
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
									if($_GET['poi'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$_GET['df']."' and '".$_GET['dt']."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['df']);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['dt']);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE fr.ctype = '".$roetypecus['group_id']."' ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
                          <a href="report6.php?date_fm=<?php  echo $datefm;?>&date_to=<?php  echo $dateft;?>&priod=<?php  echo $_GET['poi'];?>&ctype=<?php  echo $roetypecus['group_id'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
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
									if($_GET['poi'] == 0){
										$daterriod4 = " AND `date_forder`  between '".$_GET['df']."' and '".$_GET['dt']."'"; 
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['df']);
										$datefm = $s_day."/".$s_month."/".$s_year;
										list ($s_year, $s_month, $s_day) = explode ("-", $_GET['dt']);
										$dateft = $s_day."/".$s_month."/".$s_year;
									}
									$sql1 = "SELECT * FROM s_first_order AS fr WHERE fr.cs_sell = '".$roesale['group_id']."' ".$daterriod4." ORDER BY fr.cd_name ASC";
	  						$qu_fr1 = @mysqli_num_rows(@mysqli_query($conn,$sql1));
								?>
                          <a href="report9.php?date_fm=<?php  echo $datefm;?>&date_to=<?php  echo $dateft;?>&priod=<?php  echo $_GET['poi'];?>&cs_sell=<?php  echo $roesale['group_id'];?>" target="_blank"><?php  echo number_format($qu_fr1);?></a></td>
                        <td>รายการ</td>
                      </tr>
                      <?php 	
						}
					  ?>
                    </table>
                  </div>
		        </div>
		      </div>
			  <?php 
				}
			  ?>
              
            </DIV><!-- End #tab1 -->
            
            
            </DIV><!-- End .content-box-content -->
            </DIV>
		<?php 

	}if($_GET['act'] == 14){

    ?>

    <DIV class=content-box><!-- Start Content Box -->

            <DIV class=content-box-header align="right" style="padding-right:15px;">

            

            <H3 align="left">ติดตามสถานะงาน (FO/SV/PJ)</H3>

            <DIV class=clear>

            

            </DIV></DIV><!-- End .content-box-header -->

            <DIV class=content-box-content>

            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->

              <form action="report14.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">

                <div class="formArea">

                  <fieldset>

                    <table width="100%" cellspacing="0" cellpadding="0" border="0">

                      <tr>

                        <td><table class="formFields" cellspacing="0" width="100%">

                        <tr >

                            <td nowrap class="name">โซน/ภาค/เขต</td>

                            <td><select name="service_zone" id="service_zone">

                              <option value="">กรุณาเลือกโซน/ภาค/เขต</option>

                              <?php  

                                    $qu_zone = @mysqli_query($conn,"SELECT * FROM s_group_zone ORDER BY group_name ASC");

                                    while($row_zone = @mysqli_fetch_array($qu_zone)){

                                        ?>

                              <option value="<?php  echo $row_zone['group_id'];?>"><?php  echo $row_zone['group_name'];?></option>

                              <?php 

                                    }

                                ?>

                            </select></td>

                          </tr>

                          <tr >

                            <td nowrap class="name">ประเภทบริการ</td>

                            <td><select name="sr_ctype" id="sr_ctype">

                              <option value="">กรุณาเลือก</option>

                              <?php  

                                    $qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");

                                    while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){

                                     // if($row_cusftype['group_id'] == 8 || $row_cusftype['group_id'] == 37 || $row_cusftype['group_id'] == 38 || $row_cusftype['group_id'] == 39 || $row_cusftype['group_id'] == 97 || $row_cusftype['group_id'] == 100){

                                        ?>

                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>

                              <?php 

                                      }

                                    //}

                                ?>

                            </select></td>

                          </tr>

                          <tr >

                            <td nowrap class="name">ประเภทลูกค้า</td>

                            <td><select name="sr_ctype2" id="sr_ctype2" class="" >

                              <option value="">กรุณาเลือก</option>

                              <?php 

                                    $quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                    while($row_cgcus = @mysqli_fetch_array($quccustommer)){

                                    //if(substr($row_cgcus['group_name'],0,2) != "SR"){

                                      ?>

                              <option value="<?php  echo $row_cgcus['group_id'];?>" <?php  if($ctype == $row_cgcus['group_id']){echo 'selected';}?>><?php  echo $row_cgcus['group_name'];?></option>

                              <?php 	

                                   // }

                  

                }

                                ?>

                            </select></td>

                          </tr>

                          <!-- <tr>

                            <td nowrap class="name">ตามรายชื่อช่าง</td>

                            <td><select name="loc_contact" id="loc_contact">

                              <option value="">กรุณาเลือก</option>

                                    <?php  

                                        $qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_technician ORDER BY group_name ASC");

                                        while($row_custec = @mysqli_fetch_array($qu_custec)){

                                            ?>

                                            <option value="<?php  echo $row_custec['group_id'];?>" <?php  if($row_custec['group_id'] == $loc_contact){echo 'selected';}?>><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>

                                            <?php 

                                        }

                                    ?>

                                </select></td>

                          </tr> -->
                          
                          <tr>

                            <td nowrap class="name">จากข้อมูล</td>

                            <td><span class="name">

                              <!-- <input name="dbfosv" type="radio" value="0" checked>

                              ทั้ง FO และ SV&nbsp; -->

                              <input name="dbfosv" type="radio" value="1" checked>

                              FO&nbsp;
                              
                              <input name="dbfosv" type="radio" value="2">

                              SV&nbsp;</span>

                              <input name="dbfosv" type="radio" value="3">

                              PJ&nbsp;</span></td>
                          </tr>

                          <tr>

                            <td nowrap class="name">&nbsp;</td>

                            <td><span class="name">

                              <input name="priod" type="radio" value="0" checked>

                              กำหนดช่วงเวลา&nbsp;

                              <input name="priod" type="radio" value="1">

                              ไม่กำหนดช่วงเวลา</span></td>

                          </tr>

                          <tr>

                            <td width="10%" nowrap class="name">เริ่มวันที่</td>

                            <td width="90%"><input type="text" name="date_fm" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_fm'});</script></td>

                          </tr>

                          <tr>

                            <td width="10%" nowrap class="name">ถึงวันที่</td>

                            <td width="90%"><input type="text" name="date_to" readonly value="<?php  echo date("d/m/Y");?>" class="inpfoder"/><script language="JavaScript">new tcal ({'formname': 'form1','controlname': 'date_to'});</script></td>

                          </tr>

                          <tr>

                            <td nowrap class="name">รายการแสดง</td>

                            <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                              ชื่อลูกค้า / บริษัท + เบอร์โทร

                              <input name="sh2" type="checkbox" id="sh46" value="1" checked>

                              ชื่อร้าน / สถานที่ติดตั้ง

                              <input name="sh3" type="checkbox" id="sh47" value="1" checked>

                              อำเภอ/จังหวัด

                              <input name="sh4" type="checkbox" id="sh48" value="1" checked>

                              กลุ่มลูกค้า

                              <br>

                              <!-- <input name="sh5" type="checkbox" id="sh49" value="1" checked>

                              สินค้า

                              <input name="sh6" type="checkbox" id="sh50" value="1" checked>

                รุ่นเครื่อง / SN -->

                <input name="sh7" type="checkbox" id="sh51" value="1" checked>

                วันที่ติดตั้ง

                <input name="sh8" type="checkbox" id="sh52" value="1" checked>

                              ประเภทงานบริการ

                              <input name="sh9" type="checkbox" id="sh53" value="1" checked>

                              ประเภทลูกค้า

                              <input name="sh9" type="checkbox" id="sh53" value="1" checked>

                              ประเภทลูกค้า

                              <!-- <input name="sh10" type="checkbox" id="sh54" value="1" checked>

                              รายชื่อช่าง -->

                              </td>

                          </tr>

                          <!-- <tr>

                            <td nowrap class="name">&nbsp;</td>

                            <td>&nbsp;</td>

                          </tr> -->

                        </table></td>

                      </tr>

                    </table>

                    </fieldset>

                </div><br>

                <div class="formArea">

                  <input type="submit" name="Submit" value="Submit" class="button">

                </div>

              </form>

            </DIV><!-- End #tab1 -->

            </DIV><!-- End .content-box-content -->

            </DIV>

    <?php 

  }
		  
?>


<!-- End .content-box -->
<!-- End .content-box -->
<!-- End .content-box -->
<DIV class=clear></DIV><!-- Start Notifications -->
<!-- End Notifications -->

<?php  include("../footer.php");?>
</DIV><!-- End #main-content -->
</DIV>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</BODY>
</HTML>
