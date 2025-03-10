<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if ($_POST["cprice1"] != "") {$prpro1 = number_format($_POST["cprice1"],2);}
if ($_POST["cprice2"] != "") {$prpro2 = number_format($_POST["cprice2"],2);}
if ($_POST["cprice3"] != "") {$prpro3 = number_format($_POST["cprice3"],2);}
if ($_POST["cprice4"] != "") {$prpro4 = number_format($_POST["cprice4"],2);}
if ($_POST["cprice5"] != "") {$prpro5 = number_format($_POST["cprice5"],2);}
if ($_POST["cprice6"] != "") {$prpro6 = number_format($_POST["cprice6"],2);}
if ($_POST["cprice7"] != "") {$prpro7 = number_format($_POST["cprice7"],2);}
if ($_POST["cprice8"] != "") {$prpro8 = number_format($_POST["cprice8"],2);}
if ($_POST["cprice9"] != "") {$prpro9 = number_format($_POST["cprice9"],2);}
if ($_POST["cprice10"] != "") {$prpro10 = number_format($_POST["cprice10"],2);}

if ($_POST["pro_pod1"] != "") {$pro_pod1 = " (รุ่น " . $_POST["pro_pod1"] . ")";}
if ($_POST["pro_pod2"] != "") {$pro_pod2 = " (รุ่น " . $_POST["pro_pod2"] . ")";}
if ($_POST["pro_pod3"] != "") {$pro_pod3 = " (รุ่น " . $_POST["pro_pod3"] . ")";}
if ($_POST["pro_pod4"] != "") {$pro_pod4 = " (รุ่น " . $_POST["pro_pod4"] . ")";}
if ($_POST["pro_pod5"] != "") {$pro_pod5 = " (รุ่น " . $_POST["pro_pod5"] . ")";}
if ($_POST["pro_pod6"] != "") {$pro_pod6 = " (รุ่น " . $_POST["pro_pod6"] . ")";}
if ($_POST["pro_pod7"] != "") {$pro_pod7 = " (รุ่น " . $_POST["pro_pod7"] . ")";}
if ($_POST["pro_pod8"] != "") {$pro_pod8 = " (รุ่น " . $_POST["pro_pod8"] . ")";}
if ($_POST["pro_pod9"] != "") {$pro_pod9 = " (รุ่น " . $_POST["pro_pod9"] . ")";}
if ($_POST["pro_pod10"] != "") {$pro_pod10 = " (รุ่น " . $_POST["pro_pod10"] . ")";}

if ($_POST["cs_pro1"] != "") {$profree1 = "1";} else { $profree1 = "&nbsp;";}
if ($_POST["cs_pro2"] != "") {$profree2 = "2";} else { $profree2 = "&nbsp;";}
if ($_POST["cs_pro3"] != "") {$profree3 = "3";} else { $profree3 = "&nbsp;";}
if ($_POST["cs_pro4"] != "") {$profree4 = "4";} else { $profree4 = "&nbsp;";}
if ($_POST["cs_pro5"] != "") {$profree5 = "5";} else { $profree5 = "&nbsp;";}

if ($_POST["cpro1"] != "") {$cpro1 = "1";} else { $cpro1 = "&nbsp;";}
if ($_POST["cpro2"] != "") {$cpro2 = "2";} else { $cpro2 = "&nbsp;";}
if ($_POST["cpro3"] != "") {$cpro3 = "3";} else { $cpro3 = "&nbsp;";}
if ($_POST["cpro4"] != "") {$cpro4 = "4";} else { $cpro4 = "&nbsp;";}
if ($_POST["cpro5"] != "") {$cpro5 = "5";} else { $cpro5 = "&nbsp;";}
if ($_POST["cpro6"] != "") {$cpro6 = "6";} else { $cpro6 = "&nbsp;";}
if ($_POST["cpro7"] != "") {$cpro7 = "7";} else { $cpro7 = "&nbsp;";}
if ($_POST["cpro8"] != "") {$cpro8 = "8";} else { $cpro8 = "&nbsp;";}
if ($_POST["cpro9"] != "") {$cpro9 = "9";} else { $cpro9 = "&nbsp;";}
if ($_POST["cpro10"] != "") {$cpro10 = "10";} else { $cpro10 = "&nbsp;";}


$sale_line = get_technician_tel($conn,$_POST["loc_contact"]);
if(!empty($sale_line)){
  $imgsaleLine =  '<div style="position: absolute;right: 65px;top: 195px;"><img src="https://omega-intranet.com/machinery/qrcode_gen/qrcode2.php?val=https://line.me/ti/p/~'.$sale_line.'" height="60" border="0" /></div>';
}else{
  $imgsaleLine = '';
}

if($pro_img1 != ""){
  $pro_img1s = '<br><img src="../../upload/quotation/'.$pro_img1.'" height="150"  border="0" style="border-radius: 15px;"/>';
}
if($pro_img2 != ""){
  $pro_img2s = '<br><img src="../../upload/quotation/'.$pro_img2.'" height="150" border="0" style="border-radius: 15px;"/>';
}
if($pro_img3 != ""){
  $pro_img3s = '<br><img src="../../upload/quotation/'.$pro_img3.'" height="150"  border="0" style="border-radius: 15px;"/>';
}

if($_POST["type_service"] == '2'){
	$typeS = "เครื่องล้างแก้ว";
}else if($_POST["type_service"] == '3'){
	$typeS = "เครื่องผลิตน้ำแข็ง";
}else if($_POST["type_service"] == '4'){
	$typeS = $_POST["type_service_dsc"];
}
else{
	$typeS = "เครื่องล้างจาน";
}

$addBR = "";

if($_POST['quo_titles'] == '1'){
  if($_POST['type_service'] == '3'){
    $cssHead = 'right: 95px;top: 150px;font-size:12px;';
  }else{
    $cssHead = 'right: 105px;top: 150px;font-size:12px;';
  }
}else if($_POST['quo_titles'] == '2'){
  if($_POST['type_service'] == '3'){
    $cssHead = 'right: 95px;top: 150px;font-size:12px;';
  }else{
    $cssHead = 'right: 105px;top: 150px;font-size:12px;';
  }
}else if($_POST['quo_titles'] == '3'){
  if($_POST['type_service'] == '3'){
    $cssHead = 'right: 77px;top: 150px;font-size:12px;';
  }else{
    $cssHead = 'right: 87px;top: 150px;font-size:12px;';
  }
}else if($_POST['quo_titles'] == '4'){
  $cssHead = 'right: 105px;top: 140px;font-size:12px;';
  $addBR = "<br>";
}else if($_POST['quo_titles'] == '5'){
  if($_POST['type_service'] == '3'){
    $cssHead = 'right: 82px;top: 150px;font-size:12px;';
  }else{
    $cssHead = 'right: 90px;top: 150px;font-size:12px;';
  }
}else{
  if($_POST['type_service'] == '3'){
    $cssHead = 'right: 95px;top: 150px;font-size:12px;';
  }else{
    $cssHead = 'right: 105px;top: 150px;font-size:12px;';
  }
}

$titleHead = '<div style="position: absolute;right: 110px;top: 95px;font-size:16px;font-weight: bold;">ใบเสนอราคา<br>Quotation</div>';
$quo_titles = '<div style="position: absolute;'.$cssHead.'font-weight: bold;text-align: center;">'.getQuotationTitle($_POST['quo_titles'])."/".$addBR.$typeS.'</div>';


// $userCreate = getCreatePaper($conn, $tbl_name, " AND `qu_id`= " . $_POST['qu_id']);
$headerIMG = "../images/form/header-qar.png";

$form = $imgsaleLine.'
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;">
    <img src="'.$headerIMG.'" width="100%" border="0" />
    '.$titleHead.$quo_titles.'
    </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000;">
          <tr>
            <td width="57%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>ชื่อลูกค้า :</strong> ' . $_POST["cd_name"] . '<br /><br />
            <strong>ชื่อร้าน :</strong> ' . $_POST["loc_name"] . '<br />
              <br />
            ที่อยู่ :</strong> ' . $_POST["cd_address"] . '<br />
            <br />
            <strong>โทรศัพท์ :</strong> ' . $_POST["cd_tel"] . '<strong>&nbsp;&nbsp;&nbsp; อีเมล์ :</strong> ' . $_POST["cd_email"] . '<br /><br />
            </td>
            <td width="43%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>วันที่ : </strong> ' . format_date($_POST["date_forder"]) . '<br /><br />
            <strong>เลขที่เสนอราคา : </strong>' . $_POST["fs_id"] . '<br /><br />
            <strong>พนักงานขาย : </strong>'.get_technician_name($conn,$_POST['loc_contact']).'<br /><br />

			<strong>ชื่อผู้ติดต่อ : </strong>' . $_POST["c_contact"] . '<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> ' . $_POST["c_tel"] . '
            <br /><br />
			</td>
          </tr>
</table>
  <p style="font-size:12px;font-weight: normal;"><strong>ทางบริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด มีความยินดีขอเสนอราคา' . $_POST['c_title_detail'] . 'ให้พิจารณา ดังนี้</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;text-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="35%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ราคา</strong></td>
      <td width="15%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ส่วนลด</strong></td>
      <td width="15%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ราคาสุทธิ</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #000;padding:9px 5px;">' . $cpro1 . '</td>
      <td style="border:1px solid #000;text-align:left;padding:9px 5px;">' . get_proname2($conn, $_POST["cpro1"]) . $pro_pod1 . '</td>
      <td style="border:1px solid #000;padding:9px 5px;">' . number_format($_POST["pro_sn1"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($_POST["camount1"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $prpro1 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $totalSub1s . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000;padding:9px 5px;">' . $cpro2 . '</td>
      <td style="border:1px solid #000;text-align:left;padding:9px 5px;">' . get_proname2($conn, $_POST["cpro2"]) . $pro_pod2 . '</td>
      <td style="border:1px solid #000;padding:9px 5px;">' . number_format($_POST["pro_sn2"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($_POST["camount2"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $prpro2 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $totalSub2s . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000;padding:9px 5px;">' . $cpro3 . '</td>
      <td style="border:1px solid #000;text-align:left;padding:9px 5px;">' . get_proname2($conn, $_POST["cpro3"]) . $pro_pod3 . '</td>
      <td style="border:1px solid #000;padding:9px 5px;">' . number_format($_POST["pro_sn3"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($_POST["camount3"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $prpro3 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $totalSub3s . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000;padding:9px 5px;">' . $cpro4 . '</td>
      <td style="border:1px solid #000;text-align:left;padding:9px 5px;">' . get_proname2($conn, $_POST["cpro4"]) . $pro_pod4 . '</td>
      <td style="border:1px solid #000;padding:9px 5px;">' . number_format($_POST["pro_sn4"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($_POST["camount4"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $prpro4 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $totalSub4s . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000;padding:9px 5px;">' . $cpro5 . '</td>
      <td style="border:1px solid #000;text-align:left;padding:9px 5px;">' . get_proname2($conn, $_POST["cpro5"]) . $pro_pod5 . '</td>
      <td style="border:1px solid #000;padding:9px 5px;">' . number_format($_POST["pro_sn5"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($_POST["camount5"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $prpro5 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $totalSub5s . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000;padding:9px 5px;">' . $cpro6 . '</td>
      <td style="border:1px solid #000;text-align:left;padding:9px 5px;">' . get_proname2($conn, $_POST["cpro6"]) . $pro_pod6 . '</td>
      <td style="border:1px solid #000;padding:9px 5px;">' . number_format($_POST["pro_sn6"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($_POST["camount6"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $prpro6 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $totalSub6s . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000;padding:9px 5px;">' . $cpro7 . '</td>
      <td style="border:1px solid #000;text-align:left;padding:9px 5px;">' . get_proname2($conn, $_POST["cpro7"]) . $pro_pod7 . '</td>
      <td style="border:1px solid #000;padding:9px 5px;">' . number_format($_POST["pro_sn7"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($_POST["camount7"],2) . '</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $prpro7 . '&nbsp;&nbsp;</td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . $totalSub7s . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border:1px solid #000;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($sumprice, 2) . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border:1px solid #000;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($sumpricevat, 2) . '&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:center;border:0px solid #000;padding:9px 5px;background-color: #ddebf7;"><strong>' . baht_text($sumtotals) . '</strong></td>
      <td style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border:1px solid #000;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">' . number_format($sumtotals, 2) . '&nbsp;&nbsp;</td>
    </tr>
</table><br>';

if(!empty($_POST["remark"])){
  $form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
  <tr>
    <td style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:15px;"><strong>หมายเหตุ : </strong>' . $_POST["remark"] . '</td>
  </tr>
</table><br><br><br><br><br><br><br><br><br><br><br><br>';
$form .='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" />
    '.$titleHead.$quo_titles.'
    </td>
  </tr>
  </table>';
}

$form .= '<p style="font-size:12px;"><strong><u>เงื่อนไขการขาย / การชำระเงิน</u></strong></p>';

$form .= '
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="" >
  <tr>
    <td style="border:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif; line-height: 20px;width: 60%;">
      <div style="font-size:11px;">
      <p style="font-size:11px;">1. การชำระเงิน '.$_POST['paycon1'].'</p>
      <br>
      <p><strong>เงื่อนไขการขาย</strong></p><br>
      <p style="font-size:11px;">1. ราคาดังกล่าวข้างต้น ' . $_POST['pay1'] . ' ภาษีมูลค่าเพิ่ม ' . $_POST['pay2'] . ' ตามที่สรรพากรกำหนดเรียบร้อยแล้ว</p><br>
      <p style="font-size:11px;">2. กำหนดยืนราคา ' . $_POST['giveprice'] . ' วัน นับตั้งแต่วันที่อนุมัติใบเสนอราคา หรือ PO สั่งซื้อบริการดังกล่าวข้างต้น</p><br>
      <p style="font-size:11px;">3. ทางบริษัทฯ ขอสงวนสิทธ์ในกรณีที่ลูกค้าเช็นต์อนุมัติใบเสนอราคาแล้วนั้น หากมีการยกเลิกสัญญา หรือ การเปลี่ยนแปลงใดๆเกิดขึ้นระหว่างดำเนินการ ทางลูกค้าต้องเป็นผู้รับผิดชอบต่อความเสียหายและค่าใช้จ่ายที่เกิดขึ้น</p>
      </div>
    </td>
    <td style="text-align: center;border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:10px;width: 40%;">
    <p style="font-size:11px;"><u>บัญชีธนาคาร : สำหรับโอนเงินชำระค่าสินค้า</u></p><br>
    <span style="color: #018022;font-weight: bold;">
    ธนาคารกสิกร : สาขา สุขาภิบาล 5<br>
    บัญชีออมทรัพย์ : บจก.โอเมก้าแมชชีนเนอรี่ (1999)<br>
    เลขที่บัญชี : 026-1-810689</span><br><br>
    <span style="color: #4b2b7e;font-weight: bold;">ธนาคารไทยพาณิชย์ : สาขา โชคชัย 4 5<br>
    บัญชีออมทรัพย์ : บจก.โอเมก้าแมชชีนเนอรี่ (1999)<br>
    เลขที่บัญชี : 127-2-27409-1
    </span>
    </td>
  </tr>
</table>
<p style="font-size:11px;font-family:Verdana, Geneva, sans-serif;">จึงเรียนมาเพื่อโปรดพิจารณา และทางบริษัท ฯ หวังเป็นอย่างยิ่งว่าจะได้รับการพิจารณาจากท่าน<br></p>
<br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><br><br><br></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติสั่งซื้อสินค้าตามรายการข้างต้น</strong></td>
              </tr>
              <tr>
                <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <br><br><strong>วันที่ __________________________</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        
        </td>
        <td width="33%" style="border:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;position: relative;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:0px solid #000;padding-bottom:10px;font-size:13px;font-family:Verdana, Geneva, sans-serif;text-align:center;">ขอแสดงความนับถือ</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/' . get_technician_signature($conn, $_POST['cs_technic']) . '" width="130" border="0" /></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>(' . get_technician_name($conn, $_POST['cs_technic']) . ')</strong><br><br>
              <strong>(' . get_technician_tel($conn, $_POST['cs_technic']) . ')</strong>
			  </td>
              </tr>
            </table>
        </td>
      </tr>
    </table><br><br><br>
  ';

  if($pro_img1s == ""){
    $form .= '';
  }else{
    $form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;">
      <tr>
          <th width="33%"><strong style="font-size:13px;">รูปภาพประกอบที่ 1</strong></th>
          <th width="33%"><strong style="font-size:13px;">รูปภาพประกอบที่ 2</strong></th>
          <th width="33%"><strong style="font-size:13px;">รูปภาพประกอบที่ 3</strong></th>
      </tr>
      <tr>
        <th width="33%" style="text-align:center;padding:10px;">'.$pro_img1s.'</th>
        <th width="33%" style="text-align:center;padding:10px">'.$pro_img2s.'</th>
        <th width="33%" style="text-align:center;padding:10px">'.$pro_img3s.'</th>
    </tr>
     </table><br><br><br><br><br>';
  }
?>
