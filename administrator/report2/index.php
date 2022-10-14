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



if ($_GET["action"] == "delete") {

  $code = Check_Permission($conn, $check_module, $_SESSION["login_id"], "delete");

  if ($code == "1") {

    $sql = "delete from $tbl_name  where $PK_field = '" . $_GET[$PK_field] . "'";

    @mysqli_query($conn, $sql);

    header("location:index.php");
  }
}

if ($_GET["action"] == "chksum") {

  $_POST['date_fm'];

  $_POST['date_to'];



  $a_sdate = explode("/", $_REQUEST['date_fm']);

  $date_fm = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];

  $a_sdate = explode("/", $_REQUEST['date_to']);

  $date_to = $a_sdate[2] . "-" . $a_sdate[1] . "-" . $a_sdate[0];



  if ($_POST['priod'] == 0) {

    @header("Location:?mid=16&act=11&res=show&df=" . $date_fm . "&dt=" . $date_to . "&poi=" . $_POST['priod'] . "");
  } else {

    @header("Location:?mid=16&act=11&res=show&poi=" . $_POST['priod'] . "");
  }





  //

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML xmlns="http://www.w3.org/1999/xhtml">

<HEAD>

  <TITLE><?php echo $s_title; ?></TITLE>

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
    function confirmDelete(delUrl, text) {

      if (confirm("Are you sure you want to delete\n" + text)) {

        document.location = delUrl;

      }

    }

    //----------------------------------------------------------

    function check_select(frm) {

      if (frm.choose_action.value == "") {

        alert('Choose an action');

        frm.choose_action.focus();
        return false;

      }

    }



    $(document).ready(function() {



      $("#group_spar_id18").blur(function() {

        var group_spar_id = $("#group_spar_id18").val();

        if (group_spar_id != "") {

          $.ajax({

            type: "GET",

            url: "call_return.php?action=chkProID&group_spar_id=" + group_spar_id,

            success: function(data) {

              //console.log(data);

              var obj = JSON.parse(data);



              if (obj.status === 'yes') {

                $("#group_spar_id18").val(obj.group_spar_id);

                $("#cpro_ecip18").val(obj.group_name);

                $("#cpro18").val(obj.group_id);

              } else {

                $("#cpro_ecip18").val('');

                $("#cpro18").val("");

              }



            }

          });

        }

      });



      $("#cpro_ecip18").blur(function() {

        var cpro_ecip = $("#cpro_ecip18").val();

        if (cpro_ecip != "") {

          $.ajax({

            type: "GET",

            url: "call_return.php?action=chkProName&cpro_ecip=" + cpro_ecip,

            success: function(data) {

              //console.log(data);

              var obj = JSON.parse(data);



              if (obj.status === 'yes') {

                $("#group_spar_id18").val(obj.group_spar_id);

                $("#cpro_ecip18").val(obj.group_name);

                $("#cpro18").val(obj.group_id);

              } else {

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

<?php include("../../include/function_script.php"); ?>

<BODY>

  <DIV id=body-wrapper>

    <?php include("../left.php"); ?>

    <DIV id=main-content>

      <NOSCRIPT>

      </NOSCRIPT>

      <?php include('../top.php'); ?>

      <P id=page-intro><?php echo $page_name; ?></P>



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

      <DIV class=content-box>
        <!-- Start Content Box -->

        <DIV class=content-box-header align="right" style="padding-right:15px;">



          <H3 align="left"><?php echo $page_name; ?></H3>

          <DIV class=clear>



          </DIV>
        </DIV><!-- End .content-box-header -->

        <DIV class=content-box-content>

          <DIV id=tab1 class="tab-content default-tab">
            <!-- This is the target div. id must match the href of this div's tab -->

            <UL class=shortcut-buttons-set>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=1"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ใบเปิดงาน<br>

                      <br></strong></SPAN></A></LI>

                     

              <LI><A class=shortcut-button href="../report2/?mid=16&act=2"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ใบปิดงาน<br>

                      <br></strong></SPAN></A></LI>

                <LI><A class=shortcut-button href="../report2/?mid=16&act=25"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

<strong>ใบปิดงาน<br>(ส่วนงานติดตั้ง)<br>
</strong></SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=3"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามกลุ่มลูกค้า</strong><br>

                    <br>

                  </SPAN></A></LI>

              <!--<LI><A class=shortcut-button href="../report2/?mid=16&act=4"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>

      <strong>ลูกค้าแต่ละกลุ่ม<br><br></strong></SPAN></A></LI>-->

              <LI><A class=shortcut-button href="../report2/?mid=16&act=5"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามรายการ<br>แจ้งซ่อม</strong></SPAN></A></LI>

              <LI><div style="position: relative;top: 0px;right: 5px;"><A class=shortcut-button href="../report2/?mid=16&act=6"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

<strong>ตามรายการ<br>ใช้อะไหล่</strong></SPAN></A><div style="    position: absolute;
    top: 5px;
    right: 5px;"><img src="../images/icons/keylock.png" style="width: 25px;"></div></div></LI>

              <!--<LI><A class=shortcut-button href="../report2/?mid=16&act=7"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>

      <strong>ตามอาการเสีย<br><br></strong></SPAN></A></LI>-->

              <!--<LI><A class=shortcut-button href="../report2/?mid=16"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>

      <strong>ใบเสนอราคา<br><br></strong></SPAN></A></LI>-->

              <LI><A class=shortcut-button href="../report2/?mid=16&act=8"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามชื่อช่าง<br>

                      <br>

                    </strong></SPAN></A></LI>

              <!--<LI><A class=shortcut-button href="../report2/?mid=16&act=9"><SPAN><IMG  alt=icon src="../images/icons/icon-48-category.png"><BR>

      <strong>ตามเขต<br>จังหวัด</strong></SPAN></A></LI>-->

              <LI><A class=shortcut-button href="../report2/?mid=16&act=10"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามมูลค่าการใช้ <br>

                    </strong><br>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=12"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตารางคุมสัญญา บริการ</strong><br>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=15"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามใบเบิก

                    </strong>

                    <br>

                    <br>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=13"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามใบยืม

                    </strong>

                    <br>

                    <br>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=16"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามใบคืน

                    </strong>

                    <br>

                    <br>

                  </SPAN></A></LI>

              <LI><div style="position: relative;top: 0px;right: 5px;"><A class=shortcut-button href="../report2/?mid=16&act=14"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตาม Installation<br></strong>

                    <br>

                  </SPAN></A>
                  <div style="position: absolute;
    top: 5px;
    right: 5px;"><img src="../images/icons/keylock.png" style="width: 25px;"></div>
                  </A></div>
                  </LI>


                  <LI><A class=shortcut-button href="../report2/?mid=16&act=11"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                  <strong>รายงานสรุป <br> </strong><br></SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=17"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>ตามโซน/ภาค/เขต (SR)

                    </strong><br>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=18"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>รายงานอะไหล่<br>

                    </strong><br>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=19"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>รายงานซ่อม<br>เครื่องเก่า<br>

                    </strong>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=20"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>รายงานการรับอะไหล่เข้าสต๊อค<br>

                    </strong>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=21"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>

                    <strong>รายงานการรับสินค้าเข้าสต๊อค<br>

                    </strong>

                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=22"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>
                    <strong>ตามโซน/ภาค/เขต (FO)</strong>
                  </SPAN></A></LI>

              <LI><A class=shortcut-button href="../report2/?mid=16&act=23"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>
                    <strong>ติดตามสถานะงาน (FO/SV/PJ)</strong>
                  </SPAN></A></LI>

                  <LI><A class=shortcut-button href="../report2/?mid=16&act=26"><SPAN><IMG alt=icon src="../images/icons/icon-48-category.png"><BR>
                    <strong>รายงานสรุป<br>ตามชื่อช่าง</strong>
                  </SPAN></A></LI>

                 

            </UL>

            <DIV class="clear"></DIV>

          </DIV><!-- End #tab1 -->





          <?php

          if ($_GET['act'] == 1) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามใบเปิดงาน</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report1.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check1(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td width="10%" nowrap class="name">ประเภทลูกค้า</td>

                                  <td width="90%">

                                    <select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select>

                                  </td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh2" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh3" value="1" checked>

                                    ประเภทลูกค้า

                                    <input name="sh4" type="checkbox" id="sh4" value="1" checked>

                                    ประเภทงานบริการ<br>

                                    <input name="sh5" type="checkbox" id="sh5" value="1" checked>

                                    เลขที่ใบงาน / วันที่เปิดใบงาน

                                    <input name="sh6" type="checkbox" id="sh6" value="1" checked>

                                    รุ่นเครื่อง/

                                    <input name="sh7" type="checkbox" id="sh7" value="1" checked>

                                    SN

                                    <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                    รายละเอียดการบริการ

                                    <input name="sh9" type="checkbox" id="sh9" value="1" checked>

                                    ชื่อช่าง</td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr>

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

          if ($_GET['act'] == 2) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามใบปิดงาน</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report2.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check2(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td width="10%" nowrap class="name">ประเภทลูกค้า</td>

                                  <td width="90%">

                                    <select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        //if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        //}
                                      }

                                      ?>

                                    </select>

                                  </td>

                                </tr>

                                <tr>

                                  <td>รหัสลูกค้า</td>

                                  <td><input name="cusid" type="text" id="cusid" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_id.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>
    
                                      <td nowrap class="name">การบริการ</td>
    
                                      <td><select name="wservice" id="wservice" class="inputselect">
                                          <option value="1">ทั้งหมด</option>
                                          <option value="2">เข้าบริการ</option>
                                          <option value="3">ไม่เข้าบริการ</option>
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

                                  <td><input name="sh1" type="checkbox" id="sh19" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh20" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh21" value="1" checked>

                                    ประเภทลูกค้า

                                    <input name="sh4" type="checkbox" id="sh22" value="1" checked>

                                    ประเภทงานบริการ<br>

                                    <input name="sh5" type="checkbox" id="sh23" value="1" checked>

                                    เลขที่ใบบริการ

                                    <input name="sh6" type="checkbox" id="sh24" value="1" checked>

                                    วันที่เปิด / วันที่ปิด

                                    <input name="sh7" type="checkbox" id="sh25" value="1" checked>

                                    รุ่นเครื่อง

                                    <input name="sh8" type="checkbox" id="sh10" value="1" checked>

                                    S/N

                                    <input name="sh9" type="checkbox" id="sh26" value="1" checked>

                                    รายละเอียดการบริการ

                                    <input name="sh10" type="checkbox" id="sh27" value="1" checked>

                                    ชื่อช่าง</td>

                                </tr>
                                <tr>
                                <td></td>
                                <td></td>
                                </tr>

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

          if ($_GET['act'] == 3) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามการให้บริการลูกค้าแต่ละกลุ่มแต่ล่ะประเภท</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report3.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td width="10%" nowrap class="name">ประเภทลูกค้า</td>

                                  <td width="90%">

                                    <select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh13" value="1" checked>

                                    เลขที่ใบบริการ

                                    <input name="sh4" type="checkbox" id="sh14" value="1" checked>

                                    วันที่ เปิด / ปิดใบบริการ<br>

                                    <input name="sh5" type="checkbox" id="sh15" value="1" checked>

                                    วันที่ให้บริการ

                                    <input name="sh6" type="checkbox" id="sh17" value="1" checked>

                                    รุ่นเครื่อง

                                    <input name="sh7" type="checkbox" id="sh18" value="1" checked>

                                    S/N

                                    <input name="sh8" type="checkbox" id="sh28" value="1" checked>

                                    รายละเอียดการบริการ

                                    <input name="sh9" type="checkbox" id="sh29" value="1" checked>

                                    ชื่อช่าง</td>

                                </tr>

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

          if ($_GET['act'] == 4) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามลูกค้าแต่ล่ะกลุ่ม</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report4.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check4(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td width="10%" nowrap class="name">ประเภทลูกค้า</td>

                                  <td width="90%">

                                    <select name="ctype" id="ctype" class="inputselect">

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select>

                                  </td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                  <td nowrap class="name">&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr>

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

          if ($_GET['act'] == 5) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามรายการแจ้งซ่อม หรือตามให้บริการต่างๆ</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report5.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check5(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td width="10%" nowrap class="name">ประเภทลูกค้า</td>

                                  <td width="90%">

                                    <select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select>

                                  </td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">รุ่นเครื่อง</td>

                                  <td><input name="loc_seal" type="text" id="loc_seal" value="" style="width:40%;"></td>

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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh16" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh30" value="1" checked>

                                    ประเภทลูกค้า



                                    <input name="sh4" type="checkbox" id="sh32" value="1" checked>

                                    เลขที่ใบบริการ

                                    <br>

                                    <input name="sh5" type="checkbox" id="sh33" value="1" checked>

                                    รายการแจ้งซ่อม

                                    <input name="sh6" type="checkbox" id="sh34" value="1" checked>

                                    รุ่นเครื่อง

                                    <input name="sh7" type="checkbox" id="sh35" value="1" checked>

                                    S/N

                                    <input name="sh8" type="checkbox" id="sh36" value="1" checked>

                                    รายละเอียดการบริการ

                                    <input name="sh9" type="checkbox" id="sh37" value="1" checked>

                                    ชื่อช่าง</td>

                                </tr>

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

          if ($_GET['act'] == 6) {

            $check_moduleSub = "ต้นทุนการใช้อะไหล่";
            $codeSub = Check_Permission($conn, $check_moduleSub, $_SESSION["login_id"], "read");

            if ($codeSub == "1") {
              ?>

              <DIV class=content-box>
                <!-- Start Content Box -->
  
                <DIV class=content-box-header align="right" style="padding-right:15px;">
  
  
  
                  <H3 align="left">เลือกตามการใช้อะไหล่ (ราคาต้นทุน)</H3>
  
                  <DIV class=clear>
  
  
  
                  </DIV>
                </DIV><!-- End .content-box-header -->
  
                <DIV class=content-box-content>
  
                  <DIV id=tab1 class="tab-content default-tab">
                    <!-- This is the target div. id must match the href of this div's tab -->
  
                    <form action="report6.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check6(this)">
  
                      <div class="formArea">
  
                        <fieldset>
  
                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
  
                            <tr>
  
                              <td>
                                <table class="formFields" cellspacing="0" width="100%">
  
                                  <tr>
  
                                    <td nowrap class="name">เลือกรหัส | ชื่ออะไหล่</td>
  
                                    <td><select name="cpro" id="cpro_ecip">
  
                                        <option value="">กรุณาเลือก</option>
  
                                        <?php
  
                                        $qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
  
                                        while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {
  
                                        ?>
  
                                          <option value="<?php echo $row_qupro1['group_id']; ?>"><?php echo $row_qupro1['group_spar_id'] . " | " . $row_qupro1['group_name']; ?></option>
  
                                        <?php
  
                                        }
  
                                        ?>
  
                                      </select> <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
  
                                  </tr>
  
                                  <tr>
  
                                    <td nowrap class="name">ชื่อลูกค้า</td>
  
                                    <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">
                                    <!-- <input name="cd_id" type="hidden" id="cd_id" value="" style="width:40%;"> -->
                                      <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
  
                                  </tr>
  
                                  <tr>
  
                                    <td nowrap class="name">ประเภทบริการ</td>
  
                                    <td><select name="sr_ctype" id="sr_ctype">
  
                                        <option value="">กรุณาเลือก</option>
  
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
  
                                      </select></td>
  
                                  </tr>
  
                                  <tr>
  
                                    <td nowrap class="name">ประเภทลูกค้า</td>
  
                                    <td><select name="ctype2" id="ctype2" class="inputselect">
  
                                        <option value="">กรุณาเลือก</option>
  
                                        <?php
  
                                        $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");
  
                                        while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {
  
                                          if (substr($row_cgcus['group_name'], 0, 2) == "SR") {
  
                                        ?>
  
                                            <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                    echo 'selected';
                                                                                                  } ?>><?php echo $row_cgcus['group_name']; ?></option>
  
                                        <?php
  
                                          }
                                        }
  
                                        ?>
  
                                      </select></td>
  
                                  </tr>
  
                                  <tr>
  
                                    <td nowrap class="name">ชื่อช่าง</td>
  
                                    <td><select name="loc_contact" id="loc_contact">
  
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
  
                                    <td><input name="sh16" type="checkbox" id="sh16" value="1" checked>

                                    เลขที่ใบเบิก

                                    <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh13" value="1" checked>

                                    รายละเอียดการเปลี่ยน

                                    <input name="sh4" type="checkbox" id="sh14" value="1" checked>

                                    รายการอะไหล่<br>



                                    <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                    ราคาต้นทุน

                                    <input name="sh5" type="checkbox" id="sh15" value="1" checked>

                                    จำนวน

                                    <input name="sh6" type="checkbox" id="sh17" value="1" checked>

                                    วันที่เบิก

                                    <input name="sh7" type="checkbox" id="sh18" value="1" checked>

                                    วันที่คืน

                                    <input name="sh9" type="checkbox" id="sh29" value="1" checked>

                                    ผู้เบิก</td>
  
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                  </tr>
  
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

          }

          if ($_GET['act'] == 7) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามอาการเสีย</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report7.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check7(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">เลือกอาการเสีย</td>

                                  <td><select name="sfix" id="sfix">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $qu_fix = @mysqli_query($conn, "SELECT * FROM s_group_fix ORDER BY group_name ASC");

                                      $numfix = @mysqli_num_rows($qu_fix);

                                      $nd = 1;

                                      while ($row_fix = @mysqli_fetch_array($qu_fix)) {

                                      ?>

                                        <option value="<?php echo $row_fix['group_id']; ?>"><?php echo $row_fix['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

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

                                  <td nowrap class="name">&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr>

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

          if ($_GET['act'] == 8) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามรายชื่อช่าง</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report8.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">ชื่อช่าง</td>

                                  <td><select name="loc_contact" id="loc_contact">

                                      <!--<option value="">กรุณาเลือก</option>-->

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

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="ctype2" id="ctype2" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        //if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        //}
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทใบงาน</td>

                                  <td><select name="openclose" id="openclose" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <option value="1">เปิดใบงาน</option>

                                      <option value="2">ปิดใบงาน</option>

                                    </select></td>

                                </tr>
                                
                                <tr>
    
                                      <td nowrap class="name">การบริการ</td>
    
                                      <td><select name="wservice" id="wservice" class="inputselect">
                                          <option value="1">ทั้งหมด</option>
                                          <option value="2">เข้าบริการ</option>
                                          <option value="3">ไม่เข้าบริการ</option>
                                        </select></td>
                                    </tr>

                                <tr>

                                <tr>

                                  <td nowrap class="name">รายการอะไหล่</td>

                                  <td>

                                    <select id="cpro_ecip" name="cpro">

                                      <option value="">กรุณาเลือกรายการ</option>

                                      <?php

                                      $qu_sparpart = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");

                                      while ($row_sparpart = @mysqli_fetch_array($qu_sparpart)) {

                                      ?>

                                        <option value="<?php echo $row_sparpart['group_id']; ?>"><?php echo $row_sparpart['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>



                                    </select>

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">&nbsp;</td>

                                  <td><span class="name">

                                      <input name="otVal" type="radio" value="0" checked>

                                      รวมงานทั้งหมด&nbsp;

                                      <input name="otVal" type="radio" value="1">

                                      เฉพาะงานที่มีโอที / เบี้ยเลี้ยง</span></td>

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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh46" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh47" value="1" checked>

                                    ประเภทลูกค้า

                                    <input name="sh4" type="checkbox" id="sh48" value="1" checked>

                                    ประเภทบริการ

                                    <input name="sh11" type="checkbox" id="sh46" value="1" checked>

                                    โอที / เบี้ยเลี้ยง<br>

                                    <input name="sh5" type="checkbox" id="sh49" value="1" checked>

                                    เลขที่ใบบริการ

                                    <input name="sh6" type="checkbox" id="sh50" value="1" checked>

                                    รุ่นเครื่อง

                                    <input name="sh7" type="checkbox" id="sh51" value="1" checked>

                                    S/N

                                    <input name="sh8" type="checkbox" id="sh52" value="1" checked>

                                    รายการอะไหล่

                                    <input name="sh9" type="checkbox" id="sh53" value="1" checked>

                                    รายละเอียดบริการ

                                    <input name="sh10" type="checkbox" id="sh54" value="1" checked>

                                    วันที่ให้บริการ
                                    
                                   
                                  </td>

                                </tr>

                                <!-- <tr>

                                  <td nowrap class="name">&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr> -->

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

          if ($_GET['act'] == 9) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามจังหวัด</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report9.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check9(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td width="10%" nowrap class="name">จังหวัด</td>

                                  <td width="90%">

                                    <select name="cd_province" id="cd_province" class="inputselect">

                                      <?php

                                      $quprovince = @mysqli_query($conn, "SELECT * FROM s_province ORDER BY province_id ASC");

                                      while ($row_province = @mysqli_fetch_array($quprovince)) {

                                      ?>

                                        <option value="<?php echo $row_province['province_id']; ?>" <?php if ($cd_province == $row_province['province_id']) {
                                                                                                      echo 'selected';
                                                                                                    } ?>><?php echo $row_province['province_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select>

                                  </td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

          if ($_GET['act'] == 10) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามมูลค่าการใช้</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report10.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check10(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh55" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh56" value="1" checked>

                                    ประเภทลูกค้า

                                    <br>

                                    <input name="sh4" type="checkbox" id="sh57" value="1" checked>

                                    ประเภทบริการ

                                    <input name="sh5" type="checkbox" id="sh58" value="1" checked>

                                    เลขที่ใบบริการ



                                    <input name="sh6" type="checkbox" id="sh61" value="1" checked>

                                    รายการอะไหล่

                                    <input name="sh7" type="checkbox" id="sh62" value="1" checked>

                                    มูลค่าการใช้อะไหล่</td>

                                </tr>

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

          if ($_GET['act'] == 11) {

            if ($_GET['poi'] == 0) {

              $daterriod2 = " AND `job_close`  between '" . $_GET['df'] . "' and '" . $_GET['dt'] . "'";

              list($s_year, $s_month, $s_day) = explode("-", $_GET['df']);

              $datefm = $s_day . "/" . $s_month . "/" . $s_year;

              list($s_year, $s_month, $s_day) = explode("-", $_GET['dt']);

              $dateft = $s_day . "/" . $s_month . "/" . $s_year;
            }

            $sql1 = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id AND sv.st_setting = 1 " . $daterriod2 . " ORDER BY sv.job_close ASC";

            $numclose = @mysqli_num_rows(@mysqli_query($conn, $sql1));



            if ($_GET['poi'] == 0) {

              $daterriod = " AND `job_open`  between '" . $_GET['df'] . "' and '" . $_GET['dt'] . "'";

              list($s_year, $s_month, $s_day) = explode("-", $_GET['df']);

              $datefm = $s_day . "/" . $s_month . "/" . $s_year;

              list($s_year, $s_month, $s_day) = explode("-", $_GET['dt']);

              $dateft = $s_day . "/" . $s_month . "/" . $s_year;
            }

            $sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id " . $daterriod . " AND sv.st_setting = 0 ORDER BY sv.job_open ASC";

            $numopen = @mysqli_num_rows(@mysqli_query($conn, $sql));



          ?>



            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">รายงานสรุป</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report27.php?action=chksum" method="post" name="form1" target="_blank" id="form1">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td width="10%" nowrap class="name">เริ่มวันที่

                                    <input type="text" name="date_fm" readonly value="<?php if ($_GET['df'] != "") {
                                                                                        list($s_year, $s_month, $s_day) = explode("-", $_GET['df']);
                                                                                        echo $s_day . "/" . $s_month . "/" . $s_year;
                                                                                      } else {
                                                                                        echo date("d/m/Y");
                                                                                      } ?>" class="inpfoder" />
                                    <script language="JavaScript">
                                      new tcal({
                                        'formname': 'form1',
                                        'controlname': 'date_fm'
                                      });
                                    </script>

                                    &nbsp;&nbsp; ถึงวันที่

                                    <input type="text" name="date_to" readonly value="<?php echo date("d/m/Y"); ?>" class="inpfoder" />
                                    <script language="JavaScript">
                                      new tcal({
                                        'formname': 'form1',
                                        'controlname': 'date_to'
                                      });
                                    </script>
                                  </td>

                                  <td width="90%"><span class="name">

                                      <input name="priod" type="radio" value="0" <?php if ($_GET['poi'] == 0) {
                                                                                    echo 'checked';
                                                                                  } ?>>

                                      กำหนดช่วงเวลา&nbsp;

                                      <input name="priod" type="radio" value="1" <?php if ($_GET['poi'] == 1) {
                                                                                    echo 'checked';
                                                                                  } ?>>

                                      ไม่กำหนดช่วงเวลา </span>&nbsp;&nbsp;<input type="submit" name="Submit" value="Submit" class="button">



                                  </td>

                                </tr>

                              </table>
                            </td>

                          </tr>

                        </table>

                      </fieldset>

                    </div> <br>

                  </form>



                  <?php

                  if ($_GET['res'] == "show") {

                  ?>

                    <table width="100%" border="1" cellspacing="0" cellpadding="0">

                      <tr>

                        <td>&nbsp;</td>

                        <td>

                          <div align="right"><?php

                                              if ($_GET['poi'] == 0) {

                                                echo $dateshow = "เริ่มวันที่ : " . format_date($_GET['df']) . "&nbsp;&nbsp;ถึงวันที่ : " . format_date($_GET['dt']);
                                              } else {

                                                echo $dateshow = "วันที่ค้นหา : " . format_date(date("Y-m-d"));
                                              }

                                              ?></div>

                        </td>

                      </tr>

                    </table>



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

                          <a href="report2.php?date_fm=<?php echo $datefm; ?>&date_to=<?php echo $dateft; ?>&priod=<?php echo $_GET['poi']; ?>" target="_blank"><?php echo number_format($numclose); ?></a>

                        </td>

                        <td><strong>ใบ</strong></td>

                      </tr>

                      <tr>

                        <td>ใบงานค้าง</td>

                        <td><a href="report1.php?date_fm=<?php echo $datefm; ?>&date_to=<?php echo $dateft; ?>&priod=<?php echo $_GET['poi']; ?>" target="_blank"><?php echo number_format($numopen); ?></a></td>

                        <td><strong>ใบ</strong></td>

                      </tr>

                      <tr>

                        <td>มูลค่าการใช้</td>

                        <td><?php

                            if ($_GET['poi'] == 0) {

                              $daterriod5 = " AND `job_close`  between '" . $_GET['df'] . "' and '" . $_GET['dt'] . "'";

                              list($s_year, $s_month, $s_day) = explode("-", $_GET['df']);

                              $datefm = $s_day . "/" . $s_month . "/" . $s_year;

                              list($s_year, $s_month, $s_day) = explode("-", $_GET['dt']);

                              $dateft = $s_day . "/" . $s_month . "/" . $s_year;
                            }

                            $sql = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id " . $daterriod5 . " AND (sv.cpro1 != '') ORDER BY fr.cd_name ASC";

                            $qu_fr = @mysqli_query($conn, $sql);

                            $sum = 0;

                            while ($row_fr = @mysqli_fetch_array($qu_fr)) {

                              $sum += ($row_fr['cprice1'] + $row_fr['cprice2'] + $row_fr['cprice3'] + $row_fr['cprice4'] + $row_fr['cprice5']);
                            }



                            ?>

                          <a href="report10.php?date_fm=<?php echo $datefm; ?>&date_to=<?php echo $dateft; ?>&priod=<?php echo $_GET['poi']; ?>" target="_blank"><?php echo number_format($sum); ?></a>

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

                            if ($_GET['poi'] == 0) {

                              $daterriod4 = " AND `job_close`  between '" . $_GET['df'] . "' and '" . $_GET['dt'] . "'";

                              list($s_year, $s_month, $s_day) = explode("-", $_GET['df']);

                              $datefm = $s_day . "/" . $s_month . "/" . $s_year;

                              list($s_year, $s_month, $s_day) = explode("-", $_GET['dt']);

                              $dateft = $s_day . "/" . $s_month . "/" . $s_year;
                            }

                            $sql4 = "SELECT * FROM s_first_order as fr, s_service_report as sv WHERE sv.cus_id = fr.fo_id  " . $daterriod4 . " and sv.sr_ctype = '" . $roeservice['group_id'] . "' ORDER BY fr.cd_name ASC";

                            $qu_fr4 = mysqli_num_rows(@mysqli_query($conn, $sql4));

                            ?>

                            <a href="report5.php?date_fm=<?php echo $datefm; ?>&date_to=<?php echo $dateft; ?>&priod=<?php echo $_GET['poi']; ?>&sr_ctype=<?php echo $roeservice['group_id']; ?>" target="_blank"><?php echo number_format($qu_fr4); ?></a>

                          </td>

                          <td><strong>ใบ</strong></td>

                        </tr>

                      <?php  } ?>

                    </table>







                  <?php

                  }

                  ?>



                </DIV><!-- End #tab1 -->





              </DIV><!-- End .content-box-content -->

            </DIV>

          <?php





          }

          if ($_GET['act'] == 12) {

          ?>

            <DIV class=content-box>

              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">

                <H3 align="left">เลือกตามตารางคุมสัญญาบริการ</H3>

                <DIV class=clear></DIV>

              </DIV>

              <!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab2 class="tab-content default-tab">

                  <!-- This is the target div. id must match the href of this div's tab -->

                  <div class="formArea">

                    <fieldset>

                      <table width="100%" cellspacing="0" cellpadding="0" border="0">

                        <tr>

                          <td><iframe id="form-iframe" src="control_contact.php" style="margin:0; width:100%; height:600px; border:none; overflow:hidden;" scrolling="no" onload="AdjustIframeHeightOnLoad()"></iframe></td>

                        </tr>

                      </table>

                    </fieldset>

                  </div>

                  <br>

                </DIV>

                <!-- End #tab1 -->

              </DIV>

              <!-- End .content-box-content -->

            </DIV>

          <?php

          }

          if ($_GET['act'] == 13) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามใบยืม</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report13.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">เลือกรหัส | ชื่ออะไหล่</td>

                                  <td><select name="cpro" id="cpro_ecip">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");

                                      while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {

                                      ?>

                                        <option value="<?php echo $row_qupro1['group_id']; ?>"><?php echo $row_qupro1['group_spar_id'] . " | " . $row_qupro1['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select> <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อช่างยืม</td>

                                  <td><select name="loc_contact" id="loc_contact">

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

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทเอกสาร</td>

                                  <td><input name="opentake" type="radio" id="radio3" value="2" checked>

                                    ไม่กำหนด

                                    <input name="opentake" type="radio" id="radio3" value="0">

                                    ใบเปิดใบยืม

                                    <input type="radio" name="opentake" id="radio4" value="1">

                                    ใบปิดใบยืม</td>

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

                                  <td>

                                    <input name="sh10" type="checkbox" id="sh10" value="1" checked>

                                    เลขที่ใบยืม

                                    <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh13" value="1" checked>

                                    รายละเอียดการเปลี่ยน

                                    <input name="sh4" type="checkbox" id="sh14" value="1" checked>

                                    รายการอะไหล่<br>



                                    <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                    รวมมูลค่า

                                    <input name="sh5" type="checkbox" id="sh15" value="1" checked>

                                    จำนวน

                                    <input name="sh6" type="checkbox" id="sh17" value="1" checked>

                                    วันที่เบิก

                                    <input name="sh7" type="checkbox" id="sh18" value="1" checked>

                                    วันที่คืน

                                    <input name="sh9" type="checkbox" id="sh29" value="1" checked>

                                    ผู้เบิก</td>

                                </tr>

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



          if ($_GET['act'] == 15) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามใบเบิก</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report15.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">เลือกรหัส | ชื่ออะไหล่</td>

                                  <td><select name="cpro" id="cpro_ecip">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");

                                      while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {

                                      ?>

                                        <option value="<?php echo $row_qupro1['group_id']; ?>"><?php echo $row_qupro1['group_spar_id'] . " | " . $row_qupro1['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select> <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อช่างยืม</td>

                                  <td><select name="loc_contact" id="loc_contact">

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

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทเอกสาร</td>

                                  <td><input name="opentake" type="radio" id="radio" value="2" checked>

                                    ไม่กำหนด

                                    <input name="opentake" type="radio" id="radio" value="0">

                                    ใบเปิดใบเบิก

                                    <input type="radio" name="opentake" id="radio2" value="1">

                                    ใบปิดใบเบิก</td>

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

                                  <td><input name="sh16" type="checkbox" id="sh16" value="1" checked>

                                    เลขที่ใบเบิก

                                    <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh13" value="1" checked>

                                    รายละเอียดการเปลี่ยน

                                    <input name="sh4" type="checkbox" id="sh14" value="1" checked>

                                    รายการอะไหล่<br>



                                    <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                    รวมมูลค่า

                                    <input name="sh5" type="checkbox" id="sh15" value="1" checked>

                                    จำนวน

                                    <input name="sh6" type="checkbox" id="sh17" value="1" checked>

                                    วันที่เบิก

                                    <input name="sh7" type="checkbox" id="sh18" value="1" checked>

                                    วันที่คืน

                                    <input name="sh9" type="checkbox" id="sh29" value="1" checked>

                                    ผู้เบิก</td>

                                </tr>



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



          if ($_GET['act'] == 14) {

            $check_moduleSub = "ต้นทุนตาม Installation";
            $codeSub = Check_Permission($conn, $check_moduleSub, $_SESSION["login_id"], "read");

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตาม Installation</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report14.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">เลือกรหัส | ชื่ออะไหล่</td>

                                  <td><select name="cpro" id="cpro_ecip">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");

                                      while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {

                                      ?>

                                        <option value="<?php echo $row_qupro1['group_id']; ?>"><?php echo $row_qupro1['group_spar_id'] . " | " . $row_qupro1['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select> <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">รุ่นเครื่อง</td>

                                  <td><select name="loc_seal" id="loc_seal" class="inputselect" style="width:250px;">

                                      <option value="">กรุณาเลือกรายการ</option>

                                      <?php

                                      $qupros1 = @mysqli_query($conn, "SELECT * FROM s_group_pod ORDER BY group_name ASC");

                                      while ($row_qupros1 = @@mysqli_fetch_array($qupros1)) {

                                      ?>

                                        <option value="<?php echo $row_qupros1['group_name']; ?>"><?php echo $row_qupros1['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select>

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_pod.php?protype=loc_seal');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

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

                                  <td>

                                    <input name="sh9" type="checkbox" id="sh9" value="1" checked>

                                    เลขที่ใบติดตั้ง

                                    <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง



                                    <input name="sh3" type="checkbox" id="sh14" value="1" checked>

                                    รุ่นเครื่อง S/N<br>

                                    <input name="sh4" type="checkbox" id="sh15" value="1" checked>

                                    รายการอะไหล่ที่ใช้

                                    <input name="sh5" type="checkbox" id="sh17" value="1" checked>

                                    จำนวน

                                    <input name="sh10" type="checkbox" id="sh38" value="1" checked>

                                    ราคาต้นทุน

                                    <input name="sh6" type="checkbox" id="sh18" value="1" checked>

                                    ราคาขาย

                                  
                                    <input name="sh7" type="checkbox" id="sh28" value="1" checked>

                                    วันที่ส่งงาน

                                    <input name="sh8" type="checkbox" id="sh29" value="1" checked>

                                    ผู้เบิก</td>

                                </tr>

                              </table>
                            </td>

                          </tr>

                          <tr>

                            <td nowrap class="name">&nbsp;</td>

                            <td>&nbsp;</td>

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



          if ($_GET['act'] == 16) {



          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามใบคืน</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report16.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">เลือกรหัส | ชื่ออะไหล่</td>

                                  <td><select name="cpro" id="cpro_ecip">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");

                                      while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {

                                      ?>

                                        <option value="<?php echo $row_qupro1['group_id']; ?>"><?php echo $row_qupro1['group_spar_id'] . " | " . $row_qupro1['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select> <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="ctype" id="ctype" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อลูกค้า</td>

                                  <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">

                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ชื่อช่างยืม</td>

                                  <td><select name="loc_contact" id="loc_contact">

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

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทเอกสาร</td>

                                  <td><input name="opentake" type="radio" id="radio3" value="2" checked>

                                    ไม่กำหนด

                                    <input name="opentake" type="radio" id="radio3" value="0">

                                    ใบเปิดใบคืน

                                    <input type="radio" name="opentake" id="radio4" value="1">

                                    ใบปิดใบคืน</td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">&nbsp;</td>

                                  <td><span class="name">

                                      <input name="priod" type="radio" value="0">

                                      กำหนดช่วงเวลา&nbsp;

                                      <input name="priod" type="radio" value="1" checked>

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

                                  <td>

                                    <input name="sh10" type="checkbox" id="sh10" value="1" checked>

                                    เลขที่ใบยืม

                                    <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh13" value="1" checked>

                                    รายละเอียดการเปลี่ยน

                                    <input name="sh4" type="checkbox" id="sh14" value="1" checked>

                                    รายการอะไหล่<br>



                                    <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                    รวมมูลค่า

                                    <input name="sh5" type="checkbox" id="sh15" value="1" checked>

                                    จำนวนยืม

                                    <input name="sh31" type="checkbox" id="sh31" value="1" checked>

                                    จำนวนคืน

                                    <input name="sh6" type="checkbox" id="sh17" value="1" checked>

                                    วันที่เบิก

                                    <input name="sh7" type="checkbox" id="sh18" value="1" checked>

                                    วันที่คืน

                                    <input name="sh9" type="checkbox" id="sh29" value="1" checked>

                                    ผู้เบิก</td>

                                </tr>



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





          if ($_GET['act'] == 17) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามโซน/ภาค/เขต (SR)</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report17.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">โซน/ภาค/เขต</td>

                                  <td><select name="service_zone" id="service_zone">

                                      <option value="">กรุณาเลือกโซน/ภาค/เขต</option>

                                      <?php

                                      $qu_zone = @mysqli_query($conn, "SELECT * FROM s_group_zone ORDER BY group_name ASC");

                                      while ($row_zone = @mysqli_fetch_array($qu_zone)) {

                                      ?>

                                        <option value="<?php echo $row_zone['group_id']; ?>"><?php echo $row_zone['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td width="10%" nowrap class="name">ชื่อร้าน-ชื่อบริษัท</td>

                                  <td width="90%"><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $qu_cusftype = @mysqli_query($conn, "SELECT * FROM s_group_service ORDER BY group_name ASC");

                                      while ($row_cusftype = @mysqli_fetch_array($qu_cusftype)) {

                                        if ($row_cusftype['group_id'] == 8 || $row_cusftype['group_id'] == 37 || $row_cusftype['group_id'] == 38 || $row_cusftype['group_id'] == 39 || $row_cusftype['group_id'] == 97 || $row_cusftype['group_id'] == 100 || $row_cusftype['group_id'] == 101 || $row_cusftype['group_id'] == 102) {

                                      ?>

                                          <option value="<?php echo $row_cusftype['group_id']; ?>" <?php if ($row_cusftype['group_id'] == $sr_ctype) {
                                                                                                      echo 'selected';
                                                                                                    } ?>><?php echo $row_cusftype['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="sr_ctype2" id="sr_ctype2" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ตามรายชื่อช่าง</td>

                                  <td><select name="loc_contact" id="loc_contact">

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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh46" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh47" value="1" checked>

                                    อำเภอ/จังหวัด

                                    <input name="sh4" type="checkbox" id="sh48" value="1" checked>

                                    กลุ่มลูกค้า

                                    <br>

                                    <input name="sh5" type="checkbox" id="sh49" value="1" checked>

                                    สินค้า

                                    <input name="sh6" type="checkbox" id="sh50" value="1" checked>

                                    รุ่นเครื่อง / SN

                                    <input name="sh7" type="checkbox" id="sh51" value="1" checked>

                                    วันที่ติดตั้ง

                                    <input name="sh8" type="checkbox" id="sh52" value="1" checked>

                                    ประเภทงานบริการ

                                    <input name="sh9" type="checkbox" id="sh53" value="1" checked>

                                    ประเภทลูกค้า

                                    <input name="sh10" type="checkbox" id="sh54" value="1" checked>

                                    รายชื่อช่าง</td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr>

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

          if ($_GET['act'] == 18) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกรายงานอะไหล่</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report18.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check6(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">ค้นหารหัสอะไหล่</td>

                                  <td><input name="group_spar_id18" type="text" id="group_spar_id18" value="" style="width:40%;"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search3.php?protype=group_spar_id');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ค้นหาชื่ออะไหล่</td>

                                  <td><input name="cpro_ecip18" type="text" id="cpro_ecip18" value="" style="width:40%;"><a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search3.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>

                                    <input type="hidden" name="cpro" id="cpro18" value="">

                                  </td>

                                </tr>

                                <!--

                          <tr >

                            <td nowrap class="name">ชื่อลูกค้า</td>

                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">

                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                          </tr>-->

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

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

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="ctype2" id="ctype2" class="inputselect">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>



                                <tr>

                                  <td nowrap class="name">ชื่อช่างยืม</td>

                                  <td><select name="loc_contact" id="loc_contact">

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

                                </tr>

                                <tr>

                                  <td nowrap class="name">เลือกฐานข้อมูล</td>

                                  <td><span class="name">

                                      <input type="checkbox" name="database1" value="1" checked> ใบเบิก&nbsp;&nbsp;&nbsp;

                                      <input type="checkbox" name="database2" value="1" checked> ใบยืม<br></td>

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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh31" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh38" value="1" checked>

                                    ประเภทลูกค้า

                                    <input name="sh4" type="checkbox" id="sh39" value="1" checked>

                                    สินค้า<br>

                                    <input name="sh5" type="checkbox" id="sh41" value="1" checked>

                                    รุ่นเครื่อง/SN

                                    <!--

                              <input name="sh6" type="checkbox" id="sh42" value="1" checked>

                              

-->

                                    <input name="sh7" type="checkbox" id="sh43" value="1" checked>

                                    เลขที่ใบเบิก/ใบยืม

                                    <input name="sh11" type="checkbox" id="sh11" value="1" checked>

                                    รหัสสินค้า

                                    <input name="sh8" type="checkbox" id="sh44" value="1" checked>

                                    รายการอะไหล่

                                    <input name="sh9" type="checkbox" id="sh40" value="1" checked>

                                    ราคาขาย

                                    <input name="sh10" type="checkbox" id="sh45" value="1" checked>

                                    ชื่อช่าง</td>

                                </tr>

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



          if ($_GET['act'] == 19) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">เลือกตามใบงานซ่อมเครื่องเก่า</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report19.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <!--

                         <tr >

                            <td nowrap class="name">เลือกรหัส | ชื่ออะไหล่</td>

                            <td><select name="cpro" id="cpro_ecip">

                            	<option value="">กรุณาเลือก</option>

                              <?php

                              $qupro1 = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");

                              while ($row_qupro1 = @mysqli_fetch_array($qupro1)) {

                              ?>

                                      <option value="<?php echo $row_qupro1['group_id']; ?>"><?php echo $row_qupro1['group_spar_id'] . " | " . $row_qupro1['group_name']; ?></option>

                                    <?php

                                  }

                                    ?>

                          </select>                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                          </tr>

-->

                                <!--

                          <tr >

                            <td nowrap class="name">ประเภทบริการ</td>

                            <td><select name="sr_ctype" id="sr_ctype">

                              <option value="">กรุณาเลือก</option>

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

                            </select></td>

                          </tr>

                          <tr >

                            <td nowrap class="name">ประเภทลูกค้า</td>

                            <td><select name="ctype" id="ctype" class="inputselect" >

                              <option value="">กรุณาเลือก</option>

                              <?php

                              $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                              while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                if (substr($row_cgcus['group_name'], 0, 2) == "SR") {

                              ?>

                              <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                      echo 'selected';
                                                                                    } ?>><?php echo $row_cgcus['group_name']; ?></option>

                              <?php

                                }
                              }

                              ?>

                            </select></td>

                          </tr>

                          <tr >

                            <td nowrap class="name">ชื่อลูกค้า</td>

                            <td><input name="cd_name" type="text" id="cd_name"  value="" style="width:40%;">

                              <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>

                          </tr>

-->

                                <!-- <tr>

                                  <td nowrap class="name">ชื่อช่างยืม</td>

                                  <td><select name="loc_contact" id="loc_contact">

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

                                </tr> -->

                                <!--

                          <tr>

                            <td nowrap class="name">ประเภทเอกสาร</td>

                            <td><input name="opentake" type="radio" id="radio" value="2" checked>

                              ไม่กำหนด

                              <input name="opentake" type="radio" id="radio" value="0">

                              ใบเปิดใบเบิก

                              <input type="radio" name="opentake" id="radio2" value="1">

                              ใบปิดใบเบิก</td>

                          </tr>

-->


                              <tr>

                                  <td nowrap class="name">รุ่นเครื่อง</td>

                                  <td><input name="loc_seal" type="text" id="loc_seal" value="" style="width:30%;">

                                  </td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">หมายเลข S/N</td>

                                  <td><input name="loc_sn" type="text" id="loc_sn" value="" style="width:30%;">

                                  </td>

                                  </tr>

                                <tr>

                              <td width="10%" nowrap class="name">ประเภทบริการ</td>

                              <td width="90%">
                              <select name="type_service" id="type_service">
                                <option value="">กรุณาเลือก</option>
                                <option value="1"><?php   echo 'เครื่องล้างจาน';?></option>
                                <option value="2"><?php   echo 'เครื่องล้างแก้ว';?></option>
                                <option value="3"><?php   echo 'เครื่องผลิตน้ำแข็ง';?></option>
                              
                                    </select>
                              </td>

                              </tr>
                              <tr>

                              <td width="10%" nowrap class="name">สถานะเครื่อง</td>

                              <td width="90%">
                              <select name="status_type" id="status_type">
                                <option value="">กรุณาเลือก</option>
                                <option value="1"><?php   echo 'พร้อมใช้';?></option>
                                <option value="5"><?php   echo 'พร้อมใช้ / จองแล้ว';?></option>
                                <option value="2"><?php   echo 'รอล้าง/ทำความสะอาด';?></option>
                                <option value="3"><?php   echo 'ซ่อมหนัก (รอตัดซาก)';?></option>
                                <option value="4"><?php   echo 'นำไปติดตั้งแล้ว';?></option>
                                    </select>
                              </td>

                              </tr>

                              <tr>

                              <td width="10%" nowrap class="name">สต็อกเครื่อง</td>

                              <td width="90%">
                              <select name="sr_stock" id="sr_stock">
                                <option value="">กรุณาเลือก</option>
                                <option value="1"><?php   echo 'ออฟฟิต สุขาภิบาล5';?></option>
                                <option value="2"><?php   echo 'โรงงานลาดหลุมแก้ว';?></option>
                                    </select>
                              </td>

                              </tr>

                              <tr>

                              <td width="10%" nowrap class="name">ตามวันที่ซ่อมเสร็จ</td>

                              <td width="90%"><input type="text" name="sr_stime" readonly value="" class="inpfoder" />
                                <script language="JavaScript">
                                  new tcal({
                                    'formname': 'form1',
                                    'controlname': 'sr_stime'
                                  });
                                </script>
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

                                  <td><input name="sh16" type="checkbox" id="sh16" value="1" checked>

                                    เลขที่ใบซ่อมเครื่องเก่า

                                    <input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร / สถานที่ติดตั้ง

                                    <!-- <input name="sh2" type="checkbox" id="sh12" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง -->

                                    <input name="sh3" type="checkbox" id="sh13" value="1" checked>

                                    รายละเอียดการเปลี่ยน

                                    <input name="sh4" type="checkbox" id="sh14" value="1" checked>

                                    รายการอะไหล่<br>



                                    <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                    รวมมูลค่า

                                    <input name="sh5" type="checkbox" id="sh15" value="1" checked>

                                    จำนวน

                                    <input name="sh6" type="checkbox" id="sh17" value="1" checked>

                                    วันที่เบิก

                                    <input name="sh7" type="checkbox" id="sh18" value="1" checked>

                                    วันที่ถอดเครื่อง

                                    <input name="sh9" type="checkbox" id="sh29" value="1" checked>

                                    ผู้เบิก</td>

                                </tr>

                                <!-- <tr>

                                  <td>



                                  </td>

                                </tr> -->

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

          if ($_GET['act'] == 20) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">

                <H3 align="left">เลือกตามการรับอะไหล่เข้าสต๊อค</H3>

                <DIV class=clear>

                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->
                  <form action="report20.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">
                    <div class="formArea">
                      <fieldset>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

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

          if ($_GET['act'] == 21) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">

                <H3 align="left">เลือกตามการรับสินค้าเข้าสต๊อค</H3>

                <DIV class=clear>

                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->
                  <form action="report21.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check3(this)">
                    <div class="formArea">
                      <fieldset>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

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

                                    รหัสสินค้า<br>


                                    <input name="sh5" type="checkbox" id="sh5" value="1" checked>

                                    รายการสินค้า

                                    <!-- <input name="sh6" type="checkbox" id="sh6" value="1" checked>
                  
                                  ราคาซื้อ
                  
                                <input name="sh7" type="checkbox" id="sh7" value="1" checked>
  
                                รวมราคาซื้ิอ -->

                                    <input name="sh8" type="checkbox" id="sh8" value="1" checked>

                                    ผู้รับสินค้าเข้า
                                  </td>

                                </tr>



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

          if ($_GET['act'] == 22) {
            Check_Permission($conn, "รายงานตามโซน/ภาค/เขต", $_SESSION["login_id"], "read");
          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">

                <H3 align="left">เลือกตามโซน/ภาค/เขต (FO)</H3>

                <DIV class=clear>

                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report22.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>

                                  <td nowrap class="name">โซน/ภาค/เขต</td>

                                  <td><select name="service_zone" id="service_zone">

                                      <option value="">กรุณาเลือกโซน/ภาค/เขต</option>

                                      <?php

                                      $qu_zone = @mysqli_query($conn, "SELECT * FROM s_group_zone ORDER BY group_name ASC");

                                      while ($row_zone = @mysqli_fetch_array($qu_zone)) {

                                      ?>

                                        <option value="<?php echo $row_zone['group_id']; ?>"><?php echo $row_zone['group_name']; ?></option>

                                      <?php

                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทบริการ</td>

                                  <td><select name="sr_ctype" id="sr_ctype">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $qu_cusftype = @mysqli_query($conn, "SELECT * FROM s_group_service ORDER BY group_name ASC");

                                      while ($row_cusftype = @mysqli_fetch_array($qu_cusftype)) {

                                        if ($row_cusftype['group_id'] == 8 || $row_cusftype['group_id'] == 37 || $row_cusftype['group_id'] == 38 || $row_cusftype['group_id'] == 39 || $row_cusftype['group_id'] == 97 || $row_cusftype['group_id'] == 100) {

                                      ?>

                                          <option value="<?php echo $row_cusftype['group_id']; ?>" <?php if ($row_cusftype['group_id'] == $sr_ctype) {
                                                                                                      echo 'selected';
                                                                                                    } ?>><?php echo $row_cusftype['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ประเภทลูกค้า</td>

                                  <td><select name="sr_ctype2" id="sr_ctype2" class="">

                                      <option value="">กรุณาเลือก</option>

                                      <?php

                                      $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                      while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                        if (substr($row_cgcus['group_name'], 0, 2) != "SR") {

                                      ?>

                                          <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                  echo 'selected';
                                                                                                } ?>><?php echo $row_cgcus['group_name']; ?></option>

                                      <?php

                                        }
                                      }

                                      ?>

                                    </select></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">ตามรายชื่อช่าง</td>

                                  <td><select name="loc_contact" id="loc_contact">

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

                                </tr>

                                <tr>

                                  <td nowrap class="name">จากข้อมูล</td>

                                  <td><span class="name">

                                      <input name="dbfosv" type="radio" value="0" checked>

                                      ทั้ง FO และ SV&nbsp;

                                      <input name="dbfosv" type="radio" value="1">

                                      FO เท่านั้น&nbsp;

                                      <input name="dbfosv" type="radio" value="2">

                                      SV เท่านั้น&nbsp;</span></td>

                                </tr>

                                <tr>

                                  <td nowrap class="name">QR Code</td>

                                  <td><span class="name">

                                      <input name="sQR" type="radio" value="1" checked>

                                      ไม่แสดง QR Code&nbsp;

                                      <input name="sQR" type="radio" value="2">

                                      แสดง QR Code&nbsp;</span></td>

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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh46" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <input name="sh3" type="checkbox" id="sh47" value="1" checked>

                                    อำเภอ/จังหวัด

                                    <input name="sh4" type="checkbox" id="sh48" value="1" checked>

                                    กลุ่มลูกค้า

                                    <br>

                                    <input name="sh5" type="checkbox" id="sh49" value="1" checked>

                                    สินค้า

                                    <input name="sh6" type="checkbox" id="sh50" value="1" checked>

                                    รุ่นเครื่อง / SN

                                    <input name="sh7" type="checkbox" id="sh51" value="1" checked>

                                    วันที่ติดตั้ง

                                    <input name="sh8" type="checkbox" id="sh52" value="1" checked>

                                    ประเภทงานบริการ

                                    <input name="sh9" type="checkbox" id="sh53" value="1" checked>

                                    ประเภทลูกค้า

                                    <input name="sh10" type="checkbox" id="sh54" value="1" checked>

                                    รายชื่อช่าง</td>

                                </tr>

                                <!-- <tr>

                                  <td nowrap class="name">&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr> -->

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

          if ($_GET['act'] == 23) {

          ?>

            <DIV class=content-box>
              <!-- Start Content Box -->

              <DIV class=content-box-header align="right" style="padding-right:15px;">



                <H3 align="left">ติดตามสถานะงาน (FO/SV/PJ)</H3>

                <DIV class=clear>



                </DIV>
              </DIV><!-- End .content-box-header -->

              <DIV class=content-box-content>

                <DIV id=tab1 class="tab-content default-tab">
                  <!-- This is the target div. id must match the href of this div's tab -->

                  <form action="report23.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">

                    <div class="formArea">

                      <fieldset>

                        <table width="100%" cellspacing="0" cellpadding="0" border="0">

                          <tr>

                            <td>
                              <table class="formFields" cellspacing="0" width="100%">

                                <tr>
                                  <td width="10%" nowrap class="name">ชื่อร้าน-ชื่อบริษัท</td>
                                  <td width="90%"><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">
                                    <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a>
                                  </td>
                                </tr>

                                <tr>
                                  <td width="10%" nowrap class="name">ชื่อผู้ขาย</td>
                                  <td width="90%">
                                    <select name="cs_sell" id="cs_sell" style="width:250px;">
                                      <option value="">กรุณาเลือกพนักงานขาย</option>
                                      <?php
                                      $qusaletype = @mysqli_query($conn, "SELECT * FROM s_group_sale ORDER BY group_name ASC");
                                      while ($row_saletype = @@mysqli_fetch_array($qusaletype)) {
                                      ?>
                                        <option value="<?php echo $row_saletype['group_id']; ?>"><?php echo $row_saletype['group_name']; ?></option>
                                      <?php
                                      }
                                      ?>
                                    </select>
                                  </td>
                                </tr>

                                <!-- <tr >
  
                              <td nowrap class="name">โซน/ภาค/เขต</td>
  
                              <td><select name="service_zone" id="service_zone">
  
                                <option value="">กรุณาเลือกโซน/ภาค/เขต</option>
  
                                <?php

                                $qu_zone = @mysqli_query($conn, "SELECT * FROM s_group_zone ORDER BY group_name ASC");

                                while ($row_zone = @mysqli_fetch_array($qu_zone)) {

                                ?>
  
                                <option value="<?php echo $row_zone['group_id']; ?>"><?php echo $row_zone['group_name']; ?></option>
  
                                <?php

                                }

                                ?>
  
                              </select></td>
  
                            </tr> -->

                                <!-- <tr >
  
                              <td nowrap class="name">ประเภทบริการ</td>
  
                              <td><select name="sr_ctype" id="sr_ctype">
  
                                <option value="">กรุณาเลือก</option>
  
                                <?php

                                $qu_cusftype = @mysqli_query($conn, "SELECT * FROM s_group_service ORDER BY group_name ASC");

                                while ($row_cusftype = @mysqli_fetch_array($qu_cusftype)) {

                                  // if($row_cusftype['group_id'] == 8 || $row_cusftype['group_id'] == 37 || $row_cusftype['group_id'] == 38 || $row_cusftype['group_id'] == 39 || $row_cusftype['group_id'] == 97 || $row_cusftype['group_id'] == 100){

                                ?>
  
                                <option value="<?php echo $row_cusftype['group_id']; ?>" <?php if ($row_cusftype['group_id'] == $sr_ctype) {
                                                                                            echo 'selected';
                                                                                          } ?>><?php echo $row_cusftype['group_name']; ?></option>
  
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

                                $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");

                                while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {

                                  //if(substr($row_cgcus['group_name'],0,2) != "SR"){

                                ?>
  
                                <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                        echo 'selected';
                                                                                      } ?>><?php echo $row_cgcus['group_name']; ?></option>
  
                                <?php

                                  // }



                                }

                                ?>
  
                              </select></td>
  
                            </tr> -->

                                <!-- <tr>
  
                              <td nowrap class="name">ตามรายชื่อช่าง</td>
  
                              <td><select name="loc_contact" id="loc_contact">
  
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

                                  <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>

                                    ชื่อลูกค้า / บริษัท + เบอร์โทร

                                    <input name="sh2" type="checkbox" id="sh46" value="1" checked>

                                    ชื่อร้าน / สถานที่ติดตั้ง

                                    <!-- <input name="sh3" type="checkbox" id="sh47" value="1" checked>
  
                                อำเภอ/จังหวัด
  
                                <input name="sh4" type="checkbox" id="sh48" value="1" checked>
  
                                กลุ่มลูกค้า -->

                                    <br>

                                    <!-- <input name="sh5" type="checkbox" id="sh49" value="1" checked>
  
                                สินค้า-->

                                    <input name="sh6" type="checkbox" id="sh50" value="1" checked>

                                    รุ่นเครื่อง / SN

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

                                <tr>

                                  <td nowrap class="name">&nbsp;</td>

                                  <td>&nbsp;</td>

                                </tr>

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

          if ($_GET['act'] == 25) {

            ?>
  
              <DIV class=content-box>
                <!-- Start Content Box -->
  
                <DIV class=content-box-header align="right" style="padding-right:15px;">
  
  
  
                  <H3 align="left">เลือกตามใบปิดงาน (ส่วนงานติดตั้ง)</H3>
  
                  <DIV class=clear>
  
  
  
                  </DIV>
                </DIV><!-- End .content-box-header -->
  
                <DIV class=content-box-content>
  
                  <DIV id=tab1 class="tab-content default-tab">
                    <!-- This is the target div. id must match the href of this div's tab -->
  
                    <form action="report25.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check2(this)">
  
                      <div class="formArea">
  
                        <fieldset>
  
                          <table width="100%" cellspacing="0" cellpadding="0" border="0">
  
                            <tr>
  
                              <td>
                                <table class="formFields" cellspacing="0" width="100%">
  
                                  <tr>
  
                                    <td nowrap class="name">ประเภทบริการ</td>
  
                                    <td><select name="sr_ctype" id="sr_ctype">
  
                                        <option value="">กรุณาเลือก</option>
  
                                        <?php
  
                                        $qu_cusftype = @mysqli_query($conn, "SELECT * FROM s_group_service ORDER BY group_name ASC");

                                        $listC = array(88,105,106,45,47,79,36,23,57,51,89,55,24,87,31,48);
  
                                        while ($row_cusftype = @mysqli_fetch_array($qu_cusftype)) {

                                         if(in_array($row_cusftype['group_id'],$listC)){
  
                                        ?>
  
                                          <option value="<?php echo $row_cusftype['group_id']; ?>" <?php if ($row_cusftype['group_id'] == $sr_ctype) {
                                                                                                      echo 'selected';
                                                                                                    } ?>><?php echo $row_cusftype['group_name']; ?></option>
  
                                        <?php
                                         }
  
                                        }
  
                                        ?>
  
                                      </select></td>
  
                                  </tr>
  
                                  <tr>
  
                                    <td width="10%" nowrap class="name">ประเภทลูกค้า</td>
  
                                    <td width="90%">
  
                                      <select name="ctype" id="ctype" class="inputselect">
  
                                        <option value="">กรุณาเลือก</option>
  
                                        <?php
  
                                        $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");
  
                                        while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {
  
                                          //if (substr($row_cgcus['group_name'], 0, 2) == "SR") {
  
                                        ?>
  
                                            <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                    echo 'selected';
                                                                                                  } ?>><?php echo $row_cgcus['group_name']; ?></option>
  
                                        <?php
  
                                          //}
                                        }
  
                                        ?>
  
                                      </select>
  
                                    </td>
  
                                  </tr>
  
                                  <tr>
  
                                    <td>รหัสลูกค้า</td>
  
                                    <td><input name="cusid" type="text" id="cusid" value="" style="width:40%;">
  
                                      <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search_id.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
  
                                  </tr>
  
                                  <tr>
  
                                    <td nowrap class="name">ชื่อลูกค้า</td>
  
                                    <td><input name="cd_name" type="text" id="cd_name" value="" style="width:40%;">
  
                                      <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search.php');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
  
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
  
                                    <td><input name="sh1" type="checkbox" id="sh19" value="1" checked>
  
                                      ชื่อลูกค้า / บริษัท + เบอร์โทร
  
                                      <input name="sh2" type="checkbox" id="sh20" value="1" checked>
  
                                      ชื่อร้าน / สถานที่ติดตั้ง
  
                                      <input name="sh3" type="checkbox" id="sh21" value="1" checked>
  
                                      ประเภทลูกค้า
  
                                      <input name="sh4" type="checkbox" id="sh22" value="1" checked>
  
                                      โอที / เบี้ยเลี้ยง
                                      <br>
  
                                      <input name="sh5" type="checkbox" id="sh23" value="1" checked>
  
                                      เลขที่ใบบริการ
  
                                      <input name="sh6" type="checkbox" id="sh24" value="1" checked>
  
                                      วันที่เปิด / วันที่ปิด
  
                                      <input name="sh7" type="checkbox" id="sh25" value="1" checked>
  
                                      รุ่นเครื่อง
  
                                      <input name="sh8" type="checkbox" id="sh10" value="1" checked>
  
                                      S/N
  
                                      <input name="sh9" type="checkbox" id="sh26" value="1" checked>
  
                                      รายละเอียดการบริการ
  
                                      <input name="sh10" type="checkbox" id="sh27" value="1" checked>
  
                                      ชื่อช่าง</td>
  
                                  </tr>
  
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
            
            if ($_GET['act'] == 26) {

              ?>
    
                <DIV class=content-box>
                  <!-- Start Content Box -->
    
                  <DIV class=content-box-header align="right" style="padding-right:15px;">
    
    
    
                    <H3 align="left">รายงานสรุป (แยกตามรายชื่อช่าง)</H3>
    
                    <DIV class=clear>
    
    
    
                    </DIV>
                  </DIV><!-- End .content-box-header -->
    
                  <DIV class=content-box-content>
    
                    <DIV id=tab1 class="tab-content default-tab">
                      <!-- This is the target div. id must match the href of this div's tab -->
    
                      <form action="report26.php" method="post" name="form1" id="form1" target="_blank" onSubmit="return check8(this)">
    
                        <div class="formArea">
    
                          <fieldset>
    
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
    
                              <tr>
    
                                <td>
                                  <table class="formFields" cellspacing="0" width="100%">
    
                                    <tr>
    
                                      <td nowrap class="name">ชื่อช่าง</td>
    
                                      <td><select name="loc_contact" id="loc_contact">
    
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
    
                                    </tr>
    
                                    <tr style="display:none;">
    
                                      <td nowrap class="name">ประเภทบริการ</td>
    
                                      <td><select name="sr_ctype" id="sr_ctype">
    
                                          <option value="">กรุณาเลือก</option>
    
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
    
                                        </select></td>
    
                                    </tr>
    
                                    <tr style="display:none;">
    
                                      <td nowrap class="name">ประเภทลูกค้า</td>
    
                                      <td><select name="ctype2" id="ctype2" class="inputselect">
    
                                          <option value="">กรุณาเลือก</option>
    
                                          <?php
    
                                          $quccustommer = @mysqli_query($conn, "SELECT * FROM s_group_custommer ORDER BY group_name ASC");
    
                                          while ($row_cgcus = @mysqli_fetch_array($quccustommer)) {
    
                                            if (substr($row_cgcus['group_name'], 0, 2) == "SR") {
    
                                          ?>
    
                                              <option value="<?php echo $row_cgcus['group_id']; ?>" <?php if ($ctype == $row_cgcus['group_id']) {
                                                                                                      echo 'selected';
                                                                                                    } ?>><?php echo $row_cgcus['group_name']; ?></option>
    
                                          <?php
    
                                            }
                                          }
    
                                          ?>
    
                                        </select></td>
    
                                    </tr>

                                    <tr>
    
                                      <td nowrap class="name">จากข้อมูล</td>
    
                                      <td><select name="frdata" id="frdata" class="inputselect">
                                          <option value="1">ทั้งหมด</option>
                                          <option value="2">FO เท่านั้น</option>
                                          <option value="3">SV เท่านั้น</option>
                                        </select></td>
                                    </tr>
    
    
                                    <!-- <tr>
    
                                      <td nowrap class="name">ประเภทใบงาน</td>
    
                                      <td><select name="openclose" id="openclose" class="inputselect">
                                          <option value="1">ทั้งหมด</option>
                                          <option value="2">เปิดใบงาน</option>
                                          <option value="3">ปิดใบงาน</option>
                                        </select></td>
    
                                    </tr> -->
    
                                    <tr style="display:none;">
    
                                      <td nowrap class="name">รายการอะไหล่</td>
    
                                      <td>
    
                                        <select id="cpro_ecip" name="cpro">
    
                                          <option value="">กรุณาเลือกรายการ</option>
    
                                          <?php
    
                                          $qu_sparpart = @mysqli_query($conn, "SELECT * FROM s_group_sparpart ORDER BY group_name ASC");
    
                                          while ($row_sparpart = @mysqli_fetch_array($qu_sparpart)) {
    
                                          ?>
    
                                            <option value="<?php echo $row_sparpart['group_id']; ?>"><?php echo $row_sparpart['group_name']; ?></option>
    
                                          <?php
    
                                          }
    
                                          ?>
    
    
    
                                        </select>
    
                                        <a href="javascript:void(0);" onClick="windowOpener('400', '500', '', 'search2.php?protype=cpro_ecip');"><img src="../images/icon2/mark_f2.png" width="25" height="25" border="0" alt="" style="vertical-align:middle;padding-left:5px;"></a></td>
    
                                    </tr>
    
                                    <tr style="display:none;">
    
                                      <td nowrap class="name">&nbsp;</td>
    
                                      <td><span class="name">
    
                                          <input name="otVal" type="radio" value="0" checked>
    
                                          รวมงานทั้งหมด&nbsp;
    
                                          <input name="otVal" type="radio" value="1">
    
                                          เฉพาะงานที่มีโอที / เบี้ยเลี้ยง</span></td>
    
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
    
                                    <tr style="display:none;">
    
                                      <td nowrap class="name">รายการแสดง</td>
    
                                      <td><input name="sh1" type="checkbox" id="sh1" value="1" checked>
    
                                        ชื่อลูกค้า / บริษัท + เบอร์โทร
    
                                        <input name="sh2" type="checkbox" id="sh46" value="1" checked>
    
                                        ชื่อร้าน / สถานที่ติดตั้ง
    
                                        <input name="sh3" type="checkbox" id="sh47" value="1" checked>
    
                                        ประเภทลูกค้า
    
                                        <input name="sh4" type="checkbox" id="sh48" value="1" checked>
    
                                        ประเภทบริการ
    
                                        <input name="sh11" type="checkbox" id="sh46" value="1" checked>
    
                                        โอที / เบี้ยเลี้ยง<br>
    
                                        <input name="sh5" type="checkbox" id="sh49" value="1" checked>
    
                                        เลขที่ใบบริการ
    
                                        <input name="sh6" type="checkbox" id="sh50" value="1" checked>
    
                                        รุ่นเครื่อง
    
                                        <input name="sh7" type="checkbox" id="sh51" value="1" checked>
    
                                        S/N
    
                                        <input name="sh8" type="checkbox" id="sh52" value="1" checked>
    
                                        รายการอะไหล่
    
                                        <input name="sh9" type="checkbox" id="sh53" value="1" checked>
    
                                        รายละเอียดบริการ
    
                                        <input name="sh10" type="checkbox" id="sh54" value="1" checked>
    
                                        วันที่ให้บริการ
                                        
                                       
                                      </td>
    
                                    </tr>
    
                                    <!-- <tr>
    
                                      <td nowrap class="name">&nbsp;</td>
    
                                      <td>&nbsp;</td>
    
                                    </tr> -->
    
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



      <?php include("../footer.php"); ?>

    </DIV><!-- End #main-content -->

  </DIV>

</BODY>

</HTML>