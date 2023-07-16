<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if($_POST["cprice1"] != ""){$prpro1 = number_format($_POST["cprice1"],2);}
if($_POST["cprice2"] != ""){$prpro2 = number_format($_POST["cprice2"],2);}
if($_POST["cprice3"] != ""){$prpro3 = number_format($_POST["cprice3"],2);}
if($_POST["cprice4"] != ""){$prpro4 = number_format($_POST["cprice4"],2);}
if($_POST["cprice5"] != ""){$prpro5 = number_format($_POST["cprice5"],2);}
if($_POST["cprice6"] != ""){$prpro6 = number_format($_POST["cprice6"],2);}
if($_POST["cprice7"] != ""){$prpro7 = number_format($_POST["cprice7"],2);}



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


if($_REQUEST['notvat1'] == 2){$money_garuntree = $_REQUEST["money_garuntree"] + (($_REQUEST["money_garuntree"] * 7 ) / 100);}else{$money_garuntree = $_REQUEST["money_garuntree"];}
if($_REQUEST['notvat2'] == 2){$money_setup = $_REQUEST["money_setup"]+ (($_REQUEST["money_setup"] * 7 ) / 100);}else{$money_setup = $_REQUEST["money_setup"];}

//break;
if($_POST["loc_clean"] != ""){$loc_clean = $_POST["loc_clean"];}else{$loc_clean = " - ";}
if($_POST["loc_clean_sn"] != ""){$loc_clean_sn = $_POST["loc_clean_sn"];}else{$loc_clean_sn = " - ";}
if($_POST["warter01"] != ""){$warter01 = number_format($_POST["warter01"]);}else{$warter01 = " - ";}
if($_POST["warter02"] != ""){$warter02 = number_format($_POST["warter02"]);}else{$warter02 = " - ";}
if($_POST["warter03"] != ""){$warter03 = number_format($_POST["warter03"]);}else{$warter03 = " - ";}
if($_POST["warter04"] != ""){$warter04 = number_format($_POST["warter04"]);}else{$warter04 = " - ";}
if($_POST["warter05"] != ""){$warter05 = number_format($_POST["warter05"]);}else{$warter05 = " - ";}
if($_POST["warter06"] != ""){$warter06 = number_format($_POST["warter06"]);}else{$warter06 = " - ";}
if($_POST["warter07"] != ""){$warter07 = number_format($_POST["warter07"]);}else{$warter07 = " - ";}

if($_POST['type_service'] == 6){
  $checkService = 1;
}else if($_POST['type_service'] == 1 || $_POST['type_service'] == 31){
  $checkService = 2;
}else if($_POST['type_service'] == 2){
  $checkService = 3;
}else if($_POST['type_service'] == 3){
  $checkService = 4;
}

$sale_line = getsaleline($conn,$_POST["cs_sell2"]);
if(!empty($sale_line)){
  $imgsaleLine =  '<div style="position: absolute;right: 65px;top: 260px;"><img src="https://omega-intranet.com/machinery/qrcode_gen/qrcode2.php?val=https://line.me/ti/p/~'.$sale_line.'" height="60" border="0" /></div>';
}else{
  $imgsaleLine = '';
}

if($_POST['paym3'] != "" && $_POST['paym3'] != "0"){
  $paym3g = '&nbsp;&nbsp;&nbsp;เครดิต '.$_POST['paym3'].' วัน';
}else{
  $paym3g = '';
}

$chkProcess = checkProcess($conn,$tbl_name,$PK_field,$id);

$saleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['cs_sell']).'" height="50" border="0" />';

if($chkProcess == '5'){
	
	$hSaleSignature = '<img src="../../upload/user/signature/'.get_hsale_signature($conn).'" height="50" border="0" />';
	
}else{
	
	if($chkProcess == '0'){
		$hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
	}else{
		
		$chkHSaleAP = checkHSaleApplove($conn,$tbl_name,$id);
		
		if($chkHSaleAP == 1){
			$hSaleSignature = '<img src="../../upload/user/signature/'.get_hsale_signature($conn).'" height="50" border="0" />';
		}else{
			$hSaleSignature = '<img src="../../upload/user/signature/none.png" height="50" border="0" />';
		}
		
	}

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

//<img src="../../upload/quotation/'.$pro_img1.'" width="30%"  border="0" />

//$userCreate = getCreatePaper($conn, $tbl_name, " AND `qu_id`=" . $_POST['qu_id']);
$headerIMG = "../images/form/header-qab.png";

$form = $imgsaleLine.'
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000;">
          <tr>
            <td width="57%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<br />
              <br /> 
              <strong>ชื่อร้าน :</strong> '.$_POST["customer_name"].'<br />
              <br />
              <strong>ที่อยู่ :</strong> '.$_POST["cd_address"].'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;อีเมล์ :</strong> '.$_POST["cd_fax"].'<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' </td>
            <td width="43%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">
            <strong>วันที่ :</strong> '.format_date($_POST["date_forder"]).'<br /><br />
            <strong>เลขที่เสนอราคา :</strong>'.$_POST["fs_id"].'<br /><br />
            <strong>ประเภทสินค้า :</strong> '.protype_name($conn,$_POST["pro_type"]).'<br /><br />
            <strong>พนักงานขาย :</strong> '.getsalename($conn,$_POST["cs_sell2"]).'<br/><br />
            <strong>เบอร์โทร :</strong> '.getsaletel($conn,$_POST["cs_sell2"]).'<br/><br />
            
			</td>
          </tr>
</table>
<p style="font-size:12px;"><strong>ทางบริษัท โอเมก้า แมชชีนเนอรี่ (1999) จำกัด ขอบคุณที่ท่านได้มอบความไว้วางใจ ให้นำเสนอราคาสินค้าและบริการเพื่อพิจารณาดังต่อไปนี้</strong></p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;text-align:center;">
    <tr>
      <td width="5%" style="border-top:1px solid #000;border-top:1px solid #000;border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="35%" style="border-top:1px solid #000;border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border-top:1px solid #000;border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="10%" style="border-top:1px solid #000;border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ราคา</strong></td>
      <td width="15%" style="border-top:1px solid #000;border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ส่วนลด</strong></td>
      <td width="15%" style="border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ราคาสุทธิ</strong></td>
    </tr>
    <tr>
      <td style="border-top:1px solid #000;border-left:1px solid #000;padding:9px 5px;">'.$cpro1.'</td>
      <td style="border-top:1px solid #000;border-left:1px solid #000;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro1"]).$pro_pod1.'</td>
      <td style="border-top:1px solid #000;border-left:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn1"],2).'</td>
      <td style="border-top:1px solid #000;border-left:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($_POST["camount1"],2).'</td>
      <td style="border-top:1px solid #000;border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$prpro1.'&nbsp;&nbsp;</td>
      <td style="border-top:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$totalSub1s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.$cpro2.'</td>
      <td style="border-left:1px solid #000;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro2"]).$pro_pod2.'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn2"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($_POST["camount2"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$prpro2.'&nbsp;&nbsp;</td>
      <td style="border-left:1px solid #000;border-right:1px solid #000;padding:9px 5px;text-align:right;">'.$totalSub2s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.$cpro3.'</td>
      <td style="border-left:1px solid #000;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro3"]).$pro_pod3.'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn3"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($_POST["camount3"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$prpro3.'&nbsp;&nbsp;</td>
      <td style="border-left:1px solid #000;border-right:1px solid #000;padding:9px 5px;text-align:right;">'.$totalSub3s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.$cpro4.'</td>
      <td style="border-left:1px solid #000;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro4"]).$pro_pod4.'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn4"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($_POST["camount4"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$prpro4.'&nbsp;&nbsp;</td>
      <td style="border-left:1px solid #000;border-right:1px solid #000;padding:9px 5px;text-align:right;">'.$totalSub4s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.$cpro5.'</td>
      <td style="border-left:1px solid #000;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro5"]).$pro_pod5.'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn5"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($_POST["camount5"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$prpro5.'&nbsp;&nbsp;</td>
      <td style="border-left:1px solid #000;border-right:1px solid #000;padding:9px 5px;text-align:right;">'.$totalSub5s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.$cpro6.'</td>
      <td style="border-left:1px solid #000;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro6"]).$pro_pod6.'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn6"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($_POST["camount6"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$prpro6.'&nbsp;&nbsp;</td>
      <td style="border-left:1px solid #000;border-right:1px solid #000;padding:9px 5px;text-align:right;">'.$totalSub6s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.$cpro7.'</td>
      <td style="border-left:1px solid #000;text-align:left;padding:9px 5px;">'.get_proname($conn,$_POST["cpro7"]).$pro_pod7.'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;">'.number_format($_POST["pro_sn7"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($_POST["camount7"],2).'</td>
      <td style="border-left:1px solid #000;padding:9px 5px;text-align:right;">'.$prpro7.'&nbsp;&nbsp;</td>
      <td style="border-left:1px solid #000;border-right:1px solid #000;padding:9px 5px;text-align:right;">'.$totalSub7s.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border-top:1px solid #000;padding:9px 5px;"></td>
      <td style="border-top:1px solid #000;padding:9px 5px;"></td>
      <td style="border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;"><strong>รวมทั้งหมด</strong></td>
      <td style="border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($sumprice,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;"><strong>VAT 7 %</strong></td>
      <td style="border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($sumpricevat,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:center;border:0px solid #000;padding:9px 5px;background-color: #ddebf7;"><strong>'.baht_text($sumtotals).'</strong></td>
      <td style="border:0px solid #000;padding:9px 5px;"></td>
      <td style="border:1px solid #000;border-right:0px solid #000;padding:9px 5px;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #000;padding:9px 5px;text-align:right;">'.number_format($sumtotals,2).'&nbsp;&nbsp;</td>
    </tr>
</table><br><br>';

if($pro_img1s == ""){
  $form .= '<br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
}else{
  $form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;">
    <tr>
        <th width="33%" style=""><strong>รูปภาพประกอบที่ 1</strong></th>
        <th width="33%" style=""><strong>รูปภาพประกอบที่ 2</strong></th>
        <th width="33%" style=""><strong>รูปภาพประกอบที่ 3</strong></th>
    </tr>
    <tr>
      <th width="33%" style="text-align:center;padding:10px;">'.$pro_img1s.'</th>
      <th width="33%" style="text-align:center;padding:10px">'.$pro_img2s.'</th>
      <th width="33%" style="text-align:center;padding:10px">'.$pro_img3s.'</th>
  </tr>
   </table><br><br><br><br><br>';
}

$form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-bottom:5px;"><img src="'.$headerIMG.'" width="100%" border="0" /></td>
    </tr>
  </table><br>
<p style="font-size:12px;"><strong><u>รายการของแถม</u></strong></p>
   <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:11px;">
    <tr>
        <th width="10%" style="border:1px solid #000;border-right:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>ลำดับ</strong></th>
        <th width="75%" style="border:1px solid #000;border-right:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>รายการสินค้า</strong></th>
        <th width="15%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;"><strong>จำนวน</strong></th>
    </tr>
    <tr>
      <td style="border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree1.'</td>
      <td style="border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro1"].'</td>
      <td style="border-left:1px solid #000;border-right:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount1"].'</td>
    </tr>
    <tr>
      <td style="border:1px solid #000;border-top:0px solid #000;border-right:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree2.'</td>
      <td style="border:1px solid #000;border-top:0px solid #000;border-right:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro2"].'</td>
      <td style="border:1px solid #000;border-top:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount2"].'</td>
    </tr>';
    // <tr>
    //   <td style="border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree3.'</td>
    //   <td style="border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro3"].'</td>
    //   <td style="border-left:1px solid #000;border-right:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount3"].'</td>
    // </tr>
    // <tr>
    //   <td style="border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree4.'</td>
    //   <td style="border-left:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro4"].'</td>
    //   <td style="border-left:1px solid #000;border-right:1px solid #000;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount4"].'</td>
    // </tr>
    // <tr>
    //   <td style="border:1px solid #000;border-top:0px solid #000;border-right:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$profree5.'</td>
    //   <td style="border:1px solid #000;border-top:0px solid #000;border-right:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;">'.$_POST["cs_pro5"].'</td>
    //   <td style="border:1px solid #000;border-top:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:9px 5px;text-align:center;">'.$_POST["cs_amount5"].'</td>
    // </tr>
    $form .= '</table><br>';

  if(!empty($_POST["remark"])){
    $form .='
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1" >
    <tr>
      <td style="border:0px solid #000;font-size:12px;"><strong>หมายเหตุ : </strong>'.$_POST["remark"].'</td>
    </tr>
  </table><br>';
  }

  $form .='<p style="font-size:12px;"><strong><u>เงื่อนไขการชำระเงิน</u></strong></p>
  <p style="font-size:12px;">1. '.$_POST['paycon1'].'</p>
  <p style="font-size:12px;">2. บัญชีสำหรับโอนเงิน ชำระค่าสินค้า <br>
  &nbsp;&nbsp;&nbsp;&nbsp;ธนาคารกสิกรไทย : สาขาสุขาภิบาล 5<br>
  &nbsp;&nbsp;&nbsp;&nbsp;บัญชีออมทรัพย์ : บจก.โอเมก้า แมชชีนเนอรี่ (1999)<br>
  &nbsp;&nbsp;&nbsp;&nbsp;เลขที่บัญชี : 026-1-810689</p>
  <p style="font-size:12px;"><strong><u>เงื่อนไขการรับประกันและการส่งสินค้า</u></strong></p>

  <p style="font-size:12px;">1. ราคาดังกล่าวข้างต้น '.$_POST['paycon2'].' ภาษีมูลค่าเพิ่ม '.$_POST['paycon3'].' ตามที่สรรพากรกำหนดเรียบร้อยแล้ว</p>
  <p style="font-size:12px;">2. การรับประกันสินค้า : '.$_POST['paycon4'].'</p>
  <p style="font-size:12px;">3. จัดส่งสินค้าภายใน '.$_POST['guaran2'].' วัน '.$_POST['paycon5'].'</p>';

  if($_POST['type_electric'] != "no"){
	  $form .='<p style="font-size:12px;">4. ลูกค้าเป็นผู้ตรียมระบบไฟฟ้า '.$_POST['type_electric'].' '.$_POST['paycon5'].'</p>
    <p style="font-size:12px;">5. กำหนดยืนราคา '.$_POST['giveprice'].' วัน</p>
    <p style="font-size:12px;">6. ทางบริษัทฯ ขอสงวนสิทธ์ในกรณีที่ลูกค้าเช็นอนุมัติใบเสนอราคาแล้วนั้น หากมีการยกเลิกสัญญา หรือ การเปลี่ยนแปลงใดๆเกิดขึ้นระหว่าง ดำเนินการ ทางลูกค้าต้องเป็นผู้รับผิดชอบต่อความเสียหายและค่าใช้จ่ายที่เกิดขึ้น</p>';
  }else{
	   $form .='<p style="font-size:12px;">4. กำหนดยืนราคา '.$_POST['giveprice'].' วัน</p>
     <p style="font-size:12px;">5. ทางบริษัทฯ ขอสงวนสิทธ์ในกรณีที่ลูกค้าเช็นอนุมัติใบเสนอราคาแล้วนั้น หากมีการยกเลิกสัญญา หรือ การเปลี่ยนแปลงใดๆ เกิดขึ้นระหว่าง ดำเนินการ ทางลูกค้าต้องเป็นผู้รับผิดชอบต่อความเสียหายและค่าใช้จ่ายที่เกิดขึ้น</p>';
  }


  $form .='<p style="font-size:12px;"><strong>จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ บริษัทฯหวังเป็นอย่างยิ่งว่าจะได้รับโอกาสให้บริการในเร็ววันนี้<br>ขอแสดงความนับถือ</strong></p>
  ';

 $form .='
  <br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$saleSignature.'</td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >( '.getsalename($conn,$_POST["cs_sell"]).' )</strong><br><br><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
                <strong>เบอร์โทร '.$_POST["tel_sell"].'</strong>
                <br><br><strong>วันที่ '.format_date($_POST["date_sell"]).'</strong></td>
              </tr>
            </table>

        </td>
        <td width="33%" style="border:0px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="border-bottom:1px solid #000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">'.$hSaleSignature.'</td>
            </tr>
            <tr>
              <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.$_POST["cs_hsell"].' )</strong><br><br><strong>ผู้จัดการฝ่ายขาย</strong></td>
            </tr>
            <tr>
            <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
            <strong>เบอร์โทร '.$_POST["tel_hsell"].'</strong>
            <br><br>
            <strong>วันที่ '.format_date($_POST["date_hsell"]).'</strong></td>
            </tr>
          </table>
      </td>
        <td width="33%" style="border:1px solid #000;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><img src="../../upload/user/signature/none.png" height="50" border="0" /></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>( '.$_POST["cs_account"].' )</strong><br><br><strong>ผู้อนุมัติสั่งซื้อสินค้า</strong></td>
              </tr>
              <tr>
              <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
              <strong>เบอร์โทร '.$_POST["tel_account"].'</strong>
              <br><br>
              <strong>วันที่ '.format_date($_POST["date_account"]).'</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table>
  ';
?>
