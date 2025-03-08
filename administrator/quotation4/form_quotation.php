<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if($_POST["cprice1"] != ""){$prpro1 = number_format($_POST["cprice1"]);}
if($_POST["cprice2"] != ""){$prpro2 = number_format($_POST["cprice2"]);}
if($_POST["cprice3"] != ""){$prpro3 = number_format($_POST["cprice3"]);}
if($_POST["cprice4"] != ""){$prpro4 = number_format($_POST["cprice4"]);}
if($_POST["cprice5"] != ""){$prpro5 = number_format($_POST["cprice5"]);}
if($_POST["cprice6"] != ""){$prpro6 = number_format($_POST["cprice6"]);}
if($_POST["cprice7"] != ""){$prpro7 = number_format($_POST["cprice7"]);}


if($_POST["pro_pod1"] != ""){$pro_pod1 = " (รุ่น ".$_POST["pro_pod1"].")";}
if($_POST["pro_pod2"] != ""){$pro_pod2 = " (รุ่น ".$_POST["pro_pod2"].")";}
if($_POST["pro_pod3"] != ""){$pro_pod3 = " (รุ่น ".$_POST["pro_pod3"].")";}
if($_POST["pro_pod4"] != ""){$pro_pod4 = " (รุ่น ".$_POST["pro_pod4"].")";}
if($_POST["pro_pod5"] != ""){$pro_pod5 = " (รุ่น ".$_POST["pro_pod5"].")";}
if($_POST["pro_pod6"] != ""){$pro_pod6 = " (รุ่น ".$_POST["pro_pod6"].")";}
if($_POST["pro_pod7"] != ""){$pro_pod7 = " (รุ่น ".$_POST["pro_pod7"].")";}


if($_POST["cs_pro1"] != ""){$profree1 = "1";}else{$profree1 = "&nbsp;";}
if($_POST["cs_pro2"] != ""){$profree2 = "2";}else{$profree2 = "&nbsp;";}
if($_POST["cs_pro3"] != ""){$profree3 = "3";}else{$profree3 = "&nbsp;";}
if($_POST["cs_pro4"] != ""){$profree4 = "4";}else{$profree4 = "&nbsp;";}
if($_POST["cs_pro5"] != ""){$profree5 = "5";}else{$profree5 = "&nbsp;";}

if($_POST["cpro1"] != ""){$cpro1 = "1";}else{$cpro1 = "&nbsp;";}
if($_POST["cpro2"] != ""){$cpro2 = "2";}else{$cpro2 = "&nbsp;";}
if($_POST["cpro3"] != ""){$cpro3 = "3";}else{$cpro3 = "&nbsp;";}
if($_POST["cpro4"] != ""){$cpro4 = "4";}else{$cpro4 = "&nbsp;";}
if($_POST["cpro5"] != ""){$cpro5 = "5";}else{$cpro5 = "&nbsp;";}
if($_POST["cpro6"] != ""){$cpro6 = "6";}else{$cpro6 = "&nbsp;";}
if($_POST["cpro7"] != ""){$cpro7 = "7";}else{$cpro7 = "&nbsp;";}


if($_POST["type_service"] == '2'){
	$typeS = "เครื่องล้างแก้ว";
}else if($_POST["type_service"] == '3'){
	$typeS = "เครื่องผลิตน้ำแข็ง";
}else if($_POST["type_service"] == '4'){
	$typeS = "อื่นๆ ระบุ :". $_POST["type_service_dsc"];
}
else{
	$typeS = "เครื่องล้างจาน";
}

$typeS1 = $typeS . " " . getTypeMCSize($_POST["chk_mac_size1"],$_POST["type_service"]);
$typeS2 = $typeS . " " . getTypeMCSize($_POST["chk_mac_size2"],$_POST["type_service"]);

$sale_line = get_technician_tel($conn,$_POST["loc_contact"]);
if(!empty($sale_line)){
  $imgsaleLine =  '<div style="position: absolute;right: 65px;top: 210px;"><img src="https://omega-intranet.com/machinery/qrcode_gen/qrcode2.php?val=https://line.me/ti/p/~'.$sale_line.'" height="60" border="0" /></div>';
}else{
  $imgsaleLine = '';
}

$sumprice = $_POST["camount1"] + $_POST["camount2"];
$sumpricevat = $sumprice * 0.07;
$sumtotals = $sumprice + $sumpricevat;


if($pro_img1 != ""){
  $pro_img1s = '<br><img src="../../upload/quotation/'.$pro_img1.'" height="150"  border="0" style="border-radius: 15px;"/>';
}
if($pro_img2 != ""){
  $pro_img2s = '<br><img src="../../upload/quotation/'.$pro_img2.'" height="150" border="0" style="border-radius: 15px;"/>';
}

//$userCreate = getCreatePaper($conn, $tbl_name, " AND `qu_id`= " . $_POST['qu_id']);
$headerIMG = "../images/form/header-qarc.png";

$form = $imgsaleLine.'
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000;">
          <tr>
            <td width="57%" valign="top" style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<br /><br />
            <strong>ชื่อร้าน :</strong> '.$_POST["loc_name"].'<br /><br />
            <strong>ที่อยู่ :</strong> '.$_POST["cd_address"].'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp; อีเมล์ :</strong> '.$_POST["cd_email"].'<br /><br />
            </td>
            <td width="43%" valign="top" style="font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>วันที่ : </strong> '.format_date($_POST["date_forder"]).'<br /><br />
            <strong>เลขที่เสนอราคา : </strong>'.$_POST["fs_id"].'<br /><br />
            <strong>พนักงานขาย : </strong>'.get_technician_name($conn,$_POST['loc_contact']).'<br /><br />
			<strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' 
            <br /><br />
			</td>
          </tr>
</table>
  <p style="font-size:12px;"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด มีความยินดีขอเสนอราคาสัญญาบริการรายปี  สำหรับ'.$typeS.' <br>
  จึงขอเสนอราคา โดยมีรายละเอียดดังนี้<br><br></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;text-align:center;">
    <tr>
      <td width="5%" style="border:1px solid #000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="35%" style="border:1px solid #000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>รายการสินค้า</strong></td>
      <td width="10%" style="border:1px solid #000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border:1px solid #000;font-size:12px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ราคา</strong></td>
    </tr>';
	
	if($_POST['chkserv1'] == '1'){
		$form .= '<tr>
		  <td style="border:1px solid #000;padding:9px 5px;vertical-align: top;">1<br><br>
		  <img src="../images/checkbox-unchecked-hi.png" width="25"></td>
		  <td style="border:1px solid #000;text-align:left;padding:9px 5px;">
		  <p><strong>สัญญาบริการรายปี สำหรับ'.$typeS1.' <u>แบบรวมอะไหล่</u></strong><br><br></p>
		  <p><strong>1.1 '.$typeS1.'</strong>  <br><br></p>
		  <p style="line-height: 50px;">'.$_POST["cpro1"].'</p>
		  </td>
		  <td style="border:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn1"],2).'</td>
		  <td style="border:1px solid #000;padding:9px 5px;text-align:center;">'.number_format($_POST["camount1"],2).'</td>
		</tr>';
	}else{
		if($_POST['chkserv2'] == '1'){
			$form .= '<tr>
			  <td style="border:1px solid #000;padding:9px 5px;vertical-align: top;">1<br><br>
			  <img src="../images/checkbox-unchecked-hi.png" width="25"></td>
			  <td style="border:1px solid #000;text-align:left;padding:9px 5px;">
			  <p><strong>สัญญาบริการรายปี สำหรับ'.$typeS2.' <u>แบบไม่รวมอะไหล่</u></strong><br><br></p>
			  <p><strong>1.1 '.$typeS2.'</strong><br><br></p>
			  <p style="line-height: 50px;">'.$_POST["cpro2"].'</p>
			  </td>
			  <td style="border:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn2"],2).'</td>
			  <td style="border:1px solid #000;padding:9px 5px;text-align:center;">'.number_format($_POST["camount2"],2).'</td>
			</tr>';
		}
	}
    
	if($_POST['chkserv2'] == '1' && $_POST['chkserv1'] == '1'){
		$form .= '<tr>
		  <td style="border:1px solid #000;padding:9px 5px;vertical-align: top;">2<br><br>
		  <img src="../images/checkbox-unchecked-hi.png" width="25"></td>
		  <td style="border:1px solid #000;text-align:left;padding:9px 5px;">
		  <p><strong>สัญญาบริการรายปี สำหรับ'.$typeS2.' <u>แบบไม่รวมอะไหล่</u></strong><br><br></p>
		  <p><strong>2.1 '.$typeS2.'</strong><br><br></p>
		  <p style="line-height: 50px;">'.$_POST["cpro2"].'</p>
		  </td>
		  <td style="border:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn2"],2).'</td>
		  <td style="border:1px solid #000;padding:9px 5px;text-align:center;">'.number_format($_POST["camount2"],2).'</td>
		</tr>';
	}
  
$form .= '<tr>
      <td colspan="2" style="border-top:1px solid #000;padding:9px 5px;"></td>
      <td style="border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($sumprice,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($sumpricevat,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center;border:0px solid #000;padding:9px 5px;background-color: #ddebf7;"><strong>'.baht_text($sumtotals).'</strong></td>
      <td style="border:1px solid #000;border-right:0px solid #000;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($sumtotals,2).'&nbsp;&nbsp;</td>
    </tr>';

$form .= '</table><br><br>';


if($pro_img1s == ""){
  
}else{
  $form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:12px;">
    <tr>
        <th width="50%" style=""><strong>รูปภาพประกอบที่ 1</strong></th>
        <th width="50%" style=""><strong>รูปภาพประกอบที่ 2</strong></th>
    </tr>
    <tr>
      <th width="50%" style="text-align:center;padding:10px;">'.$pro_img1s.'</th>
      <th width="50%" style="text-align:center;padding:10px">'.$pro_img2s.'</th>
  </tr>
   </table><br><br><br><br><br><br><br><br><br><br><br>';
}

if(!empty($_POST["remark"])){
  $form .='
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
  <tr>
    <td style="border:0px solid #000;font-size:13px;"><strong>หมายเหตุ : </strong>'.$_POST["remark"].'</td>
  </tr>
</table><br>';
}


$form .= '
  <p style="font-size:12px;">
   <strong><u>เงื่อนไขการชำระเงิน</u></strong>
   <p style="font-size:12px;">1. '.$_POST["pay1"].'</p>
   <p style="font-size:12px;">2. บัญชีสำหรับโอนเงิน ชำระสินค้า<br>
   <strong>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green;">ธนาคารกสิกรไทย : สาขาสุขาภิบาล 5</span> <br>
   &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green;">บัญชีออมทรัพย์ : บจก.โอเมก้า แมชชีนเนอรี่ (1999) จำกัด</span> <br>
   &nbsp;&nbsp;&nbsp;&nbsp;<span style="color: green;">หมายเลขบัญชี : 026-1-8110689</span></strong>
   </p>
  </p>
  <p style="font-size:12px;"><strong><u>เงื่อนไขการขาย</u></strong></p>';
  
  $form .='
  <p style="font-size:12px;">1. ราคาดังกล่าวข้างต้น '.$_POST['pay2'].' ภาษีมูลค่าเพิ่ม '.$_POST['pay3'].'</p>
  <p style="font-size:12px;">2. กำหนดส่งสัญญาภายใน '.$_POST['giveprice'].' วัน นับตั้งแต่วันอนุมัติทำสัญญา</p>
  <p style="font-size:12px;">3. ภายใต้เงื่อนไขการทำสัญญาบริการ ทางบริษัทโอเมก้าฯ ขอสงวนลิขสิทธิ์ให้ลูกค้าใช้น้ำยาของทางบริษัทโอเมก้าฯเท่านั้น</p>
  <p style="font-size:12px;">4. กำหนดยี่ห้อสินค้า '.$_POST['pay4'].' วัน</p>
  <p style="font-size:12px;">5. ทางบริษัทฯ ขอสงวนสิทธิ์ในกรณีที่ลูกค้าเซ็นอนุมัติใบเสนอราคาแล้วนั้น หากมีการยกเลิกสัญญา หรือ การเปลี่ยนแปลงใดๆเกิดขึ้นระหว่างดำเนินการ ทางลูกค้าต้องเป็นผู้รับผิดชอบต่อความเสียหายและค่าใช้จ่ายที่เกิดขึ้น</p>
  <p style="font-size:12px;">จึงเรียนมาเพื่อโปรดพิจารณา และทางบริษัท ฯ หวังเป็นอย่างยิ่งว่าจะได้รับการพิจารณาจากท่าน</p><br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><br><br><br></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>อนุมัติสั่งซื้อสินค้าตามรายการข้างต้น</strong></td>
              </tr>
              <tr>
                <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <br><br><strong>วันที่ __________________________</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:0px solid #000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	
        </td>
        <td width="33%" style="border:0px solid #000;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:0px solid #000;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">ขอแสดงความนับถือ</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/'.get_technician_signature($conn,$_POST['cs_technic']).'" width="130" border="0" /></td>
              </tr>
              <tr>
              <td style="font-size:12px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>('.get_technician_name($conn,$_POST['cs_technic']).')</strong><br><br>
              <strong>(' . get_technician_tel($conn, $_POST['cs_technic']) . ')</strong>
			  </td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
  ';
?>
