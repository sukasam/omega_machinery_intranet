<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  

if($_POST["cprice1"] != ""){$prpro1 = number_format($_POST["cprice1"],2);}
if($_POST["cprice2"] != ""){$prpro2 = number_format($_POST["cprice2"],2);}
if($_POST["cprice3"] != ""){$prpro3 = number_format($_POST["cprice3"],2);}
if($_POST["cprice4"] != ""){$prpro4 = number_format($_POST["cprice4"],2);}
if($_POST["cprice5"] != ""){$prpro5 = number_format($_POST["cprice5"],2);}
if($_POST["cprice6"] != ""){$prpro6 = number_format($_POST["cprice6"],2);}
if($_POST["cprice7"] != ""){$prpro7 = number_format($_POST["cprice7"],2);}


$prspro1 = get_sprice($_POST["cprice1"],$_POST["camount1"]);
$prspro2 = get_sprice($_POST["cprice2"],$_POST["camount2"]);
$prspro3 = get_sprice($_POST["cprice3"],$_POST["camount3"]);
$prspro4 = get_sprice($_POST["cprice4"],$_POST["camount4"]);
$prspro5 = get_sprice($_POST["cprice5"],$_POST["camount5"]);
$prspro6 = get_sprice($_POST["cprice6"],$_POST["camount6"]);
$prspro7 = get_sprice($_POST["cprice7"],$_POST["camount7"]);

$vowels = array(",");

$sumprice  = str_replace($vowels,"",$prspro1) + str_replace($vowels,"",$prspro2) + str_replace($vowels,"",$prspro3) + str_replace($vowels,"",$prspro4) + str_replace($vowels,"",$prspro5) + str_replace($vowels,"",$prspro6) + str_replace($vowels,"",$prspro7);
$sumpricevat = ($sumprice * 7) / 100;
$sumtotal = $sumprice + $sumpricevat;

if($_REQUEST['notvat1'] == 2){$money_garuntree = $_REQUEST["money_garuntree"] + (($_REQUEST["money_garuntree"] * 7 ) / 100);}else{$money_garuntree = $_REQUEST["money_garuntree"];}
if($_REQUEST['notvat2'] == 2){$money_setup = $_REQUEST["money_setup"]+ (($_REQUEST["money_setup"] * 7 ) / 100);}else{$money_setup = $_REQUEST["money_setup"];}

//break;

if($_POST["warter01"] != ""){$warter01 = number_format($_POST["warter01"]);}else{$warter01 = " - ";}
if($_POST["warter02"] != ""){$warter02 = number_format($_POST["warter02"]);}else{$warter02 = " - ";}
if($_POST["warter03"] != ""){$warter03 = number_format($_POST["warter03"]);}else{$warter03 = " - ";}
if($_POST["warter04"] != ""){$warter04 = number_format($_POST["warter04"]);}else{$warter04 = " - ";}
if($_POST["warter05"] != ""){$warter05 = number_format($_POST["warter05"]);}else{$warter05 = " - ";}
if($_POST["warter06"] != ""){$warter06 = number_format($_POST["warter06"]);}else{$warter06 = " - ";}
if($_POST["warter07"] != ""){$warter07 = number_format($_POST["warter07"]);}else{$warter07 = " - ";}
if($_POST["warter08"] != ""){$warter08 = number_format($_POST["warter08"]);}else{$warter08 = " - ";}
if($_POST["warter09"] != ""){$warter09 = number_format($_POST["warter09"]);}else{$warter09 = " - ";}

if($_POST["feeder"] == 1){$feeder = "เครื่องป้อนเกาหลี (".$_POST["feeder_type"].")";}
else if($_POST["feeder"] == 2){$feeder = "เครื่องป้อน DC906 (".$_POST["feeder_type2"].")";}
else{$feeder = "";}

$dataApprove = '';
$dataApprove2 = '';

	if($_POST['cs_sell'] != '0' && $_POST['cs_sell'] != ''){
		if($_POST['sign_date2'] != '0000-00-00' && $_POST['sign_date2'] != ''){
			$dataApprove = format_date($_POST['sign_date2']);
		}else{
			$dataApprove = '';
		}
	}else{
		$dataApprove = '';
  }
  
  $hSaleName = getsalename($conn,$_POST['cs_sell']);
  $hSaleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['cs_sell']).'" height="50" border="0" />';
  

  if($_POST['cs_aceep'] != '0' && $_POST['cs_aceep'] != ''){
		if($_POST['sign_date3'] != '0000-00-00' && $_POST['sign_date3'] != ''){
			$dataApprove2 = format_date($_POST['sign_date3']);
		}else{
			$dataApprove2 = '';
		}
	}else{
		$dataApprove2 = '';
  }
  $hGMSaleName = getsalename($conn,$_POST['cs_aceep']);
  $GMSaleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['cs_aceep']).'" height="50" border="0" />';

  if($_POST["fastwork"] == 1){
    $headImg = '<img src="../images/form/header-first-order1.png" width="100%" border="0" />';
  }else if($_POST["fastwork"] == 2){
    $headImg = '<img src="../images/form/header-first-order2.png" width="100%" border="0" />';
  }else{
    $headImg = '<img src="../images/form/header-first-order.png" width="100%" border="0" />';
  }



if($_POST['kongw_type'] == 1){
  $kongwTypeTxt1 = ' 10 นิ้ว';
}else if($_POST['kongw_type'] == 2){
  $kongwTypeTxt1 = ' 20 นิ้ว';
}else{
  $kongwTypeTxt1 = '';
}

if($_POST['kongw_type2'] == 1){
  $kongwTypeTxt2 = ' 10 นิ้ว';
}else if($_POST['kongw_type2'] == 2){
  $kongwTypeTxt2 = ' 20 นิ้ว';
}else{
  $kongwTypeTxt2 = '';
}



if($_POST['kongw'] == 1){
  $kongwTxt = '<br><br><strong>เครื่องกรองน้ำ</strong> : 3 ขั้นตอน '.$kongwTypeTxt1;
  $checkkongw = '&nbsp;&nbsp;&nbsp;';
}else if($_POST['kongw'] == 2){
  $kongwTxt = '<br><br><strong>เครื่องกรองน้ำ</strong> : 2 ขั้นตอน '.$kongwTypeTxt2;
  $checkkongw = '&nbsp;&nbsp;&nbsp;';
}else{
  $kongwTxt = '';
  $checkkongw = '<br><br>';
}

if($_POST['stockm'] == 1){
  $stockmTxt = $checkkongw.'<strong>สต็อกเครื่องใหม่</strong> : '.$_POST['stockm_type'];
}else if($_POST['stockm'] == 2){
  $stockmTxt = $checkkongw.'<strong>สต็อกเครื่องเก่า</strong> : '.$_POST['stockm_type2'];
}else{
  $stockmTxt = '';
}

  
$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;">
    '.$headImg.'
    </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> '.$_POST["cd_fax"].'<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' </td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า : </strong> '.get_groupcusname($conn,$_POST['cg_type']).'&nbsp;&nbsp;&nbsp;&nbsp;<strong>ประเภทลูกค้า : </strong>'.custype_name($conn,$_POST["ctype"]).'<strong><br />
              <br />
            ประเภทสินค้า :</strong> '.protype_name($conn,$_POST["pro_type"]).'<br />
            <br />
            <strong>เลขที่ใบเสนอราคา / PO.NO. : </strong>'.$_POST["po_id"].'<br />
            <br />            
            <strong>เลขที่ First order :</strong>'.$_POST["fs_id"].'<strong>&nbsp;&nbsp;&nbsp;&nbsp;วันที่ :</strong> '.format_date($_POST["date_forder"]).'
			<br /><br />    
            <strong>ปีลูกค้า : </strong>'.$_POST["cusyear"].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>รหัสลูกค้า : </strong>'.$_POST["cusid"].'
			</td>
          </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2" style="border:1px solid #000000;margin-top:10px;">
          <tr>
            <td style="font-size:11px;font-family:Verdana, Geneva, sans-serif;padding:5px;width:70%">
              <strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> '.$_POST["loc_name"].'<br />
               <br /><strong>ที่อยู่ :</strong> '.$_POST["loc_address"].'<br /><br />
               <strong>ชื่อผู้ติดต่อ :</ strong> '.$_POST['loc_cname'].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>เบอร์โทร :</ strong> '.$_POST['loc_ctel'].'<br /><br />
               <strong>ขนส่งโดย :</strong> '.$_POST["loc_shopping"].'&nbsp;&nbsp;&nbsp;&nbsp;<strong>เครื่องป้อนน้ำยา :</strong> '.$feeder.$kongwTxt.$stockmTxt.'
            </td>
            <td style="vertical-align:top;font-size:10px;padding:5px;width:30%">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:none;font-size:10px;font-family:Verdana, Geneva, sans-serif;">
                <tr>
                  <td width="50%" style="white-space: nowrap;"><strong>OMG C :</strong> '.$warter01.'</td>
                  <td width="50%" style="white-space: nowrap;"><strong>Wash Glass :</strong> '.$warter04.'</td>
                </tr>
                <tr>
                  <td style="white-space: nowrap;"><strong>OMG R :</strong> '.$warter02.'</td>
                  <td style="white-space: nowrap;"><strong>Rinse Glass :</strong> '.$warter05.'</td>
                </tr>
                <tr>
                  <td style="white-space: nowrap;"><strong>OMG A :</strong> '.$warter03.'</td>
                  <td style="white-space: nowrap;"><strong>Omega Sulution EX :</strong> '.$warter08.'</td>
                </tr>
                <tr>
                  <td style="white-space: nowrap;"><strong>Omega Wash :</strong> '.$warter06.'&nbsp;&nbsp;&nbsp;</td>
                  <td style="white-space: nowrap;"><strong>Omega Sulution EX Dry :</strong> '.$warter09.'</td>
                </tr>
                <tr>
                  <td style="white-space: nowrap;"><strong>Omega Dry :</strong> '.$warter07.'&nbsp;&nbsp;&nbsp;</td>
                  <td style="white-space: nowrap;"></td>
                </tr>
            </table>
            </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;text-align:center;margin-top:10px;">
    <tr>
      <td width="5%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
      <td width="35%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>S/N</strong></td>
      <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคา / หน่วย</strong></td>
      <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ราคารวม (บาท)</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">1</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST["cpro1"]).'</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["pro_pod1"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["pro_sn1"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["camount1"].'</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prpro1.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prspro1.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">2</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST["cpro2"]).'</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["pro_pod2"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["pro_sn2"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["camount2"].'</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prpro2.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prspro2.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">3</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST["cpro3"]).'</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["pro_pod3"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["pro_sn3"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["camount3"].'</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prpro3.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prspro3.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">4</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST["cpro4"]).'</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["pro_pod4"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["pro_sn4"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["camount4"].'</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prpro4.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prspro4.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">5</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST["cpro5"]).'</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["pro_pod5"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["pro_sn5"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["camount5"].'</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prpro5.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prspro5.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">6</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST["cpro6"]).'</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["pro_pod6"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["pro_sn6"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["camount6"].'</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prpro6.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prspro6.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;">7</td>
      <td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST["cpro7"]).'</td>
      <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST["pro_pod7"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["pro_sn7"].'</td>
      <td style="border:1px solid #000000;padding:5;">'.$_POST["camount7"].'</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prpro7.'&nbsp;&nbsp;</td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.$prspro7.'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" rowspan="3" style="text-align:left;border:1px solid #000000;padding:5;vertical-align:top;padding-top:15px;font-size:11px"><strong>หมายเหตุ :</strong> '.nl2br($_POST['ccomment']).'<br>
</td>
      <td style="border:1px solid #000000;padding:5;"><strong>รวมทั้งหมด</strong></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($sumprice,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;"><strong>VAT 7 %</strong></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($sumpricevat,2).'&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;padding:5;"><strong>ราคารวมทั้งสิ้น</strong></td>
      <td style="border:1px solid #000000;padding:5;text-align:right;">'.number_format($sumtotal,2).'&nbsp;&nbsp;</td>
    </tr>
</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
          <tr>
            <td style="border:0;padding:0;width:60%;vertical-align:top;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <th width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></th>
                  <th width="75%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการแถม</strong></th>
                  <th width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></th>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">1</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">'.$_POST["cs_pro1"].'</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$_POST["cs_amount1"].'</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">2</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">'.$_POST["cs_pro2"].'</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$_POST["cs_amount2"].'</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">3</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">'.$_POST["cs_pro3"].'</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$_POST["cs_amount3"].'</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">4</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">'.$_POST["cs_pro4"].'</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$_POST["cs_amount4"].'</td>
              </tr>
              <tr>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">5</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">'.$_POST["cs_pro5"].'</td>
                <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;">'.$_POST["cs_amount5"].'</td>
              </tr>
            </table></td>
            <td style="border:0;padding:0;width:40%;vertical-align:top;padding-left:5px;font-size:10px;border:1px solid #000000;padding-top:10px;">';
			      
			  //if($_POST['ctype'] != 1){
            $form .= '<strong>เลขที่สัญญา : </strong> ' .$_POST["r_id"]. '&nbsp;&nbsp;<strong>เลขที่สัญญาเช่า</strong> '.$_POST["r_idrent"].' <strong>เดือน</strong><br><br />';
					 if($_POST["garun_id"]){ 
					 	$form .= '<strong>การรับประกันเครื่องอะไหล่ : ' .$_POST["garun_id"]. ' เดือน </strong><br><br />';
					 }else{
					 	$form .= '<strong>การรับประกันเครื่องอะไหล่ : 0 เดือน </strong><br><br />';
					 }
					
					 
				  if(($_POST["date_quf"] == date("Y-m-d")) && ($_POST["date_qut"] == date("Y-m-d"))){
					  $form .= '<p style="font-size:11px"><strong>วันเริ่ม : </strong> - <strong>&nbsp;สิ้นสุด : </strong> - </p><br>';
				  }else{
					  $form .= '<p style="font-size:11px"><strong>วันเริ่ม : </strong>'.format_date($_POST["date_quf"]).' <strong>&nbsp;สิ้นสุดสัญญา : </strong>'.format_date($_POST["date_qut"]).'</p>
			  <br>';  
				  }
				  
				  
			  //}
			
			  if($_POST["cs_sign"] != ""){
				  $form .='<div id="cssign"><strong>ผู้มีอำนาจเซ็นสัญญา : </strong>
              	  '.$_POST["cs_sign"].'
              <br><br></div>';
			  }
			  $form .='
        <p style="font-size:11px"><strong>เงื่อนไขการชำระเงิน :</strong> '.nl2br($_POST["qucomment"]).'</p>
		   </td>
          </tr>
</table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
    <tr>
      <td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>บุคคลติดต่อทางด้านการเงิน : '.$_POST["cs_contact"].'</strong></td>
      <td width="50%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"> <strong>โทรศัพท์ : </strong>'.$_POST["cs_tel"].'</td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>วันที่ส่งสินค้า : '.getShipSetupPro($conn,$_POST['fo_id'],1).'</strong></td>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>วันที่ติดตั้งเครื่อง : '.getShipSetupPro($conn,$_POST['fo_id'],2).'</strong></td>
    </tr>
    <tr>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>เงินประกัน : '.number_format($money_garuntree,2).'</strong></td>
      <td style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ค่าขนส่งและติดตั้ง : '.number_format($money_setup,2).'</strong></td>
    </tr>
  </table>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;margin-top:5px;">
      <tr>
		<td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.getsalename($conn,$_POST["cs_company"]).'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>พนักงานขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date($_POST['sign_date1']).'</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong >'.$hSaleSignature.'</strong></td>
              </tr>
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$hSaleName.'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>Sale Manager / ตรวจสอบการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.$dataApprove.'</strong></td>
              </tr>
            </table>
        </td>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$GMSaleSignature.'</strong></td>
              </tr>
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.$hGMSaleName.'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>GM / ผู้อนุมัติการขาย</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.$dataApprove2.'</strong></td>


              </tr>
            </table>
        </td>
      </tr>
    </table>
  ';
	
	if($_POST['remark'] != ""){
		$form .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td style="padding-bottom:5px;"><img src="../images/form/header-first-order.png" width="100%" border="0" /></td>
	  </tr>
	</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].'&nbsp;'.province_name($conn,$_POST["cd_province"]).'<br />
            <br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;แฟกซ์ :</strong> '.$_POST["cd_fax"].'<br /><br />
            <strong>ชื่อผู้ติดต่อ : </strong>'.$_POST["c_contact"].'<strong>&nbsp;&nbsp;&nbsp;เบอร์โทร :</strong> '.$_POST["c_tel"].' </td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>กลุ่มลูกค้า : </strong> '.get_groupcusname($conn,$_POST['cg_type']).'&nbsp;&nbsp;&nbsp;&nbsp;<strong>ประเภทลูกค้า : </strong>'.custype_name($conn,$_POST["ctype"]).'<strong><br />
              <br />
            สินค้า :</strong> '.protype_name($conn,$_POST["pro_type"]).'<br />
            <br />
            <strong>เลขที่ใบเสนอราคา / PO.NO. : </strong>'.$_POST["po_id"].'<br />
            <br />            <strong>เลขที่ First order :</strong><strong> </strong>'.$_POST["fs_id"].'<strong>&nbsp;&nbsp;&nbsp;&nbsp;วันที่ :</strong> '.format_date($_POST["date_forder"]).'<strong></td>
          </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb1">
          <tr>
            <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:15px;"><strong>หมายเหตุอื่นๆ : </strong>'.$_POST["remark"].'</td>
          </tr>
</table>';	
	}
	;
?>
	





