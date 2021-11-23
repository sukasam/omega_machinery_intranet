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

<link rel="stylesheet" href="../Carlender/calendar.css">



<script>

function confirmDelete(delUrl,text) {

  if (confirm("Are you sure you want to delete\n"+text)) {

    document.location = delUrl;

  }

}

//----------------------------------------------------------

function check_select(frm){

		if (frm.choose_action.value==""){

			alert ('Choose an action');

			frm.choose_action.focus(); return false;

		}

}	



$( document ).ready(function() {

	

	$( "#group_spar_id18" ).blur(function() {

		var group_spar_id = $("#group_spar_id18").val();

		if(group_spar_id != ""){

			$.ajax({

				type: "GET",

				url: "call_return.php?action=chkProID&group_spar_id="+group_spar_id,

				success: function(data){

					//console.log(data);

					var obj = JSON.parse(data);



					if(obj.status === 'yes'){

						$("#group_spar_id18").val(obj.group_spar_id);

						$("#cpro_ecip18").val(obj.group_name);

						$("#cpro18").val(obj.group_id);

					}else{

						$("#cpro_ecip18").val('');

						$("#cpro18").val("");

					}



				}

			});

		}

	});

	

	$( "#cpro_ecip18" ).blur(function() {

		var cpro_ecip = $("#cpro_ecip18").val();

		if(cpro_ecip != ""){

			$.ajax({

				type: "GET",

				url: "call_return.php?action=chkProName&cpro_ecip="+cpro_ecip,

				success: function(data){

					//console.log(data);

					var obj = JSON.parse(data);



					if(obj.status === 'yes'){

						$("#group_spar_id18").val(obj.group_spar_id);

						$("#cpro_ecip18").val(obj.group_name);

						$("#cpro18").val(obj.group_id);

					}else{

						$("#group_spar_id18").val('');

						$("#cpro18").val("");

					}



				}

			});

		}

	});

	

	

});

	

</script>



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
        <strong>First Order<br>Report</strong></SPAN></A></LI>
  <LI><A class=shortcut-button href="../report2/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-section.png"><BR>
        <strong>Service<br>Report</strong></SPAN></A></LI>
  <LI><A class=shortcut-button href="../report3/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-module.png"><BR>
        <strong>Stock<br>Machine</strong></SPAN></A></LI>
<LI><A class=shortcut-button href="../report4/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-article.png"><BR>
        <strong>Sale<br>Report</strong></SPAN></A></LI>
<LI><A class=shortcut-button href="../report5/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-component.png"><BR>
        <strong>Quotation<br>Report</strong></SPAN></A></LI>
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


      <LI><A class=shortcut-button href="../report3/?mid=16&act=1"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>

      <strong>รายงานการรับ<br>สินค้าเข้าสต๊อค<br>

      </strong>

      </SPAN></A></LI>

      <LI><A class=shortcut-button href="../report3/?mid=16&act=2"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามใบเบิก<br>สต็อกสินค้า</strong>

      </SPAN></A></LI>

      <LI><A class=shortcut-button href="../report3/?mid=16&act=3"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>
      <strong>ตามใบจัดส่ง<br>สต็อกสินค้า</strong>

      </SPAN></A></LI>

      <LI><A class=shortcut-button href="../report3/?mid=16&act=4"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>รายงานการรับ<br>อะไหล่ช่างเข้าสต๊อค<br>

                    </strong>

                  </SPAN></A></LI>

  </UL>

  <DIV class="clear"></DIV>

</DIV><!-- End #tab1 -->





<?php  

if($_GET['act'] == 1){

  ?>

    <DIV class=content-box><!-- Start Content Box -->

            <DIV class=content-box-header align="right" style="padding-right:15px;">

            <H3 align="left">เลือกตามการรับสินค้าเข้าสต๊อค</H3>

            <DIV class=clear>
            
            </DIV></DIV><!-- End .content-box-header -->

            <DIV class=content-box-content>

            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->
              <form action="report1.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>

                        <td><table class="formFields" cellspacing="0" width="100%">

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

                            <td><input name="sh9" type="checkbox" id="sh9" value="1" checked>

                              วันที่รับเข้า

                              <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                              ผู้จำหน่าย / ส่งสินค้า

                              <input name="sh2" type="checkbox" id="sh2" value="1" checked>

                              ชื่ที่อยู่ /ผู้จำหน่าย / เบอร์โทร

                              <input name="sh3" type="checkbox" id="sh3" value="1" checked>

                              เลขที่บิล

                              <input name="sh4" type="checkbox" id="sh4" value="1" checked>

                              รหัสสินค้า<br>


                              <input name="sh5" type="checkbox" id="sh5" value="1" checked>

                                รายการสินค้า
                
                             <input name="sh6" type="checkbox" id="sh6" value="1" checked>
                
                                จำนวนสินค้า
                
                               <!-- <input name="sh7" type="checkbox" id="sh7" value="1" checked>

                              รวมราคาซื้ิอ -->

                              <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                              ผู้รับสินค้าเข้า
                              </td>

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


	if($_GET['act'] == 2){

	?>

		<DIV class=content-box><!-- Start Content Box -->

            <DIV class=content-box-header align="right" style="padding-right:15px;">

            <H3 align="left">เลือกตามใบเบิกสินค้า</H3>

            <DIV class=clear>

            </DIV></DIV><!-- End .content-box-header -->

            <DIV class=content-box-content>

            <DIV id=tab1 class="tab-content default-tab"><!-- This is the target div. id must match the href of this div's tab -->

              <form action="report2.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">

                <div class="formArea">

                  <fieldset>

                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td><table class="formFields" cellspacing="0" width="100%">
                         <tr >
                            <td nowrap class="name">เลือกรหัส | ชื่อสินค้า</td>
                            <td><select name="cpro" id="cpro_ecip">
                            	<option value="">กรุณาเลือก</option>
                              <?php 

                                  $qupro1 = @mysqli_query($conn,"SELECT * FROM group_stockmachine ORDER BY group_name ASC");

                                  while($row_qupro1 = @mysqli_fetch_array($qupro1)){
                                    ?>
                                      <option value="<?php  echo $row_qupro1['group_id'];?>"><?php  echo $row_qupro1['group_spar_id']." | ".$row_qupro1['group_name'];?></option>
                                    <?php 	
                                  }
                              ?>
                          </select> <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                          </tr>

                          <!-- <tr >

                            <td nowrap class="name">ประเภทบริการ</td>

                            <td><select name="sr_ctype" id="sr_ctype">

                              <option value="">กรุณาเลือก</option>

                              <?php  

                                    $qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");

                                    while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){

                                        ?>

                              <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>

                              <?php 

                                    }

                                ?>

                            </select></td>

                          </tr> -->

                          <tr >
                            <td nowrap class="name">ประเภทลูกค้า</td>
                            <td><select name="sr_ctype2" id="sr_ctype2">
                              <option value="">กรุณาเลือก</option>
                              <?php 

                                    $quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                    while($row_cgcus = @mysqli_fetch_array($quccustommer)){
                                      if(substr($row_cgcus['group_name'],0,2) !== "SR"){
                                          ?>
                                           <option value="<?php  echo $row_cgcus['group_id'];?>"><?php  echo $row_cgcus['group_name'];?></option>
                                          <?php 	
                                      }
									                  }

                                ?>

                            </select></td>
                          </tr>

                          <tr >
                            <td nowrap class="name">ประเภทสินค้า</td>
                            <td><select name="sr_ctype" id="sr_ctype">
                              <option value="">กรุณาเลือก</option>
                              <?php 

                                $quprotype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
                                while($row_protype = @mysqli_fetch_array($quprotype)){
                                ?>
                                  <option value="<?php  echo $row_protype['group_id'];?>"><?php  echo $row_protype['group_name'];?></option>
                                <?php 	
                                }

                                ?>

                            </select></td>
                          </tr>

                          <!-- <tr >

                            <td nowrap class="name">ชื่อลูกค้า</td>

                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">

                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                          </tr> -->

                          <tr>

                            <td nowrap class="name">ผู้เบิกสินค้า</td>

                            <td><select name="loc_contact" id="loc_contact">

                              <option value="">กรุณาเลือก</option>

                              <?php  

                                        $qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");

                                        while($row_custec = @mysqli_fetch_array($qu_custec)){

                                            ?>

                              <option value="<?php  echo $row_custec['group_id'];?>"><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>

                              <?php 

                                        }

                                    ?>

                            </select></td>

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

                            <td><input name="sh16" type="checkbox" id="sh16" value="1" checked>

                              เลขที่ใบเบิกสินค้า

                              <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                              ชื่อลูกค้า / บริษัท + เบอร์โทร

                              <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                              ชื่อร้าน / สถานที่ติดตั้ง

                              <input name="sh3" type="checkbox" id="sh13" value="1" checked>

                              รายละเอียดเพิ่มเติมใบเบิกสินค้า

                              <input name="sh4" type="checkbox" id="sh14" value="1" checked>

                              รายการสินค้า<br>

                              <input name="sh5" type="checkbox" id="sh15" value="1" checked>

                              จำนวน

                              <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                              S/N

                              <input name="sh6" type="checkbox" id="sh17" value="1" checked>

                              วันที่เบิก

                             <!-- <input name="sh7" type="checkbox" id="sh18" value="1" checked>

                               วันที่คืน -->

                              <input name="sh9" type="checkbox" id="sh29" value="1" checked>

                              ผู้เบิกสินค้า</td>

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
  
  if($_GET['act'] == 3){

    ?>
  
      <DIV class=content-box><!-- Start Content Box -->
  
              <DIV class=content-box-header align="right" style="padding-right:15px;">
  
              <H3 align="left">เลือกตามใบจัดส่งสินค้า</H3>
  
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
                              <td nowrap class="name">เลือกรหัส | ชื่อสินค้า</td>
                              <td><select name="cpro" id="cpro_ecip">
                                <option value="">กรุณาเลือก</option>
                                <?php 
  
                                    $qupro1 = @mysqli_query($conn,"SELECT * FROM group_stockmachine ORDER BY group_name ASC");
  
                                    while($row_qupro1 = @mysqli_fetch_array($qupro1)){
                                      ?>
                                        <option value="<?php  echo $row_qupro1['group_id'];?>"><?php  echo $row_qupro1['group_spar_id']." | ".$row_qupro1['group_name'];?></option>
                                      <?php 	
                                    }
                                ?>
                            </select> <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
                            </tr>
  
                            <!-- <tr >
  
                              <td nowrap class="name">ประเภทบริการ</td>
  
                              <td><select name="sr_ctype" id="sr_ctype">
  
                                <option value="">กรุณาเลือก</option>
  
                                <?php  
  
                                      $qu_cusftype = @mysqli_query($conn,"SELECT * FROM s_group_service ORDER BY group_name ASC");
  
                                      while($row_cusftype = @mysqli_fetch_array($qu_cusftype)){
  
                                          ?>
  
                                <option value="<?php  echo $row_cusftype['group_id'];?>" <?php  if($row_cusftype['group_id'] == $sr_ctype){echo 'selected';}?>><?php  echo $row_cusftype['group_name'];?></option>
  
                                <?php 
  
                                      }
  
                                  ?>
  
                              </select></td>
  
                            </tr> -->
  
                            <tr >
                              <td nowrap class="name">ประเภทลูกค้า</td>
                              <td><select name="sr_ctype2" id="sr_ctype2">
                                <option value="">กรุณาเลือก</option>
                                <?php 
  
                                      $quccustommer = @mysqli_query($conn,"SELECT * FROM s_group_custommer ORDER BY group_name ASC");
  
                                      while($row_cgcus = @mysqli_fetch_array($quccustommer)){
                                        if(substr($row_cgcus['group_name'],0,2) !== "SR"){
                                            ?>
                                             <option value="<?php  echo $row_cgcus['group_id'];?>"><?php  echo $row_cgcus['group_name'];?></option>
                                            <?php 	
                                        }
                                      }
  
                                  ?>
  
                              </select></td>
                            </tr>
  
                            <tr >
                              <td nowrap class="name">ประเภทสินค้า</td>
                              <td><select name="sr_ctype" id="sr_ctype">
                                <option value="">กรุณาเลือก</option>
                                <?php 
  
                                  $quprotype = @mysqli_query($conn,"SELECT * FROM s_group_product ORDER BY group_name ASC");
                                  while($row_protype = @mysqli_fetch_array($quprotype)){
                                  ?>
                                    <option value="<?php  echo $row_protype['group_id'];?>"><?php  echo $row_protype['group_name'];?></option>
                                  <?php 	
                                  }
  
                                  ?>
  
                              </select></td>
                            </tr>
  
                            <!-- <tr >
  
                              <td nowrap class="name">ชื่อลูกค้า</td>
  
                              <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">
  
                                <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
  
                            </tr> -->
  
                            <tr>
  
                              <td nowrap class="name">ผู้เบิกสินค้า</td>
  
                              <td><select name="loc_contact" id="loc_contact">
  
                                <option value="">กรุณาเลือก</option>
  
                                <?php  
  
                                          $qu_custec = @mysqli_query($conn,"SELECT * FROM s_group_sale ORDER BY group_name ASC");
  
                                          while($row_custec = @mysqli_fetch_array($qu_custec)){
  
                                              ?>
  
                                <option value="<?php  echo $row_custec['group_id'];?>"><?php  echo $row_custec['group_name']. " (Tel : ".$row_custec['group_tel'].")";?></option>
  
                                <?php 
  
                                          }
  
                                      ?>
  
                              </select></td>
  
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
  
                              <td><input name="sh16" type="checkbox" id="sh16" value="1" checked>
  
                                เลขที่ใบจัดส่งสินค้า
  
                                <input name="sh1" type="checkbox" id="sh1" value="1" checked>
  
                                ชื่อลูกค้า / บริษัท + เบอร์โทร
  
                                <input name="sh2" type="checkbox" id="sh12" value="1" checked>
  
                                ชื่อร้าน / สถานที่ติดตั้ง
  
                                <input name="sh3" type="checkbox" id="sh13" value="1" checked>
  
                                รายละเอียดเพิ่มเติมใบจัดส่งสินค้า
  
                                <input name="sh4" type="checkbox" id="sh14" value="1" checked>
  
                                รายการสินค้า<br>
  
                                <input name="sh5" type="checkbox" id="sh15" value="1" checked>
  
                                จำนวน

                                <input name="sh10" type="checkbox" id="sh15" value="1" checked>
  
                                จำนวนที่จัด
  
                                <input name="sh8" type="checkbox" id="sh8" value="1" checked>
  
                                S/N
  
                                <input name="sh6" type="checkbox" id="sh17" value="1" checked>
  
                                วันที่ส่งสินค้า
  
                                <!--<input name="sh7" type="checkbox" id="sh18" value="1" checked>
  
                                 วันที่คืน-->
  
                                <input name="sh9" type="checkbox" id="sh29" value="1" checked> 
  
                                ผู้เบิกสินค้า</td>
  
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

    if ($_GET['act'] == 4) {

      ?>

        <DIV class=content-box>
          <!-- Start Content Box -->

          <DIV class=content-box-header align="right" style="padding-right:15px;">

            <H3 align="left">เลือกตามการรับอะไหล่ช่างเข้าสต๊อค</H3>

            <DIV class=clear>

            </DIV>
          </DIV><!-- End .content-box-header -->

          <DIV class=content-box-content>

            <DIV id=tab1 class="tab-content default-tab">
              <!-- This is the target div. id must match the href of this div's tab -->
              <form action="report4.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">
                <div class="formArea">
                  <fieldset>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>

                        <td>
                          <table class="formFields" cellspacing="0" width="100%">

                          <tr>

                              <td nowrap class="name">กรุณาเลือก</td>

                              <td><span class="name">

                                  <input name="sub_option" type="radio" value="0" checked>

                                  อะไหล่แผนกช่าง&nbsp;

                                  <input name="sub_option" type="radio" value="1">

                                  ค่าใช้จ่าย / เงินสดย่อย</span></td>

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

                              <td width="90%"><input type="text" name="date_fm" readonly value="<?php echo date("d/m/Y"); ?>" class="inpfoder" />
                                <script language="JavaScript">
                                  new tcal({
                                    'formname': 'form1',
                                    'controlname': 'date_fm'
                                  });
                                </script>
                              </td>

                            </tr>

                            <tr>

                              <td width="10%" nowrap class="name">ถึงวันที่</td>

                              <td width="90%"><input type="text" name="date_to" readonly value="<?php echo date("d/m/Y"); ?>" class="inpfoder" />
                                <script language="JavaScript">
                                  new tcal({
                                    'formname': 'form1',
                                    'controlname': 'date_to'
                                  });
                                </script>
                              </td>

                            </tr>

                            <tr>

                              <td nowrap class="name">รายการแสดง</td>

                              <td><input name="sh9" type="checkbox" id="sh9" value="1" checked>

                                วันที่รับเข้า

                                <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                ผู้จำหน่าย / ส่งสินค้า

                                <input name="sh2" type="checkbox" id="sh2" value="1" checked>

                                ชื่ที่อยู่ /ผู้จำหน่าย / เบอร์โทร

                                <input name="sh3" type="checkbox" id="sh3" value="1" checked>

                                เลขที่บิล

                                <input name="sh4" type="checkbox" id="sh4" value="1" checked>

                                รหัสอะไหล่<br>


                                <input name="sh5" type="checkbox" id="sh5" value="1" checked>

                                รายการอะไหล่

                                <input name="sh6" type="checkbox" id="sh6" value="1" checked>

                                ราคาซื้อ

                                <input name="sh7" type="checkbox" id="sh7" value="1" checked>

                                รวมราคาซื้ิอ

                                <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                ผู้รับสินค้าเข้า
                              </td>

                            </tr>

                              <tr><td></td></tr>

                          </table>
                        </td>

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





</DIV><!-- End .content-box-content -->

</DIV><!-- End .content-box -->

<!-- End .content-box -->

<!-- End .content-box -->

<DIV class=clear></DIV><!-- Start Notifications -->

<!-- End Notifications -->



<?php  include("../footer.php");?>

</DIV><!-- End #main-content -->

</DIV>

</BODY>

</HTML>

