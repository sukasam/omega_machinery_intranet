<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php     

$workNotiInfo = getWorkNotiInfo($conn,$id);

if(in_array('1',$work_list)){$workList1 = 'aroow_ch.png';}else{$workList1 = 'aroow_nch.png';}
if(in_array('2',$work_list)){$workList2 = 'aroow_ch.png';}else{$workList2 = 'aroow_nch.png';}
if(in_array('3',$work_list)){$workList3 = 'aroow_ch.png';}else{$workList3 = 'aroow_nch.png';}
if(in_array('4',$work_list)){$workList4 = 'aroow_ch.png';}else{$workList4 = 'aroow_nch.png';}
if(in_array('5',$work_list)){$workList5 = 'aroow_ch.png';}else{$workList5 = 'aroow_nch.png';}
if(in_array('6',$work_list)){$workList6 = 'aroow_ch.png';}else{$workList6 = 'aroow_nch.png';}
if(in_array('7',$work_list)){$workList7 = 'aroow_ch.png';}else{$workList7 = 'aroow_nch.png';}
if(in_array('8',$work_list)){$workList8 = 'aroow_ch.png';}else{$workList8 = 'aroow_nch.png';}
if(in_array('9',$work_list)){$workList9 = 'aroow_ch.png';}else{$workList9 = 'aroow_nch.png';}
if(in_array('10',$work_list)){$workList10 = 'aroow_ch.png';}else{$workList10 = 'aroow_nch.png';}

$dateW1 = ($_POST["date_work1"] != '0000-00-00') ? format_date($_POST["date_work1"]) : "-";
$dateW2 = ($_POST["date_work2"] != '0000-00-00') ? format_date($_POST["date_work2"]) : "-";
$dateW3 = ($_POST["date_work3"] != '0000-00-00') ? format_date($_POST["date_work3"]) : "-";
$dateW4 = ($_POST["date_work4"] != '0000-00-00') ? format_date($_POST["date_work4"]) : "-";
$dateW5 = ($_POST["date_work5"] != '0000-00-00') ? format_date($_POST["date_work5"]) : "-";

switch($_POST['get_noti']){
  case '1':
    $gwetNoti  = 'ฝ่ายขาย';
  break;
  case '2':
    $gwetNoti  = 'ฝ่ายบัญชี';
  break;
  case '3':
    $gwetNoti  = 'ฝ่ายโรงงาน';
  break;
  case '4':
    $gwetNoti  = 'ฝ่ายขนส่งสินค้า';
  break;
  case '5':
    $gwetNoti  = 'ฝ่ายแผนกช่าง';
  break;
  case '6':
    $gwetNoti  = 'ฝ่ายติดตั้ง / โปรเจ็ค';
  break;
  case '7':
    $gwetNoti  = 'ฝ่ายบริการ';
  break;
}


for($i=0;$i<=count($_POST['cpro']);$i++){

	if($_POST['cpro'][$i] != ""){

		$projectPro .= '<tr>
		<td style="border:1px solid #000000;padding:5;">'.($i+1).'</td>
		<td style="border:1px solid #000000;padding:5;">'.$_POST["ccode"][$i].'</td>
		<td style="border:1px solid #000000;padding:5;">'.get_pro_code($conn,$_POST['cpro'][$i]).'</td>
		<td style="border:1px solid #000000;text-align:left;padding:5;">'.get_proname($conn,$_POST['cpro'][$i]).'</td>
	  <td style="border:1px solid #000000;padding:5;width:100px;">'.$_POST['cpod'][$i].'</td>
		<td style="border:1px solid #000000;padding:5;">'.$_POST['csn'][$i].'</td>
		<td style="border:1px solid #000000;padding:5;">'.$_POST['camount'][$i].'</td>
		</tr>';
		
	}
}

$dataApprove = '';
$dataApprove2 = '';

	if($_POST['sign_work2'] != '0' && $_POST['sign_work2'] != ''){
		if($_POST['sign_date_work2'] != '0000-00-00' && $_POST['sign_date_work2'] != ''){
			$dataApprove = format_date($_POST['sign_date_work2']);
		}else{
			$dataApprove = '';
		}
	}else{
		$dataApprove = '';
  }
  
  $hSaleName = getsalename($conn,$_POST['sign_work2']);
  $hSaleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['sign_work2']).'" height="50" border="0" />';
  
  if($_POST['sign_work3'] != '0' && $_POST['sign_work3'] != ''){
		if($_POST['sign_date_work3'] != '0000-00-00' && $_POST['sign_date_work3'] != ''){
			$dataApprove2 = format_date($_POST['sign_date_work3']);
		}else{
			$dataApprove2 = '';
		}
	}else{
		$dataApprove2 = '';
  }
  $hGMSaleName = getsalename($conn,$_POST['sign_work3']);
  $GMSaleSignature = '<img src="../../upload/user/signature/'.get_sale_signature($conn,$_POST['sign_work3']).'" height="50" border="0" />';

$form = '
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-bottom:5px;"><img src="../images/form/header-work-noti.png" width="100%" border="0" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;">
          <tr>
            <td width="57%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;"><strong>ชื่อลูกค้า :</strong> '.$_POST["cd_name"].'<strong><br />
              <br />
            ที่อยู่ :</strong> '.$_POST["cd_address"].' จังหวัด '.province_name($conn,$_POST['cd_province']).'<br />
            <br />
            <strong>ชื่อผู้ติดต่อ :</strong> '.$_POST["cd_contact"].'<strong>&nbsp;&nbsp;&nbsp;ตำแหน่ง :</strong> '.$_POST["cd_position"].'<br /><br />
            <strong>มือถือ : </strong>'.$_POST["cd_mobile"].'<strong>&nbsp;&nbsp;&nbsp;Line :</strong> '.$_POST["cd_line"].' <br /><br />
            <strong>โทรศัพท์ :</strong> '.$_POST["cd_tel"].'<strong>&nbsp;&nbsp;&nbsp;อีเมล์ :</strong> '.$_POST["cd_email"].'
            </td>
            <td width="43%" valign="top" style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;">
            <strong>เลขที่ใบแจ้งงาน :</strong><strong> </strong>'.$_POST["fs_id"].'<br><br>
            <strong>วันที่ :</strong> '.format_date($_POST["date_open"]).'<br /><br />            
            <strong>พนักงานขาย :</strong> '.getsalename($conn,$_POST["sale_contact"]).'<br /><br />
            <strong>มือถือ :</strong> '.$_POST["sale_tel"].'<br /><br />   
			</td>
          </tr>
</table>
  <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tb2" style="border:1px solid #000000;font-family:Verdana, Geneva, sans-serif;font-size:10px;">
    <tr>
      <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;" width="60%">
        <strong>สถานที่ติดตั้ง / ส่งสินค้า :</strong> '.$_POST["loc_name"].'<br /><br /> 
        <strong>ที่อยู่ :</strong> '.$_POST["loc_address"].'<strong><br /><br />
      </td>
      <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;vertical-align: top;" width="40%">
        <strong>ผู้รับแจ้งงาน :</strong> '.$gwetNoti.'
      </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;font-family:Verdana, Geneva, sans-serif;font-size:10px;padding:5px;border-top:0px;line-height: 25px;">
<tr style="">
  <td width="40%" style="text-align:center;font-weight: bold;font-size:10px;"><u>เอกสารประกอบการแจ้งงาน</u></td>
  <td width="40%" style="text-align:center;font-weight: bold;font-size:10px;"><u>รายละเอียดการแจ้งงาน</u></td>
  <td width="20%" style="font-weight: bold;font-size:10px;"><u>วันที่เข้าบริการ / นัดหมาย</u></td>
</tr>
<tr>
  <td ><img src="../images/'.$workList1.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;ติดตั้งเครื่องป้อนน้ำยา</td>
  <td><img src="../images/'.$workList2.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;เพิ่อเขียนแบบ : '.$_POST['work_detail1'].'</td>
  <td>วันที่ : '.$dateW1.'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList3.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;ตรวจเช็คเพื่อเสนอราคาซ่อม</td>
  <td><img src="../images/'.$workList4.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;ตรวจสอบพื้นที่ / ดูหน้างาน / วัดพื้นที่</td>
  <td>วันที่ : '.$dateW2.'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList5.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;ย้ายเครื่อง / ถอดเครื่อง</td>
  <td><img src="../images/'.$workList6.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;เพื่อผลิตสินค้า (อ้างอิงเอกสาร) : '.$_POST['work_detail2'].'</td>
  <td>วันที่ : '.$dateW3.'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList7.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;ดูพื้นที่ / ตรวจเช็คหน้างาน</td>
  <td><img src="../images/'.$workList8.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;เพื่อแจ้งซ่อม / บริการ : '.$_POST['work_detail3'].'</td>
  <td>วันที่ : '.$dateW4.'</td>
</tr>
<tr>
  <td><img src="../images/'.$workList9.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;อื่นๆ : '.$_POST['work_detail4'].'</td>
  <td><img src="../images/'.$workList10.'" width="10" height="10" border="0" alt="" style="vertical-align: middle"/>&nbsp;อื่นๆ ระบุ : '.$_POST['work_detail5'].'</td>
  <td>วันที่ : '.$dateW5.'</td>
</tr>
</table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;text-align:center;margin-top:10px;">
  <tr>
    <td width="8%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ลำดับ</strong></td>
  <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>Code</strong></td>
  <td width="10%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รหัสสินค้า</strong></td>
    <td width="27%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รายการ</strong></td>
    <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>รุ่น/แบรนด์</strong></td>
    <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>ขนาด</strong></td>
    <td width="15%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;padding:5px;text-align:center;"><strong>จำนวน</strong></td>
  </tr>
  
'.$projectPro.'    

</table>

  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000;line-height: 20px;margin-top:10px;">
    <tr>
      <td style="text-align:center;padding:5px;">
        <u style="font-family:Verdana, Geneva, sans-serif;font-size:12px;font-weight: bold;">รายละเอียด การแจ้งงาน</u>
      </td>
    </tr>
    <tr>
      <td style="padding:5px;font-size:12px;vertical-align: top;">
        <div >'.stripslashes($_POST['remark']).'</div>
      </td>
    </tr>
  </table>
  <br>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">
      <tr>
        <td width="33%" style="border:1px solid #000000;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;padding-top:10px;padding-bottom:10px;">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-bottom:1px solid #000000;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>'.getsalename($conn,$_POST["sign_work1"]).'</strong></td>
              </tr>
              <tr>
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>ผู้แจ้งงาน</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.format_date($_POST["sign_date_work1"]).'</strong></td>
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>หัวหน้า / ผู้แจ้งงาน</strong></td>
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
                <td style="padding-top:10px;padding-bottom:10px;font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>GM/อนุมัติ</strong></td>
              </tr>
              <tr>
                <td style="font-size:10px;font-family:Verdana, Geneva, sans-serif;text-align:center;"><strong>วันที่ '.$dataApprove2.'</strong></td>
              </tr>
            </table>
        </td>
      </tr>
    </table> 
  <br><br><br>
  ';
  if($workNotiInfo['images1'] != ""){
    $form .= '<div style="font-family:Verdana, Geneva, sans-serif;text-align:center;font-size:14px;font-weight: bold;"><u>รูปภาพประกอบ การแจ้งงาน</u>
    <br><br>
    <img src="../../upload/work_noti/images/'.$workNotiInfo['images1'].'" style="max-height: 470px;"><br><br>';

    if($workNotiInfo['images2'] != ""){
      $form .= '<img src="../../upload/work_noti/images/'.$workNotiInfo['images2'].'" style="max-height: 470px;"><br><br>';
    }

    if($workNotiInfo['images3'] != ""){
      $form .= '<img src="../../upload/work_noti/images/'.$workNotiInfo['images3'].'" style="max-height: 470px;"><br><br>';
    }

    $form .= '</div>';
  }

?>
	





